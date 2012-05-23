<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature);
$PayPal = new PayPal($PayPalConfig);

// Prepare request arrays
$RTFields = array(
					'transactionid' => '', 							// Required.  PayPal transaction ID for the order you're refunding.
					'invoiceid' => '', 								// Your own invoice tracking number.
					'refundtype' => '', 							// Required.  Type of refund.  Must be Full, Partial, or Other.
					'amt' => '', 									// Refund Amt.  Required if refund type is Partial.  
					'currencycode' => '', 							// Three-letter currency code.  Required for Partial Refunds.  Do not use for full refunds.
					'note' => '' 									// Custom memo about the refund.  255 char max.
				);
				
$PayPalRequestData = array('RTFields'=>$RTFields);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->RefundTransaction($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>