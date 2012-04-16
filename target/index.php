<?php ob_start();session_start();
	require_once("shared/header.php");
	require_once('classes/statusreport.php');
	require_once('classes/projects.php');
	if(!session_is_registered('user_id')){
		include("shared/login.php");
		//include("forget_password.php");
	}elseif(isset($_SESSION['template']) && $_SESSION['template']!=''){
		include($_SESSION['template']);
	}
	include("shared/footer.php");
?>
