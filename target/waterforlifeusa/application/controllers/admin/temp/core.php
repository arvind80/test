<?php

class Core extends Controller {
	
	function __construct() {
		parent::Controller ();
		require_once (APPPATH . 'controllers/default_constructor.php');
		require_once (APPPATH . 'controllers/admin/default_constructor.php');
	}
	
	function index() {
		$this->template ['functionName'] = strtolower ( __FUNCTION__ );
		
		if ($this->session->userdata ( 'user' ) == false) {
			//redirect ( 'index' );
		}
		
		$this->load->vars ( $this->template );
		
		$layout = $this->load->view ( 'admin/layout', true, true );
		$primarycontent = '';
		$secondarycontent = '';
		
		$primarycontent = $this->load->view ( 'admin/index', true, true );
		//$layout = str_ireplace ( '{primarycontent }', $primarycontent, $layout );
		//$layout = str_ireplace ( '{secondarycontent}', $secondarycontent, $layout );
		//$this->load->view('welcome_message');
		$this->output->set_output ( $layout );
	}
	
	function reorderMedia() {
		$positions = $_POST ['positions'];
		if (! empty ( $positions )) {
			$this->core_model->mediaReOrder ( $positions );
		}
		exit ();
	}
	
	function mediaDelete() {
		$id = $_POST ['id'];
		if (intval ( $id ) != 0) {
			$this->core_model->mediaDelete ( $id );
		}
		exit ();
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */