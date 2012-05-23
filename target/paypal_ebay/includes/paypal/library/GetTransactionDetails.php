<?php
$TransactionID = $_GET['transaction_id'];

// Include required library files.
require_once('/home/harvest/includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $paypal_api_username, 'APIPassword' => $paypal_api_password, 'APISignature' => $paypal_api_signature);
$PayPal = new PayPal($PayPalConfig);

// Prepare request arrays
$GTDFields = array(
					'transactionid' => $TransactionID							// PayPal transaction ID of the order you want to get details for.
				);
				
$PayPalRequestData = array('GTDFields'=>$GTDFields);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->GetTransactionDetails($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>