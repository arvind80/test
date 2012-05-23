<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');

?>
    <h1>Make a Contribution</h1>
<?php if($_GET['act'] == 'pay'){
	$session = JFactory::getSession();
	$s_last_id = $session->get('last_id');
	$db =& JFactory::getDBO();
	$query = "SELECT * FROM #__helloworld WHERE `id`='".$s_last_id."'";
	$db->setQuery((string)$query);
	$row = $db->loadRow();
?>
<p style="text-indent:0px;">
<label>Contribution Amount: </label>
<?php echo $row['1']; ?><br><br>

<label>Email Address: </label>
<?php echo $row['2']; ?><br><br>

<label>First Name: </label>
<?php echo $row['3']; ?><br><br>

<label>Last Name: </label>
<?php echo $row['4']; ?><br><br>

<label>Employer: </label>
<?php echo $row['5']; ?><br><br>

<label>Occupation: </label>
<?php echo $row['6']; ?><br><br>

<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="joseph_1321859748_biz@kindlebit.com">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="item_name" value="Make a Contribution">
	<input type="hidden" name="amount" value="<?php echo $row['1']; ?>">
	<input type="hidden" name="return" value="http://vickiebarnett.kindlebit.biz/index.php?option=com_helloworld&view=updhelloworld&Itemid=444&act=success">
	<input type="hidden" name="cancel_return" value="http://vickiebarnett.kindlebit.biz/index.php?option=com_helloworld&view=updhelloworld&Itemid=444&act=cancel">
	<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
</form>
</p>

<?php }elseif($_GET['act'] == 'success'){ 

## Grab session ##
$session = JFactory::getSession();
$s_last_id = $session->get('last_id');
$db =& JFactory::getDBO();
$query = "UPDATE #__helloworld SET `paid_status` = '1' WHERE `id`='".$s_last_id."'";
$db->setQuery((string)$query);
$result = $db->query();
$session->clear('last_id');
?>
<div class="success"><p>Thank you for your contibution</p></div>
<?php

}elseif($_GET['act'] == 'cancel'){ 

$session = JFactory::getSession();
$s_last_id = $session->get('last_id');
$session->clear('last_id');
?>
<div style="margin-bottom:20px;"><p>Your contibution has been cancelled</p></div>
<?php

}else{ ?>
<form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="updhelloworld" name="updhelloworld">
	<p style="text-indent:0px;">
		<label>Contribution Amount: </label>
		<input type="text" name="amount" id="amount" value="<?php if(isset($_GET['amount'])){echo $_GET['amount'];}else{echo $_POST['amount'];} ?>"/><br /><br />

		<label>Email Address: </label>
		<input type="text" name="email" id="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}else{echo $_POST['email'];} ?>"/> <br /><br />

		<label>First Name: </label>
		<input type="text" name="first_name" id="first_name" value="<?php if(isset($_GET['first_name'])){echo $_GET['first_name'];}else{echo $_POST['first_name'];} ?>"/><br /><br />

		<label>Last Name: </label>
		<input type="text" name="last_name" id="last_name" value="<?php if(isset($_GET['last_name'])){echo $_GET['last_name'];}else{echo $_POST['last_name'];} ?>"/><br /><br />

		<label>Employer: </label>
		<input type="text" name="employer" id="employer" value="<?php if(isset($_GET['employer'])){echo $_GET['employer'];}else{echo $_POST['employer'];} ?>"/><br /><br />

		<label>Occupation: </label>
		<input type="text" name="occupation" id="occupation" value="<?php if(isset($_GET['occupation'])){echo $_GET['occupation'];}else{echo $_POST['occupation'];} ?>"/><br /><br />
	</p>
	<button type="submit" id="contribution_button" class="btn_bg" style="margin-bottom:20px;"><?php echo JText::_('Submit'); ?></button>
	<?php echo JHtml::_('form.token'); ?>
</form>

<?php } ?>
    <div class="clr"></div>
