<?php
 
global $cms_db_tables;

$this->users_model->notificationsParseFromLog ();
$table = $cms_db_tables ['table_users'];

$this->template ['load_tiny_mce'] = true;

$layout = false;

$global_template_replaceables = false;

$content = array ();

$content ['content_layout_file'] = 'default_layout.php';

$user_action = $this->core_model->getParamFromURL ( 'action' );

$the_active_site_template = $this->content_model->optionsGetByKey ( 'curent_template' );

$the_active_site_template_dir = TEMPLATEFILES . $the_active_site_template . '/';

if (defined ( 'ACTIVE_TEMPLATE_DIR' ) == false) {

	define ( 'ACTIVE_TEMPLATE_DIR', $the_active_site_template_dir );

}

$the_active_site_template = $this->content_model->optionsGetByKey ( 'curent_template' );

$the_active_site_template_dir = TEMPLATEFILES . $the_active_site_template . '/';

$the_template_url = site_url ( 'userfiles/' . TEMPLATEFILES_DIRNAME . '/' . $the_active_site_template );

$the_template_url = $the_template_url . '/';

define ( "TEMPLATE_URL", $the_template_url );

$user_session = array ();

$user_session = $this->session->userdata ( 'user_session' );
$the_user = $this->session->userdata ( 'the_user' );

$user = $this->session->userdata ( 'user' );
//		var_dump( $user_session);
//
$the_userid = false;
if (intval ( $the_user ['id'] ) != 0) {
	$the_userid = $this->users_model->userId ();
} else {
	$the_userid = $the_user ['id'];
}

if ($user_session ['is_logged'] != 'yes') {

	// 	var_dump($user_session);
	if (($user_action == 'message_compose') and ($user_action != 'login_ajax')) {
		$referer = isset ( $_SERVER ['HTTP_REFERER'] ) ? $_SERVER ['HTTP_REFERER'] : '';
		if ($referer != '') {
			$backto = '/back_to:' . base64_encode ( $referer );

		}
		redirect ( 'users/user_action:login_ajax' . $backto );
	} else {

		if (($user_action != 'login') && ($user_action != 'login_ajax') && ($user_action != 'register') && ($user_action != 'forgotten_pass') && ($user_action != 'activate')) {
			redirect ( 'users/user_action:login' );
		}
	}
} else {

	require (APPPATH . 'controllers/advanced/users/force_profile_complete.php');
}

/*~~~~~~~ Template initializations ~~~~~~~~~~*/

// set current user
$currentUser = $user;
if (intval ( $currentUser ['id'] ) == 0) {
	$the_user = $this->session->userdata ( 'the_user' );
	$currentUser = $the_user;
}

$this->template ['current_user'] = $currentUser;

/*~~~~~~ Following and followers ~~~~~~~*/

// get all relations that user take part
$relations_options = array ();
$relations_options ['order'] = array ('RAND()', ' ' );
$relations_options ['limit'] = 20;

$this->template ['followers_ids'] = $followersIds;
$this->template ['circle_of_influence_ids'] = $circleOfInfluenceIds;

/*~~~~~~~~ End of Following and followers ~~~~~~~~~~*/

$this->load->vars ( $this->template );

switch ($user_action) {

	case 'test' :
		break;

	case 'messages' :

		require (APPPATH . 'controllers/advanced/dashboard/messages.php');

		break;

	case 'message_compose' :

		require (APPPATH . 'controllers/advanced/dashboard/message_compose.php');

		break;

	case 'notifications' :
		require (APPPATH . 'controllers/advanced/dashboard/notifications.php');

		break;

	case 'followers' :
		require (APPPATH . 'controllers/advanced/dashboard/followers.php');

		break;

	case 'following' :
		//$is_special = 'n';
		include (APPPATH . 'controllers/advanced/dashboard/following.php');

		break;

	case 'circle-of-influence' :
		$is_special = 'y';
		include (APPPATH . 'controllers/advanced/dashboard/following.php');

		break;

	case 'index' :
	case 'dashboard' :
	case 'live' :
	default :

		include (APPPATH . 'controllers/advanced/dashboard/index.php');

		break;

}

//$content ['content_filename'] = 'dashboard/index.php';
$user_session ['user_action'] = $user_action;

$this->template ['user_action'] = $user_action;

$this->load->vars ( $this->template );

$this->session->set_userdata ( 'user_session', $user_session );

if (trim ( $content ['content_filename'] ) != '') {

	if (is_readable ( $the_active_site_template_dir . $content ['content_filename'] ) == true) {

		$this->load->vars ( $this->template );

		$content_filename_pre = $this->load->file ( $the_active_site_template_dir . $content ['content_filename'], true );

		$this->load->vars ( $this->template );

	} else {

		header ( "HTTP/1.1 500 Internal Server Error" );

		show_error ( "File {$content ['content_filename']} is not readable or doesn't exist in the templates directory!" );

		exit ();

	}

}
if ($no_layout == false) {
	if (is_readable ( $the_active_site_template_dir . 'dashboard/layout.php' ) == true) {

		$this->load->vars ( $this->template );

		$layout = $this->load->file ( $the_active_site_template_dir . 'dashboard/layout.php', true );

	}
} else {
	$layout = '{content}';
}

if (trim ( $content ['content_filename'] ) != '') {

	if (is_readable ( $the_active_site_template_dir . $content ['content_filename'] ) == true) {

		$this->load->vars ( $this->template );

		$content_filename = $this->load->file ( $the_active_site_template_dir . $content ['content_filename'], true );

		$layout = str_ireplace ( '{content}', $content_filename, $layout );

	//	$layout = str_ireplace ( '{content}', $content_filename_pre, $layout );
	}

}

$layout = $this->content_model->applyGlobalTemplateReplaceables ( $layout );

//		p($layout, 1);


$this->output->set_output ( $layout );

?>