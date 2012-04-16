<?php 
      include("config/dbConf.php");
	  mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD);
	   mysql_select_db(DATABASE_NAME);
	  $id=$_POST['id'];
      $value=@$_POST['value'];
      $case=$_REQUEST['case'];
     require_once('classes/statusreport.php');
	 $StatusReport=new StatusReport();
	 if($case == 'status_upd')
	 {
		 
     $update_status="update  users set status='".$value."' where id='".$id."'";
     $exeupdate_status=mysql_query($update_status);
     $affectedrows=mysql_affected_rows();
     if($affectedrows>0)
     {
		 echo "User updated Sucessfully";
	  }
     else{
		  echo "User Not Updated";
		 }
    }
   if($case == 'edit_user')
    {
		
	$userinfo =  $StatusReport->getUserById($id); 
	foreach($userinfo as $val)
	{
	$name= $val->full_name;
	$dept= $val->department;
	$mail= trim($val->email);
	$admin= @$val->admin;
	$deapt_head=$val->dept_head;
	echo $info=$name.",".$dept.",".$mail.",".$admin.",".$deapt_head;
    }
  }
 if($case == 'update_user'){  
		$date = date('Y-m-d H:i:s');
		$newtime = strtotime($date . ' + 12 hours 30 minutes');
		$created_at = date('Y-m-d', $newtime);
		
		
		
		$hour= date('H', $newtime);
		$minute= date('i',$newtime);
		$updated_at=date('Y-m-d h:i:s',$newtime);
				
	    $userhd_id=$_POST['hd_id'];
		$name=$_POST['full_name_edit'];
		$dept=$_POST['department_edit'];
		$mail=$_POST['email_edit'];
		$userid=$_POST['userid'];
		$dept_head=$_POST['dept_head'];
		$type=$_POST['type1'];
        $updateuser="Update users set
		full_name='".$name."',
		dept_head='".$dept_head."',
		type='".$type."',
		department='".$dept."',
		email='".$mail."',
		updated_at='".$updated_at."'
		where id=".$userhd_id;
		$exeupdateuser=mysql_query($updateuser);
		 $affectedrows=mysql_affected_rows();
		 if($affectedrows>0){
			
			header("Location:index.php?admin=true&msg=true#tabs-6");
			
			}
			else
			{
				
			header("Location:index.php?admin=true&msg=false#tabs-6");
			
			}
	
     }
	

	 ?>
	
	  
	   
	

