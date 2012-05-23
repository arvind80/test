<?php
/**
 * @copyright	Copyright (C) 2009-2011 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
class acymenuHelper{
	function display($selected = ''){
		if(version_compare(JVERSION,'1.6.0','<')){
			$js="window.addEvent('domready', function() {
				if(document.getElementById(\"submenu-box\")){
					document.getElementById(\"submenu-box\").style.display='none';
				}
			})";
			$doc =& JFactory::getDocument();
			$doc->addScriptDeclaration($js);
		}
		$selected = substr($selected,0,5);
		$config = acymailing_config();
		$mainmenu = array();
		$submenu = array();
		if(acymailing_isAllowed($config->get('acl_subscriber_manage','all'))){
			$mainmenu['subscriber'] = array(JText::_('USERS'), 'index.php?option=com_acymailing&ctrl=subscriber','acyicon-16-users');
			$submenu['subscriber'] = array();
			$submenu['subscriber'][] = array(JText::_('USERS'), 'index.php?option=com_acymailing&ctrl=subscriber','acyicon-16-users');
			$submenu['subscriber'][] = array(' '.JText::_('ACY_NEW'),'index.php?option=com_acymailing&ctrl=subscriber&task=add','acyicon-16-new');
			if(acymailing_isAllowed($config->get('acl_subscriber_import','all'))) $submenu['subscriber'][] = array(JText::_('IMPORT'), 'index.php?option=com_acymailing&ctrl=data&task=import','acyicon-16-import');
			if(acymailing_isAllowed($config->get('acl_subscriber_export','all'))) $submenu['subscriber'][] = array(JText::_('ACY_EXPORT'), 'index.php?option=com_acymailing&ctrl=data&task=export','acyicon-16-export');
		}
		if(acymailing_isAllowed($config->get('acl_lists_manage','all'))){
			$mainmenu['list'] = array(JText::_('LISTS'), 'index.php?option=com_acymailing&ctrl=list','acyicon-16-acylist');
			$submenu['list'] = array();
			$submenu['list'][] = array(JText::_('LISTS'), 'index.php?option=com_acymailing&ctrl=list','acyicon-16-acylist');
			$submenu['list'][] = array(' '.JText::_('ACY_NEW'),'index.php?option=com_acymailing&ctrl=list&task=add','acyicon-16-new');
			if(acymailing_isAllowed($config->get('acl_lists_filter','all'))) $submenu['list'][] = array(JText::_('ACY_FILTERS'), 'index.php?option=com_acymailing&ctrl=filter','acyicon-16-filter' );
		}
		if(acymailing_isAllowed($config->get('acl_newsletters_manage','all'))){
			$mainmenu['newsletter'] = array(JText::_('NEWSLETTERS'), 'index.php?option=com_acymailing&ctrl=newsletter','acyicon-16-newsletter');
			$submenu['newsletter'] = array();
			$submenu['newsletter'][] = array(JText::_('NEWSLETTERS'), 'index.php?option=com_acymailing&ctrl=newsletter','acyicon-16-newsletter');
			$submenu['newsletter'][] = array(JText::_('ACY_NEW'),'index.php?option=com_acymailing&ctrl=newsletter&task=add','acyicon-16-new');
			if(acymailing_level(2) && acymailing_isAllowed($config->get('acl_autonewsletters_manage','all'))){
				$submenu['newsletter'][] = array(JText::_('AUTONEWSLETTERS'), 'index.php?option=com_acymailing&ctrl=autonews','acyicon-16-autonewsletter');
			}
			if(acymailing_level(3) && acymailing_isAllowed($config->get('acl_campaign_manage','all'))){
				$submenu['newsletter'][] = array(JText::_('CAMPAIGN'), 'index.php?option=com_acymailing&ctrl=campaign','acyicon-16-campaign');
			}
			if(acymailing_isAllowed($config->get('acl_templates_manage','all'))) $submenu['newsletter'][] = array(JText::_('ACY_TEMPLATES'), 'index.php?option=com_acymailing&ctrl=template','acyicon-16-template');
		}
		if(acymailing_isAllowed($config->get('acl_queue_manage','all'))) $mainmenu['queue'] = array(JText::_('QUEUE'), 'index.php?option=com_acymailing&ctrl=queue','acyicon-16-queue');
		if(acymailing_isAllowed($config->get('acl_statistics_manage','all'))){
			$mainmenu['stats'] = array(JText::_('STATISTICS'), 'index.php?option=com_acymailing&ctrl=stats','acyicon-16-stats');
			$submenu['stats'] = array();
			$submenu['stats'][] = array(JText::_('STATISTICS'), 'index.php?option=com_acymailing&ctrl=stats','acyicon-16-stats');
			$submenu['stats'][]= array(JText::_('DETAILED_STATISTICS'), 'index.php?option=com_acymailing&ctrl=stats&task=detaillisting','acyicon-16-stats');
			if(acymailing_level(1)) $submenu['stats'][]= array(JText::_('CLICK_STATISTICS'), 'index.php?option=com_acymailing&ctrl=statsurl','acyicon-16-stats');
			if(acymailing_level(1)) $submenu['stats'][]= array(JText::_('CHARTS'), 'index.php?option=com_acymailing&ctrl=diagram','acyicon-16-stats');
		}
		if(acymailing_isAllowed($config->get('acl_configuration_manage','all'))){
			$mainmenu['config'] = array(JText::_('CONFIGURATION'), 'index.php?option=com_acymailing&ctrl=config','acyicon-16-config');
			$submenu['config'] = array();
			$submenu['config'][] = array(JText::_('CONFIGURATION'), 'index.php?option=com_acymailing&ctrl=config','acyicon-16-config');
			if(acymailing_level(3)){
				$submenu['config'][] = array(JText::_('EXTRA_FIELDS'), 'index.php?option=com_acymailing&ctrl=fields','acyicon-16-fields');
				$submenu['config'][] = array(JText::_('BOUNCE_HANDLING'), 'index.php?option=com_acymailing&ctrl=bounces','acyicon-16-bounces');
			}
			$submenu['config'][] = array(JText::_('UPDATE_ABOUT'), 'index.php?option=com_acymailing&ctrl=update','acyicon-16-update');
		}
		$doc =& JFactory::getDocument();
		$doc->addStyleSheet( ACYMAILING_CSS.'acymenu.css' );
		$menu = '<div id="acymenutop"><ul>';
		foreach($mainmenu as $id => $oneMenu){
			$menu .= '<li class="acymainmenu'.(!empty($submenu[$id]) ? ' parentmenu' : ' singlemenu').'"';
			if($selected == substr($id,0,5)) $menu .= ' id="acyselectedmenu"';
			$menu .= ' >';
			$menu .= '<a class="acymainmenulink '.$oneMenu[2].'" href="'.$oneMenu[1].'" >'.$oneMenu[0].'</a>';
			if(!empty($submenu[$id])){
				$menu .= '<ul>';
				foreach($submenu[$id] as $subelement){
					$menu .= '<li class="acysubmenu "><a class="acysubmenulink '.$subelement[2].'" href="'.$subelement[1].'" title="'.$subelement[0].'">'.$subelement[0].'</a></li>';
				}
				$menu .= '</ul>';
			}
			$menu .= '</li>';
		}
		$menu .= '</ul></div>';
		return $menu;
	}
}
