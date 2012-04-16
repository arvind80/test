<div class="main_content" style="float: left;width:700px;margin-top:10px;">
                    <div class="desc" style="width:400px;">
					<div class="form_bg">
                    	<form name="statusform" id="statusform"  action="process.php?action=saveStatusReport" method="POST" enctype="multipart/form-data">
						<div class="create_project">
						<fieldset style="border: 0px solid #000000; font-size: 13px;border-radius: 5px 5px 5px 5px;background-color:#EEEEEE;width:800px;">
						<font color='skyblue'>Fill Today Status Report</font>
						<table style="fontsize:8px;" cellspacing="20" cellpadding="6">
							<tr>
								<td >Project Name</td>
								<td><input type="text" name="project_name" id="project_name" class="required"></td>
							</tr>
							<tr>
								<td class="label">Project Type</td>
								<td><input type="radio"  name="project_type" id="odesk" class="required" value="odesk" checked>Odesk
									<input type="radio" name="project_type" id="fixed" class="required" value="fixed">Fixed
									<input type="radio" name="project_type" id="other" class="required" value="other">Other
								</td>
							</tr>
							<tr id="fixed_other" style="display:none;">
								<td class="label">Working Hour</td>
								<td><input type="text" onblur="checkNumeric(this.value,this.id,'working_hour_error_message');"; name="working_hour" id="working_hour"></input>
								<p id="working_hour_error_message"></p>
								</td>
							</tr>
							<tr>
								<td colspan="2">
							<table id="odesk_detail" style="display:none;" cellspacing="10">
									<tr>
										<td class="label">Odesk Id </td>
										<td><input type="text"   name="odesk_id" id="odesk_id" ></td>
									</tr>
									<tr>
										<td class="label">Client name </td>
										<td><input type="text"   name="client_name" id="client_name"></td>
									</tr>
									<tr>
										<td class="label">Company Name </td>
										<td><input type="text"  name="company_name" id="company_name"></td>
									</tr>
									<tr>
										<td class="label">Estimated Billing Hour</td>
										<td>
											<input type="text" onblur="checkNumeric(this.value,this.id,'estimated_hour_error_message');";  name="estimated_hour" id="estimated_hour">
											<p id="estimated_hour_error_message"></p>
										</td>
									</tr>
									<tr>
										<td class="label"> Actual Billing Hours</td>
										<td colspan="2"><select name="billing_hour" id="billing_hour">
											<option value="">Please Select Hour</option>
											<?php 
												for($i=0;$i<=15;$i++){
													echo"<option value='$i'>$i</option>";
												}
											?>
										</select>
										<select name="billing_minute" id="billing_minute">
											<option value="">Please Select Minutes</option>
											<option value="00">00</option>
											<option value="17">17</option>
											<option value="33">33</option>
											<option value="50">50</option>
											<option value="67">67</option>
											<option value="83">83</option>
										</select>
										</td>
										<!--<td><input type="text" onblur="if(isNaN(this.value)){this.value='';}";  name="billing_hour" id="billing_hour"></td>-->
									</tr>
							</table>
							</td>
							</tr>
							<tr>
								<td class="label">Project Description</td>
								<td><textarea name="project_description" id="project_description" rows="10"  cols="70" class="required"></textarea>
									<script>
										$("#project_description").cleditor();
									</script>
									</td>
							</tr>
							<tr>
								<td><input type="submit" value="Submit" /></td>
							</tr>
						</table>
						</fieldset>
						</div>
						</form>
				</div>
				</div>
				</div>
