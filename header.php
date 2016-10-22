<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage freshmind
 * @since freshmind 1.0
 */
 
$settings = freshmind_theme_get_options();

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<header id="header" class="site-header" role="banner">
	
		<div class="container">
		
			<div class="row">
				
				<div class="col-sm-4 col-md-3">
					<div id="logo">
						<?php if( get_theme_mod( 'logo-box' ) ): ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'logo-box' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php else: ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>	
					</div>	
				</div>
				
				<div class="col-sm-8 col-md-4">
					<?php
						$description = get_bloginfo( 'description', 'display' );
						
						if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
					<?php endif; ?>
					
				</div>
				
				<div class="col-sm-12 col-md-5">
				
					<?php 
					
						if ( is_active_sidebar( 'header-1' ) ){ 
							dynamic_sidebar( 'header-1' );
						}else{
						?>
							<div class="header-contacts">
                                <?php if($settings['email']): ?>
								<span class="header-contacts-item"><i class="fa fa-envelope"></i> <?php echo $settings['email']; ?></span>
								<?php endif; ?>
                                <?php if($settings['phone']): ?>
                                <span class="header-contacts-item"><i class="fa fa-phone"></i> <?php echo $settings['phone']; ?></span>
							    <?php endif; ?>
                            </div>
						<?php
						}	
					?>
				</div>
				
			</div>
			
		</div><!-- /.container -->
	</header>
	<!-- .site-header -->	

	<?php if ( has_nav_menu( 'primary' )) : ?>

        <div class="navbar-wrapper <?php if(get_theme_mod( 'nav_affix' ) == 'yes'){ echo 'navbar-sticked'; } ?>">
	
            <div class="navbar navbar-inverse" role="navigation">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"><?php __('Menu', 'freshmind'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#"><?php bloginfo( 'name' ); ?></a>
                </div>
                <nav class="navbar-collapse collapse">
                    <?php
                        freshmind_primary_nav();
                    ?>
                </nav><!--/.navbar-collapse -->
              </div>
            </div>

        </div>
        <!-- /.navbar wrapper -->

	<?php endif; ?>		

	<div id="content_wrap" class="site-content">
