<script type='text/javascript'
	src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
<script
	type='text/javascript'
	src='components/com_permission/public/script/jquery.validate.min.js'></script>
<script
	type='text/javascript'
	src='components/com_permission/public/script/jquery.tablesorter.min.js'></script>
<link
	rel="stylesheet" type="text/css"
	href='components/com_permission/public/css/style.css'></link>
<script type='text/javascript'>
	$(document).ready(function(){
		$("#addNew").validate();
		$("#listform").validate();
		
		$("#adminlist").tablesorter(); 	
		$("#allsts").click(function() {
			if($('input[name=selectall]').is(':checked')){
				$(".selsts").attr('checked', true);
			}else{
				$(".selsts").attr('checked', false);
			}
		});
		
	});
</script>


<?php
defined('_JEXEC') or die('Restricted access'); ?>

<?php if($this->newRecord==1 || JRequest::getVar(editRecord)=='1'){
	?>
<div id="stylized" class="myform">
	<form name="addNew" id="addNew"
		action="index.php?option=com_permission&view=add&controller=permissions&saveRecord=1"
		method="post">
		<table>
			<tr>
				<td><?php if(count($this->permission)==1){
					echo'Edit Permission !';
				}else{echo 'New Permission !';
				}?>
				</td>
			</tr>
			<tr>
				<td><?php if(isset($_GET['result']) && $_GET['result']==0){
					echo "<h3><p style='color:red;'>Permission Name Already Taken.Please Enter Different Permission Name!</p><h3>";
				}?>
				</td>
			</tr>
			<tr>
			
			
			<tr>
				<td>Name <input name="name" class="required"
					value="<?php echo $this->permission[0][1];?>" id="name" type="text"></input>
				</td>
			</tr>
			<tr>
				<td>Isactive<input value="1" name="isActive" type="checkbox"
					
					

				<?php if($this->permission[0][2]==1){echo'checked'; }?>></input></td>
			</tr>
			<tr>
				<td><input name="edit_id"
					value="<?php echo $this->permission[0][0];?>" type='hidden'
					value=""></input>
				</td>
			</tr>
			<tr>
				<td><input type="submit"></input>&nbsp;&nbsp;<input value="Cancel"
					type='button' onclick='javascript:history.go(-1);'></input></td>
			</tr>
		</table>
	</form>
	
	
	
	

<?php
}else{


	?>
	<?php if(isset($_GET['result'])&&$_GET['result']=='update'){
				echo "<h3><p style='color:blue;'>Permission updated successfully!</p><h3>";
			}elseif(isset($_GET['result'])&&$_GET['result']==1){
				echo "<h3><p style='color:blue;'>Permission added successfully!</p><h3>";
			}?>
	<form name="searchRecord" id="searchRecord" action="index.php?option=com_permission&view=find&controller=permissions&searchRecord=1" method="post">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value='<?php echo $this->searchterm;?>' name="search" class="required" id="search"></input>
				&nbsp;&nbsp;<input type="submit" value="Search"></input>&nbsp;&nbsp;
				<a
			href="index.php?option=com_permission&view=add&controller=permissions&newRecord=1">New
			Permission!</a>
			</form>
			<form name="listform" id="listform" onsubmit="if(confirm('Are you sure you want to delete all selected records?')){return true}else{return false}"
				action="index.php?option=com_permission&view=delete&controller=permissions&deleteRecord=1"
				method='post'>
<table id="adminlist" class="tablesorter">
	<thead>
		<tr>
			<th></th>
			
			<th><a
				href="index.php?option=com_permission&view=permissions&controller=permissions&orderby=name&pagenum=<?php echo $_GET['pagenum'];?>">Name</a>
			</th>
			<th>IsActive</th>
			<th><a
				href="index.php?option=com_permission&view=permissions&controller=permissions&orderby=created_at&pagenum=<?php echo $_GET['pagenum'];?>">Created
					At</a></th>
			<th><a
				href="index.php?option=com_permission&view=permissions&controller=permissions&orderby=update_at&pagenum=<?php echo $_GET['pagenum'];?>">Updated
					At</a></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php if(!empty($this->permission)){?>
<p style="padding:5px 0 0 14px;">Select All<input id="allsts" name="selectall"  type='checkbox'
				value='checkAll'></input><input value='Delete All' type='submit' /></p>


	<?php 
	}
	foreach ($this->permission as $val){
			echo "<tr><td align='center'><input class='selsts required' name='selsts[]' type='checkbox' value='{$val[0]}'/></td>";
			
			echo "<td align='center'>".$val[1]."</td>";
			if($val[2]==0){
				echo "<td align='center'>False</td>";
			}else{
				echo "<td align='center'>True</td>";
			}
			echo "<td align='center'>".$val[3]."</td>";
			echo "<td align='center'>".$val[4]."</td>";
			echo "<td align='center'><a href='index.php?option=com_permission&view=edit&controller=permissions&id={$val[0]}&editRecord=1'>Edit</a>";
			echo "&nbsp;&nbsp;<a onclick=\"if(confirm('Are you sure you want to delete it?')){return true}else{return false}\" href='index.php?option=com_permission&view=delete&controller=permissions&delete_id={$val[0]}&deleteRecord=1'>Delete</a></td></tr>";
	
	}?>
</tbody>
</table>
<table align="center">
	<tr><td colspan='7' align='center'>	
	
<?php 
	$range = 4;
	$currentpage=$_GET['pagenum'];

	if ($currentpage > 1) {
		if($this->searchterm!=''){
			echo " <a href='index.php?option=com_permission&view=find&controller=permissions&searchRecord=1&pagenum=1&search=$this->searchterm'>First&nbsp;&nbsp;</a> ";
		}else{
	   		echo " <a href='index.php?option=com_permission&view=permissions&controller=permissions&pagenum=1'>First&nbsp;&nbsp;</a> ";
		}
		 $prevpage = $currentpage - 1;
		 if($this->searchterm!=''){
		 	echo " <a href='index.php?option=com_permission&view=find&controller=permissions&searchRecord=1&pagenum=$prevpage&search=$this->searchterm'>&nbsp;&nbsp;<&nbsp;&nbsp;</a> ";
		 }else{
	   		echo " <a href='index.php?option=com_permission&view=find&controller=permissions&pagenum=$prevpage'>&nbsp;&nbsp;<&nbsp;&nbsp;</a> ";
		 }
	} 
	
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
	   if (($x > 0) && ($x <= $this->totalPages)) {
	      if ($x == $currentpage) {
	         echo " [<b>$x</b>] ";
	      } else {
	      	
		      	if($this->searchterm!=''){
		      		echo " <a href='index.php?option=com_permission&view=find&controller=permissions&searchRecord=1&pagenum=$x&search=$this->searchterm'>&nbsp;&nbsp;$x&nbsp;&nbsp;</a> ";
		      	}else{
		      		echo " <a href='index.php?option=com_permission&view=permissions&controller=permissions&pagenum=$x'>&nbsp;&nbsp;$x&nbsp;&nbsp;</a> ";
		      	}
	         
	      } 
	   } 
	} 
	  
	if ($currentpage != $this->totalPages) {
	   $nextpage = $currentpage + 1;
	   
	   if($this->searchterm!=''){
	   		echo " <a href='index.php?option=com_permission&view=find&controller=permissions&searchRecord=1&pagenum=$nextpage&search=$this->searchterm'>&nbsp;&nbsp;>&nbsp;&nbsp;</a> ";
	   		echo " <a href='index.php?option=com_permission&view=find&controller=permissions&searchRecord=1&pagenum=$this->totalPages&search=$this->searchterm'>&nbsp;&nbsp;Last</a> ";
	   }else{
	   		echo " <a href='index.php?option=com_permission&view=permissions&controller=permissions&pagenum=$nextpage'>&nbsp;&nbsp;>&nbsp;&nbsp;</a> ";
	   		echo " <a href='index.php?option=com_permission&view=permissions&controller=permissions&pagenum=$this->totalPages'>&nbsp;&nbsp;Last</a> ";
	   	}
	} 
	?>
	</td>
	</tr>
</table>
</form>
<div>
<?php }?>