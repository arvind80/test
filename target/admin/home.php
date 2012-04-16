
	<div id="tabs-admin" style="width:600px;">
			<?php 	if($_SESSION['department']!='HR'){ ?>
				<a href="?action_view=fill_today_status">Fill Today Status</a>
				<a href="?action_view=view_your_status">View Your Status</a>
			<?php } ?>
				<a href="?action_view=leave_form">Leave Application</a>
				<a href="?action_view=change_password">Change Password</a>
			<?php 
				$StatusReport->getUserAllStatus($_SESSION['user_id']);
				 if(isset($_GET['action_view']) && ($_GET['action_view']!='') &&($_GET['action_view']!='add_new_project') &&($_GET['action_view']!='fillup_attendance')&&($_GET['action_view']!='outbox')&&($_GET['action_view']!='support')&&($_GET['action_view']!='inbox')){
							if($_SESSION['department']=='HR'){
										if($_GET['action_view']!='fill_today_status' && $_GET['action_view']!='view_your_status'){
												include("admin/".$_GET['action_view'].".php");
											}
								}else{
							include("admin/".$_GET['action_view'].".php");}
				 }else{
					 if(isset($_GET['action_view']) && $_GET['action_view']!='fillup_attendance')
					 include("admin/view_your_status.php");
				}
			?>
	</div>

