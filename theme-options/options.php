<?php

/* Default settings */

/*$freshmind_theme_options_default = array(
	'freshmind_theme_options' => array(
		'copyright_text' => 'FreshMind for you'
	)
);

wp_parse_args(get_option( 'freshmind_theme_options', array() ), $freshmind_theme_options_default );  */

require( get_template_directory() . '/theme-options/option_defaults.php' ); // for Administration theme options
	
function freshmind_theme_get_options( $option_name = 'main_options' ){
	
	$defaults = freshmind_options_defaults( $option_name );
    //print_r($defaults);
    return wp_parse_args( get_option( $option_name, $defaults) );
	
}

// Page of options in Admin panel
$options_page = 'freshmind_theme_options.php';

function freshmind_theme_options() {
	
	global $options_page;

	$t_page = add_theme_page( __('Option Panel','freshmind'), __('Theme Options','freshmind'), 'administrator', $options_page, 'freshmind_theme_settings_view' );
	
	//add_options_page( 'Параметры', 'Параметры', 'manage_options', $options_page, 'freshmind_theme_settings_view');
	
	// Add css & js to options page
	add_action( 'admin_print_styles-'.$t_page, 'freshmind_admin_enqueue' );
}  
add_action( "admin_menu", "freshmind_theme_options" );

function freshmind_admin_enqueue(){
	
	// Add FontAwesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/FontAwesome/css/font-awesome.min.css', array(), '4.3.0' );
	
	wp_enqueue_style('styles', get_template_directory_uri().'/theme-options/css/styles.css');
	
}
	
function freshmind_theme_settings_view(){
	
	global $options_page;
	
?>	

	<div id="freshmind-theme-options" class="wrap">
	
        <h2><i class="fa fa-cogs"></i> <?php echo __('Theme advanced options', 'freshmind'); ?></h2>
		
        <form method="post"  enctype="multipart/form-data" action="options.php">  

			<?php
				$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'main_options';
                $page_params = '?page=freshmind_theme_options.php&tab=';
                $main_page_url_params = '?page=freshmind_theme_options.php&tab=main_options';
                $crumbs_page_url_params = '?page=freshmind_theme_options.php&tab=crumbs_options';

                if( isset( $_POST['reset'] )){
                    $reset_option_name = $_POST['reset'];
                    delete_option( $reset_option_name );
                    //echo '<div class="update">'. __('Options reset to default values', 'freshmind') .'</div>';
                }

			?>
			 
			<h2 class="nav-tab-wrapper">
				<a href="<?php echo $main_page_url_params; ?>" class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>">Main Options</a>
				<a href="<?php echo $crumbs_page_url_params; ?>" class="nav-tab <?php echo $active_tab == 'crumbs_options' ? 'nav-tab-active' : ''; ?>">Breadcrumbs Options</a>
			</h2>
		
			<?php

				if( $active_tab == 'main_options' ) {
					settings_fields( 'freshmind_theme_main_options' );
					do_settings_sections( $options_page );
				} else if( $active_tab == 'crumbs_options' ) {
					settings_fields( 'freshmind_theme_crumbs_options' );
					do_settings_sections( 'freshmind_theme_crumbs_options' );
				} // end if/else
				 
				submit_button();
				
			?>



        </form>

        <form method="post"  enctype="multipart/form-data" action="<?php echo $page_params . $active_tab; ?>">
            <input type="hidden" name="reset" value="<?php echo $active_tab ?>" />
            <button type="submit" class="button"><?php echo __('Reset this options', 'freshmind'); ?></button>
        </form>


    </div>
	
<?php
}	

function freshmind_theme_options_settings() {
	
	global $options_page;

	register_setting( 'freshmind_theme_main_options', 'main_options', 'freshmind_theme_options_validate' );
 
	add_settings_section( 'freshmind_theme_options_1', __('Main options', 'freshmind'), '', $options_page );
 
	// Add textfield copyright text
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'copyright_text',
		'desc'      => __('Enter your copyright text.', 'freshmind'),
		'label_for' => 'copyright_text' 
	);
	add_settings_field( 'copyright_text_label', __('Copyright text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_1', $freshmind_theme_field_params );
	
	add_settings_section( 'freshmind_theme_options_contacts', __('Contact info', 'freshmind'), '', $options_page );
	
	// Add textfield Phone
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'phone',
		'desc'      => __('Enter your contact phone number, you can use html tags, like <strong>span</strong>, <strong>em</strong> ', 'freshmind'),
		'label_for' => 'phone' 
	);
	add_settings_field( 'phone', __('Contact phone', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_contacts', $freshmind_theme_field_params );
	
	// Add textfield Address
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'address',
		'desc'      => __('Enter your address.', 'freshmind'),
		'label_for' => 'address' 
	);
	add_settings_field( 'address', __('Address', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_contacts', $freshmind_theme_field_params );
	
	// Add textfield Email
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'email',
		'desc'      => __('Enter your email address.', 'freshmind'),
		'label_for' => 'address' 
	);
	add_settings_field( 'email', __('Email', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_contacts', $freshmind_theme_field_params );
	
	
	// Add Google maps url 
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'google_maps_url',
		'desc'      => __('Enter your Google maps url.', 'freshmind'),
		'label_for' => 'google_maps_url' 
	);
	add_settings_field( 'google_maps_url', __('Google maps url', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_contacts', $freshmind_theme_field_params );
	
	// Read more link text
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'read_more_text',
		'desc'      => __('Enter your text for Read more link.', 'freshmind'),
		'label_for' => 'read_more_text' 
	);
	add_settings_field( 'read_more_text', __('Read more link text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_contacts', $freshmind_theme_field_params );

    // Add section portfolio
    add_settings_section( 'freshmind_theme_options_portfolio', __('Portfolio settings', 'freshmind'), '', $options_page );

    // Add portfolio url
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'portfolio_url',
		'desc'      => __('Enter your custom links for PORTFOLIO.', 'freshmind'),
		'label_for' => 'portfolio_url'
	);
	add_settings_field( 'portfolio_url', __('Portfolio custom url', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_options_portfolio', $freshmind_theme_field_params );

}	
add_action( 'admin_init', 'freshmind_theme_options_settings' );

function freshmind_theme_crumbs_options_settings() {
	
	$options_page = 'freshmind_theme_crumbs_options';
    $option_name = 'crumbs_options';
	
	register_setting( 'freshmind_theme_crumbs_options', $option_name, 'freshmind_theme_options_validate' );
 
	add_settings_section( 'freshmind_theme_crumbs', __('Breadcrumbs options', 'freshmind'), '', $options_page );

    // Add textfield sep
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'sep',
		'desc'      => __('Enter your separator for breadcrumbs.', 'freshmind'),
		'label_for' => 'sep',
        'option_name' => $option_name,
	);
	add_settings_field( 'sep_label', __('Separator', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );
 
	// Add textfield home_text
	$freshmind_theme_field_params = array(
		'type'      => 'text', 
		'id'        => 'home_text',
		'desc'      => __('Enter your home page link text.', 'freshmind'),
		'label_for' => 'home_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'home_text_label', __('Home text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );
	
    // Add textfield category_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'category_text',
		'desc'      => __('Enter your category text.', 'freshmind'),
		'label_for' => 'category_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'category_text_label', __('Category text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

    // Add textfield search_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'search_text',
		'desc'      => __('Enter your text for search results.', 'freshmind'),
		'label_for' => 'search_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'search_text_label', __('Search results text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

    // Add textfield tag_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'tag_text',
		'desc'      => __('Enter your text for tags page.', 'freshmind'),
		'label_for' => 'tag_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'tag_text_label', __('Text for tags page', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

     // Add textfield author_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'author_text',
		'desc'      => __('Enter your text for author page.', 'freshmind'),
		'label_for' => 'author_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'author_text_label', __('Author page text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

    // Add textfield author_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => '404_text',
		'desc'      => __('Enter your text for 404 page', 'freshmind'),
		'label_for' => '404_text',
        'option_name' => $option_name,
	);
	add_settings_field( '404_text_label', __('404 page text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

    // Add textfield page_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'page_text',
		'desc'      => __('Enter your text for pages.', 'freshmind'),
		'label_for' => 'page_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'page_text_label', __('Pages text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

    // Add textfield cpage_text
	$freshmind_theme_field_params = array(
		'type'      => 'text',
		'id'        => 'cpage_text',
		'desc'      => __('Enter your text for comments page.', 'freshmind'),
		'label_for' => 'cpage_text',
        'option_name' => $option_name,
	);
	add_settings_field( 'cpage_text_label', __('Comments page text', 'freshmind'), 'freshmind_theme_options_display_settings', $options_page, 'freshmind_theme_crumbs', $freshmind_theme_field_params );

}	
add_action( 'admin_init', 'freshmind_theme_crumbs_options_settings' );
 

/*
 * Функция отображения полей ввода
 * Здесь задаётся HTML и PHP, выводящий поля
 */
function freshmind_theme_options_display_settings($args) {
	
	extract( $args );
    //var_dump($args);

    if(!isset($option_name) || !$option_name){
        $option_name = 'main_options';
    }
	
	$o = freshmind_theme_get_options( $option_name );

	//print_r($o);
	
	$o_val = isset($o[$id]) ? $o[$id]: '';
	
	//print_r($defaults);
 
	switch ( $type ) {  
	
		// Text type input
		case 'text':  
			$o_val = esc_attr( stripslashes($o_val) );
			echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o_val' />";  
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
		break;
		
		// Textarea
		case 'textarea':  
			$o_val = esc_attr( stripslashes($o_val) );
			echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o_val</textarea>";  
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
		break;
		
		// Checkbox
		case 'checkbox':
			$checked = ($o_val == 'on') ? " checked='checked'" :  '';  
			echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";  
			echo ($desc != '') ? $desc : "";
			echo "</label>";  
		break;
		
		// Select
		case 'select':
			echo "<select id='$id' name='" . $option_name . "[$id]'>";
			foreach($vals as $v=>$l){
				$selected = ($o_val == $v) ? "selected='selected'" : '';  
				echo "<option value='$v' $selected>$l</option>";
			}
			echo ($desc != '') ? $desc : "";
			echo "</select>";  
		break;
		
		// Radio
		case 'radio':
			echo "<fieldset>";
			foreach($vals as $v=>$l){
				$checked = ($o_val == $v) ? "checked='checked'" : '';  
				echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
			}
			echo "</fieldset>";  
		break; 
	}
}
 
/*
 * Функция проверки правильности вводимых полей
 */
function freshmind_theme_options_validate($input) {
	foreach($input as $k => $v) {
		$valid_input[$k] = trim($v);
 
		/* Вы можете включить в эту функцию различные проверки значений, например
		if(! задаем условие ) { // если не выполняется
			$valid_input[$k] = ''; // тогда присваиваем значению пустую строку
		}
		*/
	}
	return $valid_input;
}

function freshmind_notice() {
	?>
	<div class="updated">
		<p>Настройки сброшены!</p>
	</div>
	<?php
}

