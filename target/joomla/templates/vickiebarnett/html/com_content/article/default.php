<?php
/**
 * @version		$Id: default.php 22359 2011-11-07 16:31:03Z github_bot $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
?>
<div class="item-page<?php echo $this->pageclass_sfx?>">

<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h1>
	<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
		<a href="<?php echo $this->item->readmore_link; ?>">
		<?php echo $this->escape($this->item->title); ?></a>
	<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
	<?php endif; ?>
	</h1>
<?php endif; ?>

<?php if($this->item->title == 'Volunteer'){ ?>

<?php
	if (isset($_POST['submit'])){
		$data = $_POST;
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$suffix = $data['suffix'];
		$address1 = $data['address1'];
		$address2 = $data['address2'];
		$city = $data['city'];
		$state = $data['state'];
		$zip = $data['zip'];
		$home_phone = $data['home_phone'];
		$work_phone = $data['work_phone'];
		$ext = $data['ext'];
		$cell_phone = $data['cell_phone'];
		$email = $data['email'];
		$email_updates = $data['email_updates'];
		$text_messages = $data['text_messages'];
		$early_voting = $data['early_voting'];
		$endorsements = $data['endorsements'];
		$yard = $data['yard'];
		$phone_calls = $data['phone_calls'];
		$bumper_sticker = $data['bumper_sticker'];
		$neighborhood_coffee = $data['neighborhood_coffee'];
		$large_sign = $data['large_sign'];
		$come_and_speak = $data['come_and_speak'];
		$campaign_office = $data['campaign_office'];
		$knock_on_doors = $data['knock_on_doors'];
		$comments = $data['comments'];
		$error = '';
		if($first_name == '' && empty($first_name)){
			$error .= '<li>Please enter your first name</li>';
		}
		if($last_name == '' && empty($last_name)){
			$error .= '<li>Please enter your last name</li>';
		}
		if($address1 == '' && empty($address1)){
			$error .= '<li>Please enter your address</li>';
		}
		if($city == '' && empty($city)){
			$error .= '<li>Please enter your city</li>';
		}
		if($state == '' && empty($state)){
			$error .= '<li>Please select your state</li>';
		}
		if($zip == '' && empty($zip)){
			$error .= '<li>Please enter your zip</li>';
		}
		if($home_phone == '' && empty($home_phone)){
			$error .= '<li>Please enter your home phone</li>';
		}
		if($cell_phone == '' && empty($cell_phone)){
			$error .= '<li>Please enter your cell phone</li>';
		}
		if(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)){
			$error .= '<li>Please enter a valid email</li>';
		}
		if($error == ''){
			// set the data into a query to update the record
			$to = $email;
			$subject = "Volunteer Confirmation";

			$message = "Dear $first_name,<br /><br />Thank you for volunteering your time, talents and energy. 
			Your efforts are greatly appreciated. Together, we can make, a difference!<br /><br />
			Someone will be in touch with you soon to follow up about future volunteer opportunities. Thanks again!<br /><br />
			Best Regards,<br /><br /><br />
			Vickie Barnett<br /><br />
			Comment: $comments<hr /><br />";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

			// More headers
			$headers .= 'From: <info@vickiebarnett.com>' . "\r\n";

			mail($to,$subject,$message,$headers);
			header("location:".$_SERVER['REQUEST_URI']."&act=success");
		}
	}
	if($error != ''){
		echo "<p>".$error."</p>";
	}
	?>
	<?php 
	if($_GET['act'] == 'success'){
		echo "<p>Thank you for volunteering your time, talents and energy. Your efforts are greatly appreciated. Together, we can make a difference!</p>";
	}else{
	?>
	<p>You can make a real difference in this race by signing up to get involved. Whether you can help us by knocking on doors, making phone calls or simply by putting a sign in your yard, your support and dedication will make the difference on Election Day. Fill out the information below and someone from the campaign office will get in touch with you to let you know of volunteer opportunities!</p>
	
	<p><b>Personal Information</b></p>

	<form name="support_form" id="support_form" action="" method="post" />
		<p><label>Prefix</label>
		<select class="textfield" id="prefix" name="prefix">
			<option value=""></option>
			<option value="Dr.">Dr.</option>
			<option value="Hon.">Hon.</option>
			<option value="Mr.">Mr.</option>
			<option value="Mrs.">Mrs.</option>
			<option value="Ms.">Ms.</option>
		</select></br></br>
		
		<label>First Name *</label>
			<input type="text" name="first_name" id="first_name" value="<?php echo $_POST['first_name']; ?>" /></br></br>

		<label>Last Name *</label>
			<input type="text" name="last_name" id="last_name" value="<?php echo $_POST['last_name']; ?>" /></br></br>

		<label>Suffix</label>
			<input type="text" name="suffix" id="suffix" value="<?php echo $_POST['suffix']; ?>" /></br></br>

		<label>Address *</label>
			<input type="text" name="address1" id="address1" value="<?php echo $_POST['address1']; ?>" /></br></br>
			
		<label>&nbsp;</label>
			<input type="text" name="address2" id="address2" value="<?php echo $_POST['address2']; ?>" /></br></br>

		<label>City *</label>
			<input type="text" name="city" id="city" value="<?php echo $_POST['city']; ?>" /></br></br>

		<label>State *</label>
			<select id="state" name="state">
				<option value=""></option>
				<option value="AA">AA</option>
				<option value="AB">AB</option>
				<option value="AE">AE</option>
				<option value="AK">AK</option>
				<option value="AL">AL</option>
				<option value="AP">AP</option>
				<option value="AR">AR</option>
				<option value="AS">AS</option>
				<option value="AZ">AZ</option>
				<option value="BC">BC</option>
				<option value="BM">BM</option>
				<option value="CA">CA</option>
				<option value="CO">CO</option>
				<option value="CT">CT</option>
				<option value="DC">DC</option>
				<option value="DE">DE</option>
				<option value="FL">FL</option>
				<option value="FM">FM</option>
				<option value="GA">GA</option>
				<option value="GU">GU</option>
				<option value="HI">HI</option>
				<option value="IA">IA</option>
				<option value="ID">ID</option>
				<option value="IL">IL</option>
				<option value="IN">IN</option>
				<option value="KS">KS</option>
				<option value="KY">KY</option>
				<option value="LA">LA</option>
				<option value="MA">MA</option>
				<option value="MB">MB</option>
				<option value="MD">MD</option>
				<option value="ME">ME</option>
				<option value="MH">MH</option>
				<option value="MI">MI</option>
				<option value="MN">MN</option>
				<option value="MO">MO</option>
				<option value="MP">MP</option>
				<option value="MS">MS</option>
				<option value="MT">MT</option>
				<option value="NB">NB</option>
				<option value="NC">NC</option>
				<option value="ND">ND</option>
				<option value="NE">NE</option>
				<option value="NH">NH</option>
				<option value="NJ">NJ</option>
				<option value="NL">NL</option>
				<option value="NM">NM</option>
				<option value="NS">NS</option>
				<option value="NT">NT</option>
				<option value="NU">NU</option>
				<option value="NV">NV</option>
				<option value="NY">NY</option>
				<option value="OH">OH</option>
				<option value="OK">OK</option>
				<option value="ON">ON</option>
				<option value="OR">OR</option>
				<option value="PA">PA</option>
				<option value="PE">PE</option>
				<option value="PR">PR</option>
				<option value="PW">PW</option>
				<option value="QC">QC</option>
				<option value="RI">RI</option>
				<option value="SC">SC</option>
				<option value="SD">SD</option>
				<option value="SK">SK</option>
				<option value="TN">TN</option>
				<option value="TX" selected="selected">TX</option>
				<option value="UT">UT</option>
				<option value="VA">VA</option>
				<option value="VI">VI</option>
				<option value="VT">VT</option>
				<option value="WA">WA</option>
				<option value="WI">WI</option>
				<option value="WV">WV</option>
				<option value="WY">WY</option>
				<option value="YT">YT</option>
				<option value="ZZ">ZZ</option>
			</select></br></br>
			
		<label>Zip *</label>
			<input type="text" name="zip" id="zip" value="<?php echo $_POST['zip']; ?>" /></br></br>

		<label>Home Phone *</label>
			<input type="text" name="home_phone" id="home_phone" value="<?php echo $_POST['home_phone']; ?>" /></br></br>

		<label>Work Phone</label>
			<input type="text" name="work_phone" id="work_phone" value="<?php echo $_POST['work_phone']; ?>" /></br></br>

		<label>Ext.</label>
			<input type="text" name="ext" id="ext" value="<?php echo $_POST['ext']; ?>" /></br></br>

		<label>Cell Phone *</label>
			<input type="text" name="cell_phone" id="cell_phone" value="<?php echo $_POST['cell_phone']; ?>" /></br></br>

		<label>Email *</label>
			<input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>" /></br></br>

		<input type="checkbox" checked="checked" value="1" name="email_updates" id="email_updates">
		Sign me up for email updates</br></br>

		<input type="checkbox" checked="checked" value="1" name="text_messages" id="text_messages">
		Sign me up to receive text messages on my cell phone</br></br>
		</p>
		
		<p><b>Opportunities that Interest Me</b></p>
			
		<p style="text-indent:0px">
			<input type="checkbox" value="1" name="early_voting" id="early_voting">
			I want to work as a poll greeter during early voting or on election day</br></br>

			<input type="checkbox" value="1" name="endorsements" id="endorsements">
			List my name in endorsements</br></br>

			<input type="checkbox" value="1" name="yard" id="yard">
			I want a sign for my yard</br></br>

			<input type="checkbox" value="1" name="phone_calls" id="phone_calls">
			I want to make phone calls for Vickie</br></br>

			<input type="checkbox" value="1" name="bumper_sticker" id="bumper_sticker">
			Send me a bumper sticker for my car</br></br>

			<input type="checkbox" value="1" name="neighborhood_coffee" id="neighborhood_coffee">
			I will host a neighborhood coffee for Vickie</br></br>

			<input type="checkbox" value="1" name="large_sign" id="large_sign">
			I want a large sign for my property</br></br>

			<input type="checkbox" value="1" name="come_and_speak" id="come_and_speak">
			I would like Vickie to come and speak to my group/club</br></br>

			<input type="checkbox" value="1" name="campaign_office" id="campaign_office">
			I want to help in the campaign office</br></br>

			<input type="checkbox" value="1" name="knock_on_doors" id="knock_on_doors">
			I want to knock on doors for Vickie</br></br>
			
			<label>Comments</label>
			<textarea name="comments" id="comments" rows="5" cols="40"><?php echo $_POST['comments']; ?></textarea></br></br>
			
			<label>&nbsp;</label>
			<input type="submit" name="submit" id="submit" value="Submit" /></br></br>
		</p>
		<?php } ?>
	</form>
<?php }else{ ?>

<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<ul class="actions">
	<?php if (!$this->print) : ?>
		<?php if ($params->get('show_print_icon')) : ?>
			<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
			</li>
		<?php endif; ?>

		<?php if ($params->get('show_email_icon')) : ?>
			<li class="email-icon">
			<?php echo JHtml::_('icon.email',  $this->item, $params); ?>
			</li>
		<?php endif; ?>

		<?php if ($canEdit) : ?>
			<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
			</li>
		<?php endif; ?>

	<?php else : ?>
		<li>
		<?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?>
		</li>
	<?php endif; ?>

	</ul>
<?php endif; ?>

<?php  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php $useDefList = (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_parent_category'))
	or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))
	or ($params->get('show_hits'))); ?>

<?php if ($useDefList) : ?>
	<dl class="article-info">
	<dt class="article-info-term"><?php  echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>
<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
	<dd class="parent-category-name">
	<?php	$title = $this->escape($this->item->parent_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
		<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_category')) : ?>
	<dd class="category-name">
	<?php 	$title = $this->escape($this->item->category_title);
	$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
	<?php if ($params->get('link_category') and $this->item->catslug) : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
	<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_create_date')) : ?>
	<dd class="create">
	<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
	<dd class="modified">
	<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_publish_date')) : ?>
	<dd class="published">
	<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
	<dd class="createdby">
	<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
	<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
	<?php
		$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
		$item = JSite::getMenu()->getItems('link', $needle, true);
		$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
	?>
		<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
	<?php else: ?>
		<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
	<?php endif; ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_hits')) : ?>
	<dd class="hits">
	<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
	</dd>
<?php endif; ?>
<?php if ($useDefList) : ?>
	</dl>
<?php endif; ?>

<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<?php if ($params->get('access-view')):?>
	<?php echo $this->item->text; ?>

	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true and  $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
			    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?></a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>
<?php } ?>
</div>
