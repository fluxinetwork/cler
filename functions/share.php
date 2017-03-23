<?php

/** 
 * SHARING TOOLS
 *
 * 01. Open Graph meta
 */


/** 
 * 01. Open Graph meta
 */

// Set path to default image to serve if no image is available 
$default_image = "app/img/default_fb.jpg";

// Add Open Graph in the language attributes
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

// Add Open Graph meta in head
function insert_fb_in_head() {
	global $post;
	$post_img_url = get_bloginfo('template_url').'/app/img/default_fb.jpg';

	if ( is_front_page() ) {
		echo '<meta property="og:type" content="website"/>';
        echo '<meta property="og:title" content="' .get_bloginfo('name'). '"/>';
        echo '<meta property="og:description" content="' .get_bloginfo('description'). '"/>';
       	echo '<meta property="og:url" content="' .get_bloginfo('url'). '"/>';
	} else {
		echo '<meta property="og:type" content="article"/>';
		echo '<meta property="og:title" content="' .get_the_title(). '"/>';
		echo '<meta property="og:description" content="' .get_field('google_description'). '"/>';
		echo '<meta property="og:url" content="' .get_permalink(). '"/>';

		if ( get_field('main_image') ) {
			$post_img_array = get_field('main_image');
			$post_img_url = $post_img_array['sizes']['medium'];	
		}
	}

	echo '<meta property="og:image" content="'.$post_img_url.'"/>';
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );