<?php
/*
Plugin Name: WP Editor Test
Plugin URI: http://www.presscoders.com/
Description: Test Plugin to get the WP editor working on a Plugin admin page.
Version: 0.1
Author: David Gwyer
Author URI: http://www.presscoders.com
*/
 
// Init plugin options to white list our options
function wpet_init(){
	register_setting( 'wpet_plugin_options', 'wpet_options', 'wpet_validate_options' );
}
add_action('admin_init', 'wpet_init' );
 
// Add menu page
function wpet_add_options_page(){
	add_options_page('WP Editor Test', 'WP Editor Test', 'manage_options', __FILE__, 'wpet_render_form');
}
add_action('admin_menu', 'wpet_add_options_page');
 
// Render the Plugin options form
function wpet_render_form() {
	?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>WP Editor Test</h2>
		<form method="post" action="options.php">
			<?php settings_fields('wpet_plugin_options'); ?>
			<?php $options = get_option('wpet_options'); ?>
 
			<table class="form-table">
				<tr>
					<td>
						<h3>TinyMCE - Editor 1</h3>
						<?php
							$args = array("textarea_name" => "wpet_options[textarea_one]");
							wp_editor( $options['textarea_one'], "wpet_options[textarea_one]", $args );
						?>
					</td>
				</tr>
				<tr>
					<td>
						<h3>TinyMCE - Editor 2</h3>
						<?php
							$args = array("textarea_name" => "wpet_options[textarea_two]");
							wp_editor( $options['textarea_two'], "wpet_options[textarea_two]", $args );
						?>
					</td>
				</tr>
				<tr>
					<td>
						<h3>Textarea - Editor 3</h3>
						<textarea id="wpet_options[textarea_three]" name="wpet_options[textarea_three]" rows="7" cols="150" type='textarea'><?php echo $options['textarea_three']; ?></textarea>
					</td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php	
}
 
// Sanitize and validate input. Accepts an array, return a sanitized array.
function wpet_validate_options($input) {
	// Sanitize textarea input (strip html tags, and escape characters)
	$input['textarea_one'] = wp_filter_nohtml_kses($input['textarea_one']);
	$input['textarea_two'] = wp_filter_nohtml_kses($input['textarea_two']);
	$input['textarea_three'] = wp_filter_nohtml_kses($input['textarea_three']);
	return $input;
}
