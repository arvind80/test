<?php include("edit_user_pop_up.php"); ?>
<div id="tabs-6">
	<?php 
 if(isset($_GET['msg']) &&$_GET['msg'] =='true'){
	  $msg1="User profile updated sucessfully!";}else{$msg1="User profile not updated!";}?>
<div class="editmsg"><?php echo $msg1;?></div>

	<center>
	<table class="tablesorter">
		<thead>
			   <tr>
				   <th  class="header">Name</td>
				   <th  class="header">Email</th>
				   <th  class="header">Status</th>
				   <th  class="header">Action</th>
			   </tr>
		</thead>
		<tbody>
		             <?php $users= $StatusReport->getUserList('',$fetchUserByDeptID);
					 foreach($users as $listusers){
		                ?>
							<tr>
							<td align="center"><?php echo ucfirst($listusers->full_name);?></td>
							
							<td align="center"><?php echo $listusers->email;?></td>
							<td align="center"><?php  $status= $listusers->status;?>
							<input type="radio" name="status_<?php echo $listusers->id;?>"  <?php if($status == '1'){echo "checked"; }?>  id="Active_<?php echo $listusers->id;?>" value="1" onclick="setstatus(this.value,'<?php echo $listusers->id;?>')">Active
							<input type="radio" name="status_<?php echo $listusers->id;?>" id="InActive_<?php echo $listusers->id;?>" <?php if($status == 0){ ?> checked="checked" <?php }?> value="0" onclick="setstatus(this.value,'<?php echo $listusers->id;?>')">Inactive
							</td>
							<td align="center" ><a id="various2" onclick="edituser('<?php echo $listusers->id;?>')">Edit</td>
							
							</tr>
					<?php }?> 
				
			</tbody>
	</table>
	</center>	
	</div>
