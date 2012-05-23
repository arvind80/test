<?php

$db_host = $sandbox ? 'localhost' : 'localhost';
$db_user = $sandbox ? 'dustin_jones' : 'harvest_newuser';
$db_pass = $sandbox ? 'Passw0rd~' : 'pas448877';
$db_name = $sandbox ? 'dustin_jones' : 'harvest_newdb';
require_once('includes/functions.php');
// PayPal Connection
require_once('includes/paypal/library/includes/paypal.class.php');
// MySQL Connection
require_once('includes/database.class.php');
$db = Database::obtain($db_host, $db_user, $db_pass, $db_name);
$db->connect();
// PHPMailer
require_once('includes/phpmailer/class.phpmailer.php');
require_once('includes/phpmailer/class.smtp.php');
$sandbox = false;
$domain = $sandbox ? 'http://local.dustinjones.com/' : 'http://184.154.158.150/';
$enable_logging = true;
$minutes_back = 8;

$paypal_api_version = '74.0';
$paypal_application_id = $sandbox ? 'APP-80W284485P519543T' : '';
$paypal_developer_account_email = '';
//$paypal_api_username = $sandbox ? '' : 'harvestcellular2_api1.gmail.com';
//$paypal_api_password = $sandbox ? '' : '5FKXEUUFYUQ9BLZ6';
//$paypal_api_signature = $sandbox ? '' : 'AVpBTZU4.Ex4UDmfv.sZtZtZldsrAIf7m7x6XfsPLrT8CAAt5Rm42nC3';

 $paypal_api_username = $sandbox ? '' : 'harvestcellular2_api1.gmail.com';
 $paypal_api_password = $sandbox ? '' : 'Z7T8A4Y9EA9WJJA4';
 $paypal_api_signature = $sandbox ? '' : 'ATeMsREWC-MKvnG.e8.Ejn8Ikox7AJT3c0h4sU.YIoHzHZ2SzhTW921x';

$eBay_auth_token = $sandbox ? "" : "AgAAAA**AQAAAA**aAAAAA**Y1nMTg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wNmISnCpiDqQidj6x9nY+seQ**YzEBAA**AAMAAA**4EK4RAuFm8yC/3ry5OjO+Sol8l+riQm04VAkOocEhBB4nC71yuUawtpqgMCWF3K3H+RrZhXzG4m/HKhkAw2U/5f5oo0nprso5cxFiqU0sF2kS4dxZj/HuoblVEzOXGploSwgsjqFB4YL++Pz9oU9s/VSEHO4h+IUF0/x4C7cjnmG3GKO/6puCZ9SSwlmxMJeZXibbrvzgWLXT2UY7zdzm2n2bQp7VYUh8OwhAZuW946yNWGKGq8lN6gRBetWW296TJp4ut0UsA313p+0odNICKf4tOPyBN65ZvU3DothWbvn4EvweaJnbYBocedFbO9UFvokgOuSKnbnY7XiDj/jadf1hNyJwOIuTdzmdMF4Znn3AlB808m2ljprpu5Z3lM52bfwVqHPJcNr9tArxYpcEiR6iZ1nmIPaly9c451nWoY0+b6btxV2q9ayuUnSF4vRxrgcuhpLVfFYIgrJGXpOFF5VghyYtaX1UL/+W+AcejyW/GpzluHEOturifcBag0emVumKPj1FPE4VXYc7cjt9xc+3n9t6nTYFSJA7q1xBBuoQ8m4EyWelRjZw8Ly6gpNR5LtvAJxPi6JIwxXeQlQ1stR+ADIp+9VzyxETw2pWlF2zgz56YtCD9oI/gbvUkQKVBZkKBaiOMBcrQRsIMwIK8tRATXOaE9Mokh/17iD8c7JOQILMwg0D0eU+RTZ48aiA70d7ZfJSpyiNejMtPhuBr3v2oA0abSdOssxqaW74yKOk6amxpHnsW7CcW1lOHUj";

$send_email_notification = false;
$admin_email_address = 'harvestcellular2@gmail.com';
$admin_name = 'Harvest Cellular';
$email_from_address = 'noreply@gmail.com';
$email_from_name = 'Harvest Cellular';
$smtp_host = 'smtp.gmail.com';
$smtp_username = 'harvestcellular2@gmail.com';
$smtp_password = 'Harvest$$2011';

$PayPalConfig = array('Sandbox' => $sandbox, 'APIUsername' => $paypal_api_username, 'APIPassword' => $paypal_api_password, 'APISignature' => $paypal_api_signature);
$PayPal = new PayPal($PayPalConfig);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = $smtp_host;
$mail->Port = 465;
$mail->Username = $smtp_username;
$mail->Password = $smtp_password;
$mail->IsHTML(true);
$mail->From = $email_from_address;
$mail->FromName = $email_from_name;

$con = mysql_connect($db_host, $db_user, $db_pass) or die("Could not connect");
mysql_select_db($db_name, $con) or die('Could not select Database');


# Setting TimeZone specifier.
date_default_timezone_set('EST');

?>