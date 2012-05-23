<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sales-page-sidebar' ) ) : ?>
			
				<?php $loop = new WP_Query( array( 'post_type' => 'testimonials', 'posts_per_page' => 10 ) ); ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<div class="text">
						<?php the_content(); ?>
                    </div>
                    <div class="title">
                        <p><strong><?php the_title(); ?></strong></p>
                        <?php
							$state = get_post_meta($post->ID, 'state');
							$country = get_post_meta($post->ID, 'country');
                        ?>
                        <p><span><?php echo $state[0].", ".$country[0]; ?></span></p>
                   </div>
                   <div class="border">
					</div>
				<?php endwhile; ?>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>
