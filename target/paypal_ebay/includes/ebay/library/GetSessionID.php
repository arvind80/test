<?php
// Include required eBay library files.
require_once('includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $dev_id, 'AppID' => $app_id, 'CertID' => $cert_id, 'AuthToken' => $auth_token);
$eBay = new eBay($eBayConfig);

// Load RuName value.  You get this from the Application Settings tab in your eBay Developer Account.
$RuName = 'Angell_EYE-AngellEY-35d4-4-tznyqao';

// Pass request data into library and store result.
$eBayResult = $eBay->GetSessionID($RuName);

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>