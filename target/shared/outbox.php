<div>
	<div>
		<table class="tablesorter" style="width:100%">
				<?php if($outbox[0]->id!=''){?>
		    <tr>
				<thead>
				<th style="width:20%;"align="center">From</th>
				<th style="width:40%;"align="center">Subject</th>
				<th style="width:15%;"align="center">Date</th>
				<th style="width:15%;"align="center">Action</th>
				<tr><td height="10px"></td><thead></tr>
				
				<?php foreach($outbox as $values) {?>
		     <?php if($values->read_status==0){?>
		            <tr style="background-color:#8FE4EF">
						<?php }else {?>
						 <tr style="background-color:#D3D1D1"><?php }?>
			<td align="center"><?php  echo $name=$StatusReport->getDepartmentNameById($values->userto_id);?></td>
			<td align="center"><?php echo $values->subject;?></td>
			<td align="center"><?php echo date('M-j-Y',strtotime($values->createddate));?></td>
			
			<td align="center"><a  id="varios1_<?php echo $values->id ?>" onclick="fancypop(this.id);statusupdate('<?php echo $values->id;?>')" href="detailmessage.php?id=<?php echo $values->id ?>">view</td>
			</tr>
			  <?php }}else{
					echo "No records exists!";
				  }?>
		  </table>
		
</div>
</div>


