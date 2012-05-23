<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// Include dependancy of the main model form
jimport('joomla.application.component.modelform');
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
// Include dependancy of the dispatcher
jimport('joomla.event.dispatcher');

/**
 * UpdHelloWorld Model
 */
class HelloWorldModelUpdHelloWorld extends JModelForm
{
	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Get the data for a new qualification
	 */
	public function getForm($data = array(), $loadData = true)
	{

        $app = JFactory::getApplication('site');

        // Get the form.
		$form = $this->loadForm('com_helloworld.updhelloworld', 'updhelloworld', array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;

	}

	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	function &getItem()
	{	
		if (isset($_POST['option'])){
			$data = $_POST;
			$amount = $data['amount'];
			$email = $data['email'];
			$first_name = $data['first_name'];
			$last_name = $data['last_name'];
			$employer = $data['employer'];
			$occupation = $data['occupation'];
			$error = '';
			if($amount == '' && empty($amount)){
				$error .= '<li>Please enter an amount</li>';
			}
			if(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)){
				$error .= '<li>Please enter a valid email</li>';
			}
			if($first_name == '' && empty($first_name)){
				$error .= '<li>Please enter your first name</li>';
			}
			if($last_name == '' && empty($last_name)){
				$error .= '<li>Please enter your last name</li>';
			}
			if($employer == '' && empty($employer)){
				$error .= '<li>Please enter your employer</li>';
			}
			if($occupation == '' && empty($occupation)){
				$error .= '<li>Please enter your occupation</li>';
			}
			if($error == ''){
				// set the data into a query to update the record
				$db		= $this->getDbo();
				$query = "INSERT INTO #__helloworld (`amount`, `email`, `first_name`, `last_name`, `employer`, `occupation`)
				VALUES ('".$amount."', '".$email."', '".$first_name."', '".$last_name."', '".$employer."', '".$occupation."')";
				$db->setQuery((string)$query);
				$result = $db->query();
				$last_id = $db->insertid();
				if($result){
					## Grab session ##
					$session = JFactory::getSession();
					$session->set('last_id', $last_id);
					$s_last_id = $session->get('last_id');
					?>

					<script>
						location.href='http://vickiebarnett.kindlebit.biz/index.php?option=com_helloworld&view=updhelloworld&Itemid=444&act=pay';
					</script>

					<?php

				}
			}else{
			?>
				<div style="color:#ff0d0d; margin:10px;" id="error_div"><?php echo $error; ?></div>
			<?php
			}
		}
	}

	public function updItem($data)
	{
	}
}
