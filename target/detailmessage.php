
<?php
include('shared/header.php');
include('config/dbConf.php');

mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD);
mysql_select_db(DATABASE_NAME);
//include('../classes/statusreport.php');
 if(isset($_POST['case'])&&($_POST['case']!=''))
	{
	  
	  if($_POST['case']=='statusupdate')
	  {
		
		 $update="update soupport set read_status='1' where id='".$_POST['id']."'";
		$exequery=mysql_query($update);
		}
	}
 $id=$_GET['id'];
 $select="select * from soupport where id='".$id."'";
 
 $exequery=mysql_query($select);
 $fetchrow=mysql_fetch_array($exequery);
 $userto=$fetchrow['userto_id'];
 $userfrom=$fetchrow['userfrom_id'];

  $select3="select * from soupport where userto_id ='".$userto."' and userfrom_id='".$userfrom."'||userto_id ='".$userfrom."' and userfrom_id='".$userto."'";
  $exequery3=mysql_query($select3);
 
 $selectname="select full_name from users where id='".$userfrom."'";
 $exequery2=mysql_query($selectname);
 $fetchname=mysql_fetch_array($exequery2);
 $name=$fetchname['full_name'];
?>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" href="css/fancystyle.css" />
<div>
<form name="reply_form" id="reply_form" method="post" action="reply_act.php">
<table class="tablesorter" style="width:500px">
		
		
		  	<tr><th align="center">Message Details</th></tr>
			<tr><th >Name</th></tr>
			<tr><td><?php echo  $name;?></td></tr>
				
				<div style="overflow:auto; height:20px; margin-top:-20px;">
		 <?php while($fetchrows=mysql_fetch_array($exequery3))
 {      $status=$fetchrows['status'];?>
				<tr><th> Subject</th></tr>
				<tr><td><?php echo $fetchrows['subject'];?></td></tr>
				<tr> <th >Description</th></tr>
				<tr><td><?php  echo $fetchrows['meassage'];?></td></tr>
		<?php }?></div>
	
	
	    <tr><td>
	 
			  <?php if($status!=0) {?>
			 <tr> <th >Reply</th></tr>
       		 <tr><th> Subject</th></tr>
			 <tr><td><input type="text" name="re_subject" class="required" id="re_subject" value="<?php echo "RE:".$subject?>"></td></tr>
			 <tr> <th >Description</th></tr>
			 <tr><td><textarea id="re_support_msg" class="required"  name="re_support_msg"></textarea></td></tr>
			 <tr>
			 <th>Status</th></tr>
			 <tr>
			 <td><select name="re_status" id="re_status" class="required >
			 <option value="">Select</option>
			 <option value="1">Open</option>
			 <option value="0">Close</option>
			 </select>
			 </td>
			 </tr>
			<tr><td ><input type="hidden" name="reply_to" value="<?php echo $userfrom;?>"></td></tr>
			<tr><td ><input type="hidden" name="reply_from" value="<?php echo $fetchrow['userto_id'];?>"></td></tr>
			<tr><td ><input type="hidden" name="msg_id" value="<?php echo $fetchrow['id'];?>"></td></tr>
            <tr><td ><input type="submit" name="submit" value="submit"></td></tr>
			 <?php }?>
	 
	  </td></tr>
	
	</table></form>
	
</div>
	


