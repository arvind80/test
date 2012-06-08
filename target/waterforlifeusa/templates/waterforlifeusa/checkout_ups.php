<div id="home_head" style="height: auto">
      <div id="in-banner" class="product-baner">
        <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'21' }));
                                    FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'28' }));


                            $("#checkout_table th").each(function(){
                                 FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'007AC0', cSize:'14' }));
                            });


                            $("#step2").validate();



                            });
                        </script>
        <div id="products-baner-txt">
          <h1 id="products-baner-title">Water for life</h1>
          <h2 id="products-baner-sub-title"></h2>

          <p>Water is not just some colorless and tasteless one dimensional liquid; on the contrary, life on earth originated from water, and all life forms depend on water to sustain them, therefore water is the fundamental foundation and source of eternal life on earth.  <strong>Dr. Kim Young Kwi</strong>.</p>
        </div>
      </div>
      <!-- /in-banner -->
    </div>



<div id="content">
 <div style="width:850px;margin: auto">
    <form method="post" action="https://www.paypal.com/cgi-bin/webscr"   id="step2" style="width: 485px;float: left">
        <input type="hidden" name="business" value="info@ooyes.net">
        <input type="hidden" name="cmd" value="_xclick">

        <input name="autoreply" type="hidden"  value="autoreply_order" />





        <input type="hidden" name="currency_code" value="USD">
<!--        <input type="hidden" name="image_url" value="<? print site_url(); ?>userfiles/templates/omnitom/img/logo.jpg">-->
        <input type="hidden" name="no_shipping" value="2">
        <input type="hidden" name="shipping" id="payment_form_shipping" value="9">
        <!--  <input type="hidden" name="shopping_url" value="<? print site_url(); ?>shop">-->
        <input type="hidden" name="amount" value="59">
        <input type="hidden" name="promo_code" value="">



        <input type="hidden" name="item_name" value="Order ID: WFLW1XSMHN84285">

        <input type="hidden" name="weight_cart" value="0.122">
        <input type="hidden" name="weight_unit" value="kgs">
        <!--  <input type="hidden" name="return" value="<? print site_url(); ?>payment-confirmed/order:f84532f9e79c06d560df5d37df6d14d8">-->
        <input type="hidden" name="order_id" value="WFLW1XSMHN84285">
        <input type="hidden" name="sid" value="f84532f9e79c06d560df5d37df6d14d8">
        <div class="mtf">
          <label>First Name <small  class="pink_text">(required)</small></label>
          <div class="box">

            <input type="text" name="first_name" value="" class="required">
          </div>
        </div>
        <div class="mtf">
          <label>Last Name <small  class="pink_text">(required)</small></label>
          <div class="box">
            <input type="text" name="last_name" value="" class="required">
          </div>

        </div>
        <div class="mtf">
          <label>Email <small  class="pink_text">(required)</small></label>
          <div class="box">
            <input type="text" name="email" value="" class="required">
          </div>
        </div>
        <div class="mtf">

          <label>Phone Number</label>
          <div class="box">
            <input type="text" name="night_phone_a"   />
          </div>
        </div>
        <div class="mtf">
          <label>Country <small  class="pink_text">(required)</small></label>

          <div class="box">
             <select name="country" class="required" id="shipping_county"  onchange="changeShippingCountry()">
                            <? include "countries.php" ?>
                          </select>
            <!--  <input type="text" name="country"   value="Bulgaria"  class="required">-->
          </div>
        </div>

        <div class="mtf">
          <label>City <small  class="pink_text">(required)</small></label>
          <div class="box">
            <input type="text" name="city"   class="required">
          </div>
        </div>
        <div class="mtf">
          <label>Address <small  class="pink_text">(required)</small></label>

          <div class="box">
            <input type="text" name="address1"   class="required">
          </div>
        </div>
        <div class="mtf">
          <label>Address 2</label>
          <div class="box">
            <input type="text" name="address2">

          </div>
        </div>
        <div class="mtf">
          <label>State/Province</label>
          <div class="box">
            <input name="state" type="text" />
          </div>
        </div>

        <div class="mtf">
          <label>Zip/Postal Code</label>
          <div class="box">
            <input name="zip" type="text" />
          </div>
        </div>
        <div style="height: 15px"></div>
        <div class="clear"></div>

        <small style="width:300px; display:block;" class="pink_text">*Note: by clicking the continue to payment button your order will be placed and your shopping bag will be emptied</small> <br />
        <div class="clear"></div>

        <a class="btn" href="javascript:;" onclick="$(this).parent().submit();">Continue to payment *</a>

        <span id="submit_payments_form_button_redirecting" style="display:none"><br />
Redirecting...</span>



      </form>


      <div style="float: right;width:360px;" id="o-info">


<table>
<tr>
<td>

<td><div class="richtext">
        <h2 class="blue-title">Online Payments Center</h2>
      </div>
      We use secure Payment with PayPal <br/>
      <br/>
      <table border="0">
  <tbody><tr valign="middle">
    <td>We accept:</td>
    <td><img src="<? print TEMPLATE_URL; ?>img/logo_ccVisa.gif"/> <img src="<? print TEMPLATE_URL; ?>img/logo_ccMC.gif"/><img src="<? print TEMPLATE_URL; ?>img/logo_ccAmex.gif"/> <img src="<? print TEMPLATE_URL; ?>img/logo_ccDiscover.gif"/> <img src="<? print TEMPLATE_URL; ?>img/PayPal_mark_37x23.gif"/></td>
  </tr>
</tbody></table>


      <br/>


      <div class="richtext">
        <h2 class="blue-title">Your order information:</h2>
      </div>
      <ul>
        <li><b>Order unique id:</b> OMNYAIQA7P4719</li>
        <li title="USD"><b>Total amount:</b> $  59
                  </li>
        <li><b>Shipping and handling fee:</b> $
        <br />
          <div style="position: relative;overflow: hidden">
              <span id="shipping_cost_information"></span>
              <div id='shipping_price_loading'></div>
          </div>
        </li>
      </ul>

      <div class="richtext">
        <h2 class="blue-title">Want to change your order:</h2>
      </div>
      <ul>
        <li><a href="<? print site_url('shopping-cart'); ?>">Go to edit your order</a></li>
        <li><a href="<? print site_url('products'); ?>">Shop for more items</a></li>
      </ul>
      <br/>
      <br/>
      See the <a href="<? print site_url('water-for-life-usa-policies'); ?>">Water for Life USA Policies</a> for more information about the payments.
      <div class="clear"></div>
      <br/>
      <br/></td>

</td>

</tr>

</table>

      </div>


 </div>




</div><!-- /#content -->