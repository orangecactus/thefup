<?php 

/**
 * The Shortcode
 */
function scrn_social_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'mainwebsite'					=> '',
				'facebook'			=> '',
				'twitter'			=> '',
				'linkedin'			=> '',
				'youtube'			=> '',
				'dribbble'			=> '',
				'gplus'				=> '',
				'instagram'			=> '',
				'behance'			=> '',
				'vimeo'				=> '',
				'tumblr'			=> '',
				'github'			=> '',
			), $atts 
		) 
	);


	ob_start();

	?>

	<ul class="social list-unstyled list-inline">
		<?php 
		if($mainwebsite != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($mainwebsite) . '"><i class="fa fa-globe"></i></a></li>';
		}
		if($facebook != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($facebook) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if($twitter != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($twitter) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if($linkedin != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin"></i></a></li>';
		}
		if($youtube != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($youtube) . '"><i class="fa fa-youtube"></i></a></li>';
		}
		if($dribbble != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($dribbble) . '"><i class="fa fa-dribbble"></i></a></li>';
		}
		if($gplus != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($gplus) . '"><i class="fa fa fa-google-plus"></i></a></li>';
		}
		if($instagram != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($instagram) . '"><i class="fa fa-instagram"></i></a></li>';
		}
		if($behance != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($behance) . '"><i class="fa fa-behance"></i></a></li>';
		}
		if($vimeo != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($vimeo) . '"><i class="fa fa-vimeo"></i></a></li>';
		}
		if($tumblr != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($tumblr) . '"><i class="fa fa-tumblr"></i></a></li>';
		}
		if($github != '') {
			echo '<li><a target="_blank" rel="nofollow" href="' . esc_url($github) . '"><i class="fa fa-github"></i></a></li>';
		}
		?>
	</ul>

	<?php 

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_social_icons', 'scrn_social_shortcode' );

/**
 * The VC Functions
 */
function scrn_social_vc() {
	vc_map( 
		array(
			"name" => esc_html__("Small social icons", 'SCRN'),
			"base" => "scrn_social_icons",
			"category" => esc_html__('SCRN WP Theme', 'SCRN'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Website URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "mainwebsite",
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
					"heading" => esc_html__("YouTube URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "youtube",
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
					"heading" => esc_html__("Vimeo URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "vimeo",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Tumblr URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "tumblr",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("GitHub URL", 'SCRN'),
					"description" => 'Make sure it starts with http:// or https://',
					"param_name" => "github",
					"value" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_social_vc');