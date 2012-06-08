<?php

class Content extends Controller {

	function __construct() {

		parent::Controller ();

		require_once (APPPATH . 'controllers/default_constructor.php');
		//p($user_session);
		require_once (APPPATH . 'controllers/api/default_constructor.php');

		if ($this->users_model->is_logged_in () == false) {
			//    exit ( 'Login required' );
		}

	}


	//@todo this must be moved to a seperate voting api
	function vote() {
		@ob_clean ();
		if ($_POST) {
			$_POST ['to_table_id'] = $this->core_model->securityDecryptString ( $_POST ['tt'] );
			$_POST ['to_table'] = $this->core_model->securityDecryptString ( $_POST ['t'] );
			if (intval ( $_POST ['to_table_id'] ) == 0) {
				exit ( '1' );
			}

			if (($_POST ['to_table']) == '') {
				exit ( '2' );
			}

			$save = $this->votes_model->votesCast ( $_POST ['to_table'], $_POST ['to_table_id'] );
			if ($save == true) {
				exit ( 'yes' );
			} else {
				exit ( 'no' );
			}
		} else {
			exit ( 'no votes casted!' );
		}

	}


function report() {
		@ob_clean ();
		if ($_POST) {
			$_POST ['to_table_id'] = $this->core_model->securityDecryptString ( $_POST ['tt'] );
			$_POST ['to_table'] = $this->core_model->securityDecryptString ( $_POST ['t'] );
			if (intval ( $_POST ['to_table_id'] ) == 0) {
				exit ( '1' );
			}

			if (($_POST ['to_table']) == '') {
				exit ( '2' );
			}

			$save = $this->reports_model->report ( $_POST ['to_table'], $_POST ['to_table_id'] );
			if ($save == true) {
				exit ( 'yes' );
			} else {
				exit ( 'no' );
			}
		} else {
			exit ( 'nothing is reported!' );
		}

	}

}



