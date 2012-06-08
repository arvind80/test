<script type="text/javascript">
	$(document).ready(function(){

		if($("#billing_country").val()=="US") {
			$("#state_selector").css("visibility", "visible");
		}

		$("#billing_country").bind("change mouseup keyup", function(){
			if($(this).val()=="US") {
				$("#state_selector").css("visibility", "visible");
			} else {
				$("#state_selector").css("visibility", "hidden");
			}
		});
		
		populateBillingInfo();

        if($("div#billing_info_opts input#diff:checked").length>0){
           //$("div#billing_info").show();
        }

		$("div#billing_info_opts input#same").click( function() {
		    populateBillingInfo();
		    //$("div#billing_info").hide();
		});

		$("div#billing_info_opts input#diff").click( function() {
		    //$("div#billing_info").show();
		});

	});
</script>


<!--<img src="<? print TEMPLATE_URL; ?>img/icons/icons/copy.png" alt="Populate" style="width: 18px;" />
<a
	style="top: -3px; position: relative; text-decoration: none; color: #0687D6;" 
	href="javascript:;"
	onclick="populateBillingInfo();"
>
	<i>Populate billing info with shipping info &raquo;</i>
</a>-->

<div id="billing_info_opts"></div><!-- end of billing info -->
<div id="card-check-status">
  <div class="" style="padding-left:7px;padding-bottom: 0px;width:405px;float: left ">
  <h2 class="xblue-title-small">Card Data</h2>
  <div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
  <!--You will be prompted for your credit card data at the final step.-->
  <div id="card-check-status-error" style="display:none"> Error: We were unable to verify this credit card account. Please check your credit card info and fill all fields correctly. </div>
  
  <div><? /*
Names on card
*/ ?>
  	<div class="mtf">
	  <label>First name <small  class="pink_text">(on card) *</small></label>
	  <div class="box">
		<input type="text" name="billing_first_name" id="billing_first_name" value="<? print $this->session->userdata ( 'billing_first_name' ) ?>" class="required billing_info_trigger">
	  </div>
	</div>
	<div class="mtf">
	  <label>Last name <small  class="pink_text">(on card) *</small></label>
	  <div class="box">
		<input type="text" name="billing_last_name" id="billing_last_name"  value="<? print $this->session->userdata ( 'billing_last_name' ) ?>" class="required billing_info_trigger">
	  </div>
	</div>
  </div>
  
  
  
  <div class="mtf">
    <label> Credit card number <small  class="pink_text"> *</small></label>
          <div class="box">
            <input name="billing_cardholdernumber" autocomplete="off" id="billing_cardholdernumber" value="<? print $this->session->userdata ( 'billing_cardholdernumber' ) ?>" class="required billing_info_trigger" type="text" />
          </div>
  </div>
  <div class="mtf">
	  <label>Card type <small  class="pink_text"> *</small></label>
	  <div class="box">
	    <?  $cardTypes = ($this->cart_model->payPalCardTypes()); ?>
	    <? $credit_card_type = $this->session->userdata('credit_card_type');
			if($credit_card_type == false) {  
				$credit_card_type = 'Visa';
			}
		?>
	    <select name="credit_card_type" class="required billing_info_trigger" id="credit_card_type">
	      <? $i=0; foreach($cardTypes as $c => $v):   ?>
	      <option value="<? print $c ?>" <? if($credit_card_type == $c) : ?> selected="selected" <?  endif;?> ><? print $v ?></option>
	      <? $i++; endforeach; ?>
	    </select>
	  </div>
  </div>

<div class="clear" style="height:0px;overflow: hidden">&nbsp;</div>
  <div class="mtf">
<label>Expires month <small  class="pink_text"> *</small></label>
          <div class="box">
            <!--<input name="billing_expiresmonth" id="billing_expiresmonth" value="<? print $this->session->userdata ( 'billing_expiresmonth' ) ?>" class="required billing_info_trigger" type="text" />-->
            <select style="width: 95px" name="billing_expiresmonth" id="billing_expiresmonth" class="required billing_info_trigger">
              <?

	 $y = date('Y');
	 $start = 1;
	 $end = 12;
	 
     
     for ($i = $start; $i <=  $end; $i++) : ?>
              <option <? if($this->session->userdata ( 'billing_expiresmonth' ) == $i) : ?> selected="selected"   <? endif; ?>  value="<? print $i ?>"><? print $i ?></option>
              <? endfor; ?>
            </select>
          </div> </div>
          <div class="mtf">
        <label>Expires year <small  class="pink_text"> *</small></label>
          <div class="box">
            <select name="billing_expiresyear" style="width: 95px;" id="billing_expiresyear" class="required billing_info_trigger">
              <?
	 
	 $y = date('Y');
	 $start = $y - 0;
	 $end = $y + 10;
	 
     
     for ($i = $start; $i <=  $end; $i++) : ?>
              <option <? if($this->session->userdata ( 'billing_expiresyear' ) == $i) : ?> selected="selected"   <? endif; ?>  value="<? print $i ?>"><? print $i ?></option>
              <? endfor; ?>
            </select>
          </div>
      </div>
</div>
<div class="" style="clear:none;padding:2px;background: #E9F2F9;width: 300px;float: left;margin-left: 5px;">
  <div class="mtf">
  <script type="text/javascript">
  $(document).ready(function(){
    $("#wheretofindit").modal("html")
  });
  </script>
    <label>CVV2 <small  class="pink_text"> *</small>&nbsp;&nbsp;<a href="#find-it" id="wheretofindit"><strong>?</strong></a></label>
    <div class="box">
      <input style="width: 70px" maxlength="4" name="billing_cvv2" autocomplete="off" id="billing_cvv2" value="<? print $this->session->userdata ( 'billing_cvv2' ) ?>" class="required billing_info_trigger" type="text" />
    </div>
  </div>
  <div id="cvv-info">

    <div id="find-it" style="width: 170px;height: 120px;background:#E9F2F9;display: none;padding: 15px;">
    <span>VISA &amp; MASTERCARD:</span> <img src="<? print TEMPLATE_URL; ?>img/cc_code_1.gif" alt="" /> <em>3-digit code </em>
    <div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
    <span class="clear">AMERICAN EXPRESS:</span> <img src="<? print TEMPLATE_URL; ?>img/cc_code_1.gif" alt="" /> <em>4-digit code</em> </div>
    </div>
</div>

<div style="" id="o-info">
        <table>
          <tr>
            <td>
            <td>
            <? /* <div class="richtext">
                <h2 class="xblue-title">Online Payments Center</h2>
              </div>

              <table border="0">
                <tbody>
                  <tr valign="middle">
                    <td><h2 class="xblue-title-small">What types of credit card do you accept?</h2>
                      We accept Visa, Mastercard, Discover, Maestro and American Express.
                      <div style="height: 7px;overflow: hidden">&nbsp;</div>
                      <img src="<? print TEMPLATE_URL; ?>img/logo_ccVisa.gif"/> <img src="<? print TEMPLATE_URL; ?>img/logo_ccMC.gif"/> <img src="<? print TEMPLATE_URL; ?>img/logo_ccAmex.gif"/> <img src="<? print TEMPLATE_URL; ?>img/logo_ccDiscover.gif"/> <img src="<? print TEMPLATE_URL; ?>img/PayPal_mark_37x23.gif" style="display:none"/>
                      <div style="height: 7px;overflow: hidden">&nbsp;</div>
                      <h2 class="xblue-title-small">Can I use PayPal? </h2>
                      Unfortunately, we do not accept PayPal payments. </td>
                  </tr>
                </tbody>
              </table>
              */ ?>




                          <div id="srumk" style="width: 415px;">
                          <div class="richtext">
                <p><b>Your order information:</b></p>
              </div>
              <ul>
                <li><b>Order unique id:</b> <span id="order_uid_span"><? print $order_id ?></span></li>
                <li><b>View order:</b> <span > <a href="<? print site_url('shopping-cart'); ?>">Click here</a></span></li>
                
                
                
                <li title="USD"><b>Total amount:</b> $ <span id="total_price_for_whole_cart"><? print ($this->cart_model->itemsGetTotal(false,$this->session->userdata ( 'shop_currency' ))); ?></span></b>&nbsp; <span class="pink_text" id="new_price_for_whole_cart"></span> </li>
                <? $pc = $this->session->userdata ( 'cart_promo_code' ); ?>
                <? if($pc != false): ?>
                <script type="text/javascript">
				$(document).ready(function() {
					 cart_checkPromoCode()
				});
				</script>
                <li title="Promo code"><b>Promo code:</b> <? print $pc; ?> <small> <span id="the_promo_code_status" class="pink_text" style="display:none; clear:both"></span></small> </li>
                <? endif; ?>
                <li><b>Shipping and handling fee:</b> <span class='currency_sign'>$ <span></span></span>

                     <div class="c" style="padding-bottom: 5px;">&nbsp;</div>
                    <div style="position: relative;overflow: hidden;padding-top: 10px;height: 20px;">
                        <span id="shipping_cost_information" class="shipping_price_holder" ><? print $this->session->userdata ( 'shop_shipping_cost' ) ?></span>
                        <div class='shipping_price_loading' style="height: 30px;"></div>
                    </div>
                </li>
              </ul>
              <div class="clear" style="height: 5px;overflow: hidden"></div>

              <? /*
<div class="richtext">
                <h2 class="xblue-title" style="margin: 0;">Want to change your order:</h2>
              </div>
              <ul>
                <li><a href="<? print $this->content_model->getContentURLByIdAndCache(39) ; ?>">Go to edit your order</a></li>
                <li><a href="<? print $this->content_model->getContentURLByIdAndCache(2) ; ?>">Shop for more items</a></li>
              </ul>
              <br/> */ ?>



            </div>



              <div class="clear"></div>
              <br/>
                          <div class="mwdisable" style="position:relative"> <a class="btn submit" href="javascript:;">Continue to payment *</a></div>
            <!--[if IE 6]><input type="submit" value="" class="ie6sbm" style="width:180px;height:27px;" /><![endif]-->
            <small style="width:300px; display:block;padding-top: 15px;" class="pink_text">*Note: by clicking the continue to payment button your order will be placed and your shopping bag will be emptied. See the <a href="<? print $this->content_model->getContentURLByIdAndCache(49) ; ?>">Water for Life USA Policies</a> for more information about the payments. </small> <span id="submit_payments_form_button_redirecting" style="display:none"> <br />
            Redirecting... </span>
              <br/></td>
            </td>
          </tr>
        </table>
      </div>


</div>
