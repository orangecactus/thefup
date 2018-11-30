<?php 

/**
 * The Shortcode
 */
function scrn_headersubheader_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'header'			=> '',
				'subheader'			=> '',
			), $atts 
		) 
	);

	ob_start();

	echo '<header class="vc-block">';

	if($header != '') {
		echo '<h3>' . esc_html($header). ' </h3>';
	}
	if($subheader != '') {
		echo '<p>' . esc_html($subheader) . '</p>';
	}

	echo '</header>';

	?>

	<?php 

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_headersubheader', 'scrn_headersubheader_shortcode' );

/**
 * The VC Functions
 */
function scrn_headersubeader_vc() {
	vc_map( 
		array(
			"name" => esc_html__("Header + Subheader", 'SCRN'),
			"base" => "scrn_headersubheader",
			"category" => esc_html__('SCRN WP Theme', 'SCRN'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Header", 'SCRN'),
					"param_name" => "header",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subheader", 'SCRN'),
					"description" => 'Shown under the header, centered',
					"param_name" => "subheader",
					"value" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_headersubeader_vc');