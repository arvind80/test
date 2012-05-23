<?php
// Include required eBay library files.
require_once('includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $dev_id, 'AppID' => $app_id, 'CertID' => $cert_id, 'AuthToken' => $auth_token);
$eBay = new eBay($eBayConfig);

// I've got a static session ID here, but you'll typically have just received this back from GetSessionID in a previous call.
$SessionID = '47sAAA**b53863471330a471d213d553ffffff23';

// Pass request data into library and store result.
$eBayResult = $eBay->FetchToken($SessionID);

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>