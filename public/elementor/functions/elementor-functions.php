<?php
/**
 * Returns the value of all categories of posts on the site
 * 
 * @since 1.0.0
 */
function drozd_elementor_categories() {
	$output     = array();
	$categories = get_categories();

	foreach ( $categories as $category ) {
		$output[ $category->term_id ] = $category->name;
	}

	return $output;
}

/**
 * Cropped images size
 * 
 * @since 1.0.0
 */
add_action( 'after_setup_theme', 'drozd_elementor_setup' );
function drozd_elementor_setup() {

	// Cropping the images to different sizes to be used in Post Grid
	add_image_size( 'drozd-post-grid-large', 600, 455, true );
	add_image_size( 'drozd-post-grid-medium', 600, 245, true );
	add_image_size( 'drozd-post-grid-small', 300, 210, true );
	add_image_size( 'drozd-post-style-2-medium', 400, 250, true );
	add_image_size( 'drozd-post-style-2-small', 100, 70, true );
	add_image_size( 'drozd-post-style-3-medium', 290, 450, true );
	add_image_size( 'drozd-post-style-12-medium', 230, 150, true );
	add_image_size( 'drozd-post-style-13-medium', 400, 200, true );
	add_image_size( 'drozd-post-style-14-medium', 300, 310, true );
	add_image_size( 'drozd-post-style-14-large', 600, 310, true );
	add_image_size( 'drozd-post-style-18-large', 800, 400, true );
	add_image_size( 'drozd-post-style-19-large', 1200, 570, true );
}

/**
 * Loads styles on elementor editor
 *
 * @since 1.0.0
 */
add_action( 'elementor/editor/after_enqueue_styles', 'drozd_elementor_styles' );
if ( ! function_exists( 'drozd_elementor_styles' ) ) {

	function drozd_elementor_styles() {
		wp_enqueue_style( 'drozd-icon', DROZD_PLUGINS_URL . 'admin/css/drozd-icon.css', array(), '1.0.0', 'all' );
	}

}

/**
 * Change length excerpts post
 *
 * @since 1.0.2
 */
add_filter( 'excerpt_length', 'drozd_excerpt_length' );
function drozd_excerpt_length( $length ) {
	return 25;
}

/**
 * Change excerpts post
 *
 * @since 1.0.2
 */
add_filter( 'excerpt_more', 'drozd_excerpt_more' );
function drozd_excerpt_more( $more ) {
	return '...';
}

/**
 * Get Contact Form 7
 *
 * @since  1.0.5
 */
function drozd_select_contact_form() {
	$options = array();

	if ( function_exists('wpcf7') ) {

		$wpcf7_form_list = get_posts(array(
			'post_type' => 'wpcf7_contact_form',
			'showposts' => 999,
		));
		$options[0] = esc_html__('Select a Contact Form', 'drozd-addons-for-elementor');
		if ( !empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list) ) {
			foreach ( $wpcf7_form_list as $post ) {
				$options[$post->ID] = $post->post_title;
			}
		} else {
			$options[0] = esc_html__('Create a Form First', 'drozd-addons-for-elementor');
		}

	}
	return $options;
}
