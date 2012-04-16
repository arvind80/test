<?php 
$message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
				You have applied for a leave on target With the following content.Please wait for leave approvel!
							    <tr>
							<td>
								<div style="float:left; width:781px;">
								<div style="float:left; width:781px; height:90px;">
										<img src="http://target.kindlebit.com/images/logo.png" alt="" />
								</div>
								<div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
										<p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
										<strong></strong><br><br>
										<strong>Employee Name:</strong> '.$data['name_employe'].'<br><br>
										<strong>Department:</strong> '.$deptName.'<br><br>
										<strong>Designation:</strong> '.$data['designation'].'<br><br>
										<strong>Current Project:</strong> '.$data['curent_project'].'<br><br>
										<strong>Reason For Leave:</strong> '.$data['reason_for_leave'].'<br><br>';
										if($data['leave_type']=='halfday' || $data['leave_type']=='fullday'){
											$message.= '<strong>Leave Type:</strong> '.$data['leave_type'].'<br><br>';
											$message.= '<strong>Leave Date:</strong> '.$data['leave_from'].'<br><br>';
										}elseif($data['leave_type']=='shortleave'){
											$message.= '<strong>Leave Type:</strong> Short Leave<br><br>';
											$message.= '<strong>Leave Date:</strong> '.$data['leave_from'].'<br><br>';
											$message.= '<strong>Time Period:</strong> '.$data['short_leave_time'].'<br><br>';
										}
										elseif($data['leave_type']=='other'){
											$message.='<strong>Leave From:</strong> '.$data['leave_from'].'<br><br>
																<strong>Leave TO:</strong> '.$data['leave_to'].'<br><br>
																<strong>Number Of Days:</strong> '.$data['total_days'].'<br><br>';
										}
										$message.='<strong>Approved By department Head:</strong> '.$data['approved_by_dept_head'].'<br><br>
											<strong>Comment By Department Head:</strong> '.$data['dept_head_comment'].'<br><br>';		   
										$message.='</div></div></td></tr>
							</table>';
?>
