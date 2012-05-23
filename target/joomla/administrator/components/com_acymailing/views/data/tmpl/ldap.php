<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
	if(!function_exists('ldap_connect')){
		acymailing_display('LDAP Extension not loaded on your server.<br/>Please enable the LDAP php extension.','warning');
		return;
	}
	$js = "function updateldap(){
					document.getElementById('ldap_fields').innerHTML = '<span class=\"onload\"></span>';
					queryString = 'index.php?option=com_acymailing&tmpl=component&ctrl=data&task=ajaxload&importfrom=ldap';
					queryString += '&ldap_host='+document.getElementById('ldap_host').value;
					queryString += '&ldap_port='+document.getElementById('ldap_port').value;
					queryString += '&ldap_basedn='+document.getElementById('ldap_basedn').value;
					queryString += '&ldap_username='+document.getElementById('ldap_username').value;
					queryString += '&ldap_password='+document.getElementById('ldap_password').value;
					try{
						new Ajax(queryString,{ method: 'post', update: document.getElementById('ldap_fields')}).request();
					}catch(err){
						new Request({
						method: 'post',
						url: queryString,
						onSuccess: function(responseText, responseXML) {
							document.getElementById('ldap_fields').innerHTML = responseText;
						}
						}).send();
					}
				}";
			$doc =& JFactory::getDocument();
			$doc->addScriptDeclaration( $js );
?>
<fieldset>
<legend><?php echo JText::_('CONFIGURATION'); ?></legend>
<table class="admintable" cellspacing="1">
<?php if($this->config->get('require_confirmation')){ ?>
		<tr>
			<td class="key" >
				<?php echo JText::_('IMPORT_CONFIRMED'); ?>
			</td>
			<td>
				<?php echo JHTML::_('select.booleanlist', "ldap_import_confirm" , '',$this->config->get('ldap_import_confirm',1),JText::_('JOOMEXT_YES'),JTEXT::_('JOOMEXT_NO') ); ?>
			</td>
		</tr>
<?php } ?>
	<tr>
		<td class="key" >
			<?php echo JText::_('GENERATE_NAME'); ?>
		</td>
		<td>
			<?php echo JHTML::_('select.booleanlist', "ldap_generatename" , '',$this->config->get('ldap_generatename',1),JText::_('JOOMEXT_YES'),JTEXT::_('JOOMEXT_NO')); ?>
		</td>
	</tr>
	<tr>
		<td class="key" >
			<?php echo JText::_('OVERWRITE_EXISTING'); ?>
		</td>
		<td>
			<?php echo JHTML::_('select.booleanlist', "ldap_overwriteexisting" , '',$this->config->get('ldap_overwriteexisting',0),JText::_('JOOMEXT_YES'),JTEXT::_('JOOMEXT_NO')); ?>
		</td>
	</tr>
	<tr>
		<td class="key" >
			<?php echo 'Delete AcyMailing user if it does not exists in LDAP'; ?>
		</td>
		<td>
			<?php echo JHTML::_('select.booleanlist', "ldap_deletenotexists" , '',$this->config->get('ldap_deletenotexists',0),JText::_('JOOMEXT_YES'),JTEXT::_('JOOMEXT_NO')); ?>
		</td>
	</tr>
</table>
</fieldset>
<fieldset>
<legend>Server</legend>
<table class="admintable" cellspacing="1">
	<tr>
		<td class="key" >
			<label for="ldap_host">Host</label>
		</td>
		<td>
			<input onchange="updateldap();" type="text" size="30" name="ldap_host" id="ldap_host" value="<?php echo $this->escape($this->config->get('ldap_host')); ?>" />
		</td>
	</tr>
	<tr>
		<td class="key" >
			<label for="ldap_port">Port</label>
		</td>
		<td>
			<input onchange="updateldap();" type="text" size="10" name="ldap_port" id="ldap_port" value="<?php echo $this->escape($this->config->get('ldap_port')); ?>" />
		</td>
	</tr>
	<tr>
		<td class="key" >
			<label for="ldap_username">RDN</label>
		</td>
		<td>
			<input onchange="updateldap();" type="text" size="30" name="ldap_username" id="ldap_username" value="<?php echo $this->escape($this->config->get('ldap_username')); ?>" />
		</td>
	</tr>
	<tr>
		<td class="key" >
			<label for="ldap_password"><?php echo JText::_('BOUNCE_PASSWORD'); ?></label>
		</td>
		<td>
			<input onchange="updateldap();" type="password" size="30" name="ldap_password" id="ldap_password" value="<?php echo $this->escape($this->config->get('ldap_password')); ?>" />
		</td>
	</tr>
	<tr>
		<td class="key" >
			<label for="ldap_basedn">Base DN</label>
		</td>
		<td>
			<input onchange="updateldap();" type="text" size="50" name="ldap_basedn" id="ldap_basedn" value="<?php echo $this->escape($this->config->get('ldap_basedn')); ?>" />
		</td>
	</tr>
</table>
</fieldset>
<fieldset id="ldap_fields">
</fieldset>