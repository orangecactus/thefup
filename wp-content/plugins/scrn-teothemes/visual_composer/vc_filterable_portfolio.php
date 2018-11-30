<?php 

/**
 * The Shortcode
 */
function scrn_filterable_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'categories'			=> '',
				'number'				=> 9
			), $atts 
		) 
	);


	ob_start();

	if($categories != '' ) {
    	$categories = explode(',', trim($categories) );
    }
    $number = (int)$number;

	$id = rand(1, 50000);
	?>
	<div class="filterable-<?php echo $id;?>">
		<ul class="filter-list list-inline list-unstyled">
			<li class="filter" data-filter="all"><?php echo esc_html__('All', 'scrn');?></li>
			<?php 
			if($categories == '') {
				$categories = array();
				$cats = get_terms( array(
		    		'taxonomy' => 'category',
			    	'number'   => 5
			    ) );
				if ( ! empty( $cats ) && ! is_wp_error( $cats ) ){
					foreach($cats as $category) { 
						$categories[] = $category->term_id; ?>
						<li class="filter" data-filter=".<?php echo $category->term_id;?>"><?php echo esc_html($category->name);?></li>
					<?php }
				}
			}
			else {
				foreach($categories as $term) {
					$category = get_term_by('id', $term, 'category'); 
					if($category) { ?>
					<li class="filter" data-filter=".<?php echo $category->term_id;?>"><?php echo esc_html($category->name);?></li>
				<?php }
				}
			} 
			?>
		</ul>
		<div class="clear"></div>
		<div class="portfolio_details row"></div>
		<div id="work-container-<?php echo $id;?>" class="work-gallery">
			<div class="row">
				<?php 
				if(is_array($categories) && count($categories) > 0) {
					$query = new WP_Query('post_type=portfolio&posts_per_page=' . $number . '&cat=' . implode(',', $categories) );
				}
				else {
					$query = new WP_Query('post_type=portfolio&posts_per_page=' . $number);
				}
				while($query->have_posts() ) : $query->the_post(); global $post;
					$title = get_the_title();
					$image1 = get_post_meta($post->ID, '_portfolio_image1', true);
					$image2 = get_post_meta($post->ID, '_portfolio_image2', true);
					$image3 = get_post_meta($post->ID, '_portfolio_image3', true);
					$image4 = get_post_meta($post->ID, '_portfolio_image4', true);
					$image5 = get_post_meta($post->ID, '_portfolio_image5', true);
					$image6 = get_post_meta($post->ID, '_portfolio_image6', true);
					$thumbnail = get_post_meta($post->ID, '_portfolio_thumb', true);
					$video1 = get_post_meta($post->ID, '_portfolio_video1', true);
					
					if($image1 != '' || $video1 != '') { 
						if($thumbnail == '') {
							if($image1 != '')
								$thumbnail = $image1;
							elseif($image2 != '')
								$thumbnail = $image2;
							elseif($image3 != '')
								$thumbnail = $image2;
							elseif($image4 != '')
								$thumbnail = $image4;
							elseif($image5 != '')
								$thumbnail = $image5;
							elseif($image6 != '')
								$thumbnail = $image6;
						}
						$cats = get_the_category();
						$class = '';
						foreach($cats as $cat)
							$class .= $cat->term_id . ' ';
						?>
						<div style="text-align: center" class="col-md-4 col-sm-6 mix <?php echo $class;?>">
							<a class="load-project" rel="nofollow" href="<?php echo get_permalink();?>">
								<img src="<?php echo esc_url($thumbnail);?>" class="work-thumb img-responsive" alt="" />
					            <div class="overlay">
					              	<div class="overlay-content">
					               		<h3><?php echo get_the_title(); ?></h3>
					               		<p><?php echo esc_html__('View Details', 'scrn');?></p>
					               	</div>
					            </div>
				            </a>
				        </div>
				    <?php 
				    }
				endwhile; ?>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(window).load(function() {
				jQuery("#work-container-<?php echo $id;?>").mixItUp({
				  controls: {
				    activeClass: "on"
				  }
				});

				jQuery("#work-container-<?php echo $id;?> a.load-project").on("click", function(e) {
					e.preventDefault();
					var url = jQuery(this).attr("href");
					jQuery.get(url, function(data) {
						jQuery(".filterable-<?php echo $id;?> .portfolio_details").show(600).html(data);
						var scrollTarget = jQuery(".filterable-<?php echo $id;?> .portfolio_details").offset().top;
				        jQuery("html,body").animate({scrollTop:scrollTarget-80}, 1000, "swing");
					});
				});
			});
		</script>
		<div class="clear"></div>
	</div>
	
	<?php 

	$output = ob_get_contents();

	ob_end_clean();
	
	return $output;
}
add_shortcode( 'scrn_filterable_portfolio', 'scrn_filterable_portfolio_shortcode' );

/**
 * The VC Functions
 */
function scrn_filterable_portfolio_vc() {

	$terms = get_terms( 'category', 'hide_empty=0' );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		$categories = array();
	    foreach ( $terms as $term ) {
	        $categories[$term->name] = $term->term_id;
	    }
	}
		
	vc_map( 
		array(
			"name" => esc_html__("Filterable Portfolio", 'teo'),
			"base" => "scrn_filterable_portfolio",
			"category" => esc_html__('SCRN WP Theme', 'teo'),
			'description' => 'Shows an image slider.',
			"params" => array(
				array(
					"type" => "checkbox",
					"heading" => esc_html__("Categories included", 'teo'),
					"param_name" => "categories",
					"value" => $categories
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number of posts", 'teo'),
					"param_name" => "number",
					"value" => '9'
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'scrn_filterable_portfolio_vc');