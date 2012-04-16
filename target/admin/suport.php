
<div id="tabs-8" style="min-height:400px;">
<a href="?action_view=support#tabs-8">Compose</a>
<a href="?action_view=inbox#tabs-8">Inbox</a>
<a href="?action_view=outbox#tabs-8">Outbox</a>
<?php
	if(@$_GET['action_view']=='support'){
	
		require_once('shared/support_form.php');
	}
?>
<?php
	if(@$_GET['action_view']=='inbox'){
	
		include('shared/inbox.php');
	}
?>

<?php
	if(@$_GET['action_view']=='outbox'){
	
		include('shared/outbox.php');
	}
?>


</div>



