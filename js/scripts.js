(function($) {
	
 "use strict";

$(document).ready(function(){
	
	var device = 'desktop';
	
	// Detect device
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		device = 'mobile';			
	}
	
	$('body').addClass('device-' + device);
	
	// Custom fileInput
	$('input[type=file]:not(.nocustom)').bootstrapFileInput();

	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});

	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 500);
		return false;
	});

	// Affix navbar to top 
	var sticker_menu = $('.navbar-sticked'); 
	
	if( sticker_menu.size() ){

        var start_pos = sticker_menu.offset().top;

        if( start_pos ){
            
            $(window).scroll(function(){
                if ( $(window).scrollTop() >= start_pos ) {
                    sticker_menu.addClass('to_top');
                }else{
                    sticker_menu.removeClass('to_top');
                }

            });

        }
	} 
	
	// Hover navbar instead click dropdown	
    if (window.matchMedia('(min-width: 992px)').matches || device == 'desktop'){
		
		$('.navbar-toggle-hover .dropdown-toggle').removeAttr('data-toggle');
		
    };

    $( document ).ready(function( $ ) {
		$( '#slider' ).sliderPro({
			width: 1900,
			height: 800,
			fade: true,
			arrows: true,
			buttons: false,
			fullScreen: true,
			shuffle: true,
			smallSize: 500,
			mediumSize: 1000,
			largeSize: 3000,
			thumbnailArrows: true,
			autoplay: true
		});
	});

});

})(jQuery);	