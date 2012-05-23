<?php require_once('../Connections/connDB.php'); ?>
<?php
//WA Database Search Include
require_once("../WADbSearch/HelperPHP.php");
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAtransaction_items;
//Searchpage: transaction_items_Search.php;
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
  $WADbSearch1->addComparisonFromEdit("transaction_id","S_transaction_id","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("name","S_name","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("description","S_description","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("item_number","S_item_number","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("qty","S_qty","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("amount","S_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("tax_amount","S_tax_amount","AND","=",1);
  $WADbSearch1->addComparisonFromEdit("ebay_item_txn_id","S_ebay_item_txn_id","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ebay_item_order_id","S_ebay_item_order_id","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("url","S_url","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("end_date","S_end_date","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ebay_title","S_ebay_title","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("ebay_subtitle","S_ebay_subtitle","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("location","S_location","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("condition","S_condition","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("external_picture_url","S_external_picture_url","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("gallery_picture_url","S_gallery_picture_url","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("picture_url","S_picture_url","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("return_policy_description","S_return_policy_description","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("refund","S_refund","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("refund_option","S_refund_option","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("returns_accepted","S_returns_accepted","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("returns_accepted_option","S_returns_accepted_option","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("returns_within","S_returns_within","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("returns_within_option","S_returns_within_option","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("shipping_cost_paid_by","S_shipping_cost_paid_by","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("shipping_cost_paid_by_option","S_shipping_cost_paid_by_option","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("warranty_duration","S_warranty_duration","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("warranty_duration_option","S_warranty_duration_option","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("warranty_offered","S_warranty_offered","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("warranty_offered_option","S_warranty_offered_option","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("warranty_type","S_warranty_type","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("warranty_type_option","S_warranty_type_option","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_transaction_items_Results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_transaction_items_Results"]) && $_SESSION["WADbSearch1_transaction_items_Results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_transaction_items_Results"];
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
$maxRows_WADAtransaction_items = 20;
$pageNum_WADAtransaction_items = 0;
if (isset($_GET['pageNum_WADAtransaction_items'])) {
  $pageNum_WADAtransaction_items = $_GET['pageNum_WADAtransaction_items'];
}
$startRow_WADAtransaction_items = $pageNum_WADAtransaction_items * $maxRows_WADAtransaction_items;

mysql_select_db($database_connDB, $connDB);
$query_WADAtransaction_items = "SELECT id, creation_timestamp, transaction_id, name, item_number, qty, amount FROM transaction_items ORDER BY id DESC";
setQueryBuilderSource($query_WADAtransaction_items,$WADbSearch1,false);
$query_limit_WADAtransaction_items = sprintf("%s LIMIT %d, %d", $query_WADAtransaction_items, $startRow_WADAtransaction_items, $maxRows_WADAtransaction_items);
$WADAtransaction_items = mysql_query($query_limit_WADAtransaction_items, $connDB) or die(mysql_error());
$row_WADAtransaction_items = mysql_fetch_assoc($WADAtransaction_items);

if (isset($_GET['totalRows_WADAtransaction_items'])) {
  $totalRows_WADAtransaction_items = $_GET['totalRows_WADAtransaction_items'];
} else {
  $all_WADAtransaction_items = mysql_query($query_WADAtransaction_items);
  $totalRows_WADAtransaction_items = mysql_num_rows($all_WADAtransaction_items);
}
$totalPages_WADAtransaction_items = ceil($totalRows_WADAtransaction_items/$maxRows_WADAtransaction_items)-1;
?>
<?php
$queryString_WADAtransaction_items = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAtransaction_items") == false && 
        stristr($param, "totalRows_WADAtransaction_items") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAtransaction_items = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAtransaction_items = sprintf("&totalRows_WADAtransaction_items=%d%s", $totalRows_WADAtransaction_items, $queryString_WADAtransaction_items);
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
<title>Results transaction_items</title>
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
  <?php if ($totalRows_WADAtransaction_items > 0) { // Show if recordset not empty ?>
    <div class="WADAResults">
      <div class="WADAResultsNavigation">
        <div class="WADAResultsCount">Records
          <?php echo ($startRow_WADAtransaction_items + 1) ?>
          to
          <?php echo min($startRow_WADAtransaction_items + $maxRows_WADAtransaction_items, $totalRows_WADAtransaction_items) ?>
          of
          <?php echo $totalRows_WADAtransaction_items ?>
        </div>
        <div class="WADAResultsNavTop">
          <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
            <tr valign="middle">
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, 0, $queryString_WADAtransaction_items); ?>" title="First"><img border="0" name="First" id="First" alt="First" src="../WA_DataAssist/images/Pacifica/Refined_first.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, max(0, $pageNum_WADAtransaction_items - 1), $queryString_WADAtransaction_items); ?>" title="Previous"><img border="0" name="Previous" id="Previous" alt="Previous" src="../WA_DataAssist/images/Pacifica/Refined_previous.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items < $totalPages_WADAtransaction_items) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, min($totalPages_WADAtransaction_items, $pageNum_WADAtransaction_items + 1), $queryString_WADAtransaction_items); ?>" title="Next"><img border="0" name="Next" id="Next" alt="Next" src="../WA_DataAssist/images/Pacifica/Refined_next.gif" /></a>
              <?php } // Show if not last page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items < $totalPages_WADAtransaction_items) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, $totalPages_WADAtransaction_items, $queryString_WADAtransaction_items); ?>" title="Last"><img border="0" name="Last" id="Last" alt="Last" src="../WA_DataAssist/images/Pacifica/Refined_last.gif" /></a>
              <?php } // Show if not last page ?></td>
            </tr>
          </table>
        </div>
        <div class="WADAResultsInsertButton"> <a href="transaction_items_Insert.php" title="Insert"><img border="0" name="Insert" id="Insert" alt="Insert" src="../WA_DataAssist/images/Pacifica/Refined_insert.gif" /></a> </div>
      </div>
      <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <th class="WADAResultsTableHeader">id:</th>
          <th class="WADAResultsTableHeader">creation_timestamp:</th>
          <th class="WADAResultsTableHeader">transaction_id:</th>
          <th class="WADAResultsTableHeader">name:</th>
          <th class="WADAResultsTableHeader">item_number:</th>
          <th class="WADAResultsTableHeader">qty:</th>
          <th class="WADAResultsTableHeader">amount:</th>
          <th>&nbsp;</th>
        </tr>
        <?php do { ?>
          <tr class="<?php echo $WARRT_AltClass1->getClass(true); ?>">
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransaction_items['id']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransaction_items['creation_timestamp']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransaction_items['transaction_id']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransaction_items['name']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransaction_items['item_number']); ?></td>
            <td class="WADAResultsTableCell"><?php echo($row_WADAtransaction_items['qty']); ?></td>
            <td class="WADAResultsTableCell"><?php echo('$'.number_format($row_WADAtransaction_items['amount'],2)); ?></td>
            <td class="WADAResultsEditButtons" nowrap="nowrap"><table class="WADAEditButton_Table">
              <tr>
                <td><a href="transaction_items_Detail.php?id=<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" title="View"><img border="0" name="View<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" id="View<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" alt="View" src="../WA_DataAssist/images/Pacifica/Refined_zoom.gif" /></a></td>
                <td><a href="transaction_items_Update.php?id=<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" title="Update"><img border="0" name="Update<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" id="Update<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" alt="Update" src="../WA_DataAssist/images/Pacifica/Refined_edit.gif" /></a></td>
                <td><a href="transaction_items_Delete.php?id=<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" title="Delete"><img border="0" name="Delete<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" id="Delete<?php echo(rawurlencode($row_WADAtransaction_items['id'])); ?>" alt="Delete" src="../WA_DataAssist/images/Pacifica/Refined_trash.gif" /></a></td>
              </tr>
            </table></td>
          </tr>
        <?php } while ($row_WADAtransaction_items = mysql_fetch_assoc($WADAtransaction_items)); ?>
      </table>
      <div class="WADAResultsNavigation">
        <div class="WADAResultsCount">Records
          <?php echo ($startRow_WADAtransaction_items + 1) ?>
          to
          <?php echo min($startRow_WADAtransaction_items + $maxRows_WADAtransaction_items, $totalRows_WADAtransaction_items) ?>
          of
          <?php echo $totalRows_WADAtransaction_items ?>
        </div>
        <div class="WADAResultsNavBottom">
          <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
            <tr valign="middle">
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, 0, $queryString_WADAtransaction_items); ?>" title="First"><img border="0" name="First1" id="First1" alt="First" src="../WA_DataAssist/images/Pacifica/Refined_first.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, max(0, $pageNum_WADAtransaction_items - 1), $queryString_WADAtransaction_items); ?>" title="Previous"><img border="0" name="Previous1" id="Previous1" alt="Previous" src="../WA_DataAssist/images/Pacifica/Refined_previous.gif" /></a>
              <?php } // Show if not first page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items < $totalPages_WADAtransaction_items) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, min($totalPages_WADAtransaction_items, $pageNum_WADAtransaction_items + 1), $queryString_WADAtransaction_items); ?>" title="Next"><img border="0" name="Next1" id="Next1" alt="Next" src="../WA_DataAssist/images/Pacifica/Refined_next.gif" /></a>
              <?php } // Show if not last page ?></td>
              <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtransaction_items < $totalPages_WADAtransaction_items) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_WADAtransaction_items=%d%s", $currentPage, $totalPages_WADAtransaction_items, $queryString_WADAtransaction_items); ?>" title="Last"><img border="0" name="Last1" id="Last1" alt="Last" src="../WA_DataAssist/images/Pacifica/Refined_last.gif" /></a>
              <?php } // Show if not last page ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_WADAtransaction_items == 0) { // Show if recordset empty ?>
    <div class="WADANoResults">
      <div class="WADANoResultsMessage">No results for your search</div>
      <div> <a href="transaction_items_Insert.php" title="Insert"><img border="0" name="Insert1" id="Insert1" alt="Insert" src="../WA_DataAssist/images/Pacifica/Refined_insert.gif" /></a> </div>
    </div>
  <?php } // Show if recordset empty ?>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtransaction_items);
?>
