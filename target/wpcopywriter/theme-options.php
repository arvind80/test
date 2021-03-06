<?php
/**
 * Twenty Eleven Theme Options
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since Twenty Eleven 1.0
 *
 */
function twentyeleven_admin_enqueue_scripts( $hook_suffix ) {
	
	wp_enqueue_style( 'twentyeleven-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2011-04-28' );
	wp_enqueue_script( 'twentyeleven-theme-options', get_template_directory_uri() . '/inc/theme-options.js', array( 'farbtastic' ), '2011-06-10' );
	wp_enqueue_script(  get_template_directory_uri() . '/inc/jquery-1.3.2.min.js');
	wp_enqueue_script(  get_template_directory_uri() . '/inc/jquery-ui-1.7.1.custom.min.js');
	
	wp_enqueue_style( 'farbtastic' );
	
}

add_action( 'admin_print_styles-appearance_page_theme_options', 'twentyeleven_admin_enqueue_scripts' );

/**
 * Register the form setting for our twentyeleven_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, twentyeleven_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_theme_options_init(){

	// If we have no options in the database, let's add them now.
	if ( false === twentyeleven_get_theme_options() )
		add_option( 'twentyeleven_theme_options', twentyeleven_get_default_theme_options() );

	register_setting(
		'twentyeleven_options',       // Options group, see settings_fields() call in twentyeleven_theme_options_render_page()
		'twentyeleven_theme_options', // Database option, see twentyeleven_get_theme_options()
		'twentyeleven_theme_options_validate' // The sanitization callback, see twentyeleven_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see twentyeleven_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'color_scheme',  // Unique identifier for the field for this section
		__( 'Color Scheme', 'twentyeleven' ), // Setting field label
		'twentyeleven_settings_field_color_scheme', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see twentyeleven_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);

	add_settings_field( 'link_color', __( 'Link Color',     'twentyeleven' ), 'twentyeleven_settings_field_link_color', 'theme_options', 'general' );
	add_settings_field( 'layout',     __( 'Default Layout', 'twentyeleven' ), 'twentyeleven_settings_field_layout',     'theme_options', 'general' );
}
add_action( 'admin_init', 'twentyeleven_theme_options_init' );

/**
 * Change the capability required to save the 'twentyeleven_options' options group.
 *
 * @see twentyeleven_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see twentyeleven_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * By default, the options groups for all registered settings require the manage_options capability.
 * This filter is required to change our theme options page to edit_theme_options instead.
 * By default, only administrators have either of these capabilities, but the desire here is
 * to allow for finer-grained control for roles and users.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function twentyeleven_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_twentyeleven_options', 'twentyeleven_option_page_capability' );

/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'twentyeleven' ),   // Name of page
		__( 'Theme Options', 'twentyeleven' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'twentyeleven_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;

	add_action( "load-$theme_page", 'twentyeleven_theme_options_help' );
}
add_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );

function twentyeleven_theme_options_help() {

	$help = '<p>' . __( 'Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, Twenty Eleven, provides the following Theme Options:', 'twentyeleven' ) . '</p>' .
			'<ol>' .
				'<li>' . __( '<strong>Color Scheme</strong>: You can choose a color palette of "Light" (light background with dark text) or "Dark" (dark background with light text) for your site.', 'twentyeleven' ) . '</li>' .
				'<li>' . __( '<strong>Link Color</strong>: You can choose the color used for text links on your site. You can enter the HTML color or hex code, or you can choose visually by clicking the "Select a Color" button to pick from a color wheel.', 'twentyeleven' ) . '</li>' .
				'<li>' . __( '<strong>Default Layout</strong>: You can choose if you want your site&#8217;s default layout to have a sidebar on the left, the right, or not at all.', 'twentyeleven' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'twentyeleven' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 'twentyeleven' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'twentyeleven' ) . '</p>' .
		'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'twentyeleven' ) . '</p>';

	$screen = get_current_screen();

	if ( method_exists( $screen, 'add_help_tab' ) ) {
		// WordPress 3.3
		$screen->add_help_tab( array(
			'title' => __( 'Overview', 'twentyeleven' ),
			'id' => 'theme-options-help',
			'content' => $help,
			)
		);

		$screen->set_help_sidebar( $sidebar );
	} else {
		// WordPress 3.2
		add_contextual_help( $screen, $help . $sidebar );
	}
}

/**
 * Returns an array of color schemes registered for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_color_schemes() {
	$color_scheme_options = array(
		'light' => array(
			'value' => 'light',
			'label' => __( 'Light', 'twentyeleven' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/light.png',
			'default_link_color' => '#1b8be0',
		),
		'dark' => array(
			'value' => 'dark',
			'label' => __( 'Dark', 'twentyeleven' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/dark.png',
			'default_link_color' => '#e4741f',
		),
	);

	return apply_filters( 'twentyeleven_color_schemes', $color_scheme_options );
}

/**
 * Returns an array of layout options registered for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_layouts() {
	$layout_options = array(
		'content-sidebar' => array(
			'value' => 'content-sidebar',
			'label' => __( 'Content on left', 'twentyeleven' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content-sidebar.png',
		),
		'sidebar-content' => array(
			'value' => 'sidebar-content',
			'label' => __( 'Content on right', 'twentyeleven' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/sidebar-content.png',
		),
		'content' => array(
			'value' => 'content',
			'label' => __( 'One-column, no sidebar', 'twentyeleven' ),
			'thumbnail' => get_template_directory_uri() . '/inc/images/content.png',
		),
	);

	return apply_filters( 'twentyeleven_layouts', $layout_options );
}

/**
 * Returns the default options for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'light',
		'link_color'   => twentyeleven_get_default_link_color( 'light' ),
		'theme_layout' => 'content-sidebar',
	);

	if ( is_rtl() )
 		$default_theme_options['theme_layout'] = 'sidebar-content';

	return apply_filters( 'twentyeleven_default_theme_options', $default_theme_options );
}

/**
 * Returns the default link color for Twenty Eleven, based on color scheme.
 *
 * @since Twenty Eleven 1.0
 *
 * @param $string $color_scheme Color scheme. Defaults to the active color scheme.
 * @return $string Color.
*/
function twentyeleven_get_default_link_color( $color_scheme = null ) {
	if ( null === $color_scheme ) {
		$options = twentyeleven_get_theme_options();
		$color_scheme = $options['color_scheme'];
	}

	$color_schemes = twentyeleven_color_schemes();
	if ( ! isset( $color_schemes[ $color_scheme ] ) )
		return false;

	return $color_schemes[ $color_scheme ]['default_link_color'];
}

/**
 * Returns the options array for Twenty Eleven.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_get_theme_options() {
	return get_option( 'twentyeleven_theme_options', twentyeleven_get_default_theme_options() );
}

/**
 * Renders the Color Scheme setting field.
 *
 * @since Twenty Eleven 1.3
 */
function twentyeleven_settings_field_color_scheme() {
	$options = twentyeleven_get_theme_options();

	foreach ( twentyeleven_color_schemes() as $scheme ) {
	?>
	<div class="layout image-radio-option color-scheme">
	<label class="description">
		<input type="radio" name="twentyeleven_theme_options[color_scheme]" value="<?php echo esc_attr( $scheme['value'] ); ?>" <?php checked( $options['color_scheme'], $scheme['value'] ); ?> />
		<input type="hidden" id="default-color-<?php echo esc_attr( $scheme['value'] ); ?>" value="<?php echo esc_attr( $scheme['default_link_color'] ); ?>" />
		<span>
			<img src="<?php echo esc_url( $scheme['thumbnail'] ); ?>" width="136" height="122" alt="" />
			<?php echo $scheme['label']; ?>
		</span>
	</label>
	</div>
	<?php
	}
}

/**
 * Renders the Link Color setting field.
 *
 * @since Twenty Eleven 1.3
 */
function twentyeleven_settings_field_link_color() {
	$options = twentyeleven_get_theme_options();
	?>
	<input type="text" name="twentyeleven_theme_options[link_color]" id="link-color" value="<?php echo esc_attr( $options['link_color'] ); ?>" />
	<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
	<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color', 'twentyeleven' ); ?>" />
	<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
	<br />
	<span><?php printf( __( 'Default color: %s', 'twentyeleven' ), '<span id="default-color">' . twentyeleven_get_default_link_color( $options['color_scheme'] ) . '</span>' ); ?></span>
	<?php
}

/**
 * Renders the Layout setting field.
 *
 * @since Twenty Eleven 1.3
 */
function twentyeleven_settings_field_layout() {
	$options = twentyeleven_get_theme_options();
	foreach ( twentyeleven_layouts() as $layout ) {
		?>
		<div class="layout image-radio-option theme-layout">
		<label class="description">
			<input type="radio" name="twentyeleven_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
			<span>
				<img src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
				<?php echo $layout['label']; ?>
			</span>
		</label>
		</div>
		<?php
	}
}

/**
 * Returns the options array for Twenty Eleven.
 *
 * @since Twenty Eleven 1.2
 */
function twentyeleven_theme_options_render_page(){
	
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf(__( '%s Theme Options', 'twentyeleven' ), get_current_theme() ); ?></h2>
		<?php settings_errors();
		?>
		<style>
			body {font-family: Arial, Helvetica, sans-serif;font-size: 16px;margin-top: 10px;}
			ul{margin: 0;}
			#contentWrap {width: 700px;margin: 0 auto;height: auto;overflow: hidden;}
			#contentTop {width: 600px;padding: 10px;margin-left: 30px;}
			#contentLeft {float: left;width: 400px;}
			#contentLeft li {list-style: none;margin: 0 0 4px 0;padding: 10px;background-color:#00CCCC;border: #CCCCCC solid 1px;color:#fff;}
			#contentRight {float: right;width: 260px;padding:10px;background-color:#336600;color:#FFFFFF;}
		</style>
		<style type="text/css">
			.main_wraper{ float:left; width:90%; padding:1% 5%;}
			.main_wraper .header{ float:left; width:100%;}
			.header .block_wraper{ float:left;border: 5px solid green;min-height: 100px;margin:10px;padding:5px; width:30%;}
			.header .block_wraper_middle{ float:left; width:30%; margin-left:5%; background:#999999;}
			.header .block_wraper_right{ float:right; width:30%; background:#999999;}
			.main_wraper .middle_wraper{ float:left; width:100%; padding-top:10px;}
			.middle_wraper .banner_left{ float:left; width:65%;  background:#006699;}
			.middle_wraper .banner_right{ float:right; width:33%; background:#003333;}
			.middle_wraper .bottam_partleft{ float:left; width:60%; background:#00FF66;}
			.middle_wraper .bottam_partright{ float:right; width:37%; background:#00FF66;}
			.middle_wraper .fotter_left{ float:left; width:80%; background:#993300;} 
			.middle_wraper .fotter_right{ float:right; width:17%; background:#006633;} 
		</style>
		<script type="text/javascript" src="<?php echo bloginfo('template_url'); ?>/inc/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php echo bloginfo('template_url'); ?>/inc/jquery-ui-1.8.6.custom.min.js"></script>
		<input type="hidden" id="path" value="<?php echo bloginfo('template_url'); ?>"></input>
		<script type="text/javascript">
			$(document).ready(function(){ 					   
				$(function(){
					
					$("#header").sortable({ opacity: 0.6, cursor: 'move', update: function() {
						var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
						var path1=$("#path").val();
						$.post(path1+"/inc/updateDB.php", order, function(theResponse){
							//$("#contentRight").html(theResponse);
						}); 															 
					}								  
					});
					
					$("#middle_wrapper").sortable({ opacity: 0.6, cursor: 'move', update: function() {
						var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
						var path1=$("#path").val();
						$.post(path1+"/inc/updateDB.php", order, function(theResponse){
							//$("#contentRight").html(theResponse);
						}); 															 
					}								  
					});
					
					
					$("#middle_wraper1").sortable({ opacity: 0.6, cursor: 'move', update: function() {
						var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
						var path1=$("#path").val();
						$.post(path1+"/inc/updateDB.php", order, function(theResponse){
							//$("#contentRight").html(theResponse);
						}); 															 
					}								  
					});
					
					$("#middle_wraper2").sortable({ opacity: 0.6, cursor: 'move', update: function() {
						var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
						var path1=$("#path").val();
						$.post(path1+"/inc/updateDB.php", order, function(theResponse){
							//$("#contentRight").html(theResponse);
						}); 															 
					}								  
					});
				});
			});	
		</script>

		<form method="post" action="<?php echo get_bloginfo('siteurl');?>/wp-admin/themes.php?page=theme_options">
		<!-- New Design-->
			<div class="main_wraper">
				<!--header part-->
				<div  id="header" class="header">
					<?php
					global $wpdb;
			
					if(isset($_POST['1']) && $_POST['1']!=''){
						$wpdb->query("Update wp_records set record_value='".$_POST['1']."' where recordID=1");
					}
					
					//google analytics code setting ends here.
					if(isset($_POST['googleAnalyticsCode']) && $_POST['googleAnalyticsCode']!=''){
						if(get_option('googleAnalyticsCode')==''){
						 add_option( 'googleAnalyticsCode', $_POST['googleAnalyticsCode']);}
						else{
							 update_option( 'googleAnalyticsCode', $_POST['googleAnalyticsCode']);
						}
					}
					//code for google analytics ends here.
					
					if(isset($_POST['5']) && $_POST['5']!=''){
						$wpdb->query("Update wp_records set record_value='".$_POST['5']."' where recordID=5");
					}
					
					if(isset($_POST['6']) && $_POST['6']!=''){
						$wpdb->query("Update wp_records set record_value='".$_POST['6']."' where recordID=6");
					}
			
					if(isset($_POST['wpet_options'][7]) && $_POST['wpet_options'][7]!=''){
						$wpdb->query("Update wp_records set record_value='".$_POST['wpet_options'][7]."' where recordID=7");
					}
					
					if(isset($_POST['9']) && $_POST['9']!=''){
						$wpdb->query("Update wp_records set record_value='".$_POST['9']."' where recordID=9");
					}
					
					if(isset($_POST['10']) && $_POST['10']!=''){
						$wpdb->query("Update wp_records set record_value='".$_POST['10']."' where recordID=10");
					}
					
					$myrows = $wpdb->get_results("SELECT recordID, recordText,record_value FROM  wp_records where section_no=1 order by recordListingID");
					foreach($myrows as $val){
						
						if($val->recordText!=''){
							$textarea_logo=str_replace("</textarea>",$val->record_value."</textarea>",$val->recordText);
						}                                     
						?>
							<div class="block_wraper" style="width:auto;width:300px;" id="recordsArray_<?php echo $val->recordID; ?>"><?php  echo $textarea_logo; ?>
							
							</div>
						<?php 
					} 
					
					//fetching all the record from the database.
					$records_value = $wpdb->get_results("SELECT recordID, record_value FROM  wp_records where recordID in(1,5,6,7,9,10) order by recordID");
					?>
					
				</div>
				
				<div class="header" style="height:100px;">
					
				</div>
				<!--header part Close-->
				<!--Middle_part-->
				<div id="middle_wrapper" class="header">
				<?php settings_fields('wpet_plugin_options'); ?>
			<?php $options = get_option('wpet_options'); ?>
						<?php
						$count=0;
						$myrows = $wpdb->get_results("SELECT recordID, recordText,record_value FROM  wp_records where section_no=2 order by recordListingID");
						foreach($myrows as $val){
							if($val->recordText!=''){
								$textarea_section_no2=str_replace("</textarea>",$val->record_value."</textarea>",$val->recordText);
							}   
							$count++;
							if($count==1){                                  
						?>
							<div class="block_wraper" style="width:46%" id="recordsArray_<?php echo $val->recordID; ?>"><?php echo $textarea_section_no2; ?></div>
						<?php 
						}else{
							if($count==2){
								?>
								<div  class="block_wraper" style="width:46%" id="recordsArray_<?php echo $val->recordID;?>"><?php echo $textarea_section_no2; ?></div>
								<?php
							}
						} }
						$count=0;?>
				</div>
				<div class="header" style="height:100px;">
					
				</div>
				<!--Middle Part close-->
				<!--Middle_part-->
				<div id="middle_wraper1" class="header">
					<?php
						 $count=0;
						$myrows = $wpdb->get_results("SELECT recordID, recordText,record_value FROM  wp_records where section_no=3 order by recordListingID");
						
						foreach($myrows as $val){
								if($val->recordText!=''){
									$textarea_section_no3=str_replace("</textarea>",$val->record_value."</textarea>",$val->recordText);
								}  
								$count++;
								if($count==1){                                  
									?>
										<div class="block_wraper" style="width:46%" id="recordsArray_<?php echo $val->recordID; ?>"><?php if($val->recordText!='')eval($val->recordText); ?></div>
									<?php 
									}else{
										if($count==2){
											?>
											<div  class="block_wraper" style="width:46%" id="recordsArray_<?php echo $val->recordID;?>"><?php if($val->recordText!='')eval($val->recordText); ?></div>
											<?php
										}
									} 
							}
						$count=0;?>
				</div>
				<div class="header" style="height:100px;">
					
				</div>
			
				<div id="middle_wraper2" class="header">
					<?php
						
						
						$myrows = $wpdb->get_results("SELECT recordID, recordText,record_value FROM  wp_records where section_no=4 order by recordListingID limit 0,2");
						foreach($myrows as $val){ 
							if($val->recordText!=''){
								$textarea_section_no4=str_replace("</textarea>",$val->record_value."</textarea>",$val->recordText);
							}  
							$count++;
							if($count==1){                                  
						?>
							<div  class="block_wraper" style="width:46%" id="recordsArray_<?php echo $val->recordID; ?>"><?php echo $textarea_section_no4; ?></div>
						<?php 
						}else{
							if($count<=2){
								?>
								 <div  class="block_wraper" style="width:46%" id="recordsArray_<?php echo $val->recordID; ?>"><?php echo $textarea_section_no4;?></div>
							<?php }
						} }
						$count=0;?>
				</div>
				<div class="header" style="height:100px;">
				</div>
				
				
				<div id="middle_wraper2" class="header">
					<div class="block_wraper" style="width:46%">
						<p>Paste your google analytice code here.</p>
						<textarea name="googleAnalyticsCode" id="googleAnalyticsCode" rows="5" cols="40"><?php //echo get_option('googleAnalyticsCode'); ?></textarea>
					</div>
				</div>
				<div class="header" style="height:100px;">
				</div>
				
				<!--Middle Part close-->
			</div>
			<?php 
				//settings_fields( 'twentyeleven_options' );
				//do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}
/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see twentyeleven_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_theme_options_validate( $input ) {
	$output = $defaults = twentyeleven_get_default_theme_options();

	// Color scheme must be in our array of color scheme options
	if ( isset( $input['color_scheme'] ) && array_key_exists( $input['color_scheme'], twentyeleven_color_schemes() ) )
		$output['color_scheme'] = $input['color_scheme'];

	// Our defaults for the link color may have changed, based on the color scheme.
	$output['link_color'] = $defaults['link_color'] = twentyeleven_get_default_link_color( $output['color_scheme'] );

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
		$output['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Theme layout must be in our array of theme layout options
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], twentyeleven_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];

	return apply_filters( 'twentyeleven_theme_options_validate', $output, $input, $defaults );
}

/**
 * Enqueue the styles for the current color scheme.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_enqueue_color_scheme() {
	$options = twentyeleven_get_theme_options();
	$color_scheme = $options['color_scheme'];

	if ( 'dark' == $color_scheme )
		wp_enqueue_style( 'dark', get_template_directory_uri() . '/colors/dark.css', array(), null );

	do_action( 'twentyeleven_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'twentyeleven_enqueue_color_scheme' );

/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the wp_head action hook.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_print_link_color_style() {
	$options = twentyeleven_get_theme_options();
	$link_color = $options['link_color'];

	$default_options = twentyeleven_get_default_theme_options();

	// Don't do anything if the current link color is the default.
	if ( $default_options['link_color'] == $link_color )
		return;
?>
	<style>
		/* Link color */
		a,
		#site-title a:focus,
		#site-title a:hover,
		#site-title a:active,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-title a:active,
		.widget_twentyeleven_ephemera .comments-link a:hover,
		section.recent-posts .other-recent-posts a[rel="bookmark"]:hover,
		section.recent-posts .other-recent-posts .comments-link a:hover,
		.format-image footer.entry-meta a:hover,
		#site-generator a:hover {
			color: <?php echo $link_color; ?>;
		}
		section.recent-posts .other-recent-posts .comments-link a:hover {
			border-color: <?php echo $link_color; ?>;
		}
		article.feature-image.small .entry-summary p a:hover,
		.entry-header .comments-link a:hover,
		.entry-header .comments-link a:focus,
		.entry-header .comments-link a:active,
		.feature-slider a.active {
			background-color: <?php echo $link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'twentyeleven_print_link_color_style' );

/**
 * Adds Twenty Eleven layout classes to the array of body classes.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_layout_classes( $existing_classes ) {
	$options = twentyeleven_get_theme_options();
	$current_layout = $options['theme_layout'];

	if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) )
		$classes = array( 'two-column' );
	else
		$classes = array( 'one-column' );

	if ( 'content-sidebar' == $current_layout )
		$classes[] = 'right-sidebar';
	elseif ( 'sidebar-content' == $current_layout )
		$classes[] = 'left-sidebar';
	else
		$classes[] = $current_layout;

	$classes = apply_filters( 'twentyeleven_layout_classes', $classes, $current_layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'twentyeleven_layout_classes' );
