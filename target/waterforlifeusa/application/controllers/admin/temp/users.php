<?php



class Users extends Controller {

	

	function __construct() {

		parent::Controller ();

		require_once (APPPATH . 'controllers/default_constructor.php');
		require_once (APPPATH . 'controllers/admin/default_constructor.php');

	

	}

	function delete() {


		$id = $this->core_model->getParamFromURL ( 'id' );
		$this->users_model->userDeleteById ( $id );
		redirect ( 'admin/users/index' );


}	
	
	
	

	function index() {

		$this->template ['functionName'] = strtolower ( __FUNCTION__ );

		

		if ($this->session->userdata ( 'user' ) == false) {

			//redirect ( 'index' );

		}

		

		if ($_POST) {

			$this->users_model->saveUser ( $_POST );

		}

		

		$users = $this->users_model->getUsers ();

		

		$this->template ['users'] = $users;

		

		$this->load->vars ( $this->template );

		

		$layout = $this->load->view ( 'admin/layout', true, true );

		$primarycontent = '';

		$secondarycontent = '';

		

		$primarycontent = $this->load->view ( 'admin/users/index', true, true );

		$secondarycontent = $this->load->view ( 'admin/users/sidebar', true, true );

		$layout = str_ireplace ( '{primarycontent}', $primarycontent, $layout );

		$layout = str_ireplace ( '{secondarycontent}', $secondarycontent, $layout );

		//$this->load->view('welcome_message');

		$this->output->set_output ( $layout );

	}



}

?>