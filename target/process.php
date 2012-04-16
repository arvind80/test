<?php ob_start();session_start();
	require_once('classes/statusreport.php');
	require_once('classes/projects.php');
	class process extends StatusReport{
		public function execute(){
			if(isset($_GET['action']) && $_GET['action']!=''){$action=$_GET['action'];}
			if(isset($_POST['action']) && $_POST['action']!=''){$action=$_POST['action'];}
			if($action!=''){
			$Project=new Projects();	
			$StatusReport=new StatusReport();
			switch($action){
				case 'checklogin':
					$result=$this->checkLogin();
				break;
				case 'saveStatusReport':
					$result=$this->saveStatusReport();
					if($result){
						if($_SESSION['template']=='admin/reports.php'){
							header("Location:index.php?success=true&action_view=view_your_status");
							}else
						header("Location:index.php?success=true#tabs-2");
					}else{
							header("Location:index.php?failure=true");
						}
				break;
				case 'editAttendance':
					$result=$this->editAttendance();
				break;
				case 'searchProject':
					$_SESSION['search_result']='';
					unset($_SESSION['search_result']);
					$_SESSION['search_result']=$Project->searchProject();
					if($_SESSION['search_result']!=''){
						header("Location:index.php?search=true&action_view=view_projects#tabs-7");
					}else{
						header("Location:index.php?search=false&action_view=view_projects#tabs-7");
					}
				break;
				case 'getUserAllStatus':
					if(!isset($_POST['user_list'])){
						$_POST['user_list']=$_SESSION['user_id'];
					}
					if(isset($_GET['pagination']) && ($_GET['pagination']!='')){
						$pagination=$_GET['pagination'];
					}else{
						$pagination=null;
					}
					$StatusReport->getUserAllStatus($_POST['user_list'],$_POST['start_date'],$_POST['end_date'],'','',$_POST['mode'],$_POST['page'],$pagination);
					$_SESSION['result']='';
					unset($_SESSION['result']);
					$_SESSION['result']=$StatusReport->userAllStatus;
					
					header("Location:index.php?passId=".$_POST['user_list']."&start_date=".$_POST['start_date']."&end_date=".$_POST['end_date']."#tabs-2");
				break;
				
				case 'logout':
					if(isset($_SESSION['user_id'])&&$_SESSION['user_id']!=''){
						 unset($_SESSION['user_id']);
						 unset($_SESSION['type']);
						 session_destroy();
						 //header("Location:index.php");
						 echo"<script>window.location.reload();</script>";
					}
				break;
				case 'addNewUser':
					$result=$this->addNewUser();
					if($result){
						header("Location:index.php?success=true&uADD=true#tabs-3");
					}else{
						header("Location:index.php?failure=true&uADD=false#tabs-3");
					}
				break;
				case 'saveProject':
				
					$result=$Project->saveProject();
					if($result){
						header("Location:index.php?action_view=view_projects&success=true#tabs-7");
					}else{
						header("Location:index.php?failure=true&action_view=add_new_project&failure=true#tabs-7");
					}
				break;
				case 'changePassword':
					$result=$this->changePassword();
					if($result){
						if($_SESSION['template']=='admin/reports.php'){
							header("Location:index.php?success=true&msg=true&action_view=change_password");
							}else
						header("Location:index.php?success=true&msg=true#tabs-3");
					}else{
						header("Location:index.php?failure=true&msg=false#tabs-3");
					}
				break;
				case 'viewAttendance':
					$result=$this->viewAttendance();
				break;
				case 'saveAttendance':
					$result=$this->saveAttendance();
					$update=$this->rowUpdated;
					if($update>0){
						header("Location:index.php?action_view=fillup_attendance&success=true&updated=".$update."#tabs-4");
						die;
					}
					if($result!=0){
						header("Location:index.php?action_view=fillup_attendance&success=true&present=true#tabs-4");
					}else{
						header("Location:index.php?action_view=fillup_attendance&failure=true&present=false#tabs-4");
					}
				break;
				case 'leaveform':
				$result=$this->leaveform();
				if($result){
						if($_SESSION['template']=='admin/reports.php'){
							header("Location:index.php?success=true&mail=true&leave=true&action_view=leave_form");
							}else
						header("Location:index.php?success=true&mail=true&leave=true#tabs-4");
					}else{
						header("Location:index.php?failure=true&mail=false#tabs-4");
					}
				break;
				case 'supportadd':
				$result=$this->supportadd();
				if($result){
						header("Location:index.php?success=true&mail=true#tabs-5");
					}else{
						header("Location:index.php?failure=true&mail=false#tabs-5");
					}
				break;
				
				}
			}
		}
	}
	$process=new process();
	$process->execute();
?>
