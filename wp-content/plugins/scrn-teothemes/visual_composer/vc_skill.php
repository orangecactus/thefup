<?php 

/**
 * The Shortcode
 */
function scrn_skill_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'percentage'			=> '',
				'name'					=> ''
			), $atts 
		) 
	);


	ob_start();

	$percentage = (int)$percentage;

	if($percentage != 0) {
		if($percentage < 0 || $percentage > 100) {
			$percentage = 0;
		}

		echo '<p class="skill-name"> ' . esc_html($name) . '</p>';
		echo '<div class="skill-bg"></div>';
		echo '<div class="skill-bar" style="width: ' . $percentage . '%"></div>';	
	}

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_skill', 'scrn_skill_shortcode' );

/**
 * The VC Functions
 */
function scrn_skill_vc() {
	vc_map( 
		array(
			"name" => esc_html__("Skill", 'SCRN'),
			"base" => "scrn_skill",
			"category" => esc_html__('SCRN WP Theme', 'SCRN'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Name", 'SCRN'),
					"param_name" => "name",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Percentage", 'SCRN'),
					"description" => 'Values from 0 to 100 are accepted',
					"param_name" => "percentage",
					"value" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_skill_vc');