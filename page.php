<?php get_header();
get_template_part('breadcrumbs'); the_post(); ?>

<div class="container">

	<div class="row">

		<div class="col-sm-8 col-md-9">
		
			<?php if(has_post_thumbnail()): ?>
			<div class="image_frame">
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('post-full'); ?>
				</a>
			</div>
			<?php endif; ?>
			<?php the_content(__('Read more...','weblizar'));   ?>        
			<div class="clearfix divider_dashed9"></div>  
			<?php comments_template('',true); ?>

		</div>
		<!-- end content left side -->
		
		<div class="col-sm-4 col-md-3">
			<?php get_sidebar(); ?>
		</div>
	
	</div>
	

</div><!-- end content area -->

<?php get_footer(); ?>