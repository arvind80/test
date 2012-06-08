<?

$url = getCurentURL ();

if (strstr ( $url, 'users/user_action:login' ) == true) {
	$url = 'http://waterforlifeusa.com/aff/affiliates/login.php';
	
	header ( "location: {$url}" );

}

if (strstr ( $url, 'user_action:register' ) == true) {
	$url = 'http://waterforlifeusa.com/aff/affiliates/signup.php';
	header ( "location: {$url}" );
}

$secured = false;
if (isset ( $_SERVER ["HTTPS"] )) {
	if ($_SERVER ["HTTPS"] == "on") {
		$secured = true;
	if (strstr ( $url, 'checkout' ) == true or (strstr ( $url, 'order' ) == true) or (strstr ( $url, 'ajax' ) == true) ) {
	
	} else {
		$url = str_replace ( 'https://', 'http://', $url );
		$url = str_replace ( ':443', '', $url );
		
		header ( "location: {$url}" );
	}
	}
}
if ($secured == false) {
	if (strstr ( $url, 'checkout' ) == true or (strstr ( $url, 'order' ) == true)) {
		$url = str_replace ( 'http://', 'https://', $url );
		header ( "location: {$url}" );
	}
} else {
	if (strstr ( $url, 'checkout' ) == true or (strstr ( $url, 'order' ) == true)) {
	
	} else {
		//$url = str_replace ( 'https://', 'http://', $url );
		//header ( "location: {$url}" );
	}

}	


if (strtolower($url) == 'http://www.waterforlifeusa.com/') {
	$url = 'http://waterforlifeusa.com/';
	header ( "location: {$url}" );
}

if (strtolower($url) == 'http://www.waterforlifeusa.com') {
	$url = 'http://waterforlifeusa.com/';
	header ( "location: {$url}" );
}






		