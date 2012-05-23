<?php
require_once('/home/harvest/includes/config.php');
?>
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connDB = $db_host;
$database_connDB = $db_name;
$username_connDB = $db_user;
$password_connDB = $db_pass;
$connDB = mysql_pconnect($hostname_connDB, $username_connDB, $password_connDB) or trigger_error(mysql_error(),E_USER_ERROR); 
?>