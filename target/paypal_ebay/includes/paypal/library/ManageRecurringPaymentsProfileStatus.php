<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $api_username, 'APIPassword' => $api_password, 'APISignature' => $api_signature);
$PayPal = new PayPal($PayPalConfig);

// Prepare request arrays
$MRPPSFields = array(
					'profileid' => '', 				// Required. Recurring payments profile ID returned from CreateRecurring...
					'action' => '', 				// Required. The action to be performed.  Mest be: Cancel, Suspend, Reactivate
					'note' => ''					// The reason for the change in status.  For express checkout the message will be included in email to buyers.  Can also be seen in both accounts in the status history.
					);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->ManageRecurringPaymentsProfileStatus($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>