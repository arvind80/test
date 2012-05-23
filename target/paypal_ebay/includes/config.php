<?php
$host_split = explode('.',$_SERVER['HTTP_HOST']);
$db_sandbox = $host_split[0] == 'harvestcellular' ? true : false;

$sandbox = false;

$domain = $sandbox ? 'http://harvestcellular.angelleye.com/' : 'http://184.154.158.150/';
$siteroot = $db_sandbox ? '/home/harvestcellular/www/' : '/home/harvest/public_html/';

$enable_logging = true;
$minutes_back = 8;

$paypal_api_version = '74.0';
$paypal_application_id = $sandbox ? 'APP-80W284485P519543T' : '';
$paypal_developer_account_email = '';
$paypal_api_username = $sandbox ? '' : 'harvestcellular2_api1.gmail.com';
$paypal_api_password = $sandbox ? '' : '5FKXEUUFYUQ9BLZ6';
$paypal_api_signature = $sandbox ? '' : 'AVpBTZU4.Ex4UDmfv.sZtZtZldsrAIf7m7x6XfsPLrT8CAAt5Rm42nC3';

$eBay_auth_token = $sandbox ? "" : "AgAAAA**AQAAAA**aAAAAA**Y1nMTg**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wNmISnCpiDqQidj6x9nY+seQ**YzEBAA**AAMAAA**4EK4RAuFm8yC/3ry5OjO+Sol8l+riQm04VAkOocEhBB4nC71yuUawtpqgMCWF3K3H+RrZhXzG4m/HKhkAw2U/5f5oo0nprso5cxFiqU0sF2kS4dxZj/HuoblVEzOXGploSwgsjqFB4YL++Pz9oU9s/VSEHO4h+IUF0/x4C7cjnmG3GKO/6puCZ9SSwlmxMJeZXibbrvzgWLXT2UY7zdzm2n2bQp7VYUh8OwhAZuW946yNWGKGq8lN6gRBetWW296TJp4ut0UsA313p+0odNICKf4tOPyBN65ZvU3DothWbvn4EvweaJnbYBocedFbO9UFvokgOuSKnbnY7XiDj/jadf1hNyJwOIuTdzmdMF4Znn3AlB808m2ljprpu5Z3lM52bfwVqHPJcNr9tArxYpcEiR6iZ1nmIPaly9c451nWoY0+b6btxV2q9ayuUnSF4vRxrgcuhpLVfFYIgrJGXpOFF5VghyYtaX1UL/+W+AcejyW/GpzluHEOturifcBag0emVumKPj1FPE4VXYc7cjt9xc+3n9t6nTYFSJA7q1xBBuoQ8m4EyWelRjZw8Ly6gpNR5LtvAJxPi6JIwxXeQlQ1stR+ADIp+9VzyxETw2pWlF2zgz56YtCD9oI/gbvUkQKVBZkKBaiOMBcrQRsIMwIK8tRATXOaE9Mokh/17iD8c7JOQILMwg0D0eU+RTZ48aiA70d7ZfJSpyiNejMtPhuBr3v2oA0abSdOssxqaW74yKOk6amxpHnsW7CcW1lOHUj";

$db_host = $db_sandbox ? 'localhost' : 'localhost';
$db_user = $db_sandbox ? 'angelleye' : 'harvest_user';
$db_pass = $db_sandbox ? 'Passw0rd~' : 'pas448877';
$db_name = $db_sandbox ? 'harvest_db' : 'harvest_db';

$send_email_notification = true;
$admin_email_address = 'harvestcellular2@gmail.com'; 							
$admin_name = 'Harvest Cellular';
$email_from_address = 'noreply@gmail.com';
$email_from_name = 'Harvest Cellular';
$smtp_host = 'smtp.gmail.com';
$smtp_username = 'harvestcellular2@gmail.com';
$smtp_password = 'Harvest$$2011';
?>