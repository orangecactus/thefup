<?php 

/**
 * The Shortcode
 */
function scrn_calltoaction_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'title'			=> '',
				'description'	=> '',
				'buttontext'	=> 'Sign up',
				'buttonurl' 	=> '#',
				'target'		=> 1
			), $atts 
		) 
	);


	ob_start();

	?>

    <div class="call-to-action">
    	<div class="row">
    		<div class="col-md-9 left">
    			<h3><?php echo esc_attr($title);?></h3>
				<p><?php echo esc_attr($description);?></p>
			</div>
			<div class="col-md-3 right">
		        <?php 
		        if($buttontext != '') {
		        	if($target == 1) {
		        		echo '<a target="_blank" class="btn btn-default" href="' . esc_url($buttonurl) . '">' . esc_attr($buttontext) . '</a>';
		        	}
		        	else {
		        		echo '<a class="btn btn-default" href="' . esc_url($buttonurl) . '">' . esc_attr($buttontext) . '</a>';
		        	}
		       	} 
		       	?>
		    </div>
		</div>
	</div>

	<?php 

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_calltoaction', 'scrn_calltoaction_shortcode' );

/**
 * The VC Functions
 */
function scrn_calltoaction_vc() {
		
	vc_map( 
		array(
			"name" => esc_html__("Call to action (text + button)", 'SCRN'),
			"base" => "scrn_calltoaction",
			"category" => esc_html__('SCRN WP Theme', 'SCRN'),
			'description' => 'Call to action variation, text + button.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'SCRN'),
					"param_name" => "title",
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
					"heading" => esc_html__("Button text", 'SCRN'),
					"param_name" => "buttontext",
					"value" => esc_html__('Say hello', 'SCRN')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button URL", 'SCRN'),
					"param_name" => "buttonurl",
					"value" => '#'
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Should the link open in new tab?", 'SCRN'),
					"param_name" => "target",
					"value" => array(
						'New tab'	=> 1,
						'Same tab'	=> 2
					),
					"std" => 1
				)
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_calltoaction_vc');