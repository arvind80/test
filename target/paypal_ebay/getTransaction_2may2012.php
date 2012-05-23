<?php ob_start();
   include('includes/confignew.php');
if(!empty($_POST['startdate']) and  !empty($_POST['enddate']) ){

// Config 
if($_SERVER['REMOTE_ADDR'] == '72.135.106.15')
{
error_reporting(E_ALL);
ini_set('display_errors',1);		
}
   
    $startdate=str_replace(" ","\T",$_POST['startdate']);
    $enddate=str_replace(" ","\T",$_POST['enddate']);
    $StartDate = gmdate($startdate.'\Z');
    $EndDate = gmdate($enddate.'\Z');
    
   
  
function getrecordspaypal($StartDate,$EndDate){
   $sandbox = false;
   $domain = $sandbox ? 'http://local.dustinjones.com/' : 'http://184.154.158.150/';
   $enable_logging = true;
   $minutes_back = 8;
   
   $paypal_api_version = '74.0';
   $paypal_application_id = $sandbox ? 'APP-80W284485P519543T' : '';
   $paypal_developer_account_email = '';
   $paypal_api_username = $sandbox ? '' : 'harvestcellular2_api1.gmail.com';
   $paypal_api_password = $sandbox ? '' : '5FKXEUUFYUQ9BLZ6';
   $paypal_api_signature = $sandbox ? '' : 'AVpBTZU4.Ex4UDmfv.sZtZtZldsrAIf7m7x6XfsPLrT8CAAt5Rm42nC3';
   
   $eBay_auth_token = $sandbox ? "" : "AgAAAA**AQAAAA**aAAAAA**Y1nMTg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wNmISnCpiDqQidj6x9nY+seQ**YzEBAA**AAMAAA**4EK4RAuFm8yC/3ry5OjO+Sol8l+riQm04VAkOocEhBB4nC71yuUawtpqgMCWF3K3H+RrZhXzG4m/HKhkAw2U/5f5oo0nprso5cxFiqU0sF2kS4dxZj/HuoblVEzOXGploSwgsjqFB4YL++Pz9oU9s/VSEHO4h+IUF0/x4C7cjnmG3GKO/6puCZ9SSwlmxMJeZXibbrvzgWLXT2UY7zdzm2n2bQp7VYUh8OwhAZuW946yNWGKGq8lN6gRBetWW296TJp4ut0UsA313p+0odNICKf4tOPyBN65ZvU3DothWbvn4EvweaJnbYBocedFbO9UFvokgOuSKnbnY7XiDj/jadf1hNyJwOIuTdzmdMF4Znn3AlB808m2ljprpu5Z3lM52bfwVqHPJcNr9tArxYpcEiR6iZ1nmIPaly9c451nWoY0+b6btxV2q9ayuUnSF4vRxrgcuhpLVfFYIgrJGXpOFF5VghyYtaX1UL/+W+AcejyW/GpzluHEOturifcBag0emVumKPj1FPE4VXYc7cjt9xc+3n9t6nTYFSJA7q1xBBuoQ8m4EyWelRjZw8Ly6gpNR5LtvAJxPi6JIwxXeQlQ1stR+ADIp+9VzyxETw2pWlF2zgz56YtCD9oI/gbvUkQKVBZkKBaiOMBcrQRsIMwIK8tRATXOaE9Mokh/17iD8c7JOQILMwg0D0eU+RTZ48aiA70d7ZfJSpyiNejMtPhuBr3v2oA0abSdOssxqaW74yKOk6amxpHnsW7CcW1lOHUj";
   
   $send_email_notification = false;
   $admin_email_address = 'harvestcellular2@gmail.com'; 							
   $admin_name = 'Harvest Cellular';
   $email_from_address = 'noreply@gmail.com';
   $email_from_name = 'Harvest Cellular';
   $smtp_host = 'smtp.gmail.com';
   $smtp_username = 'harvestcellular2@gmail.com';
   $smtp_password = 'Harvest$$2011';
        
   $PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $paypal_api_username, 'APIPassword' => $paypal_api_password, 'APISignature' => $paypal_api_signature);
   $PayPal = new PayPal($PayPalConfig);
        
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
		//$mail -> Send();
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
	 
        return $PayPalResult; 
    }
    
      $startdatestrtotime=strtotime($StartDate);
      $enddatestrtotime=strtotime($EndDate);
      $i=1;
  /* while loop for getting more than 100 records from paypal */    
     while($enddatestrtotime!=$startdatestrtotime){
        
       if($enddatestrtotime > $startdatestrtotime){
           $PayPalResult=getrecordspaypal($StartDate,$EndDate);
          if(count($PayPalResult['SEARCHRESULTS'])>=100){
		  $PayPalResultfinal[]= $PayPalResult;
		$lastvalue = array_pop($PayPalResult['SEARCHRESULTS']);
                 $enddatestrtotime=strtotime($lastvalue['L_TIMESTAMP']);
                 $nedate[]= date("Y-m-d", $enddatestrtotime);
                $EndDate=$lastvalue['L_TIMESTAMP'];
	    }else{
		
		 $PayPalResultfinal[]= $PayPalResult;
		   break ;
	     }
          
         }else{
		
             break ;
          }
            
    
	    
        $i++;    
    }
     /* end og while loop for getting 100 records from php */
   /* global variable */
   
   
     
     /* end of global variables */
     
     foreach($PayPalResultfinal as $keysearch=>$valuesearch){
        
        
         if(is_array($valuesearch['SEARCHRESULTS'])){
               foreach($valuesearch['SEARCHRESULTS'] as $SearchResult)
               {
                   $SenderTransactionID = isset($SearchResult['L_TRANSACTIONID']) ? $SearchResult['L_TRANSACTIONID'] : '';
                    if(strtoupper($SearchResult['L_TYPE']) == 'TRANSFER' || strtoupper($SearchResult['L_STATUS']) == 'UNCLAIMED')
                       {
                               $Transfer['L_TIMESTAMP'] = isset($SearchResult['L_TIMESTAMP']) ? $SearchResult['L_TIMESTAMP'] : '';
                               $Transfer['L_TIMEZONE'] = isset($SearchResult['L_TIMEZONE']) ? $SearchResult['L_TIMEZONE'] : '';
                               $Transfer['L_TYPE'] = isset($SearchResult['L_TYPE']) ? $SearchResult['L_TYPE'] : '';
                               $Transfer['L_EMAIL'] = isset($SearchResult['L_TYPE']) ? $SearchResult['L_EMAIL'] : '';
                               $Transfer['L_NAME'] = isset($SearchResult['L_NAME']) ? $SearchResult['L_NAME'] : '';
                               $Transfer['L_TRANSACTIONID'] = isset($SearchResult['L_TRANSACTIONID']) ? $SearchResult['L_TRANSACTIONID'] : '';
                               $Transfer['L_STATUS'] = isset($SearchResult['L_STATUS']) ? $SearchResult['L_STATUS'] : '';
                       
                               $Transfer['L_AMT'] = isset($SearchResult['L_AMT']) ? $SearchResult['L_AMT'] : '';
                               $Transfer['L_FEEAMT'] = isset($SearchResult['L_FEEAMT']) ? $SearchResult['L_FEEAMT'] : '';
                               $Transfer['L_NETAMT'] = isset($SearchResult['L_NETAMT']) ? $SearchResult['L_NETAMT'] : '';
                               
                               // Check to see if this transfer already exists in the database.
                               $transfer_exists = false;
                               $sql = "SELECT id FROM transactions WHERE L_TRANSACTIONID = '".$Transfer['L_TRANSACTIONID']."'";
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
                                       
                       }else{
                               
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
                               
                               /* add data in the customer table */
                               
                               // Add customer data to database.
                               $Customer['PAYERID'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
                               $Customer['FIRSTNAME'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
                               $Customer['LASTNAME'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';
                               $Customer['EMAIL'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
                               $Customer['BUYERID'] = isset($PayPalResult['BUYERID']) ? $PayPalResult['BUYERID'] : '';
                               $Customer['TIMESTAMP'] = isset($PayPalResult['TIMESTAMP']) ? $PayPalResult['TIMESTAMP'] : '';
               
                               // Check to see if this customer already exists in the database.
                                       $customer_exists = false;
                                       $sql = "SELECT id FROM customers WHERE PAYERID = '".$db->escape($Customer['PAYERID'])."' AND BUYERID = '".$db->escape($Customer['BUYERID'])."'";
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
                                                       
                             /* Inserting data into the transaction deatils */		
                       
                               // Add transaction record to database.
                               $Transaction['customer_id'] = isset($CustomerID) ? $CustomerID : '';
                               
                               $Transaction['RECEIVERBUSINESS'] = isset($PayPalResult['RECEIVERBUSINESS']) ? $PayPalResult['RECEIVERBUSINESS'] : '';
                               $Transaction['RECEIVEREMAIL'] = isset($PayPalResult['RECEIVEREMAIL']) ? $PayPalResult['RECEIVEREMAIL'] : '';
                               $Transaction['RECEIVERID'] = isset($PayPalResult['RECEIVERID']) ? $PayPalResult['RECEIVERID'] : '';
                               $Transaction['PAYERSTATUS'] = isset($PayPalResult['PAYERSTATUS']) ? $PayPalResult['PAYERSTATUS'] : '';
                               $Transaction['CURRENCYCODE'] = isset($PayPalResult['CURRENCYCODE']) ? $PayPalResult['CURRENCYCODE'] : '';
                               $Transaction['SHIPTONAME'] = isset($PayPalResult['SHIPTONAME']) ? $PayPalResult['SHIPTONAME'] : '';
                               $Transaction['SHIPTOSTREET'] = isset($PayPalResult['SHIPTOSTREET']) ? $PayPalResult['SHIPTOSTREET'] : '';
                               $Transaction['SHIPTOSTREET2'] = isset($PayPalResult['SHIPTOSTREET2']) ? $PayPalResult['SHIPTOSTREET2'] : '';
                               $Transaction['SHIPTOCITY'] = isset($PayPalResult['SHIPTOCITY']) ? $PayPalResult['SHIPTOCITY'] : '';
                               $Transaction['SHIPTOSTATE'] = isset($PayPalResult['SHIPTOSTATE']) ? $PayPalResult['SHIPTOSTATE'] : '';
                               $Transaction['SHIPTOZIP'] = isset($PayPalResult['SHIPTOZIP']) ? $PayPalResult['SHIPTOZIP'] : '';
                               $Transaction['SHIPTOCOUNTRYCODE'] = isset($PayPalResult['SHIPTOCOUNTRYCODE']) ? $PayPalResult['SHIPTOCOUNTRYCODE'] : '';
                               $Transaction['SHIPTOPHONENUM'] = isset($PayPalResult['SHIPTOPHONENUM']) ? $PayPalResult['SHIPTOPHONENUM'] : '';
                               $Transaction['ADDRESSOWNER'] = isset($PayPalResult['ADDRESSOWNER']) ? $PayPalResult['ADDRESSOWNER'] : '';
                               $Transaction['ADDRESSSTATUS'] = isset($PayPalResult['ADDRESSSTATUS']) ? $PayPalResult['ADDRESSSTATUS'] : '';
                               $Transaction['TIMESTAMP'] = isset($PayPalResult['TIMESTAMP']) ? $PayPalResult['TIMESTAMP'] : '';
                               $Transaction['CORRELATIONID'] = isset($PayPalResult['CORRELATIONID']) ? $PayPalResult['CORRELATIONID'] : '';
                               $Transaction['INVNUM'] = isset($PayPalResult['INVNUM']) ? $PayPalResult['INVNUM'] : '';
                               $Transaction['TAXAMT'] = isset($PayPalResult['TAXAMT']) && $PayPalResult['TAXAMT'] > 0 ? $PayPalResult['TAXAMT'] : 0;
                               $Transaction['TIMESTAMP'] = isset($PayPalResult['TIMESTAMP']) ? $PayPalResult['TIMESTAMP'] : '';
                               $Transaction['ACK'] = isset($PayPalResult['ACK']) ? $PayPalResult['ACK'] : '';
                               $Transaction['VERSION'] = isset($PayPalResult['VERSION']) ? $PayPalResult['VERSION'] : '';
                               $Transaction['BUILD'] = isset($PayPalResult['BUILD']) ? $PayPalResult['BUILD'] : '';
                               $Transaction['TRANSACTIONID'] = isset($PayPalResult['TRANSACTIONID']) ? $PayPalResult['TRANSACTIONID'] : '';
                               $Transaction['TRANSACTIONTYPE'] = isset($PayPalResult['TRANSACTIONTYPE']) ? $PayPalResult['TRANSACTIONTYPE'] : '';
                               $Transaction['PAYMENTTYPE'] = isset($PayPalResult['PAYMENTTYPE']) ? $PayPalResult['PAYMENTTYPE'] : '';
                               $Transaction['ORDERTIME'] = isset($PayPalResult['ORDERTIME']) ? $PayPalResult['ORDERTIME'] : '';
                               $Transaction['AMT'] = isset($PayPalResult['AMT']) && $PayPalResult['AMT'] > 0 ? $PayPalResult['AMT'] : 0;
                               $Transaction['FEEAMT'] = isset($PayPalResult['FEEAMT']) && $PayPalResult['FEEAMT'] > 0 ? $PayPalResult['FEEAMT'] : 0;
                               $Transaction['CURRENCYCODE'] = isset($PayPalResult['CURRENCYCODE']) ? $PayPalResult['CURRENCYCODE'] : '';
                               $Transaction['PAYMENTSTATUS'] = isset($PayPalResult['PAYMENTSTATUS']) ? $PayPalResult['PAYMENTSTATUS'] : '';
                               $Transaction['PENDINGREASON'] = isset($PayPalResult['PENDINGREASON']) ? $PayPalResult['PENDINGREASON'] : '';
                               $Transaction['REASONCODE'] = isset($PayPalResult['REASONCODE']) ? $PayPalResult['REASONCODE'] : '';
                               $Transaction['PROTECTIONELIGIBILITY'] = isset($PayPalResult['PROTECTIONELIGIBILITY']) ? $PayPalResult['PROTECTIONELIGIBILITY'] : '';
                               $Transaction['PROTECTIONELIGIBILITYTYPE'] = isset($PayPalResult['PROTECTIONELIGIBILITYTYPE']) ? $PayPalResult['PROTECTIONELIGIBILITYTYPE'] : '';
                               $Transaction['L_CURRENCYCODE0'] = isset($PayPalResult['L_CURRENCYCODE0']) ? $PayPalResult['L_CURRENCYCODE0'] : '';  
                               $Transaction['EMAIL'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
                               $Transaction['PAYERID'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
                               $Transaction['PAYERBUSINESS'] = isset($PayPalResult['PAYERBUSINESS']) ? $PayPalResult['PAYERBUSINESS'] : '';
                               $Transaction['SALUTATION'] = isset($PayPalResult['SALUTATION']) ? $PayPalResult['SALUTATION'] : '';
                               $Transaction['PARENTTRANSACTIONID'] = isset($PayPalResult['PARENTTRANSACTIONID']) ? $PayPalResult['PARENTTRANSACTIONID'] : '';
                               $Transaction['RECEIPTID'] = isset($PayPalResult['RECEIPTID']) ? $PayPalResult['RECEIPTID'] : '';
                               $Transaction['SETTLEAMT'] = isset($PayPalResult['SETTLEAMT']) ? $PayPalResult['SETTLEAMT'] : '0';
                               $Transaction['TAXAMT'] = isset($PayPalResult['TAXAMT']) ? $PayPalResult['TAXAMT'] : '0';
                               $Transaction['EXCHANGERATE'] = isset($PayPalResult['EXCHANGERATE']) ? $PayPalResult['EXCHANGERATE'] : '0';
                               $Transaction['INVNUM'] = isset($PayPalResult['INVNUM']) ? $PayPalResult['INVNUM'] : '';
                               $Transaction['CUSTOM'] = isset($PayPalResult['CUSTOM']) ? $PayPalResult['CUSTOM'] : '';
                               $Transaction['NOTE'] = isset($PayPalResult['NOTE']) ? $PayPalResult['NOTE'] : '';
                               $Transaction['SALESTAX'] = isset($PayPalResult['SALESTAX']) ? $PayPalResult['SALESTAX'] : '';
                               $Transaction['BUYERID'] = isset($PayPalResult['BUYERID']) ? $PayPalResult['BUYERID'] : '';
                               $Transaction['CLOSINGDATE'] = isset($PayPalResult['CLOSINGDATE']) ? $PayPalResult['CLOSINGDATE'] : '';
                               $Transaction['MULTIITEM'] = isset($PayPalResult['MULTIITEM']) ? $PayPalResult['MULTIITEM'] : '';
                               $Transaction['PERIOD'] = isset($PayPalResult['PERIOD']) ? $PayPalResult['PERIOD'] : '';
                               $Transaction['L_TRANSACTIONID'] = $SenderTransactionID;
                               $Transaction['INSURANCEAMOUNT'] = isset($PayPalResult['INSURANCEAMOUNT']) && $PayPalResult['INSURANCEAMOUNT'] > 0 ? $PayPalResult['INSURANCEAMOUNT'] : 0;
                               $Transaction['SHIPPINGAMT'] = isset($PayPalResult['SHIPPINGAMT']) && $PayPalResult['SHIPPINGAMT'] > 0 ? $PayPalResult['SHIPPINGAMT'] : 0;
                               $Transaction['HANDLINGAMT'] = isset($PayPalResult['HANDLINGAMT']) && $PayPalResult['HANDLINGAMT'] > 0 ? $PayPalResult['HANDLINGAMT'] : 0;
                               // Check to see if this transaction already exists in the database.
                               $transaction_exists = false;
                               $sql = "SELECT id FROM transactions WHERE TRANSACTIONID = '".$db->escape($Transaction['TRANSACTIONID'])."'";
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
                                       $TransactionItem['trans_id'] = $TransactionID;
                                       $TransactionItem['L_NAME'] = isset($OrderItem['L_NAME']) ? $OrderItem['L_NAME'] : '';
                                       $TransactionItem['L_DESC'] = isset($OrderItem['L_DESC']) ? $OrderItem['L_DESC'] : '';
                                       $TransactionItem['L_NUMBER'] = isset($OrderItem['L_NUMBER']) ? $OrderItem['L_NUMBER'] : '';
                                       $TransactionItem['L_QTY'] = isset($OrderItem['L_QTY']) && $OrderItem['L_QTY'] > 0 ? $OrderItem['L_QTY'] : 0;
                                       $TransactionItem['L_AMT'] = isset($OrderItem['L_AMT']) && $OrderItem['L_AMT'] > 0  ? $OrderItem['L_AMT'] : 0;
                                       $TransactionItem['L_ITEMWEIGHTVALUE'] = isset($OrderItem['L_ITEMWEIGHTVALUE']) ? $OrderItem['L_ITEMWEIGHTVALUE'] : '';
                                       $TransactionItem['L_ITEMWEIGHTUNIT'] = isset($OrderItem['L_ITEMWEIGHTUNIT']) ? $OrderItem['L_ITEMWEIGHTUNIT'] : '';
                                       $TransactionItem['L_ITEMWIDTHVALUE'] = isset($OrderItem['L_ITEMWIDTHVALUE']) ? $OrderItem['L_ITEMWIDTHVALUE'] : '';
                                       $TransactionItem['L_ITEMWIDTHUNIT'] = isset($OrderItem['L_ITEMWIDTHUNIT']) ? $OrderItem['L_ITEMWIDTHUNIT'] : '';
                                       $TransactionItem['L_ITEMLENGTHVALUE'] = isset($OrderItem['L_ITEMLENGTHVALUE']) ? $OrderItem['L_ITEMLENGTHVALUE'] : '';
                                       $TransactionItem['L_ITEMLENGTHUNIT'] = isset($OrderItem['L_ITEMLENGTHUNIT']) ? $OrderItem['L_ITEMLENGTHUNIT'] : '';
                                       $TransactionItem['L_ITEMLENGTHVALUE'] = isset($OrderItem['L_ITEMLENGTHVALUE']) ? $OrderItem['L_ITEMLENGTHVALUE'] : '';
                                       $TransactionItem['L_ITEMLENGTHUNIT'] = isset($OrderItem['L_ITEMLENGTHUNIT']) ? $OrderItem['L_ITEMLENGTHUNIT'] : '';
                                       $TransactionItem['L_TAXAMT'] = isset($OrderItem['L_TAXAMT']) && $OrderItem['L_TAXAMT'] > 0 ? $OrderItem['L_TAXAMT'] : 0;
                                       $TransactionItem['ebay_item_txn_id'] = isset($OrderItem['L_EBAYITEMTXNID']) ? $OrderItem['L_EBAYITEMTXNID'] : '';
                                       $TransactionItem['ebay_item_order_id'] = isset($OrderItem['L_EBAYITEMORDERID']) ? $OrderItem['L_EBAYITEMORDERID'] : '';
                                      // If the item is from eBay, grab remaining details from eBay's API.
                                  if($Customer['BUYERID'] != '')
                                 {
                                       // eBay Connection
                                       require_once('includes/ebay/library/includes/eBay.class.php');
                                       $eBayConfig = array('Sandbox' => $sandbox, 'AuthToken' => $eBay_auth_token);
                                       $eBay = new eBay($eBayConfig);
                                       
                                       $eBayResult = $eBay->GetItem($OrderItem['L_NUMBER']);
                                       
                                       //print_R($eBayResult);
               
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
               
                               $TransactionItem['ViewItemURL'] = isset($eBayResult['ViewItemURL']) ? $eBayResult['ViewItemURL'] : '';
                               $TransactionItem['Title'] = isset($eBayResult['Title']) ? $eBayResult['Title'] : '';
                               $TransactionItem['SubTitle'] = isset($eBayResult['SubTitle']) ? $eBayResult['SubTitle'] : '';
                               $TransactionItem['Location'] = isset($eBayResult['Location']) ? $eBayResult['Location'] : '';
                               $TransactionItem['ConditionDisplayName'] = isset($eBayResult['ConditionDisplayName']) ? $eBayResult['ConditionDisplayName'] : '';
                               $TransactionItem['Description'] = isset($eBayResult['Description']) ? $eBayResult['Description'] : '';
                               $TransactionItem['EndTime'] = isset($eBayResult['EndTime']) ? $eBayResult['EndTime'] : '';
                               $TransactionItem['ExternalPictureURL'] = isset($eBayResult['ExternalPictureURL']) ? $eBayResult['ExternalPictureURL'] : '';
                               $TransactionItem['GalleryURL'] = isset($eBayResult['GalleryURL']) ? $eBayResult['GalleryURL'] : '';
                               $TransactionItem['PictureURL'] = isset($eBayResult['PictureURL']) ? $eBayResult['PictureURL'] : '';
                               $TransactionItem['ReturnPolicyDescription'] = isset($eBayResult['ReturnPolicyDescription']) ? $eBayResult['ReturnPolicyDescription'] : '';
                               $TransactionItem['Refund'] = isset($eBayResult['Refund']) ? $eBayResult['Refund'] : '';
                               $TransactionItem['RefundOption'] = isset($eBayResult['RefundOption']) ? $eBayResult['RefundOption'] : '';
                               $TransactionItem['ReturnsAccepted'] = isset($eBayResult['ReturnsAccepted']) ? $eBayResult['ReturnsAccepted'] : '';
                               $TransactionItem['ReturnsAcceptedOption'] = isset($eBayResult['ReturnsAcceptedOption']) ? $eBayResult['ReturnsAcceptedOption'] : '';
                               $TransactionItem['ReturnsWithin'] = isset($eBayResult['ReturnsWithin']) ? $eBayResult['ReturnsWithin'] : '';
                               $TransactionItem['ReturnsWithinOption'] = isset($eBayResult['ReturnsWithinOption']) ? $eBayResult['ReturnsWithinOption'] : '';
                               $TransactionItem['ShippingCostPaidBy'] = isset($eBayResult['ShippingCostPaidBy']) ? $eBayResult['ShippingCostPaidBy'] : '';
                               $TransactionItem['ShippingCostPaidByOption'] = isset($eBayResult['ShippingCostPaidByOption']) ? $eBayResult['ShippingCostPaidByOption'] : '';
                               $TransactionItem['WarrantyDuration'] = isset($eBayResult['WarrantyDuration']) ? $eBayResult['WarrantyDuration'] : '';
                               $TransactionItem['WarrantyDurationOption'] = isset($eBayResult['WarrantyDurationOption']) ? $eBayResult['WarrantyDurationOption'] : '';
                               $TransactionItem['WarrantyOffered'] = isset($eBayResult['WarrantyOffered']) ? $eBayResult['WarrantyOffered'] : '';
                               $TransactionItem['WarrantyOfferedOption'] = isset($eBayResult['WarrantyOfferedOption']) ? $eBayResult['WarrantyOfferedOption'] : '';
                               $TransactionItem['WarrantyType'] = isset($eBayResult['WarrantyType']) ? $eBayResult['WarrantyType'] : '';
                               $TransactionItem['WarrantyTypeOption'] = isset($eBayResult['WarrantyTypeOption']) ? $eBayResult['WarrantyTypeOption'] : '';				
                         
                         
                         
                         
                         }
                          // Check to see if this transaction_item already exists in the database.
                             $transaction_item_exists = false;
                             $sql = "SELECT id FROM transaction_items WHERE trans_id = '".$db->escape($TransactionID)."' AND L_NUMBER = '".$db->escape($TransactionItem['L_NUMBER'])."'";
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
                               save_image($TransactionItem['external_picture_url'],'/home/harvest/public_html/images/'.$TransactionItemID.'-external_picture_url.jpg');	
                               }
                               
                               if($TransactionItem['gallery_picture_url'] != '')
                               {
                               save_image($TransactionItem['gallery_picture_url'],'/home/harvest/public_html/images/'.$TransactionItemID.'-gallery_picture_url.jpg');	
                               }
                               
                               if($TransactionItem['picture_url'] != '')
                               {
                               save_image($TransactionItem['picture_url'],'/home/harvest/public_html/images/'.$TransactionItemID.'-picture_url.jpg');	
                               } 
                               
                          }		
                               
                   }
               
               }

        }
      
        
       
     }
     
     header('location:getDetails.php?msg=succ');



// Close database connection.
$db->close();
//header("location:getDetails.php?msg=succ");
if($send_email_notification)
{
$mail->Subject  =  'Transactions Synced Successfully - '.$StartDate;
$mail->Body = 'getTransactions.php has completed successfully.';
//$mail->AddAddress($admin_email_address, $admin_name);
//$mail->Send();
$mail->ClearAddresses();	
}
}else {

echo "Please enter the start date and end date ";
}
// Send notification email to administrator.

?>