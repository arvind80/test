<script type="text/javascript">
$(document).ready(function() {
  /* var user_register_options = {
        //target:        '#output1',   // target element(s) to be updated with server response
		url:       '<? print site_url('main/mailform_send2'); ?>'  ,
		clearForm: true,
		type:      'post',
		contentType: 'multipart/form-data',

        beforeSubmit:  mail_form_showRequest,  // pre-submit callback
        success:       mail_form_showResponse  // post-submit callback

    };

    $('#contact_form').submit(function(){
        $(this).ajaxSubmit(options);
        return false;

    });
	
 
	*/
	
	
});



$(document).ready(function() {
	$(".user_registation_trigger").handleKeyboardChange(1000).change(function()
	{
	setUserRegistration()
	});
});



function setUserRegistration(){
var queryString = $('#register-form .user_registation_trigger').fieldSerialize();



$.ajax({
   type: "POST",
   async: true,
   url: "<? print site_url('ajax_helpers/users_register'); ?>",
   data: queryString,
   success: function(data){
	   if(data != 'ok'){
       alert(data);
	   }
   }
 });






//alert(queryString);
	
} 



</script>
