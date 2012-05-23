<?php require_once('../Connections/connDB.php'); ?>
<?php
//WA Database Search Include
require_once("../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAtransactions;
//Searchpage: transactions_Search.php;
//Form: WADASearchForm;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if ((isset($_GET["Search_x"]) && $_GET["Search_x"] != "")) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromEdit("id","S_id","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("creation_timestamp","S_creation_timestamp","AND","=",2);
  $WADbSearch1->addComparisonFromEdit("customer_id","S_customer_id","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("receiver_email","S_receiver_email","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("receiver_id","S_receiver_id","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("payer_status","S_payer_status","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_name","S_ship_to_name","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_street","S_ship_to_street","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_street_2","S_ship_to_street_2","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_city","S_ship_to_city","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_state","S_ship_to_state","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_postal_code","S_ship_to_postal_code","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_country_code","S_ship_to_country_code","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("invoice_number","S_invoice_number","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("sales_tax","S_sales_tax","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("paypal_timestamp","S_paypal_timestamp","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("paypal_correlation_id","S_paypal_correlation_id","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("sender_transaction_id","S_sender_transaction_id","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("receipt_id","S_receipt_id","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("transaction_type","S_transaction_type","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("payment_type","S_payment_type","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("amount","S_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("fee_amount","S_fee_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("shipping_amount","S_shipping_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("handling_amount","S_handling_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("currency_code","S_currency_code","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("payment_status","S_payment_status","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ship_to_phone_number","S_ship_to_phone_number","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("insurance_amount","S_insurance_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("receiver_transaction_id","S_receiver_transaction_id","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_transactions_Results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_transactions_Results"]) && $_SESSION["WADbSearch1_transactions_Results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_transactions_Results"];
    }
    else     {
      $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
    }
  }
  else     {
    $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
  }
}
$WADbSearch1->whereClause = str_replace("\\''", "''", $WADbSearch1->whereClause);
$WADbSearch1whereClause = '';
?>
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
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$maxRows_WADAtransactions = 20;
$pageNum_WADAtransactions = 0;
if (isset($_GET['pageNum_WADAtransactions'])) {
  $pageNum_WADAtransactions = $_GET['pageNum_WADAtransactions'];
}
$startRow_WADAtransactions = $pageNum_WADAtransactions * $maxRows_WADAtransactions;

mysql_select_db($database_connDB, $connDB);
$query_WADAtransactions = "SELECT id, creation_timestamp, customer_id, receiver_email, receiver_id, invoice_number, sales_tax, paypal_timestamp, sender_transaction_id, transaction_type, payment_type, amount, payment_status, receiver_transaction_id FROM transactions ORDER BY id DESC";
setQueryBuilderSource($query_WADAtransactions,$WADbSearch1,false);
$query_limit_WADAtransactions = sprintf("%s LIMIT %d, %d", $query_WADAtransactions, $startRow_WADAtransactions, $maxRows_WADAtransactions);
$WADAtransactions = mysql_query($query_limit_WADAtransactions, $connDB) or die(mysql_error());
$row_WADAtransactions = mysql_fetch_assoc($WADAtransactions);

if (isset($_GET['totalRows_WADAtransactions'])) {
  $totalRows_WADAtransactions = $_GET['totalRows_WADAtransactions'];
} else {
  $all_WADAtransactions = mysql_query($query_WADAtransactions);
  $totalRows_WADAtransactions = mysql_num_rows($all_WADAtransactions);
}
$totalPages_WADAtransactions = ceil($totalRows_WADAtransactions/$maxRows_WADAtransactions)-1;
?>
<?php
$queryString_WADAtransactions = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAtransactions") == false && 
        stristr($param, "totalRows_WADAtransactions") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAtransactions = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAtransactions = sprintf("&totalRows_WADAtransactions=%d%s", $totalRows_WADAtransactions, $queryString_WADAtransactions);
?>
<?php
//WA AltClass Iterator
class WA_AltClassIterator     {
  var $DisplayIndex;
  var $DisplayArray;
  
  function WA_AltClassIterator($theDisplayArray = array(1)) {
    $this->ClassCounter = 0;
    $this->ClassArray   = $theDisplayArray;
  }
  
  function getClass($incrementClass)  {
    if (sizeof($this->ClassArray) == 0) return "";
  	if ($incrementClass) {
      if ($this->ClassCounter >= sizeof($this->ClassArray)) $this->ClassCounter = 0;
      $this->ClassCounter++;
    }
    if ($this->ClassCounter > 0)
      return $this->ClassArray[$this->ClassCounter-1];
    else
      return $this->ClassArray[0];
  }
}
?><?php
//WA Alternating Class
$WARRT_AltClass1 = new WA_AltClassIterator(explode("|", "WADAResultsRowDark|"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Results transactions</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.WADAResultsNavigation {
	padding-top: 5px;
	padding-bottom: 10px;
}
.WADAResultsCount {
	font-size: 11px;
}
.WADAResultsNavTop, .WADAResultsInsertButton {
	clear: none;
}
.WADAResultsNavTop {
	width: 60%;
	float: left;
}
.WADAResultsInsertButton {
	width: 30%;
	float: right;
	text-align: right;
}
.WADAResultsNavButtonCell, .WADAResultsInsertButton {
	padding: 2px;
}
.WADAResultsTable {
	font-size: 11px;
	clear: both;
	padding-top: 1px;
	padding-bottom: 1px;
}

.WADAResultsTableHeader, .WADAResultsTableCell {
	padding: 3px;
	text-align: left;
}

.WADAResultsTableHeader {
	padding-left: 12px;
	padding-right: 12px;
}

.WADAResultsTableCell {
	padding-left: 14px;
	padding-right: 14px;
}

.WADAResultsTableCell {
	border-left: 1px solid #BABDC2;
}

.WADAResultsEditButtons {
	border-left: 1px solid #BABDC2;
	border-right: 1px solid #BABDC2;
}

.WADAResultsRowDark {
	background-color: #DFE4E9;
}
</style>
</head>

<body>


<div class="WADAResultsContainer"> <a name="top"></a>
  <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
  <?php if ($totalRows_WADAtransactions > 0) { // Show if recordset not empty ?>
    <div class="WADAResults">
      <div class="WADAResultsNavigation">
        <div class="WADAResultsCount">Records
          <?php echo ($startRow_WADAtransactions + 1) ?>
          to
          <?php echo min($startRow_WADAtransactions + $maxRows_WADAtransactions, $totalRows_WADAtransactions) ?>
          of
          <?php echo $totalRows_WADAtransactions ?>
        </div>
        <div class="WADAResultsNavTop">
          <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
            <tr valign="middle">
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, 0, $queryString_WADAtransactions); ?>" title="First"><img border="0" name="First" id="First" alt="First" src="../WA_DataAssist/images/Pacifica/Refined_first.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, max(0, $pageNum_WADAtransactions - 1), $queryString_WADAtransactions); ?>" title="Previous"><img border="0" name="Previous" id="Previous" alt="Previous" src="../WA_DataAssist/images/Pacifica/Refined_previous.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions < $totalPages_WADAtransactions) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, min($totalPages_WADAtransactions, $pageNum_WADAtransactions + 1), $queryString_WADAtransactions); ?>" title="Next"><img border="0" name="Next" id="Next" alt="Next" src="../WA_DataAssist/images/Pacifica/Refined_next.gif" /></a>
              <?php } // Show if not last page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions < $totalPages_WADAtransactions) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, $totalPages_WADAtransactions, $queryString_WADAtransactions); ?>" title="Last"><img border="0" name="Last" id="Last" alt="Last" src="../WA_DataAssist/images/Pacifica/Refined_last.gif" /></a>
              <?php } // Show if not last page ?></td>
            </tr>
          </table>
        </div>
        <div class="WADAResultsInsertButton"> <a href="transactions_Insert.php" title="Insert"><img border="0" name="Insert" id="Insert" alt="Insert" src="../WA_DataAssist/images/Pacifica/Refined_insert.gif" /></a> </div>
      </div>
      <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <th class="WADAResultsTableHeader">id:</th>
          <th class="WADAResultsTableHeader">creation_timestamp:</th>
          <th class="WADAResultsTableHeader">paypal_timestamp:</th>
          <th class="WADAResultsTableHeader">customer_id:</th>
          <th class="WADAResultsTableHeader">receiver_email:</th>
          <th class="WADAResultsTableHeader">invoice_number:</th>
          <th class="WADAResultsTableHeader">sales_tax:</th>
          <th class="WADAResultsTableHeader">sender_transaction_id:</th>
          <th class="WADAResultsTableHeader">receiver_transaction_id:</th>
          <th class="WADAResultsTableHeader">amount:</th>
          <th class="WADAResultsTableHeader">payment_status:</th>
          <th>&nbsp;</th>
        </tr>
        <?php do { ?>
          <tr class="<?php echo $WARRT_AltClass1->getClass(true); ?>">
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['id']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['creation_timestamp']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['paypal_timestamp']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['customer_id']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['receiver_email']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['invoice_number']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['sales_tax']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['sender_transaction_id']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['receiver_transaction_id']); ?></td>
            <td class="WADAResultsTableCell"><?php echo('$'.number_format($row_WADAtransactions['amount'],2)); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransactions['payment_status']); ?></td>
            <td class="WADAResultsEditButtons" nowrap="nowrap"><table class="WADAEditButton_Table">
              <tr>
                <td><a href="transactions_Detail.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" title="View"><img border="0" name="View<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" id="View<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" alt="View" src="../WA_DataAssist/images/Pacifica/Refined_zoom.gif" /></a></td>
                <td><a href="transactions_Update.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" title="Update"><img border="0" name="Update<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" id="Update<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" alt="Update" src="../WA_DataAssist/images/Pacifica/Refined_edit.gif" /></a></td>
                <td><a href="transactions_Delete.php?id=<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" title="Delete"><img border="0" name="Delete<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" id="Delete<?php echo(rawurlencode($row_WADAtransactions['id'])); ?>" alt="Delete" src="../WA_DataAssist/images/Pacifica/Refined_trash.gif" /></a></td>
                </tr>
            </table></td>
          </tr>
        <?php } while ($row_WADAtransactions = mysql_fetch_assoc($WADAtransactions)); ?>
      </table>
      <div class="WADAResultsNavigation">
        <div class="WADAResultsCount">Records
          <?php echo ($startRow_WADAtransactions + 1) ?>
          to
          <?php echo min($startRow_WADAtransactions + $maxRows_WADAtransactions, $totalRows_WADAtransactions) ?>
          of
          <?php echo $totalRows_WADAtransactions ?>
        </div>
        <div class="WADAResultsNavBottom">
          <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
            <tr valign="middle">
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, 0, $queryString_WADAtransactions); ?>" title="First"><img border="0" name="First1" id="First1" alt="First" src="../WA_DataAssist/images/Pacifica/Refined_first.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, max(0, $pageNum_WADAtransactions - 1), $queryString_WADAtransactions); ?>" title="Previous"><img border="0" name="Previous1" id="Previous1" alt="Previous" src="../WA_DataAssist/images/Pacifica/Refined_previous.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions < $totalPages_WADAtransactions) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, min($totalPages_WADAtransactions, $pageNum_WADAtransactions + 1), $queryString_WADAtransactions); ?>" title="Next"><img border="0" name="Next1" id="Next1" alt="Next" src="../WA_DataAssist/images/Pacifica/Refined_next.gif" /></a>
              <?php } // Show if not last page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransactions < $totalPages_WADAtransactions) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransactions=%d%s", $currentPage, $totalPages_WADAtransactions, $queryString_WADAtransactions); ?>" title="Last"><img border="0" name="Last1" id="Last1" alt="Last" src="../WA_DataAssist/images/Pacifica/Refined_last.gif" /></a>
              <?php } // Show if not last page ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_WADAtransactions == 0) { // Show if recordset empty ?>
    <div class="WADANoResults">
      <div class="WADANoResultsMessage">No results for your search</div>
      <div> <a href="transactions_Insert.php" title="Insert"><img border="0" name="Insert1" id="Insert1" alt="Insert" src="../WA_DataAssist/images/Pacifica/Refined_insert.gif" /></a> </div>
    </div>
  <?php } // Show if recordset empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtransactions);
?>
