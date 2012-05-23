<?php
/**
 * @version		$Id: default_ftp.php 22338 2011-11-04 17:24:53Z github_bot $
 * @package		Joomla.Administrator
 * @subpackage	Templates.hathor
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

// no direct access
defined('_JEXEC') or die;
?>
<fieldset class="adminform" title="<?php echo JText::_('COM_INSTALLER_MSG_DESCFTPTITLE'); ?>">
	<legend><?php echo JText::_('COM_INSTALLER_MSG_DESCFTPTITLE'); ?></legend>

	<?php echo JText::_('COM_INSTALLER_MSG_DESCFTP'); ?>

	<?php if (JError::isError($this->ftp)): ?>
		<p><?php echo JText::_($this->ftp->getMessage()); ?></p>
	<?php endif; ?>

	<ul class="adminformlist">
		<li><label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
		<input type="text" id="username" name="username" class="inputbox" value="" /></li>

		<li><label for="password"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
		<input type="password" id="password" name="password" class="input_box" value="" /></li>
	</ul>

</fieldset>
