<div id="tabs-5" style="min-height:400px;">
<a href="?action_view=support#tabs-5">Compose</a>
<a href="?action_view=inbox#tabs-5">Inbox</a>
<a href="?action_view=outbox#tabs-5">Outbox</a>
<?php
	if($_GET['action_view']=='support'){
	
		require_once('shared/support_form.php');
	}
?>
<?php
	if($_GET['action_view']=='inbox'){
	
		require_once('shared/inbox.php');
	}
?>

<?php
	if($_GET['action_view']=='outbox'){
	
		require_once('shared/outbox.php');
	}
?>


</div>

