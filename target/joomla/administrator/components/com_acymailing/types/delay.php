<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
class delayType{
	var $values = array();
	var $num = 0;
	var $onChange = '';
	function delayType(){
		static $i = 0;
		$i++;
		$this->num = $i;
		$js = "function updateDelay".$this->num."(){";
			$js .= "delayvar = window.document.getElementById('delayvar".$this->num."');";
			$js .= "delaytype = window.document.getElementById('delaytype".$this->num."').value;";
			$js .= "delayvalue = window.document.getElementById('delayvalue".$this->num."');";
			$js .= "realValue = delayvalue.value;";
			$js .= "if(delaytype == 'minute'){realValue = realValue*60; }";
			$js .= "if(delaytype == 'hour'){realValue = realValue*3600; }";
			$js .= "if(delaytype == 'day'){realValue = realValue*86400; }";
			$js .= "if(delaytype == 'week'){realValue = realValue*604800; }";
			$js .= "if(delaytype == 'month'){realValue = realValue*2592000; }";
			$js .= "delayvar.value = realValue;";
		$js .= '}';
		$doc =& JFactory::getDocument();
		$doc->addScriptDeclaration( $js );
	}
	function display($map,$value,$type = 1){
		if($type == 0){
			$this->values[] = JHTML::_('select.option', 'second',JText::_('ACY_SECONDS'));
			$this->values[] = JHTML::_('select.option', 'minute',JText::_('ACY_MINUTES'));
		}elseif($type == 1){
			$this->values[] = JHTML::_('select.option', 'minute',JText::_('ACY_MINUTES'));
			$this->values[] = JHTML::_('select.option', 'hour',JText::_('HOURS'));
			$this->values[] = JHTML::_('select.option', 'day',JText::_('DAYS'));
			$this->values[] = JHTML::_('select.option', 'week',JText::_('WEEKS'));
		}elseif($type == 2){
			$this->values[] = JHTML::_('select.option', 'minute',JText::_('ACY_MINUTES'));
			$this->values[] = JHTML::_('select.option', 'hour',JText::_('HOURS'));
		}elseif($type == 3){
			$this->values[] = JHTML::_('select.option', 'hour',JText::_('HOURS'));
			$this->values[] = JHTML::_('select.option', 'day',JText::_('DAYS'));
			$this->values[] = JHTML::_('select.option', 'week',JText::_('WEEKS'));
			$this->values[] = JHTML::_('select.option', 'month',JText::_('MONTHS'));
		}elseif($type == 4){
			$this->values[] = JHTML::_('select.option', 'week',JText::_('WEEKS'));
			$this->values[] = JHTML::_('select.option', 'month',JText::_('MONTHS'));
		}
		$return = $this->get($value,$type);
		$delayValue = '<input class="inputbox" onchange="updateDelay'.$this->num.'();'.$this->onChange.'" type="text" id="delayvalue'.$this->num.'" size="10" value="'.$return->value.'" /> ';
		$delayVar = '<input type="hidden" name="'.$map.'" id="delayvar'.$this->num.'" value="'.$value.'"/>';
		return $delayValue.JHTML::_('select.genericlist',   $this->values, 'delaytype'.$this->num, 'class="inputbox" size="1" onchange="updateDelay'.$this->num.'();'.$this->onChange.'"', 'value', 'text', $return->type ,'delaytype'.$this->num).$delayVar;
	}
	function get($value,$type){
		$return = null;
		$return->value = $value;
		if($type == 0){
			$return->type = 'second';
		}else{
			$return->type = 'minute';
		}
		if($return->value >= 60  AND $return->value%60 == 0){
			$return->value = (int) $return->value / 60;
			$return->type = 'minute';
			if($type != 0 AND $return->value >=60 AND $return->value%60 == 0){
				$return->type = 'hour';
				$return->value = $return->value / 60;
				if($type != 2 AND $return->value >=24 AND $return->value%24 == 0){
					$return->type = 'day';
					$return->value = $return->value / 24;
					if($type >= 3 AND $return->value >=30 AND $return->value%30 == 0){
						$return->type = 'month';
						$return->value = $return->value / 30;
					}elseif($return->value >=7 AND $return->value%7 == 0){
						$return->type = 'week';
						$return->value = $return->value / 7;
					}
				}
			}
		}
		return $return;
	}
}