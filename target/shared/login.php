<div id="popup_bg_pass" style="background:#333; width:100%; display:none; height:100%; position:fixed; z-index:11; opacity:1.0;"></div>
<div id="popup_form_pass" class="demo" style="display:none;float:left;background:#fff; width:450px; position:relative;top:200px;left:400px; z-index:5000; -moz-border-radius: 10px 30px;border:solid 5px #49A4CB;padding:20px;" >
<div class="close_dd_pass" style="position:relative;" id=""><a href="javascript::void" id="button_close" style="position:absolute;right:-40px; top:-38px;"><img src="images/close.png" alt="" /></a></div>
<form name="forget_pass" id="forget_pass" method="post" >
<table id="forget_pass_tab" name="forget_pass_tab">
<tr><td colspan="2">Recover Password!</td></tr>
<tr><td colspan="2" height="30px"></td></tr>

<tr><td>Email Id</td>
<td><input type="text" name="email_pass" id="email_pass" class="required"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Reset Password"></input></td>
</table>
</form>
<script>$("#forget_pass").validate({
									rules:{
										"email_pass":{
										required:true,
										email:true }
										}
									});
									$(function() {$("#popup_form_pass" ).tabs();$( "input:submit,a,button", ".demo" ).button();});</script>
</div>
<div id="popup_msg_pass" style="display:none;color:float:left;background:#fafafa; height:100px; line-height: 50px; text-align: center; text-transform: uppercase; width:280px; position:relative;top:300px;left:440px; z-index:50; -moz-border-radius: 10px 30px; border: 5px solid #49A4CB; font-size: 15px;"></div>

<?php 
	print <<<LoginForm
	<div>
	<div class="cont_header">
	<div class="header">
		<span style="width:300px;float:right;padding-top:50px;color:#03E6FC;font-size:18px;"><h1>Target</h1></span>
		<img src="images/logo.png" style="height:100px;"/> 
		
	</div>
	<hr style="color:#1484E6;width:100%;"/>
	</div>
	<!-- cont_header -->
	
	<div class="cont_content" style="min-height:400px;">
	<div class="main">
	<div class="demo">
	<fieldset style="background: none repeat scroll 0 0 #F0F0F6;
    border: 1px solid #000000;
    border-radius: 5px 5px 5px 5px;
    padding: 20px;
    color:#292A36;
     height:180px;
    width: 500px;">
   
	<legend><h2>Login</h2></legend>
	<form style="width:300px; padding-left:53px; float:left;"  method="POST" id="loginform"  name="loginform" onsubmit="return checkLogin();">
		<table>
			<tr>
				<td><table align="center">
		<tr ><td colspan='2' id="eroorlogin"></td></tr>
		<tr><td height="25px"></td></tr>
		<tr ><td style="color:#000;">Email<font color="#FF0000">*</font></td><td><input type="text" name="email" id="email"></input></td></tr>
		<tr><td height="5px"></td></tr>
		<tr ><td style="color:#000;">Password<font color="#FF0000">*</font></td><td><input type="password" name="password" id="password" ></input></td></tr>
		<tr><td height="5px"></td></tr>
		<tr ><td  align="right"><input type="submit" value="Login"></input></td><td><span onmouseover="this.style.cursor='pointer'" style="color:#2E303C;float:right;" onclick="forgetpass()">Forget Password</span></td>
		</tr>
		<tr></tr>
		</table></td>
				<td> <img src="images/lock.png" style="height:100px;"/></td>
			</tr>
		</table>
	</form>
	</fieldset>
	</div>
	</div> <!-- main div -->
	</div> <!-- cont_content -->
</div>
LoginForm;
?>
