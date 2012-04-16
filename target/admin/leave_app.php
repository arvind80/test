<div id="tabs-5" style="min-height:340px;">
         <table  width="1000px;"  id="row">
                 <font color='skyblue'>View Leave By User!</font>
					<tr> 
                          <td><select name="user_drop"  id="user_drop" onchange="getleaveid(this.value);" >
                                                 <option value="">Please select user</option>
                                                 <?php foreach($emails as $values){?>
                                                  <option value="<?php echo $values->id ?>"> <?php echo  ucwords($values->full_name); ?> </option>
                                                  <?php }?>
                                                   </select>
                          </td>        
					</tr>
					<tr>
						  <td id="leavis"></td>
					</tr>
					<tr>
                          <td>
                           <font color='skyblue'>Leave Waiting For Approval!</font>
                                  <table class="tablesorter" style="width:1000px;" id="row2">
                                    <thead>
                                           <tr>
											   <th align="center" class="header">Name</th>
											   <th align="center" class="header">Department</th>
											   <th align="center" class="header">Designation</th>
											   <th align="center" class="header">Current Project</th>
											   <th align="center" class="header">Leave From</th>
											   <th align="center" class="header">Leave TO</th>
											   <th align="center" class="header">Leave Type</th>
											   <th align="center" class="header">Approved By Dept Head</th>
											   <th align="center" class="header">Reason For Leave</th>
											   <th align="center" class="header">Total Days </th>
											   <th align="center" class="header">Final Status </th>
                                           </tr>
                                      <thead>
                                            <tbody>
                                                <?php foreach($Leaveform2 as $onleaves){
                                                        if($onleaves->user_id!=''){
                                                         $applicant_id=$onleaves->user_id;
                                                ?>
                                          <tr>
										  <input type="hidden" id="reason_for_leave_<?php echo $onleaves->id;?>" value="<?php echo strip_tags($onleaves->reason_for_leave);?>"/>
										  <input type="hidden" id="leave_from<?php echo $onleaves->id;?>" value="<?php echo $onleaves->leave_from;?>"/>
										  <input type="hidden" id="leave_to<?php echo $onleaves->id;?>" value="<?php echo strip_tags($onleaves->leave_to);?>"/>
										  <input type="hidden" id="leave_id<?php echo $onleaves->id;?>" value="<?php echo $onleaves->id;?>"/>
										  <input type="hidden" id="created_at<?php echo $onleaves->id;?>" value="<?php echo date('Y-m-d',strtotime($onleaves->created_at));?>"/>
										  <input type="hidden" id="name_employe<?php echo $onleaves->id;?>" value="<?php echo strip_tags($onleaves->name_employe);?>"/>
										  <input type="hidden" id="designation<?php echo $onleaves->id;?>" value="<?php echo $onleaves->designation;?>"/>
										  <input type="hidden" id="curent_project<?php echo $onleaves->id;?>" value="<?php echo strip_tags($onleaves->curent_project);?>"/>
										  <input type="hidden" id="leave_type<?php echo $onleaves->id;?>" value="<?php echo $onleaves->leave_type;?>"/>
										  <td  id="reason_for_leave_<?php echo $onleaves->id;?>" align="center" ><?php echo ucfirst($onleaves->name_employe); ?></td>
										  <td align="center"><?php echo ucfirst($StatusReport->getDepartmentNameByUserId($applicant_id));?></td>
										  <td align="center"><?php echo ucfirst($onleaves->designation); ?></td>
										  <td align="center"><?php echo ucfirst($onleaves->curent_project); ?></td>
										  <td align="center"><?php echo $onleaves->leave_from; ?></td>
										  <td align="center"><?php echo $onleaves->leave_to; ?></td>
										  <td align="center"><?php echo ucfirst($onleaves->leave_type); ?></td>
										  <td align="center"><?php  if( $onleaves->approved_by_dept_head=='notapproved'){ echo "Not Approved!"; }else{ echo $onleaves->approved_by_dept_head!=''?'Approved':'Pending'; }?></td>
										  <td align="center" title="<?php echo strip_tags($onleaves->reason_for_leave);?>"><?php echo (substr(strip_tags($onleaves->reason_for_leave),0,10)); ?></td>
										  <td align="center"><?php echo $onleaves->total_days; ?> </td>
											<td align="center"><?php 
											if($onleaves->approved_by_dept_head=='' && @$_SESSION['dept_head']!=''){
												?><input id="popup_<?php echo $onleaves->id;?>" type="submit" value="Action" name="doLogin_<?php  echo $onleaves->id;?>" onclick="return approvalform(<?php  echo $onleaves->id;?>)"></td>
												<?php }
												elseif(($onleaves->approved_by_dept_head!='' && $_SESSION['department']=='HR')){
												
												?><input id="popup_<?php echo $onleaves->id;?>" type="submit" value="Action" name="doLogin_<?php  echo $onleaves->id;?>" onclick="return approvalform(<?php  echo $onleaves->id;?>)"></td>
												<?php }else{
														echo "Pending";
													}?>
												  </tr>
                                           <?php }else{echo "<tr><td>No Record Found!</td></tr>";}}?>
                                           <input type="hidden" id="hd_val" name="hd_val" value=""/>
                                            </tbody>
                                           </table>
                                </td>
                </tr> 
 </table>
 </div>
