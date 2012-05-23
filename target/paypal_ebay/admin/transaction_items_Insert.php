<?php require_once('../Connections/connDB.php'); ?>
<?php require_once("../WA_DataAssist/WA_AppBuilder_PHP.php"); ?>
<?php 
// WA Application Builder Insert
if (isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $connDB;
  $WA_table = "transaction_items";
  $WA_sessionName = "WADA_Insert_transaction_items";
  $WA_redirectURL = "transaction_items_Detail.php";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "name|description|item_number|qty|amount|tax_amount|ebay_item_txn_id|ebay_item_order_id|url|end_date|ebay_title|ebay_subtitle|location|condition|external_picture_url|gallery_picture_url|picture_url|return_policy_description|refund|refund_option|returns_accepted|returns_accepted_option|returns_within|returns_within_option|shipping_cost_paid_by|shipping_cost_paid_by_option|warranty_duration|warranty_duration_option|warranty_offered|warranty_offered_option|warranty_type|warranty_type_option";
  $WA_fieldValuesStr = "".((isset($_POST["name"]))?$_POST["name"]:"")  ."" . "|" . "".((isset($_POST["description"]))?$_POST["description"]:"")  ."" . "|" . "".((isset($_POST["item_number"]))?$_POST["item_number"]:"")  ."" . "|" . "".((isset($_POST["qty"]))?$_POST["qty"]:"")  ."" . "|" . "".((isset($_POST["amount"]))?$_POST["amount"]:"")  ."" . "|" . "".((isset($_POST["tax_amount"]))?$_POST["tax_amount"]:"")  ."" . "|" . "".((isset($_POST["ebay_item_txn_id"]))?$_POST["ebay_item_txn_id"]:"")  ."" . "|" . "".((isset($_POST["ebay_item_order_id"]))?$_POST["ebay_item_order_id"]:"")  ."" . "|" . "".((isset($_POST["url"]))?$_POST["url"]:"")  ."" . "|" . "".((isset($_POST["end_date"]))?$_POST["end_date"]:"")  ."" . "|" . "".((isset($_POST["ebay_title"]))?$_POST["ebay_title"]:"")  ."" . "|" . "".((isset($_POST["ebay_subtitle"]))?$_POST["ebay_subtitle"]:"")  ."" . "|" . "".((isset($_POST["location"]))?$_POST["location"]:"")  ."" . "|" . "".((isset($_POST["condition"]))?$_POST["condition"]:"")  ."" . "|" . "".((isset($_POST["external_picture_url"]))?$_POST["external_picture_url"]:"")  ."" . "|" . "".((isset($_POST["gallery_picture_url"]))?$_POST["gallery_picture_url"]:"")  ."" . "|" . "".((isset($_POST["picture_url"]))?$_POST["picture_url"]:"")  ."" . "|" . "".((isset($_POST["return_policy_description"]))?$_POST["return_policy_description"]:"")  ."" . "|" . "".((isset($_POST["refund"]))?$_POST["refund"]:"")  ."" . "|" . "".((isset($_POST["refund_option"]))?$_POST["refund_option"]:"")  ."" . "|" . "".((isset($_POST["returns_accepted"]))?$_POST["returns_accepted"]:"")  ."" . "|" . "".((isset($_POST["returns_accepted_option"]))?$_POST["returns_accepted_option"]:"")  ."" . "|" . "".((isset($_POST["returns_within"]))?$_POST["returns_within"]:"")  ."" . "|" . "".((isset($_POST["returns_within_option"]))?$_POST["returns_within_option"]:"")  ."" . "|" . "".((isset($_POST["shipping_cost_paid_by"]))?$_POST["shipping_cost_paid_by"]:"")  ."" . "|" . "".((isset($_POST["shipping_cost_paid_by_option"]))?$_POST["shipping_cost_paid_by_option"]:"")  ."" . "|" . "".((isset($_POST["warranty_duration"]))?$_POST["warranty_duration"]:"")  ."" . "|" . "".((isset($_POST["warranty_duration_option"]))?$_POST["warranty_duration_option"]:"")  ."" . "|" . "".((isset($_POST["warranty_offered"]))?$_POST["warranty_offered"]:"")  ."" . "|" . "".((isset($_POST["warranty_offered_option"]))?$_POST["warranty_offered_option"]:"")  ."" . "|" . "".((isset($_POST["warranty_type"]))?$_POST["warranty_type"]:"")  ."" . "|" . "".((isset($_POST["warranty_type_option"]))?$_POST["warranty_type_option"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|none,none,NULL|none,none,NULL|none,none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
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
<title>Insert transaction_items</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="WADAInsertContainer">
  <form action="transaction_items_Insert.php" method="post" name="WADAInsertForm" id="WADAInsertForm">
    <div class="WADAHeader">Insert Record</div>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <th class="WADADataTableHeader">name:</th>
        <td class="WADADataTableCell"><input type="text" name="name" id="name" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">description:</th>
        <td class="WADADataTableCell"><input type="text" name="description" id="description" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">item_number:</th>
        <td class="WADADataTableCell"><input type="text" name="item_number" id="item_number" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">qty:</th>
        <td class="WADADataTableCell"><input type="text" name="qty" id="qty" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">amount:</th>
        <td class="WADADataTableCell"><input type="text" name="amount" id="amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">tax_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="tax_amount" id="tax_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ebay_item_txn_id:</th>
        <td class="WADADataTableCell"><input type="text" name="ebay_item_txn_id" id="ebay_item_txn_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ebay_item_order_id:</th>
        <td class="WADADataTableCell"><input type="text" name="ebay_item_order_id" id="ebay_item_order_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">url:</th>
        <td class="WADADataTableCell"><input type="text" name="url" id="url" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">end_date:</th>
        <td class="WADADataTableCell"><input type="text" name="end_date" id="end_date" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ebay_title:</th>
        <td class="WADADataTableCell"><input type="text" name="ebay_title" id="ebay_title" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ebay_subtitle:</th>
        <td class="WADADataTableCell"><input type="text" name="ebay_subtitle" id="ebay_subtitle" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">location:</th>
        <td class="WADADataTableCell"><input type="text" name="location" id="location" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">condition:</th>
        <td class="WADADataTableCell"><input type="text" name="condition" id="condition" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">external_picture_url:</th>
        <td class="WADADataTableCell"><input type="text" name="external_picture_url" id="external_picture_url" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">gallery_picture_url:</th>
        <td class="WADADataTableCell"><input type="text" name="gallery_picture_url" id="gallery_picture_url" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">picture_url:</th>
        <td class="WADADataTableCell"><input type="text" name="picture_url" id="picture_url" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">return_policy_description:</th>
        <td class="WADADataTableCell"><input type="text" name="return_policy_description" id="return_policy_description" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">refund:</th>
        <td class="WADADataTableCell"><input type="text" name="refund" id="refund" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">refund_option:</th>
        <td class="WADADataTableCell"><input type="text" name="refund_option" id="refund_option" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">returns_accepted:</th>
        <td class="WADADataTableCell"><input type="text" name="returns_accepted" id="returns_accepted" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">returns_accepted_option:</th>
        <td class="WADADataTableCell"><input type="text" name="returns_accepted_option" id="returns_accepted_option" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">returns_within:</th>
        <td class="WADADataTableCell"><input type="text" name="returns_within" id="returns_within" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">returns_within_option:</th>
        <td class="WADADataTableCell"><input type="text" name="returns_within_option" id="returns_within_option" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">shipping_cost_paid_by:</th>
        <td class="WADADataTableCell"><input type="text" name="shipping_cost_paid_by" id="shipping_cost_paid_by" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">shipping_cost_paid_by_option:</th>
        <td class="WADADataTableCell"><input type="text" name="shipping_cost_paid_by_option" id="shipping_cost_paid_by_option" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">warranty_duration:</th>
        <td class="WADADataTableCell"><input type="text" name="warranty_duration" id="warranty_duration" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">warranty_duration_option:</th>
        <td class="WADADataTableCell"><input type="text" name="warranty_duration_option" id="warranty_duration_option" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">warranty_offered:</th>
        <td class="WADADataTableCell"><input type="text" name="warranty_offered" id="warranty_offered" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">warranty_offered_option:</th>
        <td class="WADADataTableCell"><input type="text" name="warranty_offered_option" id="warranty_offered_option" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">warranty_type:</th>
        <td class="WADADataTableCell"><input type="text" name="warranty_type" id="warranty_type" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">warranty_type_option:</th>
        <td class="WADADataTableCell"><input type="text" name="warranty_type_option" id="warranty_type_option" value="" size="32" /></td>
      </tr>
    </table>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <div class="WADAButtonRow">
      <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Insert" id="Insert" value="Insert" alt="Insert" src="../WA_DataAssist/images/Pacifica/Refined_insert.gif"  /></td>
          <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transaction_items_Results.php" title="Cancel"><img border="0" name="Cancel" id="Cancel" alt="Cancel" src="../WA_DataAssist/images/Pacifica/Refined_cancel.gif" /></a></td>
        </tr>
      </table>
      <input name="WADAInsertRecordID" type="hidden" id="WADAInsertRecordID" value="" />
    </div>
  </form>
</div>
</body>
</html>
