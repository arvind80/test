<?php require_once('../Connections/connDB.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?><?php
if (!session_id()) session_start(); 
?>
<?php
$Paramid_WADAtransaction_items = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAtransaction_items = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
$ParamSessionid_WADAtransaction_items = "-1";
if (isset($_SESSION['WADA_Insert_transaction_items'])) {
  $ParamSessionid_WADAtransaction_items = (get_magic_quotes_gpc()) ? $_SESSION['WADA_Insert_transaction_items'] : addslashes($_SESSION['WADA_Insert_transaction_items']);
}
$Paramid2_WADAtransaction_items = "-1";
if (isset($_GET['id'])) {
  $Paramid2_WADAtransaction_items = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connDB, $connDB);
$query_WADAtransaction_items = sprintf("SELECT id, creation_timestamp, transaction_id, name, description, item_number, qty, amount, tax_amount, ebay_item_txn_id, ebay_item_order_id, url, end_date, ebay_title, ebay_subtitle, location, `condition`, external_picture_url, gallery_picture_url, picture_url, return_policy_description, refund, refund_option, returns_accepted, returns_accepted_option, returns_within, returns_within_option, shipping_cost_paid_by, shipping_cost_paid_by_option, warranty_duration, warranty_duration_option, warranty_offered, warranty_offered_option, warranty_type, warranty_type_option FROM transaction_items WHERE id = %s OR ( -1= %s AND id= %s)", GetSQLValueString($Paramid_WADAtransaction_items, "int"),GetSQLValueString($Paramid2_WADAtransaction_items, "int"),GetSQLValueString($ParamSessionid_WADAtransaction_items, "int"));
$WADAtransaction_items = mysql_query($query_WADAtransaction_items, $connDB) or die(mysql_error());
$row_WADAtransaction_items = mysql_fetch_assoc($WADAtransaction_items);
$totalRows_WADAtransaction_items = mysql_num_rows($WADAtransaction_items);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Details transaction_items</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/* Details page CSS */
.WADADetailsContainer {
	font-size: 11px;
}
#WADADetails {
	padding-top: 10px;
}
</style>
</head>

<body>


<div class="WADADetailsContainer"> <a name="top"></a>
  <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
  <?php if ($totalRows_WADAtransaction_items > 0) { // Show if recordset not empty ?>
    <div id="WADADetails">
      <div class="WADAHeader">Details</div>
      <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th valign="top" class="WADADataTableHeader">id:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['id']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">creation_timestamp:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['creation_timestamp']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">transaction_id:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['transaction_id']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">name:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['name']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">description:</th>
          <td valign="top" class="WADADataTableCell"><?php echo(htmlspecialchars($row_WADAtransaction_items['description'],ENT_QUOTES)); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">item_number:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['item_number']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">qty:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['qty']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">amount:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['amount']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">tax_amount:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['tax_amount']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">ebay_item_txn_id:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_item_txn_id']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">ebay_item_order_id:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_item_order_id']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">url:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['url']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">end_date:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['end_date']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">ebay_title:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_title']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">ebay_subtitle:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_subtitle']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">location:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['location']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">condition:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['condition']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">external_picture_url:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['external_picture_url']); ?>
          <?php
		  echo $row_WADAtransaction_items['external_picture_url'] != '' ? '<br /><img src="../images/'.$row_WADAtransaction_items['id'].'-external_picture_url.jpg"></img>' : '';
		  ?>
          </td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">gallery_picture_url:</th>
          <td valign="top" class="WADADataTableCell">
		  <?php echo($row_WADAtransaction_items['gallery_picture_url']); ?>
          <?php
		  echo $row_WADAtransaction_items['gallery_picture_url'] != '' ? '<br /><img src="../images/'.$row_WADAtransaction_items['id'].'-gallery_picture_url.jpg"></img>' : '';
		  ?>
          </td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">picture_url:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['picture_url']); ?>
          <?php
		  echo $row_WADAtransaction_items['picture_url'] != '' ? '<br /><img src="../images/'.$row_WADAtransaction_items['id'].'-picture_url.jpg"></img>' : '';
		  ?>
          </td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">return_policy_description:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['return_policy_description']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">refund:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['refund']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">refund_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['refund_option']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">returns_accepted:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_accepted']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">returns_accepted_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_accepted_option']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">returns_within:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_within']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">returns_within_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_within_option']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">shipping_cost_paid_by:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['shipping_cost_paid_by']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">shipping_cost_paid_by_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['shipping_cost_paid_by_option']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">warranty_duration:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_duration']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">warranty_duration_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_duration_option']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">warranty_offered:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_offered']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">warranty_offered_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_offered_option']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">warranty_type:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_type']); ?></td>
        </tr>
        <tr>
          <th valign="top" class="WADADataTableHeader">warranty_type_option:</th>
          <td valign="top" class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_type_option']); ?></td>
        </tr>
      </table>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    </div>
  <?php } // Show if recordset not empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtransaction_items);
?>
