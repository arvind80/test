<?php 
if($_SESSION['user_id']!=''){
   $StatusReport->getUserAllStatus($_SESSION['user_id']);
   $emails=$StatusReport->getUserList("full_name");
   $outbox= $StatusReport->support_listingsoutbox($_SESSION['user_id']);
   $inbox=  $StatusReport->support_listingsinbox($_SESSION['user_id']);
?>
<style type="text/css">
	.ui-button .ui-button-text{
		width:113px;
	}
	table.tablesorter tbody td {
	background-color: #c3c5c6;
    color: #3D3D3D;
    padding: 4px;
    vertical-align: top;
		}
</style>	

<div>
	<div>
	<div class="cont_header">
	<div class="header">
		<span style="width:300px;float:right;padding-top:50px;color:#03E6FC;font-size:18px;"><h1>Target</h1></span>
		<img src="images/logo.jpg" style="height:100px;"/> 
		
	</div>
	<hr style="color:#1484E6;wdth:100%;">
	</div>
<div class="demo" style="width:100%;min-height:600px; margin:0 auto;">
	
<div id="tabs" style="width:1000px;border:none;">
	
	
	<ul>
		<li><a href="#tabs-1">Fill Today Status</a></li>
		<li><a href="#tabs-2">View Your Status</a></li>
		<li><a href="#tabs-3">Change Password</a></li>
		<li><a href="#tabs-4">Leave Application</a></li>
		<li><a href="#tabs-5">Reach Out</a></li>
		<li> <a href='process.php?action=logout'>Logout</a></li>
	</ul>
	<span style="float:right;font-color:#EEEEEE;"><?php echo "Welcome ".ucwords($_SESSION['full_name']); ?></span>
	<?php 
		include("change_password.php");
		include("leave_form.php");
		include("fill_today_status.php");
		include("view_your_status.php");
		include("support.php");
	?>
</div>
</div>
</div><!-- End demo -->
<?php
}else{
	header("Location:index.php");
}
?>
