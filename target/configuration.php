<?php
/*
=======================================================================================
By : Naveen kumar
=======================================================================================
*/
require_once("libs/database.php");
require_once("config/dbConf.php");
//ini_set('display_errors','On');
//ini_set('errors_reporting','On');
$position_uri = strrpos($_SERVER['REQUEST_URI'],'/')+1;
$request_uri= substr($_SERVER['REQUEST_URI'],0,$position_uri);
$request_uri=str_replace('installs/','',$request_uri);
$siteUrl="http://" . $_SERVER['SERVER_NAME'].$request_uri;
$partsurls=parse_url($siteUrl);
define('REAL_PATH',$partsurls['path']);
define ("SITE_NAME",'Fill Your Status');
# Setting up the database connection.
?>
