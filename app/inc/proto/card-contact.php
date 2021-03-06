<?php
	$contact = get_field('contact_referent');
	$contact_id = $contact[0];
	$descriptif_contact = get_field('descriptif_contact', false, false);					

	if( $contact ):			
		$photo = get_field('photo', $contact_id);

		$output = '<a href="mailto:'.get_field('mail_contact', $contact_id).'">';
		$output .= '<article class="c-card">';
		$output .= '<div class="c-card__header" style="background-image: url('.$photo['sizes']['thumbnail'].')"></div>';
		$output .= '<div class="c-card__body">';
		$output .= '<div class="c-card__body__meta"><span class="t-meta">'.$descriptif_contact.'</span></div>';
		$output .= '<h1 class="c-card__body__title">'.get_the_title($contact_id).'</h1>';
		$output .= '</div>';
		$output .= '<div class="c-card__footer"><span class="c-link c-link--more c-card__body__link">Contactez moi</span></div>';
		$output .= '</article>';
		$output .= '</a>';

		echo $output;
		
	endif;
?>