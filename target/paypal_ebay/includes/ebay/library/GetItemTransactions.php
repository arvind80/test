<?php
// Include required eBay library files.
require_once('../../../includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $eBay_dev_id, 'AppID' => $eBay_app_id, 'CertID' => $eBay_cert_id, 'AuthToken' => $eBay_auth_token);
$eBay = new eBay($eBayConfig);

// Set param vals
$eBayItemID = '290634499639';
$DaysBack = 10;

// Pass request data into library and store result.
$eBayResult = $eBay->GetItemTransactions($eBayItemID, $DaysBack);

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>