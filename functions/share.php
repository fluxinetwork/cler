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
	if ( !is_singular()) //if it is not a post or a page
		return;
        echo '<meta property="fb:admins" content="1678343189101829"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="Occur Books"/>';
		if( !has_post_thumbnail( $post->ID )  || is_home() ) {
			echo '<meta property="og:image" content="'.get_bloginfo('template_url').$default_image.'"/>';
		}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="'.esc_attr( $thumbnail_src[0] ).'"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );