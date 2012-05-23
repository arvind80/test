<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<?php 
	$sitefooter = $wpdb->get_results("SELECT recordID, recordText,record_value,recordListingID,field_label FROM  wp_records where section_no=4 order by recordID");
?>
<div class="footer">
<div id="footerMenu">
	 <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer' ) ); ?>
	</div>
        <div class="footer-container">
        <div class="footer-container">
        	<?php 
        				$facebookStr="<a href='<ADD YOUR FB ID HERE>'><img src='".get_bloginfo('template_url')."/images/fb.png' alt='' /></a>";
        				$googlePlusStr="<a href='<ADD YOUR GOOGLE PLUS ID HERE>'><img src='".get_bloginfo('template_url')."/images/google-plus.png' alt='' /></a>";
           				if($sitefooter[0]->recordListingID==1 && $sitefooter[0]->field_label=='copyright_text'){		
           										echo '<div class="lt">';
				                        		echo $sitefooter[0]->record_value;
				                        		echo"</div>";
				                        		echo '<div class="rt">';
				                        		if(get_option('fb_id')!=''){
				                        			
				                        			$sitefooter[1]->record_value=	str_replace($facebookStr,get_option('fb_id'),$sitefooter[0]->record_value);
				                        		}
				                        		
				                        		if(get_option('twitter_id')!=''){
				                        			$sitefooter[1]->record_value=	str_replace("<ADD YOUR Twitter ID HERE>",get_option('twitter_id'),$sitefooter[0]->record_value);
				                        		}
				                        		
				                        		if(get_option('linkedin_id')!=''){
				                        			$sitefooter[1]->record_value=	str_replace("<ADD YOUR Linkdin ID HERE>",get_option('linkedin_id'),$sitefooter[0]->record_value);
				                        		}
				                        		
				                        		if(get_option('google_plus_id')!=''){
				                        			$sitefooter[1]->record_value=	str_replace($googlePlusStr,get_option('google_plus_id'),$sitefooter[0]->record_value);
				                        		}
				                        		
				                        		echo $sitefooter[1]->record_value;
				                        		echo"</div>";
			             }elseif($sitefooter[0]->recordListingID==1 && $sitefooter[0]->field_label=='social_links'){
			             	
								             	if(get_option('fb_id')!=''){
								             		$sitefooter[0]->record_value=	str_replace($facebookStr,get_option('fb_id'),$sitefooter[0]->record_value);
								             	}
								             	
								             	if(get_option('twitter_id')!=''){
								             		$sitefooter[0]->record_value=	str_replace("<ADD YOUR Twitter ID HERE>",get_option('twitter_id'),$sitefooter[0]->record_value);
								             	}
								             	
								             	if(get_option('linkedin_id')!=''){
								             		$sitefooter[0]->record_value=	str_replace("<ADD YOUR Linkdin ID HERE>",get_option('linkedin_id'),$sitefooter[0]->record_value);
								             	}
								             	
								             	if(get_option('google_plus_id')!=''){
								             		$sitefooter[0]->record_value=	str_replace($googlePlusStr,get_option('google_plus_id'),$sitefooter[0]->record_value);
								             	}
								             	
			             						echo '<div class="rt" style="float:left;">';
				                        		echo $sitefooter[0]->record_value;	
				                        		echo"</div>";
				                        		echo '<div class="lt" style="float:right;">';
				                        		echo $sitefooter[1]->record_value;
				                        		echo"</div>";  		
                        }elseif($sitefooter[1]->recordListingID==1 && $sitefooter[1]->field_label=='copyright_text'){
                        						echo '<div class="lt">';
				                        		echo $sitefooter[1]->record_value;
				                        		echo"</div>";
				                        		echo '<div class="rt">';
				                        		if(get_option('fb_id')!=''){
				                        			$sitefooter[0]->record_value=	str_replace($facebookStr,get_option('fb_id'),$sitefooter[0]->record_value);
				                        		}
				                        		
				                        		if(get_option('twitter_id')!=''){
				                        			$sitefooter[0]->record_value=	str_replace("<ADD YOUR Twitter ID HERE>",get_option('twitter_id'),$sitefooter[0]->record_value);
				                        		}
				                        		if(get_option('linkedin_id')!=''){
				                        			$sitefooter[0]->record_value=	str_replace("<ADD YOUR Linkdin ID HERE>",get_option('linkedin_id'),$sitefooter[0]->record_value);
				                        		}
				                        		if(get_option('google_plus_id')!=''){
				                        			$sitefooter[0]->record_value=	str_replace($googlePlusStr,get_option('google_plus_id'),$sitefooter[0]->record_value);
				                        		}
				                        		echo $sitefooter[0]->record_value;
				                        		echo"</div>";
			            }elseif($sitefooter[1]->recordListingID==1 && $sitefooter[1]->field_label=='social_links'){
			            						if(get_option('fb_id')!=''){
			            							$sitefooter[1]->record_value=	str_replace($facebookStr,get_option('fb_id'),$sitefooter[0]->record_value);
			            						}
				                        		
				                        		if(get_option('twitter_id')!=''){
				                        			$sitefooter[1]->record_value=	str_replace("<ADD YOUR Twitter ID HERE>",get_option('twitter_id'),$sitefooter[0]->record_value);
				                        		}
				                        		if(get_option('linkedin_id')!=''){
				                        			$sitefooter[1]->record_value=	str_replace("<ADD YOUR Linkdin ID HERE>",get_option('linkedin_id'),$sitefooter[0]->record_value);
				                        		}
				                        		if(get_option('google_plus_id')!=''){
				                        			$sitefooter[1]->record_value=	str_replace($googlePlusStr,get_option('google_plus_id'),$sitefooter[0]->record_value);
				                        		}
				                        		
                        						echo '<div class="rt" style="float:left;">';
				                        		echo $sitefooter[1]->record_value;
				                        		
				                        		echo"</div>";
				                        		echo '<div class="lt" style="float:right;">';
				                        		echo $sitefooter[0]->record_value;
				                        		echo"</div>";
                        }		
                        	?>     	
        </div>
    </div>
</div>
</body>
<?php wp_footer(); ?>
</html>