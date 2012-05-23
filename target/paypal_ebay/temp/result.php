<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
	
// MySQL Connection
require_once('../includes/config.php');
require_once('../includes/database.class.php');
$db = Database::obtain($db_host,$db_user,$db_pass,$db_name);
$db->connect();

$sql = "SELECT serialized_result FROM api_logs WHERE id = 238";
$row = $db->query_first($sql);

$serialized_result = $row['serialized_result'];
$unserialized_result = unserialize($serialized_result);

echo '<pre />';
print_r($unserialized_result);
?>