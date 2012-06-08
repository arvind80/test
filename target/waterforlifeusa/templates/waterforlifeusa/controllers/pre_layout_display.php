<?php
$url_temp = getCurentURL ();
if (isset ( $_SERVER ["HTTPS"] )) {
	if ($_SERVER ["HTTPS"] == "on") {
		$no_cdn = true;
		
		if (stristr ( $url_temp, 'checkout' ) or stristr ( $url_temp, 'confirm-order' )) {
			$layout = str_replace ( 'http://', 'https://', $layout );
		
		} else {
			$url_temp = str_replace ( ':443', '', $url_temp );
			$url_temp = str_replace ( 'https://', 'http://', $url_temp );
			header ( 'Location: ' . $url_temp );
			exit ();
		}
	
	}
} else {
	
	//var_dump($url_temp);
	if (stristr ( $url_temp, 'checkout' ) or stristr ( $url_temp, 'confirm-order' )) {
		
		$url_temp = str_replace ( 'http://', 'https://', $url_temp );
		header ( 'Location: ' . $url_temp );
		exit ();
	
	}

}


if ($no_cdn == false) {
	$old = site_url ( 'userfiles' );
	$new = str_replace ( 'waterforlifeusa.com', 'wfl.ooyes.netdna-cdn.com', $old );
	$layout = str_replace ( $old, $new, $layout );

	$old = site_url ( 'flir' );
	$new = str_replace ( 'waterforlifeusa.com', 'wfl.ooyes.netdna-cdn.com', $old );
	$layout = str_replace ( $old, $new, $layout );

}


$url_sub = getCurentURL ();
$url_sub = str_ireplace ( 'http://', '', $url_sub );
$url_sub = str_ireplace ( 'https://', '', $url_sub );
$url_sub = str_ireplace ( 'www.', '', $url_sub );
$url_sub2 = $url_sub;

$url_sub = explode ( '.', $url_sub );

$name = $url_sub [0];

if ((trim ( $name ) != '') and stristr($url_sub2, '/sites/') == false) {
	if ($name != 'waterforlifeusa') {
		$name2 = $name;
		$name = addslashes ( $name );

		$sql = " select *  from qu_pap_users where data12='{$name}' limit 1 ";
		
		$check = $this->core_model->dbQuery ( $sql );
		if (! empty ( $check )) {
			
			$ref = $check [0] ['refid'];
			
			//var_Dump($ref);
			

			//header('Location: http://www.example.com/');
			header ( "Location: " . 'http://'.$name2.'.waterforlifeusa.com/sites/' . $ref . '/' );
			exit ();
		
		} else {
			//print $name;
		//	exit();
			
			header ( "Location: " . 'http://waterforlifeusa.com/' );
		}
	}
}




?>