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

<h2 class="blue-title" style="display: block;">Billing Info</h2>
<!--<img src="<? print TEMPLATE_URL; ?>img/icons/icons/copy.png" alt="Populate" style="width: 18px;" />
<a 
	style="top: -3px; position: relative; text-decoration: none; color: #0687D6;" 
	href="javascript:;"
	onclick="populateBillingInfo();"
>
	<i>Populate billing info with shipping info &raquo;</i>
</a>-->

<div id="billing_info_opts">
    <label for="bil_inf" class="left">Same as shipping info?</label>
    <input type="radio" name="bil_inf" value="0" id="same" checked="checked" class="left" style="cursor: pointer; cursor: hand; border: 0; padding: 0; height: 13px; width: 13px; margin:0px 5px 0 10px;">
    <span class="left">Yes</span>
    <input type="radio" name="bil_inf" value="1" id="diff" class="left" style="cursor: pointer; cursor: hand; border: 0; padding: 0; height: 13px; width: 13px; margin: 0px 5px 0 15px;">
    <span class="left">No</span>
</div>

<div class="c" style="padding-bottom: 10px">&nbsp;</div>

<div id="billing_info" style="display: block;">
 <div class="" style="padding-left: 7px;padding-bottom: 30px;">

<div class="left" style="width:415px">

	<div class="mtf">
	  <label>First Name <small  class="pink_text">(required)</small></label>
	  <div class="box">
		<input type="text" name="billing_first_name" id="billing_first_name" value="<? print $this->session->userdata ( 'billing_first_name' ) ?>" class="required billing_info_trigger">
	  </div>
	</div>
	<div class="mtf">
	  <label>Last Name <small  class="pink_text">(required)</small></label>
	  <div class="box">
		<input type="text" name="billing_last_name" id="billing_last_name"  value="<? print $this->session->userdata ( 'billing_last_name' ) ?>" class="required billing_info_trigger">
	  </div>
	</div>

    <div class="mtf">
	  <label>Phone Number</label>
	  <div class="box">
		<input type="text" name="billing_user_phone"  id="billing_user_phone" value="<? print $this->session->userdata ( 'billing_user_phone' ) ?>"  class="required billing_info_trigger"  />
	  </div>
	</div>
	<div class="mtf">
	  <label>Email <small  class="pink_text">(required)</small></label>
	  <div class="box">
		<input type="text" name="billing_user_email" id="billing_user_email"  value="<? print $this->session->userdata ( 'billing_user_email' ) ?>" class="required-email billing_info_trigger">
	  </div>
	</div>
</div>


    <? /*
    <div class="mtf">
	  <label>Company Name <small  class="pink_text">(your name)</small></label>
	  <div class="box">
		<input type="text" name="billing_company_name" id="billing_company_name"  value="<? print $this->session->userdata ( 'billing_company_name' ) ?>" class="billing_info_trigger">
	  </div>
	</div>
    */ ?>

    <div class="right" style="width: 415px;">

	<? /*
<div class="mtf" style="clear: both">
	  <label>Country <small  class="pink_text">(required)</small></label>
	  <div class="box">
		<? // $countries = $this->core_model->geoGetAllCountries(); ?>
		<?php // remove dummy conditions below when paypal is stable?>
		<?  if (true || $_SERVER['REMOTE_ADDR'] == '77.70.8.202') {
				$countries = $this->cart_model->paymentmethods_paypal_get_countries_codes();
			} else {
				$countries = $this->cart_model->paymentmethods_tpro_get_countries_list_as_array();
			}
		?>
		<? $billing_country = $this->session->userdata ( 'billing_country' );
	  //var_dump($billing_country);
				if($billing_country == false) {  $billing_country = 1 ;

				}
				?>
		<select name="billing_country" class="required billing_info_trigger" id="billing_country"  onchange="changeBillingCountry()">
		  <? $i=0; foreach($countries as $c => $v):   ?>
		  <option value="<? print $c ?>" <? if($billing_country == $c) : ?> selected="selected" <?  endif;?> ><? print $v ?></option>
		  <? $i++; endforeach; ?>
		</select>
		<!--  <input type="text" name="country"   value="Bulgaria"  class="required">-->
	  </div>
	</div>
*/ ?>
	<div class="mtf">
	  <label>City <small  class="pink_text">(required)</small></label>
	  <div class="box">
		<input type="text" name="billing_city" id="billing_city"  value="<? print $this->session->userdata ( 'billing_city' ) ?>"  class="required billing_info_trigger">
	  </div>
	</div>
	<div class="mtf">
	  <label>Address</label>
	  <div class="box">
		<input type="text" class="required<? /*

*/ ?>" name="billing_address" id="billing_address"  value="<? print $this->session->userdata ( 'billing_address' ) ?>"  class="billing_info_trigger">
	  </div>
	</div>


	<div class="mtf" id="state_selector" style="visibility: hidden">
	  <label>State/Province</label>
	  <div class="box">
		<? /*
		<input name="billing_state"  id="billing_state" value="<? print $this->session->userdata ( 'billing_state' ) ?>" type="text" class="billing_info_trigger" />
		*/ ?>


        <script type="text/javascript">
            $(document).ready(function(){
                $("#billing_state").val('<? print $this->session->userdata ( 'billing_state' ) ?>');

                $("#billing_info input").remove();

            });
        </script>

<select style="padding: 2px" name="billing_state" id="billing_state" class="required billing_info_trigger">
	<option value="">Select State</option>
 	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">Dist of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>

	</select>




	  </div>
	</div>
	<div class="mtf">
	  <label>Zip/Postal Code <small  class="pink_text">(required)</small></label>
	  <div class="box">
		<input name="billing_zip" id="billing_zip" value="<? print $this->session->userdata ( 'billing_zip' ) ?>" class="required billing_info_trigger" type="text" />
	  </div>
	</div>

    </div>
</div>

</div> <!-- end of billing info -->

<div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
<div id="card-check-status">
<div class="" style="padding-left: 7px;padding-bottom: 30px;">
  <h2 class="blue-title-small">Card Data</h2>
  <div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
  <!--You will be prompted for your credit card data at the final step.-->
  <div id="card-check-status-error" style="display:none"> Error: We were unable to verify this credit card account. Please check your credit card info and fill all fields correctly. </div>
  <div class="mtf">
    <label> Credit card number <small  class="pink_text">(required)</small></label>
          <div class="box">
            <input name="billing_cardholdernumber" autocomplete="off" id="billing_cardholdernumber" value="<? print $this->session->userdata ( 'billing_cardholdernumber' ) ?>" class="required billing_info_trigger" type="text" />
          </div>
  </div>
  <div class="mtf">
	  <label>Card type <small  class="pink_text">(required)</small></label>
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
<br />
<div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
  <div class="mtf">
    <table border="0" cellspacing="2" cellpadding="0">
    
    
    
     
    
      <tr>
        <td><label>Expires month <small  class="pink_text">(required)</small></label>
          <div class="box">
            <!--<input name="billing_expiresmonth" id="billing_expiresmonth" value="<? print $this->session->userdata ( 'billing_expiresmonth' ) ?>" class="required billing_info_trigger" type="text" />-->
            <select name="billing_expiresmonth" id="billing_expiresmonth" class="required billing_info_trigger">
              <?
	 
	 $y = date('Y');
	 $start = 1;
	 $end = 12;
	 
     
     for ($i = $start; $i <=  $end; $i++) : ?>
              <option <? if($this->session->userdata ( 'billing_expiresmonth' ) == $i) : ?> selected="selected"   <? endif; ?>  value="<? print $i ?>"><? print $i ?></option>
              <? endfor; ?>
            </select>
          </div></td>
        <td><label>Expires year <small  class="pink_text">(required)</small></label>
          <div class="box">
            <select name="billing_expiresyear" id="billing_expiresyear" class="required billing_info_trigger">
              <?
	 
	 $y = date('Y');
	 $start = $y - 0;
	 $end = $y + 10;
	 
     
     for ($i = $start; $i <=  $end; $i++) : ?>
              <option <? if($this->session->userdata ( 'billing_expiresyear' ) == $i) : ?> selected="selected"   <? endif; ?>  value="<? print $i ?>"><? print $i ?></option>
              <? endfor; ?>
            </select>
          </div></td>
      </tr>
    </table>
  </div>
</div>
<div class="mtf" style="clear:both;padding:2px;background: #E9F2F9;width: 300px;">
  <div style="float: left;width:90px;">
    <label>CVV2 <small  class="pink_text">(required)</small></label>
    <div class="box">
      <input style="width: 70px" maxlength="4" name="billing_cvv2" autocomplete="off" id="billing_cvv2" value="<? print $this->session->userdata ( 'billing_cvv2' ) ?>" class="required billing_info_trigger" type="text" />
    </div>
  </div>
  <div id="cvv-info">
    <h2 class="blue-title-small" style="padding: 8px 0 7px 0">Where do I find it?</h2>
    <div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
    <span>VISA &amp; MASTERCARD:</span> <img src="<? print TEMPLATE_URL; ?>img/cc_code_1.gif" alt="" /> <em>3-digit code </em>
    <div class="clear" style="height:2px;overflow: hidden">&nbsp;</div>
    <span class="clear">AMERICAN EXPRESS:</span> <img src="<? print TEMPLATE_URL; ?>img/cc_code_1.gif" alt="" /> <em>4-digit code</em> </div>
</div>
</div>
