<?php
// Include required eBay library files.
require_once('../../../includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $eBay_dev_id, 'AppID' => $eBay_app_id, 'CertID' => $eBay_cert_id, 'AuthToken' => $eBay_auth_token);
$eBay = new eBay($eBayConfig);

// Set param vals
$eBayItemID = '260906364682';

// Pass request data into library and store result.
$eBayResult = $eBay->GetItem($eBayItemID);

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>