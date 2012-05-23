<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search transactions</title>
<link href="../WA_DataAssist/styles/Refined_Pacifica.css" rel="stylesheet" type="text/css" />
<link href="../WA_DataAssist/styles/Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="WADASearchContainer">
  <form action="transactions_Results.php" method="get" name="WADASearchForm" id="WADASearchForm">
    <div class="WADAHeader">Search</div>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <table class="WADADataTable" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <th class="WADADataTableHeader">id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_id" id="S_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">creation_timestamp:</th>
        <td class="WADADataTableCell"><input type="text" name="S_creation_timestamp" id="S_creation_timestamp" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">customer_id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_customer_id" id="S_customer_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receiver_email:</th>
        <td class="WADADataTableCell"><input type="text" name="S_receiver_email" id="S_receiver_email" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receiver_id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_receiver_id" id="S_receiver_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">payer_status:</th>
        <td class="WADADataTableCell"><input type="text" name="S_payer_status" id="S_payer_status" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_name:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_name" id="S_ship_to_name" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_street:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_street" id="S_ship_to_street" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_street_2:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_street_2" id="S_ship_to_street_2" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_city:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_city" id="S_ship_to_city" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_state:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_state" id="S_ship_to_state" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_postal_code:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_postal_code" id="S_ship_to_postal_code" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_country_code:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_country_code" id="S_ship_to_country_code" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">invoice_number:</th>
        <td class="WADADataTableCell"><input type="text" name="S_invoice_number" id="S_invoice_number" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">sales_tax:</th>
        <td class="WADADataTableCell"><input type="text" name="S_sales_tax" id="S_sales_tax" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">paypal_timestamp:</th>
        <td class="WADADataTableCell"><input type="text" name="S_paypal_timestamp" id="S_paypal_timestamp" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">paypal_correlation_id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_paypal_correlation_id" id="S_paypal_correlation_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">sender_transaction_id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_sender_transaction_id" id="S_sender_transaction_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receipt_id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_receipt_id" id="S_receipt_id" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">transaction_type:</th>
        <td class="WADADataTableCell"><input type="text" name="S_transaction_type" id="S_transaction_type" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">payment_type:</th>
        <td class="WADADataTableCell"><input type="text" name="S_payment_type" id="S_payment_type" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">amount:</th>
        <td class="WADADataTableCell"><input type="text" name="S_amount" id="S_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">fee_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="S_fee_amount" id="S_fee_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">shipping_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="S_shipping_amount" id="S_shipping_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">handling_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="S_handling_amount" id="S_handling_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">currency_code:</th>
        <td class="WADADataTableCell"><input type="text" name="S_currency_code" id="S_currency_code" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">payment_status:</th>
        <td class="WADADataTableCell"><input type="text" name="S_payment_status" id="S_payment_status" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">ship_to_phone_number:</th>
        <td class="WADADataTableCell"><input type="text" name="S_ship_to_phone_number" id="S_ship_to_phone_number" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">insurance_amount:</th>
        <td class="WADADataTableCell"><input type="text" name="S_insurance_amount" id="S_insurance_amount" value="" size="32" /></td>
      </tr>
      <tr>
        <th class="WADADataTableHeader">receiver_transaction_id:</th>
        <td class="WADADataTableCell"><input type="text" name="S_receiver_transaction_id" id="S_receiver_transaction_id" value="" size="32" /></td>
      </tr>
    </table>
    <div class="WADAHorizLine"><img src="../WA_DataAssist/images/_tx_.gif" alt="" height="1" width="1" border="0" /></div>
    <div class="WADAButtonRow">
      <table class="WADADataNavButtons" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="WADADataNavButtonCell" nowrap="nowrap"><input type="image" name="Search" id="Search" value="Search" alt="Search" src="../WA_DataAssist/images/Pacifica/Refined_search.gif"  /></td>
        </tr>
      </table>
    </div>
  </form>
</div>
</body>
</html>
