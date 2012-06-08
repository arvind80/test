<?
$sid=$this->session->userdata ( 'session_id' );
$cart_item = array();
$cart_item['sid'] = $sid;
$cart_item['order_completed'] ='n';

$cart_items = $this->cart_model->itemsGet($cart_item);
//var_dump($sid,$cart_items);    
 ?>
<? if(!empty($cart_items)): ?>
<?

$formdata = array();
$formdata ['customercode'] = $this->session->userdata ( 'session_id' );
//$formdata ['amount'] = $this->session->userdata ( 'amount' );
$formdata ['orderno'] = $this->session->userdata ( 'order_id' );
$formdata ['cardholdernumber'] = $this->session->userdata ( 'billing_cardholdernumber' );
$formdata ['expiresmonth'] = $this->session->userdata ( 'billing_expiresmonth' );
$formdata ['expiresyear'] = $this->session->userdata ( 'billing_expiresyear' );
$formdata ['cvv2'] = $this->session->userdata ( 'billing_cvv2' );
$formdata ['bname'] = $this->session->userdata ( 'billing_first_name' ) . ' ' . $this->session->userdata ( 'billing_last_name' );
$formdata ['bemailaddress'] = $this->session->userdata ( 'billing_user_email' );
$formdata ['baddress1'] = $this->session->userdata ( 'billing_address' );
$formdata ['bcity'] = $this->session->userdata ( 'billing_city' );
$formdata ['bstate'] = $this->session->userdata ( 'billing_state' );
$formdata ['bzipcode'] = $this->session->userdata ( 'billing_zip' );
$formdata ['bcountry'] = (strtoupper ( $this->session->userdata ( 'billing_country' ) ));
$formdata ['bphone'] = $this->session->userdata ( 'billing_user_phone' );
$formdata ['sname'] = $this->session->userdata ( 'shipping_first_name' ) . ' ' . $this->session->userdata ( 'shipping_last_name' );
$formdata ['scompany'] = $this->session->userdata ( 'shipping_company_name' );
$formdata ['saddress1'] = $this->session->userdata ( 'shipping_address' );
$formdata ['saddress2'] = $this->session->userdata ( 'shipping_city' ) . ', ' . $this->session->userdata ( 'shipping_zip' );
$formdata ['scity'] = $this->session->userdata ( 'shipping_city' );
$formdata ['sstate'] = $this->session->userdata ( 'shipping_state' );
$formdata ['szipcode'] = $this->session->userdata ( 'shipping_zip' );
$formdata ['sphone'] = $this->session->userdata ( 'shipping_user_phone' );
$formdata ['scountry'] = $this->session->userdata ( 'shipping_state' );
$formdata ['promo_code'] = $this->session->userdata ( 'cart_promo_code' );
$formdata ['amount'] =  $this->session->userdata ( 'amount' ) + $this->session->userdata('shipping_total_charges');
$formdata['shipping_service'] = $this->session->userdata ( 'shipping_service' );
$formdata ['semailaddress'] = $this->session->userdata ( 'shipping_user_email' );
$formdata ['shipping_total_charges'] = $this->session->userdata ( 'shipping_total_charges' );

//$res = $this->core_model->dbQuery("select * from affiliate_users");
//p($formdata);
?>
<style type="text/css">
.checkout_table {
	padding-bottom: 20px;
}
</style>
<div id="content">


 <div id="payment_must_be_ok">

  <div id="in-banner" class="view-cart-baner" style="width: 855px; height: 190px;">
    <div id="products-baner-txt">
      <h2 class="blue-title">Order confirmation</h2>
      <h2 id="products-baner-sub-title"></h2>
      <br />
      <br />
      <p class="richtext"><? print html_entity_decode(html_entity_decode($page['content_body'])); ?></p>
    </div>
  </div>
  <div id="confirm-order-error" style="width: 855px; height: 190px;">
         <h2 class="blue-title">Error</h2><br />
         Your data is incorect! Please, go back to Checkout form and edit your details!
         <div style="height: 12px;">&nbsp;</div>
         <div class="confirm-error-box"></div>
         <div style="height: 12px;">&nbsp;</div>
         <a href="<? print $this->content_model->getContentURLByIdAndCache(48) ; ?>" class="btn">Edit Data</a>
    </div>
  <div style="overflow:hidden;position:relative;zoom:1;width:850px;margin: auto;" id="shop_confirm_wrap">
    <div id="home_head" style="height: auto">
      <!-- /in-banner -->
    </div>
    <? // print $this->cart_model->cartSumByFields('width'); ?>
    <a href="<? print $this->content_model->getContentURLByIdAndCache(39) ; ?>" class="edit-info">Edit your order</a>
    <h2 class="blue-title">What are you about to order?</h2>
    <div id="shipping_price" style="display:none"></div>
    <table id="checkout_table" cellpadding="0" cellspacing="0" width="929px">
      <thead>
        <tr>
          <th>SKU</th>
          <th>Item Name</th>
          <th>Single Item Price</th>
          <th>QTY</th>
          <th>Final Price</th>
        </tr>
      </thead>
      <tbody>
        <? foreach(($cart_items) as $item): 
			$more = false;
 $more = $this->core_model->getCustomFields('table_content', $item['id']);
	$item['custom_fields'] = $more;
		?>
        <tr id="item_row_<? print $item['id'] ?>">
          <td><? print $item['sku'] ?></td>
          <td><? print $item['item_name'] ?></td>
          <td><? $this_item_price = ceil($this->cart_model->currencyConvertPrice($item['price'], $this->session->userdata ( 'shop_currency' ))); ?>
            <div style="float:left"><? print $this->session->userdata ( 'shop_currency_sign' ) ?> &nbsp;</div>
            <div id="single_price_for_cart_item_id_<? print $item['id'] ?>"><? print $this_item_price ?></div></td>
          <td><? print $item['qty'] ?></td>
          <td><? print $this->session->userdata ( 'shop_currency_sign' ) ?> <span id="total_price_for_cart_item_id_<? print $item['id'] ?>"><? print (($item['qty']) * (($this_item_price)) ); ?></span></td>
        </tr>
        <? endforeach; ?>
      </tbody>
    </table>
    <div style="clear: both;height: 15px;">&nbsp;</div>
    <br />
    <div style="clear: both;height: 20px;">&nbsp;</div>
    <br />
    <a href="<? print $this->content_model->getContentURLByIdAndCache(48) ; ?>" class="edit-info">Edit shipping details</a>
    <h2 class="blue-title">Where do we ship the order</h2>
    <div id="shipping_price" style="display:none"></div>
    <table border="0" cellspacing="2" class="checkout_table checkout_confirm_table" cellpadding="0">
      <tr>
        <th scope="row">Shipping names<small></small></th>
        <td><? print  $this->session->userdata ( 'shipping_first_name' ) . ' ' . $this->session->userdata ( 'shipping_last_name' ); ?></td>
      </tr>
      <? $shipping_company_name  = $this->session->userdata ( 'shipping_company_name' ); ?>
      <? if($shipping_company_nam != false): ?>
      <tr>
        <th scope="row">Company name</th>
        <td><? print $shipping_company_name ?></td>
      </tr>
      <? endif; ?>
      <? $shipping_user_email  = $this->session->userdata ( 'shipping_user_email' ); ?>
      <? if($shipping_user_email != false): ?>
      <tr>
        <th scope="row">Shipping email</th>
        <td><? print $shipping_user_email ?></td>
      </tr>
      <? endif; ?>
      <? $shipping_user_phone  = $this->session->userdata ( 'shipping_user_phone' ); ?>
      <? if($shipping_user_phone != false): ?>
      <tr>
        <th scope="row">Shipping Phone</th>
        <td><? print $shipping_user_phone ?></td>
      </tr>
      <? endif; ?>
      <? $shipping_country  = $this->session->userdata ( 'shipping_country' ); ?>
      <? if($shipping_country != false): ?>
      <tr>
        <th scope="row">Shipping Country</th>
        <td><?  $countries = ($this->cart_model->paymentmethods_tpro_get_countries_list_as_array()); ?>
          <? $shipping_country = $this->session->userdata ( 'shipping_country' );
			if($shipping_country == false) {  $shipping_country = 1 ;

			}
			?>
          <? $i=0; foreach($countries as $c => $v):   ?>
          <? if($shipping_country == $c) : ?>
          <? print $v ?>
          <?  endif;?>
          <? $i++; endforeach; ?></td>
      </tr>
      <? endif; ?>
      <? $shipping_city  = $this->session->userdata ( 'shipping_city' ); ?>
      <? if($shipping_city != false): ?>
      <tr>
        <th scope="row">Shipping City</th>
        <td><? print $shipping_city ?></td>
      </tr>
      <? endif; ?>
      <? $shipping_zip  = $this->session->userdata ( 'shipping_zip' ); ?>
      <? if($shipping_zip != false): ?>
      <tr>
        <th scope="row">Shipping Zip</th>
        <td><? print $shipping_zip ?></td>
      </tr>
      <? endif; ?>
    </table>
    <div style="height: 12px;overflow: hidden">&nbsp;</div>
    <a href="<? print $this->content_model->getContentURLByIdAndCache(48) ; ?>" class="edit-info">Edit billing details</a>
    <h2 class="blue-title">Who is going to pay for it?</h2>
    <div id="shipping_price" style="display:none"></div>
    <table border="0" cellspacing="2" class="checkout_table checkout_confirm_table" cellpadding="0" width="98%">
      <tr>
        <th scope="row">Billing names <small>(as on card)</small></th>
        <td><? print $this->session->userdata ( 'billing_first_name' ) ?> <? print $this->session->userdata ( 'billing_last_name' ) ?></td>
      </tr>
      <? $billing_company_name  = $this->session->userdata ( 'billing_company_name' ); ?>
      <? if($billing_company_nam != false): ?>
      <tr>
        <th scope="row">Company name</th>
        <td><? print $billing_company_name ?></td>
      </tr>
      <? endif; ?>
      <? $billing_user_email  = $this->session->userdata ( 'billing_user_email' ); ?>
      <? if($billing_user_email != false): ?>
      <tr>
        <th scope="row">Billing email</th>
        <td><? print $billing_user_email ?></td>
      </tr>
      <? endif; ?>
      <? $billing_user_phone  = $this->session->userdata ( 'billing_user_phone' ); ?>
      <? if($billing_user_phone != false): ?>
      <tr>
        <th scope="row">Billing Phone</th>
        <td><? print $billing_user_phone ?></td>
      </tr>
      <? endif; ?>
      <? $billing_country  = $this->session->userdata ( 'billing_country' ); ?>
      <? if($billing_country != false): ?>
      <tr>
        <th scope="row">Billing Country</th>
        <td><?  $countries = ($this->cart_model->paymentmethods_paypal_get_countries_codes()); ?>
          <? $billing_country = $this->session->userdata ( 'billing_country' );
  //var_dump($billing_country);
			if($billing_country == false) {  
				$billing_country = 'US' ;
			}
			?>
          <? $i=0; foreach($countries as $c => $v):   ?>
          <? if($billing_country == $c) : ?>
          <? print $v ?>
          <?  endif;?>
          <? $i++; endforeach; ?></td>
      </tr>
      <? endif; ?>
      <? $billing_city  = $this->session->userdata ( 'billing_city' ); ?>
      <? if($billing_city != false): ?>
      <tr>
        <th scope="row">Billing City</th>
        <td><? print $billing_city ?></td>
      </tr>
      <? endif; ?>
    </table>
    <div style="height: 12px;overflow: hidden">&nbsp;</div>
    <input type="hidden" id="shipping_country" name="country" value="United States" />
    <table cellpadding="0" cellspacing="3" align="right" id="clsclr">
      <tr>
        <td style="text-align: right;padding-right: 10px;"><strong>Items cost</strong></td>
        <td><strong><? print $this->session->userdata ( 'shop_currency_sign' ) ?> <b><span id="total_price_for_whole_cart"><? print ($this->cart_model->itemsGetTotal(false,$this->session->userdata ( 'shop_currency' ))); ?></span></b>&nbsp; <b><span class="pink_text" id="new_price_for_whole_cart"></span></b></strong></td>
      </tr>
      <? if($this->session->userdata ( 'cart_promo_code' ) != ''):  ?>
      <tr>
        <td style="text-align: right;padding-right: 10px;"><strong>Promo code?</strong></td>
        <td><div class="box" style="width: 120px">
            <input type="text" id="the_promo_code_input" onkeyup="cart_checkPromoCode()" value="<? print $this->session->userdata ( 'cart_promo_code' ); ?>" style="padding: 2px 5px 2px 10px;width: 110px; border:1;background:none; display:none" />
            <? print $this->session->userdata ( 'cart_promo_code' ); ?></div>
          <small><span id="the_promo_code_status" class="pink_text" style="display:none; clear:both"></span></small></td>
      </tr>
      <? endif; ?>
      
      
       <? if($this->session->userdata ( 'shop_shipping_cost' ) != ''):  ?>
      <tr>
        <td style="text-align: right;padding-right: 10px;"><strong>Shipping cost</strong></td>
        <td><? print $this->session->userdata ( 'shop_currency_sign' ) ?> <? print $this->session->userdata ( 'shop_shipping_cost' ); ?> 
         </td>
      </tr>
      <? endif; ?>
      
 
      <tr>
        <td style="text-align: right;padding-right: 10px;"><strong>Total cost</strong></td>
        <td> 
        
      <strong class="red"><? print $this->session->userdata ( 'shop_currency_sign' ) ?> <? print (floatval($this->cart_model->itemsGetTotal($this->session->userdata ( 'cart_promo_code' ),$this->session->userdata ( 'shop_currency' )) +  floatval($this->session->userdata ( 'shop_shipping_cost' )))); ?></strong>
         </td>
      </tr>
    
      
    </table>
  </div>
  <br />
  <div align="center" id="confirm_payment_placeholder" style="padding-top: 25px;"> <a href="javascript: confirmPayment();" class="confirm_payment">&nbsp;</a>
    <div style="height: 7px;overflow: hidden">&nbsp;</div>
    
     
    <a href="<? print $this->content_model->getContentURLByIdAndCache(49) ; ?>">Water for Life USA Policies</a> | 
    <a href="<? print $this->content_model->getContentURLByIdAndCache(48) ; ?>">Back</a> <br />
    <br />
   
    <span class="shipping_price_loading" style="right:250px;left:auto;top:42px;width:30px;height:30px;"></span>
  </div>
  <br />
  <br />
  <br />
</div>

 <div id="payment_is_ok" style="display:none;">

	<div align="center" style="padding-top: 40px;">
		<h2 class="blue-title">Payment Successful</h2>
	    <h2 id="products-baner-sub-title"></h2>
	    <div class="richtext"><p>Your payment has been successfully processed!&nbsp;Thank you for your purchase.&nbsp;You will receive a confirmation email shortly.&nbsp;Now that you&#039;ve purchased our product, have you considered joining our affiliate program?&nbsp; </p></div>

	</div>
	  
	<div align="center" id="confirm_payment_placeholder" style="padding-top: 25px;">
	    <div style="height: 7px;overflow: hidden">&nbsp;</div>
	    <a class="btn" href="http://waterforlifeusa.com/products"><span>Explore more products</span></a>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <a class="btn" href="http://waterforlifeusa.com/home"><span>Back to home</span></a>
	</div>
  

</div> 


</div>
<!-- /#content -->
<? else: ?>
<? include (ACTIVE_TEMPLATE_DIR.'shop_cart_empty.php') ?>
<? endif; ?>
