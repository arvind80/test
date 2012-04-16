<?php 
	if(isset($_GET['action']) && $_GET['action']=='edit'){
		
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$project=$Projects->getProjects($_GET['id']);
			$_SESSION['edit_project_id']=$project[0]->id;
		}
	}
?>
<div style="margin-top:25px;">
<form name="add_new_project_form" id="add_new_project_form" method="post" action="process.php?action=saveProject">	
				<?php if($_GET['action_view']=='add_new_project' && (isset($_GET['success'])&&$_GET['success']==true ||isset($_GET['failure'])&&$_GET['failure']==true)){
					echo $_GET['failure']==true?"There is some problem in saving the project.Please try again!":"Record successfully saved";
				} ?>
				<fieldset style="border: 0px solid #000000; font-size: 13px;border-radius: 5px 5px 5px 5px;width:800px;margin:top:50px;">
				<legend></legend>
            <center><table width="700px" cellspacing="10"   border="0" cellspacing="1" cellpadding="0">
					
						<tr><td>	<?if(isset($project[0]->id)&&$project[0]->id==''){?><font color="skyblue">Edit Project  </font><?php }else{echo '<font color="skyblue">Fill the form below to add  a new project! </font>';}?></td></tr>
					  <tr>
							<td>Project Name:<font color="#FF0000">*</font></td>
							<td><input name="project_name" class="required" style="width:200px;" type="text" id="project_name" value="<?php echo @$project[0]->project_name; ?>"></td>
					  </tr>
					  <tr>        
                                <td class="label">Department<font color="#FF0000">*</font></td>
                                                        <td> <select name="department" id="department" class="required">
                                                        <option value="">Select Department</option>
                                                        <?php foreach($StatusReport->getDepartmentList($fetchDepartmentById) as $dept){
															$selected='';
															if($dept->id!=''){
																if($dept->id==$project[0]->dept_id){
																		 $selected='selected';
																}
															echo "<option $selected value='$dept->id'>".ucwords($dept->dept_name)."</option>";
															}
															}?>
                          </select>
                          </td>
                        </tr>
					  <tr>        
                                <td class="label">Project Type<font color="#FF0000">*</font></td>
                               <td> <select name="project_type" id="project_type" class="required">
										<option value="">Please Select One</option>
										<option <?php if($project[0]->project_type=='odesk'){echo 'selected';}?> value="odesk">Odesk</option></option>
										<option <?php if($project[0]->project_type=='fixed'){echo 'selected';}?> value="fixed">Fixed</option>                 
									</select>
                          </td>
                        </tr>
						<tr>
						<td>start Date<font color="#FF0000">*</font></td>
						<td><input name="start_date" value="<?php echo @$project[0]->start_date; ?>" readonly  type="text" class="required" style="width:200px;" id="start_date"/></td>
					 </tr>
					  <tr>
						<td>End Date<font color="#FF0000">*</font></td>
						<td><input name="end_date" value="<?php echo @$project[0]->end_date; ?>" readonly type="text" class="required" style="width:200px;" id="end_date"/></td>
					 </tr>
					  <tr>
						<td>Site url:<font color="#FF0000">*</font></td>
						<td><input name="site_url" value="<?php echo @$project[0]->site_url; ?>" type="text"  style="width:200px;" id="site_url" ></td>
					   </tr>
					  <tr>
						<td>Odesk Id<font color="#FF0000">*</font></td>
						<td><input name="odesk_id" type="text" value="<?php echo @$project[0]->odesk_id; ?>"  style="width:200px;" id="odesk_id"/></td>
					 </tr>
					 
					  <tr>
						<td>Client Name<font color="#FF0000">*</font></td>
						<td><input name="client_name" type="text" value="<?php echo @$project[0]->client_name; ?>" class="required" style="width:200px;" id="client_name"/></td>
					 </tr>
					 <tr>
						<td>Company Name<font color="#FF0000">*</font></td>
						<td><input name="company_name" type="text" value="<?php echo @$project[0]->company_name; ?>" class="required" style="width:200px;" id="company_name"/></td>
					 </tr>
					 <tr>
						<td>Project Detail<font color="#FF0000">*</font></td>
						<td><textarea name="project_detail" rows="10"   cols="70" class="required" id="project_detail"><?php echo @$project[0]->project_detail; ?></textarea></td>
						<script>
								$("#project_detail").cleditor();
						</script>
					 </tr>
					  <tr>
						<td>Project Description<font color="#FF0000">*</font></td>
						<td><textarea name="project_description_new" rows="10"  cols="70" class="required" id="project_description_new"><?php echo @$project[0]->project_description; ?></textarea></td>
						<script>
								$("#project_description_new").cleditor();
						</script>
					 </tr>
					   <tr>
						<td>Total Hours<font color="#FF0000">*</font></td>
						<td><input name="total_hours" value="<?php echo @$project[0]->total_hours; ?>" class="required" type="text"  style="width:200px;" id="total_hours"/></td>
					 </tr>
					   
					 <tr>
						<td class="smallfont">Project Status<font color="#FF0000">*</font></td> 
						<td>
						<select name='status'  id='status' class="required">
							<option value="">Please Select Status</option>
							<option <?php if($project[0]->status=='open'){echo 'selected';}?> value="open">Open</option>
							<option <?php if($project[0]->status=='closed'){echo 'selected';}?> value="closed">Closed</option>
							<option <?php if($project[0]->status=='onhold'){echo 'selected';}?> value="onhold">On Hold</option>
						</select></td>
				    </tr>
					  <tr>
						<td height="5px"></td>
						<td><input type="submit" name="submit" value="Save !"/></td>
					</tr>
				</table></center></fieldset>
            </form>
</div>
