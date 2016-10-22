<?php get_header();
get_template_part('breadcrumbs'); //the_post(); ?>

<div id="content">

<div class="container">

	<div class="row">

		<div class="col-sm-8 col-md-9">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
					<header>
					
						<p class="meta"><i class="fa fa-calendar" aria-hidden="true"></i> <?php _e("Posted", "freshmind"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('F jS, Y', '','', FALSE); ?></time> <?php _e("by", "freshmind"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "freshmind"); ?> <?php the_category(', '); ?>.</p>
					
						<?php the_post_thumbnail( 'post-full' ); ?>									
						
					</header> <!-- end article header -->
				
					<section class="post_content clearfix" itemprop="articleBody">
					
						<?php the_content(); ?>
						
						<?php wp_link_pages(); ?>
				
					</section> <!-- end article section -->
					
					<footer>

                        <p class="tags"><i class="fa fa-tags" aria-hidden="true"></i> <?php the_tags('<span class="tags-title">' . __("Tags","freshmind") . ':</span> ', ' ', ''); ?></p>

						<?php 
						// only show edit button if user has permission to edit posts
						if( $user_level > 0 ) { 
						?>
						<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="fa fa-pencil"></i> <?php _e("Edit post","freshmind"); ?></a>
						<?php } ?>
						
					</footer> <!-- end article footer -->
				
				</article> <!-- end article -->
				
				<?php comments_template('',true); ?>
				
				<?php endwhile; ?>			
				
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
		</div>
		<!-- /.col-sm-9 -->
		
		<div class="col-sm-4 col-md-3">
			<?php get_sidebar(); ?>
		</div>
	
	</div>
	

</div><!-- end content area -->

</div>
<!-- /#main -->
<?php get_footer(); ?>