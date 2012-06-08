<?php

class Media extends Controller {

	function __construct() {

		parent::Controller ();

		require_once (APPPATH . 'controllers/default_constructor.php');
		//p($user_session);
		require_once (APPPATH . 'controllers/api/default_constructor.php');

		if ($this->users_model->is_logged_in () == false) {
			//    exit ( 'Login required' );
		}

	}

	function delete_picture() {
		@ob_clean ();

		$pic_id = intval ( $this->core_model->securityDecryptString ( $_POST ['id'] ) );
		if (intval ( $pic_id ) == 0) {
			exit ( 'Error!' );
		}

		$user_id = $this->core_model->userId ();
		if (intval ( $user_id ) == 0) {
			exit ( 'Error!' );
		}

		$media = $this->core_model->mediaGetById ( $pic_id );
		//p($media);
		if (intval ( $media ['created_by'] ) == intval ( $user_id )) {
			//exit('ok');
			$this->core_model->mediaDelete ( $media ['id'] );
		} else {
			exit ( 'Error! This picture is not yours!' );
		}
	}

	function user_upload_picture() {
		@ob_clean ();
		$user_id = $this->core_model->userId ();
		if (intval ( $user_id ) == 0) {
			exit ( 'Error! You are not logged in.' );
		}

		if (! empty ( $_FILES )) {
			$resize_options = array ();
			$resize_options ['width'] = 400;
			$resize_options ['height'] = 400;

			$this->core_model->mediaUpload ( 'table_users', $user_id, $queue_id = false, $resize_options );
			exit ( 'ok' );
		}

	}

	function crop_picture_by_id() {
		@ob_clean ();
		$user_id = $this->core_model->userId ();
		if (intval ( $user_id ) == 0) {
			exit ( 'Error! You are not logged in.' );
		}

		$id = $_POST ['id'];

		if ($id > 0) {
			$media = $this->core_model->mediaGetById ( $id );
			if (! empty ( $media )) {
				require ('ImageManipulation.php');
				$file_path = MEDIAFILES . 'pictures/original/' . $media ['filename'];
				$objImage = new ImageManipulation ( $file_path );
				if ($objImage->imageok) {
					$objImage->setCrop ( $_POST ['x'], $_POST ['y'], $_POST ['w'], $_POST ['h'] );
					//$objImage->resize(500);
					//$objImage->show();
					$objImage->save ( $file_path );
				} else {
					echo 'Error!';
				}
			}
		}

	//	$src = 'flowers.jpg';

		//exit ();
		exit ();

		//var_dump ( $_POST );

	}

	function user_get_picture_info() {
		$user_id = $this->core_model->userId ();
		if (intval ( $user_id ) == 0) {
			exit ( 'Error! You are not logged in.' );
		}

		$media = $this->users_model->getUserPictureInfo ( $user_id );
		if (empty ( $media )) {
			exit ( 'no image' );
		} else {
			///	p($media);
			$media = json_encode ( $media );
			exit ( $media );
		}

	}
}



