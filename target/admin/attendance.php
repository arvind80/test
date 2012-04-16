<div id="tabs-4" style="min-height:350px;">
		<a href="?action_view=fillup_attendance#tabs-4">Attendance!</a>
		<?php 
			//$StatusReport->getUserAllStatus($_SESSION['user_id']);
			 if(isset($_GET['action_view']) && ($_GET['action_view']!='') &&($_GET['action_view']=='fillup_attendance')){
						include("admin/".$_GET['action_view'].".php");
			 }
		?>
</div>
