<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alena
 * Date: 27.02.16
 * Time: 16:08
 * To change this template use File | Settings | File Templates.
 */

$settings = freshmind_theme_get_options();

add_action( 'init', 'fmind_custom_types' );
// Portfolio type
function fmind_custom_types(){

    global $settings;

    register_post_type( 'fmind_portfolio',
		array(
			'labels' => array(
				'name' => __('Portfolio','freshmind'),
				'add_new' => __('Add New Item', 'freshmind'),
				'add_new_item' => __('Add New Portfolio','freshmind'),
				'edit_item' => __('Add New Portfolio ','freshmind'),
				'new_item' => __('New Link','freshmind'),
				'all_items' => __('All Portfolio','freshmind'),
				'view_item' => __('View Link','freshmind'),
				'search_items' => __('Search Links','freshmind'),
				'not_found' =>  __('No Links found','freshmind'),
				'not_found_in_trash' => __('No Links found in Trash','freshmind'),
			),
			'supports' => array('title','editor','thumbnail'),
			'show_in' => true,
			'show_in_nav_menus' => true,
			'public' => true,
			'menu_position' => 20,
			'rewrite' => array('slug' => $settings['portfolio_url']),
			'menu_icon' => 'dashicons-admin-media',
		)
	);
	
	register_post_type( 'fmind_slider',
		array(
			'labels' => array(
				'name' => __('Slider','freshmind'),
				'add_new' => __('Add New Item', 'freshmind'),
				'add_new_item' => __('Add New Slide','freshmind'),
				'edit_item' => __('Edit Slide ','freshmind'),
				'new_item' => __('New Slide','freshmind'),
				'all_items' => __('All Slides','freshmind'),
				'view_item' => __('View Slide','freshmind'),
				'search_items' => __('Search Slides','freshmind'),
				'not_found' =>  __('No Slides found','freshmind'),
				'not_found_in_trash' => __('No Slides found in Trash','freshmind'),
			),
			'supports' => array('title','editor','thumbnail'),
			'show_in' => true,
			'show_in_nav_menus' => true,
			'public' => true,
			'menu_position' => 20,
			//'rewrite' => array('slug' => $settings['portfolio_url']),
			'menu_icon' => 'dashicons-admin-media',
		)
	);
	
}

// Add metaboxes
add_action('admin_init','fmind_init');
function fmind_init(){

    add_meta_box('fmind_portfolio', 'Portfolio Detail', 'fmind_meta_portfolio', 'fmind_portfolio', 'normal', 'high');
	add_meta_box('fmind_slider', 'Slider Details', 'fmind_meta_slider', 'fmind_slider', 'normal', 'high');

    add_action('save_post','fmind_meta_save');
}

function fmind_meta_portfolio(){

    global $post;
	$portfolio_client = sanitize_text_field( get_post_meta( get_the_ID(), 'portfolio_client', true ));
    ?>

    <p><h4><?php _e('Portfolio Client','freshmind');?></h4></p>
	<p><input  name="portfolio_client" id="portfolio_client" style="width: 480px" placeholder="<?php echo _e( 'Enter the Portfolio client', 'freshmind' ); ?>" type="text" value="<?php if (!empty($portfolio_client)) echo esc_attr($portfolio_client); ?>"> </input></p>

    <?php
}

function fmind_meta_slider(){

    global $post;
	$slider_description = sanitize_text_field( get_post_meta( get_the_ID(), 'slider_description', true ));
    ?>

    <p><h4><?php _e('Slide description','freshmind');?></h4></p>
	<p><input  name="slider_description" id="slider_description" style="width: 480px" placeholder="<?php echo _e( 'Enter slide description', 'freshmind' ); ?>" type="text" value="<?php if (!empty($slider_description)) echo esc_attr($slider_description); ?>"> </input></p>

    <?php
} 
function fmind_meta_save($post_id){

    if((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
        return;

    if ( ! current_user_can( 'edit_page', $post_id ) )
    {     return ;	}
    if(isset($_POST['post_ID']))
    {
        $post_ID = $_POST['post_ID'];
        $post_type = get_post_type($post_ID);

        if( $post_type == 'fmind_slider' ) {

            update_post_meta( $post_ID, 'slider_description', sanitize_text_field($_POST['slider_description']) );
        }
        else if( $post_type == 'fmind_portfolio' ) {
            update_post_meta( $post_ID, 'portfolio_client', sanitize_text_field($_POST['portfolio_client']) );
        }

    }			
}
?>
