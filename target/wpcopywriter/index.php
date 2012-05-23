<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
		<div class="inr_cntnt">
        	<div class="inr_cntnt_t">
            	<div class="inr_cntnt_b">
                	<div class="inr_cntnt_l">
                    	<div class="inr_cntnt_r">
                        	<div class="inr_cntnt_m">
                            	<?php 
                            	    global $widget_margin;
                        $site_main_content = $wpdb->get_results("SELECT recordID,field_label, recordText,record_value,recordListingID FROM  wp_records where section_no=3 order by recordListingID "); 	 
                        //print_r($site_main_content);die;
			/////    first ////
			
			if(
			   
			   $site_main_content[0]->recordListingID==1 && $site_main_content[0]->field_label=='content_section'
			  && $site_main_content[1]->recordListingID==2 && $site_main_content[1]->field_label=='content_section1'
			&& $site_main_content[2]->recordListingID==3 && $site_main_content[2]->field_label=='widget_section'
			   
			   ){
				echo'<div class="feature_left_bx">';
				echo $site_main_content[0]->record_value;
				echo"</div>";
				
				echo'<div class="feature_right_bx">';
				echo $site_main_content[1]->record_value;
				echo"</div>";
                                 
				 echo'<div class="feature_right_bx1">';                                       
                                if($widget_margin==1){
				echo '<div class="testimnl" style="margin-top: 68px;">';
				}else{
				echo '<div class="testimnl">';
				}
				?>
				<div class="testimnl-top">
				<h2>What have happy users said?</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				get_sidebar();
				?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				
				<div class="testimnl">
				<div class="testimnl-top">
				<h2>Enter Your Email</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				dynamic_sidebar( 'auto-responder' )
								?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				<?php
				echo"</div>";
				
				                        		
			}
			/////    seconf  ////
			
			else if(
			   
			   $site_main_content[0]->recordListingID==1 && $site_main_content[0]->field_label=='content_section'
			  && $site_main_content[1]->recordListingID==2 && $site_main_content[1]->field_label=='widget_section'
			&& $site_main_content[2]->recordListingID==3 && $site_main_content[2]->field_label=='content_section1'
			   
			   ){
				echo'<div class="feature_left_bx">';
				echo $site_main_content[0]->record_value;
				echo"</div>";
				
				 echo'<div class="feature_right_bx1">';                                       
                                if($widget_margin==1){
				echo '<div class="testimnl" style="margin-top: 68px;">';
				}else{
				echo '<div class="testimnl">';
				}
				?>
				<div class="testimnl-top">
				<h2>What have happy users said?</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				get_sidebar();
				?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				
				<div class="testimnl">
				<div class="testimnl-top">
				<h2>Enter Your Email</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				dynamic_sidebar( 'auto-responder' )
								?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				<?php
				echo"</div>";
                                   
				
				echo'<div class="feature_right_bx">';
				echo $site_main_content[2]->record_value;
				echo"</div>";
				
				
				                        		
			}
			/////    thired  ////
			
			else if(
			   
			   $site_main_content[0]->recordListingID==1 && $site_main_content[0]->field_label=='content_section1'
			  && $site_main_content[1]->recordListingID==2 && $site_main_content[1]->field_label=='content_section'
			&& $site_main_content[2]->recordListingID==3 && $site_main_content[2]->field_label=='widget_section'
			   
			   ){
				
				echo'<div class="feature_right_bx">';
				echo $site_main_content[0]->record_value;
				echo"</div>";
				
				echo'<div class="feature_left_bx">';
				echo $site_main_content[1]->record_value;
				echo"</div>";
				
                                 echo'<div class="feature_right_bx1">';                                       
                                if($widget_margin==1){
				echo '<div class="testimnl" style="margin-top: 68px;">';
				}else{
				echo '<div class="testimnl">';
				}
				?>
				<div class="testimnl-top">
				<h2>What have happy users said?</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				get_sidebar();
				?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				
				<div class="testimnl">
				<div class="testimnl-top">
				<h2>Enter Your Email</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				dynamic_sidebar( 'auto-responder' )
								?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				<?php
				echo"</div>";
				
				                        		
			}
			/////    fourth ////
			
			else if(
			   
			   $site_main_content[0]->recordListingID==1 && $site_main_content[0]->field_label=='content_section1'
			  && $site_main_content[1]->recordListingID==2 && $site_main_content[1]->field_label=='widget_section'
			&& $site_main_content[2]->recordListingID==3 && $site_main_content[2]->field_label=='content_section'
			   
			   ){
				
				echo'<div class="feature_right_bx">';
				echo $site_main_content[0]->record_value;
				echo"</div>";
				
				 echo'<div class="feature_right_bx1">';                                       
                                if($widget_margin==1){
				echo '<div class="testimnl" style="margin-top: 68px;">';
				}else{
				echo '<div class="testimnl">';
				}
				?>
				<div class="testimnl-top">
				<h2>What have happy users said?</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				get_sidebar();
				?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				
				<div class="testimnl">
				<div class="testimnl-top">
				<h2>Enter Your Email</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				dynamic_sidebar( 'auto-responder' )
								?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				<?php
				echo"</div>";
				
				
				echo'<div class="feature_left_bx">';
				echo $site_main_content[2]->record_value;
				echo"</div>";
				
				
                                                                        
                                
				
				
				
				                        		
			}
			/////    fife ////
			
			else if(
			   
			   $site_main_content[0]->recordListingID==1 && $site_main_content[0]->field_label=='widget_section'
			  && $site_main_content[1]->recordListingID==2 && $site_main_content[1]->field_label=='content_section'
			&& $site_main_content[2]->recordListingID==3 && $site_main_content[2]->field_label=='content_section1'
			   
			   ){
				
                                 echo'<div class="feature_right_bx1">';                                       
                                if($widget_margin==1){
				echo '<div class="testimnl" style="margin-top: 68px;">';
				}else{
				echo '<div class="testimnl">';
				}
				?>
				<div class="testimnl-top">
				<h2>What have happy users said?</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				get_sidebar();
				?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				
				<div class="testimnl">
				<div class="testimnl-top">
				<h2>Enter Your Email</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				dynamic_sidebar( 'auto-responder' )
								?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				<?php
				echo"</div>";
				
				echo'<div class="feature_left_bx">';
				echo $site_main_content[1]->record_value;
				echo"</div>";
				
				echo'<div class="feature_right_bx">';
				echo $site_main_content[2]->record_value;
				echo"</div>";
				
				
				                        		
			}
			/////    six ////
			
			else if(
			   
			   $site_main_content[0]->recordListingID==1 && $site_main_content[0]->field_label=='widget_section'
			  && $site_main_content[1]->recordListingID==2 && $site_main_content[1]->field_label=='content_section1'
			&& $site_main_content[2]->recordListingID==3 && $site_main_content[2]->field_label=='content_section'
			   
			   ){
				
				
                                 echo'<div class="feature_right_bx1">';                                       
                                if($widget_margin==1){
				echo '<div class="testimnl" style="margin-top: 68px;">';
				}else{
				echo '<div class="testimnl">';
				}
				?>
				<div class="testimnl-top">
				<h2>What have happy users said?</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				get_sidebar();
				?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				
				<div class="testimnl">
				<div class="testimnl-top">
				<h2>Enter Your Email</h2>
				</div>
			        <div class="testimnl-mid">
				<?php 
				dynamic_sidebar( 'auto-responder' )
								?>
				</div>
			        <div class="testimnl-btm"> </div>
			        </div>
				<?php
				echo"</div>";
				
				echo'<div class="feature_right_bx">';
				echo $site_main_content[1]->record_value;
				echo"</div>";
				echo'<div class="feature_left_bx">';
				echo $site_main_content[2]->record_value;
				echo"</div>";
				
				
				
				
				                        		
			}
			else{
				
				echo "something werong ";
			}
		       
				      ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php get_footer(); ?>
