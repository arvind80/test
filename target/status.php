<?php 
	session_start();
	include("config/dbConf.php");

	mysql_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD);
	mysql_select_db(DATABASE_NAME);
	require_once('classes/statusreport.php');
	$StatusReport=new StatusReport();

	$app=$_POST['app'];
	$msg=$_POST['msg'];
	$id=$_POST['id'];
	$dept_approvel=$_POST['dept_approvel'];

	$approvedByDeptHead=0;
	$updatestatus="update leave_app set";
	
	
    if($dept_approvel!='' && $dept_approvel!='undefined'){
		$updatestatus.=" dept_head_comment='".$_POST['msg']."',approved_by_dept_head ='".$dept_approvel."'";
		$approvedByDeptHead=1;
	}else{
		if($app=='' || $app=='undefined'){
			echo"failure";die;
		}
		$updatestatus.=" approve_status='".$app."'";
		$updatestatus.=",comment='".$msg."'";
	}

	 $updatestatus.=" where id='".$id."'";
	 $updatequery=mysql_query($updatestatus); 
if($updatequery){
	$selectmailids="select * from leave_app where id='". $id."'" ; 
	$exeselectmailids=mysql_query($selectmailids); 
	$bothselectmailids = mysql_fetch_array($exeselectmailids);
	$toselectmailids  = $bothselectmailids['mailsend_to'];
	$usermail = $StatusReport->getUserByEmailById($bothselectmailids['user_id']);
	$deptName=$StatusReport->getDepartmentNameById($bothselectmailids['dept_id']);
	$eachtoselectmailids=explode(',',$toselectmailids);
	array_push($eachtoselectmailids,$usermail[0]->email);
	
	$eachtoselectmailids=implode(',',$eachtoselectmailids);
	
	$subject="Leave Approvel";

	if($bothselectmailids['approve_status']==0){
		$approve_status="Not Approved";
	}

	if($bothselectmailids['approve_status']==1){
		$approve_status="Approved";
	}
	
	if($bothselectmailids['approve_status']==2){
		$approve_status="Waiting";
	}
	$data=$bothselectmailids;
	if($approvedByDeptHead==1){	
		$eachtoselectmailids='leave@kindlebit.com';
		$message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
					  <tr>
							<td>
								<div style="float:left; width:781px;">
								<div style="float:left; width:781px; height:90px;">
										 <font color="green"> A leave is approved by '.ucfirst($StatusReport->getDepartmentNameByUserId($data['user_id'])).' department head.Please login  to <strong>Target</strong> and take the desired action!</font>
										<img src="http://target.kindlebit.com/images/logo.png" alt="" />
								</div>
								<div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
										<p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
										<strong></strong><br><br>
										<strong>Employee Name:</strong> '.$data['name_employe'].'<br><br>
										<strong>Department:</strong> '.$StatusReport->getDepartmentNameByUserId($data['user_id']).'<br><br>
										<strong>Designation:</strong> '.$data['designation'].'<br><br>
										<strong>Current Project:</strong> '.$data['curent_project'].'<br><br>
										<strong>Leave Apply Date:</strong> '.date('Y-m-d',strtotime($data['created_at'])).'<br><br>
										<strong>Reason For Leave:</strong> '.$data['reason_for_leave'].'<br><br>';
										if($data['leave_type']=='halfday' || $data['leave_type']=='fullday'){
											$message.= '<strong>Leave Type:</strong> '.$data['leave_type'].'<br><br>';
											$message.= '<strong>Leave Date:</strong> '.$data['leave_from'].'<br><br>';
										}elseif($data['leave_type']=='shortleave'){
											$message.= '<strong>Leave Type:</strong> Short Leave<br><br>';
											$message.= '<strong>Leave Date:</strong> '.$data['leave_from'].'<br><br>';
											$message.= '<strong>Time Period:</strong> '.$data['short_leave_time'].'<br><br>';
										}
										elseif($data['leave_type']=='other'){
											$message.='<strong>Leave From:</strong> '.$data['leave_from'].'<br><br>
																<strong>Leave TO:</strong> '.$data['leave_to'].'<br><br>
																<strong>Number Of Days:</strong> '.$data['total_days'].'<br><br>';
										}
										$message.='<strong>Approved By department Head:</strong> '.$data['approved_by_dept_head'].'<br><br>
											<strong>Comment By Department Head:</strong> '.$data['dept_head_comment'].'<br><br>';		   
										$message.='</div></div></td></tr>
						</table>';
	}else{
		$message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
					  <tr>
							<td>
								<div style="float:left; width:781px;">
								<div style="float:left; width:781px; height:90px;">
										<img src="http://target.kindlebit.com/images/logo.png" alt="" />
								</div>
								<div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
										<p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
										<strong></strong><br><br>
										<strong>Employee Name:</strong> '.$data['name_employe'].'<br><br>
										<strong>Department:</strong> '.$StatusReport->getDepartmentNameByUserId($data['user_id']).'<br><br>
										<strong>Designation:</strong> '.$data['designation'].'<br><br>
										<strong>Current Project:</strong> '.$data['curent_project'].'<br><br>
										<strong>Leave Apply Date:</strong> '.date('Y-m-d',strtotime($data['created_at'])).'<br><br>
										<strong>Reason For Leave:</strong> '.$data['reason_for_leave'].'<br><br>';
										if($data['leave_type']=='halfday' || $data['leave_type']=='fullday'){
											$message.= '<strong>Leave Type:</strong> '.$data['leave_type'].'<br><br>';
											$message.= '<strong>Leave Date:</strong> '.$data['leave_from'].'<br><br>';
										}elseif($data['leave_type']=='shortleave'){
											$message.= '<strong>Leave Type:</strong> Short Leave<br><br>';
											$message.= '<strong>Leave Date:</strong> '.$data['leave_from'].'<br><br>';
											$message.= '<strong>Time Period:</strong> '.$data['short_leave_time'].'<br><br>';
										}
										elseif($data['leave_type']=='other'){
											$message.='<strong>Leave From:</strong> '.$data['leave_from'].'<br><br>
																<strong>Leave TO:</strong> '.$data['leave_to'].'<br><br>
																<strong>Number Of Days:</strong> '.$data['total_days'].'<br><br>';
										}
										$message.='<strong>Approved By department Head:</strong> '.$data['approved_by_dept_head'].'<br><br>
										<strong>Comment By Department Head:</strong> '.$data['dept_head_comment'].'<br><br>';
										$message.='<strong>Approved by Hr:</strong> '.$approve_status.'<br><br>
												   <strong>Comment By Hr:</strong> '.$data['comment'].'<br><br>';		   		   
							$message.='</div></div></td></tr>
						</table>';
	
	}
	$StatusReport->UserEmail($eachtoselectmailids,$subject,$message);
}else{
		echo "failure";
	}                     
?>
