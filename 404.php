<?php get_header();
get_template_part('breadcrumbs'); ?>

<div class="container">

	<div class="error_404"> 
   	
        <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br/><?php _e('404','freshmind');?></strong>
	
		<p>
			<b><?php _e('Oops... Page Not Found!', 'freshmind');?></b>
        </p>
		<p>
			<em><?php _e('Sorry the Page Could not be Found here.','freshmind');?></em>
		</p>
        <p><?php _e('Try using the button below to go to main page of the site','freshmind');?></p>
        
   	
        <a href="<?php echo home_url( '/' ); ?>" class="but_goback"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; <?php _e('Go to front page','freshmind');?></a>
        
    </div><!-- end error page notfound -->   
	

</div><!-- end content area -->

<?php get_footer(); ?>