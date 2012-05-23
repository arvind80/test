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
$query_WADAtransactions = sprintf("SELECT id, customer_id, receiver_email, receiver_id, payer_status, ship_to_name, ship_to_street, ship_to_street_2, ship_to_city, ship_to_state, ship_to_postal_code, ship_to_country_code, invoice_number, sales_tax, paypal_timestamp, paypal_correlation_id, sender_transaction_id, receipt_id, transaction_type, payment_type, amount, fee_amount, shipping_amount, handling_amount, currency_code, payment_status, ship_to_phone_number, insurance_amount, receiver_transaction_id FROM transactions WHERE id = %s", GetSQLValueString($Paramid_WADAtransactions, "int"));
$WADAtransactions = mysql_query($query_WADAtransactions, $connDB) or die(mysql_error());
$row_WADAtransactions = mysql_fetch_assoc($WADAtransactions);
$totalRows_WADAtransactions = mysql_num_rows($WADAtransactions);?>
<?php 
// WA Application Builder Update
if (isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $connDB;
  $WA_table = "transactions";
  $WA_redirectURL = "transactions_Detail.php?id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "customer_id|receiver_email|receiver_id|payer_status|ship_to_name|ship_to_street|ship_to_street_2|ship_to_city|ship_to_state|ship_to_postal_code|ship_to_country_code|invoice_number|sales_tax|paypal_timestamp|paypal_correlation_id|sender_transaction_id|receipt_id|transaction_type|payment_type|amount|fee_amount|shipping_amount|handling_amount|currency_code|payment_status|ship_to_phone_number|insurance_amount|receiver_transaction_id";
  $WA_fieldValuesStr = "".((isset($_POST["customer_id"]))?$_POST["customer_id"]:"")  ."" . "|" . "".((isset($_POST["receiver_email"]))?$_POST["receiver_email"]:"")  ."" . "|" . "".((isset($_POST["receiver_id"]))?$_POST["receiver_id"]:"")  ."" . "|" . "".((isset($_POST["payer_status"]))?$_POST["payer_status"]:"")  ."" . "|" . "".((isset($_POST["ship_to_name"]))?$_POST["ship_to_name"]:"")  ."" . "|" . "".((isset($_POST["ship_to_street"]))?$_POST["ship_to_street"]:"")  ."" . "|" . "".((isset($_POST["ship_to_street_2"]))?$_POST["ship_to_street_2"]:"")  ."" . "|" . "".((isset($_POST["ship_to_city"]))?$_POST["ship_to_city"]:"")  ."" . "|" . "".((isset($_POST["ship_to_state"]))?$_POST["ship_to_state"]:"")  ."" . "|" . "".((isset($_POST["ship_to_postal_code"]))?$_POST["ship_to_postal_code"]:"")  ."" . "|" . "".((isset($_POST["ship_to_country_code"]))?$_POST["ship_to_country_code"]:"")  ."" . "|" . "".((isset($_POST["invoice_number"]))?$_POST["invoice_number"]:"")  ."" . "|" . "".((isset($_POST["sales_tax"]))?$_POST["sales_tax"]:"")  ."" . "|" . "".((isset($_POST["paypal_timestamp"]))?$_POST["paypal_timestamp"]:"")  ."" . "|" . "".((isset($_POST["paypal_correlation_id"]))?$_POST["paypal_correlation_id"]:"")  ."" . "|" . "".((isset($_POST["sender_transaction_id"]))?$_POST["sender_transaction_id"]:"")  ."" . "|" . "".((isset($_POST["receipt_id"]))?$_POST["receipt_id"]:"")  ."" . "|" . "".((isset($_POST["transaction_type"]))?$_POST["transaction_type"]:"")  ."" . "|" . "".((isset($_POST["payment_type"]))?$_POST["payment_type"]:"")  ."" . "|" . "".((isset($_POST["amount"]))?$_POST["amount"]:"")  ."" . "|" . "".((isset($_POST["fee_amount"]))?$_POST["fee_amount"]:"")  ."" . "|" . "".((isset($_POST["shipping_amount"]))?$_POST["shipping_amount"]:"")  ."" . "|" . "".((isset($_POST["handling_amount"]))?$_POST["handling_amount"]:"")  ."" . "|" . "".((isset($_POST["currency_code"]))?$_POST["currency_code"]:"")  ."" . "|" . "".((isset($_POST["payment_status"]))?$_POST["payment_status"]:"")  ."" . "|" . "".((isset($_POST["ship_to_phone_number"]))?$_POST["ship_to_phone_number"]:"")  ."" . "|" . "".((isset($_POST["insurance_amount"]))?$_POST["insurance_amount"]:"")  ."" . "|" . "".((isset($_POST["receiver_transaction_id"]))?$_POST["receiver_transaction_id"]:"")  ."";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|none,none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL|',none,''|',none,''|',none,''|none,none,NULL|',none,''";
  $WA_comparisonStr = " = | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | = | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | = | = | = | = | LIKE | LIKE | LIKE | = | LIKE ";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_where_columnTypesStr = "none,none,NULL";
  $WA_where_comparisonStr = "=";
  $WA_where_fieldNames = explode("|", $WA_indexField);
  $WA_where_fieldValues = explode("|", $WA_where_fieldValuesStr);
  $WA_where_columns = explode("|", $WA_where_columnTypesStr);
  $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
  
  $WA_connectionDB = $database_connDB;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
  $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
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
<title>Update transactions</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div class="WADAUpdateContainer">
  <?php if ($totalRows_WADAtransactions > 0) { // Show if recordset not empty ?>
    <form action="transactions_Update.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" method="post" name="WADAUpdateForm" id="WADAUpdateForm">
      <div class="WADAHeader">Update Record</div>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th class="WADADataTableHeader">customer_id:</th>
          <td class="WADADataTableCell"><input type="text" name="customer_id" id="customer_id" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['customer_id'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receiver_email:</th>
          <td class="WADADataTableCell"><input type="text" name="receiver_email" id="receiver_email" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['receiver_email'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receiver_id:</th>
          <td class="WADADataTableCell"><input type="text" name="receiver_id" id="receiver_id" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['receiver_id'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">payer_status:</th>
          <td class="WADADataTableCell"><input type="text" name="payer_status" id="payer_status" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['payer_status'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_name:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_name" id="ship_to_name" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_name'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_street:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_street" id="ship_to_street" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_street'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_street_2:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_street_2" id="ship_to_street_2" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_street_2'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_city:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_city" id="ship_to_city" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_city'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_state:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_state" id="ship_to_state" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_state'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_postal_code:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_postal_code" id="ship_to_postal_code" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_postal_code'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_country_code:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_country_code" id="ship_to_country_code" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_country_code'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">invoice_number:</th>
          <td class="WADADataTableCell"><input type="text" name="invoice_number" id="invoice_number" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['invoice_number'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">sales_tax:</th>
          <td class="WADADataTableCell"><input type="text" name="sales_tax" id="sales_tax" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['sales_tax'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">paypal_timestamp:</th>
          <td class="WADADataTableCell"><input type="text" name="paypal_timestamp" id="paypal_timestamp" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['paypal_timestamp'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">paypal_correlation_id:</th>
          <td class="WADADataTableCell"><input type="text" name="paypal_correlation_id" id="paypal_correlation_id" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['paypal_correlation_id'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">sender_transaction_id:</th>
          <td class="WADADataTableCell"><input type="text" name="sender_transaction_id" id="sender_transaction_id" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['sender_transaction_id'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receipt_id:</th>
          <td class="WADADataTableCell"><input type="text" name="receipt_id" id="receipt_id" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['receipt_id'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">transaction_type:</th>
          <td class="WADADataTableCell"><input type="text" name="transaction_type" id="transaction_type" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['transaction_type'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">payment_type:</th>
          <td class="WADADataTableCell"><input type="text" name="payment_type" id="payment_type" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['payment_type'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">amount:</th>
          <td class="WADADataTableCell"><input type="text" name="amount" id="amount" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['amount'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">fee_amount:</th>
          <td class="WADADataTableCell"><input type="text" name="fee_amount" id="fee_amount" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['fee_amount'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">shipping_amount:</th>
          <td class="WADADataTableCell"><input type="text" name="shipping_amount" id="shipping_amount" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['shipping_amount'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">handling_amount:</th>
          <td class="WADADataTableCell"><input type="text" name="handling_amount" id="handling_amount" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['handling_amount'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">currency_code:</th>
          <td class="WADADataTableCell"><input type="text" name="currency_code" id="currency_code" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['currency_code'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">payment_status:</th>
          <td class="WADADataTableCell"><input type="text" name="payment_status" id="payment_status" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['payment_status'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">ship_to_phone_number:</th>
          <td class="WADADataTableCell"><input type="text" name="ship_to_phone_number" id="ship_to_phone_number" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['ship_to_phone_number'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">insurance_amount:</th>
          <td class="WADADataTableCell"><input type="text" name="insurance_amount" id="insurance_amount" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['insurance_amount'])); ?>" size="32" /></td>
        </tr>
        <tr>
          <th class="WADADataTableHeader">receiver_transaction_id:</th>
          <td class="WADADataTableCell"><input type="text" name="receiver_transaction_id" id="receiver_transaction_id" value="<?php echo(str_replace('"', '&quot;', $row_WADAtransactions['receiver_transaction_id'])); ?>" size="32" /></td>
        </tr>
      </table>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <div class="WADAButtonRow">
        <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Update" id="Update" value="Update" alt="Update" src="../WA_DataAssist/images/Pacifica/Refined_update.gif"  /></td>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transactions_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
          </tr>
        </table>
        <input name="WADAUpdateRecordID" type="hidden" id="WADAUpdateRecordID" value="<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" />
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
