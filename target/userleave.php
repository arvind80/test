<?php 
	include("config/dbConf.php");

	 mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD);
	 mysql_select_db(DATABASE_NAME);
	 require_once('classes/statusreport.php');
	 $id=$_POST['id'];

      $users="select* FROM leave_app where user_id='".$id."'";
      $usersexe=mysql_query($users);
      $num=mysql_num_rows($usersexe);
      if($num>0){
      echo'<table width=100% class="tablesorter">
      <thead>
					   <tr>
							   <th align="center">Name</td>
							   <th align="center">Department</th>
							   <th align="center">Designation</th>
							   <th align="center">Curent Project</th>
							   <th align="center">Leave from</th>
							   <th align="center">Leave TO</th>
							   <th align="center">Leave Type</th>
							   <th align="center">Total Days </th>
							   <th align="center">Status </th>
					   </tr>
					    <thead>';
      while($row=mysql_fetch_array($usersexe)){  
		   $user_id=$row['user_id'];
		   ?>
			           <tr>
					   <td align="center"><?php echo ucfirst($row['name_employe']); ?></td>
					   <td align="center"><?php echo ucfirst($StatusReport->getDepartmentNameByUserId($user_id)); ?></td>
					   <td align="center"><?php echo ucfirst($row['designation']); ?></td>
					   <td align="center"><?php echo ucfirst($row['curent_project']); ?></td>
					   <td align="center"><?php echo $row['leave_from']; ?></td>
					   <td align="center"><?php echo $row['leave_to']; ?></td>
					    <td align="center"><?php echo ucfirst($row['leave_type']); ?></td>
					   <td align="center"><?php echo $row['total_days']; ?> </td>
					   <td align="center"><?php 
					   if($row['approve_status']==0){echo 'Not Approved';}
					   if($row['approve_status']==1){echo 'Approved';}
					   if($row['approve_status']==2){echo 'Waiting';}
					   ?> </td></tr>
					   <?php }
		
		echo "</table>";
}else{?>

	    <div class="error">No Result Found!</div>
	
<?php	}
?>
