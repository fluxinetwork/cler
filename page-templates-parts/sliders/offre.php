<?php 

$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

$code_postal = get_field('code_postal');
$num_departement = substr($code_postal,0,-3);

$categories = get_the_category();
($categories ) ? $cat_name = $categories[0]->name : $cat_name = 'Non classé';

$permalink = get_permalink();
$date = get_the_date('d M Y');
$title = limitString(get_the_title(), 0, LIMIT_STRING, ' [...]');

$output = '<li class="l-card-slider__cards__row__col">';
$output .= '<a href="'.$permalink.'">';
$output .= '<article class="c-card c-card--emploi">';
$output .= '<header class="c-card__header">';
$output .= '<div class="c-card__header__tag">'.$label_type_de_poste.'</div>';
$output .= '<div class="c-card__header__tag">'.$num_departement.'</div>';
$output .= '<h5 class="c-card__header__cat">'.$cat_name.'</h5>';
$output .= '</header>';
$output .= '<div class="c-card__body">';
$output .= '<span class="t-meta">'.$date.'</span>';
$output .= '<h1 class="c-card__body__title">'.$title.'</h1>';
$output .= '</div>';
$output .= '<footer class="c-card__footer">';
$output .= '<span class="c-link c-link--more">Voir l\'offre</span>';
$output .= '</footer>';
$output .= '</article>';
$output .= '</a>';
$output .= '</li>';

echo $output;

?>
