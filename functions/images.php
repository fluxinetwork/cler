<?php

/**
 * Add post thumbnail
 * add_image_size('name', width, height, crop);
 */
function add_img_sizes() {
	add_image_size('publi', 180, 230, true);
	add_image_size('card--rss', 260, 175, true);
	add_image_size('thumb2x', 360, 360, true);
}
add_action('after_setup_theme', 'add_img_sizes');


/**
 * Clean images name
 */
add_filter('sanitize_file_name', 'remove_accents' );


/**
 * Remove <p> tag around images in the_content
 */
function filter_ptags_on_img($content) {
	return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'filter_ptags_on_img');


/**
 * Add mime-type
 */
function add_mime( $existing_mimes = array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}
add_filter('upload_mimes', 'add_mime');





