<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
class queueClass extends acymailingClass{
	var $onlynew = false;
	var $mindelay = 0;
	function delete($filters){
		$query = 'DELETE a.* FROM '.acymailing_table('queue').' as a';
		if(!empty($filters)){
			$query .= ' JOIN '.acymailing_table('subscriber').' as b on a.subid = b.subid';
			$query .= ' JOIN '.acymailing_table('mail').' as c on a.mailid = c.mailid';
			$query .= ' WHERE ('.implode(') AND (',$filters).')';
		}
		$this->database->setQuery($query);
		$this->database->query();
		$nbRecords = $this->database->getAffectedRows();
		if(empty($filters)){
			$this->database->setQuery('TRUNCATE TABLE '.acymailing_table('queue'));
			$this->database->query();
		}
		return $nbRecords;
	}
	function nbQueue($mailid){
		$mailid = (int) $mailid;
		$this->database->setQuery('SELECT count(subid) FROM '.acymailing_table('queue').' WHERE mailid = '.$mailid.' GROUP BY mailid');
		return $this->database->loadResult();
	}
	function queue($mailid,$time){
		$mailid = intval($mailid);
		if(empty($mailid)) return false;
		$classLists = acymailing_get('class.listmail');
		$lists = $classLists->getReceivers($mailid,false);
		if(empty($lists)) return 0;
		$config = acymailing_config();
		$querySelect = 'SELECT DISTINCT a.subid,'.$mailid.','.$time.','.(int) $config->get('priority_newsletter',3);
		$querySelect .= ' FROM '.acymailing_table('listsub').' as a ';
		$querySelect .= ' JOIN '.acymailing_table('subscriber').' as b ON a.subid = b.subid ';
		$querySelect .= 'WHERE b.enabled = 1 AND b.accept = 1 ';
		$querySelect .= 'AND a.listid IN ('.implode(',',array_keys($lists)).') AND a.status = 1 ';
		$config = acymailing_config();
		if($config->get('require_confirmation','0')){ $querySelect .= 'AND b.confirmed = 1 '; }
		$query = 'INSERT IGNORE INTO '.acymailing_table('queue').' (subid,mailid,senddate,priority) '.$querySelect;
		$this->database->setQuery($query);
		if(!$this->database->query()){
			acymailing_display($this->database->getErrorMsg(),'error');
		}
		$totalinserted = $this->database->getAffectedRows();
		if($this->onlynew){
			$this->database->setQuery('DELETE b.* FROM `#__acymailing_userstats` as a JOIN `#__acymailing_queue` as b on a.subid = b.subid WHERE a.mailid = '.$mailid);
			$this->database->query();
			$totalinserted = $totalinserted - $this->database->getAffectedRows();
		}
		if(!empty($this->mindelay)){
			$this->database->setQuery('DELETE b.* FROM `#__acymailing_userstats` as a JOIN `#__acymailing_queue` as b on a.subid = b.subid WHERE a.senddate > '.(time() - ($this->mindelay*24*60*60)));
			$this->database->query();
			$totalinserted = $totalinserted - $this->database->getAffectedRows();
		}
		JPluginHelper::importPlugin('acymailing');
    	$dispatcher = &JDispatcher::getInstance();
    	$dispatcher->trigger('onAcySendNewsletter',array($mailid));
		return $totalinserted;
	}
	function getReady($limit,$mailid = 0){
		$query = 'SELECT c.*,a.* FROM '.acymailing_table('queue').' as a';
		$query .= ' JOIN '.acymailing_table('mail').' as b on a.`mailid` = b.`mailid` ';
		$query .= ' JOIN '.acymailing_table('subscriber').' as c on a.`subid` = c.`subid` ';
		$query .= ' WHERE a.`senddate` <= '.time().' AND b.`published` = 1';
		if(!empty($mailid)) $query .= ' AND a.`mailid` = '.$mailid;
		$query .= ' ORDER BY a.`priority` ASC, a.`senddate` ASC, a.`subid` ASC';
		if(!empty($limit)) $query .= ' LIMIT '.$limit;
		$this->database->setQuery($query);
		$results = $this->database->loadObjectList();
		if($results === null){
			$this->database->setQuery('REPAIR TABLE #__acymailing_queue, #__acymailing_subscriber, #__acymailing_mail');
			$this->database->query();
		}

		if(!empty($results)){
			$firstElementQueued = reset($results);
			$this->database->setQuery('UPDATE #__acymailing_queue SET senddate = senddate + 1 WHERE mailid = '.$firstElementQueued->mailid.' AND subid = '.$firstElementQueued->subid.' LIMIT 1');
			$this->database->query();
		}
		return $results;
	}
	function queueStatus($mailid,$all = false){
		$query = 'SELECT a.mailid, count(a.subid) as nbsub,min(a.senddate) as senddate, b.subject FROM '.acymailing_table('queue').' as a';
		$query .= ' JOIN '.acymailing_table('mail').' as b on a.mailid = b.mailid';
		$query .= ' WHERE b.published > 0';
		if(!$all){
			$query .= ' AND a.senddate < '.time();
			if(!empty($mailid)) $query .= ' AND a.mailid = '.$mailid;
		}
		$query .= ' GROUP BY a.mailid';
		$this->database->setQuery($query);
		$queueStatus = $this->database->loadObjectList('mailid');
		return $queueStatus;
	}
}