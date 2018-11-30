<?php 

/**
 * The Shortcode
 */
function scrn_team_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'avatar'			=> '',
				'name'				=> '',
				'position'			=> '',
				'description'		=> '',
				'facebook'			=> '',
				'twitter'			=> '',
				'linkedin'			=> '',
				'dribbble'			=> '',
				'gplus'				=> '',
				'instagram'			=> '',
				'behance'			=> '',
				'tumblr'			=> '',
			), $atts 
		) 
	);


	ob_start();

	echo '<div class="team">';

	if($avatar != '') {
		echo '<img alt="' . esc_attr($name) . '" class="img-responsive" src="' . esc_url(wp_get_attachment_url($avatar) ) . '" />';
	}

	if($name != '') {
		echo '<p class="team-name">' . esc_attr($name) . '</p>';
	}

	if($position != '') {
		echo '<p class="team-job">' . esc_attr($position) . '</p>';
	}

	if($facebook != '' || $twitter != '' || $linkedin != '' || $dribbble != '' || $gplus != '' || $instagram != '' || $behance != '' || $tumblr != '') { 
		echo '<ul class="social list-unstyled list-inline">';

		if($facebook != '') {
			echo '<li><a target="_blank" href="' . esc_url($facebook) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if($twitter !== '') {
			echo '<li><a target="_blank" href="' . esc_url($twitter) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if($linkedin !== '') {
			echo '<li><a target="_blank" href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin"></i></a></li>';
		}
		if($dribbble !== '') {
			echo '<li><a target="_blank" href="' . esc_url($dribbble) . '"><i class="fa fa-dribbble"></i></a></li>';
		}
		if($gplus !== '') {
			echo '<li><a target="_blank" href="' . esc_url($gplus) . '"><i class="fa fa-google-plus"></i></a></li>';
		}
		if($instagram !== '') {
			echo '<li><a target="_blank" href="' . esc_url($instagram) . '"><i class="fa fa-instagram"></i></a></li>';
		}
		if($behance !== '') {
			echo '<li><a target="_blank" href="' . esc_url($behance) . '"><i class="fa fa-behance"></i></a></li>';
		}
		if($tumblr !== '') {
			echo '<li><a target="_blank" href="' . esc_url($tumblr) . '"><i class="fa fa-tumblr"></i></a></li>';
		}

		echo '</ul>';
	}

	if($description !== '') {
		echo '<p>' . esc_attr($description) . '</p>';
	}

	echo '</div>';

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_team', 'scrn_team_shortcode' );

/**
 * The VC Functions
 */
function scrn_team_vc() {
	vc_map( 
		array(
			"name" => esc_html__("Team member", 'SCRN'),
			"base" => "scrn_team",
			"category" => esc_html__('SCRN WP Theme', 'SCRN'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Image", 'SCRN'),
					"param_name" => "avatar",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Name", 'SCRN'),
					"param_name" => "name",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Position", 'SCRN'),
					"param_name" => "position",
					"value" => ''
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'SCRN'),
					"param_name" => "description",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "facebook",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "twitter",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("LinkedIn URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "linkedin",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Dribbble URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "dribbble",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "gplus",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Instagram URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "instagram",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Behance URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "behance",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Tumblr URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "tumblr",
					"value" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_team_vc');