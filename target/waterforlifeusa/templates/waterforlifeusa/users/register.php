

         <script type="text/javascript">
            $(document).ready(function(){
               $("#ctandc").attr("checked", "");
            });

         </script>



<? //var_dump($form_values); ?>

<div class="bottom-content">
  <div style="float:right;width:300px"><? require (ACTIVE_TEMPLATE_DIR.'users/right_sidebar_new.php') ?></div>
  <div class="login">
  <div class="login-b">
    <? if($user_registration_done != true) : ?>
    <? if(!empty($user_register_errors)) : ?>
    <ul class="error">
      <? foreach($user_register_errors as $k => $v) :  ?>
      <li><? print $v ?></li>
      <? endforeach; ?>
    </ul>
    <? endif ?>
    <form action="<? print site_url('users/user_action:register'); ?>" method="post" id="regform" class="validate">
    <h2 class="blue-title">Register<em> *</em></h2>
    <div class="clear"></div>
     <div class="regw">
      <label><strong>Username:<em> *</em> </strong></label>
        <input maxlength="13" class="first_input typetext required" name="username" type="text" value="<? print $form_values['username'];  ?>">

      </div>
      <div class="regw">
      <label><strong>Email:<em> *</em></strong></label>
        <input class="first_input typetext required-email" name="email" type="text" value="<? print $form_values['email'];  ?>">

      </div>
      <div class="regw">
      <label><strong>Password:<em> *</em> </strong></label>
        <input class="first_input typetext required" name="password" type="password" value="<? print $form_values['password'];  ?>">

      </div>
      <div class="regw">
      <label><strong>Retype Password:<em> *</em> </strong></label>
        <input class="first_input typetext required" name="password2" type="password" value="<? print $form_values['password2'];  ?>">
       </div>


       <div class="regw">
         <label><strong>First Name:<em> *</em> </strong></label>
         <input type="text" class="typetext required" name="first_name" />
       </div>
       <div class="regw">
         <label><strong>Last Name:<em> *</em> </strong></label>
         <input type="text" class="typetext required" name="last_name" />
       </div>




             <span class="clear" style="display:block;"><!--  --></span>
              <div>
                <label><strong>Country:<em> *</em> </strong></label>
                <select style="" name="location_country" id="location_country" class="required"><?php include("darjavi.php"); ?></select>
              </div>
              <span class="clear" style="display:block;padding:3px 0"><!--  --></span>
               <div class="regw">
                <label><strong>City:<em> *</em> </strong></label>


                 <!--<samp style="display:block;height:5px"></samp>-->
                  <input class="typetext required" type="text" name="location_city" id="location_city" />
                  <select style="display:none" id="gradove" class="vetrove">  <?php include("gradove.php"); ?>  </select>
               </div>


              <div class="regw">
                <label><strong>Address<em> *</em></strong></label>
                <input type="text" class="typetext required" name="reg_address" />
              </div>
              <div class="regw">
                <label><strong>ZIP/Postal Code<em> *</em></strong></label>
                <input type="text" class="typetext required" name="reg_zip" />
              </div>



               <div class="regw">

         <label><strong>Your Order Number: <em> *</em></strong></label>
         <input type="text" class="typetext required" name="order_id" />
         <br />

         <small>Please provide the order number of your WFL water ionizer purchase.</small>
         
         
         
       </div>

		<div class="regw">
			<label><strong>Secure Text:<em> *</em> </strong></label>
			<input class="first_input typetext required" name="captcha_code" type="text" value="">
       </div>

		<div class="regw" style="padding-top: 20px;">
			<?php echo $captcha; ?>
       </div>
       
       <div class="regw">

         <label><strong>Affiliate: </strong></label>
         <input type="text" class="typetext" name="parent_affil"  />
         <br />

         <small>Here you can write down your refering affiliate if you have such.</small>
         
         
         
       </div>

    <div style="clear: both;height: 12px;overflow: hidden">&nbsp;</div>

<script>
$(document).ready(function(){
$("#location_country").change(function(){
                if($(this).val()=='Bulgaria'){
                    $("#gradove").show();
                }
                else{
                    $("#gradove").hide();
                }
             });

             $("#gradove").change(function(){
                var gradove_val = $(this).val();
                var valTML = $("#gradove option:eq(" + gradove_val + ")").html();
                $("#location_city").val(valTML);
             });

             $("#logIn").submit(function(){
                if($("#location_city").exists()){
                    var chk = document.getElementById('ctandc');
                    if(!chk.checked){
                         //alert(1);
                         return false;
                    }

                }
             });

            $("#ctandc").click(function(){
                $("#disable_submit").toggle();
            });


});
</script>



          <style type="text/css">
            .t_and_c label{
              font:  11px Verdana;
              color: black;
              display: block;
              width: 455px;
              float: left;
              padding: 0 !important;

            }
                        .t_and_c input{
                        width: auto !important;
                        float: left;
                       margin-right: 5px;
            }
            .t_and_c{
              overflow: visible !important;
              width: 485px;
            }


          </style>
         <div class="t_and_c">
            <input type="checkbox" name="tandc" id="ctandc" />
            <label for="ctandc">I certify that I have read and agree to the <a href="<? print $this->content_model->getContentURLById(98) ; ?>" target="_blank">"Water for life USA" Terms of Service and "Water for life USA" Privacy Policy</a>.</label>
         </div>

         <div style="clear: both;height: 12px;overflow: hidden">&nbsp;</div>

         <a href="javascript:;" class="submit btn">Register</a>
         <span id="disable_submit" class="submit">&nbsp;</span>




          <? else: ?>


        <h1 id="success" class="tvtitle tvorange">Registration Successful</h1>

        <p><strong>Thank you for registering.</strong> </p>

        <p>
        <a style="font:bold 12px Arial;color:#555" href="<? print site_url('users/user_action:login'); ?>">To log in you have to enter your username and password.</a></p>


    <?  endif ; ?>
    </form></div></div>

   <!--  <a href="<? print site_url('users/user_action:login'); ?>">Влез</a>--> </div>


