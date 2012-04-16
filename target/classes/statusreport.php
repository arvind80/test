<?php 
	require_once("configuration.php");
	class StatusReport extends Database{
		public $database;
		public $dailyReport;
		public $userAllStatus;
		public $numOfPages;
		public $perPageRecord;
		public $rowUpdated;
		
		public function __construct(){
			$this->database=new Database();
			$this->adminLogin=false;
			$this->perPageRecord=20;
		}
		
		protected  function checkLogin(){
			$email=$_POST['email'];
			$pass=$_POST['password'];
			$checkLogin="SELECT * FROM users WHERE email='".mysql_real_escape_string($email,$this->database->openDatabase())."' AND password='".md5(mysql_real_escape_string($pass,$this->database->openDatabase()))."' AND status='1'";
			$result=$this->database->execQry($checkLogin);
			
			if($this->database->numRows($result)==1){
				$useRow=$this->database->fecthRow($result);
				
				$_SESSION['user_id']=$useRow['id'];
				$_SESSION['type']=$useRow['type'];
				$_SESSION['full_name']=$useRow['full_name'];
				$_SESSION['dept_id']=$useRow['department'];
				$_SESSION['department']=$this->getDepartmentNameById($useRow['department']);
				if($useRow['type']=='admin' && isset($useRow['type'])){
				$this->adminLogin=true;}
			
				//check for department head.
				if($useRow['dept_head']==1){
					$_SESSION['dept_head']=$useRow['dept_head'];
					$_SESSION['template']='admin/reports.php';
					echo "DeptHead";
					exit();
				}
				$this->getUserAllStatus($useRow['id']);
				if($_SESSION['department']=='HR'){
					$_SESSION['template']='admin/reports.php';
					echo "HR";
					exit();
				}
				if($useRow['type']=='admin'){
					$_SESSION['template']='admin/reports.php';
					echo "admin";
					exit();
				}
				$_SESSION['template']='shared/home.php';
				echo 'success';
				exit();
			}
			else{
				echo "failure";
				exit();
			}
			
		}
		
		final public function getDepartmentNameById($dept_id=null){
				$this->database->db_query="SELECT * FROM department WHERE id='".$dept_id."'"; 
				$detptname= $this->database->fetchQuery();
				return $detptname[0]->dept_name;
		}
		
		final public function getDepartmentList($fetchDepartmentById=null){
				$deptArray=array();
				$check='';
					 if($_SESSION['user_id']==$this->getDefaultDepartmentHeadId()){
							//code to get the id of department which has no head!.
							$check="(SELECT DISTINCT department
								FROM users
								WHERE department NOT
								IN (
								SELECT DISTINCT department
								FROM users
								WHERE dept_head !=0
								))";
							 $this->database->db_query=$check;
							  $deptResultSet=$this->database->fetchQuery();
							  foreach($deptResultSet as $value){
								  if($value!=''){
									$deptArray[]=$value->department;
								  }
							  }
							  $deptArray=implode(',',$deptArray);
					 }
					
				  
				$this->database->db_query=" SELECT * FROM department";
				if(isset($fetchDepartmentById) && $fetchDepartmentById!=''){
					$this->database->db_query.=" WHERE id='".$fetchDepartmentById."'";
				}else{
					$this->database->db_query.=" WHERE 1";
				}
				
				if($check!=''){
					$this->database->db_query.=" or id in($deptArray)"; 
				}
			 	$this->database->db_query.=" order by dept_name"; 
				return  $this->database->fetchQuery();
		}
		
		final public function getDepartmentIdByUserId($userId){
				 $this->database->db_query="SELECT department.id FROM department
											INNER JOIN users
											ON users.department=department.id
											WHERE users.id='".$userId."'"; 
				
				 $deptId= $this->database->fetchQuery();
				return  $deptId[0]->id;
		}	
		
		final public function getDepartmentNameByUserId($userId){
				$this->database->db_query="SELECT department.dept_name FROM department
											INNER JOIN users
											ON users.department=department.id
											WHERE users.id='".$userId."'"; 
				 $detptname= $this->database->fetchQuery();
				 return $detptname[0]->dept_name;
		}	
		
		final public function getUserAllStatus($userId=null,$start_date=null,$end_date=null,$startLimit=null,$endLimit=null,$mode=null,$page=null,$pagination=null){
				 $this->database->db_query="SELECT * FROM daily_status ";
				if($userId!=''){
					 $this->database->db_query.=" WHERE user_id='".$userId."'";
				
					if((isset($start_date) && !empty($start_date))){
						if(!empty($start_date))
						$this->database->db_query.=" AND created_at >= '".$start_date."'";  
						if(!empty($end_date))
						$this->database->db_query.=" AND created_at<='".$end_date."'";
					}
				}else{
					if((isset($start_date) && !empty($start_date))){
						if(!empty($start_date))
						 $this->database->db_query.=" WHERE created_at >= '".$start_date."'";  
						if(!empty($end_date))
						 $this->database->db_query.=" AND created_at<='".$end_date."'";
					}
					
				}
				//adding order by clause.
				$this->database->db_query.=" ORDER BY id desc";
				//Code for pagination.
				if((isset($startLimit) && !empty($startLimit)) && (isset($endLimit) && !empty($endLimit))){
					$this->database->db_query.=" Limit $startLimit,$endLimit";
				}
				if($mode=='ajax'){
					$start = ($page-1)*$this->perPageRecord;
					if($pagination!='no')
				 	$this->database->db_query.=" Limit $start,$this->perPageRecord";
					
				}else{
					 $this->numOfPages=ceil($this->database->numRows($this->database->execQry($this->database->db_query))/$this->perPageRecord);
				 	 if($pagination!='no')
				 	 $this->database->db_query.=" Limit 0,$this->perPageRecord";
				}
				
				$this->userAllStatus=$this->database->fetchQuery();
				if($mode!='ajax'){
					 
					  return  $this->userAllStatus;
				}else{
					$this->getAjaxHTML();
				}
			 
		}
		
		
		protected function saveStatusReport(){

				$date = date('Y-m-d H:i:s');
				$newtime = strtotime($date . ' + 12 hours 30 minutes');
				$created_at = date('Y-m-d', $newtime);
				
				
				
				$hour= date('H', $newtime);
				$minute= date('i',$newtime);
				$updated_at=date('Y-m-d h:i:s',$newtime);
				
				if($hour<=7){
						 $onedayback=strtotime($created_at . '-1 day');
						 $created_at = date('Y-m-d',$onedayback);
						 $updated_at="03:22:22";
				}
				
			 	$saveStatus="INSERT INTO daily_status(user_id,
														  project_name,
														  project_type,
														  project_description,
														  odesk_id,
														  client_name,
														  company_name,
														  hour_billed,
														  working_hour,
														  free_hour,
														  estimated_hour,
														  created_at,
														  time_at)VALUES(
														  '".$_SESSION['user_id']."',
														  '".strtolower(mysql_real_escape_string($_POST['project_name'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['project_type'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['project_description'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['odesk_id'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['client_name'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['company_name'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string((float)($_POST['billing_hour'].'.'.$_POST['billing_minute']),$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($this->checkProjectType('fixed'),$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($this->checkProjectType('other'),$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['estimated_hour'],$this->database->openDatabase()))."',
														  '".$created_at."',
														  '".$updated_at."'
														  )";
				return $this->database->execQry($saveStatus) or die('error'.mysql_error()) ;		  
		}
		
		final public function checkProjectType($type=null){
			
			if($_POST['project_type']==$type){
				return $_POST['working_hour'];
			}else{
				return 0.00;
			}
		}
		
	    final public function getPdfData1($dept=null,$viewByDate=null){
			
			if($dept!='' && $dept!='all'){
				 $this->database->db_query="SELECT * FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id
				 WHERE department.id='".$dept."'";
				 
				 
			}if($dept=='all'){
				 $this->database->db_query="SELECT * FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id where 1";
			}
			
			if(isset($viewByDate) && !empty($viewByDate)){
			     $this->database->db_query.="  AND daily_status.created_at='".$viewByDate."'";
			}else{
			 	 $this->database->db_query.=" AND daily_status.created_at=CURDATE() ";
			}
		 	$this->database->db_query.=" order by department.id,daily_status.user_id";
			$this->dailyReport=$this->database->fetchQuery();
		}
		
		final public function getPdfData($dept=null,$viewByDate=null,$end_date=null,$odesk=null){
			
			if($dept!='' && $dept!='all'){
				 $this->database->db_query="SELECT daily_status.id,daily_status.project_type,daily_status.user_id,daily_status.project_name,daily_status.project_description,daily_status.odesk_id,daily_status.client_name,
				 daily_status.company_name,daily_status.free_hour,daily_status.free_hour,daily_status.hour_billed,daily_status.estimated_hour,daily_status.working_hour,daily_status.created_at 		 FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id
				 WHERE department.id='".$dept."'";
			}if($dept=='all'){
				 $this->database->db_query="SELECT daily_status.id,daily_status.user_id,daily_status.project_type,daily_status.project_name,daily_status.project_description,daily_status.odesk_id,daily_status.client_name,
				 daily_status.company_name,daily_status.free_hour,daily_status.free_hour,daily_status.hour_billed,daily_status.estimated_hour,daily_status.working_hour,daily_status.created_at FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id where 1";
			}
			if($odesk!=''){
				$this->database->db_query.="  AND daily_status.created_at>='".$viewByDate."' AND daily_status.created_at<='".$end_date."'
				 AND daily_status.project_type='odesk'";
			}else{
				if(isset($viewByDate) && !empty($viewByDate)){
				     $this->database->db_query.="  AND daily_status.created_at='".$viewByDate."'";
				}else{
				 	 $this->database->db_query.=" AND daily_status.created_at=CURDATE() ";
				}
			}
		  	$this->database->db_query.=" order by department.id,daily_status.user_id";
			$this->dailyReport=$this->database->fetchQuery();
		}
		
		//function to fetch user list order by department.
		final public function getUserList($orderBy=null,$deptId=null){

			 //code to check if department head is the defalut department head also.
			 $check='';
			 if($_SESSION['user_id']==$this->getDefaultDepartmentHeadId()){
				 	//code to get the id of department which has no head!.
				 	$check=" || department in(SELECT DISTINCT department
						FROM users
						WHERE department NOT
						IN (
						SELECT DISTINCT department
						FROM users
						WHERE dept_head !=0
						))";
			 }
			 
			 $this->database->db_query="SELECT * FROM users WHERE type!='admin' and status=1";
			 
			 if(isset($deptId) && $deptId!=''){
			 	$this->database->db_query.=" AND department='".$deptId."'";
			 }
			 
			 if($check!=''){
				 $this->database->db_query.=$check;
			 }
			 
			 if(isset($orderBy) && $orderBy!=''){
				   $this->database->db_query.=" ORDER BY ".$orderBy;
			 }
			 else{
					  $this->database->db_query.=" ORDER BY department,id";
			 }
			    $this->database->db_query;
				return $this->database->fetchQuery();
		}
		
		//function to save a new user.
	    protected  function addNewUser(){
                                $date = date('Y-m-d H:i:s');
                                $newtime = strtotime($date . ' + 12 hours 30 minutes');
                                $created_at = date('Y-m-d H:i:s', $newtime);
                                $updated_at = date('H:i:s', $newtime);
                                $saveUser="INSERT INTO users(
                                                                                          full_name,
                                                                                          department,
                                                                                          dept_head,
                                                                                          email,
                                                                                          password,
                                                                                          type,
                                                                                          created_at,
                                                                                          updated_at)VALUES(
                                                                                          '".strtolower(mysql_real_escape_string($_POST['full_name'],$this->database->openDatabase()))."',
                                                                                          '".strtolower(mysql_real_escape_string($_POST['department'],$this->database->openDatabase()))."',
                                                                                           '".(mysql_real_escape_string($_POST['dept_head'],$this->database->openDatabase()))."',
                                                                                          '".strtolower(mysql_real_escape_string($_POST['email'],$this->database->openDatabase()))."',
                                                                                          '".md5(mysql_real_escape_string($_POST['password'],$this->database->openDatabase()))."',
                                                                                          '".(mysql_real_escape_string($_POST['type'],$this->database->openDatabase()))."',
                                                                                          '".$created_at."',
                                                                                          '".$updated_at."'
                                                                                          )";
                        return $this->database->execQry($saveUser);
        }
		
		final public function getUserNameById($userId){
			$this->database->db_query="SELECT full_name FROM users WHERE id='".$userId."'";
				return $this->database->fetchQuery();
		}
		
		final public function getAjaxHTML(){
			echo"<thead>
								<tr>
									<th>Department</th>
									<th>Project Name</th>
									<th>Project Type</th>
									<th>Project Description</th>
									<th>Odesk Id</th>
									<th>Client Name</th>
									<th>Company Name</th>
									<th>Hour Billed</th>
									<th>Working Hour</th>
									<th>Others Hour</th>
									<th>Created At</th>
								</tr>
				</thead><tbody>";
			foreach($this->userAllStatus as $val){
					echo"<tr>";
					echo"<td align='center'>".$this->getDepartmentNameByUserId($_SESSION['user_id'])."</td>";
					echo"<td align='center'>".$val->project_name."</td>";
					echo"<td align='center'>".$val->project_type."</td>";
					echo"<td align='center' onmouseover='this.style.cursor=\"pointer\"' title='".strip_tags($val->project_description)."'>".substr($val->project_description,0,10)." ...</td>";
					echo"<td align='center'>".$val->odesk_id."</td>";
					echo"<td align='center'>".$val->client_name."</td>";
					echo"<td align='center'>".$val->company_name."</td>";
					echo"<td align='center'>".$val->hour_billed."</td>";
					echo"<td align='center'>".$val->working_hour."</td>";
					echo"<td align='center'>".$val->free_hour."</td>";
					echo"<td align='center'>".$val->created_at."</td>";
					echo"</tr>";
			 }
			 echo"</tbody>";
			exit();
		}
		
		protected  function changePassword(){
		
			if((isset($_POST['new_password']) && $_POST['new_password']!='' && $_POST['confirm_password']!='') && ($_POST['current_password']!=$_POST['new_password']) && ($_POST['new_password']==$_POST['confirm_password'])){
				$changePassword="Update users set password='".md5(mysql_real_escape_string($_POST['new_password'],$this->database->openDatabase()))."' 
								WHERE id='".$_SESSION['user_id']."'
								AND password='".md5(mysql_real_escape_string($_POST['current_password'],$this->database->openDatabase()))."'
								AND password!='".md5(mysql_real_escape_string($_POST['new_password'],$this->database->openDatabase()))."'";
				$this->database->execQry($changePassword);
				
				$checkUpdate="select * from users where password='".md5(mysql_real_escape_string($_POST['new_password'],$this->database->openDatabase()))."' and id='".$_SESSION['user_id']."'";
				$result=$this->database->execQry($checkUpdate);
				if($this->database->numRows($result)==1){
						return 1;
				}
				return 0;
			}else{
				return 0;
			}
		}
		protected  function viewAttendance(){
			$this->database->db_query="SELECT * FROM attendance WHERE created_at>='".mysql_real_escape_string($_POST['start_date'],$this->database->openDatabase())."'";
			
			if(isset($_POST['end_date']) && $_POST['end_date']!=''){
				$this->database->db_query.=" AND created_at<='".mysql_real_escape_string($_POST['end_date'],$this->database->openDatabase())."'";
			}
			
			if(isset($_POST['viewtype'])&& $_POST['viewtype']!=''&& isset($_POST['viewtype']) && $_POST['viewtype']!='viewall'){
				$this->database->db_query.=" AND (arrival_status='".mysql_real_escape_string($_POST['viewtype'],$this->database->openDatabase())."'";
				if($_POST['viewtype']=='late_coming'){
						$this->database->db_query.=" OR leave_type='shortleave')";
				}else{
					$this->database->db_query.=" )";
				}
			}
			
			if(isset($_POST['viewuser'])&&$_POST['viewuser']!=''){
				$this->database->db_query.=" AND user_id='".mysql_real_escape_string($_POST['viewuser'],$this->database->openDatabase())."'";
			}
			echo"<table class=\"tablesorter\" style=\"width:1000px;\" align='center' cellspacing='15'>
					<thead>
						<tr style=\"background-color:skyblue;\">
							<th align='center'>UserName</th>
							<th align='center'>Arrival Status</th>
							<th align='center'>Late Arrived Time</th>
							<th align='center'>Leave Status</th>
							<th align='center'>Leave Type</th>
							<th align='center'>Date</th>
						</tr>
					</thead>";
			echo"<tbody>";
			foreach($this->database->fetchQuery() as $val){
				if($val->user_id!=''){
					$username=$this->getUserNameById($val->user_id);
					if($val->arrival_status=='late_coming'){
						$val->arrival_status='Late Coming';
					}
					echo"<tr>";
						echo"<td align='center'>".ucfirst($username[0]->full_name)."</td>";
						echo"<td align='center'>".$val->arrival_status ."</td>";
						echo"<td align='center'>".$val->late_arrived_time."</td>";
						echo"<td align='center'>".$val->leave_status."</td>";
						echo"<td align='center'>".$val->leave_type."</td>";
						echo"<td align='center'>".$val->created_at."</td>";
					echo"</tr>";
				}else{
					echo"<tr>";
					echo"<td align='center' colspan='4'><font color='red'>No result found!</font></td>";
					echo"</tr>";
				}
				
			}
			echo"</tbody></table>";
		}
		
		protected  function saveAttendance(){
			$userIds=($_POST['username']);
			unset($_POST['username']);
			
			$date = date('Y-m-d H:i:s');
			$newtime = strtotime($date . ' + 12 hours 30 minutes');
			$created_at = date('Y-m-d', $newtime);
			$updated_at = date('Y-m-d H:i:s', $newtime);
			$leavetype="";
			if(isset($_POST['updateSubmit']) && $_POST['updateSubmit']=='Update'){
				$lineUpdateItem=array();
					foreach($userIds as $key=>$val){
						if(isset($_POST['onleave'.$val]) && $_POST['onleave'.$val]!=''){
							if(isset($_POST['onleaveSelect'.$val]) && $_POST['onleaveSelect'.$val]!=''){
								if($_POST['onleaveSelect'.$val]=='notapproved'){
									$_POST['onleaveSelect'.$val]='not_approved';
									if($_POST['leave_type'.$val]=='shortleave' || $_POST['leave_type'.$val]=='halfday'){
										$_POST['attendance'.$val]='leave';
									}
									else{
										$_POST['attendance'.$val]='absent';
									}
								}else{
									$_POST['attendance'.$val]='leave';
								}
							}
							
							$_POST['textattendance'][$key]=($_POST['leave_type'.$val]=='shortleave')?$_POST['shortleave_late_arrived_time'.$val]:'';
							if(isset($_POST['leave_type'.$val]) && ($_POST['leave_type'.$val]!='')){
								$leavetype=$_POST['leave_type'.$val];
							}else{
								$leavetype='fullday';
							}
						}else{
								$_POST['onleaveSelect'.$val]='';
								$leavetype='';
								if($_POST['attendance'.$val]!='late_coming' && $_POST['leave_type'.$val]!='shortleave'){
									$_POST['textattendance'][$key]='';
								}
						}
						
						$lineUpdateItem[]=array($userIds[$key],$_POST['attendance'.$val],$_POST['textattendance'][$key],$_POST['onleaveSelect'.$val],$leavetype);	
						$leavetype='';
					}
					
					//loop  to update all the record.
					
					foreach($lineUpdateItem as $item){
						$this->rowUpdated++;
						 $updateQuery="Update attendance SET arrival_status='".mysql_real_escape_string($item[1],$this->database->openDatabase())."',
																			 late_arrived_time='".mysql_real_escape_string($item[2],$this->database->openDatabase())."',
																			 leave_status='".mysql_real_escape_string($item[3],$this->database->openDatabase())."',
																			 updated_at='".$updated_at."',
																			 leave_type='".mysql_real_escape_string($item[4],$this->database->openDatabase())."'
																			 WHERE user_id='".mysql_real_escape_string($item[0],$this->database->openDatabase())."'";
						$result=$this->database->execQry($updateQuery);
						unset($updateQuery);
					}
					return 0; 
			}else{
				
				 $saveAttendance="INSERT INTO attendance(user_id,arrival_status,late_arrived_time,leave_status,created_at,updated_at,leave_type)VALUES ";
				foreach($userIds as $key=>$val){
					if(isset($_POST['onleave'.$val]) && $_POST['onleave'.$val]!=''){
						if(isset($_POST['onleaveSelect'.$val]) && $_POST['onleaveSelect'.$val]!=''){
							if($_POST['onleaveSelect'.$val]=='notapproved'){
								$_POST['onleaveSelect'.$val]='not_approved';
								if($_POST['leave_type'.$val]=='shortleave' || $_POST['leave_type'.$val]=='halfday'){
										$_POST['attendance'.$val]='leave';
									}
								else{
								$_POST['attendance'.$val]='absent';}
							}else{
								$_POST['attendance'.$val]='leave';
							}
						}
						$_POST['textattendance'][$key]=($_POST['leave_type'.$val]=='shortleave')?$_POST['shortleave_late_arrived_time'.$val]:'';
						$_POST['leave_type'.$val]=($_POST['leave_type'.$val]=='')?'fullday':$_POST['leave_type'.$val];
					}
					
					
						
					
					$saveAttendance.="('".mysql_real_escape_string($userIds[$key],$this->database->openDatabase())."',
									'".mysql_real_escape_string($_POST['attendance'.$val],$this->database->openDatabase())."',
									'".mysql_real_escape_string($_POST['textattendance'][$key],$this->database->openDatabase())."',
									'".mysql_real_escape_string($_POST['onleaveSelect'.$val],$this->database->openDatabase())."',
									'".$created_at."',
									'".$updated_at."',
									'".mysql_real_escape_string($_POST['leave_type'.$val],$this->database->openDatabase())."'
									),";
				}
				$lastIndex=strrpos($saveAttendance,',');
				$SaveAttendance=substr($saveAttendance,0,$lastIndex);
				return $this->database->execQry($SaveAttendance);
			}
		}
		
		 protected function editAttendance(){
			$this->database->db_query="SELECT * FROM attendance WHERE
			created_at=	'".mysql_real_escape_string($_POST['date'],$this->database->openDatabase())."'";
			$check=0;
		
			echo"<form name='attendance_form'  action=\"process.php?action=saveAttendance\" id=\"attendance_form\" method=\"post\">";
				echo"<table width=\"1000px;\" cellspacing=\"15\" class=\"tablesorter\" id=\"filltodayattendance\"><tbody>";
			foreach($this->database->fetchQuery() as $user){
					$result=$this->getUserNameById($user->user_id);
							 $username=$result[0]->full_name;
					if(!empty($user->user_id)){
						if($check==0){
							$check=1;
						}
						echo"<tr><td><tr><td width='200px'><input type='hidden'  value=\"$user->user_id\"  id='username$user->user_id' name='username[]'/>
							<font color=\"green\">$username</font></td>
							<td width='450px'>";
						if($user->leave_status!='approved' && $user->leave_status!='not_approved'){
							echo"<p id=\"attendancebox$user->user_id\">";
						}else{	
							echo"<p style='display:none;' id=\"attendancebox$user->user_id\">";
						}
						if($user->arrival_status=='present'){
							echo"<input type=\"radio\" value=\"present\" selected class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"present\" id=\"present$user->user_id\" name=\"attendance$user->user_id\" checked/><font color=\"green\">Present</font>&nbsp";
						}else{
							echo"<input type=\"radio\" value=\"present\" selected class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"present\" id=\"present$user->user_id\" name=\"attendance$user->user_id\"";if($user->leave_status!=''){ echo 'checked';} echo "/><font color=\"green\">Present</font>&nbsp";
						}
						
						if($user->arrival_status=='absent'){
							echo"<input type=\"radio\" value=\"absent\" class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"absent\" id=\"absent$user->user_id\" name=\"attendance$user->user_id\" checked/><font color=\"red\">Absent";
						}else{
							echo"<input type=\"radio\" value=\"absent\" class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"absent\" id=\"absent$user->user_id\" name=\"attendance$user->user_id\" /><font color=\"red\">Absent";
						}
						if($user->arrival_status=='late_coming'){
							echo"<input type=\"radio\"  class=\"required\" value=\"late_coming\" onclick=\"gettime($user->user_id,'')\" id=\"late_coming$user->user_id\" name=\"attendance$user->user_id\" checked/><font color=\"brown\">Late Coming";
						}else{
							echo"<input type=\"radio\"  class=\"required\" value=\"late_coming\" onclick=\"gettime($user->user_id,'')\" id=\"late_coming$user->user_id\" name=\"attendance$user->user_id\"/><font color=\"brown\">Late Coming";
						}
						if($user->late_arrived_time!=''){
							echo"<input type=\"text\" style=\"width:50px;\" id=\"textattendance$user->user_id\" value='$user->late_arrived_time'   name=\"textattendance[]\"/>";
						}else{
								echo"<input type=\"text\" style=\"display:none;width:50px;\" id=\"textattendance$user->user_id\"    name=\"textattendance[]\"/>";
						}
						echo"</p> </td><td width=\"150px;\">";
						if($user->leave_status!=''){
								echo"<input type=\"checkbox\" value=\"$user->user_id\" onclick=\"hideShowAttendance(this.value);\" name=\"onleave$user->user_id\" checked /><font color=\"green\">On Leave</font></td>";
						}
						else{
								echo"<input type=\"checkbox\" value=\"$user->user_id\" onclick=\"hideShowAttendance(this.value);\" name=\"onleave$user->user_id\"/><font color=\"green\">On Leave</font></td>";
						}
						if($user->leave_status!=''){
							echo"<td width=\"350px;\"><p id=\"leavebox$user->user_id\">";
						}
						else{
								echo"<td><p id=\"leavebox$user->user_id\" style=\"display:none\">";
							}
						echo"<select name=\"onleaveSelect$user->user_id\"  id=\"onleaveSelect$user->user_id\">";
						echo"<option value=''>Please Select One</option>";
							if($user->leave_status=='approved'){
								echo"<option value=\"approved\" selected>Approved</option>";
							}else{
								echo"<option value=\"approved\">Approved</option>";
							}
							if($user->leave_status=='not_approved'){
								echo"<option value=\"notapproved\" selected>Not Approved</option>";
							}else{
								echo"<option value=\"notapproved\">Not Approved</option>";
							}
						 echo"</select>
						</p>";
						if($user->leave_status!=''){
							echo"<p  style=\"font-size:9px;display:block;\" id=\"type_of_leave_box$user->user_id\">";
						}else{
							echo"<p  style=\"font-size:9px;display:none;\" id=\"type_of_leave_box$user->user_id\">";
						}
						echo"<font color=\"brown\">Short Leave</font>";
						if($user->leave_type=='shortleave'){
							echo "<input type=\"radio\" value=\"shortleave\" onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" name=\"leave_type$user->user_id\" checked/>";
							echo "<input type=\"textbox\"  style=\"width:50px;display:block;\" name=\"shortleave_late_arrived_time$user->user_id\" value=\"$user->late_arrived_time\" id=\"shortleave_late_arrived_time$user->user_id\"/>";
						}
						else{
							echo"<input type=\"radio\" value=\"shortleave\" onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" name=\"leave_type$user->user_id\"/>";
							echo "<input type=\"textbox\"  style=\"width:50px;display:none\" name=\"shortleave_late_arrived_time$user->user_id\" id=\"shortleave_late_arrived_time$user->user_id\"/>";
						}
						if($user->leave_type=='halfday'){
							echo "<font color=\"brown\">Half Day Leave</font><input type=\"radio\"  onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" value=\"halfday\" name=\"leave_type$user->user_id\" checked/>";
						}else{
							echo "<font color=\"brown\">Half Day Leave</font><input type=\"radio\"  onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" value=\"halfday\" name=\"leave_type$user->user_id\" />";
						}
						echo"</p>
					  </td>
					</tr>
					<script>
					 $(document).ready(function() {
						$('#textattendance'+$user->user_id).mouseover(function(){
							$('#textattendance'+$user->user_id).timepicker();
						});
						$('#shortleave_late_arrived_time'+$user->id).mouseover(function(){
							$('#shortleave_late_arrived_time'+$user->id).timepicker();
						});
					});
					</script>";
				
				
					}else{
						echo "<td colspan='4' align='center'>No Result Found!</td>";
					}
				}
				if($check==1){
				echo"<tr>
					<td><input type=\"submit\" name='updateSubmit'  value=\"Update\"/></td></tr></tr></td></tbody></table></form><script>$('#attendance_form').validate();</script>";	
				}
			}
		 final public function getDefaultDepartmentHeadId(){
					 $this->database->db_query="SELECT id FROM users WHERE default_dept_head='1'";
							$result= $this->database->fetchQuery();
							return $result[0]->id;
		 } 	
		 protected function leaveform(){
			$data=$_POST;
			$date = date('Y-m-d H:i:s');
			$receipientList='';
			$newtime = strtotime($date . ' + 12 hours 30 minutes');
			$created_at = date('Y-m-d H:i:s', $newtime);
			$dept_head_Id=$this->getIdOfdept_headfromDepartment($_SESSION['dept_id']);
			if($dept_head_Id[0]->id==''){
				 $dept_head_Id[0]->id=$this->getDefaultDepartmentHeadId();
			}
			$dept_head_email=$this->getUserById($dept_head_Id[0]->id);
			$dept_head_email=$dept_head_email[0]->email;
			if(@$_SESSION['dept_head']!=''){
				$receipientList='nvnkumar59@yahoo.in';
				$approved_by_dept_head='approved';
			}else{
				$receipientList=$dept_head_email.',nvnkumar59@yahoo.in';
				$approved_by_dept_head='';
			}
			$senderUserObject=$this->getUserById($_SESSION['user_id']);
		    $senderUserEmail=$senderUserObject[0]->email;
		    $receipientList.=','.$senderUserEmail;
			$short_leave_time='';
			
			if($data['type_of_leave']=='halfday'){
				$data['total_days']='00.50';
				$data['from_date']=$data['halfday_fullday__leave_date'];
				$data['to_date']=$data['halfday_fullday__leave_date'];
			}elseif($data['type_of_leave']=='fullday'){
				$data['total_days']='1.00';
				$data['from_date']=$data['halfday_fullday__leave_date'];
				$data['to_date']=$data['halfday_fullday__leave_date'];
			}elseif($data['type_of_leave']=='shortleave'){
				$short_leave_time=$data['short_leave_time_from'].' To '.$data['short_leave_time_to'];
				$data['from_date']=$data['short_leave_text_box'];
				$data['to_date']=$data['short_leave_text_box'];
			}
			else{
					$data['halfday_fullday__leave_date']='';
			}
			if((($data['emp_name']!='') && ($data['emp_dept1']!='')&&($data['emp_designation']!='')&&($data['emp_cur_Project']!='')&& ($data['total_days']!=''))|| $data['type_of_leave']=='shortleave'){ 
				  $leaveStartdate='';
				  $leave_form="insert into leave_app(user_id,
													name_employe,
													designation,
													curent_project,
													leave_type,
													leave_session,
													leave_from,
													leave_to,
													total_days,
													approved_by_dept_head,
													short_leave_time,
													reason_for_leave,
													approve_status,
													created_at,
													mailsend_to,
													comment)
												values('".$_SESSION['user_id']."',
												'".mysql_real_escape_string($data['emp_name'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['emp_designation'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['emp_cur_Project'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['type_of_leave'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['halfday_fullday__leave__half_select'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['from_date'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['to_date'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['total_days'],$this->database->openDatabase())."',
												'".$approved_by_dept_head."',
												'".mysql_real_escape_string($short_leave_time,$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['reason_for_leave'],$this->database->openDatabase())."',
												'2',
												'".$created_at."',
												'".mysql_real_escape_string($receipientList,$this->database->openDatabase())."',
												'')";
				$result=$this->database->execQry($leave_form);
					if($result){  
							 $subject="Leave Application";
							 $message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
							  <tr><td>Leave Application!</td></tr>
							  <tr>
									<td>
													<div style="float:left; width:781px;">
													<div style="float:left; width:781px; height:90px;">
															<img src="http://target.naveen.com/images/logo.png" alt="" />
													</div>
													<div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
															<p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
															<strong></strong><br><br>
															<strong>Name:</strong> '.$data['emp_name'].'<br><br>
															<strong>Department:</strong> '.$data['emp_dept1'].'<br><br>
															<strong>Designation:</strong> '.$data['emp_designation'].'<br><br>
															<strong>Current Project:</strong> '.$data['emp_cur_Project'].'<br><br>
															<strong>Reason For Leave:</strong> '.$data['reason_for_leave'].'<br><br>
															<strong>Leave Apply Date:</strong> '.date('Y-m-d',strtotime($created_at)).'<br><br>';
															
															if($data['type_of_leave']=='halfday' ||$data['type_of_leave']=='fullday'){
																if($data['type_of_leave']=='halfday'){
																	if($data['halfday_fullday__leave__half_select']=='second_half'){
																		$session= 'Second Half';
																	}else{
																		$session= 'First Half';
																	}
																	$message.= '<strong>Session:</strong> '.$session.'<br><br>';
																}
																$message.= '<strong>Leave Date:</strong> '.$data['halfday_fullday__leave_date'].'<br><br>';
															}elseif($data['type_of_leave']=='shortleave'){
																$message.= '<strong>Leave Type:</strong> Short Leave<br><br>';
																$message.= '<strong>Leave Date:</strong> '.$data['short_leave_text_box'].'<br><br>';
																$message.= '<strong>Time Period:</strong> '.$short_leave_time.'<br><br>';
															}
															elseif($data['type_of_leave']=='other'){
																$message.='<strong>Leave From:</strong> '.$data['from_date'].'<br><br>
																					<strong>Leave TO:</strong> '.$data['to_date'].'<br><br>
																					<strong>Number Of Days:</strong> '.$data['total_days'].'<br><br>';
															}				   
									$message.='</div></div></td></tr>
							</table>';
							 $this->UserEmail($receipientList,$subject,$message);
						   }
					   }
			return $result;
		  }
                    
             
		final public function getUserByEmail($mailofuser){
				 $this->database->db_query="SELECT full_name FROM users WHERE email='".$mailofuser."'";
						return $this->database->fetchQuery();
		}
        final public function getUserByEmailById($userid){
				 $this->database->db_query="SELECT email FROM users WHERE id='".$userid."'";
						return $this->database->fetchQuery();
		}       
		final public function UserEmail($mailto,$subject,$message){ 
				$userObject=  $this->getUserNameById($_SESSION['user_id']);
				$userName=    $userObject[0]->full_name;
				$from  =     $userName ;
				$headers='';
				$headers .= "MIME-Version: 1.0\n" ;
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
				$headers .= "X-Priority: 1 (Higuest)\n";
				$headers .= "X-MSMail-Priority: High\n";
				$headers .= "Importance: High\n";
				$headers .= 'From:'."nvnkumar59@yahoo.in"."\r\n";
				//$headers .= 'To:';
				$mailto=explode(',',$mailto);
				foreach($mailto as $val){            
					$emails=$val;
					//$headers.= $val.',';
				}
				$lastIndex=strrpos($headers,',');
				//$headers=substr($headers,0,$lastIndex);
			    //$headers .= "\r\n";
				$count=0;
				foreach($mailto as $email){
					$count++;
					if($count==3){
						//$message='';
					}
					$mail=mail($email,$subject,$message,$headers);
				}
        }  
        
		final public function getLeaveList($fetchUserByDeptID=null){
				  $deptArray=array();
				  $deptArray_String='';
				  $check='';
					 if($_SESSION['user_id']==$this->getDefaultDepartmentHeadId()){
							//code to get the id of department which has no head!.
							$check="(SELECT DISTINCT department
								FROM users
								WHERE department NOT
								IN (
								SELECT DISTINCT department
								FROM users
								WHERE dept_head !=0
								))";
					
					
				  $this->database->db_query=$check;
				  $deptResultSet=$this->database->fetchQuery();
				  foreach($deptResultSet as $value){
					  if($value!=''){
						$deptArray[]=$value->department;
					  }
				  }
				   $deptArray_String=implode(',',$deptArray);
				  }
				  $this->database->db_query="SELECT la.id,
									la.user_id,
									la.name_employe,
									la.designation,
									la.curent_project,
									la.leave_type,
									la.leave_session,
									la.leave_from,
									la.created_at,
									la.	approved_by_dept_head,
									la.leave_to,
									la.total_days,
									la.reason_for_leave,
									la.approve_status
								FROM leave_app la";
				 if(isset($fetchUserByDeptID) && $fetchUserByDeptID!=''){
					
				 	$this->database->db_query.=" INNER JOIN users
						ON users.id=la.user_id
						INNER JOIN department
						ON users.department=department.id
						WHERE department.id='".$fetchUserByDeptID."'
						
						AND la.approve_status>'1'
				 	";
				 	if($check!=''){
						$this->database->db_query.=" OR department.id in($deptArray_String)";
					}
				 }else{$this->database->db_query.=" WHERE la.approve_status>'1'";}
				      $this->database->db_query.=" order by la.id desc";
				 return $this->database->fetchQuery();
		}
		 
		final public function getUserLeavestatus(){
					 $this->database->db_query="SELECT * FROM leave_app WHERE 	approve_status<='1'
												AND user_id='".$_SESSION['user_id']."' 
												order by id desc";
							return $this->database->fetchQuery();
		}
		
		final public function getUserListings($orderBy=null,$fetchUserByDeptID=null){
                        
			 $this->database->db_query="SELECT * FROM users WHERE type!='admin' ";
			 
			 if(isset($fetchUserByDeptID) && $fetchUserByDeptID!=''){
				  $this->database->db_query.=" AND department='".$fetchUserByDeptID."' ";
			 }
			 if(isset($orderBy) && $orderBy!=''){
				  $this->database->db_query.=" ORDER BY ".$orderBy;
			  }
			  else{
				  $this->database->db_query.=" ORDER BY department,id";
			  }
					return $this->database->fetchQuery();
        }
        
        
        final public function getUserById($userid){
			 $this->database->db_query="SELECT * FROM users WHERE id='".$userid."'";
				return $this->database->fetchQuery();
        }
        
        final public function getStatusDescription($id=null){
			 $this->database->db_query="SELECT * FROM daily_status WHERE id='".$id."'";
				return $this->database->fetchQuery();
        }
        final public function getIdOfdept_headfromDepartment($dept_id=null){
			
			
			  $this->database->db_query="SELECT id FROM users WHERE dept_head='1' and department=";
			 if(isset($_POST['dept_id']) && $_POST['dept_id']!=''){
				$this->database->db_query.="'".$_POST['dept_id']."'";
			 }
			 else{
					if(isset($dept_id)&&$dept_id!=''){
						 $this->database->db_query.="'".$dept_id."'";
					}
			  }
			  
			 return $this->database->fetchQuery();
                               
        }
		final public function supportadd(){
			    $date = date('Y-m-d H:i:s');
				$newtime = strtotime($date . ' + 12 hours 30 minutes');
				$created_at = date('Y-m-d', $newtime);
				
				$hour= date('H', $newtime);
				$minute= date('i',$newtime);
				$updated_at=date('h:i:s',$newtime);
				$subject=$_POST['subject'];
				$msg=$_POST['support_msg'];
				$dept_id=$_POST['dept_id'];
				
		     //$ids=$this->getIdOfdept_headfromDepartment($_POST['dept_id']);
	         //$idto=$ids[0]->id;
		    $addsupport="insert into soupport(`userto_id`,`userfrom_id`,`subject`,`meassage`,`status`,`read_status`,`createddate`,`massgae_id`)
		    values('".$dept_id."','".$_SESSION['user_id']."','".$_POST['subject']."','".$_POST['support_msg']."','".$_POST['status']."','0','".$created_at."','')";
			
		    $result=$this->database->execQry($addsupport);
			$insert_id=mysql_insert_id( $result);
		    if($result){
				$ids=$this->getIdOfdept_headfromDepartment($_POST['dept_id']);
			    $idto=$ids[0]->id;
				$mailId_head=$this->getUserByEmailById($idto);
			    $mailId_user=$this->getUserByEmailById($_SESSION['user_id']);
				$mailto=$mailId_head[0]->email;
				$mailId_user=$mailId_user[0]->email;
				$headers .= "MIME-Version: 1.0\n" ;
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
				$headers .= "X-Priority: 1 (Higuest)\n";
				$headers .= "X-MSMail-Priority: High\n";
				$headers .= "Importance: High\n";
				$headers .= 'From:'."nvnkumar59@yahoo.in"."\r\n";
				$headers .= 'To:';
				mail($mailId_head,$subject,$msg.$headers);
			    return $result;
		}
				
		}
		final public function support_listingsoutbox($id){
		$this->database->db_query="SELECT * FROM soupport WHERE userfrom_id='".$id."' ";
		return $this->database->fetchQuery();
		 
		}
		final public function support_listingsinbox($id){
		$this->database->db_query="SELECT * FROM soupport WHERE userto_id='".$id."' ";
		return $this->database->fetchQuery();
					
		}
		final public function support_messagebox($id){
		$this->database->db_query="SELECT * FROM soupport WHERE id='".$id."' ";
		return $this->database->fetchQuery();
					
		}
	}
	$StatusReport=new StatusReport();
?>
<?php 
	require_once("configuration.php");
	class StatusReport extends Database{
		public $database;
		public $dailyReport;
		public $userAllStatus;
		public $numOfPages;
		public $perPageRecord;
		public $rowUpdated;
		
		public function __construct(){
			$this->database=new Database();
			$this->adminLogin=false;
			$this->perPageRecord=20;
		}
		
		protected  function checkLogin(){
			$email=$_POST['email'];
			$pass=$_POST['password'];
			$checkLogin="SELECT * FROM users WHERE email='".mysql_real_escape_string($email,$this->database->openDatabase())."' AND password='".md5(mysql_real_escape_string($pass,$this->database->openDatabase()))."' AND status='1'";
			$result=$this->database->execQry($checkLogin);
			
			if($this->database->numRows($result)==1){
				$useRow=$this->database->fecthRow($result);
				
				$_SESSION['user_id']=$useRow['id'];
				$_SESSION['type']=$useRow['type'];
				$_SESSION['full_name']=$useRow['full_name'];
				$_SESSION['dept_id']=$useRow['department'];
				$_SESSION['department']=$this->getDepartmentNameById($useRow['department']);
				if($useRow['type']=='admin' && isset($useRow['type'])){
				$this->adminLogin=true;}
			
				//check for department head.
				if($useRow['dept_head']==1){
					$_SESSION['dept_head']=$useRow['dept_head'];
					$_SESSION['template']='admin/reports.php';
					echo "DeptHead";
					exit();
				}
				$this->getUserAllStatus($useRow['id']);
				if($_SESSION['department']=='HR'){
					$_SESSION['template']='admin/reports.php';
					echo "HR";
					exit();
				}
				if($useRow['type']=='admin'){
					$_SESSION['template']='admin/reports.php';
					echo "admin";
					exit();
				}
				$_SESSION['template']='shared/home.php';
				echo 'success';
				exit();
			}
			else{
				echo "failure";
				exit();
			}
			
		}
		
		final public function getDepartmentNameById($dept_id=null){
				$this->database->db_query="SELECT * FROM department WHERE id='".$dept_id."'"; 
				$detptname= $this->database->fetchQuery();
				return $detptname[0]->dept_name;
		}
		
		final public function getDepartmentList($fetchDepartmentById=null){
				$deptArray=array();
				$check='';
					 if($_SESSION['user_id']==$this->getDefaultDepartmentHeadId()){
							//code to get the id of department which has no head!.
							$check="(SELECT DISTINCT department
								FROM users
								WHERE department NOT
								IN (
								SELECT DISTINCT department
								FROM users
								WHERE dept_head !=0
								))";
							 $this->database->db_query=$check;
							  $deptResultSet=$this->database->fetchQuery();
							  foreach($deptResultSet as $value){
								  if($value!=''){
									$deptArray[]=$value->department;
								  }
							  }
							  $deptArray=implode(',',$deptArray);
					 }
					
				  
				$this->database->db_query=" SELECT * FROM department";
				if(isset($fetchDepartmentById) && $fetchDepartmentById!=''){
					$this->database->db_query.=" WHERE id='".$fetchDepartmentById."'";
				}else{
					$this->database->db_query.=" WHERE 1";
				}
				
				if($check!=''){
					$this->database->db_query.=" or id in($deptArray)"; 
				}
			 	$this->database->db_query.=" order by dept_name"; 
				return  $this->database->fetchQuery();
		}
		
		final public function getDepartmentIdByUserId($userId){
				 $this->database->db_query="SELECT department.id FROM department
											INNER JOIN users
											ON users.department=department.id
											WHERE users.id='".$userId."'"; 
				
				 $deptId= $this->database->fetchQuery();
				return  $deptId[0]->id;
		}	
		
		final public function getDepartmentNameByUserId($userId){
				$this->database->db_query="SELECT department.dept_name FROM department
											INNER JOIN users
											ON users.department=department.id
											WHERE users.id='".$userId."'"; 
				 $detptname= $this->database->fetchQuery();
				 return $detptname[0]->dept_name;
		}	
		
		final public function getUserAllStatus($userId=null,$start_date=null,$end_date=null,$startLimit=null,$endLimit=null,$mode=null,$page=null,$pagination=null){
				 $this->database->db_query="SELECT * FROM daily_status ";
				if($userId!=''){
					 $this->database->db_query.=" WHERE user_id='".$userId."'";
				
					if((isset($start_date) && !empty($start_date))){
						if(!empty($start_date))
						$this->database->db_query.=" AND created_at >= '".$start_date."'";  
						if(!empty($end_date))
						$this->database->db_query.=" AND created_at<='".$end_date."'";
					}
				}else{
					if((isset($start_date) && !empty($start_date))){
						if(!empty($start_date))
						 $this->database->db_query.=" WHERE created_at >= '".$start_date."'";  
						if(!empty($end_date))
						 $this->database->db_query.=" AND created_at<='".$end_date."'";
					}
					
				}
				//adding order by clause.
				$this->database->db_query.=" ORDER BY id desc";
				//Code for pagination.
				if((isset($startLimit) && !empty($startLimit)) && (isset($endLimit) && !empty($endLimit))){
					$this->database->db_query.=" Limit $startLimit,$endLimit";
				}
				if($mode=='ajax'){
					$start = ($page-1)*$this->perPageRecord;
					if($pagination!='no')
				 	$this->database->db_query.=" Limit $start,$this->perPageRecord";
					
				}else{
					 $this->numOfPages=ceil($this->database->numRows($this->database->execQry($this->database->db_query))/$this->perPageRecord);
				 	 if($pagination!='no')
				 	 $this->database->db_query.=" Limit 0,$this->perPageRecord";
				}
				
				$this->userAllStatus=$this->database->fetchQuery();
				if($mode!='ajax'){
					 
					  return  $this->userAllStatus;
				}else{
					$this->getAjaxHTML();
				}
			 
		}
		
		
		protected function saveStatusReport(){

				$date = date('Y-m-d H:i:s');
				$newtime = strtotime($date . ' + 12 hours 30 minutes');
				$created_at = date('Y-m-d', $newtime);
				
				
				
				$hour= date('H', $newtime);
				$minute= date('i',$newtime);
				$updated_at=date('Y-m-d h:i:s',$newtime);
				
				if($hour<=7){
						 $onedayback=strtotime($created_at . '-1 day');
						 $created_at = date('Y-m-d',$onedayback);
						 $updated_at="03:22:22";
				}
				
			 	$saveStatus="INSERT INTO daily_status(user_id,
														  project_name,
														  project_type,
														  project_description,
														  odesk_id,
														  client_name,
														  company_name,
														  hour_billed,
														  working_hour,
														  free_hour,
														  estimated_hour,
														  created_at,
														  time_at)VALUES(
														  '".$_SESSION['user_id']."',
														  '".strtolower(mysql_real_escape_string($_POST['project_name'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['project_type'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['project_description'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['odesk_id'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['client_name'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['company_name'],$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string((float)($_POST['billing_hour'].'.'.$_POST['billing_minute']),$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($this->checkProjectType('fixed'),$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($this->checkProjectType('other'),$this->database->openDatabase()))."',
														  '".strtolower(mysql_real_escape_string($_POST['estimated_hour'],$this->database->openDatabase()))."',
														  '".$created_at."',
														  '".$updated_at."'
														  )";
				return $this->database->execQry($saveStatus) or die('error'.mysql_error()) ;		  
		}
		
		final public function checkProjectType($type=null){
			
			if($_POST['project_type']==$type){
				return $_POST['working_hour'];
			}else{
				return 0.00;
			}
		}
		
	    final public function getPdfData1($dept=null,$viewByDate=null){
			
			if($dept!='' && $dept!='all'){
				 $this->database->db_query="SELECT * FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id
				 WHERE department.id='".$dept."'";
				 
				 
			}if($dept=='all'){
				 $this->database->db_query="SELECT * FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id where 1";
			}
			
			if(isset($viewByDate) && !empty($viewByDate)){
			     $this->database->db_query.="  AND daily_status.created_at='".$viewByDate."'";
			}else{
			 	 $this->database->db_query.=" AND daily_status.created_at=CURDATE() ";
			}
		 	$this->database->db_query.=" order by department.id,daily_status.user_id";
			$this->dailyReport=$this->database->fetchQuery();
		}
		
		final public function getPdfData($dept=null,$viewByDate=null,$end_date=null,$odesk=null){
			
			if($dept!='' && $dept!='all'){
				 $this->database->db_query="SELECT daily_status.id,daily_status.project_type,daily_status.user_id,daily_status.project_name,daily_status.project_description,daily_status.odesk_id,daily_status.client_name,
				 daily_status.company_name,daily_status.free_hour,daily_status.free_hour,daily_status.hour_billed,daily_status.estimated_hour,daily_status.working_hour,daily_status.created_at 		 FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id
				 WHERE department.id='".$dept."'";
			}if($dept=='all'){
				 $this->database->db_query="SELECT daily_status.id,daily_status.user_id,daily_status.project_type,daily_status.project_name,daily_status.project_description,daily_status.odesk_id,daily_status.client_name,
				 daily_status.company_name,daily_status.free_hour,daily_status.free_hour,daily_status.hour_billed,daily_status.estimated_hour,daily_status.working_hour,daily_status.created_at FROM daily_status inner join users 
				 on users.id=daily_status.user_id
				 inner join department
				 on users.department=department.id where 1";
			}
			if($odesk!=''){
				$this->database->db_query.="  AND daily_status.created_at>='".$viewByDate."' AND daily_status.created_at<='".$end_date."'
				 AND daily_status.project_type='odesk'";
			}else{
				if(isset($viewByDate) && !empty($viewByDate)){
				     $this->database->db_query.="  AND daily_status.created_at='".$viewByDate."'";
				}else{
				 	 $this->database->db_query.=" AND daily_status.created_at=CURDATE() ";
				}
			}
		  	$this->database->db_query.=" order by department.id,daily_status.user_id";
			$this->dailyReport=$this->database->fetchQuery();
		}
		
		//function to fetch user list order by department.
		final public function getUserList($orderBy=null,$deptId=null){

			 //code to check if department head is the defalut department head also.
			 $check='';
			 if($_SESSION['user_id']==$this->getDefaultDepartmentHeadId()){
				 	//code to get the id of department which has no head!.
				 	$check=" || department in(SELECT DISTINCT department
						FROM users
						WHERE department NOT
						IN (
						SELECT DISTINCT department
						FROM users
						WHERE dept_head !=0
						))";
			 }
			 
			 $this->database->db_query="SELECT * FROM users WHERE type!='admin' and status=1";
			 
			 if(isset($deptId) && $deptId!=''){
			 	$this->database->db_query.=" AND department='".$deptId."'";
			 }
			 
			 if($check!=''){
				 $this->database->db_query.=$check;
			 }
			 
			 if(isset($orderBy) && $orderBy!=''){
				   $this->database->db_query.=" ORDER BY ".$orderBy;
			 }
			 else{
					  $this->database->db_query.=" ORDER BY department,id";
			 }
			    $this->database->db_query;
				return $this->database->fetchQuery();
		}
		
		//function to save a new user.
	    protected  function addNewUser(){
                                $date = date('Y-m-d H:i:s');
                                $newtime = strtotime($date . ' + 12 hours 30 minutes');
                                $created_at = date('Y-m-d H:i:s', $newtime);
                                $updated_at = date('H:i:s', $newtime);
                                $saveUser="INSERT INTO users(
                                                                                          full_name,
                                                                                          department,
                                                                                          dept_head,
                                                                                          email,
                                                                                          password,
                                                                                          type,
                                                                                          created_at,
                                                                                          updated_at)VALUES(
                                                                                          '".strtolower(mysql_real_escape_string($_POST['full_name'],$this->database->openDatabase()))."',
                                                                                          '".strtolower(mysql_real_escape_string($_POST['department'],$this->database->openDatabase()))."',
                                                                                           '".(mysql_real_escape_string($_POST['dept_head'],$this->database->openDatabase()))."',
                                                                                          '".strtolower(mysql_real_escape_string($_POST['email'],$this->database->openDatabase()))."',
                                                                                          '".md5(mysql_real_escape_string($_POST['password'],$this->database->openDatabase()))."',
                                                                                          '".(mysql_real_escape_string($_POST['type'],$this->database->openDatabase()))."',
                                                                                          '".$created_at."',
                                                                                          '".$updated_at."'
                                                                                          )";
                        return $this->database->execQry($saveUser);
        }
		
		final public function getUserNameById($userId){
			$this->database->db_query="SELECT full_name FROM users WHERE id='".$userId."'";
				return $this->database->fetchQuery();
		}
		
		final public function getAjaxHTML(){
			echo"<thead>
								<tr>
									<th>Department</th>
									<th>Project Name</th>
									<th>Project Type</th>
									<th>Project Description</th>
									<th>Odesk Id</th>
									<th>Client Name</th>
									<th>Company Name</th>
									<th>Hour Billed</th>
									<th>Working Hour</th>
									<th>Others Hour</th>
									<th>Created At</th>
								</tr>
				</thead><tbody>";
			foreach($this->userAllStatus as $val){
					echo"<tr>";
					echo"<td align='center'>".$this->getDepartmentNameByUserId($_SESSION['user_id'])."</td>";
					echo"<td align='center'>".$val->project_name."</td>";
					echo"<td align='center'>".$val->project_type."</td>";
					echo"<td align='center' onmouseover='this.style.cursor=\"pointer\"' title='".strip_tags($val->project_description)."'>".substr($val->project_description,0,10)." ...</td>";
					echo"<td align='center'>".$val->odesk_id."</td>";
					echo"<td align='center'>".$val->client_name."</td>";
					echo"<td align='center'>".$val->company_name."</td>";
					echo"<td align='center'>".$val->hour_billed."</td>";
					echo"<td align='center'>".$val->working_hour."</td>";
					echo"<td align='center'>".$val->free_hour."</td>";
					echo"<td align='center'>".$val->created_at."</td>";
					echo"</tr>";
			 }
			 echo"</tbody>";
			exit();
		}
		
		protected  function changePassword(){
		
			if((isset($_POST['new_password']) && $_POST['new_password']!='' && $_POST['confirm_password']!='') && ($_POST['current_password']!=$_POST['new_password']) && ($_POST['new_password']==$_POST['confirm_password'])){
				$changePassword="Update users set password='".md5(mysql_real_escape_string($_POST['new_password'],$this->database->openDatabase()))."' 
								WHERE id='".$_SESSION['user_id']."'
								AND password='".md5(mysql_real_escape_string($_POST['current_password'],$this->database->openDatabase()))."'
								AND password!='".md5(mysql_real_escape_string($_POST['new_password'],$this->database->openDatabase()))."'";
				$this->database->execQry($changePassword);
				
				$checkUpdate="select * from users where password='".md5(mysql_real_escape_string($_POST['new_password'],$this->database->openDatabase()))."' and id='".$_SESSION['user_id']."'";
				$result=$this->database->execQry($checkUpdate);
				if($this->database->numRows($result)==1){
						return 1;
				}
				return 0;
			}else{
				return 0;
			}
		}
		protected  function viewAttendance(){
			$this->database->db_query="SELECT * FROM attendance WHERE created_at>='".mysql_real_escape_string($_POST['start_date'],$this->database->openDatabase())."'";
			
			if(isset($_POST['end_date']) && $_POST['end_date']!=''){
				$this->database->db_query.=" AND created_at<='".mysql_real_escape_string($_POST['end_date'],$this->database->openDatabase())."'";
			}
			
			if(isset($_POST['viewtype'])&& $_POST['viewtype']!=''&& isset($_POST['viewtype']) && $_POST['viewtype']!='viewall'){
				$this->database->db_query.=" AND (arrival_status='".mysql_real_escape_string($_POST['viewtype'],$this->database->openDatabase())."'";
				if($_POST['viewtype']=='late_coming'){
						$this->database->db_query.=" OR leave_type='shortleave')";
				}else{
					$this->database->db_query.=" )";
				}
			}
			
			if(isset($_POST['viewuser'])&&$_POST['viewuser']!=''){
				$this->database->db_query.=" AND user_id='".mysql_real_escape_string($_POST['viewuser'],$this->database->openDatabase())."'";
			}
			echo"<table class=\"tablesorter\" style=\"width:1000px;\" align='center' cellspacing='15'>
					<thead>
						<tr style=\"background-color:skyblue;\">
							<th align='center'>UserName</th>
							<th align='center'>Arrival Status</th>
							<th align='center'>Late Arrived Time</th>
							<th align='center'>Leave Status</th>
							<th align='center'>Leave Type</th>
							<th align='center'>Date</th>
						</tr>
					</thead>";
			echo"<tbody>";
			foreach($this->database->fetchQuery() as $val){
				if($val->user_id!=''){
					$username=$this->getUserNameById($val->user_id);
					if($val->arrival_status=='late_coming'){
						$val->arrival_status='Late Coming';
					}
					echo"<tr>";
						echo"<td align='center'>".ucfirst($username[0]->full_name)."</td>";
						echo"<td align='center'>".$val->arrival_status ."</td>";
						echo"<td align='center'>".$val->late_arrived_time."</td>";
						echo"<td align='center'>".$val->leave_status."</td>";
						echo"<td align='center'>".$val->leave_type."</td>";
						echo"<td align='center'>".$val->created_at."</td>";
					echo"</tr>";
				}else{
					echo"<tr>";
					echo"<td align='center' colspan='4'><font color='red'>No result found!</font></td>";
					echo"</tr>";
				}
				
			}
			echo"</tbody></table>";
		}
		
		protected  function saveAttendance(){
			$userIds=($_POST['username']);
			unset($_POST['username']);
			
			$date = date('Y-m-d H:i:s');
			$newtime = strtotime($date . ' + 12 hours 30 minutes');
			$created_at = date('Y-m-d', $newtime);
			$updated_at = date('Y-m-d H:i:s', $newtime);
			$leavetype="";
			if(isset($_POST['updateSubmit']) && $_POST['updateSubmit']=='Update'){
				$lineUpdateItem=array();
					foreach($userIds as $key=>$val){
						if(isset($_POST['onleave'.$val]) && $_POST['onleave'.$val]!=''){
							if(isset($_POST['onleaveSelect'.$val]) && $_POST['onleaveSelect'.$val]!=''){
								if($_POST['onleaveSelect'.$val]=='notapproved'){
									$_POST['onleaveSelect'.$val]='not_approved';
									if($_POST['leave_type'.$val]=='shortleave' || $_POST['leave_type'.$val]=='halfday'){
										$_POST['attendance'.$val]='leave';
									}
									else{
										$_POST['attendance'.$val]='absent';
									}
								}else{
									$_POST['attendance'.$val]='leave';
								}
							}
							
							$_POST['textattendance'][$key]=($_POST['leave_type'.$val]=='shortleave')?$_POST['shortleave_late_arrived_time'.$val]:'';
							if(isset($_POST['leave_type'.$val]) && ($_POST['leave_type'.$val]!='')){
								$leavetype=$_POST['leave_type'.$val];
							}else{
								$leavetype='fullday';
							}
						}else{
								$_POST['onleaveSelect'.$val]='';
								$leavetype='';
								if($_POST['attendance'.$val]!='late_coming' && $_POST['leave_type'.$val]!='shortleave'){
									$_POST['textattendance'][$key]='';
								}
						}
						
						$lineUpdateItem[]=array($userIds[$key],$_POST['attendance'.$val],$_POST['textattendance'][$key],$_POST['onleaveSelect'.$val],$leavetype);	
						$leavetype='';
					}
					
					//loop  to update all the record.
					
					foreach($lineUpdateItem as $item){
						$this->rowUpdated++;
						 $updateQuery="Update attendance SET arrival_status='".mysql_real_escape_string($item[1],$this->database->openDatabase())."',
																			 late_arrived_time='".mysql_real_escape_string($item[2],$this->database->openDatabase())."',
																			 leave_status='".mysql_real_escape_string($item[3],$this->database->openDatabase())."',
																			 updated_at='".$updated_at."',
																			 leave_type='".mysql_real_escape_string($item[4],$this->database->openDatabase())."'
																			 WHERE user_id='".mysql_real_escape_string($item[0],$this->database->openDatabase())."'";
						$result=$this->database->execQry($updateQuery);
						unset($updateQuery);
					}
					return 0; 
			}else{
				
				 $saveAttendance="INSERT INTO attendance(user_id,arrival_status,late_arrived_time,leave_status,created_at,updated_at,leave_type)VALUES ";
				foreach($userIds as $key=>$val){
					if(isset($_POST['onleave'.$val]) && $_POST['onleave'.$val]!=''){
						if(isset($_POST['onleaveSelect'.$val]) && $_POST['onleaveSelect'.$val]!=''){
							if($_POST['onleaveSelect'.$val]=='notapproved'){
								$_POST['onleaveSelect'.$val]='not_approved';
								if($_POST['leave_type'.$val]=='shortleave' || $_POST['leave_type'.$val]=='halfday'){
										$_POST['attendance'.$val]='leave';
									}
								else{
								$_POST['attendance'.$val]='absent';}
							}else{
								$_POST['attendance'.$val]='leave';
							}
						}
						$_POST['textattendance'][$key]=($_POST['leave_type'.$val]=='shortleave')?$_POST['shortleave_late_arrived_time'.$val]:'';
						$_POST['leave_type'.$val]=($_POST['leave_type'.$val]=='')?'fullday':$_POST['leave_type'.$val];
					}
					
					
						
					
					$saveAttendance.="('".mysql_real_escape_string($userIds[$key],$this->database->openDatabase())."',
									'".mysql_real_escape_string($_POST['attendance'.$val],$this->database->openDatabase())."',
									'".mysql_real_escape_string($_POST['textattendance'][$key],$this->database->openDatabase())."',
									'".mysql_real_escape_string($_POST['onleaveSelect'.$val],$this->database->openDatabase())."',
									'".$created_at."',
									'".$updated_at."',
									'".mysql_real_escape_string($_POST['leave_type'.$val],$this->database->openDatabase())."'
									),";
				}
				$lastIndex=strrpos($saveAttendance,',');
				$SaveAttendance=substr($saveAttendance,0,$lastIndex);
				return $this->database->execQry($SaveAttendance);
			}
		}
		
		 protected function editAttendance(){
			$this->database->db_query="SELECT * FROM attendance WHERE
			created_at=	'".mysql_real_escape_string($_POST['date'],$this->database->openDatabase())."'";
			$check=0;
		
			echo"<form name='attendance_form'  action=\"process.php?action=saveAttendance\" id=\"attendance_form\" method=\"post\">";
				echo"<table width=\"1000px;\" cellspacing=\"15\" class=\"tablesorter\" id=\"filltodayattendance\"><tbody>";
			foreach($this->database->fetchQuery() as $user){
					$result=$this->getUserNameById($user->user_id);
							 $username=$result[0]->full_name;
					if(!empty($user->user_id)){
						if($check==0){
							$check=1;
						}
						echo"<tr><td><tr><td width='200px'><input type='hidden'  value=\"$user->user_id\"  id='username$user->user_id' name='username[]'/>
							<font color=\"green\">$username</font></td>
							<td width='450px'>";
						if($user->leave_status!='approved' && $user->leave_status!='not_approved'){
							echo"<p id=\"attendancebox$user->user_id\">";
						}else{	
							echo"<p style='display:none;' id=\"attendancebox$user->user_id\">";
						}
						if($user->arrival_status=='present'){
							echo"<input type=\"radio\" value=\"present\" selected class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"present\" id=\"present$user->user_id\" name=\"attendance$user->user_id\" checked/><font color=\"green\">Present</font>&nbsp";
						}else{
							echo"<input type=\"radio\" value=\"present\" selected class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"present\" id=\"present$user->user_id\" name=\"attendance$user->user_id\"";if($user->leave_status!=''){ echo 'checked';} echo "/><font color=\"green\">Present</font>&nbsp";
						}
						
						if($user->arrival_status=='absent'){
							echo"<input type=\"radio\" value=\"absent\" class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"absent\" id=\"absent$user->user_id\" name=\"attendance$user->user_id\" checked/><font color=\"red\">Absent";
						}else{
							echo"<input type=\"radio\" value=\"absent\" class=\"required\" onclick=\"gettime($user->user_id,'hide')\" value=\"absent\" id=\"absent$user->user_id\" name=\"attendance$user->user_id\" /><font color=\"red\">Absent";
						}
						if($user->arrival_status=='late_coming'){
							echo"<input type=\"radio\"  class=\"required\" value=\"late_coming\" onclick=\"gettime($user->user_id,'')\" id=\"late_coming$user->user_id\" name=\"attendance$user->user_id\" checked/><font color=\"brown\">Late Coming";
						}else{
							echo"<input type=\"radio\"  class=\"required\" value=\"late_coming\" onclick=\"gettime($user->user_id,'')\" id=\"late_coming$user->user_id\" name=\"attendance$user->user_id\"/><font color=\"brown\">Late Coming";
						}
						if($user->late_arrived_time!=''){
							echo"<input type=\"text\" style=\"width:50px;\" id=\"textattendance$user->user_id\" value='$user->late_arrived_time'   name=\"textattendance[]\"/>";
						}else{
								echo"<input type=\"text\" style=\"display:none;width:50px;\" id=\"textattendance$user->user_id\"    name=\"textattendance[]\"/>";
						}
						echo"</p> </td><td width=\"150px;\">";
						if($user->leave_status!=''){
								echo"<input type=\"checkbox\" value=\"$user->user_id\" onclick=\"hideShowAttendance(this.value);\" name=\"onleave$user->user_id\" checked /><font color=\"green\">On Leave</font></td>";
						}
						else{
								echo"<input type=\"checkbox\" value=\"$user->user_id\" onclick=\"hideShowAttendance(this.value);\" name=\"onleave$user->user_id\"/><font color=\"green\">On Leave</font></td>";
						}
						if($user->leave_status!=''){
							echo"<td width=\"350px;\"><p id=\"leavebox$user->user_id\">";
						}
						else{
								echo"<td><p id=\"leavebox$user->user_id\" style=\"display:none\">";
							}
						echo"<select name=\"onleaveSelect$user->user_id\"  id=\"onleaveSelect$user->user_id\">";
						echo"<option value=''>Please Select One</option>";
							if($user->leave_status=='approved'){
								echo"<option value=\"approved\" selected>Approved</option>";
							}else{
								echo"<option value=\"approved\">Approved</option>";
							}
							if($user->leave_status=='not_approved'){
								echo"<option value=\"notapproved\" selected>Not Approved</option>";
							}else{
								echo"<option value=\"notapproved\">Not Approved</option>";
							}
						 echo"</select>
						</p>";
						if($user->leave_status!=''){
							echo"<p  style=\"font-size:9px;display:block;\" id=\"type_of_leave_box$user->user_id\">";
						}else{
							echo"<p  style=\"font-size:9px;display:none;\" id=\"type_of_leave_box$user->user_id\">";
						}
						echo"<font color=\"brown\">Short Leave</font>";
						if($user->leave_type=='shortleave'){
							echo "<input type=\"radio\" value=\"shortleave\" onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" name=\"leave_type$user->user_id\" checked/>";
							echo "<input type=\"textbox\"  style=\"width:50px;display:block;\" name=\"shortleave_late_arrived_time$user->user_id\" value=\"$user->late_arrived_time\" id=\"shortleave_late_arrived_time$user->user_id\"/>";
						}
						else{
							echo"<input type=\"radio\" value=\"shortleave\" onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" name=\"leave_type$user->user_id\"/>";
							echo "<input type=\"textbox\"  style=\"width:50px;display:none\" name=\"shortleave_late_arrived_time$user->user_id\" id=\"shortleave_late_arrived_time$user->user_id\"/>";
						}
						if($user->leave_type=='halfday'){
							echo "<font color=\"brown\">Half Day Leave</font><input type=\"radio\"  onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" value=\"halfday\" name=\"leave_type$user->user_id\" checked/>";
						}else{
							echo "<font color=\"brown\">Half Day Leave</font><input type=\"radio\"  onclick=\"showShortLeaveBox('shortleave_late_arrived_time$user->user_id',this.value);\" value=\"halfday\" name=\"leave_type$user->user_id\" />";
						}
						echo"</p>
					  </td>
					</tr>
					<script>
					 $(document).ready(function() {
						$('#textattendance'+$user->user_id).mouseover(function(){
							$('#textattendance'+$user->user_id).timepicker();
						});
						$('#shortleave_late_arrived_time'+$user->id).mouseover(function(){
							$('#shortleave_late_arrived_time'+$user->id).timepicker();
						});
					});
					</script>";
				
				
					}else{
						echo "<td colspan='4' align='center'>No Result Found!</td>";
					}
				}
				if($check==1){
				echo"<tr>
					<td><input type=\"submit\" name='updateSubmit'  value=\"Update\"/></td></tr></tr></td></tbody></table></form><script>$('#attendance_form').validate();</script>";	
				}
			}
		 final public function getDefaultDepartmentHeadId(){
					 $this->database->db_query="SELECT id FROM users WHERE default_dept_head='1'";
							$result= $this->database->fetchQuery();
							return $result[0]->id;
		 } 	
		 protected function leaveform(){
			$data=$_POST;
			$date = date('Y-m-d H:i:s');
			$receipientList='';
			$newtime = strtotime($date . ' + 12 hours 30 minutes');
			$created_at = date('Y-m-d H:i:s', $newtime);
			$dept_head_Id=$this->getIdOfdept_headfromDepartment($_SESSION['dept_id']);
			if($dept_head_Id[0]->id==''){
				 $dept_head_Id[0]->id=$this->getDefaultDepartmentHeadId();
			}
			$dept_head_email=$this->getUserById($dept_head_Id[0]->id);
			$dept_head_email=$dept_head_email[0]->email;
			if(@$_SESSION['dept_head']!=''){
				$receipientList='nvnkumar59@yahoo.in';
				$approved_by_dept_head='approved';
			}else{
				$receipientList=$dept_head_email.',nvnkumar59@yahoo.in';
				$approved_by_dept_head='';
			}
			$senderUserObject=$this->getUserById($_SESSION['user_id']);
		    $senderUserEmail=$senderUserObject[0]->email;
		    $receipientList.=','.$senderUserEmail;
			$short_leave_time='';
			
			if($data['type_of_leave']=='halfday'){
				$data['total_days']='00.50';
				$data['from_date']=$data['halfday_fullday__leave_date'];
				$data['to_date']=$data['halfday_fullday__leave_date'];
			}elseif($data['type_of_leave']=='fullday'){
				$data['total_days']='1.00';
				$data['from_date']=$data['halfday_fullday__leave_date'];
				$data['to_date']=$data['halfday_fullday__leave_date'];
			}elseif($data['type_of_leave']=='shortleave'){
				$short_leave_time=$data['short_leave_time_from'].' To '.$data['short_leave_time_to'];
				$data['from_date']=$data['short_leave_text_box'];
				$data['to_date']=$data['short_leave_text_box'];
			}
			else{
					$data['halfday_fullday__leave_date']='';
			}
			if((($data['emp_name']!='') && ($data['emp_dept1']!='')&&($data['emp_designation']!='')&&($data['emp_cur_Project']!='')&& ($data['total_days']!=''))|| $data['type_of_leave']=='shortleave'){ 
				  $leaveStartdate='';
				  $leave_form="insert into leave_app(user_id,
													name_employe,
													designation,
													curent_project,
													leave_type,
													leave_session,
													leave_from,
													leave_to,
													total_days,
													approved_by_dept_head,
													short_leave_time,
													reason_for_leave,
													approve_status,
													created_at,
													mailsend_to,
													comment)
												values('".$_SESSION['user_id']."',
												'".mysql_real_escape_string($data['emp_name'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['emp_designation'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['emp_cur_Project'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['type_of_leave'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['halfday_fullday__leave__half_select'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['from_date'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['to_date'],$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['total_days'],$this->database->openDatabase())."',
												'".$approved_by_dept_head."',
												'".mysql_real_escape_string($short_leave_time,$this->database->openDatabase())."',
												'".mysql_real_escape_string($data['reason_for_leave'],$this->database->openDatabase())."',
												'2',
												'".$created_at."',
												'".mysql_real_escape_string($receipientList,$this->database->openDatabase())."',
												'')";
				$result=$this->database->execQry($leave_form);
					if($result){  
							 $subject="Leave Application";
							 $message='<table align="center" style=" border:2px solid #000000;" width="785" border="0" cellspacing="0" cellpadding="0">
							  <tr><td>Leave Application!</td></tr>
							  <tr>
									<td>
													<div style="float:left; width:781px;">
													<div style="float:left; width:781px; height:90px;">
															<img src="http://target.naveen.com/images/logo.png" alt="" />
													</div>
													<div style="float:left; width:751px; padding:15px; font-size:13px; height:auto !important; height:320px;font-family: Arial,Helvetica,sans-serif;">
															<p style="float:left; width:751px; margin:0px; color:#000000; padding-top:15px;"><br/>
															<strong></strong><br><br>
															<strong>Name:</strong> '.$data['emp_name'].'<br><br>
															<strong>Department:</strong> '.$data['emp_dept1'].'<br><br>
															<strong>Designation:</strong> '.$data['emp_designation'].'<br><br>
															<strong>Current Project:</strong> '.$data['emp_cur_Project'].'<br><br>
															<strong>Reason For Leave:</strong> '.$data['reason_for_leave'].'<br><br>
															<strong>Leave Apply Date:</strong> '.date('Y-m-d',strtotime($created_at)).'<br><br>';
															
															if($data['type_of_leave']=='halfday' ||$data['type_of_leave']=='fullday'){
																if($data['type_of_leave']=='halfday'){
																	if($data['halfday_fullday__leave__half_select']=='second_half'){
																		$session= 'Second Half';
																	}else{
																		$session= 'First Half';
																	}
																	$message.= '<strong>Session:</strong> '.$session.'<br><br>';
																}
																$message.= '<strong>Leave Date:</strong> '.$data['halfday_fullday__leave_date'].'<br><br>';
															}elseif($data['type_of_leave']=='shortleave'){
																$message.= '<strong>Leave Type:</strong> Short Leave<br><br>';
																$message.= '<strong>Leave Date:</strong> '.$data['short_leave_text_box'].'<br><br>';
																$message.= '<strong>Time Period:</strong> '.$short_leave_time.'<br><br>';
															}
															elseif($data['type_of_leave']=='other'){
																$message.='<strong>Leave From:</strong> '.$data['from_date'].'<br><br>
																					<strong>Leave TO:</strong> '.$data['to_date'].'<br><br>
																					<strong>Number Of Days:</strong> '.$data['total_days'].'<br><br>';
															}				   
									$message.='</div></div></td></tr>
							</table>';
							 $this->UserEmail($receipientList,$subject,$message);
						   }
					   }
			return $result;
		  }
                    
             
		final public function getUserByEmail($mailofuser){
				 $this->database->db_query="SELECT full_name FROM users WHERE email='".$mailofuser."'";
						return $this->database->fetchQuery();
		}
        final public function getUserByEmailById($userid){
				 $this->database->db_query="SELECT email FROM users WHERE id='".$userid."'";
						return $this->database->fetchQuery();
		}       
		final public function UserEmail($mailto,$subject,$message){ 
				$userObject=  $this->getUserNameById($_SESSION['user_id']);
				$userName=    $userObject[0]->full_name;
				$from  =     $userName ;
				$headers='';
				$headers .= "MIME-Version: 1.0\n" ;
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
				$headers .= "X-Priority: 1 (Higuest)\n";
				$headers .= "X-MSMail-Priority: High\n";
				$headers .= "Importance: High\n";
				$headers .= 'From:'."nvnkumar59@yahoo.in"."\r\n";
				//$headers .= 'To:';
				$mailto=explode(',',$mailto);
				foreach($mailto as $val){            
					$emails=$val;
					//$headers.= $val.',';
				}
				$lastIndex=strrpos($headers,',');
				//$headers=substr($headers,0,$lastIndex);
			    //$headers .= "\r\n";
				$count=0;
				foreach($mailto as $email){
					$count++;
					if($count==3){
						//$message='';
					}
					$mail=mail($email,$subject,$message,$headers);
				}
        }  
        
		final public function getLeaveList($fetchUserByDeptID=null){
				  $deptArray=array();
				  $deptArray_String='';
				  $check='';
					 if($_SESSION['user_id']==$this->getDefaultDepartmentHeadId()){
							//code to get the id of department which has no head!.
							$check="(SELECT DISTINCT department
								FROM users
								WHERE department NOT
								IN (
								SELECT DISTINCT department
								FROM users
								WHERE dept_head !=0
								))";
					
					
				  $this->database->db_query=$check;
				  $deptResultSet=$this->database->fetchQuery();
				  foreach($deptResultSet as $value){
					  if($value!=''){
						$deptArray[]=$value->department;
					  }
				  }
				   $deptArray_String=implode(',',$deptArray);
				  }
				  $this->database->db_query="SELECT la.id,
									la.user_id,
									la.name_employe,
									la.designation,
									la.curent_project,
									la.leave_type,
									la.leave_session,
									la.leave_from,
									la.created_at,
									la.	approved_by_dept_head,
									la.leave_to,
									la.total_days,
									la.reason_for_leave,
									la.approve_status
								FROM leave_app la";
				 if(isset($fetchUserByDeptID) && $fetchUserByDeptID!=''){
					
				 	$this->database->db_query.=" INNER JOIN users
						ON users.id=la.user_id
						INNER JOIN department
						ON users.department=department.id
						WHERE department.id='".$fetchUserByDeptID."'
						
						AND la.approve_status>'1'
				 	";
				 	if($check!=''){
						$this->database->db_query.=" OR department.id in($deptArray_String)";
					}
				 }else{$this->database->db_query.=" WHERE la.approve_status>'1'";}
				      $this->database->db_query.=" order by la.id desc";
				 return $this->database->fetchQuery();
		}
		 
		final public function getUserLeavestatus(){
					 $this->database->db_query="SELECT * FROM leave_app WHERE 	approve_status<='1'
												AND user_id='".$_SESSION['user_id']."' 
												order by id desc";
							return $this->database->fetchQuery();
		}
		
		final public function getUserListings($orderBy=null,$fetchUserByDeptID=null){
                        
			 $this->database->db_query="SELECT * FROM users WHERE type!='admin' ";
			 
			 if(isset($fetchUserByDeptID) && $fetchUserByDeptID!=''){
				  $this->database->db_query.=" AND department='".$fetchUserByDeptID."' ";
			 }
			 if(isset($orderBy) && $orderBy!=''){
				  $this->database->db_query.=" ORDER BY ".$orderBy;
			  }
			  else{
				  $this->database->db_query.=" ORDER BY department,id";
			  }
					return $this->database->fetchQuery();
        }
        
        
        final public function getUserById($userid){
			 $this->database->db_query="SELECT * FROM users WHERE id='".$userid."'";
				return $this->database->fetchQuery();
        }
        
        final public function getStatusDescription($id=null){
			 $this->database->db_query="SELECT * FROM daily_status WHERE id='".$id."'";
				return $this->database->fetchQuery();
        }
        final public function getIdOfdept_headfromDepartment($dept_id=null){
			
			
			  $this->database->db_query="SELECT id FROM users WHERE dept_head='1' and department=";
			 if(isset($_POST['dept_id']) && $_POST['dept_id']!=''){
				$this->database->db_query.="'".$_POST['dept_id']."'";
			 }
			 else{
					if(isset($dept_id)&&$dept_id!=''){
						 $this->database->db_query.="'".$dept_id."'";
					}
			  }
			  
			 return $this->database->fetchQuery();
                               
        }
		final public function supportadd(){
			    $date = date('Y-m-d H:i:s');
				$newtime = strtotime($date . ' + 12 hours 30 minutes');
				$created_at = date('Y-m-d', $newtime);
				
				$hour= date('H', $newtime);
				$minute= date('i',$newtime);
				$updated_at=date('h:i:s',$newtime);
				$subject=$_POST['subject'];
				$msg=$_POST['support_msg'];
				$dept_id=$_POST['dept_id'];
				
		     //$ids=$this->getIdOfdept_headfromDepartment($_POST['dept_id']);
	         //$idto=$ids[0]->id;
		    $addsupport="insert into soupport(`userto_id`,`userfrom_id`,`subject`,`meassage`,`status`,`read_status`,`createddate`,`massgae_id`)
		    values('".$dept_id."','".$_SESSION['user_id']."','".$_POST['subject']."','".$_POST['support_msg']."','".$_POST['status']."','0','".$created_at."','')";
			
		    $result=$this->database->execQry($addsupport);
			$insert_id=mysql_insert_id( $result);
		    if($result){
				$ids=$this->getIdOfdept_headfromDepartment($_POST['dept_id']);
			    $idto=$ids[0]->id;
				$mailId_head=$this->getUserByEmailById($idto);
			    $mailId_user=$this->getUserByEmailById($_SESSION['user_id']);
				$mailto=$mailId_head[0]->email;
				$mailId_user=$mailId_user[0]->email;
				$headers .= "MIME-Version: 1.0\n" ;
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
				$headers .= "X-Priority: 1 (Higuest)\n";
				$headers .= "X-MSMail-Priority: High\n";
				$headers .= "Importance: High\n";
				$headers .= 'From:'."nvnkumar59@yahoo.in"."\r\n";
				$headers .= 'To:';
				mail($mailId_head,$subject,$msg.$headers);
			    return $result;
		}
				
		}
		final public function support_listingsoutbox($id){
		$this->database->db_query="SELECT * FROM soupport WHERE userfrom_id='".$id."' ";
		return $this->database->fetchQuery();
		 
		}
		final public function support_listingsinbox($id){
		$this->database->db_query="SELECT * FROM soupport WHERE userto_id='".$id."' ";
		return $this->database->fetchQuery();
					
		}
		final public function support_messagebox($id){
		$this->database->db_query="SELECT * FROM soupport WHERE id='".$id."' ";
		return $this->database->fetchQuery();
					
		}
	}
	$StatusReport=new StatusReport();
?>
