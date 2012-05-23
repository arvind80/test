<?php
// Config 
if($_SERVER['REMOTE_ADDR'] == '72.135.111.9')
{
	error_reporting(E_ALL);
	ini_set('display_errors',1);		
}

require_once('includes/config.php');
require_once('includes/functions.php');

// PayPal Connection
require_once('includes/paypal/library/includes/paypal.class.php');
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $paypal_api_username, 'APIPassword' => $paypal_api_password, 'APISignature' => $paypal_api_signature);
$PayPal = new PayPal($PayPalConfig);

// MySQL Connection
require_once('includes/database.class.php');
$db = Database::obtain($db_host,$db_user,$db_pass,$db_name);
$db->connect();

// PHPMailer
require_once('includes/phpmailer/class.phpmailer.php');
require_once('includes/phpmailer/class.smtp.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = $smtp_host;
$mail->Port = 465;
$mail->Username = $smtp_username;
$mail->Password = $smtp_password;
$mail->IsHTML(true);
$mail->From = $email_from_address;				
$mail->FromName = $email_from_name;

// Get PayPal transactions.
$StartDate = '2012-01-22T00:0:00Z';
$EndDate = '2012-01-23T23:59:59Z';

$TSFields = array(
					'startdate' => $StartDate, 					// Required.  The earliest transaction date you want returned.  Must be in UTC/GMT format.  2008-08-30T05:00:00.00Z
					'enddate' => $EndDate, 						// The latest transaction date you want to be included.
					'email' => '', 								// Search by the buyer's email address.
					'receiver' => '', 							// Search by the receiver's email address.  
					'receiptid' => '', 							// Search by the PayPal account optional receipt ID.
					'transactionid' => '', 						// Search by the PayPal transaction ID.
					'invnum' => '', 							// Search by your custom invoice or tracking number.
					'acct' => '', 								// Search by a credit card number, as set by you in your original transaction.  
					'auctionitemnumber' => '', 					// Search by auction item number.
					'transactionclass' => '', 					// Search by classification of transaction.  Possible values are: All, Sent, Received, MassPay, MoneyRequest, FundsAdded, FundsWithdrawn, Referral, Fee, Subscription, Dividend, Billpay, Refund, CurrencyConversions, BalanceTransfer, Reversal, Shipping, BalanceAffecting, ECheck
					'amt' => '', 								// Search by transaction amount.
					'currencycode' => '', 						// Search by currency code.
					'status' => '',  							// Search by transaction status.  Possible values: Pending, Processing, Success, Denied, Reversed
					'profileid' => ''							// Recurring Payments profile ID.  Currently undocumented but has tested to work.
				);
				
$PayerName = array(
					'salutation' => '', 						// Search by payer's salutation.
					'firstname' => '', 							// Search by payer's first name.
					'middlename' => '', 						// Search by payer's middle name.
					'lastname' => '', 							// Search by payer's last name.
					'suffix' => ''	 							// Search by payer's suffix.
				);
				
$PayPalRequestData = array(
						'TSFields' => $TSFields, 
						'PayerName' => $PayerName
						);

$PayPalResult = $PayPal->TransactionSearch($PayPalRequestData);

if($PayPalResult['ACK'] != 'Success')
{
	exit($PayPalResult['ACK']);	
}

// If the TransactionSearch call fails, send a notification to the administration and exit the script.
if(!$PayPal->APICallSuccessful($PayPalResult['ACK']))
{	
	$api_log['source'] = 'PayPal';
	$api_log['api_name'] = 'TransactionSearch';
	$api_log['ack'] = $PayPalResult['ACK'];
	$api_log['transaction_id'] = '';
	$api_log['raw_request'] = $PayPalResult['RAWREQUEST'];
	$api_log['raw_response'] = $PayPalResult['RAWRESPONSE'];
	$api_log['serialized_result'] = serialize($PayPalResult);
	$transaction_search_api_log_id = $db->insert('api_logs',$api_log);
	
	$mail -> Subject  =  'Transactions Synced Failed - '.$StartDate;
	$mail -> Body = $PayPal->DisplayErrors($PayPalResult['ERRORS']);
	$mail -> AddAddress($admin_email_address, $admin_name);
	$mail -> Send();
	$mail -> ClearAddresses();
	exit();
}
else
{
	if($enable_logging)
	{
		$api_log['source'] = 'PayPal';
		$api_log['api_name'] = 'TransactionSearch';
		$api_log['ack'] = $PayPalResult['ACK'];
		$api_log['transaction_id'] = '';
		$api_log['raw_request'] = $PayPalResult['RAWREQUEST'];
		$api_log['raw_response'] = $PayPalResult['RAWRESPONSE'];
		$api_log['serialized_result'] = serialize($PayPalResult);
		$transaction_search_api_log_id = $db->insert('api_logs',$api_log);
	}
}

// Loop through all transactions and call GetTransactionDetails for each.
foreach($PayPalResult['SEARCHRESULTS'] as $SearchResult)
{		
	// Setup TransactionSearch table data
	$TransactionSearch = array();
	$TransactionSearch['l_timestamp'] = isset($SearchResult['L_TIMESTAMP']) ? $SearchResult['L_TIMESTAMP'] : '';
	$TransactionSearch['l_timezone'] = isset($SearchResult['L_TIMEZONE']) ? $SearchResult['L_TIMEZONE'] : '';
	$TransactionSearch['l_type'] = isset($SearchResult['L_TYPE']) ? $SearchResult['L_TYPE'] : '';
	$TransactionSearch['l_transactionid'] = isset($SearchResult['L_TRANSACTIONID']) ? $SearchResult['L_TRANSACTIONID'] : '';
	$TransactionSearch['l_amt'] = isset($SearchResult['L_AMT']) ? $SearchResult['L_AMT'] : '';
	$TransactionSearch['l_feeamt'] = isset($SearchResult['L_FEEAMT']) ? $SearchResult['L_FEEAMT'] : '';
	$TransactionSearch['l_netamt'] = isset($SearchResult['L_NETAMT']) ? $SearchResult['L_NETAMT'] : '';
	$TransactionSearch['l_status'] = isset($SearchResult['L_STATUS']) ? $SearchResult['L_STATUS'] : '';
	$TransactionSearch['l_email'] = isset($SearchResult['L_EMAIL']) ? $SearchResult['L_EMAIL'] : '';
	$TransactionSearch['api_log_id'] = $transaction_search_api_log_id;
	
	// Check to see if this transaction already exists in the database and update/add accordingly
	$transfer_exists = false;
	$sql = "SELECT id FROM transaction_search WHERE l_transactionid = '".$TransactionSearch['l_transactionid']."'";
	$transfer_record = $db->query_first($sql);
	$transfer_exists = isset($transfer_record['id']) && $transfer_record['id'] != '' ? true : false;
	
	if(!$transfer_exists)
	{
		$TransactionSearchID = $db->insert('transaction_search',$TransactionSearch);
	}
	else
	{
		$TransactionSearchID = $transfer_record['id'];
		$db->update('transaction_search',$TransactionSearch,"id='".$db->escape($TransactionSearchID)."'");
	}
	
	if(strtoupper($TransactionSearch['l_type']) != 'BILL' && strtoupper($TransactionSearch['l_type']) != 'VOUCHER REVERSAL' && strtoupper($TransactionSearch['l_type']) != 'TRANSFER')
	{
		// Call GetTransactionDetails for the current transaction in the loop.
		$GTDFields = array('transactionid' => $SearchResult['L_TRANSACTIONID']);		
		$PayPalRequestData = array('GTDFields'=>$GTDFields);
		$PayPalResult = $PayPal->GetTransactionDetails($PayPalRequestData);	
		
		if(!$PayPal->APICallSuccessful($PayPalResult['ACK']))
		{
			$api_log['source'] = 'PayPal';
			$api_log['api_name'] = 'GetTransactionDetails';
			$api_log['ack'] = $PayPalResult['ACK'];
			$api_log['transaction_id'] = $SearchResult['L_TRANSACTIONID'];
			$api_log['raw_request'] = $PayPalResult['RAWREQUEST'];
			$api_log['raw_response'] = $PayPalResult['RAWRESPONSE'];
			$api_log['serialized_result'] = serialize($PayPalResult);
			$gtd_api_log_id = $db->insert('api_logs',$api_log);		
		}
		else
		{
			if($enable_logging)
			{
				$api_log['source'] = 'PayPal';
				$api_log['api_name'] = 'GetTransactionDetails';
				$api_log['ack'] = $PayPalResult['ACK'];
				$api_log['transaction_id'] = $SearchResult['L_TRANSACTIONID'];
				$api_log['raw_request'] = $PayPalResult['RAWREQUEST'];
				$api_log['raw_response'] = $PayPalResult['RAWRESPONSE'];
				$api_log['serialized_result'] = serialize($PayPalResult);
				$gtd_api_log_id = $db->insert('api_logs',$api_log);		
			}	
		}
		
		
		// Add get_transaction_details record to database.
		$Transaction = array();
		$Transaction['api_log_id'] = $gtd_api_log_id;
		$Transaction['payerid'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
		$Transaction['salutation'] = isset($PayPalResult['SALUTATION']) ? $PayPalResult['SALUTATION'] : '';
		$Transaction['firstname'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
		$Transaction['middlename'] = isset($PayPalResult['MIDDLENAME']) ? $PayPalResult['MIDDLENAME'] : '';
		$Transaction['lastname'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';
		$Transaction['suffix'] = isset($PayPalResult['SUFFIX']) ? $PayPalResult['SUFFIX'] : '';
		$Transaction['payerbusiness'] = isset($PayPalResult['PAYERBUSINESS']) ? $PayPalResult['PAYERBUSINESS'] : '';
		$Transaction['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
		$Transaction['buyerid'] = isset($PayPalResult['BUYERID']) ? $PayPalResult['BUYERID'] : '';
		$Transaction['transaction_search_id'] = isset($TransactionSearchID) ? $TransactionSearchID : '';
		$Transaction['shippingcalculationmode'] = isset($PayPalResult['SHIPPINGCALCULATIONMODE']) ? $PayPalResult['SHIPPINGCALCULATIONMODE'] : '';
		$Transaction['insuranceoptionselected'] = isset($PayPalResult['INSURANCEOPTIONSELECTED']) ? $PayPalResult['INSURANCEOPTIONSELECTED'] : '';
		$Transaction['giftmessage'] = isset($PayPalResult['GIFTMESSAGE']) ? $PayPalResult['GIFTMESSAGE'] : '';
		$Transaction['giftreceiptenable'] = isset($PayPalResult['GIFTRECEIPTENABLE']) ? $PayPalResult['GIFTRECEIPTENABLE'] : '';
		$Transaction['giftwrapname'] = isset($PayPalResult['GIFTWRAPNAME']) ? $PayPalResult['GIFTWRAPNAME'] : '';
		$Transaction['giftwrapamount'] = isset($PayPalResult['GIFTWRAPAMOUNT']) ? $PayPalResult['GIFTWRAPAMOUNT'] : '';
		$Transaction['buyermarketingemail'] = isset($PayPalResult['BUYERMARKETINGEMAIL']) ? $PayPalResult['BUYERMARKETINGEMAIL'] : '';
		$Transaction['surveyquestion'] = isset($PayPalResult['SURVEYQUESTION']) ? $PayPalResult['SURVEYQUESTION'] : '';
		$Transaction['receiverid'] = isset($PayPalResult['RECEIVERID']) ? $PayPalResult['RECEIVERID'] : '';
		$Transaction['receiveremail'] = isset($PayPalResult['RECEIVEREMAIL']) ? $PayPalResult['RECEIVEREMAIL'] : '';
		$Transaction['payerstatus'] = isset($PayPalResult['PAYERSTATUS']) ? $PayPalResult['PAYERSTATUS'] : '';
		$Transaction['countrycode'] = isset($PayPalResult['COUNTRYCODE']) ? $PayPalResult['COUNTRYCODE'] : '';
		$Transaction['receiverbusiness'] = isset($PayPalResult['RECEIVERBUSINESS']) ? $PayPalResult['RECEIVERBUSINESS'] : '';
		$Transaction['addressowner'] = isset($PayPalResult['ADDRESSOWNER']) ? $PayPalResult['ADDRESSOWNER'] : '';
		$Transaction['addressstatus'] = isset($PayPalResult['ADDRESSSTATUS']) ? $PayPalResult['ADDRESSSTATUS'] : '';
		$Transaction['shiptoname'] = isset($PayPalResult['SHIPTONAME']) ? $PayPalResult['SHIPTONAME'] : '';
		$Transaction['shiptostreet'] = isset($PayPalResult['SHIPTOSTREET']) ? $PayPalResult['SHIPTOSTREET'] : '';
		$Transaction['shiptostreet2'] = isset($PayPalResult['SHIPTOSTREET2']) ? $PayPalResult['SHIPTOSTREET2'] : '';
		$Transaction['shiptocity'] = isset($PayPalResult['SHIPTOCITY']) ? $PayPalResult['SHIPTOCITY'] : '';
		$Transaction['shiptostate'] = isset($PayPalResult['SHIPTOSTATE']) ? $PayPalResult['SHIPTOSTATE'] : '';
		$Transaction['shiptopostalcode'] = isset($PayPalResult['SHIPTOZIP']) ? $PayPalResult['SHIPTOZIP'] : '';
		$Transaction['shiptocountrycode'] = isset($PayPalResult['SHIPTOCOUNTRYCODE']) ? $PayPalResult['SHIPTOCOUNTRYCODE'] : '';
		$Transaction['shiptophonenum'] = isset($PayPalResult['SHIPTOPHONENUM']) ? $PayPalResult['SHIPTOPHONENUM'] : '';
		$Transaction['transactionid'] = isset($PayPalResult['TRANSACTIONID']) ? $PayPalResult['TRANSACTIONID'] : '';
		$Transaction['parenttransactionid'] = isset($PayPalResult['PARENTTRANSACTIONID']) ? $PayPalResult['PARENTTRANSACTIONID'] : '';
		$Transaction['receiptid'] = isset($PayPalResult['RECEIPTID']) ? $PayPalResult['RECEIPTID'] : '';
		$Transaction['transactiontype'] = isset($PayPalResult['TRANSACTIONTYPE']) ? $PayPalResult['TRANSACTIONTYPE'] : '';
		$Transaction['paymenttype'] = isset($PayPalResult['PAYMENTTYPE']) ? $PayPalResult['PAYMENTTYPE'] : '';
		$Transaction['ordertime'] = isset($PayPalResult['ORDERTIME']) ? $PayPalResult['ORDERTIME'] : '';
		$Transaction['amt'] = isset($PayPalResult['AMT']) && $PayPalResult['AMT'] > 0 ? $PayPalResult['AMT'] : 0;
		$Transaction['currencycode'] = isset($PayPalResult['CURRENCYCODE']) ? $PayPalResult['CURRENCYCODE'] : '';
		$Transaction['feeamt'] = isset($PayPalResult['FEEAMT']) && $PayPalResult['FEEAMT'] > 0 ? $PayPalResult['FEEAMT'] : 0;
		$Transaction['settleamt'] = isset($PayPalResult['SETTLEAMT']) && $PayPalResult['SETTLEAMT'] > 0 ? $PayPalResult['SETTLEAMT'] : 0;
		$Transaction['exchangerate'] = isset($PayPalResult['EXCHANGERATE']) ? $PayPalResult['EXCHANGERATE'] : '';
		$Transaction['paymentstatus'] = isset($PayPalResult['PAYMENTSTATUS']) ? $PayPalResult['PAYMENTSTATUS'] : '';
		$Transaction['pendingreason'] = isset($PayPalResult['PENDINGREASON']) ? $PayPalResult['PENDINGREASON'] : '';
		$Transaction['reasoncode'] = isset($PayPalResult['REASONCODE']) ? $PayPalResult['REASONCODE'] : '';
		$Transaction['protectioneligibility'] = isset($PayPalResult['PROTECTIONELIGIBILITY']) ? $PayPalResult['PROTECTIONELIGIBILITY'] : '';
		$Transaction['protectioneligibilitytype'] = isset($PayPalResult['PROTECTIONELIGIBILITYTYPE']) ? $PayPalResult['PROTECTIONELIGIBILITYTYPE'] : '';
		$Transaction['invnum'] = isset($PayPalResult['INVNUM']) ? $PayPalResult['INVNUM'] : '';
		$Transaction['custom'] = isset($PayPalResult['CUSTOM']) ? $PayPalResult['CUSTOM'] : '';
		$Transaction['note'] = isset($PayPalResult['NOTE']) ? $PayPalResult['NOTE'] : '';
		$Transaction['salestax'] = isset($PayPalResult['SALESTAX']) ? $PayPalResult['SALESTAX'] : '';
		$Transaction['closingdate'] = isset($PayPalResult['CLOSINGDATE']) ? $PayPalResult['CLOSINGDATE'] : '';
		$Transaction['multiitem'] = isset($PayPalResult['MULTIITEM']) ? $PayPalResult['MULTIITEM'] : '';
		$Transaction['period'] = isset($PayPalResult['PERIOD']) ? $PayPalResult['PERIOD'] : '';
		$Transaction['correlationid'] = isset($PayPalResult['CORRELATIONID']) ? $PayPalResult['CORRELATIONID'] : '';
		$Transaction['shippingamt'] = isset($PayPalResult['SHIPPINGAMT']) && $PayPalResult['SHIPPINGAMT'] > 0 ? $PayPalResult['SHIPPINGAMT'] : 0;
		$Transaction['handlingamt'] = isset($PayPalResult['HANDLINGAMT']) && $PayPalResult['HANDLINGAMT'] > 0 ? $PayPalResult['HANDLINGAMT'] : 0;
		$Transaction['taxamt'] = isset($PayPalResult['TAXAMT']) && $PayPalResult['TAXAMT'] > 0 ? $PayPalResult['TAXAMT'] : 0;
		$Transaction['insuranceamount'] = isset($PayPalResult['INSURANCEAMOUNT']) && $PayPalResult['INSURANCEAMOUNT'] > 0 ? $PayPalResult['INSURANCEAMOUNT'] : 0;
		
		// Check to see if this transaction already exists in the database.
		$transaction_exists = false;
		$sql = "SELECT id FROM get_transaction_details WHERE transactionid = '".$db->escape($Transaction['transactionid'])."'";
		$transaction_record = $db->query_first($sql);
		$transaction_exists = isset($transaction_record['id']) && $transaction_record['id'] != '' ? true : false;
		
		if(!$transaction_exists)
		{
			$GetTransactionDetailsID = $db->insert('get_transaction_details',$Transaction);		
		}
		else
		{
			$GetTransactionDetailsID = $transaction_record['id'];
			$db->update('get_transaction_details', $Transaction, "id='".$db->escape($GetTransactionDetailsID)."'");	
		}
		
		foreach($PayPalResult['ORDERITEMS'] as $OrderItem)
		{
			$TransactionItem = array();
			$TransactionItem['get_transaction_details_id'] = $GetTransactionDetailsID;
			$TransactionItem['l_name'] = isset($OrderItem['L_NAME']) ? $OrderItem['L_NAME'] : '';
			$TransactionItem['l_desc'] = isset($OrderItem['L_DESC']) ? $OrderItem['L_DESC'] : '';
			$TransactionItem['l_number'] = isset($OrderItem['L_NUMBER']) ? $OrderItem['L_NUMBER'] : '';
			$TransactionItem['l_qty'] = isset($OrderItem['L_QTY']) && $OrderItem['L_QTY'] > 0 ? $OrderItem['L_QTY'] : 0;
			$TransactionItem['l_amt'] = isset($OrderItem['L_AMT']) && $OrderItem['L_AMT'] > 0  ? $OrderItem['L_AMT'] : 0;
			$TransactionItem['l_ebayitemtxnid'] = isset($OrderItem['L_EBAYITEMTXNID']) ? $OrderItem['L_EBAYITEMTXNID'] : '';
			$TransactionItem['l_ebayitemorderid'] = isset($OrderItem['L_EBAYITEMORDERID']) ? $OrderItem['L_EBAYITEMORDERID'] : '';
			$TransactionItem['l_shippingamt'] = isset($OrderItem['L_SHIPPINGAMT']) && $OrderItem['L_SHIPPINGAMT'] > 0  ? $OrderItem['L_SHIPPINGAMT'] : 0;
			$TransactionItem['l_handlingamt'] = isset($OrderItem['L_HANDLINGAMT']) && $OrderItem['L_HANDLINGAMT'] > 0  ? $OrderItem['L_HANDLINGAMT'] : 0;
			$TransactionItem['l_taxamt'] = isset($OrderItem['L_TAXAMT']) && $OrderItem['L_TAXAMT'] > 0  ? $OrderItem['L_TAXAMT'] : 0;
						
			// If the item is from eBay, grab remaining details from eBay's API.
			if($TransactionItem['l_ebayitemtxnid'] != '' || $TransactionItem['l_ebayitemorderid'] != '')
			{
				// eBay Connection
				require_once('includes/ebay/library/includes/eBay.class.php');
				$eBayConfig = array('Sandbox' => $sandbox, 'AuthToken' => $eBay_auth_token);
				$eBay = new eBay($eBayConfig);
				
				$eBayResult = $eBay->GetItem($OrderItem['L_NUMBER']);
				
				if(strtoupper($eBayResult['Ack']) != 'SUCCESS' && strtoupper($eBayResult['Ack']) != 'SUCCESSWITHWARNING')
				{					
					$api_log['source'] = 'eBay';
					$api_log['api_name'] = 'GetItem';
					$api_log['ack'] = $eBayResult['Ack'];
					$api_log['transaction_id'] = $OrderItem['L_NUMBER'];
					$api_log['raw_request'] = $eBayResult['RawRequest'];
					$api_log['raw_response'] = $eBayResult['RawResponse'];
					$api_log['serialized_result'] = serialize($eBayResult);
					$eBay_api_log_id = $db->insert('api_logs',$api_log);	
				}
				else
				{
					if($enable_logging)
					{						
						$api_log['source'] = 'eBay';
						$api_log['api_name'] = 'GetItem';
						$api_log['ack'] = $eBayResult['Ack'];
						$api_log['transaction_id'] = $OrderItem['L_NUMBER'];
						$api_log['raw_request'] = $eBayResult['RawRequest'];
						$api_log['raw_response'] = $eBayResult['RawResponse'];
						$api_log['serialized_result'] = serialize($eBayResult);
						$eBay_api_log_id = $db->insert('api_logs',$api_log);	
					}	
				}
				
				$TransactionItem['url'] = isset($eBayResult['ViewItemURL']) ? $eBayResult['ViewItemURL'] : '';
				$TransactionItem['end_date'] = isset($eBayResult['EndTime']) ? $eBayResult['EndTime'] : '';
				$TransactionItem['ebay_title'] = isset($eBayResult['Title']) ? $eBayResult['Title'] : '';
				$TransactionItem['ebay_subtitle'] = isset($eBayResult['SubTitle']) ? $eBayResult['SubTitle'] : '';
				$TransactionItem['location'] = isset($eBayResult['Location']) ? $eBayResult['Location'] : '';
				$TransactionItem['condition'] = isset($eBayResult['ConditionDisplayName']) ? $eBayResult['ConditionDisplayName'] : '';
				$TransactionItem['description'] = isset($eBayResult['Description']) ? $eBayResult['Description'] : '';
				$TransactionItem['external_picture_url'] = isset($eBayResult['ExternalPictureURL']) ? $eBayResult['ExternalPictureURL'] : '';
				$TransactionItem['gallery_picture_url'] = isset($eBayResult['GalleryURL']) ? $eBayResult['GalleryURL'] : '';
				$TransactionItem['picture_url'] = isset($eBayResult['PictureURL']) ? $eBayResult['PictureURL'] : '';
				$TransactionItem['return_policy_description'] = isset($eBayResult['ReturnPolicyDescription']) ? $eBayResult['ReturnPolicyDescription'] : '';
				$TransactionItem['refund'] = isset($eBayResult['Refund']) ? $eBayResult['Refund'] : '';
				$TransactionItem['refund_option'] = isset($eBayResult['RefundOption']) ? $eBayResult['RefundOption'] : '';
				$TransactionItem['returns_accepted'] = isset($eBayResult['ReturnsAccepted']) ? $eBayResult['ReturnsAccepted'] : '';
				$TransactionItem['returns_accepted_option'] = isset($eBayResult['ReturnsAcceptedOption']) ? $eBayResult['ReturnsAcceptedOption'] : '';
				$TransactionItem['returns_within'] = isset($eBayResult['ReturnsWithin']) ? $eBayResult['ReturnsWithin'] : '';
				$TransactionItem['returns_within_option'] = isset($eBayResult['ReturnsWithinOption']) ? $eBayResult['ReturnsWithinOption'] : '';
				$TransactionItem['shipping_cost_paid_by'] = isset($eBayResult['ShippingCostPaidBy']) ? $eBayResult['ShippingCostPaidBy'] : '';
				$TransactionItem['shipping_cost_paid_by_option'] = isset($eBayResult['ShippingCostPaidByOption']) ? $eBayResult['ShippingCostPaidByOption'] : '';
				$TransactionItem['warranty_duration'] = isset($eBayResult['WarrantyDuration']) ? $eBayResult['WarrantyDuration'] : '';
				$TransactionItem['warranty_duration_option'] = isset($eBayResult['WarrantyDurationOption']) ? $eBayResult['WarrantyDurationOption'] : '';
				$TransactionItem['warranty_offered'] = isset($eBayResult['WarrantyOffered']) ? $eBayResult['WarrantyOffered'] : '';
				$TransactionItem['warranty_offered_option'] = isset($eBayResult['WarrantyOfferedOption']) ? $eBayResult['WarrantyOfferedOption'] : '';
				$TransactionItem['warranty_type'] = isset($eBayResult['WarrantyType']) ? $eBayResult['WarrantyType'] : '';
				$TransactionItem['warranty_type_option'] = isset($eBayResult['WarrantyTypeOption']) ? $eBayResult['WarrantyTypeOption'] : '';
				$TransactionItem['api_ebay_log_id'] = $eBay_api_log_id;				
			}
			
			// Check to see if this transaction_item already exists in the database.
			$transaction_item_exists = false;
			$sql = "SELECT id FROM get_transaction_details_items WHERE get_transaction_details_id = '".$db->escape($GetTransactionDetailsID)."' AND l_number = '".$db->escape($TransactionItem['l_number'])."'";
			$transaction_item_record = $db->query_first($sql);
			$transaction_item_exists = isset($transaction_item_record['id']) && $transaction_item_record['id'] != '' ? true : false;
			
			if(!$transaction_item_exists)
			{
				$GetTransactionDetailsItemsID = $db->insert('get_transaction_details_items',$TransactionItem);		
			}
			else
			{
				$GetTransactionDetailsItemsID = $transaction_item_record['id'];
				$db->update('get_transaction_details_items', $TransactionItem, "id='".$db->escape($GetTransactionDetailsItemsID)."'");	
			}
			
			// Save images locally
			if(isset($TransactionItem['external_picture_url']) && $TransactionItem['external_picture_url'] != '')
			{
				save_image($TransactionItem['external_picture_url'],'images/products/'.$GetTransactionDetailsItemsID.'-external_picture_url.jpg');	
			}
			
			if(isset($TransactionItem['gallery_picture_url']) && $TransactionItem['gallery_picture_url'] != '')
			{
				save_image($TransactionItem['gallery_picture_url'],'images/products/'.$GetTransactionDetailsItemsID.'-gallery_picture_url.jpg');	
			}
			
			if(isset($TransactionItem['picture_url']) && $TransactionItem['picture_url'] != '')
			{
				save_image($TransactionItem['picture_url'],'images/products/'.$GetTransactionDetailsItemsID.'-picture_url.jpg');	
			}
		}
	}
}

// Close database connection.
$db->close();

// Send notification email to administrator.
if($send_email_notification)
{
	$mail->Subject  =  'Transactions Synced Successfully - '.$StartDate;
	$mail->Body = 'get-transactions-raw.php has completed successfully.';
	$mail->AddAddress($admin_email_address, $admin_name);
	$mail->Send();
	$mail->ClearAddresses();	
}

echo $StartDate .' - ' . $EndDate . ' Complete';
?>