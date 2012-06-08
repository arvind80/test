<form action="<? print site_url('users/user_action:forgotten_pass'); ?>" method="post" id="frgpass">
<?php 
	if($error):
?>
<div style="color:red"><?php print $error;?></div>
<?php endif;?>
<?php 
	if($ok):
?>
<div style="color:blue"><?php print $ok;?></div>
<?php endif;?>
<table>
	<tr>
		<td>Please, enter your email and we will send your password: <input type="text" name="email" id="email" /></td>
		<td><input type="submit" value="Send" /></td>
	</tr>
</table>
</form>