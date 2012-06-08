<? //var_dump($form_values); ?>
<div class="bottom-content">
<div class="login">
<div class="login-b">
<form action="<? print site_url('users/user_action:login'); ?>" method="post" id="logIn">
 <h2 class="blue-title" style="margin: 0px;">Sign In</h2>
 <div style="height: 10px;overflow: hidden">&nbsp;</div>
 <div class="clear"><!--  --></div>
 <div>
    <label>Username or Email:</label>
    <div class="cinput">
        <input name="username" type="text" value="<? print $form_values['username'];  ?>" />
    </div>
 </div>
 <div>
    <label>Password</label>
    <div class="cinput">
        <input name="password" type="password" value="<? print $form_values['password'];  ?>" />
    </div>
 </div>
 <?php if ($this->session->userdata('login_attempts') >= 2) : ?>
 <div>
    <label>Secure text</label>
    <div class="cinput">
		<input type="text" name="captcha_code" size="10" maxlength="6" />
    </div>
    <small>Please enter the text from image below</small>
    <br /><br />
    <?php echo $captcha;?>
 </div>
 <?php endif; ?>
 
<div style="height: 10px;overflow: hidden">&nbsp;</div>
<a href="javascript:;" title="Login" class="submit btn" style="margin-right: 26px;">Login</a>
<!--[if IE 6]><input type="submit" value="" id="msie6userlogin" /><![endif]-->
or
<a href="<? print site_url('users/user_action:register'); ?>" class="ricon">Register</a>
<div class="br"></div>
<a href="<? print site_url('users/user_action:forgotten_pass'); ?>" class="ricon">Forgotten Password</a>
</form>



 </div>
  </div>



  <? //require (ACTIVE_TEMPLATE_DIR.'users/right_sidebar.php') ?>
</div>
