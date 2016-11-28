<?php
/**
* Process "Reçu"
* ----------------------------------------------------
*/

/**
*
*	Admin controles
*
*
*/

/*
* Add a metabox to access related post
*/
function add_control_recu() {
	add_meta_box('manage_recu', 'Accès', 'manage_recu', 'recus', 'side', 'high');
}

function manage_recu() {
	global $post;
	$type_recu = get_field('type_recu');
	$publication_id = get_field('publication', false, false);
	$mode_paiement = get_field('mode_paiement');
	$security_token = get_field('security_token');
	$statut_paiement = get_field('statut_paiement');
	
	echo '<div class="fluxi-metabox">';
		echo '<p>Pensez à publier le reçu pour le rendre accessible à l\'utilisateur.</p>';
		if( $type_recu == 'recu_emploi' && !empty($publication_id) ):
			echo '<a href="'.get_edit_post_link($publication_id).'" class="f-button">Voir l\'offre d\'emploi</a> ';
		elseif( $type_recu == 'recu_adhesion' && !empty($publication_id) ):
			echo '<a href="'.get_edit_post_link($publication_id).'" class="f-button">Voir l\'adhésion</a> ';
		else:
			echo '<p>Vous devez relier le reçu à une publication (offre d\'emploi ou adhésion).</p>';
		endif;

		if( $mode_paiement == 'cb' && !empty($security_token) && !empty($publication_id) && $statut_paiement != 'succeeded' ):
			echo '<hr>';
			echo '<a href="'.home_url().'/payer/?st='.$security_token.'&ido='.$publication_id.'&idr='.get_the_id().'" class="f-button">Page de paiement</a>';	
		endif;
	echo '</div>';

	
}
add_action( 'add_meta_boxes', 'add_control_recu' );