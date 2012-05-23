<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width))
	$content_width = 584;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action('after_setup_theme','twentyeleven_setup');

if (!function_exists( 'twentyeleven_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', get_template_directory().'/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require(get_template_directory() . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require(get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'footer', __( 'Footer Menu', 'twentyeleven' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// Add support for custom backgrounds
	add_custom_background();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// The next four constants set how Twenty Eleven supports custom headers.

	// The default header text color
	define( 'HEADER_TEXTCOLOR', '000' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 1000 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 288 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Twenty Eleven's custom image sizes
	add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyeleven_admin_header_style(), below.
	add_custom_image_header( 'twentyeleven_header_style', 'twentyeleven_admin_header_style', 'twentyeleven_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'twentyeleven' )
		),
		'shore' => array(
			'url' => '%s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'twentyeleven' )
		),
		'trolley' => array(
			'url' => '%s/images/headers/trolley.jpg',
			'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Trolley', 'twentyeleven' )
		),
		'pine-cone' => array(
			'url' => '%s/images/headers/pine-cone.jpg',
			'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pine Cone', 'twentyeleven' )
		),
		'chessboard' => array(
			'url' => '%s/images/headers/chessboard.jpg',
			'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Chessboard', 'twentyeleven' )
		),
		'lanterns' => array(
			'url' => '%s/images/headers/lanterns.jpg',
			'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lanterns', 'twentyeleven' )
		),
		'willow' => array(
			'url' => '%s/images/headers/willow.jpg',
			'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Willow', 'twentyeleven' )
		),
		'hanoi' => array(
			'url' => '%s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'twentyeleven' )
		)
	) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // twentyeleven_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyeleven_continue_reading_link();
}
add_filter('excerpt_more', 'twentyeleven_auto_excerpt_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function twentyeleven_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function twentyeleven_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Sales Page Sidebar', 'twentyeleven' ),
		'id' => 'sales-page-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Auto Responder', 'twentyeleven' ),
		'id' => 'auto-responder',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area One', 'twentyeleven' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'twentyeleven' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'twentyeleven' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

function myformatTinyMCE($in){
	//$in['plugins']='inlinepopups,tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpfullscreen';
	$in['wpautop']=true;
	$in['width']='100%';
	$in['theme']='advanced';
	$in['skin']='wp_theme';
	
	
	$in['apply_source_formatting']=true;
	$in['extended_valid_elements']="b,i";
	$in['theme_advanced_buttons1']='date,save,formatselect,forecolor,bold,italic,underline,bullist,numlist,blockquote,'.
									'justifyleft,justifycenter,justifyright,justifyfull,link,unlink,wp_fullscreen';
	$in['theme_advanced_buttons2']='pastetext,pasteword,removeformat,charmap,outdent,indent,undo,redo,insertlayer,'.
									'moveforward,movebackward,absolute,styleprops,spellchecker,cite,abbr,acronym,del,'.
									'ins,attribs,visualchars,nonbreaking,styleselect,formatselect,fontselect,fontsizeselect';
	$in['theme_advanced_buttons3']='newdocument,strikethrough,cleanup,code,insertdate,inserttime,'.
									'preview,backcolor,media,advhr,print,ltr,rtl,cut,copy,paste,'.
									'replace,anchor,image,wp_help'.
									'tablecontrols,hr,visualaid,sub,sup,emotions,iespell,wp_more,wp_page,';
	return $in;
}
//add_filter('tiny_mce_before_init', 'myformatTinyMCE');
/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function twentyeleven_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;
						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if (!function_exists('twentyeleven_posted_on')):
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 * Create your own twentyeleven_posted_on to override in a child theme
	 *
	 * @since Twenty Eleven 1.0
	 */
	function twentyeleven_posted_on(){
		printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
			esc_url(get_permalink()),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
			get_the_author()
		);
	}
endif;
/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_body_classes( $classes ){
	if ( function_exists( 'is_multi_author' ) && ! is_multi_author())
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );
//adding the short-code to display the image.
function image_func($atts){
	extract(shortcode_atts(array(
		"src" => 'src not found'
	), $atts));
	$strarray = str_split($src, 50);

	return "<img src='$src' />";
}
add_shortcode('image','image_func');
include_once("themehooks.php");
//creating the short code for adding in the post.
function text2image_func($atts){
	
	extract(shortcode_atts(array(
			"text" => 'src not found',
			"fontname" => 'src not found',
			"color" => 'src not found'
	), $atts));
	
	$strarray=str_split($atts['text'],50);
	$font   = 20;
	$width  = ImageFontWidth($font) * strlen($atts['text']);
	$height = ImageFontHeight($font);
	$im = imagecreate(500, count($strarray)*15+20);
	$colorarray=array('red'=>'255,0,0',
					  'orange'=>'255,165,0',
					  'black'=>'0,0,0',
					  'brown'=>'165,42,42',
					  'yellow'=>'250,250,210',
					  'blue'=>'0,0,255',
	  				  'gold'=>'	255,215,0', 
					  'pink'=>'	255,192,203',
					  'violet'=>'238,130,238', 
					  'navy'=>'	0,0,128',
					  'cyan'=>'0,255,255',
					  'green'=>'0,250,154');
	$background_color = imagecolorallocate ($im,255,255,255);
	foreach($colorarray as $key=>$val){
		if($key==$atts['color']){
			$point=explode(',',$val);
			$text_color = imagecolorallocate ($im, $point[0],$point[1],$point[2]);
			break;
		}else{
			$text_color = imagecolorallocate ($im, 255,0,0);//red text
		}
	}
	$y=10;
	putenv('GDFONTPATH='.realpath(substr(__FILE__,0,strripos(__FILE__,'/')+1).'emmafont/'));
	$fontFamily = array('helvetica','arial','baubau','times new roman','arial','georgia','sans serif','courier new','verdana','arial black');
	if(in_array($atts['fontname'],$fontFamily)){
		 if(strtolower($atts['fontname'])=='arial'){
		 	$font1=substr(__FILE__,0,strripos(__FILE__,'/')+1).'emmafont/Noxchi_Arial.ttf';
		 }
		if(strtolower($atts['fontname'])=='sans serif'){
		 	$font1=substr(__FILE__,0,strripos(__FILE__,'/')+1).'emmafont/SansSerif.ttf';
		 }
	}
	
	foreach($strarray as $val){
		if($font1!=''){
			ImageTTFText($im,10,0,20, $y ,$text_color,$font1,$val);}else{
				imagestring($im,3, 20, $y,  $val, $text_color);
				}
		$y+=15;
	}
	// output the image
	imagepng($im,"textToImage.png");
	return "<img src='textToImage.png' />";
}
add_shortcode('text2image','text2image_func');

function my_theme_deactivate(){
	//global $wpdb;
    //$deleteSql="drop table if exists wp_records";
    //$wpdb->query($deleteSql);
 }
wp_register_theme_deactivation_hook('WP CopyWriter', 'my_theme_deactivate');
 
function emma_theme_init(){
	global $wpdb;
	$hostUrl=stripslashes(get_bloginfo('url')).'/wp-content/themes/wpcopywriter';
	$result=$wpdb->query("SELECT * FROM `wp_records` LIMIT 0 , 30 ");
	if(empty($result)){
 	          $createSql="CREATE TABLE IF NOT EXISTS wp_records(
					recordID int(11) primary key auto_increment,
					field_label varchar(255) NOT NULL,
					recordText varchar(255) default NULL,
					record_value varchar(10000) NOT NULL,
					recordListingID int(11) default NULL,
					section_no int(11) NOT NULL)";
		$wpdb->query($createSql);
		$wpdb->query("INSERT INTO `wp_records` VALUES(1, 'site_logo', '<label><b>Please specify the logo image source here.</b></label>
		<textarea name=''1''  id=''textarea_logo'' rows=''3'' cols=''25''></textarea>', '<h1><em>WP </em>Sale Page</h1>\r\n 
		 <div class=''head_ttl''>\r\n  <span><em><strong>Sale Page Writing Made Easy</strong></em></span>\r\n                            </div>\r\n                       ', 1, 1)");
		$wpdb->query("INSERT INTO `wp_records` VALUES(2, '', '<b>Logo can be placed here.</b>', '', 2, 1)");
		$wpdb->query("INSERT INTO `wp_records` VALUES(3, '', '<b>Logo can be placed here.</b>', '', 3, 1);");
		$wpdb->query("INSERT INTO `wp_records` VALUES(5, 'header_image_src', ' <label><b>Please specify the header image source here.</b></label></br><textarea name=''5''  id=''textarea_header'' rows=''5'' cols=''45''></textarea>', '<div class=''banner_pic_inr''>\r\n<img alt='''' src=''$hostUrl/images/banner_pic.png''>\r\n</div>\r\n        ', 1, 2)");
		$wpdb->query("INSERT INTO `wp_records` VALUES(6, 'header_content_src', ' <label><b>Please specify the header  content  here.</b></label></br><textarea name=''6''  id=''textarea_header_video'' rows=''5'' cols=''45''></textarea>',
		'<h1>
		<!--ADD YOUR TEXT HERE -->Do You Really Need To Pay So Much To Email Your Subscribers Every Month?</h1>
			<p>	
			<!--ADD YOUR TEXT HERE -->								   
				The answer is an emphatic NO.Sign up today for unlimited list size and unlimited emails for $1 Trial for 30 days and then 
			</p>
			 <div class=\"banner_btn\">
			 <!--ADD YOUR TEXT HERE -->
			 	<a href=\"<Paste your Payment Processor Link>\">$24.95 <em>only.</em></a>
			 </div>', 2, 2)");

		$test="echo '<label><b>Content Section.</b> </label>';";
		//$test.='$args = array("textarea_name" => "wpet_options[7]"); wp_editor($val->record_value, "wpet_options[7]", $args );';
		$test="echo \"<textarea name='7' class='ckeditor'>\$val->record_value</textarea>\";";
		$test=addslashes($test);
		$value='<ul style="list-style:none;">
							<li> 
								<div class="feature_bx_inr"> 
									<h1>
										<span class="heading">
											1 Create Attention
										</span>
									</h1> 
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
											Lorem Ipsum has been the industry'."''".'s standard dummy text ever since the 1500. 
									<h1>
										<span class="heading">
											2 Create Interest/Want/Highlight a problem
										</span>
									</h1> 
											Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
											Lorem Ipsum has been the industry'."''".'s standard dummy text ever since the 1500.		
									<h1>
										<span class="heading">
											3 Offer Solution
										</span>
									</h1> 
										Lorem Ipsum is simply dummy text of the printing and typesetting industry.
										Lorem Ipsum has been the industry'.'s standard dummy text ever since the 1500.
									<h1>
										<span class="heading">
											4 Show how your solution can help Your clients
										</span>
									</h1> 
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
									Lorem Ipsum has been the industry'."''".'s standard dummy text ever since the 1500.				
								</div>
							</li> 
						</ul>';
		$result=$wpdb->query("INSERT INTO `wp_records` VALUES(8, 'content_section','".$test."','".$value."', 1, 3)")or die(mysql_error());
		$wpdb->query("INSERT INTO `wp_records` VALUES(7, 'widget_section', '<label><b>Widget Section Goes Here.</b></label>', '', 3, 3);");
		$wpdb->query("INSERT INTO `wp_records` VALUES(9, 'social_links', '<label><b>Please specify the social links here.</b></label>
						<textarea name=''9''  id=''textarea_social_links'' rows=''3'' cols=''45''></textarea>', '<div class=''rt''>\r\n  <ul>\r\n  <li class=''first''> Connect with Us\r\n </li>\r\n <li style=''float: left; overflow: hidden; width: 200px;''><a href=''<ADD YOUR FB ID HERE>''><img src=''".get_bloginfo('url')."/wp-content/themes/wpcopywriter/images/fb.png'' alt='''' /></a></li>\r\n                <li><a href=''<ADD YOUR Twitter ID HERE>''><img src=''".get_bloginfo('url')."/wp-content/themes/wpcopywriter/images/tw.png'' alt='''' /></a></li>\r\n                <li><a href=''<ADD YOUR Linkdin ID HERE>''><img src=''".get_bloginfo('url')."/wp-content/themes/wpcopywriter/images/in.png'' alt='''' /></a></li>\r\n                <li><a href=''<ADD YOUR GOOGLE PLUS ID HERE>''><img src=''".get_bloginfo('url')."/wp-content/themes/wpcopywriter/images/google-plus.png'' alt='''' /></a></li>\r\n             </ul>\r\n        </div> ', 2, 4);");
		
		$wpdb->query("INSERT INTO `wp_records` VALUES(10, 'copyright_text', '<label><b>Please specify the copyright  text here.</b></label><textarea name=''10''  id=''textarea_copyright_section'' rows=''3'' cols=''45''></textarea>', '  <div class=''lt''>\r\n        Copyright © 2009-2012 wp-sales-page.com. All Rights Reserved.\r\n        </div>', 1, 4);");
		$test="echo '<label><b>Right Content Section.</b> </label>';";
		//$test.='$args = array("textarea_name" => "wpet_options[8]"); wp_editor($val->record_value, "wpet_options[8]", $args );';
		$test="echo \"<textarea name='8' class='ckeditor'>\$val->record_value</textarea>\";";
		$test=addslashes($test);
		$value='<ul style="list-style:none;"> 	
					<li>
			            <div class="feature_bx_inr">
			               	<h1>
					<span class="heading">
						5 What would clients get when they buy this product? 
					</span>
				</h1> 
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'."''".'s standard dummy text ever since the 1500. 
				<h1>
										<span class="heading">
											6 Call to action
										</span>
									</h1> 
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'."''".'s standard dummy text ever since the 1500.  
							
				<h1>
					<span class="heading">
						7 What have happy users said?  
					</span>
				</h1> 
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'."''".'s standard dummy text ever since the 1500. 
				
			            </div>
			        </li>
			</ul>';
$wpdb->query("INSERT INTO `wp_records` VALUES(11, 'content_section1','".$test."','".$value."', 2, 3)")or die(mysql_error());
$wpdb->query("INSERT INTO `wp_records` VALUES(12, 'header_image_src1', ' <label><b>Please specify the header image source here.</b></label></br>
             <textarea name=''5''  id=''textarea_header'' rows=''3'' cols=''45''></textarea>',
             '<div class=''banner_pic_inr''>\r\n<img alt=''''
             src=''$hostUrl/images/banner_pic.png''>\r\n</div>\r\n
             ', 1, 5)"); 
}		
	if(get_option('googleAnalyticsCode')=='')
	add_option('googleAnalyticsCode',stripslashes('<script type="text/javascript"></script>'));
	if(get_option('headerslider_1')=='')
	add_option('headerslider_1',stripslashes(get_bloginfo('url').'/wp-content/themes/wpcopywriter/images/header_4.jpg'),'yes');
	if(get_option('headerslider_2')=='')
	add_option('headerslider_2',stripslashes(get_bloginfo('url').'/wp-content/themes/wpcopywriter/images/header_3.jpg'),'yes');
	if(get_option('headerslider_3')=='')
	add_option('headerslider_3',stripslashes(get_bloginfo('url').'/wp-content/themes/wpcopywriter/images/header_5.png'),'yes');
	if(get_option('headerslider_4')=='')
	add_option('headerslider_4',stripslashes(get_bloginfo('url').'/wp-content/themes/wpcopywriter/images/header_1.jpg'),'yes');
	if(get_option('headerslider_5')=='')
	add_option('headerslider_5',stripslashes(get_bloginfo('url').'/wp-content/themes/wpcopywriter/images/header_2.jpg'),'yes');
}


wp_register_theme_activation_hook('Emma','emma_theme_init');
function wp_register_theme_activation_hook($code, $function){
    if(get_option('current_theme')=='WP CopyWriter'){
        call_user_func($function);
        update_option($optionKey , 1);
    }
}



add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Testimonial' ),
				'edit' => __( 'Edit' ),
				'edit_item' => __( 'Edit Testimonial' ),
				'new_item' => __( 'New Testimonial' ),
				'view' => __( 'View Testimonial' ),
				'view_item' => __( 'View Testimonial' ),
				'search_items' => __( 'Search Testimonial' ),
				'not_found' => __( 'No Testimonials found' ),
				'not_found_in_trash' => __( 'No Testimonials found in Trash' ),
				'parent' => __( 'Parent Testimonial' )
			),
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail' ),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'testimonials')
		)
	);
}
