<?php 

/**
 * The Shortcode
 */
function scrn_slider_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'images'				=> '',
			), $atts 
		) 
	);


	ob_start();

	if($images != '') {
		$images = explode(',', trim($images) );
		if(is_array($images) && count($images) > 0) {
			$slider_id = rand(0, 25000); ?>
			<ul id="slider-<?php echo $slider_id;?>" class="bxslider">
				<?php 
				foreach($images as $id) {
					$url = wp_get_attachment_url($id); 
					?>
					<li><img alt="<?php echo get_the_title($id);?>" title="<?php echo get_the_title($id);?>" src="<?php echo esc_url($url);?>" /></li>
				<?php } ?>
			</ul>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#slider-<?php echo $slider_id;?>").bxSlider({captions: true});
				});
			</script>
		<?php }
	}

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_slider', 'scrn_slider_shortcode' );

/**
 * The VC Functions
 */
function scrn_slider_vc() {
		
	vc_map( 
		array(
			"name" => esc_html__("Image Slider", 'teo'),
			"base" => "scrn_slider",
			"category" => esc_html__('SCRN WP Theme', 'teo'),
			'description' => 'Shows an image slider.',
			"params" => array(
				array(
					"type" => "attach_images",
					"heading" => esc_html__("Images", 'teo'),
					"param_name" => "images",
					"value" => array()
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_slider_vc');