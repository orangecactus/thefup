<?php 

/**
 * The Shortcode
 */
function scrn_pricing_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'highlight'			=> 1,
				'title'			=> '',
				'price'			=> '',
				'price_per'		=> '',
				'option1'		=> '',
				'option2'		=> '',
				'option3'		=> '',
				'option4'		=> '',
				'option5'		=> '',
				'option6'		=> '',
				'option7'		=> '',
				'buttontext'	=> '',
				'buttonurl'		=> '',
				'target'		=> 1,
			), $atts 
		) 
	);


	ob_start();

	?>

	<?php if($highlight == 2) { ?>
		<div class="pricing-table pt-3">
	<?php } else { ?>
		<div class="pricing-table">
	<?php } ?>

	<?php if($title != '') { ?>
		<p class="pt-title"><?php echo esc_html($title);?></p>
	<?php } ?>

	<?php if($price !== '') { ?>
		<p class="pt-price">
		<?php $price = explode('.', $price);
		if($price[0] != '') {
			if($price[1] != '') { 
				echo $price[0] . '<span>.' . $price[1] . '</span>';
			} else {
				echo $price[0];
			} 
		}
		else {
			echo $price;
		}
		?>
		</p>
		<?php if ($price_per !== '') { ?>
			<p class="pt-per"><?php echo $price_per;?></p>
		<?php } 
	}
	?>

	<?php if($option1 != '') { ?>
		<ul class="list-unstyled">
			<li><?php echo esc_html($option1);?></li>
			<?php 
			if($option2 != '') { 
				echo '<li>' . esc_html($option2) . '</li>';
			} 
			if($option3 != '') { 
				echo '<li>' . esc_html($option3) . '</li>';
			} 
			if($option4 != '') { 
				echo '<li>' . esc_html($option4) . '</li>';
			} 
			if($option5 != '') { 
				echo '<li>' . esc_html($option5) . '</li>';
			} 
			if($option6 != '') { 
				echo '<li>' . esc_html($option6) . '</li>';
			} 
			if($option7 != '') { 
				echo '<li>' . esc_html($option7) . '</li>';
			} 
			?>
		</ul>
	<?php } ?>

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

	<?php 

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_pricing_table', 'scrn_pricing_shortcode' );

/**
 * The VC Functions
 */
function scrn_pricing_vc() {
	vc_map( 
		array(
			"name" => esc_html__("Pricing table", 'SCRN'),
			"base" => "scrn_pricing_table",
			"category" => esc_html__('SCRN WP Theme', 'SCRN'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Is pricing table highlighted?", 'SCRN'),
					"param_name" => "highlight",
					"value" => array(
						'No, default pricing table'	=> 1,
						'Yes, highlight it'	=> 2,
					),
					"std" => 1
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'SCRN'),
					"param_name" => "title",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Price", 'SCRN'),
					"param_name" => "price",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Pricing period", 'SCRN'),
					"description"	=> 'per week / per month, etc',
					"param_name" => "price_per",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 1", 'SCRN'),
					"param_name" => "option1",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 2(optional)", 'SCRN'),
					"param_name" => "option2",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 3(optional)", 'SCRN'),
					"param_name" => "option3",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 4(optional)", 'SCRN'),
					"param_name" => "option4",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 5(optional)", 'SCRN'),
					"param_name" => "option5",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 6(optional)", 'SCRN'),
					"param_name" => "option6",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Option 7(optional)", 'SCRN'),
					"param_name" => "option7",
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
add_action( 'vc_before_init', 'scrn_pricing_vc');