<?php
$post_img_id = get_field('main_image');
global $post_img_url;
$post_img_url = 'none';
if ($post_img_id) {
	global $isMobile;
	($isMobile) ? $img_size = 'thumb2x' : $img_size = 'thumbnail';
	$post_img_array = wp_get_attachment_image_src($post_img_id, $img_size, true);
	$post_img_url = $post_img_array[0];
}
?>