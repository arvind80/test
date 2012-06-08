<?
//p($_COOKIE, 1);
$sid=$this->session->userdata ( 'session_id' );
$cart_item = array();
$cart_item['sid'] = $sid;
$cart_item['order_completed'] ='n';

$cart_items = $this->cart_model->itemsGet($cart_item);
//var_dump($sid,$cart_items);    
 ?>
<? if(!empty($cart_items)): ?>

<div id="content" style="min-height: 717px;">
  <div style="width:850px;margin: auto">
    <div id="home_head" style="height: auto">
      <div id="in-banner" class="view-cart-baner" style="width: 930px;height: 190px;">
        <script type="text/javascript">
                            $(function(){
                                    //FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'21' }));
                                    FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'28' }));


                            $("#checkout_table th").each(function(){
                                 FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'007AC0', cSize:'14' }));
                            })

                            });
                        </script>
        <div id="products-baner-txt">
          <h2 class="blue-title">View cart</h2>
          <h2 id="products-baner-sub-title"></h2>
          <br />
          <br />
          <p><? print html_entity_decode(html_entity_decode($page['content_body'])); ?></p>
        </div>
      </div>
      <!-- /in-banner -->
    </div>
    <? // print $this->cart_model->cartSumByFields('width'); ?>
    <h2>View cart</h2>
    <div id="shipping_price" style="display:none"></div>
    <table id="checkout_table" cellpadding="0" cellspacing="0" width="929px">
      <thead>
        <tr>
          <th>SKU</th>
          <th>Item Name</th>
          <th>Single Item Price</th>
          <th>QTY</th>
          <th>Final Price</th>
          <th>Remove</th>
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
          <td><? $this_item_price = $item['price']; /*ceil($this->cart_model->currencyConvertPrice($item['price'], $this->session->userdata ( 'shop_currency' )));*/ ?>
            <div style="float:left"><? print $this->session->userdata ( 'shop_currency_sign' ) ?> &nbsp;</div>
            <div id="single_price_for_cart_item_id_<? print $item['id'] ?>"><? print $this_item_price ?></div></td>
          <td><select name="qty" id="qty_for_cart_item_id_<? print $item['id'] ?>" onchange="cart_modify_item_properties('<? print $item['id'] ?>', 'qty', this.value);">
              <? for ($x = 1; $x <= 100; $x++) : ?>
              <option  <? if($item['qty'] == $x): ?> value="<? print $x; ?>" selected="selected" <? endif; ?>  ><? print $x; ?></option>
              <? endfor; ?>
            </select></td>
          <td><? print $this->session->userdata ( 'shop_currency_sign' ) ?> <span id="total_price_for_cart_item_id_<? print $item['id'] ?>"><? print (($item['qty']) * (($this_item_price)) ); ?></span></td>
          <td><a title="Remove from bag" href="javascript:cart_remove_item_from_cart(<? print $item['id'] ?>);" class="small_btn"><img src="<? print TEMPLATE_URL; ?>img/clearp.jpg" alt="Remove"  /></a></td>
        </tr>
        <? endforeach; ?>
      </tbody>
    </table>
    <div style="clear: both;height: 15px;">&nbsp;</div>
    <input type="hidden" id="shipping_country" name="country" value="United States" />
    <table cellpadding="0" cellspacing="3" align="right" id="clsclr">
      <tr>
        <td style="text-align: right;padding-right: 10px;"><strong>Total</strong></td>
        <td><strong class="red"><? print $this->session->userdata ( 'shop_currency_sign' ) ?> <b><span id="total_price_for_whole_cart"><? print ($this->cart_model->itemsGetTotal(false,$this->session->userdata ( 'shop_currency' ))); ?></span></b>&nbsp; <b><span class="pink_text" id="new_price_for_whole_cart"></span></b> </strong></td>
      </tr>
      <tr>
        <td style="text-align: right;padding-right: 10px;"><strong>Promo code?</strong></td>
        <td><div class="box" style="width: 120px">
            <input type="text" id="the_promo_code_input" onkeyup="cart_checkPromoCode()" value="<? print $this->session->userdata ( 'cart_promo_code' ); ?>" style="padding: 2px 5px 2px 10px;width: 110px; border:1;background:none;" />
          </div>
          <small><span id="the_promo_code_status" class="pink_text" style="display:none; clear:both"></span></small></td>
      </tr>
    </table>
    <br />
    <div style="clear: both;height: 20px;">&nbsp;</div>
    <a href="<? print $this->content_model->getContentURLById(2) ; ?>" class="btn left" style="margin-right:30px;">Shop for more</a> <a href="<? print $this->content_model->getContentURLById(48) ; ?>" class="btn right" style="margin-right:30px;"> Continue to checkout</a> </div>
  <br />
  <br />
  <br />
  <br />
</div>
<!-- /#content -->

<? else: ?>
<? include (ACTIVE_TEMPLATE_DIR.'shop_cart_empty.php') ?>
<? endif; ?>
