<?php
$host = 'localhost'; // <--  db address
 $user = 'root'; // <-- db user name
 $pass = 'root'; // <-- password
 $db = 'franchis_dbclients'; // db's name
 $table = 'tbl_customers'; // table you want to export
 $table2 = 'tbl_address_book'; // table2 you want to export
 $file = 'tbl_customers_groups'; // csv name.
 //include "private/php_functions.php";
$link = mysql_connect($host, $user, $pass) or die("Can not connect." . mysql_error());
 mysql_select_db($db) or die("Can not connect.");
 
//$result = mysql_query("SHOW COLUMNS FROM ".$table."");
$result1 = mysql_query("SHOW COLUMNS FROM ".$table."");
$result2 = mysql_query("SHOW COLUMNS FROM ".$table2."");
//$result3 = mysql_query("SHOW COLUMNS FROM tbl_customer_groups_to_products ");
 $i = 0;
 

if (mysql_num_rows($result1) > 0) {
while ($row1 = mysql_fetch_assoc($result1)) {
//$csv_output .= $row1['Field'].";";
$i++;}
}
if (mysql_num_rows($result2) > 0) {
while ($row2 = mysql_fetch_assoc($result2)) {
//$csv_output .= $row2['Field'].";";
$i++;}
}
//$csv_output .= "\n";
//,tpd.products_description
//echo "SELECT c.*,b.* FROM ".$table." c left join ".$table2." b on b.customers_id=c.customers_id WHERE b.customers_id=c.customers_id"; die();
$values = mysql_query("SELECT c.*,b.* FROM ".$table." c left join ".$table2." b on b.customers_id=c.customers_id WHERE b.customers_id=c.customers_id");
//$values = mysql_query("SELECT * FROM ".$table."");
 
while ($rowr = mysql_fetch_row($values)){
	for ($j=0;$j<$i;$j++){
	$csv_output .= trim(strip_tags($rowr[$j].";"));//$rowr[$j].";";
	}
	$csv_output .= "\n";
}
 
$filename = $file."_".date("d-m-Y_H-i",time());
 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
 
print $csv_output;
 
exit;

?>
