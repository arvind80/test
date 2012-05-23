<?php
// Include required eBay library files.
require_once('includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $dev_id, 'AppID' => $app_id, 'CertID' => $cert_id, 'AuthToken' => $auth_token);
$eBay = new eBay($eBayConfig);

// Pass request data into library and store result.
$eBayResult = $eBay->GeteBayOfficialTime();

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>