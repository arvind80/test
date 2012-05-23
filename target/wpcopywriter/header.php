<?php
/**
 * The Header for our theme.
 * Displays all of the <head> section and everything up till <div id="main">
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html   xmlns:fb="http://ogp.me/ns/fb#">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width"/>
<title><?php
	global $page, $paged;
	wp_title( '|',true,'right');
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui-1.8.6.custom.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cycle.lite.1.0.min.js" type="text/javascript"></script>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<style type="text/stylesheet">
.connect_widget_summary .connect_widget_text{display:none;}
</style>		
<!--[if lt IE 9]>

<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>

<![endif]-->

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	
	echo stripslashes(get_option('googleAnalyticsCode'));
	$sitelogo = $wpdb->get_results("SELECT recordID, recordText,record_value,recordListingID FROM  wp_records where section_no=1 and field_label='site_logo'");
?>
</head>
<body>

<div class="main">
	<div class="main_inr">
    	<div class="head">
        	<div class="head_l">
            	<div class="head_r">
                	<div class="head_m">
                	<div id="fb-root"></div>
                	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                	
                        	<?php 
                        	global $widget_margin;
                        	$enable_slider=get_option('enable_slider');
                        	$site_header_content = $wpdb->get_results("SELECT recordID, recordText,record_value,field_label,recordListingID FROM  wp_records where section_no=5");
	                        		if($enable_slider==1){
						echo "<div class='headerslider'>";
	                        			echo "<img style='postion:relative;width:1000px;height:150px;border-radius: 10px 10px 0 0;height: 132px;' src=".get_option('headerslider_1').">";
	                        			echo "<img style='postion:relative;width:1000px;height:150px;border-radius: 10px 10px 0 0;height: 132px;' src=".get_option('headerslider_2').">";
	                        			echo "<img style='postion:relative;width:1000px;height:150px;border-radius: 10px 10px 0 0;height: 132px;' src=".get_option('headerslider_3').">";
	                        			echo "<img style='postion:relative;width:1000px;height:150px;border-radius: 10px 10px 0 0;height: 132px;' src=".get_option('headerslider_4').">";
	                        			echo "<img style='postion:relative;width:1000px;height:150px;border-radius: 10px 10px 0 0;height: 132px;' src=".get_option('headerslider_5').">";
	                        		echo "</div>";
						}else{
							echo "<div class='headertext'>";
	                        	 if($sitelogo[0]->recordListingID==1){
	                        	 	 echo "<div class='head_shadow'style=''>";
	                        	 	 echo $sitelogo[0]->record_value;
	                        	 }elseif($sitelogo[0]->recordListingID==2){
	                        	 	 echo "<div class='head_shadow' style='padding-left: 322px;'>";
	                        	 	 echo $sitelogo[0]->record_value;
	                        	 }elseif($sitelogo[0]->recordListingID==3){
	                        	 	echo "<div class='head_shadow' style='padding-left: 623px;'>";
	                        	 	echo $sitelogo[0]->record_value;
	                        	 }
					 		echo "</div>";
						}
	                        		?>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner">
        	<div class="banner_t">
            	<div class="banner_b">
                	<div class="banner_l">
                    	<div class="banner_r">
                        	<div class="banner_m">
                        	<?php 
                        	global $widget_margin;
                        	
                        	$enable_slider=get_option('enable_slider');
                        	$site_header_content = $wpdb->get_results("SELECT recordID, recordText,record_value,field_label,recordListingID FROM  wp_records where section_no=2");
                        	if($site_header_content[0]->recordListingID==1 && $site_header_content[0]->field_label=='header_image_src'){
	                        		echo '<div class="banner_pic">';
	                        		
	                        		if($enable_cxvbcvslider==1){
	                        			echo "<div class=\"banner_pic_inr\" style='position: absolute;right: -5px;top: 18px;'><img style='postion:relative;' src=".get_option('slider_1').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_2').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_3').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_4').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_5')."></div>";
	                        		}else{
	                        			echo $site_header_content[0]->record_value;
	                        		}
	                        		echo"</div>";
	                        		echo '<div class="banner_txt">';
	                        		echo $site_header_content[1]->record_value;
	                        		echo"</div>";
                        	}
                        	elseif($site_header_content[0]->recordListingID==1 && $site_header_content[0]->field_label=='header_content_src'){
                        			$widget_margin=1;
	                        		echo '<div class="banner_txt" style="float:left;padding-left:10px;">';
	                        		echo $site_header_content[0]->record_value;
	                        		echo"</div>";	
                        			echo '<div class="banner_pic" style="float:right;position:relative;padding-right:1px;">';
	                        	
                        			if($enable_slidersdfsf==1){
	                        			echo "<div class=\"banner_pic_inr\" style='position: absolute;right: -5px;top: 18px;'><img src=".get_option('slider_1').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_2').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_3').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_4').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_5')."></div>";
	                        		}else{
	                        				echo $site_header_content[1]->record_value;
	                        		}
	                        		
	                        		echo"</div>";
                        	}
                        	elseif($site_header_content[1]->recordListingID==1 && $site_header_content[1]->field_label=='header_content_src'){
                        		$widget_margin=1;
	                        	echo '<div class="banner_txt" style="float:left;padding-left:10px;">';
	                        		echo $site_header_content[1]->record_value;
	                        		echo"</div>";	
                        		echo '<div class="banner_pic" style="float:right;position:relative;padding-right:1px;">';
	                        	if($enable_slidersdfsd==1){
		                        			echo "<div class=\"banner_pic_inr\" style='position: absolute;right: -5px;top: 18px;'><img src=".get_option('slider_1').">";
		                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_2').">";
		                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_3').">";
		                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_4').">";
		                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_5')."></div>";
		                        		}else{
		                        				echo $site_header_content[0]->record_value;
		                        		}
	                        		
	                        		echo"</div>";
	                        		
                        	}
                        	elseif($site_header_content[1]->recordListingID==1 && $site_header_content[1]->field_label=='header_image_src'){
	                        echo '<div class="banner_pic">';
                        			if($enable_slidersdfsd==1){
	                        			echo "<div class=\"banner_pic_inr\" style='position: absolute;right: -5px;top: 18px;'><img src=".get_option('slider_1').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_2').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_3').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_4').">";
	                        			echo "<img style='postion:relative;width:425px;height:334px;' src=".get_option('slider_5')."></div>";
	                        		}else{
	                        				echo $site_header_content[1]->record_value;
	                        		}
	                        		echo"</div>";
	                        		echo '<div class="banner_txt">';
	                        		echo $site_header_content[0]->record_value;
	                        		echo"</div>";
                        	}		
                        	
                        	?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script type="text/javascript">
$("document").ready(function(){
	$(".banner_pic_inr").cycle();
	$(".headerslider").cycle();
});
</script>