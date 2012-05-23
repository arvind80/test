<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'DeveloperAccountEmail' => $developer_account_email, 'ApplicationID' => $application_id, 'DeviceID' => $device_id, 
						'IPAddress' => $device_ip_address, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature, 'APISubject' => $api_subject);
$PayPal = new PayPal_Adaptive($PayPalConfig);

// Prepare request arrays
$CancelPreapprovalFields = array(
								 'PreapprovalKey' => ''										// Required.  Preapproval key that identifies the preapproval to be canceled.
								 );

$PayPalRequestData = array('CancelPreapprovalFields' => $CancelPreapprovalFields);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->CancelPreapproval($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>