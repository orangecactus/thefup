<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'scrn_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */


/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function scrn_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function scrn_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function scrn_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo $classes; ?>">
		<p><label for="<?php echo $id; ?>"><?php echo $label; ?></label></p>
		<p><input id="<?php echo $id; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo $description; ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object
 */
function scrn_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo $field->row_classes(); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo $field->args( 'description' ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function scrn_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'scrn_register_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function scrn_register_metabox() {
	/**
	 * Metabox to add custom categories select for blog page template
	 */
	$prefix = '_blog_';

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => false,
	) );

	$categories = array();
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach($terms as $term) {
			$categories[$term->term_id] = $term->name;
		}
	}

	$cmb_blog = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Blog page template customization', 'SCRN' ),
		'object_types' => array( 'page', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template-blog.php' ),
		'show_names'   => true, // Show field names on the left
	) );
	$cmb_blog->add_field( array(
		'name'     => esc_html__( 'Categories to show posts from', 'SCRN' ),
		'desc'     => esc_html__( 'If none selected, it will show posts from all', 'SCRN' ),
		'id'       => $prefix . 'categories',
		'type'     => 'multicheck',
		'options' => $categories, // Taxonomy Slug
	) );


	/**
	 * Metabox to add subheader for individual pages
	 */
	$prefix = '_page_';

	$cmb_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Page customization', 'SCRN' ),
		'object_types' => array( 'page' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );
	$cmb_page->add_field( array(
		'name'     => esc_html__( 'Subheader', 'SCRN' ),
		'desc'     => esc_html__( 'Shows up on the homepage, below the page title', 'SCRN' ),
		'id'       => $prefix . 'subheader',
		'type'     => 'textarea_small',
	) );
	$cmb_page->add_field( array(
		'name'     => esc_html__( 'Slogan / separator text', 'SCRN' ),
		'desc'     => esc_html__( 'The text that shows up below the page on the homepage.', 'SCRN' ),
		'id'       => $prefix . 'slogantext',
		'type'     => 'text',
	) );
	$cmb_page->add_field( array(
		'name'     => esc_html__( 'Background image of the separator image showing up AFTER this page', 'SCRN' ),
		'desc'     => esc_html__( 'The image that shows up below the page(as a separator) on the homepage.', 'SCRN' ),
		'id'       => $prefix . 'sloganimg',
		'type'     => 'file',
	) );
	$cmb_page->add_field( array(
		'name'     => esc_html__( 'Background style', 'SCRN' ),
		'desc'     => esc_html__( 'You can choose between the two already-defined background styles or create your own.', 'SCRN' ),
		'id'       => $prefix . 'style',
		'type'     => 'radio',
		'options' => array(
			1 => 'White',
			2 => 'Dark',
		),
		'std' => 1
	) );

	$prefix = '_portfolio_';

	$cmb_portfolio = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Portfolio item details', 'SCRN' ),
		'object_types' => array( 'portfolio' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Thumb', 'SCRN' ),
		'desc'     => esc_html__( 'Add the the thumbnail that will show up initially', 'SCRN' ),
		'id'       => $prefix . 'thumb',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 1 image', 'SCRN' ),
		'desc'     => esc_html__( 'The first image in the slider, is optional', 'SCRN' ),
		'id'       => $prefix . 'image1',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 1 video', 'SCRN' ),
		'desc'     => esc_html__( 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...', 'SCRN' ),
		'id'       => $prefix . 'video1',
		'type'     => 'oembed',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 2 image', 'SCRN' ),
		'desc'     => esc_html__( 'The second image in the slider, is optional', 'SCRN' ),
		'id'       => $prefix . 'image2',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 2 video', 'SCRN' ),
		'desc'     => esc_html__( 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...', 'SCRN' ),
		'id'       => $prefix . 'video2',
		'type'     => 'oembed',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 3 image', 'SCRN' ),
		'desc'     => esc_html__( 'The third image in the slider, is optional', 'SCRN' ),
		'id'       => $prefix . 'image3',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 3 video', 'SCRN' ),
		'desc'     => esc_html__( 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...', 'SCRN' ),
		'id'       => $prefix . 'video3',
		'type'     => 'oembed',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 4 image', 'SCRN' ),
		'desc'     => esc_html__( 'The 4th image in the slider, is optional', 'SCRN' ),
		'id'       => $prefix . 'image4',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 4 video', 'SCRN' ),
		'desc'     => esc_html__( 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...', 'SCRN' ),
		'id'       => $prefix . 'video4',
		'type'     => 'oembed',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 5 image', 'SCRN' ),
		'desc'     => esc_html__( 'The 5th image in the slider, is optional', 'SCRN' ),
		'id'       => $prefix . 'image5',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 5 video', 'SCRN' ),
		'desc'     => esc_html__( 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...', 'SCRN' ),
		'id'       => $prefix . 'video5',
		'type'     => 'oembed',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 6 image', 'SCRN' ),
		'desc'     => esc_html__( 'The 6th image in the slider, is optional', 'SCRN' ),
		'id'       => $prefix . 'image6',
		'type'     => 'file',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Slide 6 video', 'SCRN' ),
		'desc'     => esc_html__( 'If you want to use a video and not an image, put the video here(only from external sites like YouTube, Vimeo, ...', 'SCRN' ),
		'id'       => $prefix . 'video6',
		'type'     => 'oembed',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Type', 'SCRN' ),
		'desc'     => esc_html__( 'The type of your project. Leave empty if not applicable.', 'SCRN' ),
		'id'       => $prefix . 'type',
		'type'     => 'text',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Description', 'SCRN' ),
		'desc'     => esc_html__( 'Some description for your project', 'SCRN' ),
		'id'       => $prefix . 'description',
		'type'     => 'textarea_small',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Button text', 'SCRN' ),
		'desc'     => esc_html__( 'The text on the call to action button, if applicable.', 'SCRN' ),
		'id'       => $prefix . 'buttontext',
		'type'     => 'text',
	) );
	$cmb_portfolio->add_field( array(
		'name'     => esc_html__( 'Button URL', 'SCRN' ),
		'desc'     => esc_html__( 'The url on the call to action button, if applicable.', 'SCRN' ),
		'id'       => $prefix . 'buttonurl',
		'type'     => 'text',
	) );
}