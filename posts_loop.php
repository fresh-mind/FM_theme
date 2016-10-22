<?php
        /*
         * Teplate for loop item of post
         */
		 
	$settings = freshmind_theme_get_options();
	
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

    <header>

        

        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

        <p class="meta"><i class="fa fa-calendar" aria-hidden="true"></i> <?php _e("Posted", "freshmind"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('F jS, Y', '','', FALSE); ?></time> <?php _e("by", "freshmind"); ?> <?php the_author_posts_link(); ?></p>
		
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'post-thumb' ); ?></a>
		
    </header> <!-- end article header -->

    <section class="post_content clearfix">
        <?php the_content( $settings['read_more_text'] ); ?>
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

    </footer> <!-- end article footer -->

</article> <!-- end article -->