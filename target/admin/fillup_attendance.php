<center>
			<table>
				<tr><td>
				<table class="tablesorter">
					<tr>
						<td> <button id="editAttendance_show">Edit Attendance</button></td>
						<td><button id="viewAttendance_show">View Attendance</button></td>
						<td><button id="fillAttendance_show">Fill Today Attendance</button></td>
					</tr>
					<tr id="editAttendanceSection"  height="100px;" style="display:none;">
						<form name="editAttendance_form"  id="editAttendance_form" onsubmit='return editAttendance();' method="post">
								<td>Edit By date<font color='red'>*</font><input type="text" class="required" id="date_edit_attendance" name="date_edit_attendance"/></td>
								<td><input type="submit" onClick="$('label').remove('.error');" name="submit" value="Continue"></td>
						</form>
					</tr>
				    <tr id="viewAttendanceSection"  style="display:none;">
						<form name="viewAttendance_form" onsubmit="return viewAttendance();"  id="viewAttendance_form" method="post">
							<td>
								<select  name="view_by_user" id="view_by_user">
									<option value="">Please Select User</option>
									<?php 
										
										foreach(($StatusReport->getUserList()) as $user){ 
										if($user->id!=''){
										?>
										<option value=<?php echo $user->id; ?> <?php if($_GET['passId']==$user->id)echo "selected"; ?>><?php echo ucwords($user->full_name).'--'.$StatusReport->getDepartmentNameById($user->department); ?></option>
									<?php }
									}?>
								</select>
							</td>
							<td>Start Date<font color='red'>*</font><input type="text" style="width:80px;" class="required" id="date_view_attendance_start_date" name="date_view_attendance_start_date"/></td>
							<td>End Date<input type="text" style="width:80px;" id="date_view_attendance_end_date" name="date_view_attendance_end_date"/></td>
							<td>View By Type<font color='red'>*</font>
								<select class="required" name="date_view_type_attendance" id="date_view_type_attendance">
									<option value="">Please Select View</option>
									<option value="viewall">View All</option>
									<option value="late_coming">Late Coming</option>
									<option value="present">Present</option>
									<option value="absent">Absent</option>
									<option value="leave">Leave</option>
								</select>
							</td>
							<td><input type="submit" onClick="$('label').remove('.error');" name="submit" value="Continue"></td>
					</form></br>
				   </tr>
			    </table>
			      </td>
			    </tr>
			  <tr><td id="userAttendanceView" colspan="4"></td></tr>
			  </table>
		<div id="filltodayattendanceAjax" style="float:left;">
		<table width="1000px;" id="filltodayattendance" class="tablesorter" cellspacing="15">
			<form name="attendance_form" action="process.php?action=saveAttendance" id="attendance_form" method="post">
				<tr><td><?php if(isset($_GET['present']) && $_GET['present']=='true')
						{echo"<font color='green'>Data Successfully saved!</font>";}
						if(isset($_GET['present']) &&  $_GET['present']=='false')
						{echo"<font color='red'>There is some problem in saving the data please try again!</font>";}
				 ?></td>
			    </tr>
				<tr><td>
					<?php 	if(isset($_GET['updated']) &&  $_GET['success']=='true')
							{echo "<font color='red'>".$_GET['updated']." Records updated successfully!</font>";}?>
					 <td>
					 <input type='radio'  value="present" onclick="selectRadios('present');"   name='checkpresentall'/><a href="javascript:void(0)" onclick="selectRadios('present');">SelectAll</a> 
					 <input type='radio'  value="absent" onclick="selectRadios('absent');"   name='checkpresentall'/><a href="javascript:void(0)" onclick="selectRadios('absent');">SelectAll</a> 
					 </td>
					 <td></td><td></td>
				</tr>
				<?php foreach(($StatusReport->getUserList()) as $user){
					$username=ucwords($user->full_name);
				 print<<<AttendanceFormField
				 <tr style="background-color:#EEE;"><td width='200px'>
				 <input type='hidden'  value="$user->id"  id='username$user->id' name='username[]'/>
				<!--<input type='checkbox' class="required" value="$user->id"  id='username$user->id' name='username[]'/>--><font color="green">$username</font></td>
					<td width='550px'><p id="attendancebox$user->id">
						<input type="radio" value="present" class="required" onclick="gettime($user->id,'hide')" value="present" id="present$user->id" name="attendance$user->id"/><font color="green">Present</font>&nbsp;
						<input type="radio" value="absent" class="required" onclick="gettime($user->id,'hide')" value="absent" id="absent$user->id" name="attendance$user->id"/><font color="red">Absent</font>
						<input type="radio"  class="required" value="late_coming" onclick="gettime($user->id,'')" id="late_coming$user->id" name="attendance$user->id"/><font color="brown">Late Coming</font>
						<input type="text" style="display:none;width:50px;" id="textattendance$user->id"    name="textattendance[]"/>
						</p>
				     </td>
				 <td width="150px;">
						<input type="checkbox" value="$user->id" onclick="hideShowAttendance(this.value);" name="onleave$user->id"/><font color="green">On Leave</td>
						<td width="350px;"><p id="leavebox$user->id" style="display:none">
						       <select name="onleaveSelect$user->id"  id="onleaveSelect$user->id">
								<option value="">Please Select One</option>
								<option value="approved">Approved</option>
								<option value="notapproved">Not Approved</option>  
						       </select>
					        </p>
					        <p  style="font-size:9px;display:none;" id="type_of_leave_box$user->id">
					      
								   <font color="brown">Short Leave</font>
										<input type="radio" value="shortleave" onclick="showShortLeaveBox('shortleave_late_arrived_time$user->id',this.value);" name="leave_type$user->id"/>
										<input type="textbox"  style="width:50px;display:none" name="shortleave_late_arrived_time$user->id" id="shortleave_late_arrived_time$user->id"/>
								   <font color="brown">Half Day Leave</font><input type="radio" onclick="showShortLeaveBox('shortleave_late_arrived_time$user->id',this.value);" value="halfday" name="leave_type$user->id"/>
							</p>
				        </td>
				</tr>
				<script>
				 $(document).ready(function() {
					$('#textattendance'+$user->id).mouseover(function(){
						$('#textattendance'+$user->id).timepicker();
					});
					
					$('#shortleave_late_arrived_time'+$user->id).mouseover(function(){
						$('#shortleave_late_arrived_time'+$user->id).timepicker();
					});
				});
				
				</script>
AttendanceFormField;
				}?>
	<tr>
		<td><input type="submit" onClick="$('label').remove('.error');" value="Save"/></td>
	</tr>
			</form>
			
		</table>
		</div>
		</center>
