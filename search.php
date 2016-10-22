<?php get_header(); ?>

<div class="page-title">

	<div class="container">

		<div class="title"><h1><?php _e("Search Results for","freshmind"); ?>:</span> <?php echo esc_attr(get_search_query()); ?></h1></div>

        <?php freshmind_breadcrumbs(); ?>

	</div>

</div><!-- end page title -->

<div id="content">

<div class="container">

	<div class="row">

		<div class="col-sm-8 col-md-9">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

                    <header>

                        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                        <p class="meta"><?php _e("Posted", "freshmind"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(); ?></time> <?php _e("by", "freshmind"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "freshmind"); ?> <?php the_category(', '); ?>.</p>

                    </header> <!-- end article header -->

                    <section class="post_content">
                        <?php the_excerpt('<span class="read-more">' . __("Read more on","freshmind") . ' "'.the_title('', '', false).'" &raquo;</span>'); ?>

                    </section> <!-- end article section -->

                    <footer>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="post-categories"><i class="fa fa-list" aria-hidden="true"></i> <?php echo __("Categories","freshmind"); ?>: <?php the_category(', '); ?></p>
                            </div>
                            <div class="col-sm-6">
                                <p class="tags"><i class="fa fa-tags" aria-hidden="true"></i> <?php the_tags('<span class="tags-title">' . __("Tags","freshmind") . ':</span> ', ' ', ''); ?></p>

                            </div>
                        </div>

                    </footer>
                    <!-- end article footer -->

                </article>
                <!-- end article -->

            <?php endwhile; ?>

            <?php if (function_exists('freshmind_page_navi')) { // if expirimental feature is active ?>

                <?php freshmind_page_navi(); // use the page navi function ?>

            <?php } else { // if it is disabled, display regular wp prev & next links ?>
                <nav class="wp-prev-next">
                    <ul class="clearfix">
                        <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "freshmind")) ?></li>
                        <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "freshmind")) ?></li>
                    </ul>
                </nav>
            <?php } ?>

            <?php else : ?>

            <!-- this area shows up if there are no results -->

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

		</div>
        <!-- /.col-md-9 -->

        <div class="col-sm-4 col-md-3">

            <?php get_sidebar(); // sidebar 1 ?>

        </div>
        <!-- /.col-md-3 -->

	</div>
    <!-- /.row -->

</div>
<!-- /.container -->

</div>
<!-- /#content -->    

<?php get_footer(); ?>