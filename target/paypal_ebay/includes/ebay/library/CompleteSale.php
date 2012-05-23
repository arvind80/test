<?php
// Include required eBay library files.
require_once('includes/config.php');
require_once('includes/eBay.class.php');

// Setup eBay object.
$eBayConfig = array('Sandbox' => $sandbox, 'DevID' => $dev_id, 'AppID' => $app_id, 'CertID' => $cert_id, 'AuthToken' => $auth_token);
$eBay = new eBay($eBayConfig);

// Load request params
// For details on exactly what should go in each request param see:  http://developer.ebay.com/DevZone/XML/docs/Reference/eBay/CompleteSale.html#Request
// You can click on any element on that eBay documentation page to see exactly what should go in that request param.

// For tracking, we could have more than 1 shipment for an auction.  
// Here you'll load all tracking numbers into a single $TrackingNumbers array accordingly, most likely within a loop of some sort.
$TrackingNumbers = array();
$TrackingNumber = array(
					'TrackingNumber' => '123456789', 
					'ShippingCarrierUsed' => 'UPS Ground'
					);
array_push($TrackingNumbers,$TrackingNumber);

$TrackingNumber = array(
					'TrackingNumber' => '987654321', 
					'ShippingCarrierUsed' => 'UPS Ground'
					);
array_push($TrackingNumbers,$TrackingNumber);

$eBayRequestData = array(
						'FeedbackCommentText' => 'Fast payment!  Thanks!', 
						'FeedbackCommentType' => 'Positive', 
						'FeedbackTargetUser' => 'buyer_username', 
						'ItemID' => '110037773021', 
						'OrderID' => '', 
						'OrderLineItemID' => '', 
						'Paid' => 'TRUE', 
						'Shipped' => 'TRUE', 
						'TransactionID' => '', 
						'ShipmentNotes' => 'Shipped!  Woohoo!', 
						'ShippedTime' => '',
						'TrackingNumbers' => $TrackingNumbers	
						);

// Pass request data into library and store result.
$eBayResult = $eBay->CompleteSale($eBayRequestData);

// Dump result to the screen.
echo '<pre />';
print_r($eBayResult);
?>