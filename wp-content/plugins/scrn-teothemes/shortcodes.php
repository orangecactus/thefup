<?php
function filter_shortcode($content) {
	return do_shortcode(strip_tags($content, "<h1><h2><h3><h4><h5><h6><a><img><div><ul><li><ol><table><td><th><span><p><br><strong><em><b><i><iframe><embed>"));
}

add_shortcode('one_third','vp_one_third');
function vp_one_third($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-4">' . $content . '</div>';
	return $output;
}
add_shortcode('one_half','vp_one_half');
function vp_one_half($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-6">' . $content . '</div>';
	return $output;
}

add_shortcode('two_thirds','vp_two_thirds');
function vp_two_thirds($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-8">' . $content . '</div>';
	return $output;
}

add_shortcode('one_fourth','vp_one_fourth');
function vp_one_fourth($atts, $content = null){
	extract(shortcode_atts(array(
		'icon' => '',
	), $atts));
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-3">';
	if($icon !== '')
		$output .= '<img alt="" src="' . esc_attr($icon) . '">';
	$output .= $content;
	$output .= '</div>';
	return $output;
}
add_shortcode('one_column','vp_one_column');
function vp_one_column($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-1">' . $content . '</div>';
	return $output;
}
add_shortcode('two_columns','vp_two_columns');
function vp_two_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-2">' . $content . '</div>';
	return $output;
}
add_shortcode('three_columns','vp_three_columns');
function vp_three_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-3">' . $content . '</div>';
	return $output;
}
add_shortcode('five_columns','vp_five_columns');
function vp_five_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-5">' . $content . '</div>';
	return $output;
}
add_shortcode('six_columns','vp_six_columns');
function vp_six_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-6">' . $content . '</div>';
	return $output;
}
add_shortcode('seven_columns','vp_seven_columns');
function vp_seven_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-7">' . $content . '</div>';
	return $output;
}
add_shortcode('nine_columns','vp_nine_columns');
function vp_nine_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-9">' . $content . '</div>';
	return $output;
}
add_shortcode('ten_columns','vp_ten_columns');
function vp_ten_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-10">' . $content . '</div>';
	return $output;
}
add_shortcode('eleven_columns','vp_eleven_columns');
function vp_eleven_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-11">' . $content . '</div>';
	return $output;
}
add_shortcode('twelve_columns','vp_twelve_columns');
function vp_twelve_columns($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-12">' . $content . '</div>';
	return $output;
}
add_shortcode('full','vp_full');
function vp_full($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="col-sm-12">' . $content . '</div>';
	return $output;
}
add_shortcode('subtext','vp_subtext');
function vp_subtext($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<p class="line2nd">' . $content . '</p>';
	return $output;
}
add_shortcode('skills','vp_skills');
function vp_skills($atts, $content = null){
	$content = filter_shortcode($content);
	return $content;
}
add_shortcode('skill','vp_skill');
function vp_skill($atts, $content = null){
	extract(shortcode_atts(array(
		'value' => '50',
	), $atts));
	$content = filter_shortcode($content);
	$value = (int)$value;
	$output = '<p class="skill-name"> ' . $content . '</p>';
	$output .= '<div class="skill-bg"></div>';
	$output .= '<div class="skill-bar" style="width: ' . (int)$value . '%"></div>';	
	return $output;
}
add_shortcode('lightbox', 'vp_lightbox');
function vp_lightbox($atts, $content = null) {
	extract(shortcode_atts(array(
		'alt' => 0,
		'title' => 0,
		'thumbnail' => 0,
		'width' => 250,
		'height' => 125,
		'float' => 'none'
	), $atts));

	$content = filter_shortcode($content);

	$output = '<div class="pic" style="width: ' . $width . 'px; float: ' . $float;
	if($float == 'left') 
		$output .= '; margin-right: 10px';
	elseif($float == 'right')
		$output .= '; margin-left: 10px';
	$output .= '">';
	$output .= '<div class="proj-img">' . PHP_EOL;
	if($content != '')
	{
		if($title !== 0)
			$title = ' title="' . $title . '"';
		else
			$title = '';
		if($alt !== 0)
			$alt = ' alt="' . $alt . '"';
		else
			$alt = '';
		//the shortcode should return something only if the user sends an image
		$output .= '<a href="' . $content . '" class="prettyPhoto"' . $title . $alt . '></a>' . PHP_EOL;
		if($thumbnail === 0)
		{
			$thumbnail = $content;
		}
		//if the user sends out a thumbnail img, we use that one. If not, we use the full width img to create a thumb.
		$output .= '<img ' . $alt . ' src="' . $thumbnail . '" style="width: ' . $width . 'px; height: ' . $height . 'px" />' . PHP_EOL;
		$output .= '<i>hover background</i>' . PHP_EOL;
		$output .= '</div>
		</div>' . PHP_EOL;
	}
	else
		$output = '';
		return $output;
}

add_shortcode('slider', 'vp_slider');
function vp_slider($atts, $content=null) {
	$id = rand(0, 25000);
	$content = filter_shortcode($content);
	$output = '<ul id="slider-' . $id . '" class="bxslider">';
	$output .= $content;
	$output .= '</ul>';
	$output .= '
	<script type="text/javascript">
		jQuery("#slider-' . $id . '").bxSlider();
	</script>';
	return $output;
}

add_shortcode('slider_img', 'vp_slider_img');
function vp_slider_img($atts, $content=null) {
	extract(shortcode_atts(array(
		'alt' => '',
		'url' => ''
	), $atts));
	$content = filter_shortcode($content);
	if($content != '')
	{
		if($url !== '')
			$output = ' <li><a target="_blank" href="' . esc_url($url) . '"><img alt="' . esc_attr($alt) . '" title="' . esc_attr($alt) . '" src="' . $content . '" /></a></li>' . PHP_EOL;
		else
			$output = ' <li><img alt="' . esc_attr($alt) . '" title="' . esc_attr($alt) . '" src="' . $content . '" /></li>' . PHP_EOL;
		return $output;
	}
	else return '';
}

add_shortcode('portfolio', 'vp_portfolio');
function vp_portfolio($atts, $content=null) {
	$content = filter_shortcode($content);
	$output = '<div class="portfolio">' . PHP_EOL;
	$output .= $content;
	$output .= '</div>
	<div class="clear"></div>';
	return $output;
}

add_shortcode('filterable_portfolio', 'vp_filterable_portfolio');
function vp_filterable_portfolio($atts, $content=null) {
	extract(shortcode_atts(array(
		'categories' => '',
		'number' => 21
	), $atts));
	$id = rand(1, 50000);
	$output = '<div class="filterable-' . $id . '">';
	global $post;
	$categories = esc_attr(trim($categories) );
	$output .= '<div class="col-sm-12"><ul class="filter-list list-inline list-unstyled">
			<li class="filter" data-filter="all">' . esc_html__('All', 'scrn') . '</li>';
	if($categories == '') {
		$cats = get_terms( array(
    		'taxonomy' => 'category',
    	) );
		if ( ! empty( $cats ) && ! is_wp_error( $cats ) ){
			foreach($cats as $cat) {
				$output .= '<li class="filter" data-filter=".' . $cat->term_id . '">' . $cat->name . '</li>';
			}
		}
	}
	else {
		$cats = explode(",", $categories);
		foreach($cats as $term) {
			$category = get_term_by('id', $term, 'category');
			$output .= '<li class="filter" data-filter=".' . $category->term_id . '">' . $category->name . '</li>';
		}
	}

	$output .= '</ul></div>
	<div class="clear"></div>';
	$output .= '<div class="portfolio_details row"></div>';
	$categories = trim($categories);
	$number = (int)$number;
	$output .= '<div id="work-container-' . $id . '" class="work-gallery col-sm-12">
		<div class="row">';
	$query = new WP_Query('post_type=portfolio&posts_per_page=' . $number . '&cat=' . $categories);
	while($query->have_posts() ) : $query->the_post();
		$title = get_the_title();
		$image1 = get_post_meta($post->ID, '_portfolio_image1', true);
		$image2 = get_post_meta($post->ID, '_portfolio_image2', true);
		$image3 = get_post_meta($post->ID, '_portfolio_image3', true);
		$image4 = get_post_meta($post->ID, '_portfolio_image4', true);
		$image5 = get_post_meta($post->ID, '_portfolio_image5', true);
		$image6 = get_post_meta($post->ID, '_portfolio_image6', true);
		$video1 = get_post_meta($post->ID, '_portfolio_video1', true);
		$type = get_post_meta($post->ID, '_portfolio_type', true);
		$description = get_post_meta($post->ID, '_portfolio_description', true);
		$buttontext = get_post_meta($post->ID, '_portfolio_buttontext', true);
		$buttonurl = get_post_meta($post->ID, '_portfolio_buttonurl', true);
		$thumbnail = get_post_meta($post->ID, '_portfolio_thumb', true);
		$video = get_post_meta($post->ID, '_portfolio_video', true);
		if($image1 != '' || $video1 != '')
		{ 
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
			$output .= '<div style="text-align: center" class="col-md-4 col-sm-6 mix ' . $class . '">';
			if($video != '') //if the video field is not empty, we will show the video upon clicking on the zoom icon
				$zoomlink = $video;
			else
				if($image1 != '')
					$zoomlink = $image1;
				elseif($image2 != '')
					$zoomlink = $image2;
				elseif($image3 != '')
					$zoomlink = $image3;
				elseif($image4 != '')
					$zoomlink = $image4;
				elseif($image5 != '')
					$zoomlink = $image5;
				elseif($image6 != '')
					$zoomlink = $image6;
			$output .= '<a class="load-project" rel="nofollow" href="' . get_permalink() . '">
				<img src="' . $thumbnail . '" class="work-thumb img-responsive" alt="" />
	            	<div class="overlay">
	              		<div class="overlay-content">
	                		<h3>' . get_the_title() . '</h3>
	                		<p>' . esc_html__('View Details', 'scrn') . '</p>
	                	</div>
	                </div>
	              </a>
	        ';
			$output .= '</div>';
		}
		endwhile;
	$output .= '</div>
	</div>';
	$output .= '
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery("#work-container-' . $id . '").mixItUp({
			  controls: {
			    activeClass: "on"
			  }
			});

			jQuery("#work-container-' . $id . ' a.load-project").on("click", function(e) {
				e.preventDefault();
				var url = jQuery(this).attr("href");
				jQuery.get(url, function(data) {
					jQuery(".filterable-' . $id . ' .portfolio_details").show(600).html(data);
					var scrollTarget = jQuery(".filterable-' . $id . ' .portfolio_details").offset().top;
			        jQuery("html,body").animate({scrollTop:scrollTarget-80}, 1000, "swing");
				});
			});
		});
	</script>';
	$output .= '<div class="clear"></div>';
	return $output;
}

add_shortcode('portfolio_item', 'vp_portfolio_item');
function vp_portfolio_item($atts, $content=null) {
	extract(shortcode_atts(array(
		'thumbnail' => '',
		'image' => '',
		'title' => '',
		'text' => '',
		'columns' => 3,
		'centered' => 'no',
		'alt' => '',
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns"';
			break;
		case 2:
			$class = 'class="eight columns"';
			break;
		case 3:
			$class = 'class="one-third column"';
			break;
		case 4: 
			$class = 'class="four columns"';
			break;
	}
	if($thumbnail === '')
		$thumbnail = $image;
	if($image !== '')
	{
		if($centered == 'yes')
			$var = ' style="text-align: center" ';
		else
			$var = '';
		$output = '<div ' . $var . $class . '>';
		$output .= '<a class="prettyPhoto" href="' . esc_attr($image) . '"><img alt="' . esc_attr($alt) . '" class="scale-with-grid" src="' . esc_attr($thumbnail) . '" /></a>';
		$output .= '<p class="proj-title">' . esc_attr($title) . '</p>';
		$output .= '<p class="proj-desc">' . esc_attr($text) . '</p>';
		$output .= '</div>';
		return $output;
	}
	else return '';
}
add_shortcode('button', 'vp_button');
function vp_button($atts, $content=null) {
	extract(shortcode_atts(array(
		'url' => '',
		'newwindow' => 'no',
		'color' => 'FADBA1'
	), $atts));
	$content = filter_shortcode($content);
	$color = esc_attr($color);
	if($newwindow == 'yes')
		$target = ' target="_blank" ';
	else
		$target = '';
	if($content !== '')
	{
		if($color === 'FADBA1')
		{
			if($url === '')
				$output = '<button class="btn btn-default">' . $content . '</button>';
			else
				$output = '<a class="btn btn-default" ' . $target . ' href="' . esc_url($url) . '">' . $content . '</a>';
		}
		else
		{
			if($url === '')
				$output = '<button class="btn btn-default" style="background-color: #' . $color . '">' . $content . '</button>';
			else
				$output = '<a class="btn btn-default" ' . $target . ' href="' . esc_url($url) . '" style="background-color: #' . $color . '">' . $content . '</a>';
		}
		return $output;
	}
	else return '';
}

add_shortcode('testimonial', 'vp_testimonial');
function vp_testimonial($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div class="testimonials">
	<p>&ldquo;' . $content . '&rdquo;</p>
	</div>';
}


add_shortcode('clear', 'vp_clear');
function vp_clear($atts, $content=null) {
	return '<div class="clear"></div>';
}
add_shortcode('center', 'vp_centered');
function vp_centered($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div style="text-align: center">' . $content . '</div>';
}
add_shortcode('list', 'vp_list');
function vp_list($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'bullet'
	), $atts));
	$content = filter_shortcode($content);
	if($type == 'bullet')
		$output = '<ul class="list bullet">';
	elseif($type == 'check')
		$output = '<ul class="list check">';
	elseif($type == 'float')
		$output = '<ul class="list float">';
	else return '';
	$output .= $content;
	$output .= '</ul>';
	return $output;
}

add_shortcode('twitter_updates', 'vp_twitter_updates');
function vp_twitter_updates($atts, $content=null) {
	$output = '<div class="last_tweets">
					<div id="twitter_update_list"></div>
				</div> <!-- end last_tweets -->';
	return $output;
}

add_shortcode('pricing_table','til_pricing_table');
function til_pricing_table($atts, $content = null){
	extract(shortcode_atts(array(
		'name' => '',
		'price' => '',
		'price_text' => '',
		'moretext' => 'Sign up',
		'morelink' => '',
		'columns' => '4'
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="col-sm-12 pricing-table"';
			break;
		case 2:
			$class = 'class="col-sm-8 pricing-table"';
			break;
		case 3:
			$class = 'class="col-sm-4 pricing-table"';
			break;
		case 4: 
			$class = 'class="col-sm-3 pricing-table"';
			break;
		default:
			$class = 'class="col-sm-4 pricing-table"';
			break;
	}
	$content = filter_shortcode($content);
	$name = esc_attr($name);
	$price = esc_attr($price);
	$price_text = esc_attr($price_text);
	$moretext = esc_attr($moretext);
	$morelink = esc_url($morelink);
	$output = '';
	$output .= '<div ' . $class .'>';
	if($name !== '')
		$output .= '<p class="pt-title">' . $name . '</p>';
	if($price !== '')
	{
		$output .= '<p class="pt-price">';
		$price = explode('.', $price);
		if($price[0] != '') {
			$output .= $price[0];
			if($price[1] != '') {
				$output .= '<span>.' . $price[1] . '</span>';
			}
		}
		else {
			$output .= $price;
		}
		$output .= '</p>';
		if ($price_text !== '') {
			$output .= '<p class="pt-per">' . $price_text . '</p>';
		}
	}
	$output .= '<ul class="list-unstyled">' . $content . '</ul>';
	if($morelink !== '')
		$output .= '<a class="btn btn-default" href="' . $morelink . '">' . $moretext . '</a>';
	else
		$output .= $moretext;
	$output .= '</div>';
	return $output;
}

add_shortcode('feature','vp_feature');
function vp_feature($atts, $content = null){
	$content = filter_shortcode($content);
	if($content != '')
		return '<li>' . $content . '</li>';	
}

add_shortcode('facebook_small','vp_facebook_small');
function vp_facebook_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="facebook_small">
			<a href="http://facebook.com/' . esc_html($username) . '/" title="facebook">Visit our facebook Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('twitter_small','vp_twitter_small');
function vp_twitter_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="twitter2_small">
			<a href="http://twitter.com/#!/' . esc_html($username) . '/" title="twitter">Visit our twitter Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('twitter_big','vp_twitter_big');
function vp_twitter_big($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="twitter_small">
			<a href="http://twitter.com/#!/' . esc_html($username) . '/" title="twitter">Visit our twitter Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('dribble_small','vp_dribble_small');
function vp_dribble_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="dribble_small">
			<a href="http://dribbble.com/' . esc_html($username) . '/" title="dribble">Visit our dribble Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('vimeo_small','vp_vimeo_small');
function vp_vimeo_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="vimeo_small">
			<a href="http://vimeo.com/' . esc_html($username) . '/" title="vimeo">Visit our vimeo Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('flickr_small','vp_flickr_small');
function vp_flickr_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="flickr_small">
			<a href="http://www.flickr.com/people/' . esc_html($username) . '/" title="flickr">Visit our flickr Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}
add_shortcode('team','vp_team');
function vp_team($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"name" => '',
		"position" => '',
		"description" => '',
		"twitter" => '',
		"facebook" => '',
		"dribble" => '',
		"skype" => '',
		"gplus" => '',
		"linkedin" => '',
		"pinterest" => '',
		"columns" => 3
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="col-sm-12 team"';
			break;
		case 2:
			$class = 'class="col-sm-6 team"';
			break;
		case 3:
			$class = 'class="col-sm-4 team"';
			break;
		case 4: 
			$class = 'class="col-sm-3 team"';
			break;
		default:
			$class = 'class="col-sm-4 team';
			break;
	}
	$output = '<div ' . $class . '>';
	if($image !== '')
		$output .= '<img alt="' . esc_attr($name) . '" class="img-responsive" src="' . esc_attr($image) . '" />';
	if($name !== '')
		$output .= '<p class="team-name">' . esc_attr($name) . '</p>';
	if($position !== '')
		$output .= '<p class="team-job">' . esc_attr($position) . '</p>';
	$output .= '<ul class="social list-unstyled list-inline">';
	if($twitter !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($twitter) . '"><i class="fa fa-twitter"></i></a></li>';
	if($facebook !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($facebook) . '"><i class="fa fa-facebook"></i></a></li>';
	if($dribble !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($dribble) . '"><i class="fa fa-dribbble"></i></a></li>';
	if($skype !== '')
		$output .= '<li><a target="_blank" href="' . esc_attr($skype) . '"><i class="fa fa-skype"></i></a></li>';
	if($gplus !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($gplus) . '"><i class="fa fa-google-plus"></i></a></li>';
	if($linkedin !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin"></i></a></li>';
	if($pinterest !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($pinterest) . '"><i class="fa fa-pinterest"></i></a></li>';
	$output .= '</ul>';

	if($description !== '')
		$output .= '<p>' . esc_attr($description) . '</p>';
	
	$output .= '</div>';
	return $output;
}
add_shortcode('service','vp_service');
function vp_service($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"image" => '',
		"text" => '',
		"columns" => '3',
		"url" => ''
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="col-sm-12 serv-list"';
			break;
		case 2:
			$class = 'class="col-sm-6 serv-list"';
			break;
		case 3:
			$class = 'class="col-sm-4 serv-list"';
			break;
		case 4: 
			$class = 'class="col-sm-3 serv-list"';
			break;
		default:
			$class = 'class="col-sm-4 serv-list"';
			break;
	}
	$text = esc_attr($text);
	$image = esc_attr($image);
	$title = esc_attr($title);
	$output = '<div ' . $class . '>';
	if($image != '')  {
		if($url != '') {
			$output .= '<a href="' . esc_url($url) . '"><img alt="" src="' . $image . '" /></a>';
		}
		else {
			$output .= '<img alt="" src="' . $image . '" />';
		}
	}
	if($title != '')
		$output .= '<h4>' . $title . '</h4>';
	if($text != '')
		$output .= '<p>' . $text . '</p>';
	$output .= '</div>';
	return $output;
}
?>