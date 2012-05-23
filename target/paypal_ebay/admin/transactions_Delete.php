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
$Paramid_WADAtransactions = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAtransactions = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connDB, $connDB);
$query_WADAtransactions = sprintf("SELECT id, creation_timestamp, customer_id, receiver_email, receiver_id, payer_status, ship_to_name, ship_to_street, ship_to_street_2, ship_to_city, ship_to_state, ship_to_postal_code, ship_to_country_code, invoice_number, sales_tax, paypal_timestamp, paypal_correlation_id, sender_transaction_id, receipt_id, transaction_type, payment_type, amount, fee_amount, shipping_amount, handling_amount, currency_code, payment_status, ship_to_phone_number, insurance_amount, receiver_transaction_id FROM transactions WHERE id = %s", GetSQLValueString($Paramid_WADAtransactions, "int"));
$WADAtransactions = mysql_query($query_WADAtransactions, $connDB) or die(mysql_error());
$row_WADAtransactions = mysql_fetch_assoc($WADAtransactions);
$totalRows_WADAtransactions = mysql_num_rows($WADAtransactions);?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $connDB;
  $WA_table = "transactions";
  $WA_redirectURL = "transactions_Results.php";
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
<title>Delete transactions</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div class="WADADeleteContainer">
  <?php if ($totalRows_WADAtransactions > 0) { // Show if recordset not empty ?>
    <form action="transactions_Delete.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" method="post" name="WADADeleteForm" id="WADADeleteForm">
      <div class="WADAHeader">Delete Record</div>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <p class="WADAMessage">Are you sure you want to delete the following record?</p>
      <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th class="WADADataTableHeader">id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">creation_timestamp:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['creation_timestamp']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">customer_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['customer_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receiver_email:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['receiver_email']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receiver_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['receiver_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">payer_status:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['payer_status']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_name:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_name']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_street:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_street']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_street_2:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_street_2']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_city:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_city']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_state:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_state']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_postal_code:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_postal_code']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_country_code:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_country_code']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">invoice_number:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['invoice_number']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">sales_tax:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['sales_tax']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">paypal_timestamp:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['paypal_timestamp']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">paypal_correlation_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['paypal_correlation_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">sender_transaction_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['sender_transaction_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receipt_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['receipt_id']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">transaction_type:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['transaction_type']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">payment_type:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['payment_type']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">fee_amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['fee_amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">shipping_amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['shipping_amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">handling_amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['handling_amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">currency_code:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['currency_code']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">payment_status:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['payment_status']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_phone_number:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['ship_to_phone_number']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">insurance_amount:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['insurance_amount']); ?></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receiver_transaction_id:</th>
          <td class="WADADataTableCell"><?php echo($row_WADAtransactions['receiver_transaction_id']); ?></td>
        </tr>
      </table>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <div class="WADAButtonRow">
        <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Delete" id="Delete" value="Delete" alt="Delete" src="../WA_DataAssist/images/Pacifica/Refined_delete.gif"  /></td>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transactions_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
          </tr>
        </table>
        <input name="WADADeleteRecordID" type="hidden" id="WADADeleteRecordID" value="<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" />
      </div>
    </form>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_WADAtransactions == 0) { // Show if recordset empty ?>
    <div class="WADANoResults">
      <div class="WADANoResultsMessage">No record found.</div>
    </div>
  <?php } // Show if recordset empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtransactions);
?>
