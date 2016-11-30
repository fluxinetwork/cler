<?php
/**
* Process "Participation au concours"
* ----------------------------------------------------
*/

/**
 * Send by mail a "Participation au concours"
 */

function fluxi_participation_concours(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	//$current_user = wp_get_current_user();
	$redirect_slug = filter_var($_POST['link_concours'], FILTER_SANITIZE_URL);
	$toky_toky = $_POST['toky_toky'];

	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$title_concours = filter_var($_POST['titre_concours'], FILTER_SANITIZE_STRING);

	$message_response = 'Erreur dans l\'envoie du formulaire. Essayez de l\'envoyer à nouveau. Contacter-nous si le problème persiste.';

	// Verify nonce
	if ( isset( $_POST['fluxi_participation_concours_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_participation_concours_nonce_field'], 'fluxi_participation_concours' )) :
		// Verify email & token
		if ( is_numeric($toky_toky) && $toky_toky == 5931886351 ):

			if ( !empty($_POST['nom_prenom']) && !empty($_POST['mail_contact']) && !empty($_POST['titre_participation']) && !empty($_POST['accepte_reglement']) ):
					
					$modalites = get_field('regles_concours', $the_idp);					
					$type_concours = get_field('type_concours', $the_idp);

					if( $type_concours == 'cler_obscur'){
						$lien_video = filter_var( $_POST['lien_video'], FILTER_SANITIZE_URL);
					}else{
						$lien_video = '';
					}

					$metas_tab = array(
						'nom_prenom'			=> filter_var( $_POST['nom_prenom'], FILTER_SANITIZE_STRING),
						'nom_structure'			=> filter_var( $_POST['nom_structure'], FILTER_SANITIZE_STRING),
						'email'					=> filter_var( $_POST['mail_contact'], FILTER_SANITIZE_EMAIL),
						'accepte_reglement'		=> filter_var( $_POST['accepte_reglement'], FILTER_SANITIZE_STRING),
						'titre_participation'	=> filter_var( $_POST['titre_participation'], FILTER_SANITIZE_STRING),
						'texte_participation'	=> filter_var( $_POST['texte_participation'], FILTER_SANITIZE_STRING),
						'lien_video'			=> $lien_video,
					);

					// Notification mail participation
					$mail_vars_participation_concours = array(get_footer_mail(), $metas_tab['nom_prenom'], $title_concours, $metas_tab['titre_participation'], $redirect_slug);
					notify_by_mail (array($metas_tab['email']),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre participation à '.$title_concours, true, get_template_directory() . '/app/inc/mails/participation-concours.php', $mail_vars_participation_concours);

					// Notification admin
					
					notify_by_mail (array(CONTACTS_CONCOURS),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Nouvelle participation à "'.$title_concours.'"', false, '<h2>Nouvelle participation à "'.$title_concours.'"</h2>'.
						
						'<p><strong>Nom et prénom :</strong><br> ' . $metas_tab['nom_prenom'] . '</p>'.
						'<p><strong>Nom structure :</strong><br> ' . $metas_tab['nom_structure'] . '</p>'.
						'<p><strong>Titre de la participation :</strong><br> ' . $metas_tab['titre_participation'] . '</p>'.
						'<p><strong>Texte de la participation :</strong><br> ' . $metas_tab['texte_participation'] . '</p>'.
						'<p><strong>Lien : </strong><a href="' . $lien_video . '">' . $lien_video . '</a></p>'.
						
						'<p><a style="background-color:#86bd4c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_idp . '&action=edit">Accéder au concours</a></p>');

					$message_response = 'Votre participation au concours est enregistrée.';

			else:
				// Empty required field
				$reg_errors->add( 'emptyfield', 'Veuillez renseigner tous les champs obligatoires.' );
			endif;

		else:
			// If invalid mail
			$reg_errors->add( 'toky', $message_response );

		endif;

	else :
		// If invalid nonce
		$reg_errors->add( 'nonce', $message_response );
	endif;

	if ( is_wp_error( $reg_errors ) && count( $reg_errors->get_error_messages() ) > 0):
 		$output_errors = '';
		foreach ( $reg_errors->get_error_messages() as $error ) {
			$output_errors .= $error . '<br>';
		}
		$data = array(
			'validation' => 'error',
			'message' => $output_errors
		);
		$results[] = $data;
	else:
		$data = array(
			'validation' => 'success',
			'redirect' => $redirect_slug,
			'message' => $message_response
		);
		$results[] = $data;
	endif;

	// Output JSON
	wp_send_json($results);
}

add_action('wp_ajax_nopriv_fluxi_participation_concours', 'fluxi_participation_concours');
add_action('wp_ajax_fluxi_participation_concours', 'fluxi_participation_concours');


/**
 * Rating
 */

function fluxi_rating_concours(){	

	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;	

	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$the_idc = filter_var($_POST['idc'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Erreur, essayez à nouveau. Contacter-nous si le problème persiste.';

	// Verify nonce
	if ( isset( $_POST['fluxi_rating_concours_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_rating_concours_nonce_field'], 'fluxi_rating_concours' ) ) :

		if( have_rows('candidatures', $the_idp) ):
			$i = 0;
		    while( have_rows('candidatures', $the_idp) ) : the_row(); 
		    	$i++;
		    	$nb_votes = get_sub_field('nombre_votes');

		        if( $i == $the_idc ):
		        	$nb_votes++;
		        	update_sub_field('nombre_votes', $nb_votes);
		        endif;
		    endwhile;

		endif;		


		$message_response = 'Votre vote a été pris en compte.';
	else :
		// If invalid nonce
		$reg_errors->add( 'nonce', $message_response );
	endif;

	if ( is_wp_error( $reg_errors ) && count( $reg_errors->get_error_messages() ) > 0):
 		$output_errors = '';
		foreach ( $reg_errors->get_error_messages() as $error ) {
			$output_errors .= $error . '<br>';
		}
		$data = array(
			'validation' => 'error',
			'message' => $output_errors,
			'refid' => $the_idp
		);
		$results[] = $data;
	else:
		$data = array(
			'validation' => 'success',		
			'message' => $message_response,			
			'refid' => $the_idp
		);
		$results[] = $data;
	endif;

	// Output JSON
	wp_send_json($results);
}

add_action('wp_ajax_nopriv_fluxi_rating_concours', 'fluxi_rating_concours');
add_action('wp_ajax_fluxi_rating_concours', 'fluxi_rating_concours');
