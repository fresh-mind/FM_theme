<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

    <div class="page-title">

        <div class="container">

            <div class="title"><?php the_archive_title( '<h1>', '</h1>' ); ?></div>
            <?php freshmind_breadcrumbs(); ?>
            <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

        </div>

    </div><!-- end page title -->
<?php endif; ?>

<div class="container">

    <div id="content" class="clearfix row">

        <div id="main" class="col-sm-8 col-md-9">

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
