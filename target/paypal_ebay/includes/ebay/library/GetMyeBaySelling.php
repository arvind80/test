<?php
// Include required eBay library files.
require_once('includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $dev_id, 'AppID' => $app_id, 'CertID' => $cert_id, 'AuthToken' => $auth_token);
$eBay = new eBay($eBayConfig);

// Each list you include in the array here will be returned in the eBay response.
$Lists = array(
			'ActiveList', 
			//'BidList', 
			//'DeletedFromSoldList', 
			//'DeletedFromUnsoldList', 
			//'ScheduledList', 
			'SoldList', 
			'UnsoldList'
			);

// Pass request data into library and store result.
$eBayResult = $eBay->GetMyeBaySelling($Lists);

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>