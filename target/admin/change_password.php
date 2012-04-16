<form name="change_password_frm" id="change_password_frm" onsubmit="return checkPasswordStrength();" method="post" action="process.php?action=changePassword">
			  <fieldset style="border: 0px solid #000000; font-size: 13px;border-radius: 5px 5px 5px 5px;background-color:#EEEEEE;width:800px;">
				<center><strong>
				</strong></center>
                <center><table width="700px"  cellspacing="10"  border="0"  cellpadding="0">
					<?php 
				if(isset($_REQUEST['msg'])&&$_REQUEST['msg']=='true'){
					echo "<tr><td><font color='green'>Password successfully Changed!</font></td></tr>";
				}if(isset($_REQUEST['msg'])&&$_REQUEST['msg']=='false'){
						echo "<tr><td><font color='red'>There is some problem in changing the password please try again!</font></td></tr>";
				}?>
					<tr><td colspan='2'><font color='skyblue'>Fill the form below to change your password!</font></td></tr>
					  <tr>
						<td>Current Password:<font color="#FF0000">*</font></td>
							<td><input name="current_password"  style="width:200px;" type="password" id="current_password"></td>
					  </tr>
					  <tr>
						<td>New Password:<font color="#FF0000">*</font></td>
						 <td> <input name="new_password"  type="password" onkeyup="validenter();" onkeydown="validenter();" onblur="checkPasswordStrength();" onfocus="passwordHelp();"  style="width:200px;" id="new_password">  <p id="password_help_error"> </p></td>
						
						</tr>
					  <tr>
						<td>Confirm New Password:<font color="#FF0000">*</font></td>
						  <td><input name="confirm_password" onblur="checkPasswordStrength();" type="password"  style="width:200px;" id="confirm_password"></td>
					</tr>
					<tr>
						<td height="5px"></td>
						<td><input type="submit" value="Change Password"/></td>
					</tr>
				</table></center>
         </fieldset>
            </form>
