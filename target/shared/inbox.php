<div>
	<div>
   		<table class="tablesorter" style="width:100%">
			<?php if($inbox[0]->id!=''){?>
		    <tr><thead>
				<th style="width:20%;"align="center">From</th>
				<th style="width:40%;"align="center">Subject</th>
				<th style="width:15%;"align="center">Date</th>
				<th style="width:15%;"align="center">Action</th>
				<tr><td height="10px"></td><thead></tr>
				
				<?php foreach($inbox as $values) {
						
					?>
					<?php if($values->read_status==0){?>
		            <tr style="background-color:#8FE4EF">
						<?php }else {?>
						 <tr style="background-color:#D3D1D1"><?php }?>
						 <?php if($_SESSION['dept_head']){?>
						  <td align="center"><?php  $name=$StatusReport->getUserNameById($values->userfrom_id);
			                          echo   $name[0]->full_name;  ?></td><?php } else {?>
			<td align="center"><?php echo $name=$StatusReport->getDepartmentNameById($values->userfrom_id);?></td><?php }?>
            <td ><?php echo $values->subject;?></td>
			<td align="center"><?php echo date('M-j-Y',strtotime($values->createddate));?></td>
			<td align="center"><a  id="varios1_<?php echo $values->id ?>" onclick="fancypop(this.id);statusupdate('<?php echo $values->id;?>')" href="detailmessage.php?id=<?php echo $values->id ?>">view</td>
			</tr> <?php } }else{
				echo"No records exists.";
				}?>
		</table>
		
</div>
</div>


