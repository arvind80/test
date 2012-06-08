<?
$sid=$this->session->userdata ( 'session_id' );
$cart_item = array();
$cart_item['sid'] = $sid;
$cart_item['order_completed'] ='n';

$cart_items = $this->cart_model->itemsGet($cart_item);
//echo "<pre>";print_r($cart_items);echo"</pre>";
//var_dump($sid,$cart_items);
//print $this->core_model->optionsGetByKey ( 'paypal_environment' );
$order_id = "WFL". date("ymdHis") . rand ();

 ?>
<? if(empty($cart_items)): ?>
<? include (ACTIVE_TEMPLATE_DIR.'shop_cart_empty.php') ?>
<? else: ?>


<style type="text/css">
    .mtf label{
      float: left;
      width:155px;
      padding-right: 5px;
    }
    .mtf label small{
      white-space: nowrap;
    }


    form#step2 .mtf{
      float: none;
      width: auto;
      overflow: hidden;
      zoom:1;
    }

    #stepper-wrap{
      width:850px;
    }
    #shop-step-1{
      float: none;
      width: auto;
      margin: 0;
    }
    #o-info{
      width: 405px;
      float: right;
    }
    .info-errors-object{
      width:400px;
      float: left;
      clear: none;
    }

    form#step2 input{
      padding: 3px;
    }

    .mtf label{
      margin-top: 2px;
    }
    .xblue-title{
      color: #0687D6;
      font-size: 24px;
    }

    #o-info .shipping_price_loading{
      background-color:#E9F2F9;
      background-position: center;
    }



</style>	
<form method="post" action="<? print $this->content_model->getContentURLByIdAndCache(99) ; ?>" class="validate show-error-fields" id="step2" style="width: 485px;float: left">
  <input name="autoreply" type="hidden"  value="autoreply_order" />
  <input type="hidden" name="currency_code" value="<? print $this->session->userdata ( 'shop_currency_code' ) ?>">
  <input type="hidden" name="shipping" id="payment_form_shipping" value="">
  <input type="hidden" name="amount" class="billing_info_trigger" value="<? print ($this->cart_model->itemsGetTotal(false,$this->session->userdata ( 'shop_currency' ))); ?>">
  <input type="hidden" name="promo_code" id="the_promo_code_input" value="<? print ($this->session->userdata ( 'cart_promo_code' )); ?>">
  <input type="hidden" name="order_id" class="billing_info_trigger" value="<? print $order_id; ?>">
  <?  $this->session->set_userdata ( 'order_id' ,$order_id); ?>
  <? /*
  <div id="home_head" style="height: auto">
    <div id="in-banner" class="product-baner">
      <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'21' }));
                                    FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'28' }));


                            $("#checkout_table th").each(function(){
                                 FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'007AC0', cSize:'14' }));
                            });

                         //   document.getElementById('shachk').checked=true;


                              if(window.location.href.indexOf('#billing-details')!=-1){
								  populateBillingInfo();
                                   $("#go-to-step-2").click();
                              }
                              if(window.location.href.indexOf('#send-order')!=-1){
                                   $("#go-to-step-3").click();
                              }
                            });
                        </script>
      <div id="products-baner-txt">
        <h1 id="products-baner-title">Water for life</h1>
        <h2 id="products-baner-sub-title"></h2>
        <p>Water is not just some colorless and tasteless one dimensional liquid; on the contrary, life on earth originated from water, and all life forms depend on water to sustain them, therefore water is the fundamental foundation and source of eternal life on earth. <strong>Dr. Kim Young Kwi</strong>.</p>
      </div>
    </div>
    <!-- /in-banner -->
  </div>
  */ ?>
  <div style="height: 45px">&nbsp;</div>
  <div id="content">
    <div style="width:850px;margin: auto">
    
    <? print html_entity_decode(html_entity_decode($page['content_body'])); ?>
     <br />
  <div class="mwdisable" style="position:relative"> <a class="btn" href="http://waterforlifeusa.com/paypal">Checkout with paypal</a></div>
      <h2 class="xblue-title">Checkout</h2>
      <br />
      <p style="padding: 3px 0pt 6px;">Please fill out all required fields.</p>
      <!--<ul class="steplist">
        <li><a href="#" id="go-to-step-1" class="active"><strong>1</strong> <span>- Shipping Details</span></a></li>
        <li><a href="#"  onclick="populateBillingInfo();" id="go-to-step-2"><strong>2</strong> <span>- Billing Details</span></a></li>
        <li style="margin-right: 0"><a href="#" id="go-to-step-3"><strong>3</strong> <span>- Send Order</span></a></li>
      </ul>-->
 <br /> <br />
      <div id="stepper-wrap">
        <div class="state-1">
          <div id="shop-step-1" class="the_step">
            <? include (ACTIVE_TEMPLATE_DIR.'shop_shipping_details.php') ?>
          <!--</div>-->
          <!-- /shop-step-1 -->
          <!--<div id="shop-step-2" class="the_step">-->
          <h2 class="xblue-title" style="display: block;float: right;width:415px;padding-bottom: 10px">Billing Info</h2>
          <div style="float: right;width:405px;background:#E9F2F9;padding: 5px">
            <? include (ACTIVE_TEMPLATE_DIR.'shop_billing_details.php') ?></div>
          <!--</div>-->
          <!-- /shop-step-2 -->
          <!--<div id="shop-step-3" class="the_step">-->
            <div class="info-errors-object" style="padding-bottom: 10px;"></div>
            </div>
          <!-- /shop-step-3 -->
        </div>
        <!-- /stepper -->
      </div>
      <div style="clear: both">&nbsp;</div>
    </div>
  </div>
</form>
<!-- /#content -->

<? endif ?>
