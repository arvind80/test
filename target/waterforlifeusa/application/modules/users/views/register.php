<?php // echo $this->validation->error_string; ?>

<form method="post">

<h5>Username</h5>
<?php echo $this->validation->username_error; ?>
<input type="text" name="username" value="<?php echo $this->validation->username;?>" size="50" />

<h5>Password</h5>
<?php echo $this->validation->password_error; ?>
<input type="text" name="password" value="<?php echo $this->validation->password;?>" size="50" />

<h5>Password Confirm</h5>
<?php echo $this->validation->passconf_error; ?>
<input type="text" name="passconf" value="<?php echo $this->validation->passconf;?>" size="50" />

<h5>Email Address</h5>
<?php echo $this->validation->email_error; ?>
<input type="text" name="email" value="<?php echo $this->validation->email;?>" size="50" />

<h5>Accept terms</h5>
<?php echo $this->validation->accept_error; ?>

<input type="radio" name="accept" value="1" <?php echo $this->validation->set_radio('accept', '1'); ?> />Yes<br />
<input type="radio" name="accept" value="0" <?php echo $this->validation->set_radio('accept', '0'); ?> />No<br />


<h5>Capcha</h5>
<?php echo $this->validation->accept_error; ?>
<img src="<? print site_url('me/captcha') ?>" />
<input type="text" name="captcha" value="<?php echo $this->validation->captcha;?>" size="5" />

<div><input type="submit" value="Submit" /></div>

</form>            