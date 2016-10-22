<?php
/**
 * freshmindTheme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage freshmind
 * @since freshmind 1.0
 */

/**
 * freshminde=7+ only works in WordPress 4.4 or later.
 */
/*if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}*/

if ( ! function_exists( 'freshmind_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own freshmind_setup() function to override in a child theme.
 *
 * @since Freshmind 1.0
 */
function freshmind_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'freshmind', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 850, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'freshmind' ),
		'social'  => __( 'Social Links Menu', 'freshmind' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );
	
	if ( ! isset( $content_width ) ) $content_width = 900;
	
	$args = array(
		'default-color' => 'ffffff',
		//'default-image' => '%1$s/images/zigzag.png',
		'default-image' => '',
	);
	add_theme_support( 'custom-background', $args );

    add_theme_support( 'woocommerce' );
}
endif; // freshmind_setup
add_action( 'after_setup_theme', 'freshmind_setup' );

if ( ! function_exists( 'freshmind_primary_nav' ) ) :
/*
 * Display Primary Navigation as Bootstrap Navbar. 
 * See http://bootstrapdocs.com/v3.1.1/docs/components/#navbar
*/
function freshmind_primary_nav() {
	
	// If dropdown toggle way is 'on hover' => add class 'navbar-toggle-hover'
	$menu_class = 'nav navbar-nav';
	
	if( get_theme_mod( 'dropdown_toggle' ) == 'hover' ){
		$menu_class .= ' navbar-toggle-hover';
	}	
	
  // Display the WordPress menu if available
  wp_nav_menu( 
    array( 
      'menu' => 'primary', /* menu name */
      'menu_class' => $menu_class,
      'theme_location' => 'primary', /* where in the theme it's assigned */
      'container' => 'false', /* container class */
	  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
      'walker' => new Bootstrap_walker() // use to diaply menu items as bootstrap navbar menu items
    )
  );
}

endif;

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Freshmind 1.0
 */
/*function freshmind_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'freshmind_content_width', 840 );
}
add_action( 'after_setup_theme', 'freshmind_content_width', 0 );
*/

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Freshmind 1.0
 */
function freshmind_widgets_init() {
	
	register_sidebar( array(
		'name'          => __( 'Header 1', 'freshmind' ),
		'id'            => 'header-1',
		'description'   => __( 'Add widgets here to appear in your header.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'freshmind' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'freshmind' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'freshmind' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'freshmind' ),
		'id'            => 'footer-1',
		'description'   => __( 'Appears at the footer block, for example, for mini main nav.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'freshmind' ),
		'id'            => 'footer-2',
		'description'   => __( 'Appears at the footer block, for example, for contacts.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'freshmind' ),
		'id'            => 'footer-3',
		'description'   => __( 'Appears at the footer block, for example, for recent posts.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'freshmind' ),
		'id'            => 'footer-4',
		'description'   => __( 'Appears at the footer block, for example, for mini contact form.', 'freshmind' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'freshmind_widgets_init' );


/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since freshmind 1.1
 */
function freshmind_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'freshmind_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since freshmind 1.0
 */
function freshmind_scripts() {

	// Add Bootstrap
	wp_enqueue_style( 'bootstrap-styles', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.1.1' );
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '20160128', true );
	
	// Add FontAwesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/FontAwesome/css/font-awesome.min.css', array(), '4.3.0' );

	// Theme stylesheet.
	wp_enqueue_style( 'freshmind-style', get_stylesheet_uri() );
	
	// Custom stylesheet.
    if( get_theme_mod( 'skin' ) == 'none' || get_theme_mod( 'skin' ) == '' ){
		
		// styles with custom color

		$main_color = get_theme_mod( 'site-main-color', '#044C29' );
		// remove '# 'from color
		$main_color = substr( $main_color, 1 );
		wp_enqueue_style( 'color-skin-styles', get_template_directory_uri() . '/css/custom_css.php?color=' . $main_color );
		
    }else{
        wp_enqueue_style( 'skin-styles', get_template_directory_uri() . '/css/skins/' . get_theme_mod( 'skin' ) . '.css' );
    }
	
	// Theme media stylesheet.
	wp_enqueue_style( 'freshmind-media-style', get_template_directory_uri() . '/css/media-queries.css' );
	
	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// JS plugins
	wp_enqueue_script( 'bootstrap-fileinput', get_template_directory_uri() . '/js/bootstrap.file-input.js', array('bootstrap-script'), 1, true );

    // Slider Pro
    wp_enqueue_script( 'slider-pro', get_template_directory_uri() . '/js/slider-pro/js/jquery.sliderPro.min.js', array('jquery'), 1, true );
    wp_enqueue_style( 'slider-pro', get_template_directory_uri() . '/js/slider-pro/css/slider-pro.min.css' );

	// Load the html5 shiv.
	wp_enqueue_script( 'freshmind-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'freshmind-html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'freshmind-respond', get_template_directory_uri() . '/js/respond.js', array(), '1.4.2' );
	wp_script_add_data( 'freshmind-respond', 'conditional', 'lt IE 9' );
	
	// Custom js
	wp_enqueue_script( 'freshmind-custom-js', get_template_directory_uri() . '/js/scripts.js', array('jquery'), 1, true );

}
add_action( 'wp_enqueue_scripts', 'freshmind_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Freshmind 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function freshmind_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'freshmind_body_classes' );

if ( ! function_exists( 'freshmind_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since freshmind 1.0
 */
function freshmind_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;

// Add image sizes

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'category-thumb', 300, 9999 ); // 300 в ширину и без ограничения в высоту
	add_image_size( 'homepage-thumb', 400, 300, true ); // Кадрирование изображения
	add_image_size( 'post-full', 1200, 9999 );
	add_image_size( 'post-thumb', 1200, 275, true );
	add_image_size( 'slider-full', 1900, 800, true );
}

if ( ! function_exists( 'freshmind_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since freshmind 1.0
 */
function freshmind_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'freshmind' ) );
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'freshmind' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'freshmind' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}

	if ( 'post' == get_post_type() ) {
		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
				_x( 'Author', 'Used before post author name.', 'freshmind' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'freshmind' ) );
		if ( $categories_list && freshmind_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'freshmind' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'freshmind' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'freshmind' ),
				$tags_list
			);
		}
	}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'freshmind' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'freshmind' ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'freshmind_page_navi' ) ) :

// Numeric Page Navi (built into the theme by default)

function freshmind_page_navi($before = '', $after = '') {
  global $wpdb, $wp_query;
  $request = $wp_query->request;
  $posts_per_page = intval(get_query_var('posts_per_page'));
  $paged = intval(get_query_var('paged'));
  $numposts = $wp_query->found_posts;
  $max_page = $wp_query->max_num_pages;
  if ( $numposts <= $posts_per_page ) { return; }
  if(empty($paged) || $paged == 0) {
    $paged = 1;
  }
  $pages_to_show = 7;
  $pages_to_show_minus_1 = $pages_to_show-1;
  $half_page_start = floor($pages_to_show_minus_1/2);
  $half_page_end = ceil($pages_to_show_minus_1/2);
  $start_page = $paged - $half_page_start;
  if($start_page <= 0) {
    $start_page = 1;
  }
  $end_page = $paged + $half_page_end;
  if(($end_page - $start_page) != $pages_to_show_minus_1) {
    $end_page = $start_page + $pages_to_show_minus_1;
  }
  if($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page = $max_page;
  }
  if($start_page <= 0) {
    $start_page = 1;
  }
    
  echo $before.'<ul class="pagination">'."";
  if ($paged > 1) {
    $first_page_text = "&laquo";
    echo '<li class="prev"><a href="'.get_pagenum_link().'" title="' . __('First','freshmind') . '">'.$first_page_text.'</a></li>';
  }
    
  $prevposts = get_previous_posts_link( __('&larr; Previous','freshmind') );
  if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
  else { echo '<li class="disabled"><a href="#">' . __('&larr; Previous','freshmind') . '</a></li>'; }
  
  for($i = $start_page; $i  <= $end_page; $i++) {
    if($i == $paged) {
      echo '<li class="active"><a href="#">'.$i.'</a></li>';
    } else {
      echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    }
  }
  echo '<li class="">';
  next_posts_link( __('Next &rarr;','freshmind') );
  echo '</li>';
  if ($end_page < $max_page) {
    $last_page_text = "&raquo;";
    echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="' . __('Last','freshmind') . '">'.$last_page_text.'</a></li>';
  }
  echo '</ul>'.$after."";
}

endif;

/* =============================  COMMENT LAYOUT ==================================== */
		
// Comment Layout
function freshmind_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
		
			<div class="comment-author vcard row">
				<div class="avatar col-sm-1">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-sm-11 comment-text">
				
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					
					<?php //edit_comment_link(__('Edit','freshmind'),'<span class="edit-comment btn btn-sm btn-info"><i class="fa fa-pencil"></i>','</span>') ?>
					

                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','freshmind') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>

                    <footer>
                        <i class="fa fa-clock-o" aria-hidden="true"></i> <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                        &nbsp;
                        <i class="fa fa-reply" aria-hidden="true"></i> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        &nbsp;
                        <?php edit_comment_link( '<i class="fa fa-pencil" aria-hidden="true"></i> ' . __('Edit','freshmind')); ?>
                    </footer>
                    

					          </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

if ( ! function_exists( 'freshmind_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Twenty Fifteen 1.0
 */
function freshmind_comment_nav() {
	// Are there comments to navigate through?
	//echo 'option page_comments' . get_option( 'page_comments' );
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>	
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'freshmind' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'freshmind' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'freshmind' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

add_filter( 'comment_form_default_fields', 'freshmind_comment_form_fields' );
function freshmind_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<div class="form-control-wrap form-control-wrap-name">' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>' .
                    '</div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<div class="form-control-wrap form-control-wrap-email">' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>' .
                    '</div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<div class="form-control-wrap form-control-wrap-url">' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>' .
                    '</div>',
    );

    return $fields;
}

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	 $class_names = $value = '';
	
		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}
	
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	if ( $args->has_children ) {
		  $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}

/* =================================== include files ======================================= */

require( get_template_directory() . '/theme-options/options.php' ); // for Administration theme options
require( get_template_directory() . '/inc/customizer.php' ); // for Customizing
require( get_template_directory() . '/inc/custom_post_types.php' ); // for Custom post types
require( get_template_directory() . '/inc/breadcrumbs.php' ); // for breadcrumbs

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );