<?php
if($_SESSION['type']=='admin' ||$_SESSION['department']=='HR' ||$_SESSION['dept_head']==1){
	if(isset($_SESSION['dept_head']) && $_SESSION['dept_head']==1){
			$fetchUserByDeptID=$_SESSION['dept_id'];
			$fetchDepartmentById=$_SESSION['dept_id'];
	}else{$fetchUserByDeptID='';$fetchDepartmentById='';}
	$emails=$StatusReport->getUserList('',$fetchUserByDeptID);
	$Leaveform2=$StatusReport->getLeaveList($fetchUserByDeptID);
	$outbox= $StatusReport->support_listingsoutbox($_SESSION['user_id']);
    $inbox=  $StatusReport->support_listingsinbox($_SESSION['dept_id']);
	include("admin/leave_popup.php");?>
	<div>
	<div class="cont_header">
	<div class="header">
		<span style="width:300px;float:right;padding-top:50px;color:#03E6FC;font-size:18px;"><h1>Target</h1></span>
	 <img src="images/logo.jpg" style="height:100px;"/> </div>
	 	<hr style="color:#1484E6;width:100%;"/>
	 </div>
	<div class="demo" style="width:100%; margin:0 auto;">
	<div id="tabs" style="width:1000px;border:0px;">
		<ul>
				<li><a href="#tabs-admin">Home</a></li>
				<?php if($_SESSION['department']!='HR'){?>
				
				<li><a href="#tabs-1">View Reports</a></li>
				<li><a href="#tabs-2">Search Task</a></li>
				<li><a href="#tabs-3">Add User</a></li>
				<li><a href="#tabs-7">Sales</a></li>
				<li><a href="#tabs-6">View User</a></li>
				<?php }
				if($_SESSION['type']=='admin' ||$_SESSION['department']=='HR'){?>
				<li><a href="#tabs-4">Attendance</a></li>
				<?php }?>
				<li><a href="#tabs-5">Leave Applications</a></li>
				
				<li><a href="#tabs-8">Reach Out</a></li>
				<li><a href='process.php?action=logout'>Logout</a></li>
		</ul>
		<span style="float:right;font-color:#EEEEEE;"><?php echo "Welcome ".ucwords($_SESSION['full_name']); ?></span>
		<?php
			   include("admin/home.php");
			 	
			  if($_SESSION['type']=='admin' || $_SESSION['department']=='HR' ||isset($_SESSION['dept_head']) && $_SESSION['dept_head']==1){
					//include("admin/layout.php");
			  }
			  if($_SESSION['department']!='HR'){
		 	  	include("admin/view_reports.php");
		 	  	include("admin/projects.php");
		      }
 			  if($_SESSION['type']=='admin' || $_SESSION['department']=='HR'){
			    include("admin/attendance.php");
		      }
		      include("admin/leave_app.php");
			  if($_SESSION['department']!='HR'){
		 	  	include("admin/add_new_user.php");
		 	  	include("edit_view_user.php");
		      }
			 if($_SESSION['department']!='HR'){
		 	  	include("admin/search_task.php");
		 	  	
		      }
		      include("admin/suport.php"); 
		?>
	</div>
	</div>
	<?php
}else{
	header("Location:index.php");
}
 ?>
