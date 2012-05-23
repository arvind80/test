<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature);
$PayPal = new PayPal($PayPalConfig);

// Prepare request arrays
$GBFields = array('returnallcurrencies' => '');
$PayPalRequestData = array('GBFields'=>$GBFields);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->GetBalance($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>