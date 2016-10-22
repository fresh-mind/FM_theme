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
<div class="container">

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
