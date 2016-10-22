<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage freshmind
 * @since freshmind 1.0
 */
?>

	</div>
	<!-- /#content -->
	
	<?php
		$settings = freshmind_theme_get_options();
	?>
	
	<footer id="footer" class="site-footer" role="contentinfo">
	
		<div id="footer-bar">
	
			<div class="container">

                <div class="row">
			
                    <div class="col col-sm-6 col-md-3">

                        <?php
                            if ( is_active_sidebar( 'footer-1' ) ){
                                dynamic_sidebar( 'footer-1' );
                            }else{
                        ?>

                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <h4><?php echo __('Main links', 'freshmind') ?></h4>
                            <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'freshmind' ); ?>">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'primary',
                                        'menu_class'     => 'primary-menu',
                                        'depth'          => 1
                                     ) );
                                ?>
                            </nav><!-- .main-navigation -->
                        <?php endif; ?>

                         <?php
                            }
                         ?>

                    </div>

                    <div class="col col-sm-6 col-md-3">

                        <?php

                            if ( is_active_sidebar( 'footer-2' ) ){
                                dynamic_sidebar( 'footer-2' );
                            }else{
                            ?>

                                <h4><?php echo __('Contact info', 'freshmind') ?></h4>

                                <div class="contact-info">
                                    <?php if($settings['phone']): ?>
                                    <div class="contact-info-item"><i class="fa fa-phone"></i> <?php echo $settings['phone']; ?></div>
                                    <?php endif; ?>
                                    <?php if($settings['address']): ?>
                                    <div class="contact-info-item"><i class="fa fa-map-marker"></i> <?php echo $settings['address']; ?></div>
                                    <?php endif; ?>
                                    <?php if($settings['email']): ?>
                                    <div class="contact-info-item"><i class="fa fa-envelope"></i> <?php echo $settings['email']; ?></div>
                                    <?php endif; ?>
                                    <?php if($settings['google_maps_url']): ?>
                                        <div class="contact-info-item">
                                            <a href="#" class="alink" data-toggle="modal" data-target="#modalMap">
                                                <i class="fa fa-location-arrow"></i>
                                                <?php echo __('Show map', 'freshmind'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php
                            }
                        ?>

                    </div>

                    <div class="col col-sm-6 col-md-3">

                        <?php

                            if ( is_active_sidebar( 'footer-3' ) ){
                                dynamic_sidebar( 'footer-3' );
                            }else{
                                echo '<h4>'. __('Recent posts', 'freshmind') .'</h4>';
                                ?>
                                    <ul>
                                        <li><a href="#">Recent post 1</a></li>
                                        <li><a href="#">Recent post 2</a></li>
                                        <li><a href="#">Recent post 3</a></li>
                                        <li><a href="#">Recent post 4</a></li>
                                        <li><a href="#">Recent post 5</a></li>
                                    </ul>
                                <?php
                            }

                        ?>

                    </div>

                    <div class="col col-sm-6 col-md-3">

                        <?php

                            if ( is_active_sidebar( 'footer-4' ) ){
                                dynamic_sidebar( 'footer-4' );
                            }else{
                                echo '<h4>'. __('Tags', 'freshmind') .'</h4>';
                                ?>
                                    
                                <div class="tagcloud">
                                    <a style="font-size: 8pt;" title="" class="tag-link-32 tag-link-position-1" href="#">Lorem</a>
                                    <a style="font-size: 12.581818181818pt;" title="" class="tag-link-21 tag-link-position-2" href="#"">ipsum</a>
                                    <a style="font-size: 12.581818181818pt;" title="" class="tag-link-14 tag-link-position-3" href="#">dolor</a>
                                    <a style="font-size: 8pt;" title="" class="tag-link-19 tag-link-position-4" href="#">sit</a>
                                    <a style="font-size: 8pt;" title="" class="tag-link-34 tag-link-position-5" href="#">amet</a>
                                    <a style="font-size: 12.581818181818pt;" title="" class="tag-link-30 tag-link-position-6" href="#">consectetur</a>
                                </div>
                                <?php    
                            }

                        ?>

                    </div>

                </div>
                <!-- /.row -->

			</div>
			<!-- /.container -->
		</div>
		<!-- /#footer-bar -->

		<div class="site-info">

			<div class="container">

				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>

				<i class="fa fa-copyright"></i> <?php echo date('Y') . ' ' . $settings['copyright_text']; ?>
			</div>

		</div>
		<!-- /#site-info -->

	</footer>
	<!-- /#footer -->

    <div class="scrollup">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>

	<?php wp_footer(); ?>


<!-- _______________________ Modals _____________________ -->

<?php if($settings['google_maps_url']): ?>
<!-- Google map -->
<div class="modal fade" id="modalMap" tabindex="-1" role="dialog" aria-labelledby="modalMapLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-noborder">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo __('Map', 'freshmind'); ?></h4>
      </div>
      <div class="modal-body">
        <iframe src="<?php echo $settings['google_maps_url']; ?>" width="100%" allowfullscreen scrolling="no" height="500" frameborder="0" marginheight="0" marginwidth="0"></iframe>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter10958653 = new Ya.Metrika({
                    id:10958653,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/10958653" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	
</body>

</html>
