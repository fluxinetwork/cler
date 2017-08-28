<?php
/**
* Process "Appel"
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
function add_control_appel() {
	add_meta_box('manage_appel', 'Accès', 'manage_appel', 'appelcotise', 'side', 'high');
}

function manage_appel() {
	global $post;
	
	$publication_id = get_field('publication', false, false);
	
	$statut_paiement = get_field('statut_paiement');
	
	echo '<div class="fluxi-metabox">';
		echo '<p>Pensez à publier l\'appel à cotisation pour le rendre accessible à l\'utilisateur.</p>';
		if( $publication_id ):
			
			echo '<a href="'.get_edit_post_link($publication_id).'" class="f-button">Voir l\'adhésion</a> ';
		else:
			echo '<p>Vous devez relier l\'appel à cotisation à une adhésion.</p>';
		endif;
		
	echo '</div>';

	
}
add_action( 'add_meta_boxes', 'add_control_appel' );