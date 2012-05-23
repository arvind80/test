<?php require_once('../Connections/connDB.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
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
?>
<?php
$Paramid_WADAtransaction_items = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAtransaction_items = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connDB, $connDB);
$query_WADAtransaction_items = sprintf("SELECT id, creation_timestamp, transaction_id, name, description, item_number, qty, amount, tax_amount, ebay_item_txn_id, ebay_item_order_id, url, end_date, ebay_title, ebay_subtitle, location, condition, external_picture_url, gallery_picture_url, picture_url, return_policy_description, refund, refund_option, returns_accepted, returns_accepted_option, returns_within, returns_within_option, shipping_cost_paid_by, shipping_cost_paid_by_option, warranty_duration, warranty_duration_option, warranty_offered, warranty_offered_option, warranty_type, warranty_type_option FROM transaction_items WHERE id = %s", GetSQLValueString($Paramid_WADAtransaction_items, "int"));
$WADAtransaction_items = mysql_query($query_WADAtransaction_items, $connDB) or die(mysql_error());
$row_WADAtransaction_items = mysql_fetch_assoc($WADAtransaction_items);
$totalRows_WADAtransaction_items = mysql_num_rows($WADAtransaction_items);?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $connDB;
  $WA_table = "transaction_items";
  $WA_redirectURL = "transaction_items_Results.php";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "id";
  $WA_columnTypesStr = "none,none,NULL";
  $WA_fieldValuesStr = "".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  $WA_comparisonStr = "=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_comparisions = explode("|", $WA_comparisonStr);
  $WA_connectionDB = $database_connDB;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $deleteParamsObj = WA_AB_generateWhereClause($WA_fieldNames, $WA_columns, $WA_fieldValues, $WA_comparisions);
  $WA_Sql = "DELETE FROM `" . $WA_table . "` WHERE " . $deleteParamsObj->sqlWhereClause;
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete transaction_items</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div class="WADADeleteContainer">
  <?php if ($totalRows_WADAtransaction_items > 0) { // Show if recordset not empty ?>
    <form action="transaction_items_Delete.php?id=<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" method="post" name="WADADeleteForm" id="WADADeleteForm">
      <div class="WADAHeader">Delete Record</div>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <p class="WADAMessage">Are you sure you want to delete the following record?</p>
      <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th class="WADADataTableHeader">id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">creation_timestamp:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['creation_timestamp']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">transaction_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['transaction_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">name:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['name']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">description:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['description']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">item_number:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['item_number']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">qty:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['qty']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">tax_amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['tax_amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ebay_item_txn_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_item_txn_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ebay_item_order_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_item_order_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">url:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['url']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">end_date:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['end_date']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ebay_title:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_title']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ebay_subtitle:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['ebay_subtitle']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">location:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['location']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">condition:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['condition']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">external_picture_url:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['external_picture_url']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">gallery_picture_url:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['gallery_picture_url']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">picture_url:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['picture_url']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">return_policy_description:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['return_policy_description']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">refund:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['refund']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">refund_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['refund_option']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">returns_accepted:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_accepted']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">returns_accepted_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_accepted_option']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">returns_within:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_within']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">returns_within_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['returns_within_option']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">shipping_cost_paid_by:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['shipping_cost_paid_by']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">shipping_cost_paid_by_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['shipping_cost_paid_by_option']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">warranty_duration:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_duration']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">warranty_duration_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_duration_option']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">warranty_offered:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_offered']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">warranty_offered_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_offered_option']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">warranty_type:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_type']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">warranty_type_option:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransaction_items['warranty_type_option']); ?></td>
        </tr>
      </table>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <div class="WADAButtonRow">
        <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Delete" id="Delete" value="Delete" alt="Delete" src="../WA_DataAssist/images/Pacifica/Refined_delete.gif"  /></td>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transaction_items_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
          </tr>
        </table>
        <input name="WADADeleteRecordID" type="hidden" id="WADADeleteRecordID" value="<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" />
      </div>
    </form>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_WADAtransaction_items == 0) { // Show if recordset empty ?>
    <div class="WADANoResults">
      <div class="WADANoResultsMessage">No record found.</div>
    </div>
  <?php } // Show if recordset empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtransaction_items);
?>
