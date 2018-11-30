<?php
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function scrn_customizer( $wp_customize ) {
		
	$wp_customize->add_section( 
		'scrn_logo_section' ,
		array(
			'title'       => esc_html__( 'Logo', 'SCRN' ),
			'priority'    => 30,
			'description' => 'Upload a logo to replace the default site name and description in the header',
		)
	);
	$wp_customize->add_setting( 'scrn_logo', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'scrn_logo', array(
		'label'    			=> esc_html__( 'Logo', 'SCRN' ),
		'section'  			=> 'scrn_logo_section',
		'settings' 			=> 'scrn_logo',
	) ) );

	if( !function_exists('wp_site_icon') ) {
		$wp_customize->add_section( 
			'scrn_favicon_section' ,
			array(
				'title'       => esc_html__( 'Favicon', 'SCRN' ),
				'priority'    => 30,
				'description' => 'Upload a favicon to replace the default site name and description in the header',
			)
		);
		$wp_customize->add_setting( 'scrn_favicon', array('sanitize_callback' => 'esc_url') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'scrn_favicon', array(
			'label'    			=> esc_html__( 'Favicon', 'SCRN' ),
			'section'  			=> 'scrn_favicon_section',
			'settings' 			=> 'scrn_favicon',
		) ) );
	}

	$wp_customize->add_section( 
		'scrn_header_section' ,
		array(
			'title'       => esc_html__('Header info', 'SCRN'),
			'priority'    => 30,
			'description' => esc_html__('Info about the header.', 'SCRN'),
		)
	);

	$wp_customize->add_setting( 'scrn_bgimage', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'scrn_bgimage', array(
		'label'    			=> esc_html__( 'Header background image', 'SCRN' ),
		'section'  			=> 'scrn_header_section',
		'settings' 			=> 'scrn_bgimage',
	) ) );

	$wp_customize->add_setting( 'scrn_header_bgimage', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_header_firsttext',
		array(
			'label'				=> esc_html__( 'Top Header Text (first line)', 'SCRN' ),
			'section'			=> 'scrn_header_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_header_secondtext', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_header_secondtext',
		array(
			'label'				=> esc_html__( 'Top Header Text (second line)', 'SCRN' ),
			'section'			=> 'scrn_header_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_header_description', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_header_description',
		array(
			'label'				=> esc_html__( 'Description(shown below the above texts)', 'SCRN' ),
			'section'			=> 'scrn_header_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_section( 
		'scrn_footer_section' ,
		array(
			'title'       => esc_html__( 'Footer info', 'SCRN' ),
			'priority'    => 30,
			'description' => 'Info shown in the footer.',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_description', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_description',
		array(
			'label'				=> esc_html__( 'Footer header description', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_address', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_address',
		array(
			'label'				=> esc_html__( 'Footer address', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_phone', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_phone',
		array(
			'label'				=> esc_html__( 'Footer phone', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_email', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_email',
		array(
			'label'				=> esc_html__( 'Footer e-mail', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_shortcode', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_shortcode',
		array(
			'label'				=> esc_html__( 'Contact form shortcode', 'SCRN' ),
			'description'		=> esc_html__( 'Use only if you want to replace the default contact form', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_latitude', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_latitude',
		array(
			'label'				=> esc_html__( 'Footer map latitude', 'SCRN' ),
			'description'		=> esc_html__( 'You can take them from this site - http://www.latlong.net', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);

	$wp_customize->add_setting( 'scrn_footer_longitude', array('sanitize_callback' => 'esc_attr') );
	$wp_customize->add_control(
		'scrn_footer_longitude',
		array(
			'label'				=> esc_html__( 'Footer map longitude', 'SCRN' ),
			'description'		=> esc_html__( 'You can take them from this site - http://www.latlong.net', 'SCRN' ),
			'section'			=> 'scrn_footer_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_section( 
		'scrn_social_section' ,
		array(
			'title'       => esc_html__( 'Social Icons', 'SCRN' ),
			'priority'    => 30,
			'description' => esc_html__( 'Shown in the header ', 'SCRN' ),
		)
	);

	$wp_customize->add_setting( 'scrn_social_facebook', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_facebook',
		array(
			'label'				=> esc_html__( 'Facebook URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_twitter', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_twitter',
		array(
			'label'				=> esc_html__( 'Twitter URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_dribbble', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_dribbble',
		array(
			'label'				=> esc_html__( 'Dribbble URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_gplus', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_gplus',
		array(
			'label'				=> esc_html__( 'Google Plus URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_linkedin', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_linkedin',
		array(
			'label'				=> esc_html__( 'LinkedIn URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_instagram', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_instagram',
		array(
			'label'				=> esc_html__( 'Instagram URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_behance', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_behance',
		array(
			'label'				=> esc_html__( 'Behance URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_vimeo', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_vimeo',
		array(
			'label'				=> esc_html__( 'Vimeo URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_youtube', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_youtube',
		array(
			'label'				=> esc_html__( 'YouTube URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_tumblr', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_tumblr',
		array(
			'label'				=> esc_html__( 'Tumblr URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
	$wp_customize->add_setting( 'scrn_social_github', array('sanitize_callback' => 'esc_url') );
	$wp_customize->add_control(
		'scrn_social_github',
		array(
			'label'				=> esc_html__( 'GitHub URL', 'SCRN' ),
			'section'			=> 'scrn_social_section',
			'type'				=> 'text',
		)
	);
}

add_action( 'customize_register', 'scrn_customizer' );
