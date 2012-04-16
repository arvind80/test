<div style="width:auto;">
	<div style="width:auto;">
    <form name="support_form1" id="support_form1" method="post" action="process.php?action=supportadd">
		
		<table  style="width:100%" class="support">
			<tr><td height="10px"></td></tr>
		<tr><td colspan="3">Please fill this form for Support</td></tr>
		<tr><td height="10px"></td></tr>
		<tr>
			<td>Choose Department</td>
			<td width="10px"></td>
			<td><select name="dept_id" class="required" id="dept_id">
			<option value="">Select Department</option>
			<?php foreach($StatusReport->getDepartmentList() as $dept){?>
			<option value="<?php echo $dept->id;?>"><?php echo $dept->dept_name;?></option><?php }?>
			</select></td>
		</tr>
		
		<tr><td height="10px"></td></tr>
		<tr>
			<tr>
			<td>Subject</td>
			<td width="10px"></td>
			<td><input type="text" name="subject" id="subject" class="required"></td>
		</tr>
		<tr><td height="10px"></td></tr>
		<tr>
			<tr>
			<td valign="top">Discription</td>
			<td width="10px"></td>
			<td><textarea id="support_msg" class="required" name="support_msg"></textarea></td>
		</tr>
		<script>
			$("#support_msg").cleditor();
		</script>
		<tr><td height="10px"></td></tr>
		<tr>
			<td>Status</td>
			<td width="10px"></td>
			<td><select name="status" id="status" class="required">
			<option value="">Select</option>
			<option value="1">Open</option>
			<option value="0">Close</option>
			</select></td>
		  </tr>	
		  <tr><td height="10px"></td></tr>
		  <tr><td colspan="3" align="center"><input type="submit" onClick="$('label').remove('.error');" name="submit" value="Submit"></td></tr>
		</table>
		
</div>
	</div>
