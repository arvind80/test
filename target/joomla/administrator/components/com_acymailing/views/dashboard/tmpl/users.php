<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<br  style="font-size:1px;" />
<div id="dash_users">
	<table class="adminlist" cellpadding="1">
		<thead>
			<tr>
				<th class="title">
					<?php echo JText::_('JOOMEXT_NAME'); ?>
				</th>
				<th class="title">
					<?php echo JText::_('JOOMEXT_EMAIL'); ?>
				</th>
				<th class="title titledate">
					<?php echo JText::_( 'CREATED_DATE' );?>
				</th>
				<th class="title titletoggle">
					<?php echo JText::_( 'RECEIVE_HTML' );?>
				</th>
				<?php if($this->config->get('require_confirmation',1)) {?>
				<th class="title titletoggle">
					<?php echo JText::_( 'CONFIRMED' );?>
				</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php
				$k = 0;
				foreach($this->users as $oneUser){
					$row =& $oneUser;
					$confirmedid = 'confirmed_'.$row->subid;
					$htmlid = 'html_'.$row->subid;
			?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
						<?php echo $row->name; ?>
					</td>
					<td>
						<a href="<?php echo acymailing_completeLink('subscriber&task=edit&subid='.$row->subid)?>"><?php echo $row->email; ?></a>
					</td>
					<td align="center" style="text-align:center">
						<?php echo acymailing_getDate($row->created); ?>
					</td>
					<td align="center" style="text-align:center">
						<span id="<?php echo $htmlid ?>" class="loading"><?php echo $this->toggleClass->toggle($htmlid,$row->html,'subscriber') ?></span>
					</td>
					<?php if($this->config->get('require_confirmation',1)) {?>
					<td align="center" style="text-align:center">
						<span id="<?php echo $confirmedid ?>" class="loading"><?php echo $this->toggleClass->toggle($confirmedid,$row->confirmed,'subscriber') ?></span>
					</td>
					<?php } ?>
				</tr>
			<?php
					$k = 1-$k;
				}
			?>
		</tbody>
	</table>
</div>