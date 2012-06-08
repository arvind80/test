<h2 class="xblue-title" style="display: block">Fill in your shipping information</h2>
<br />
Currently, we offer shipping directly from the Web within the United States to actual physical addresses only.  If you would like to ship to a P.O. box or internationally, please contact us for rate information. The shipping price is quoted directly from UPS. <br />
<br />

<div class="clear"></div>
<table border="0" cellspacing="0" cellpadding="0" width="530">
<!--  <tr valign="middle">
    <td rowspan="2"><img src="<? print TEMPLATE_URL; ?>img/ups.png" height="70"/></td>
    <td><label>Address Type:</label>
      <? $shipping_address_type = $this->session->userdata ( 'shipping_address_type' );
if($shipping_address_type == false) {  $shipping_address_type = '01' ; }
?>
      <div class="box">
        <select style="width:220px;padding: 2px" name="selResidential" id="shipping_address_type" onchange="showShippingCost()" />

        <option value="01"  <? if($shipping_address_type == '01' ) : ?>  selected="selected" <? endif; ?>>Residential</option>
        <option value="02"  <? if($shipping_address_type == '02' ) : ?>  selected="selected" <? endif; ?>>Commercial</option>
        </select>
      </div>
      <br /></td>
  </tr>-->
  <tr valign="middle">
  <? /*
  <td><img src="<? print TEMPLATE_URL; ?>img/ups.png" height="70"/></td>
  */ ?>
    <td>
      </td> 
  </tr>
  
</table><br />
<div id="PERSONAL_INFO" style="width: 415px;float: left">
<div class="clear"></div>


<div class="" style="padding-left: 7px;padding-bottom: 30px;width: 415px;">
<h2 class="xblue-title-small">Personal info</h2>
<div class="clear"></div>
<div class="mtf">
  <label>First Name <small  class="pink_text"> *</small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_first_name" id="shipping_first_name" value="<? print $this->session->userdata ( 'shipping_first_name' ) ?>" class="required shipping_cost_calculation_trigger">
  </div>
</div>
<div class="mtf">
  <label>Last Name <small  class="pink_text"> *</small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_last_name" id="shipping_last_name"  value="<? print $this->session->userdata ( 'shipping_last_name' ) ?>" class="required shipping_cost_calculation_trigger">
  </div>
</div>
<div class="mtf">
  <label>Phone Number <small  class="pink_text"> *</small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_user_phone"  id="shipping_user_phone" value="<? print $this->session->userdata ( 'shipping_user_phone' ) ?>"  class="required shipping_cost_calculation_trigger"  />
  </div>
</div>
<div class="mtf">
  <label>Email <small  class="pink_text"> *</small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_user_email" id="shipping_user_email"  value="<? print $this->session->userdata ( 'shipping_user_email' ) ?>" class="required-email shipping_cost_calculation_trigger">
  </div>
</div>


<? /*
<div class="mtf">
  <label>Company Name <small  class="pink_text">(your name)</small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_company_name" id="shipping_company_name"  value="<? print $this->session->userdata ( 'shipping_company_name' ) ?>" class="shipping_cost_calculation_trigger">
  </div>
</div>
*/ ?>
</div>

<div class="clear" style="padding-left: 7px;padding-bottom: 0px;width: 415px;">
<h2 class="xblue-title-small">Address info for shipping</h2>
<div class="clear"></div>

<div class="mtf">

<label>Service Type:</label>
      <? $shipping_service = $this->session->userdata ( 'shipping_service' );
if($shipping_service == false) {  $shipping_service = '03' ; }
?>
      <div class="box">
        <select style="width:220px;padding: 2px" name="shipping_service" class="shipping_cost_calculation_trigger" id="shipping_service"  />
  <? /*
       <!-- <option value="1DM" <? if($shipping_service == '1DM' ) : ?>  selected="selected" <? endif; ?>   >UPS Next Day Air Early AM</option>-->
        <option value="1DA" <? if($shipping_service == '1DA' ) : ?>  selected="selected" <? endif; ?>  >UPS Next Day Air</option>
        <!--<option value="1DP" <? if($shipping_service == '1DP' ) : ?>  selected="selected" <? endif; ?>  >UPS Next Day Air Saver</option>-->
        <!--<option value="2DM" <? if($shipping_service == '2DM' ) : ?>  selected="selected" <? endif; ?> >2nd Day Air AM</option>-->
        <option value="2DA" <? if($shipping_service == '2DA' ) : ?>  selected="selected" <? endif; ?> >UPS 2nd Day Air</option>
        <option value="3DS" <? if($shipping_service == '3DS' ) : ?>  selected="selected" <? endif; ?> >UPS 3 Day Select</option>
        <option value="GND" <? if($shipping_service == 'GND' ) : ?>  selected="selected" <? endif; ?> >UPS Ground</option>
        <!--   <option value="STD">Canada Standard</option>
   <option value="XPR">Worldwide Express</option>
   <option value="XDM">Worldwide Express Plus</option>
   <option value="XPD">Worldwide Expedited</option>
   <option value="WXS">Worldwide Saver</option>-->
  */
  ?>
  			<option value="13" <? if($shipping_service == '13' ) : ?>  selected="selected" <? endif; ?>  >UPS Next Day Air</option>
  			<option value="02" <? if($shipping_service == '02' ) : ?>  selected="selected" <? endif; ?> >UPS 2nd Day Air</option>
  			<option value="12" <? if($shipping_service == '12' ) : ?>  selected="selected" <? endif; ?> >UPS 3 Day Select</option>
  			<option value="03" <? if($shipping_service == '03' ) : ?>  selected="selected" <? endif; ?> >UPS Ground</option>
        </select>
      </div>

      <small style="display: block;padding: 3px 0 5px;">* We recommend the UPS Ground service as the cheapest one and most widely used.</small>

</div>




<div class="mtf" style="clear: both">
  <label>Country -
    <small  class="pink_text">USA only</small></label>
  <div class="box">
    <? // $countries = $this->core_model->geoGetAllCountries(); ?>
    <?  $countries = ($this->cart_model->paymentmethods_tpro_get_countries_list_as_array());
	$countries  = array_slice($countries , 0, 1);
	?>
    <? $shipping_country = $this->session->userdata ( 'shipping_country' );

  //var_dump($shipping_country);
			if($shipping_country != '1') {  $shipping_country = 1 ;

			}
			?>
    <select onblur="populateBillingInfo();" name="shipping_country" class="required shipping_cost_calculation_trigger" id="shipping_country"  onchange="changeshippingCountry()">
      <? $i=0; foreach($countries as $c => $v):   ?>
      <option value="<? print $c ?>" <? if($shipping_country == $c) : ?> selected="selected" <?  endif;?> ><? print $v ?></option>
      <? $i++; endforeach; ?>
    </select>
    <!--  <input type="text" name="country"   value="Bulgaria"  class="required">-->
  </div>
</div>
<div class="clear"></div>
<div class="mtf">
  <label>City <small  class="pink_text"> *</small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_city" id="shipping_city"  value="<? print $this->session->userdata ( 'shipping_city' ) ?>"  class="required shipping_cost_calculation_trigger">
    </div>
</div>

<div class="mtf">
  <label>Address</label>
  <div class="box">
    <input onblur="populateBillingInfo();" type="text" name="shipping_address" id="shipping_address"  value="<? print $this->session->userdata ( 'shipping_address' ) ?>"  class="required shipping_cost_calculation_trigger">
  </div>
</div>
<div class="mtf">
  <label>State/Province</label>
  <div class="box">

    <? /*
<input onblur="populateBillingInfo();" name="shipping_state"  id="shipping_state" value="<? print $this->session->userdata ( 'shipping_state' ) ?>" type="text" class="shipping_cost_calculation_trigger" />
*/ ?>

<script type="text/javascript">
  $(document).ready(function(){
      $("#shipping_state").val("<? print $this->session->userdata ( 'shipping_state' ) ?>");
  });
</script>

    <select onblur="populateBillingInfo();" name="shipping_state"  id="shipping_state" class="required shipping_cost_calculation_trigger">
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
  <label>Zip Code <small  class="pink_text"></small></label>
  <div class="box">
    <input onblur="populateBillingInfo();" name="shipping_zip" id="shipping_zip" value="<? print $this->session->userdata ( 'shipping_zip' ) ?>" class="required shipping_cost_calculation_trigger" type="text" />
    <input name="shipping_zip_is_valid" id="shipping_zip_is_valid" type="hidden" value="no" />
  <!--  <br />
    <small>ex. 94043</small> -->
  </div>
</div>
</div>





<div class="clear" style="height: 1px;overflow: hidden"></div>
<div style="position: relative;overflow: hidden;height:30px;padding-bottom: 10px ">
    <span id="" class="shipping_price_holder" ><? print $this->session->userdata ( 'shop_shipping_cost' ) ?></span>
    <div class='shipping_price_loading' style="background-position: center !important;"></div>
</div>

<div style="display: none">
    <div id="shipping_map_canvas" style="height:200px; width:500px; display:block; clear:both;"></div>
</div>



</div>



