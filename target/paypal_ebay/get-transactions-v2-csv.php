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
$data = get2DArrayFromCsv('temp/download.csv',',');

// Loop through all transactions and call GetTransactionDetails for each.
foreach($data as $SearchResult)
{		
	set_time_limit(60);
	
	/*  Dump of data columns and array location
	Array
	(
		[0] => Date
		[1] => Time
		[2] => Time Zone
		[3] => Name
		[4] => Type
		[5] => Status
		[6] => Subject
		[7] => Currency
		[8] => Gross
		[9] => Fee
		[10] => Net
		[11] => Note
		[12] => From Email Address
		[13] => To Email Address
		[14] => Transaction ID
		[15] => Payment Type
		[16] => Counterparty Status
		[17] => Shipping Address
		[18] => Address Status
		[19] => Item Title
		[20] => Item ID
		[21] => Shipping and Handling Amount
		[22] => Insurance Amount
		[23] => Sales Tax
		[24] => Option 1 Name
		[25] => Option 1 Value
		[26] => Option 2 Name
		[27] => Option 2 Value
		[28] => Auction Site
		[29] => Buyer ID
		[30] => Item URL
		[31] => Closing Date
		[32] => Reference Txn ID
		[33] => Invoice Number
		[34] => Subscription Number
		[35] => Custom Number
		[36] => Quantity
		[37] => Receipt ID
		[38] => Balance
		[39] => Address Line 1
		[40] => Address Line 2/District/Neighborhood
		[41] => Town/City
		[42] => State/Province/Region/County/Territory/Prefecture/Republic
		[43] => Zip/Postal Code
		[44] => Country
		[45] => Contact Phone Number
		[46] => Balance Impact
		[47] => 
	)
	*/
	
	// Setup TransactionSearch table data
	$TransactionSearch = array();	
	$TransactionSearchTimestamp = strtotime($SearchResult[0].' '.$SearchResult[1]);
	$new_timestamp = gmdate('Y-m-d H:i:s',$TransactionSearchTimestamp);
	$TransactionSearch['l_timestamp'] = $new_timestamp;
	$TransactionSearch['l_timezone'] = $SearchResult[2];
	$TransactionSearch['l_type'] = $SearchResult[4];
	$TransactionSearch['l_transactionid'] = $SearchResult[32] != '' ? $SearchResult[32] : $SearchResult[14]; // If a reference transaction ID is available, use that instead of the regular transaction ID.
	$TransactionSearch['l_amt'] = $SearchResult[8];
	$TransactionSearch['l_feeamt'] = $SearchResult[9];
	$TransactionSearch['l_netamt'] = $SearchResult[10];
	$TransactionSearch['l_status'] = $SearchResult[5];
	$TransactionSearch['l_email'] = $SearchResult[13];
		
	if(strtoupper($TransactionSearch['l_timezone']) != 'TIME ZONE')
	{
		// Check to see if this transaction already exists in the database and update/add accordingly
		$transfer_exists = false;
		$sql = "SELECT id FROM transaction_search WHERE l_transactionid = '".$TransactionSearch['l_transactionid']."' AND l_type = '".$TransactionSearch['l_type']."'";
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
		
		/*
			Here I'm attempting to weed out unnecessary calls to PayPal when I know I'm just going to get an invalid type response.
			In some cases, though, even though the current record type would be bad, if it has a reference transaction ID that one could be 
			good and need updated.  I can't tell if the reference transaction ID (type) will be valid or not, though, so I'll probably 
			get some failed API calls on GetTransactionDetails that I can't avoid. 
		*/
		if(strtoupper($TransactionSearch['l_type']) != 'REQUEST SENT'		 
		&& strtoupper($TransactionSearch['l_type']) != 'SHOPPING CART ITEM' 
		&& strtoupper($TransactionSearch['l_type']) != 'CANCELLED FEE'  
		&& strtoupper($TransactionSearch['l_type']) != 'CANCELLED TRANSFER' 
		&& strtoupper($TransactionSearch['l_type']) != 'CASH BACK BONUS' 
		&& strtoupper($TransactionSearch['l_type']) != 'CHARGE FROM CREDIT CARD' 
		&& strtoupper($TransactionSearch['l_type']) != 'CREDIT TO CREDIT CARD' 
		&& strtoupper($TransactionSearch['l_type']) != 'DEBIT CARD PURCHASE' 
		&& strtoupper($TransactionSearch['l_type']) != 'DENIED PAYMENT' 
		&& strtoupper($TransactionSearch['l_type']) != 'ADD FUNDS FROM A BANK ACCOUNT' 
		&& strtoupper($TransactionSearch['l_type']) != 'RECOVER NEGATIVE BALANCE FROM CREDIT CARD'
		&& strtoupper($TransactionSearch['l_type']) != 'TEMPORARY HOLD' 
		&& strtoupper($TransactionSearch['l_type']) != 'UPDATE TO ADD FUNDS FROM A BANK' 
		&& strtoupper($TransactionSearch['l_type']) != 'UPDATE TO ECHECK RECEIVED' 
		&& strtoupper($TransactionSearch['l_type']) != 'UPDATE TO ECHECK SENT' 
		&& strtoupper($TransactionSearch['l_type']) != 'UPDATE TO REVERSAL' 
		&& strtoupper($TransactionSearch['l_type']) != 'VOUCHER' 
		&& strtoupper($TransactionSearch['l_type']) != 'VOUCHER REFUND' 
		&& strtoupper($TransactionSearch['l_status']) != 'RETURNED' 
		|| strtoupper($SearchResult[32]) != '')
		{
			// Call GetTransactionDetails for the current transaction in the loop.
			$GTDFields = array('transactionid' => $TransactionSearch['l_transactionid']);		
			$PayPalRequestData = array('GTDFields'=>$GTDFields);
			$PayPalResult = $PayPal->GetTransactionDetails($PayPalRequestData);	
			
			if(!$PayPal->APICallSuccessful($PayPalResult['ACK']))
			{
				$api_log['source'] = 'PayPal';
				$api_log['api_name'] = 'GetTransactionDetails';
				$api_log['ack'] = $PayPalResult['ACK'];
				$api_log['transaction_id'] = $TransactionSearch['l_transactionid'];
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
					$api_log['transaction_id'] = $TransactionSearch['l_transactionid'];
					$api_log['raw_request'] = $PayPalResult['RAWREQUEST'];
					$api_log['raw_response'] = $PayPalResult['RAWRESPONSE'];
					$api_log['serialized_result'] = serialize($PayPalResult);
					$gtd_api_log_id = $db->insert('api_logs',$api_log);		
				}	
			}
			
			// Add customer data to database.
			$Customer = array();
			$Customer['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
			$Customer['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
			$Customer['middle_name'] = isset($PayPalResult['MIDDLENAME']) ? $PayPalResult['MIDDLENAME'] : '';
			$Customer['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';
			$Customer['suffix'] = isset($PayPalResult['SUFFIX']) ? $PayPalResult['SUFFIX'] : '';
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
			
			// Update transaction_search table to include our customer ID.
			$sql = "UPDATE transaction_search SET customer_id = ".$CustomerID." WHERE id = ".$TransactionSearchID;
			$db->query($sql);
			
			// Add get_transaction_details record to database.
			$Transaction = array();
			$Transaction['api_log_id'] = $gtd_api_log_id;
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
		
		echo 'Transaction ID '.$TransactionSearch['l_transactionid'].' completed.<br />';
	}	
}

// Close database connection.
$db->close();

// Send notification email to administrator.
if($send_email_notification)
{
	$mail->Subject  =  'Transactions Synced Successfully from CSV Download';
	$mail->Body = 'get-transactions-v2-csv.php has completed successfully.';
	//$mail->AddAddress($admin_email_address, $admin_name);
	$mail->AddAddress('andrew@angelleye.com','Andrew Angell');
	$mail->Send();
	$mail->ClearAddresses();	
}