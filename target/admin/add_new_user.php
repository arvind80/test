<div id="tabs-3" style="width:400px;margin:0 auto;float:left;">
	<form name="add_user_form" action="process.php?action=addNewUser"  id="add_user_form" action="" method="post">
		<table cellspacing="20" style="width:600px;" class="tablesorter">
			<?php  if(isset($_GET['uADD']) && $_GET['uADD']=='true')echo"<tr><td><font color='green'>User Successfully added!</font></td></tr>";
						   if(isset($_GET['uADD']) && $_GET['uADD']=='false'){echo"<tr><td><font color='red'>There is some problem in saving the user! Please try again!</font></td></tr>";
							}
			?>
			<tr><font color="skyblue">Add New User</font></tr>
			<tr>
				<td><label>Full Name</label><font color="#FF0000">*</font></td>
				<td><input type="text" name="full_name" id="full_name"/></td>
			</tr>
			<tr>        
                                <td class="label">Department<font color="#FF0000">*</font></td>
                                                        <td> <select name="department" id="department" class="required">
                                                        <option value="">Select Department</option>
                                                        <?php foreach($StatusReport->getDepartmentList($fetchDepartmentById) as $dept){
                                                        if($dept->id!=''){
                                                        echo "<option value='$dept->id'>".ucwords($dept->dept_name)."</option>";
                                                        }
                                                        }
                                                        ?>
                          </select></td>
                        </tr>
                        <tr>
                                <td><label>Email</label><font color="#FF0000">*</font></td>
                                <td><input type="text" name="email" id="email"/></td>
                        </tr>
                        <tr>
                                <td><label>Password</label><font color="#FF0000">*</font></td>
                                <td><input type="password" name="password" id="password"/></td>
                        </tr>
                        <?php if($_SESSION['type']=='admin' || $_SESSION['department']=='HR'){?>
                        <tr>
                                <td><label>User Type</label></td>
                                <td><input type="checkbox" name="type" id="type" value="admin"/>&nbsp;admin
                                    <input type="checkbox" name="dept_head" id="dept_head" value="1"/>&nbsp;Department Head
                                
                                </td>
                        </tr>
                        <?php }else{
                        	echo'<tr>
                                <td><label>User Type</label></td>
                                <td><input type="checkbox" readonly onclick="this.checked=false;" name="type" id="type" value="admin"/>&nbsp;admin
                                    <input type="checkbox" readonly onclick="this.checked=false;" name="dept_head" id="dept_head" value="1"/>&nbsp;Department Head
                                
                                </td>
                        </tr>';
                        }?>
			<tr>
				<td><input type="submit" value="Submit"/></td>
			</tr>
		</table>
	</form>
	</div>
