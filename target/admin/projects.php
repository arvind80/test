<div id="tabs-7" style="width:700px;">
	<div style="width:auto;">
			<div style="float:left">			
				<a href="?action_view=add_new_project#tabs-7"> New Project</a>
				<a href="?action_view=view_projects#tabs-7">View Projects</a>
			</div>
			<div style="float:right">
				<form name="search_project" method="post" action="process.php?action=searchProject" id="search_project">
					<input type="text" name="search_project" id="search_project"/>
					<input type="submit"/>
				</form>
			</div>
	</div>
		<?php 
			
			 if(isset($_GET['action_view']) && ($_GET['action_view']!='fill_today_status') && ($_GET['action_view']!='view_your_status') && ($_GET['action_view']!='leave_form') && ($_GET['action_view']!='change_password')&&($_GET['action_view']!='fillup_attendance')&&($_GET['action_view']!='outbox')&&($_GET['action_view']!='support')&&($_GET['action_view']!='inbox')){
					
						include("admin/".$_GET['action_view'].".php");
			 }
		?>
</div>
