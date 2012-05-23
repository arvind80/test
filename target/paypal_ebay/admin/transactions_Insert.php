<?php require_once('../Connections/connDB.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php 
// WA Application Builder Insert
if (isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $connDB;
  $WA_table = "transactions";
  $WA_sessionName = "WADA_Insert_transactions";
  $WA_redirectURL = "transactions_Detail.php";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "customer_id|receiver_email|receiver_id|payer_status|ship_to_name|ship_to_street|ship_to_street_2|ship_to_city|ship_to_state|ship_to_postal_code|ship_to_country_code|invoice_number|sales_tax|paypal_timestamp|paypal_correlation_id|sender_transaction_id|receipt_id|transaction_type|payment_type|amount|fee_amount|shipping_amount|handling_amount|currency_code|payment_status|ship_to_phone_number|insurance_amount|receiver_transaction_id";
  $WA_fieldValuesStr = "".((isset($_POST["customer_id"]))?$_POST["customer_id"]:"")  ."" . "|" . "".((isset($_POST["receiver_email"]))?$_POST["receiver_email"]:"")  ."" . "|" . "".((isset($_POST["receiver_id"]))?$_POST["receiver_id"]:"")  ."" . "|" . "".((isset($_POST["payer_status"]))?$_POST["payer_status"]:"")  ."" . "|" . "".((isset($_POST["ship_to_name"]))?$_POST["ship_to_name"]:"")  ."" . "|" . "".((isset($_POST["ship_to_street"]))?$_POST["ship_to_street"]:"")  ."" . "|" . "".((isset($_POST["ship_to_street_2"]))?$_POST["ship_to_street_2"]:"")  ."" . "|" . "".((isset($_POST["ship_to_city"]))?$_POST["ship_to_city"]:"")  ."" . "|" . "".((isset($_POST["ship_to_state"]))?$_POST["ship_to_state"]:"")  ."" . "|" . "".((isset($_POST["ship_to_postal_code"]))?$_POST["ship_to_postal_code"]:"")  ."" . "|" . "".((isset($_POST["ship_to_country_code"]))?$_POST["ship_to_country_code"]:"")  ."" . "|" . "".((isset($_POST["invoice_number"]))?$_POST["invoice_number"]:"")  ."" . "|" . "".((isset($_POST["sales_tax"]))?$_POST["sales_tax"]:"")  ."" . "|" . "".((isset($_POST["paypal_timestamp"]))?$_POST["paypal_timestamp"]:"")  ."" . "|" . "".((isset($_POST["paypal_correlation_id"]))?$_POST["paypal_correlation_id"]:"")  ."" . "|" . "".((isset($_POST["sender_transaction_id"]))?$_POST["sender_transaction_id"]:"")  ."" . "|" . "".((isset($_POST["receipt_id"]))?$_POST["receipt_id"]:"")  ."" . "|" . "".((isset($_POST["transaction_type"]))?$_POST["transaction_type"]:"")  ."" . "|" . "".((isset($_POST["payment_type"]))?$_POST["payment_type"]:"")  ."" . "|" . "".((isset($_POST["amount"]))?$_POST["amount"]:"")  ."" . "|" . "".((isset($_POST["fee_amount"]))?$_POST["fee_amount"]:"")  ."" . "|" . "".((isset($_POST["shipping_amount"]))?$_POST["shipping_amount"]:"")  ."" . "|" . "".((isset($_POST["handling_amount"]))?$_POST["handling_amount"]:"")  ."" . "|" . "".((isset($_POST["currency_code"]))?$_POST["currency_code"]:"")  ."" . "|" . "".((isset($_POST["payment_status"]))?$_POST["payment_status"]:"")  ."" . "|" . "".((isset($_POST["ship_to_phone_number"]))?$_POST["ship_to_phone_number"]:"")  ."" . "|" . "".((isset($_POST["insurance_amount"]))?$_POST["insurance_amount"]:"")  ."" . "|" . "".((isset($_POST["receiver_transaction_id"]))?$_POST["receiver_transaction_id"]:"")  ."";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|none,none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL|',none,''|',none,''|',none,''|none,none,NULL|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode("|", $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_connDB;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id();
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
<title>Insert transactions</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="WADAInsertContainer">
  <form action="transactions_Insert.php" method="post" name="WADAInsertForm" id="WADAInsertForm">
    <div class="WADAHeader">Insert Record</div>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <th class="WADADataTableHeader">customer_id:</th>
        <td class="WADADataTableCell"><input type="text" name="customer_id" id="customer_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receiver_email:</th>
        <td class="WADADataTableCell"><input type="text" name="receiver_email" id="receiver_email" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receiver_id:</th>
        <td class="WADADataTableCell"><input type="text" name="receiver_id" id="receiver_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">payer_status:</th>
        <td class="WADADataTableCell"><input type="text" name="payer_status" id="payer_status" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_name:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_name" id="ship_to_name" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_street:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_street" id="ship_to_street" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_street_2:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_street_2" id="ship_to_street_2" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_city:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_city" id="ship_to_city" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_state:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_state" id="ship_to_state" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_postal_code:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_postal_code" id="ship_to_postal_code" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_country_code:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_country_code" id="ship_to_country_code" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">invoice_number:</th>
        <td class="WADADataTableCell"><input type="text" name="invoice_number" id="invoice_number" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">sales_tax:</th>
        <td class="WADADataTableCell"><input type="text" name="sales_tax" id="sales_tax" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">paypal_timestamp:</th>
        <td class="WADADataTableCell"><input type="text" name="paypal_timestamp" id="paypal_timestamp" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">paypal_correlation_id:</th>
        <td class="WADADataTableCell"><input type="text" name="paypal_correlation_id" id="paypal_correlation_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">sender_transaction_id:</th>
        <td class="WADADataTableCell"><input type="text" name="sender_transaction_id" id="sender_transaction_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receipt_id:</th>
        <td class="WADADataTableCell"><input type="text" name="receipt_id" id="receipt_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">transaction_type:</th>
        <td class="WADADataTableCell"><input type="text" name="transaction_type" id="transaction_type" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">payment_type:</th>
        <td class="WADADataTableCell"><input type="text" name="payment_type" id="payment_type" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">amount:</th>
        <td class="WADADataTableCell"><input type="text" name="amount" id="amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">fee_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="fee_amount" id="fee_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">shipping_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="shipping_amount" id="shipping_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">handling_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="handling_amount" id="handling_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">currency_code:</th>
        <td class="WADADataTableCell"><input type="text" name="currency_code" id="currency_code" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">payment_status:</th>
        <td class="WADADataTableCell"><input type="text" name="payment_status" id="payment_status" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_phone_number:</th>
        <td class="WADADataTableCell"><input type="text" name="ship_to_phone_number" id="ship_to_phone_number" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">insurance_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="insurance_amount" id="insurance_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receiver_transaction_id:</th>
        <td class="WADADataTableCell"><input type="text" name="receiver_transaction_id" id="receiver_transaction_id" value="" size="32" /></td>
      </tr>
    </table>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <div class="WADAButtonRow">
      <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Insert" id="Insert" value="Insert" alt="Insert" src="../WA_DataAssist/images/Pacifica/Refined_insert.gif"  /></td>
          <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transactions_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
        </tr>
      </table>
      <input name="WADAInsertRecordID" type="hidden" id="WADAInsertRecordID" value="" />
    </div>
  </form>
</div>
</body>
</html>
