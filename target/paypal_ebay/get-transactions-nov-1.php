<?php
// Config 
if($_SERVER['REMOTE_ADDR'] == '72.135.106.15')
{
	error_reporting(E_ALL);
	ini_set('display_errors',1);		
}

set_time_limit(3600);

require_once('/home/harvest/includes/config.php');
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
$StartDate = gmdate("Y-m-d\TH:i:s\Z",strtotime('now - '.$minutes_back.' min'));
$StartDate = '2011-11-01T00:00:00Z';
$EndDate = '2011-11-01T23:59:59Z';
$EndDate = '2011-11-01T12:00:00Z';

$TSFields = array(
					'startdate' => $StartDate, 							// Required.  The earliest transaction date you want returned.  Must be in UTC/GMT format.  2008-08-30T05:00:00.00Z
					'enddate' => $EndDate, 							// The latest transaction date you want to be included.
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

// If the TransactionSearch call fails, send a notification to the administration and exit the script.
if(!$PayPal->APICallSuccessful($PayPalResult['ACK']))
{	
	$PayPal->Logger('TransactionSearch_Request',$PayPalResult['RAWREQUEST']);
	$PayPal->Logger('TransactionSearch_Response',$PayPalResult['RAWRESPONSE']);	
	
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
		$PayPal->Logger('TransactionSearch_Request',$PayPalResult['RAWREQUEST']);
		$PayPal->Logger('TransactionSearch_Response',$PayPalResult['RAWRESPONSE']);		
	}
}

// Loop through all transactions and call GetTransactionDetails for each.
foreach($PayPalResult['SEARCHRESULTS'] as $SearchResult)
{	
	$SenderTransactionID = isset($SearchResult['L_TRANSACTIONID']) ? $SearchResult['L_TRANSACTIONID'] : '';
	
	if(strtoupper($SearchResult['L_TYPE']) == 'TRANSFER' || strtoupper($SearchResult['L_STATUS']) == 'UNCLAIMED')
	{
		// Add transfer data to database.
		$Transfer['paypal_timestamp'] = isset($SearchResult['L_TIMESTAMP']) ? $SearchResult['L_TIMESTAMP'] : '';
		$Transfer['payment_type'] = isset($SearchResult['L_TYPE']) ? $SearchResult['L_TYPE'] : '';
		$Transfer['ship_to_name'] = isset($SearchResult['L_NAME']) ? $SearchResult['L_NAME'] : '';
		$Transfer['sender_transaction_id'] = isset($SearchResult['L_TRANSACTIONID']) ? $SearchResult['L_TRANSACTIONID'] : '';
		$Transfer['amount'] = isset($SearchResult['L_AMT']) ? $SearchResult['L_AMT'] : '';
		
		// Check to see if this transfer already exists in the database.
		$transfer_exists = false;
		$sql = "SELECT id FROM transactions WHERE sender_transaction_id = '".$Transfer['sender_transaction_id']."'";
		$transfer_record = $db->query_first($sql);
		$transfer_exists = isset($transfer_record['id']) && $transfer_record['id'] != '' ? true : false;
		
		if(!$transfer_exists)
		{
			$TransactionID = $db->insert('transactions',$Transfer);
		}
		else
		{
			$TransactionID = $transfer_record['id'];
			$db->update('transactions',$Transfer,"id='".$db->escape($TransactionID)."'");
		}
	}
	else
	{
		// Call GetTransactionDetails for the current transaction in the loop.
		$GTDFields = array('transactionid' => $SearchResult['L_TRANSACTIONID']);		
		$PayPalRequestData = array('GTDFields'=>$GTDFields);
		$PayPalResult = $PayPal->GetTransactionDetails($PayPalRequestData);	
		
		if(!$PayPal->APICallSuccessful($PayPalResult['ACK']))
		{
			$PayPal->Logger('GetTransactionDetails_'.$SearchResult['L_TRANSACTIONID'].'_Request',$PayPalResult['RAWREQUEST']);
			$PayPal->Logger('GetTransactionDetails_'.$SearchResult['L_TRANSACTIONID'].'_Response',$PayPalResult['RAWRESPONSE']);		
		}
		else
		{
			if($enable_logging)
			{
				$PayPal->Logger('GetTransactionDetails_'.$SearchResult['L_TRANSACTIONID'].'_Request',$PayPalResult['RAWREQUEST']);
				$PayPal->Logger('GetTransactionDetails_'.$SearchResult['L_TRANSACTIONID'].'_Response',$PayPalResult['RAWRESPONSE']);		
			}	
		}
	
		// Add customer data to database.
		$Customer['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
		$Customer['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
		$Customer['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';
		$Customer['company_name'] = isset($PayPalResult['PAYERBUSINESS']) ? $PayPalResult['PAYERBUSINESS'] : '';
		$Customer['email_address'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
		$Customer['ebay_buyer_id'] = isset($PayPalResult['BUYERID']) ? $PayPalResult['BUYERID'] : '';
		
		// Check to see if this customer already exists in the database.
		$customer_exists = false;
		$sql = "SELECT id FROM customers WHERE paypal_payer_id = '".$db->escape($Customer['paypal_payer_id'])."' AND ebay_buyer_id = '".$db->escape($Customer['ebay_buyer_id'])."'";
		$customer_record = $db->query_first($sql);
		$customer_exists = isset($customer_record['id']) && $customer_record['id'] != '' ? true : false;
		
		if(!$customer_exists)
		{
			$CustomerID = $db->insert('customers',$Customer);		
		}
		else
		{
			$CustomerID = $customer_record['id'];
			$db->update('customers', $Customer, "id='".$db->escape($CustomerID)."'");	
		}	
		
		// Add transaction record to database.
		$Transaction['customer_id'] = isset($CustomerID) ? $CustomerID : '';
		$Transaction['receiver_email'] = isset($PayPalResult['RECEIVEREMAIL']) ? $PayPalResult['RECEIVEREMAIL'] : '';
		$Transaction['receiver_id'] = isset($PayPalResult['RECEIVERID']) ? $PayPalResult['RECEIVERID'] : '';
		$Transaction['payer_status'] = isset($PayPalResult['PAYERSTATUS']) ? $PayPalResult['PAYERSTATUS'] : '';
		$Transaction['ship_to_name'] = isset($PayPalResult['SHIPTONAME']) ? $PayPalResult['SHIPTONAME'] : '';
		$Transaction['ship_to_street'] = isset($PayPalResult['SHIPTOSTREET']) ? $PayPalResult['SHIPTOSTREET'] : '';
		$Transaction['ship_to_street_2'] = isset($PayPalResult['SHIPTOSTREET2']) ? $PayPalResult['SHIPTOSTREET2'] : '';
		$Transaction['ship_to_city'] = isset($PayPalResult['SHIPTOCITY']) ? $PayPalResult['SHIPTOCITY'] : '';
		$Transaction['ship_to_state'] = isset($PayPalResult['SHIPTOSTATE']) ? $PayPalResult['SHIPTOSTATE'] : '';
		$Transaction['ship_to_postal_code'] = isset($PayPalResult['SHIPTOZIP']) ? $PayPalResult['SHIPTOZIP'] : '';
		$Transaction['ship_to_country_code'] = isset($PayPalResult['SHIPTOCOUNTRYCODE']) ? $PayPalResult['SHIPTOCOUNTRYCODE'] : '';
		$Transaction['ship_to_phone_number'] = isset($PayPalResult['SHIPTOPHONENUM']) ? $PayPalResult['SHIPTOPHONENUM'] : '';
		$Transaction['invoice_number'] = isset($PayPalResult['INVNUM']) ? $PayPalResult['INVNUM'] : '';
		$Transaction['sales_tax'] = isset($PayPalResult['TAXAMT']) && $PayPalResult['TAXAMT'] > 0 ? $PayPalResult['TAXAMT'] : 0;
		$Transaction['paypal_timestamp'] = isset($PayPalResult['TIMESTAMP']) ? $PayPalResult['TIMESTAMP'] : '';
		$Transaction['paypal_correlation_id'] = isset($PayPalResult['CORRELATIONID']) ? $PayPalResult['CORRELATIONID'] : '';
		$Transaction['receiver_transaction_id'] = isset($PayPalResult['TRANSACTIONID']) ? $PayPalResult['TRANSACTIONID'] : '';
		$Transaction['sender_transaction_id'] = $SenderTransactionID;
		$Transaction['receipt_id'] = isset($PayPalResult['RECEIPTID']) ? $PayPalResult['RECEIPTID'] : '';
		$Transaction['transaction_type'] = isset($PayPalResult['TRANSACTIONTYPE']) ? $PayPalResult['TRANSACTIONTYPE'] : '';
		$Transaction['payment_type'] = isset($PayPalResult['PAYMENTTYPE']) ? $PayPalResult['PAYMENTTYPE'] : '';
		$Transaction['amount'] = isset($PayPalResult['AMT']) && $PayPalResult['AMT'] > 0 ? $PayPalResult['AMT'] : 0;
		$Transaction['fee_amount'] = isset($PayPalResult['FEEAMT']) && $PayPalResult['FEEAMT'] > 0 ? $PayPalResult['FEEAMT'] : 0;
		$Transaction['insurance_amount'] = isset($PayPalResult['INSURANCEAMOUNT']) && $PayPalResult['INSURANCEAMOUNT'] > 0 ? $PayPalResult['INSURANCEAMOUNT'] : 0;
		$Transaction['shipping_amount'] = isset($PayPalResult['SHIPPINGAMT']) && $PayPalResult['SHIPPINGAMT'] > 0 ? $PayPalResult['SHIPPINGAMT'] : 0;
		$Transaction['handling_amount'] = isset($PayPalResult['HANDLINGAMT']) && $PayPalResult['HANDLINGAMT'] > 0 ? $PayPalResult['HANDLINGAMT'] : 0;
		$Transaction['currency_code'] = isset($PayPalResult['CURRENCYCODE']) ? $PayPalResult['CURRENCYCODE'] : '';
		$Transaction['payment_status'] = isset($PayPalResult['PAYMENTSTATUS']) ? $PayPalResult['PAYMENTSTATUS'] : '';
		
		// Check to see if this transaction already exists in the database.
		$transaction_exists = false;
		$sql = "SELECT id FROM transactions WHERE receiver_transaction_id = '".$db->escape($Transaction['receiver_transaction_id'])."'";
		$transaction_record = $db->query_first($sql);
		$transaction_exists = isset($transaction_record['id']) && $transaction_record['id'] != '' ? true : false;
		
		if(!$transaction_exists)
		{
			$TransactionID = $db->insert('transactions',$Transaction);		
		}
		else
		{
			$TransactionID = $transaction_record['id'];
			$db->update('transactions', $Transaction, "id='".$db->escape($TransactionID)."'");	
		}
		
		foreach($PayPalResult['ORDERITEMS'] as $OrderItem)
		{
			$TransactionItem['transaction_id'] = $TransactionID;
			$TransactionItem['name'] = isset($OrderItem['L_NAME']) ? $OrderItem['L_NAME'] : '';
			$TransactionItem['description'] = isset($OrderItem['L_DESC']) ? $OrderItem['L_DESC'] : '';
			$TransactionItem['item_number'] = isset($OrderItem['L_NUMBER']) ? $OrderItem['L_NUMBER'] : '';
			$TransactionItem['qty'] = isset($OrderItem['L_QTY']) && $OrderItem['L_QTY'] > 0 ? $OrderItem['L_QTY'] : 0;
			$TransactionItem['amount'] = isset($OrderItem['L_AMT']) && $OrderItem['L_AMT'] > 0  ? $OrderItem['L_AMT'] : 0;
			$TransactionItem['tax_amount'] = isset($OrderItem['L_TAXAMT']) && $OrderItem['L_TAXAMT'] > 0 ? $OrderItem['L_TAXAMT'] : 0;
			$TransactionItem['ebay_item_txn_id'] = isset($OrderItem['L_EBAYITEMTXNID']) ? $OrderItem['L_EBAYITEMTXNID'] : '';
			$TransactionItem['ebay_item_order_id'] = isset($OrderItem['L_EBAYITEMORDERID']) ? $OrderItem['L_EBAYITEMORDERID'] : '';
			
			// If the item is from eBay, grab remaining details from eBay's API.
			if($Customer['ebay_buyer_id'] != '')
			{
				// eBay Connection
				require_once('includes/ebay/library/includes/eBay.class.php');
				$eBayConfig = array('Sandbox' => $sandbox, 'AuthToken' => $eBay_auth_token);
				$eBay = new eBay($eBayConfig);
				
				$eBayResult = $eBay->GetItem($OrderItem['L_NUMBER']);
				
				if(strtoupper($eBayResult['Ack']) != 'SUCCESS' && strtoupper($eBayResult['Ack']) != 'SUCCESSWITHWARNING')
				{
					$eBay->Logger('GetItem_'.$OrderItem['L_NUMBER'].'_Request',$eBayResult['RawRequest']);
					$eBay->Logger('GetItem_'.$OrderItem['L_NUMBER'].'_Response',$eBayResult['RawResponse']);		
				}
				else
				{
					if($enable_logging)
					{
						$eBay->Logger('GetItem_'.$OrderItem['L_NUMBER'].'_Request',$eBayResult['RawRequest']);
						$eBay->Logger('GetItem_'.$OrderItem['L_NUMBER'].'_Response',$eBayResult['RawResponse']);		
					}	
				}
				
				$TransactionItem['url'] = isset($eBayResult['ViewItemURL']) ? $eBayResult['ViewItemURL'] : '';
				$TransactionItem['ebay_title'] = isset($eBayResult['Title']) ? $eBayResult['Title'] : '';
				$TransactionItem['ebay_subtitle'] = isset($eBayResult['SubTitle']) ? $eBayResult['SubTitle'] : '';
				$TransactionItem['location'] = isset($eBayResult['Location']) ? $eBayResult['Location'] : '';
				$TransactionItem['condition'] = isset($eBayResult['ConditionDisplayName']) ? $eBayResult['ConditionDisplayName'] : '';
				$TransactionItem['description'] = isset($eBayResult['Description']) ? $eBayResult['Description'] : '';
				$TransactionItem['end_date'] = isset($eBayResult['EndTime']) ? $eBayResult['EndTime'] : '';
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
			}
			
			// Check to see if this transaction_item already exists in the database.
			$transaction_item_exists = false;
			$sql = "SELECT id FROM transaction_items WHERE transaction_id = '".$db->escape($TransactionID)."' AND item_number = '".$db->escape($TransactionItem['item_number'])."'";
			$transaction_item_record = $db->query_first($sql);
			$transaction_item_exists = isset($transaction_item_record['id']) && $transaction_item_record['id'] != '' ? true : false;
			
			if(!$transaction_item_exists)
			{
				$TransactionItemID = $db->insert('transaction_items',$TransactionItem);		
			}
			else
			{
				$TransactionItemID = $transaction_item_record['id'];
				$db->update('transaction_items', $TransactionItem, "id='".$db->escape($TransactionItemID)."'");	
			}
			
			// Save images locally
			if($TransactionItem['external_picture_url'] != '')
			{
				save_image($TransactionItem['external_picture_url'],'images/products/'.$TransactionItemID.'-external_picture_url.jpg');	
			}
			
			if($TransactionItem['gallery_picture_url'] != '')
			{
				save_image($TransactionItem['gallery_picture_url'],'images/products/'.$TransactionItemID.'-gallery_picture_url.jpg');	
			}
			
			if($TransactionItem['picture_url'] != '')
			{
				save_image($TransactionItem['picture_url'],'images/products/'.$TransactionItemID.'-picture_url.jpg');	
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
	$mail->Body = 'get-transactions.php has completed successfully.';
	$mail->AddAddress($admin_email_address, $admin_name);
	$mail->Send();
	$mail->ClearAddresses();	
}
?>