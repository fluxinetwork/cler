<?php

$post_img_id = get_field('main_image');
$post_img_array = wp_get_attachment_image_src($post_img_id, 'full', true);
$post_img_url = $post_img_array[0];	

$permalink = get_permalink();
$date = get_the_date('d M Y');
$title = get_the_title();

$output = '<li class="l-card-slider__cards__row__col">';
$output .= '<a href="'.$permalink.'">';
$output .= '<article class="c-card c-card--emploi">';
$output .= '<header class="c-card__header" style="background-image: url('.$post_img_url.');"></header>';
$output .= '<div class="c-card__body">';
$output .= '<span class="t-meta">'.$date.'</span>';
$output .= '<h1 class="c-card__body__title">'.$title.'</h1>';
$output .= '</div>';
$output .= '<footer class="c-card__footer">';
$output .= '<span class="c-link c-link--more">Lire la suite</span>';
$output .= '</footer>';
$output .= '</article>';
$output .= '</a>';
$output .= '</li>';

echo $output;

?>