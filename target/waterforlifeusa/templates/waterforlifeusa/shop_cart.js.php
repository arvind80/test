<script type="text/javascript">


function change_shop_currency($val){
 // alert(($("#shop_currency_celector").val()));

 $c =  $val;
 $.post("<? print site_url('ajax_helpers/cart_set_shop_currency'); ?>", { currency:$val , the_val: $c, random_stuff: Math.random() },
  function(data){
	 //showShippingCost();
	 window.location.reload()
  });
 
}

function  cart_ajax_form_submit(){
//$('.cart_ajax_form').submit();
}

function  cart_ajax_empty_no_confirm(){ 
$.ajax({
  url: "<? print site_url('ajax_helpers/cart_itemsEmptyCart'); ?>",
  async: false,
  success: function(html){
  }
});



/*$.post("<? print site_url('ajax_helpers/cart_itemsEmptyCart'); ?>", { name: "tesr"},
  function(data){
  
  });*/



}

function  cart_ajax_empty(){ 

		var answer = confirm("Are you sure you want to empty your bag?")
			if (answer){
				//alert("Bye bye!")
				//
				$.post("<? print site_url('ajax_helpers/cart_itemsEmptyCart'); ?>", { name: "John", time: "2pm" },
  function(data){
    //alert("Data Loaded: " + data);
	
	alert("Your bag is now empty. We will take you to the shop, so you can add some items.");
	window.location="<? print $link = $this->content_model->getContentURLByIdAndCache(2); ?>";
	//
	//$("#cart-items-qty").html(data);

//location.reload(true)

  });

				
			}
			else{
				//alert("Thanks for sticking around!")
			}


}
// prepare the form when the DOM is ready 



function add_to_cart($form_id){

//alert($form_id);
/*var queryString = $('#'+$form_id).formSerialize();
alert(queryString);
$.ajax({
   type: "POST",
   async: false,
   url: "<? //print site_url('ajax_helpers/cart_itemAdd'); ?>",
   data: queryString,
   success: function(data){
      alert(data);
   }
 });*/

 Modal.modaloverlay();
 var options123 = {
      url:'<? print site_url('ajax_helpers/cart_itemAdd'); ?>/',
     // dataType: 'xml',
	 type:      'post',
      success: function(response) {
       //
       cart_ajax_form_showResponse() 
      }
  };
  $('#'+$form_id).ajaxSubmit(options123);



$(Modal_popup.main).hide()
 $(Modal_popup.overlay).hide()



}

function go_to_field(item){
     var master = item.attr("master");
     var the_field = item.attr('field');
     $("html, body").animate({scrollTop: $("#" + the_field).offset().top});
     $("#" + the_field).focus();
}




$(document).ready(function() {



  /*  var options1 = {
        //target:        '#output1',   // target element(s) to be updated with server response
		//url:       '<? print site_url('ajax_helpers/cart_itemAdd'); ?>/'  ,
		clearForm: false,
		type:      'post',
      //  beforeSubmit:  cart_ajax_form_showRequest,  // pre-submit callback
        success:       cart_ajax_form_showResponse  // post-submit callback

    };

    $('.cart_ajax_form').submit(function(){
			 
        $(this).ajaxSubmit(options1);
        return false;

    });*/



update_the_cart_qty_in_header();

    $("#go-to-step-1").click(function(){
        var stepper = document.getElementById('stepper');
        if(stepper.className!='state-1'){
            $("#stepper").not(":animated").animate({'left':'0px'});
            stepper.className='state-1';
        }
        $(".steplist a").removeClass("active");
        $(".steplist2 a").removeClass("active");
        $(this).addClass("active");
        $(".steplist2 a").eq(0).addClass("active");
        return false;
    });

    $("#go-to-step-2").click(function(){
        var stepper = document.getElementById('stepper');
        if(stepper.className!='state-2'){
            $("#stepper").not(":animated").animate({'left':'-503px'});
            stepper.className='state-2';
        }
        $(".steplist a").removeClass("active");
        $(".steplist2 a").removeClass("active");
        $(this).addClass("active");
        $(".steplist2 a").eq(1).addClass("active");
        return false;
    });

    $("#go-to-step-3").click(function(){
        var stepper = document.getElementById('stepper');
        if(stepper.className!='state-3'){
            $("#stepper").not(":animated").animate({'left':'-1007px'}, function(){
                        oform = $("#step2");
                        require(oform);
                        checkMail(oform);
						is_valid_shipping_zipcode();
						
                        //Final check
                        if(oform.find(".error").length>0){
                            oform.addClass("error");
                            if(oform.hasClass("show-error-fields")){
                              oform.find(".info-errors-object").html("");
                              oform.find(".info-errors-object").append("<h2>Please fill out all required fields: </h2>");
                              oform.find(".error").each(function(i){
                                var field_title = $(this).parent().find("label").html();
                                var field_parent = $(this).parents(".the_step:first").attr("id");
                                var field_paret_index = field_parent.charAt(field_parent.length-1);
                                var to_focus = $(this).parents(".mtf").find("input").attr("id");
                                oform.find(".info-errors-object").append((i+1) + ".&nbsp;<a href='javascript:;' master='"+ field_paret_index + "' field='" + to_focus + "' onclick='go_to_field($(this))'>" + field_title + "</a><br />");
                              });
                            }
                            oform.addClass("submitet");
                        }

                        else{
                            oform.removeClass("error");
                            oform.find(".info-errors-object").html("");
                        }


            
            });
            stepper.className='state-3';
        }
                $(".steplist a").removeClass("active");
                $(".steplist2 a").removeClass("active");
        $(this).addClass("active");
        $(".steplist2 a").eq(2).addClass("active");
        return false;

    });





});    

 
// post-submit callback
function cart_ajax_form_showResponse()  {
      update_the_cart_qty_in_header();
    //  alert(responseText)
      //alert('Your items are added to the shopping cart!');
	  $("#cart-add-success").modal("htmlbox");

}


function update_the_cart_qty_in_header(){
//$("#cart-items-qty").fadeOut();
$.post("<? print site_url('ajax_helpers/cart_itemsGetQty'); ?>", { name: "John", time: "2pm" },
  function(data){
    $("#cart-items-qty").html(data);
    if(data=="0"){
       $("#cartico").attr("class", "empty-cart-ico");
    }
    else{
      $("#cartico").attr("class", "full-cart-ico");
    }

	//$("#cart-items-qty").fadeIn();
  });

}


function cart_itemsGetTotal(){ 
$.post("<? print site_url('ajax_helpers/cart_itemsGetTotal'); ?>", { name: "John", time: "2pm" },
  function(data){
	return data;
  });
}













$(document).ready(function() {
    cart_checkPromoCode()
	showShippingCost();
	setBillingInfo();
});

function cart_pre_checkout_update_the_total_price(){
$('#total_price_for_whole_cart').fadeOut();


$.ajax({
   type: "POST",
   async: false,
   url: "<? print site_url('ajax_helpers/cart_itemsGetTotal'); ?>",
  //data: "name=John&location=Boston",
   success: function(data){
       $('#total_price_for_whole_cart').html(data); 
	   $('#total_price_for_whole_cart').fadeIn();
   }
 });

}





function cart_sumByField($fld){ 
$rand = Math.random();
var msg1 = false
	$.ajax({
	   type: "POST",
	   url: "<? print site_url('ajax_helpers/cart_sumByField'); ?>",
	   data: "field="+$fld+"&rand="+$rand,
	   async : false,
	   success: function(msg){
		   msg1 = msg;
	  // return msg;
	   }
	 });
	return msg1;
}




function cart_modify_item_properties($item_id_in_cart, $propery_name, $new_value){ 
$.ajax({
   type: "POST",
   url: "<? print site_url('ajax_helpers/cart_ModifyItemProperties'); ?>",
   data: "id="+$item_id_in_cart+"&propery_name="+$propery_name+"&new_value="+$new_value,
   async: false,
   success: function(data){
		var single_price_for_cart_item_id = $('#single_price_for_cart_item_id_'+$item_id_in_cart).html();
		single_price_for_cart_item_id = parseFloat(single_price_for_cart_item_id);
		var qty_for_cart_item_id = $('#qty_for_cart_item_id_'+$item_id_in_cart).val();
		qty_for_cart_item_id = parseFloat(qty_for_cart_item_id);
		
		$('#total_price_for_cart_item_id_'+$item_id_in_cart).html(qty_for_cart_item_id*single_price_for_cart_item_id);
		update_the_cart_qty_in_header();
		cart_pre_checkout_update_the_total_price();
		cart_checkPromoCode();
		showShippingCost();

   }
 });
}

function getPackageProperties(){
	$package_height =  cart_sumByField($fld);
}


function cart_remove_item_from_cart($item_id_in_cart){ 
var answer = confirm("Are you sure you want to remove this item from your bag?")
	if (answer){
	
	
		$.ajax({
		type: "POST",
		async: false,
		url: "<? print site_url('ajax_helpers/cart_removeItemFromCart'); ?>",
		data: "id="+$item_id_in_cart,
		success: function(data){
		
		 
				
				
				
				
				
				$.post("<? print site_url('ajax_helpers/cart_itemsGetQty'); ?>", { name: "John", time: "2pm" },
				function(data){
				data = parseInt(data);
				if(data == 0){
				alert("Your bag is now empty. We will take you to the shop, so you can add some items.");
				window.location="<? print $link = $this->content_model->getContentURLByIdAndCache(2); ?>";
				} else {
					$('#item_row_'+$item_id_in_cart).fadeOut();
					
					
					
					
				update_the_cart_qty_in_header();
				cart_pre_checkout_update_the_total_price();
				cart_checkPromoCode();
				showShippingCost();
				}
				});
		}
		});

	}
	else{
		
	}
 
}



function cart_checkPromoCode(){ 
//
var code_check = $('#the_promo_code_input').val();
 $.post("<? print site_url('ajax_helpers/cart_getPromoCode'); ?>", { code: code_check, time: "2pm" },
  function(data){
	  
	  
	 if((data) && (data) != ''){ 
  if(parseInt(data) != 0){
	  
	  
	  
  var myPromoObject = eval('(' + data + ')');
  $('#the_promo_code_status').show();
  $('#the_promo_code_status').html(myPromoObject.description);
  
  $.post("<? print site_url('ajax_helpers/cart_getTotal'); ?>", { name: "John", time: "2pm" },
  function(data2){
	//alert(data2);
	 var old_price = $('#total_price_for_whole_cart').html();
	 old_price = parseInt(old_price);
	 
	  var new_price =data2;
	  new_price = parseInt(new_price);
	  
	  if(old_price != new_price){
	  $('#total_price_for_whole_cart').css('textDecoration', 'line-through');
	  $('#new_price_for_whole_cart').html(new_price);
	  } else {
	    $('#total_price_for_whole_cart').css('textDecoration', 'none');
	   $('#new_price_for_whole_cart').html('');
	  }
  });
  
  
  }
  
  
  
  
  
  } else {
  $('#the_promo_code_status').hide();
   $('#total_price_for_whole_cart').css('textDecoration', 'none');
	   $('#new_price_for_whole_cart').html('');
  }
  
	 //$('#total_price_for_whole_cart').html(data); 
	// $('#total_price_for_whole_cart').fadeIn();
  });

}





function changeBillingCountry(){

$c =  $('#billing_country').val();

 $.post("<? print site_url('ajax_helpers/set_session_vars'); ?>", { the_var:'billing_country' , the_val: $c, time: "2pm" },
  function(data){
	 //showShippingCost();
  });

}


function populateBillingInfo()
{

 /*
$temp = $('#billing_first_name').val();
//alert($temp );
if($temp == ''){
	$('#billing_first_name').val($('#shipping_first_name').val());
}
	$temp = $('#billing_last_name').val();
if($temp == ''){
	$('#billing_last_name').val($('#shipping_last_name').val());
}

		$temp = $('#billing_company_name').val();
if($temp == ''){
	$('#billing_company_name').val($('#shipping_company_name').val());
}

			$temp = $('#billing_user_email').val();
if($temp == ''){
	$('#billing_user_email').val($('#shipping_user_email').val());

}

				$temp = $('#billing_user_phone').val();
if($temp == ''){
	$('#billing_user_phone').val($('#shipping_user_phone').val());
}
	$('#billing_country').val('US');

					$temp = $('#billing_city').val();
if($temp == ''){

	$('#billing_city').val($('#shipping_city').val());

}

						$temp = $('#billing_address').val();
if($temp == ''){
	$('#billing_address').val($('#shipping_address').val());
}

							$temp = $('#billing_state').val();
if($temp == ''){
	$('#billing_state').val($('#shipping_state').val());
}

						$temp = $('#billing_zip').val();
if($temp == ''){
		$('#billing_zip').val($('#shipping_zip').val());

}

*/
	

	
}










$(document).ready(function() {



 $("#PERSONAL_INFO input[type='text'], #PERSONAL_INFO select").bind("change keyup", function(){
    if($("#same").is(":checked")){

        var val = $(this).val();
        var name = $(this).attr("name");
        var name = name.replace(/shipping/g, 'billing');
        $("[name=" + name + "]").val(val);

    }

  });





	$(".shipping_cost_calculation_trigger").handleKeyboardChange(500).change(function()
	{
	showShippingCost();
	});
	
	
	$(".billing_info_trigger").handleKeyboardChange(500).change(function()
	{
	setBillingInfo();
	});
	
	
	$("#shipping_zip").change(function() {
	shipping_road_map_calcRoute();							   						   
	});
	
});



function setBillingInfo(){  
	if($("#card-check-status-error").exists()){
			$('#card-check-status-error').fadeOut();
			var queryString = $('.billing_info_trigger').fieldSerialize();
			$.ajax({
			type: "POST",
			async: true,
			url: "<? print site_url('ajax_helpers/set_session_vars_by_post'); ?>",
			data: queryString,
			success: function(data){
			 //  alert(data);
			}
			});
			
			
			
			/*if($("#billing_cvv2").exists()){
				if($("#card-check-status").exists()){
				$billing_cvv2 = $('#billing_cvv2').val();
				$billing_cvv2_l =  $('#billing_cvv2').val().length;
						if($billing_cvv2_l > 2){
				
							$.ajax({
							   type: "POST",
							   async: true,
							   url: "<? //print site_url('ajax_helpers/cart_check_cc'); ?>",
							  // data: "the_var=billing_first_name&the_val="+$billing_first_name,
							   success: function(data){
									if(data == 'error'){
										 $('#card-check-status-error').fadeIn();
									} else {
										//alert(data);
										$("#card-check-status-error").html(data);
										 $('#card-check-status-error').fadeIn();
										 
									}
								   
								   
							   }
							 });
						}
					
				}
			
			}*/
			
			
			
			}
}








/*

if($("#billing_first_name").exists()){
$billing_first_name = $('#billing_first_name').val();
$billing_first_name_old_val = "<? print $this->session->userdata ( 'billing_first_name' ) ?>"
	if($billing_first_name != $billing_first_name_old_val){
	$.ajax({
	   type: "POST",
	   async: true,
	   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
	   data: "the_var=billing_first_name&the_val="+$billing_first_name,
	   success: function(data){
	   }
	 });
	}
}

if($("#billing_last_name").exists()){
$billing_last_name = $('#billing_last_name').val();
$billing_last_name_old_val = "<? print $this->session->userdata ( 'billing_last_name' ) ?>"
	if($billing_last_name != $billing_last_name_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_last_name&the_val="+$billing_last_name,
   success: function(data){
      
   }
 });
	}
}


if($("#user_email").exists()){
$user_email = $('#user_email').val();
$user_email_old_val = "<? print $this->session->userdata ( 'user_email' ) ?>"
	if($user_email != $user_email_old_val){
		$.ajax({
		   type: "POST",
		   async: true,
		   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
		   data: "the_var=user_email&the_val="+$user_email,
		   success: function(data){
			  
		   }
		 });
	}
}

if($("#user_phone").exists()){
$user_phone = $('#user_phone').val();
$user_phone_old_val = "<? print $this->session->userdata ( 'user_phone' ) ?>"
	if($user_phone != $user_phone_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=user_phone&the_val="+$user_phone,
   success: function(data){
      
   }
 });
	}
}
 

if($("#billing_city").exists()){
$billing_city = $('#billing_city').val();
$billing_city_old_val = "<? print $this->session->userdata ( 'billing_city' ) ?>"
	if($billing_city != $billing_city_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_city&the_val="+$billing_city,
   success: function(data){
      
   }
 });
	}
}


 

if($("#billing_address").exists()){
$billing_address = $('#billing_address').val();
$billing_address_old_val = "<? print $this->session->userdata ( 'billing_address' ) ?>"
	if($billing_address != $billing_address_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_address&the_val="+$billing_address,
   success: function(data){
      
   }
 });
	}
}


if($("#billing_state").exists()){
$billing_state = $('#billing_state').val();
$billing_state_old_val = "<? print $this->session->userdata ( 'billing_state' ) ?>"
	if($billing_state != $billing_state_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_state&the_val="+$billing_state,
   success: function(data){
      
   }
 });
	}
}




if($("#billing_zip").exists()){
$billing_zip = $('#billing_zip').val();
$billing_zip_old_val = "<? print $this->session->userdata ( 'billing_zip' ) ?>"
	if($billing_zip != $billing_zip_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_zip&the_val="+$billing_zip,
   success: function(data){
      
   }
 });
	}
}


if($("#billing_company_name").exists()){
$billing_company_name = $('#billing_company_name').val();
$billing_company_name_old_val = "<? print $this->session->userdata ( 'billing_company_name' ) ?>"
	if($billing_company_name != $billing_company_name_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_company_name&the_val="+$billing_zip,
   success: function(data){
      
   }
 });
	}
}


if($("#billing_cardholdernumber").exists()){
$billing_cardholdernumber = $('#billing_cardholdernumber').val();
$billing_cardholdernumber_old_val = "<? print $this->session->userdata ( 'billing_cardholdernumber' ) ?>"
	if($billing_cardholdernumber != $billing_cardholdernumber_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_cardholdernumber&the_val="+$billing_cardholdernumber,
   success: function(data){
      
   }
 });
	}
}

if($("#billing_expiresmonth").exists()){
$billing_expiresmonth = $('#billing_expiresmonth').val();
$billing_expiresmonth_old_val = "<? print $this->session->userdata ( 'billing_expiresmonth' ) ?>"
	if($billing_expiresmonth != $billing_expiresmonth_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_expiresmonth&the_val="+$billing_expiresmonth,
   success: function(data){
      
   }
 });
	}
}



if($("#billing_expiresyear").exists()){
$billing_expiresyear = $('#billing_expiresmonth').val();
$billing_expiresyear_old_val = "<? print $this->session->userdata ( 'billing_expiresyear' ) ?>"
	if($billing_expiresyear != $billing_expiresyear_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_expiresyear&the_val="+$billing_expiresyear,
   success: function(data){
      
   }
 });
	}
}


if($("#billing_cvv2").exists()){
$billing_cvv2 = $('#billing_cvv2').val();
$billing_cvv2_old_val = "<? print $this->session->userdata ( 'billing_cvv2' ) ?>"
	if($billing_cvv2 != $billing_cvv2_old_val){
$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=billing_cvv2&the_val="+$billing_cvv2,
   success: function(data){
      
   }
 });
	}
}





*/



  $(document).ready(function(){
							 
							 $(".mwdisable").ajaxStart(function(){
								$(this).xDisable();							  
							});
							 $(".mwdisable").ajaxStop(function(){
								$(this).xEnable();							  
							});
    
$(".shipping_price_holder").click(function () {
      $(this).effect("highlight", {}, 3000);
});


$("#total_price_for_whole_cart").click(function () {
      $(this).effect("highlight", {}, 3000);
});

$("#order_uid_span").click(function () {
      $(this).effect("highlight", {}, 3000);
})


/* $(".shipping_price_holder").effect("highlight", {}, 3000);
 $("#total_price_for_whole_cart").effect("highlight", {}, 3000);

*/

  });





function showShippingCost(){



 if($(".shipping_cost_calculation_trigger").exists()){
        $(".shipping_price_loading").fadeIn('fast');
		var queryString = $('.shipping_cost_calculation_trigger').fieldSerialize();
			$.ajax({
			type: "POST",
			async: true,
			url: "<? print site_url('ajax_helpers/set_session_vars_by_post'); ?>",
			data: queryString,
			success: function(data){
					$.ajax({
					   type: "POST",
					   async: true,
					   url: "<? print site_url('ajax_helpers/cart_shippingCalculateUPS'); ?>",
					  // data: "the_var=shipping_to_city&the_val="+$shipping_to_city,
					   success: function(data){
						   $('#shipping_price').html(data);
						   $('.shipping_price_holder').html(data);
						   
						   
			 if(data == 0){
			 $('#shipping_zip').parent().addClass("error");
			 } else {
			 $('#shipping_zip').parent().removeClass("error");
			 }
	
						   

						   var parseData = parseFloat(data);
						   if(isNaN(parseData)){
							 //$('.shipping_price_holder').html('enter valid zip code');

                			 if($("#shipping_cost_information").exists()){
								 $('#shipping_map_canvas').hide();
								  //$('.currency_sign').fadeOut();
        						$('.shipping_price_holder').val(data);
								$('#payment_form_shipping').val(data);
                                $('.shipping_price_holder').html(data);
								  $('#shipping_zip').parent().addClass("error");
                                  $(".currency_sign span").html("");
								// $("#billing_zip").val("");
							   //  $("#billing_zip").parent().addClass("error");
                                 $("#step2").addClass("error");
                                 //document.getElementById('step2').className = document.getElementById('step2').className + ' error';
                                 //alert("error");


                       /* validate */

                        oform = $("#step2");
                        require(oform);
                        checkMail(oform);
						is_valid_shipping_zipcode();

                        //Final check
                        if(oform.find(".error").length>0){
                            oform.addClass("error");
                            if(oform.hasClass("show-error-fields")){
                              oform.find(".info-errors-object").html("");
                              oform.find(".info-errors-object").append("<h2>Please fill out all required fields: </h2>");
                              oform.find(".error").each(function(i){
                                var field_title = $(this).parent().find("label").html();
                                var field_parent = $(this).parents(".the_step:first").attr("id");
                                var field_paret_index = field_parent.charAt(field_parent.length-1);
                                var to_focus = $(this).parents(".mtf").find("input").attr("id");
                                oform.find(".info-errors-object").append((i+1) + ".&nbsp;<a href='javascript:;' master='"+ field_paret_index + "' field='" + to_focus + "' onclick='go_to_field($(this))'>" + field_title + "</a><br />");
                              });
                            }
                            oform.addClass("submitet");
                        }
                        else{
                            //oform.removeClass("error");
                            oform.find(".info-errors-object").html("");
                        }



                           /* /validate */





							 }
						   } else {

        						$('.shipping_price_holder').val(data);
								$('#payment_form_shipping').val(data);
								//$('.currency_sign').fadeIn();
                                $('.shipping_price_holder').html("");
                                $(".currency_sign span").html(data);

                                 $("#step2").removeClass("error");
                                 //alert("No error");


							// $(".shipping_price_holder").effect("transfer", {}, 1000);

						   }
					       $(".shipping_price_loading").fadeOut('fast');






						   
					   }
					 });
			   
			   
			   
			   
			   
			   
			   
			   
			}
			});


 }






/*



if($("#shipping_address_type").exists()){
$shipping_address_type = $('#shipping_address_type').val();
$.ajax({
   type: "POST",
   async: false,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=shipping_address_type&the_val="+$shipping_address_type,
   success: function(data){
      
   }
 });

}

if($("#shipping_service").exists()){
	$shipping_service = $('#shipping_service').val();
	
	$.ajax({
   type: "POST",
   async: false,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=shipping_service&the_val="+$shipping_service,
   success: function(data){
      
   }
 });
 
	
	
 
}

if($("#shipping_to_zip").exists()){
$shipping_to_zip = $('#shipping_to_zip').val();



	$.ajax({
   type: "POST",
   async: false,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=shipping_to_zip&the_val="+$shipping_to_zip,
   success: function(data){
      
   }
 });


  
}

if($("#shipping_to_city").exists()){
	//alert(1);
$shipping_to_city = $('#shipping_to_city').val();



$.ajax({
   type: "POST",
   async: false,
   url: "<? print site_url('ajax_helpers/set_session_vars'); ?>",
   data: "the_var=shipping_to_city&the_val="+$shipping_to_city,
   success: function(data){
      
   }
 });


 
}

 
 



$.ajax({
   type: "POST",
   async: false,
   url: "<? print site_url('ajax_helpers/cart_shippingCalculateUPS'); ?>",
  // data: "the_var=shipping_to_city&the_val="+$shipping_to_city,
   success: function(data){
       $('#shipping_price').html(data);

	   $('.shipping_price_holder').html(data);

       var parseData = parseFloat(data);
       if(parseData<1){
         if($("#shipping_cost_information").exists()){
            // $("#billing_zip").val("");
           //  $("#billing_zip").parent().addClass("error");
         }
       }

	   $('.shipping_price_holder').val(data);
   }
 });*/


 

 

}
/*
function aff_test(){
	
PostAffTracker.setAccountId('default1');
var sale = PostAffTracker.createSale();
sale.setTotalCost('120.50');
sale.setOrderID('ORD_12345XYZ');
sale.setProductID('test product');

PostAffTracker.register();	
}*/

function confirmPayment(){
	  

	 $am = '<? print $this->cart_model->itemsGetTotal( $this->session->userdata ( 'cart_promo_code' ), $this->session->userdata ( 'shop_currency' ) ) ?>';
	 //alert($am);
	 
  // $("a.confirm_payment").attr("href", "javascript:;");
  $("a.confirm_payment").animate({"opacity":"0.7"}, 'fast');
   $(".confirm_payment").fadeOut();
   
  $(".shipping_price_loading").show();
	$.ajax({
	  type: "POST",
	  data: "",
	  async: false,
	  url: "<? print site_url('ajax_helpers/cart_check_cc'); ?>",
	  success: function(r) {
		 
		 
		 if(r == 'ok'){
			  //
			  var shareasale_trackimg_src = 'https://shareasale.com/sale.cfm?amount='+$am+'&tracking=<? print $this->session->userdata ( 'order_id' ) ?>&transtype=sale&merchantID=30147'
            $('#shareasale_trackimg').attr("src", shareasale_trackimg_src);
		  
		 
			
			
			//  alert(shareasale_trackimg_src);
			  
			  PostAffTracker.setAccountId('default1');
var sale = PostAffTracker.createSale();
//sale.setTotalCost('<? print $this->session->userdata ( 'amount' ) ?>');
sale.setTotalCost($am);



sale.setOrderID('<? print $this->session->userdata ( 'order_id' ) ?>');
//sale.setProductID('test product');

<? if($this->session->userdata ( 'ref' ) != ''): ?>
sale.setAffiliateID('<? print $this->session->userdata ( 'ref' ) ?>');
<? elseif($_COOKIE['referrer_id'] != ''): ?>
sale.setAffiliateID('<? print $_COOKIE['referrer_id'] ?>');
<? else: ?>


<? endif; ?>
 
sale.setStatus('A');

PostAffTracker.register();
 
 
try{

var pageTracker = _gat._getTracker("UA-1065179-41");
pageTracker._trackPageview('thankyou.html');
} catch(err) {}
 
//alert(1);




			   cart_ajax_empty_no_confirm();
			  
			   $("#payment_must_be_ok").fadeOut();
			   $("#payment_is_ok").fadeIn();
			  
			  
			  
			  // setTimeout(function(){ window.location.href="";}, '1000');
		 
		  
		  
		  
		  
		  
		  } else {
			   
//alert(r);
			//Modal.box("Your data is incorect! Please, edit it! " + r, 200, 100);
           
		   
		   //pecata
		    $("#shop_confirm_wrap").fadeOut();
            $(".confirm_payment").fadeOut();
            $("#content").css("height", "700px");
            $("#confirm-order-error").show();
            $("#in-banner").remove(); 
            $(".confirm-error-box").html(r);
            $(".confirm-error-box").show();
			$("#wfl-policies-payment-link").fadeOut();
			


			/* TODO
			da pokazwa DIV s tozi nadpis
			
			*/
		  }
          $(".shipping_price_loading").hide();
	  }
	});
}











$.fn.xDisable = function(opacity) {
      $(this).each(function(){
        var d = $(this);
        var w = d.outerWidth();
        var h = d.outerHeight();
        var o = document.createElement('div');
        o.id = d.attr('id') + '-overlay';
        o.style.width = w+'px';
        o.style.height = h+'px';
        o.style.position = 'absolute';
        o.style.zIndex = '20';
        o.style.top = 0;
        o.style.left = 0;
        o.style.background = 'white';
        if(opacity!=undefined){
          o.style.opacity = opacity;
          o.style.filter = 'alpha(opacity=' + (opacity*100) + ')';
        }
        else{
          o.style.opacity = 0.1;
          o.style.filter = 'alpha(opacity=10)';
        }
        d.append(o);
      });
};

$.fn.xEnable = function() {
    $(this).each(function(){
      var d = $(this);
      var id = d.attr('id');
      $("#" + id + '-overlay').remove();
    });
};


</script>
