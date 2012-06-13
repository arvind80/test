<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
 */
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');
 
/**
 * Hello World Component Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class PermissionControllerPermissions extends JController{
	function __construct(){
	   parent::__construct();
	   $this->registerTask( 'add', 'edit','delete','find');
	}
	
    function display(){
        parent::display();
    }
    function permissions(){
    	parent::display();
    }
    function  edit(){
    	JRequest::setVar( 'view', 'permissions' );
    	parent::display();
    }
	function find(){
		JRequest::setVar( 'view', 'permissions' );
		parent::display();
	}
	function  delete(){
    	JRequest::setVar( 'view', 'permissions' );
    	parent::display();
    }
}