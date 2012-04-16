<?php 
 $message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
							<tr><td>You have applied for a leave on Target with the followwing  content.Please wait for the approval!</td></tr>
							  <tr>
									<td>
													<div style="float:left; width:781px;">
													<div style="float:left; width:781px; height:90px;">
															<img src="http://192.168.1.3/vivek/target/images/logo.png" alt="" />
													</div>
													<div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
															<p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
															<strong></strong><br><br>
															<strong>Name:</strong> '.$data['emp_name'].'<br><br>
															<strong>Department:</strong> '.$data['emp_dept1'].'<br><br>
															<strong>Designation:</strong> '.$data['emp_designation'].'<br><br>
															<strong>Current Project:</strong> '.$data['emp_cur_Project'].'<br><br>
															<strong>Reason For Leave:</strong> '.$data['reason_for_leave'].'<br><br>';
															if($data['type_of_leave']=='halfday' ||$data['type_of_leave']=='fullday'){
																if($data['type_of_leave']=='halfday'){
																	if($data['halfday_fullday__leave__half_select']=='second_half'){
																		$session= 'Second Half';
																	}else{
																		$session= 'First Half';
																	}
																	$message.= '<strong>Session:</strong> '.$session.'<br><br>';
																}
																$message.= '<strong>Leave Date:</strong> '.$data['halfday_fullday__leave_date'].'<br><br>';
															}elseif($data['type_of_leave']=='shortleave'){
																$message.= '<strong>Leave Type:</strong> Short Leave<br><br>';
																$message.= '<strong>Leave Date:</strong> '.$data['short_leave_text_box'].'<br><br>';
																$message.= '<strong>Time Period:</strong> '.$short_leave_time.'<br><br>';
															}
															elseif($data['type_of_leave']=='other'){
																$message.='<strong>Leave From:</strong> '.$data['from_date'].'<br><br>
																					<strong>Leave TO:</strong> '.$data['to_date'].'<br><br>
																					<strong>Number Of Days:</strong> '.$data['total_days'].'<br><br>';
															}				   
									$message.='</div></div></td></tr>
							</table>';
?>
