<? $sid=$this->session->userdata ( 'session_id' );

$cart_item = array();
$cart_item['sid'] = $sid;
$cart_item['order_completed'] ='n';

$cart_items = $this->cart_model->itemsGet($cart_item);
//code to check if the cart is empty.
if(empty($cart_items)){
	header("Location:/products");
}
$order_id = "WFL". date("ymdHis") . rand ();
?>

<style type="text/css">
.mtf label {
	float: left;
	width: 155px;
	padding-right: 5px;
}

.mtf label small {
	white-space: nowrap;
}

.mtf {
	float: none;
	width: auto;
	overflow: hidden;
	zoom: 1;
    margin: 10px 10px 10px 0;
    position: relative;
    width: 415px;
}

#stepper-wrap {
	width: 850px;
}

#shop-step-1 {
	float: none;
	width: auto;
	margin: 0;
}

#o-info {
	width: 405px;
	float: right;
}

.info-errors-object {
	width: 400px;
	float: left;
	clear: none;
}

form#step2 input {
	padding: 3px;
}

.mtf label {
	margin-top: 2px;
}

.xblue-title {
	color: #0687D6;
	font-size: 24px;
}

#o-info .shipping_price_loading {
	background-color: #E9F2F9;
	background-position: center;
}

#content a.btn input.btnright {background:none; border:none; color:#fff;}
#content a.btn {padding-top:0; height:24px; text-decoration:none;}
#content a.btn:hover {text-decoration:none;}
</style>
<script type='text/javascript'>
	function checkValidation(){
		
		$("#hidden_shipping_id").val($("#shipping_fee1").html());
		if($("#hidden_shipping_id").val()!=''){
			return true;
		}else{return false;}			
	}
</script>
 <div style="height: 45px">&nbsp;</div>
  <div id="content">
    <div style="width:850px;margin: auto">
<?

if(isset($_GET['tx']) && $_GET['tx']!=''){
	if($_GET['st']=='Completed'){
		//code to check  whether transaction id already exists in the db or not.
		 $connection=mysql_connect(DBHOSTNAME,DBUSERNAME,DBPASSWORD);
			    mysql_select_db(DBDATABASE);
		$transactionSql="Select count(*) as count from firecms_cart_orders where transactionid='".$_GET['tx']."'";
		$checkTrans=mysql_query($transactionSql,$connection);
		$checkTrans=mysql_fetch_array($checkTrans);
		if($_GET['order_id']!='' && $_GET['tx']!='' && $checkTrans['count']==0){
		echo "<div ><h1>Thanks for your purchase from the waterforlifeusa.com for a amount of $ {$_GET['amt']}</h1></div>";

		//echo "<pre>";print_r($cart_items);echo"</pre>";
		
		
		
		//loop through if we have multiple items.
		
		$cart_promo_code=$this->session->userdata ( 'cart_promo_code' );
		foreach($cart_items as $itemArray){
			 $updateQuery="Update  firecms_cart set order_id='".$_GET['order_id']."', order_completed='y' where id='".$itemArray['id']."'";
			 $return= mysql_query($updateQuery,$connection);
			
		}
		 $sidQuery="Select sid from firecms_cart where order_id='".$_GET['order_id']."'";
		$sidArray=mysql_query($sidQuery,$connection);
		$sidArray=mysql_fetch_array($sidArray);
			      $shop_transaction_method_user_id = $this->core_model->optionsGetByKey ( 'shop_transaction_method_user_id' );
			      $customer_code=$this->session->userdata ( 'session_id' ) . date ( 'ymdHis' );
			      $shipping_total_charges=$this->session->userdata ( 'shipping_total_charges' );
			      $shipping_service=$this->session->userdata ( 'shipping_service' );
			      $sname=$this->session->userdata ( 'shipping_first_name' ) . ' ' . $this->session->userdata ( 'shipping_last_name' );
			      $scompany=$this->session->userdata ( 'shipping_company_name' );
			      $saddress1 = $this->session->userdata ( 'shipping_address' );
			      $saddress2 = $this->session->userdata ( 'shipping_city' ) . ', ' . $this->session->userdata ( 'shipping_zip' );
			      $scity = $this->session->userdata ( 'shipping_city' );
			      $sstate= $this->session->userdata ( 'shipping_state' );
			      $szipcode= $this->session->userdata ( 'shipping_zip' );
			      $sphone = $this->session->userdata ( 'shipping_user_phone' );
			      $scountry = $this->session->userdata ( 'shipping_state' );
			      $semailaddress = $this->session->userdata ( 'shipping_user_email' );

			       $insertQuery="INSERT INTO firecms_cart_orders(updated_on,
									    created_on,
									    sid,
									    country,
									    order_id,
									    promo_code,
									    amount,
									    clientid,
									    customercode,
									    transactionid,
									    shipping_total_charges,
									    shipping_service,
									    sname,
									    scompany,
									    saddress1,
									    saddress2,
									    scity,
									    sstate,
									    szipcode,
									    scountry,
									    sphone,
									    semailaddress)
								     values(now(),
									    now(),
									    '".$sidArray['sid']."',
									    '".$scountry."',
			                                    		    '".$order_id."',
									    '".$cart_promo_code."',
									    '".$_GET['amt']."',
									    '".$shop_transaction_method_user_id."',
									    '".$customer_code."',
									    '".$_GET['tx']."',
									    '".$shipping_total_charges."',
									    '".$shipping_service."',
									    '".$sname."',
									    '".$scompany."',
									    '".$saddress1."',
									    '".$saddress2."',
									    '".$scity."',
									    '".$sstate."',
									    '".$szipcode."',
									    '".$scountry."',
									    '".$sphone."',
									    '".$semailaddress."')";	
				mysql_query($insertQuery,$connection);
	}
		
}elseif($_GET['st']=='Failed'){
	echo "<div ><h1>There is some problem in processing your payment please try again.</h1></div>";
}elseif($_GET['st']=='Pending'){
	echo "<div ><h1>Due to lack of sufficient balance in your account your payment status is pending.</h1></div>";
}
}else{

	?>
<!--Pyament through paypal. -->

<form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post"
	onsubmit="return checkValidation();">

	<div class=""
		style="padding-left: 7px; padding-bottom: 30px; width: 415px;">
		<h2 class="xblue-title-small">Personal info</h2>
		<div class="clear"></div>
		<div class="mtf">
			<label>First Name <small class="pink_text"> *</small> </label>
			<div class="box">
				<input onblur="populateBillingInfo();" type="text"
					name="shipping_first_name" id="shipping_first_name"
					value="<? print $this->session->userdata ( 'shipping_first_name' ) ?>"
					class="required shipping_cost_calculation_trigger">
			</div>
		</div>


		<div class="mtf">
			<label>Last Name <small class="pink_text"> *</small> </label>
			<div class="box">
				<input onblur="populateBillingInfo();" type="text"
					name="shipping_last_name" id="shipping_last_name"
					value="<? print $this->session->userdata ( 'shipping_last_name' ) ?>"
					class="required shipping_cost_calculation_trigger">
			</div>
		</div>
		<div class="mtf">
			<label>Phone Number <small class="pink_text"> *</small> </label>
			<div class="box">
				<input onblur="populateBillingInfo();" type="text"
					name="shipping_user_phone" id="shipping_user_phone"
					value="<? print $this->session->userdata ( 'shipping_user_phone' ) ?>"
					class="required shipping_cost_calculation_trigger" />
			</div>
		</div>
		<div class="mtf">
			<label>Email <small class="pink_text"> *</small> </label>
			<div class="box">
				<input onblur="populateBillingInfo();" type="text"
					name="shipping_user_email" id="shipping_user_email"
					value="<? print $this->session->userdata ( 'shipping_user_email' ) ?>"
					class="required-email shipping_cost_calculation_trigger">
			</div>
		</div>
		<input type="hidden" name="cmd" value="_cart"> <input type="hidden"
			name="upload" value="1"> <input type="hidden" name="business"
			value="nvnkum_1325154201_biz@yahoo.in"> <input type="hidden"
			name="return" value="https://waterforlifeusa.com/paypal?order_id=<? echo $order_id;?>"> <input
			type="hidden" id="hidden_shipping_id" name="shipping_1"
			value="<?  print $this->session->userdata ( 'shop_shipping_cost' ); ?> ">

		<h2 class="xblue-title" style="display: block">Fill in your shipping
			information</h2>
		<br /> Currently, we offer shipping directly from the Web within the
		United States to actual physical addresses only. If you would like to
		ship to a P.O. box or internationally, please contact us for rate
		information. The shipping price is quoted directly from UPS. <br /> <br />

		<div class="clear"></div>
		<table border="0" cellspacing="0" cellpadding="0" width="530">

			<tr valign="middle">
				<td></td>
			</tr>

		</table>
		<br />
		<div id="PERSONAL_INFO"
			style="width: 415px; height: 473px; float: left">
			<div class="clear"></div>
			<div class="clear"
				style="padding-left: 7px; padding-bottom: 0px; width: 415px;">
				<h2 class="xblue-title-small">Address info to calculate shipping</h2>
				<div class="clear"></div>

				<div class="mtf">

					<label>Service Type:</label>
					<? $shipping_service = $this->session->userdata ( 'shipping_service' );
					if($shipping_service == false) {
						$shipping_service = '03' ;
					}
					?>
					<div class="box">
						<select style="width: 220px; padding: 2px" name="shipping_service"
							class="shipping_cost_calculation_trigger" id="shipping_service" />

						<option value="13" <? if($shipping_service == '13' ) : ?>
							selected="selected" <? endif; ?>>UPS Next Day Air</option>
						<option value="02" <? if($shipping_service == '02' ) : ?>
							selected="selected" <? endif; ?>>UPS 2nd Day Air</option>
						<option value="12" <? if($shipping_service == '12' ) : ?>
							selected="selected" <? endif; ?>>UPS 3 Day Select</option>
						<option value="03" <? if($shipping_service == '03' ) : ?>
							selected="selected" <? endif; ?>>UPS Ground</option>
						</select>
					</div>
					<small style="display: block; padding: 3px 0 5px;">* We recommend
						the UPS Ground service as the cheapest one and most widely used.</small>
				</div>
				<div class="mtf" style="clear: both">
					<label>Country - <small class="pink_text">USA only</small> </label>
					<div class="box">
					<? // $countries = $this->core_model->geoGetAllCountries(); ?>
					<?  $countries = ($this->cart_model->paymentmethods_tpro_get_countries_list_as_array());
					$countries  = array_slice($countries , 0, 1);
					?>
					<? $shipping_country = $this->session->userdata ( 'shipping_country' );

					//var_dump($shipping_country);
					if($shipping_country != '1') {
						$shipping_country = 1 ;

					}
					?>
						<select onblur="populateBillingInfo();" name="shipping_country"
							class="required shipping_cost_calculation_trigger"
							id="shipping_country" onchange="changeshippingCountry()">
							<? $i=0; foreach($countries as $c => $v):   ?>
							<option value="<? print $c ?>"
							<? if($shipping_country == $c) : ?> selected="selected"
							<?  endif;?>>
								<? print $v ?>
							</option>
							<? $i++; endforeach; ?>
						</select>

					</div>
				</div>
				<div class="clear"></div>
				<div class="mtf">
					<label>City <small class="pink_text"> *</small> </label>
					<div class="box">
						<input onblur="populateBillingInfo();" type="text"
							name="shipping_city" id="shipping_city"
							value="<? print $this->session->userdata ( 'shipping_city' ) ?>"
							class="required shipping_cost_calculation_trigger">
					</div>
				</div>

				<div class="mtf">
					<label>Address</label>
					<div class="box">
						<input onblur="populateBillingInfo();" type="text"
							name="shipping_address" id="shipping_address"
							value="<? print $this->session->userdata ( 'shipping_address' ) ?>"
							class="required shipping_cost_calculation_trigger">
					</div>
				</div>
				<div class="mtf">
					<label>State/Province</label>
					<div class="box">

						<script type="text/javascript">
  $(document).ready(function(){
      $("#shipping_state").val("<? print $this->session->userdata ( 'shipping_state' ) ?>");
  });
</script>
						<select onblur="populateBillingInfo();" name="shipping_state"
							id="shipping_state"
							class="required shipping_cost_calculation_trigger">
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
					<label>Zip Code <small class="pink_text"></small> </label>
					<div class="box">
						<input onblur="populateBillingInfo();" name="shipping_zip"
							id="shipping_zip"
							value="<? print $this->session->userdata ( 'shipping_zip' ) ?>"
							class="required shipping_cost_calculation_trigger" type="text" />
						<input name="shipping_zip_is_valid" id="shipping_zip_is_valid"
							type="hidden" value="no" />
						<!--  <br />
    <small>ex. 94043</small> -->
					</div>
				</div>
			</div>
			<div class="clear" style="height: 1px; overflow: hidden"></div>
			<div
				style="position: relative; overflow: hidden; height: 30px; padding-bottom: 10px">
				<span id="" class="shipping_price_holder"><? print $this->session->userdata ( 'shop_shipping_cost' ) ?>
				</span>
				<div class='shipping_price_loading'
					style="background-position: center !important;"></div>
			</div>

			<div style="display: none">
				<div id="shipping_map_canvas"
					style="height: 200px; width: 500px; display: block; clear: both;"></div>
			</div>

			<div id="srumk" style="width: 415px;margin-left: 25px;">
				<div class="richtext">
					<p>
						<b>Your order information:</b>
					</p>
				</div>
				<ul>
					<li><b>Order unique id:</b> <span id="order_uid_span"><? print $order_id ?>
					</span></li>
					<li><b>View order:</b> <span> <a
							href="<? print site_url('shopping-cart'); ?>">Click here</a> </span>
					</li>
					<li title="USD"><b>Total amount:</b> $ <span
						id="total_price_for_whole_cart"><? print ($this->cart_model->itemsGetTotal(false,$this->session->userdata ( 'shop_currency' ))); ?>
					</span></b>&nbsp; <span class="pink_text"
						id="new_price_for_whole_cart"></span>
					</li>
					<? $pc = $this->session->userdata ( 'cart_promo_code' ); ?>
					<? if($pc != false): ?>
					<script type="text/javascript">
				$(document).ready(function() {
					 cart_checkPromoCode();
				});
				</script>
					<li title="Promo code"><b>Promo code:</b> <? print $pc; ?> <small>
							<span id="the_promo_code_status" class="pink_text"
							style="display: none; clear: both"></span> </small>
					</li>
					<? endif; ?>
					<li><b>Shipping and handling fee:</b> <span class='currency_sign'>$
							<span id="shipping_fee1"></span> </span>

						<div class="c" style="padding-bottom: 5px;">&nbsp;</div>
						<div
							style="position: relative; overflow: hidden; padding-top: 10px; height: 20px;">
							<span id="shipping_cost_information"
								class="shipping_price_holder"><? print $this->session->userdata ( 'shop_shipping_cost' ) ?>
							</span>
							<div class='shipping_price_loading' style="height: 30px;"></div>
						</div>
					</li>
				</ul>
				<div class="clear" style="height: 5px; overflow: hidden"></div>
			</div>
		</div>
		<!-- Shipping Service. -->

		<? $itemCounter=1;?>
		<? foreach($cart_items as $key=>$val){?>
		<input type="hidden" name="item_name_<? echo $itemCounter; ?>"
			value="<? echo $val['item_name']; ?>"> <input type="hidden"
			name="amount_<? echo $itemCounter; ?>"
			value="<? echo $val['price']; ?>"> <input type="hidden"
			name="height_<? echo $itemCounter; ?>"
			value="<? echo $val['height']; ?>"> <input type="hidden"
			name="width_<? echo $itemCounter; ?>"
			value="<? echo $val['width']; ?>"> <input type="hidden"
			name="length_<? echo $itemCounter; ?>"
			value="<? echo $val['length']; ?>"> <input type="hidden"
			name="quantity_<? echo $itemCounter; ?>"
			value="<? echo $val['qty']; ?>">
		<?
			$itemCounter++;
		} ?>

		<a class="btn" href="javascript:void(0);"><input class="btnright" type="submit" value="Checkout With Paypal"></a>

</form>
<?}?></div>
		</div></div>
