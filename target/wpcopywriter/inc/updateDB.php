<?php 
require_once('../../../../wp-load.php');
global $wpdb;
$action 				= ($_POST['action']); 
$updateRecordsArray 	= $_POST['recordsArray'];

if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE wp_records SET recordListingID = " . $listingCounter . " WHERE recordID = " . $recordIDValue;
		$myrows = $wpdb->query($query);
		$listingCounter = $listingCounter + 1;	
	}
	
	echo '<pre>';
	print_r($updateRecordsArray);
	echo '</pre>';
	echo 'If you refresh the page, you will see that records will stay just as you modified.';
}
?>
