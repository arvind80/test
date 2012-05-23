<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
class listsubClass extends acymailingClass{
	var $type = 'list';
	var $gid;
	var $checkAccess = true;
	var $sendNotif = true;
	var $sendConf = true;
	var $survey = '';
	function updateSubscription($subid,$lists){
		$result = true;
		$time = time();
		$listHelper = acymailing_get('helper.list');
		$listHelper->sendNotif = $this->sendNotif;
		$listHelper->sendConf = $this->sendConf;
		$listHelper->survey = $this->survey;
		foreach($lists as $status => $listids){
			if(empty($listids)) continue;
			JArrayHelper::toInteger($listids);
			//-1 is unsubscribe
			if($status == '-1') $column = 'unsubdate';
			else $column = 'subdate';
			$query = 'UPDATE '.acymailing_table('listsub').' SET `status` = '.intval($status).','.$column.'='.$time.' WHERE subid = '.intval($subid).' AND listid IN ('.implode(',',$listids).')';
			$this->database->setQuery($query);
			$result = $this->database->query() && $result;
			if($status == 1){
				$listHelper->subscribe($subid,$listids);
			}elseif($status == -1){
				$listHelper->unsubscribe($subid,$listids);
			}
		}
		return $result;
	}
	function removeSubscription($subid,$listids){
		JArrayHelper::toInteger($listids);
		$query = 'DELETE FROM '.acymailing_table('listsub').' WHERE subid = '.intval($subid).' AND listid IN ('.implode(',',$listids).')';
		$this->database->setQuery($query);
		$this->database->query();
		$listHelper = acymailing_get('helper.list');
		$listHelper->sendNotif = $this->sendNotif;
		$listHelper->unsubscribe($subid,$listids);
		return true;
	}
	function addSubscription($subid,$lists){
		$app =& JFactory::getApplication();
		$my = JFactory::getUser();
		$result = true;
		$time = time();
		$subid = intval($subid);
		$listHelper = acymailing_get('helper.list');
		foreach($lists as $status => $listids){
			$status = intval($status);
			JArrayHelper::toInteger($listids);
			$this->database->setQuery('SELECT `listid`,`access_sub` FROM '.acymailing_table('list').' WHERE `listid` IN ('.implode(',',$listids).') AND `type` = \'list\'');
			$allResults = $this->database->loadObjectList('listid');
			$listids = array_keys($allResults);
			//-1 is unsubscribe
			if($status == '-1') $column = 'unsubdate';
			else $column = 'subdate';
			$values = array();
			foreach($listids as $listid){
				if(empty($listid)) continue;
				if($status > 0 && acymailing_level(3)){
					if(!$app->isAdmin() && $this->checkAccess && $allResults[$listid]->access_sub != 'all'){
						if(!acymailing_isAllowed($allResults[$listid]->access_sub,$this->gid)) continue;
					}
				}
				$values[] = intval($listid).','.$subid.','.$status.','.$time;
			}
			if(empty($values)) continue;
			$query = 'INSERT INTO '.acymailing_table('listsub').' (listid,subid,`status`,'.$column.') VALUES ('.implode('),(',$values).')';
			$this->database->setQuery($query);
			$result = $this->database->query() && $result;
			if($status == 1){
				$listHelper->subscribe($subid,$listids);
			}
		}
		return $result;
	}
	function getSubscription($subid){
		$query = 'SELECT * FROM '.acymailing_table('listsub').' as a LEFT JOIN '.acymailing_table('list').' as b on a.listid = b.listid WHERE a.subid = '.intval($subid).' AND b.type = \''.$this->type.'\' ORDER BY b.ordering ASC';
		$this->database->setQuery($query);
		return $this->database->loadObjectList('listid');
	}
	function getSubscriptionString($subid){
		$usersubscription = $this->getSubscription($subid);
		$subscriptionString = '';
		if(!empty($usersubscription)){
			$subscriptionString = '<ul>';
			foreach($usersubscription as $onesub){
				$status = ($onesub->status == 1) ? JText::_('SUBSCRIBED') : (($onesub->status == -1) ? JText::_('UNSUBSCRIBED') : JText::_('PENDING_SUBSCRIPTION'));
				$subscriptionString .= '<li>['.$onesub->listid.'] '.$onesub->name.' : '.$status.'</li>';
			}
			$subscriptionString .= '</ul>';
		}
		return $subscriptionString;
	}
}
