<?php
/*
  add settings section
*/
function freshmind_theme_customizer( $wp_customize ) {
	
    // Add logo 
   
    $wp_customize->add_section( 'logo-box_section' , array(
		'title'       => __( 'Logo', 'freshmind' ),
		'priority'    => 30,
		'description' => 'Upload logo image',
	) );
	
	$wp_customize->add_setting( 'logo-box', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo-box', array(
		'label'        => __( 'Add logo', 'freshmind' ),
		'section'    => 'logo-box_section',
		'settings'   => 'logo-box',
	) ) );
	
	// Customize colors
	/*$wp_customize->add_setting(
		'color-setting',
		array(
			'default' => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color-setting',
			array(
				'label' => __('Color options', 'freshmind'),
				'section' => 'example_section_one',
				'settings' => 'color-setting',
			)
		)
	);*/
	
	$wp_customize->add_setting(
		'site-main-color',
		array(
			'default' => '#044C29',
			'sanitize_callback' => 'sanitize_hex_color',
			
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site-main-color',
			array(
				'label' => __('Main color for elements', 'freshmind'),
				'section' => 'colors',
				'settings' => 'site-main-color',
				'description' => __('Color for elements like H1, this works only when Color skin is none', 'freshmind'),
			)
		)
	);
	
	// Color skins
	$wp_customize->add_setting(	'skin',
        array(
            'default' => 'none',
            'sanitize_callback' => 'wp_kses'
        )
	);
	  
	$wp_customize->add_control(
		'skin',
		array(
			'type' => 'select',
			'label' => __('Color skin', 'freshmind'),
			'section' => 'colors',
			'choices' => array(
                'none' => __('None', 'freshmind'),
				'blue' => __('Blue', 'freshmind'),
				'red'  => __('Red', 'freshmind'),
				'pink' => __('Pink', 'freshmind'),
			),
		)
	);
	
	// Register advanced section
	$wp_customize->add_section( 'advanced_settings' , array(
		'title'       => __( 'Advanced settings', 'freshmind' ),
		//'priority'    => 500,
		'description' => 'Advanced theme settings',
	) );
	
	// Menu dropdown settings
	$wp_customize->add_setting(	'dropdown_toggle',
        array(
            'default' => 'click',
            'sanitize_callback' => 'wp_kses'
        )
	);
	  
	$wp_customize->add_control(
		'dropdown_toggle',
		array(
			'type' => 'select',
			'label' => __('Dropdown toggle way', 'freshmind'),
			'section' => 'advanced_settings',
			'choices' => array(
                'click' => __('On click', 'freshmind'),
				'hover' => __('On hover', 'freshmind'),
			),
		)
	);

    // Navigation bar affix settings
	$wp_customize->add_setting(	'nav_affix',
        array(
            'default' => 'no',
            'sanitize_callback' => 'wp_kses'
        )
	);

	$wp_customize->add_control(
		'nav_affix',
		array(
			'type' => 'radio',
			'label' => __('Must navigation bar affix to top of the page', 'freshmind'),
			'section' => 'advanced_settings',
			'choices' => array(
                'no' => __('No', 'freshmind'),
				'yes' => __('Yes', 'freshmind'),
			),
		)
	);
   
}
add_action( 'customize_register', 'freshmind_theme_customizer' );

?>