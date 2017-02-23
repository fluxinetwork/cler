<?php

/* | RSS - V1.0 - 13/12/16 |
--------------------------------
   | fluxi_rss_custom()
   
*/

/* CUSTOM RSS */

/* Add main image and description ACF fields */
function fluxi_rss_custom($content) {
	global $post;
	$post_id = $post->ID;
	$news_img ='';
	
	// Content	
	if ( get_field('add_image', $post_id) == 1 ) :
		$post_img_id = get_field('main_image', $post_id);
		if($post_img_id):
			$post_img_array = wp_get_attachment_image_src($post_img_id, 'card--rss', true);
			$post_img_url = $post_img_array[0];
			$news_img = '<img src="'.$post_img_url.'">';
		endif;
	endif;	

	$content = $news_img . '' . get_field('fluxi_resum', $post_id) .'';

	return $content;
}
add_filter('the_excerpt_rss', 'fluxi_rss_custom');
add_filter('the_content_feed', 'fluxi_rss_custom');