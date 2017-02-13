<?php
if (get_field('add_image') == 1) {
	$post_img_id = get_field('main_image');

	if ($post_img_id) {
		$post_img_array = wp_get_attachment_image_src($post_img_id, 'single', true);
		$post_img_url = $post_img_array[0];	
		$post_caption = get_post($post_img_id)->post_excerpt;

		$output = '<figure class="c-figure">';
		$output .= ' <img src="'.$post_img_url.'" class="c-figure__img">';
		$output .= ' <figcaption class="c-figure__caption">'.$post_caption.'</figcaption>';
		$output .= '</figure>';
		echo $output;
	}
}
?>

<h2 class="l-header__excerpt"><?php echo get_field('fluxi_resum', false, false); ?></h2>