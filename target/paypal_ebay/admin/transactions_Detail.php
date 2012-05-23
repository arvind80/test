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
$Paramid_WADAtransactions = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAtransactions = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
$ParamSessionid_WADAtransactions = "-1";
if (isset($_SESSION['WADA_Insert_transactions'])) {
  $ParamSessionid_WADAtransactions = (get_magic_quotes_gpc()) ? $_SESSION['WADA_Insert_transactions'] : addslashes($_SESSION['WADA_Insert_transactions']);
}
$Paramid2_WADAtransactions = "-1";
if (isset($_GET['id'])) {
  $Paramid2_WADAtransactions = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connDB, $connDB);
$query_WADAtransactions = sprintf("SELECT id, creation_timestamp, customer_id, receiver_email, receiver_id, payer_status, ship_to_name, ship_to_street, ship_to_street_2, ship_to_city, ship_to_state, ship_to_postal_code, ship_to_country_code, invoice_number, sales_tax, paypal_timestamp, paypal_correlation_id, sender_transaction_id, receipt_id, transaction_type, payment_type, amount, fee_amount, shipping_amount, handling_amount, currency_code, payment_status, ship_to_phone_number, insurance_amount, receiver_transaction_id FROM transactions WHERE id = %s OR ( -1= %s AND id= %s)", GetSQLValueString($Paramid_WADAtransactions, "int"),GetSQLValueString($Paramid2_WADAtransactions, "int"),GetSQLValueString($ParamSessionid_WADAtransactions, "int"));
$WADAtransactions = mysql_query($query_WADAtransactions, $connDB) or die(mysql_error());
$row_WADAtransactions = mysql_fetch_assoc($WADAtransactions);
$totalRows_WADAtransactions = mysql_num_rows($WADAtransactions);

$varTransactionID_rsTransactionItems = "-1";
if (isset($row_WADAtransactions['id'])) {
  $varTransactionID_rsTransactionItems = (get_magic_quotes_gpc()) ? $row_WADAtransactions['id'] : addslashes($row_WADAtransactions['id']);
}
mysql_select_db($database_connDB, $connDB);
$query_rsTransactionItems = sprintf("SELECT transaction_items.name, transaction_items.`description`, transaction_items.item_number, transaction_items.qty, transaction_items.amount, transaction_items.ebay_item_txn_id, transaction_items.ebay_item_order_id, transaction_items.url, transaction_items.ebay_title, transaction_items.picture_url, transaction_items.id FROM transaction_items WHERE transaction_items.transaction_id = %s", GetSQLValueString($varTransactionID_rsTransactionItems, "int"));
$rsTransactionItems = mysql_query($query_rsTransactionItems, $connDB) or die(mysql_error());
$row_rsTransactionItems = mysql_fetch_assoc($rsTransactionItems);
$totalRows_rsTransactionItems = mysql_num_rows($rsTransactionItems);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Details transactions</title>
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
  <?php if ($totalRows_WADAtransactions > 0) { // Show if recordset not empty ?>
    <div id="WADADetails">
      <div class="WADAHeader">Details</div>
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
        <?php
		if($totalRows_rsTransactionItems > 0)
		{
		?>
        <tr>
          <th valign="top" class="WADADataTableHeader"> Items</th>
          <td class="WADADataTableCell"><table width="500" border="1" cellspacing="1" cellpadding="1">
            <tr>
              <td width="75">&nbsp;</td>
              <td width="172"><strong>name</strong></td>
              <td width="105"><strong>item_number</strong></td>
              <td width="36"><strong>qty</strong></td>
              <td width="84"><strong>amount</strong></td>
              </tr>
            <?php do { ?>
              <tr>
                <td valign="top"><img src="../images/<?php echo $row_rsTransactionItems['id']; ?>-picture_url.jpg" width="75" /></td>
                <td valign="top"><a href="transaction_items_Detail.php?id=<?php echo $row_rsTransactionItems['id']; ?>"><?php echo $row_rsTransactionItems['name']; ?></a></td>
                <td valign="top"><?php echo $row_rsTransactionItems['item_number']; ?></td>
                <td valign="top"><?php echo $row_rsTransactionItems['qty']; ?></td>
                <td valign="top"><?php echo '$'.number_format($row_rsTransactionItems['amount'],2); ?></td>
              </tr>
              <?php } while ($row_rsTransactionItems = mysql_fetch_assoc($rsTransactionItems)); ?>
          </table></td>
        </tr>
        <?php
		}
		?>
      </table>
      <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
      <div class="WADAButtonRow">
        <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transactions_Update.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" title="Update"><img border="0" name="Update" id="Update" alt="Update" src="../WA_DataAssist/images/Pacifica/Refined_update.gif" /></a></td>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transactions_Delete.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" title="Delete"><img border="0" name="Delete" id="Delete" alt="Delete" src="../WA_DataAssist/images/Pacifica/Refined_delete.gif" /></a></td>
            <td class="WADADataNavButtonCell" nowrap="nowrap"><a href="transactions_Results.php" title="Results"><img border="0" name="Results" id="Results" alt="Results" src="../WA_DataAssist/images/Pacifica/Refined_results.gif" /></a></td>
          </tr>
        </table>
      </div>
    </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_WADAtransactions == 0) { // Show if recordset empty ?>
    <div class="WADANoResults">
      <div class="WADANoResultsMessage">No record found.</div>
    </div>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <div class="WADADetailsLinkArea">
      <div class="WADADataNavButtonCell"><a href="transactions_Results.php" title="Results"><img border="0" name="Results1" id="Results1" alt="Results" src="../WA_DataAssist/images/Pacifica/Refined_results.gif" /></a></div>
    </div>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
  <?php } // Show if recordset empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtransactions);

mysql_free_result($rsTransactionItems);
?>
