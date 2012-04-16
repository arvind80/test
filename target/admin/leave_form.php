<form name="leave_form" id="leave_form" method="post" action="process.php?action=leaveform">
				<?php 
					if(isset($_GET['success']) && isset($_GET['leave']) && $_GET['leave']==true){
						echo "<tr><td><font color='green'>Leave Successfully Saved.Wait For Approve!</font></td></tr>";
					}
					if(isset($_GET['failure']) && isset($_GET['mail']) && ($_GET['mail']=='false')){
						echo "<tr><td><font color='green'>There is some problem in saving the Information.Please try again!</font></td></tr>";
					}
				?>
				<fieldset style="border: 0px solid #000000; font-size: 13px;border-radius: 5px 5px 5px 5px;width:800px;">
				<font color="skyblue">Fill the form below to apply for a leave! </font>
            <center><table width="700px" cellspacing="10"   border="0" cellspacing="1" cellpadding="0">
					  <tr>
							<td>Employee Name:<font color="#FF0000">*</font></td>
							<td><input name="emp_name"  style="width:200px;" type="text" id="emp_name" value="<?php echo $_SESSION['full_name'];?>" readonly></td>
					  </tr>
					  <tr>
						<td>Department<font color="#FF0000">*</font></td>
						 <td><input name="emp_dept1"  style="width:200px;" type="text" id="emp_dept1" value="<?php echo $_SESSION['department'];?>" readonly>
							</td> 
						</tr>
					  <tr>
						<td>Designation:<font color="#FF0000">*</font></td>
						<td><input name="emp_designation" type="text"  style="width:200px;" id="emp_designation" ></td>
					   </tr>
					  <tr>
						<td>Current Project:<font color="#FF0000">*</font></td>
						<td><input name="emp_cur_Project" type="text"  style="width:200px;" id="emp_cur_Project"></td>
					 </tr>
					 <tr>
										<td class="smallfont">Type Of Leave<font color="#FF0000">*</font></td> 
										<td><select name='type_of_leave' id='type_of_leave'>
											<option value="">Please Choose One</option>
											<option value="halfday">Half Day</option>
											<option value="fullday">Full Day</option>
											<option value="shortleave">Short Leave</option>
											<option value="other">Other</option>
										</select>
										<select name='halfday_fullday__leave__half_select' style="display:none;" id='halfday_fullday__leave__half_select'>
											<option value="">Please Select Session</option>
											<option value="first_half">First Session</option>
											<option value="second_half">Second Session</option>
										
										</select></td>
									</tr>
					<tr id="short_leavebox" style="display:none;">
						<td>Please Select Date</td>
						<td>
							<input type="text" style="width:70px;" id="short_leave_text_box" name="short_leave_text_box"/>
							Time From
							<input type="text" style="width:55px;" id="short_leave_time_from" name="short_leave_time_from"/>To
							<input type="text" style="width:55px;" id="short_leave_time_to" name="short_leave_time_to"/>
						</td>
					</tr>
					<!--Code will choose type of leave -->
					<tr id="halfday_fullday__leave_box" style='display:none;'>
										<td class="smallfont">Please Select Date</td> 
										<td><input name="halfday_fullday__leave_date" readonly type="text"  style="width:200px;" id="halfday_fullday__leave_date"></td>
					</tr>
					 <tr id="other__leave_date_box" style='display:none;'>
							<td valign="top">Leave:<font color="#FF0000">*</font></td>
						    <td>
						      <table>
									<tr>
										<td> <input type="text"  name="from_date" id="from_date" readonly="readonly"/> </td>
										<td class="smallfont">Date from</td> 
									</tr>		
									<tr>	 
										<td> <input type="text"  name="to_date" id="to_date"  readonly="readonly"/> </td>
						                 <td class="smallfont">Date TO </td> 
						              </tr>   
									<tr>  
										 <td> <input type="text" name="total_days" id="total_days" onclick="check_no_of_days()" readonly/></td>
			        					 <td class="smallfont">Total Days</td>	
									</tr>					
					          </table>
					        </td>
					   </tr>
					   <tr>
						<td>Reason For Leave:<font color="#FF0000">*</font></td>
						<td><textarea name="reason_for_leave" id="reason_for_leave" class="required" rows="10" class="textarea_class" cols="70" class="required"></textarea>
									<script>
										$("#reason_for_leave").cleditor();
									</script>
									</td>
					 </tr>
					  
					  <tr>
						<td height="5px"></td>
						<td><input type="submit" name="submit" value="Apply"/></td>
					</tr>
				</table></center></fieldset>
            </form>
