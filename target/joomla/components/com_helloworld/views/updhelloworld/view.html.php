<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the UpdHelloWorld Component
 */
class HelloWorldViewUpdHelloWorld extends JView
{
	// Overwriting JView display method
	function display($tpl = null) 
	{
		$app		= JFactory::getApplication();
		$params		= $app->getParams();
		$dispatcher = JDispatcher::getInstance();

		// Get some data from the models
		$state		= $this->get('State');
		$item		= $this->get('Item');
		$this->form	= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Display the view
		parent::display($tpl);
	}
}
