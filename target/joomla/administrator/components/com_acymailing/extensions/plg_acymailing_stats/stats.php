<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
class plgAcymailingStats extends JPlugin
{
	function plgAcymailingStats(&$subject, $config){
		parent::__construct($subject, $config);
		if(!isset($this->params)){
			$plugin =& JPluginHelper::getPlugin('acymailing', 'stats');
			$this->params = new JParameter( $plugin->params );
		}
    }
	function acymailing_replaceusertags(&$email,&$user,$send = true){
		if(!empty($email->altbody)){
			$email->altbody = str_replace(array('{statpicture}','{nostatpicture}'),'',$email->altbody);
		}
		if(!$email->sendHTML OR empty($email->type) OR !in_array($email->type,array('news','autonews','followup')) OR strpos($email->body,'{nostatpicture}')){
			$email->body = str_replace(array('{statpicture}','{nostatpicture}'),'',$email->body);
			return;
		}
		if(empty($user->subid) || !$send){
			$pictureLink = ACYMAILING_LIVE.$this->params->get('picture','media/com_acymailing/images/statpicture.png');
		}else{
			$pictureLink = acymailing_frontendLink('index.php?option=com_acymailing&ctrl=stats&mailid='.$email->mailid.'&subid='.$user->subid);
		}

		$widthsize = $this->params->get('width',50);
		$heightsize = $this->params->get('height',1);
		$width = empty($widthsize) ? '' : ' width="'.$widthsize.'" ';
		$height = empty($heightsize) ? '' : ' height="'.$heightsize.'" ';
		$statPicture = '<img alt="'.$this->params->get('alttext','').'" src="'.$pictureLink.'"  border="0" '.$height.$width.'/>';
		if(strpos($email->body,'{statpicture}')) $email->body = str_replace('{statpicture}',$statPicture,$email->body);
		elseif(strpos($email->body,'</body>')) $email->body = str_replace('</body>',$statPicture.'</body>',$email->body);
		else $email->body .= $statPicture;
	 }//endfct
	 function acymailing_getstatpicture(){
	 	return $this->params->get('picture','media/com_acymailing/images/statpicture.png');
	 }
	 function onAcyDisplayTriggers(&$triggers){
	 	$triggers['opennews'] = JText::_('ON_OPEN_NEWS');
	 }
	 function onAcyDisplayFilters($type){
		$type['deliverstat'] = JText::_('STATISTICS');
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT `mailid`,CONCAT(`subject`,' ( ',`mailid`,' )') as 'value' FROM `#__acymailing_mail` WHERE `type` IN('news','autonews','followup') ORDER BY `subject` ASC ");
		$allemails = $db->loadObjectList();
		$element = null;
		$element->mailid = 0;
		$element->value = JText::_('EMAIL_NAME');
		array_unshift($allemails,$element);
		$actions = array();
		$actions[] = JHTML::_('select.option', 'open', JText::_('OPEN') );
		$actions[] = JHTML::_('select.option', 'notopen', JText::_('NOT_OPEN') );
		$actions[] = JHTML::_('select.option', 'failed', JText::_('FAILED') );
		if(acymailing_level(3)) $actions[] = JHTML::_('select.option', 'bounce', JText::_('BOUNCES') );
		$actions[] = JHTML::_('select.option', 'htmlsent', JText::_('SENT_HTML') );
		$actions[] = JHTML::_('select.option', 'textsent', JText::_('SENT_TEXT') );
		$return = '<div id="filter__num__deliverstat">'.JHTML::_('select.genericlist',   $actions, "filter[__num__][deliverstat][action]", 'class="inputbox" onchange="countresults(__num__)" size="1"', 'value', 'text');
		$return.= ' '.JHTML::_('select.genericlist',  $allemails, "filter[__num__][deliverstat][mailid]", 'onchange="countresults(__num__)" class="inputbox" size="1"', 'mailid', 'value').'</div>';
	 	return $return;
	 }
	  function onAcyProcessFilterCount_deliverstat(&$query,$filter,$num){
		$alias = 'stats'.$num;
		$myquery = 'SELECT COUNT(sub.subid) FROM #__acymailing_subscriber as sub LEFT JOIN #__acymailing_userstats as '.$alias.' on sub.subid = '.$alias.'.subid WHERE '. $this->_wherestats($filter,$alias);
	 	$db =& JFactory::getDBO();
	 	$db->setQuery($myquery);
	 	$nbSubscribers = $db->loadResult();
	 	return JText::sprintf('SELECTED_USERS',$nbSubscribers);
	  }
	  function _wherestats($filter,$alias){
		if($filter['action'] == 'open'){
			$where = $alias.'.open > 0';
		}elseif($filter['action'] == 'notopen'){
			$where = $alias.'.open = 0';
		}elseif($filter['action'] == 'failed'){
			$where = $alias.'.fail = 1';
		}elseif($filter['action'] == 'bounce'){
			$where = $alias.'.bounce = 1';
		}elseif($filter['action'] == 'htmlsent'){
			$where = $alias.'.html = 1';
		}elseif($filter['action'] == 'textsent'){
			$where = $alias.'.html = 0';
		}
		if(!empty($filter['mailid'])) $where .= ' AND '.$alias.'.mailid = '.intval($filter['mailid']);
		return $where;
	  }
	 function onAcyProcessFilter_deliverstat(&$query,$filter,$num){
	 	$alias = 'stats'.$num;
	 	$query->leftjoin[$alias] = '#__acymailing_userstats AS '.$alias.' ON '.$alias.'.subid = sub.subid';
	 	$query->where[] = $this->_wherestats($filter,$alias);
	 }
}//endclass