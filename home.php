<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage freshmind
 * @since freshmind 1.0
 */

get_header();
?>
<?php if(0): ?>

<div class="container">

    <div id="slider" class="slider-pro">
	
		<div class="sp-slides">
		
			<?php  
			
				$all_posts = wp_count_posts( 'fmind_slider')->publish;
				$args = array( 'post_type' => 'fmind_slider', 'posts_per_page' => $all_posts ); 	
				
				$slider = new WP_Query( $args );
				
				if( $slider->have_posts() ){   
				
					while ( $slider->have_posts() ) : $slider->the_post();  ?>	
				
						<div class="sp-slide">
						
							<?php 
							
							if(has_post_thumbnail()){ 
							
								/*$default_arg = array( 'class'=>"img-responsive" );
								echo '<a href="#">';
								the_post_thumbnail( 'slider-full', $default_arg );
								echo '</a>'; */
                                $post_thumbnail_id = get_post_thumbnail_id( get_post() );
                                $src = wp_get_attachment_image_src( $post_thumbnail_id, 'slider-full', false );

                                echo '<img src="'. get_template_directory_uri() .'/images/blank.gif" data-src="'. $src[0] .'" class="img-responsive" />';
								
							}
								
							if( get_the_title()!="" ){?>
								<p class="sp-layer sp-white sp-padding" data-position="topLeft" data-horizontal="50" data-vertical="100"
									data-show-transition="left" data-show-delay="400">
									<?php the_title(); ?>
								</p><?php 
							} ?>
							
							<?php if(get_post_meta( get_the_ID(),'slider_description', true )) { ?>
							<p class="sp-layer sp-black sp-padding"
									data-position="topLeft" data-horizontal="50" data-vertical="200"
									data-show-transition="right" data-show-delay="600">
								<?php echo get_post_meta( get_the_ID(),'slider_description', true ); ?>
							</p>
							<?php } ?>
						</div>
						
					<?php endwhile; 
					// EOF while slider posts
				} 
					
					else { ?>
		
						<div class="sp-slide">
							<img class="sp-image" src="<?php echo get_template_directory_uri(); ?>/js/slider-pro/css/images/blank.gif"
								data-src="<?php echo get_template_directory_uri(); ?>/images/slides/slide1.jpg" />

							<p class="sp-layer sp-white sp-padding"
								data-position="topLeft" data-horizontal="50" data-vertical="100"
								data-show-transition="left" data-show-delay="400">
								Lorem ipsum
							</p>

							<p class="sp-layer sp-black sp-padding"
								data-position="topLeft" data-horizontal="50" data-vertical="200"
								data-show-transition="right" data-show-delay="600">
								Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor
							</p>

						</div>
						
						<div class="sp-slide">
							<img class="sp-image" src="<?php echo get_template_directory_uri(); ?>/js/slider-pro/css/images/blank.gif"
								data-src="<?php echo get_template_directory_uri(); ?>/images/slides/slide2.jpg" />

							<p class="sp-layer sp-white sp-padding"
								data-position="topLeft" data-horizontal="50" data-vertical="100"
								data-show-transition="right" data-show-delay="400">
								Lorem ipsum
							</p>

							<p class="sp-layer sp-black sp-padding"
								data-position="topLeft" data-horizontal="50" data-vertical="200" 
								data-show-transition="left" data-show-delay="600">
								Lorem ipsum dolor Lorem ipsum dolor Lorem ipsum dolor
							</p>

						</div>
					
					<?php } ?>
		</div>
		<!-- /.slides -->

    </div>
	<!-- /.slider-pro -->
	
</div>
<!-- /.container -->

<?php endif; ?>
 
<?php

/*echo get_theme_mod( 'site-main-color' );

$settings = freshmind_theme_get_options();
$crumbs_settings = freshmind_theme_get_options('crumbs_options');

//$defaults = freshmind_options_defaults( 'main_options' );
//print_r( get_option( 'main_options', $defaults) );

//print_r($settings);
//echo '<br/>';
print_r($crumbs_settings);


echo 'copyright = ' . $settings['copyright_text'] . '<br/>';
echo ' freshmind = ' . $settings['freshmind'] . '<br/>';
echo 'skin = ' . get_theme_mod( 'skin' ) . '<br/>';
*/
?>

<br/><br/>
<div class="container ttt">
    
    <div id="content" class="row">

        <div id="main" class="col-sm-8 col-md-9" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="posts_loop">
                <?php get_template_part( 'posts_loop' ); ?>
            </div>

            <?php endwhile; ?>

            <?php if (function_exists('freshmind_page_navi')) { // if expirimental feature is active ?>

                <?php freshmind_page_navi(); // use the page navi function ?>

            <?php } else { // if it is disabled, display regular wp prev & next links ?>
                <nav class="wp-prev-next">
                    <ul class="pager">
                        <li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "freshmind")) ?></li>
                        <li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "freshmind")) ?></li>
                    </ul>
                </nav>
            <?php } ?>

            <?php else : ?>

            <article id="post-not-found">
                <header>
                    <h1><?php _e("Not Found", "freshmind"); ?></h1>
                </header>
                <section class="post_content">
                    <p><?php _e("Sorry, but the requested resource was not found on this site.", "freshmind"); ?></p>
                </section>
                <footer>
                </footer>
            </article>

            <?php endif; ?>

        </div> <!-- end #main -->

        <div class="col-sm-4 col-md-3">
            <?php get_sidebar(); ?>
        </div>


    </div> <!-- end #content -->

</div>
<!-- /.container -->
        
<?php get_footer(); ?>
