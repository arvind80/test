<div id="tabs-2" style="min-height:340px;">
			<form name="search_form" id="search_form" onsubmit="return compareDates();" method="post" action="process.php?action=getUserAllStatus&pagination=no">
			<label><font color="skyblue">Search For Task</font></label>
			<table  class="tablesorter" style="width:1000px;" cellspacing="15">
				<tr><td>
					<select name="user_list"  id="user_list">
						<option value="">Please Select User</option>
					<?php foreach(($StatusReport->getUserList('',$fetchUserByDeptID)) as $user){ 
						if($user->id!=''){
						?>
						<option value=<?php echo $user->id; ?> <?php if($_GET['passId']==$user->id)echo "selected"; ?>><?php echo ucwords($user->full_name).'--'.$StatusReport->getDepartmentNameById($user->department); ?></option>
					<?php }
					}?>
					</select>
				
				</td>
				</tr><tr>
					<td>Start Date <font color="#FF0000">*</font><input type="text" readonly value="<?php if(isset($_GET['start_date']))echo $_GET['start_date'];?>" class="required" name="start_date" id="start_date"/></td>
					<td>End Date <input type="text" readonly value="<?php if(isset($_GET['end_date']))echo $_GET['end_date'];?>"  name="end_date" id="end_date"/>&nbsp;&nbsp;&nbsp;<input type="submit" value="search"/></td>
				</tr>
				</table>
				<?php if(isset($_SESSION['result']) && $_SESSION['result']!='' && $_SESSION['result'][0]->user_id!=''){?>
				<table style="width:1000px;" id="user_status_view" class="tablesorter">
							
							<thead>
								<tr>
									<th>Department</th>
									<th>Project Name</th>
									<th>Project Type</th>
									<th>Project Description</th>
									<th>Odesk Id</th>
									<th>Client Name</th>
									<th>Hour Billed</th>
									<th>Estimated Hour</th>
									<th>Other Hour</th>
									<th>Working Hour</th>
								</tr>
							</thead>
								<?php 
								foreach($_SESSION['result'] as $val){
									
									$title=strip_tags($val->project_description);
									$project_description=substr($val->project_description,0,10);
									$user_id=$val->user_id;
								?>
									<tr>
										<td align='center'><?php echo $StatusReport->getDepartmentNameByUserId($user_id)?></td>
										<td align='center'><?php echo $val->project_name?></td>
										<td align='center'><?php echo $val->project_type?></td>
										<td align='center' onmouseover="this.style.cursor='pointer'" title='<?php echo ($title);?>'><?php echo $project_description;?> ...</td>
										<td align='center'><?php echo $val->odesk_id?></td>
										<td align='center'><?php echo $val->client_name?></td>
										<td align='center'><?php echo $val->hour_billed?></td>
										<td align='center'><?php echo $val->estimated_hour?></td>
										<td align='center'><?php echo $val->free_hour?></td>
										<td align='center'><?php echo $val->working_hour?></td>
									</tr>
									<?php }?>
				</table>
					<div id="pager" style="text-align: center;top: 543px;position:relative;width:1000px;">
					<form>
						<img src="images/first.png" class="first"/>
						<img src="images/prev.png" class="prev"/>
						<input type="text" class="pagedisplay"/>
						<img src="images/next.png" class="next"/>
						<img src="images/last.png" class="last"/>
						<select class="pagesize">
							<option   selected="selected" value="10">10</option>
							<option  value="20">20</option>
						</select>
					</form>
				</div>
								<?php }else{
									if(isset($_SESSION['result'][0]->user_id) && $_SESSION['result'][0]->user_id=='')
							echo "<tr><td colspan='4' align='center'><font color='red'>No record found!</font></td></tr>";		
				}?>
			</div>
		
