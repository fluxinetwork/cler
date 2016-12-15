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

	// Content	
	$main_image_obj = get_field( 'main_image', $post_id);
	$news_img ='';
	
	if ( has_post_thumbnail($post_id) && empty($main_image_obj)) :
		$post_img_id = get_post_thumbnail_id($post_id);
		$post_img_array = wp_get_attachment_image_src($post_img_id, 'card--rss', true);
		$post_img_url = $post_img_array[0];
	
		$news_img = '<img src="'.$post_img_url.'">';
	elseif(!empty($main_image_obj)):
	
		$news_img = '<img src="'.$main_image_obj['sizes']['card--rss'].'">';

	else:

		$news_img = '';
	endif;		

	$content = $news_img . '<p>' . get_field('fluxi_resum', $post_id) .'</p>';

	return $content;
}
add_filter('the_excerpt_rss', 'fluxi_rss_custom');
add_filter('the_content_feed', 'fluxi_rss_custom');