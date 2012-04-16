<div id="popup_bg_edit" style="background:#333; color:ffffff; width:100%; display:none; height:100%; position:fixed; left:0; top:0; z-index:11; opacity:0.7;"></div>

<div style="with:900px; margin:0 auto; position:relative;">
<div id="popup_form_edit" style="display:none;float:left;background:#fff; width:620px; position:fixed; top:25%; left:30%; z-index:5000; -moz-border-radius: 10px 30px;border:solid 5px #49A4CB;">
<div class="close_dd_edit" style="position:relative;" id=""><a href="javascript:void(0);" id="button_close_edit" style="position:absolute; right:-16px; top:-15px;"><img src="images/close.png" alt="" /></a></div>
<form name="edit_user_form" action="useredit.php?case=update_user"  id="edit_user_form" action="" method="post">
		<table cellspacing="20" style="width:620px;">
			<tr><font color="skyblue">Edit User</font></tr>
			<tr>
				<td><label>Full Name</label><font color="#FF0000">*</font></td>
				<td><input type="text" name="full_name_edit" id="full_name_edit"/></td>
			</tr>
			<tr>        
                                <td class="label">Department<font color="#FF0000">*</font></td>
                                                        <td> <select name="department_edit" id="department_edit" class="required">
                                                        <option value="">Select Department</option>
                                                        <?php foreach($StatusReport->getDepartmentList($fetchUserByDeptID) as $dept){
                                                        if($dept->id!=''){
                                                        echo "<option value='$dept->id'>".ucwords($dept->dept_name)."</option>";
                                                        }
                                                        }
                                                        ?>
                          </select><font color="#FF0000">*</font></span></td>
                        </tr>
                        <tr>
                                <td><label>Email</label><font color="#FF0000">*</font></td>
                                <td><input type="text" name="email_edit" id="email_edit"/></td>
                        </tr>
                        <tr><td>	 <input type="hidden" value="" id="hd_id" name="hd_id"/></td></tr>
                       <?php if($_SESSION['type']=='admin'){?>
						  <tr>
									<td><label>User Type</label></td>
									<td>
										<input type="checkbox" onclick="if(this.checked==true){this.value='admin';}else{this.value='';}" value="" name="type1" id="type1" />&nbsp;admin
										<input type="checkbox" onclick="if(this.checked==true){this.value=1;}else{this.value=0;}" value="" name="dept_head" id="dept_head" />&nbsp;Department Head
									</td>
							</tr>
                       <?php }else{
                        	echo'<tr>
                                <td><label>User Type</label></td>
                                <td><input type="checkbox" readonly onclick="this.checked=false;" name="type1" id="type1" value=""/>&nbsp;admin
                                    <input type="checkbox" readonly onclick="this.checked=false;" name="dept_head" id="dept_head" value=""/>&nbsp;Department Head
                                </td>
                        </tr>';
                        }?>
                        
			<tr>
				<td><input type="submit" value="Submit" id="edit_user_submit"/></td>
			</tr>
		</table>
		
	</form>
</div>
</div>
<div id="popup_msg_edit" style="display:none;float:left;background:#fafafa; height:50px; line-height: 50px; text-align: center; text-transform: uppercase; width:280px; position:fixed; top:20%; left:40%; z-index:50; -moz-border-radius: 10px 30px; border: 5px solid #49A4CB; font-size: 15px;"></div>
