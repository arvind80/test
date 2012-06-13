<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
*/
 
// no direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 *
 * @package    HelloWorld
 */
 
class PermissionViewPermission extends JView
{
    function display($tpl = null)
    {
        $model = &$this->getModel('Permission');
        $greeting = $model->getPermission();
        $this->assignRef( 'greeting',	$greeting );
 
        parent::display($tpl);
    }
}