<?php
   if(("dbConf.php" == $_SERVER['SCRIPT_NAME'])){
		 die( "<h2>Direct include access prohibited</h2>");
	}
	define("DATABASE_HOST","localhost");
	define("DATABASE_USERNAME","root");
	define("DATABASE_PASSWORD","root");
	define("DATABASE_NAME","kindlebit_target");
	define("DATABASE_PORT","");
	$Prefix="admin_";
?>
