<?php
/**
* Process "Formations"
* ----------------------------------------------------
*/

/**
 * Add or modify "Formations"
 */

function fluxi_manage_formation(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$current_user = wp_get_current_user();
	$redirect_slug = home_url().'/mon-profil/';
	$toky_toky = $_POST['toky_toky'];
	$action_form = filter_var($_POST['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Erreur dans l\'envoie du formulaire. Essayez de l\'envoyer à nouveau. Contacter-nous si le problème persiste.';

	// Verify nonce
	if ( isset( $_POST['fluxi_manage_formation_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_manage_formation_nonce_field'], 'fluxi_manage_formation' )) :
		// Verify email & token
		if ( is_numeric($toky_toky) && $toky_toky == 68415684348 ):

			if ( !empty($_POST['title']) && !empty($_POST['departement']) && !empty($_POST['descriptif_formation']) && !empty($_POST['publics']) && !empty($_POST['secteur']) && !empty($_POST['niveau_detude']) && !empty($_POST['thematique']) && !empty($_POST['nom_centre']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['code_postal']) && !empty($_POST['telephone']) && !empty($_POST['contact_email']) && !empty($_POST['agrement_formateree']) && !empty($_POST['type_duree_formation']) ):

				if($action_form == 'add' || $action_form == 'mod'):
					$title = wp_strip_all_tags($_POST['title']);
					$content = '';

					$is_adherent = filter_var( $_POST['is_adherent'], FILTER_SANITIZE_STRING);
					$contact_email = filter_var( $_POST['contact_email'], FILTER_SANITIZE_EMAIL);

					$metas_tab = array(
						'is_adherent'		=> $is_adherent,
						'departement'		=> filter_var( $_POST['departement'], FILTER_SANITIZE_STRING),
						'adresse_formation' => filter_var( $_POST['adresse_formation'], FILTER_SANITIZE_STRING),						
						'type_duree_formation' => filter_var( $_POST['type_duree_formation'], FILTER_SANITIZE_STRING),
						'agrement_formateree' => filter_var( $_POST['agrement_formateree'], FILTER_SANITIZE_STRING),
						'cout_formation' => filter_var( $_POST['cout_formation'], FILTER_SANITIZE_STRING),
						'nom_centre' => filter_var( $_POST['nom_centre'], FILTER_SANITIZE_STRING),
						'descriptif_formation'	=> filter_var( $_POST['descriptif_formation'], FILTER_SANITIZE_STRING),
						'adresse'			=> filter_var( $_POST['adresse'], FILTER_SANITIZE_STRING),
						'ville'				=> filter_var( $_POST['ville'], FILTER_SANITIZE_STRING),
						'code_postal'		=> filter_var( $_POST['code_postal'], FILTER_SANITIZE_NUMBER_INT),
						'telephone'			=> preg_replace('/[^0-9]/', '', $_POST['telephone']),
						'site_internet'	=> filter_var( $_POST['site_internet'], FILTER_SANITIZE_URL),
						'contact_email'		=> $contact_email
					);

					$publics = array_map('strip_tags', $_POST['publics']);
					$secteur = array_map('strip_tags', $_POST['secteur']);
					$niveau_detude = array_map('strip_tags', $_POST['niveau_detude']);
					$thematique = array_map('strip_tags', $_POST['thematique']);
					
					$content = $metas_tab['descriptif_formation'];

					if( $action_form == 'add' && current_user_can( 'publish_posts' ) ):
						// Insert post
						$new_post = array(
						  'post_title'    => $title,
						  'post_content'  => $content,
						  'post_status'   => 'pending',
						  'post_author'   => $current_user->ID,
						  'post_type' 	  => 'formations'
						);

						$the_post_id = wp_insert_post( $new_post );

						// Insert meta
						foreach( $metas_tab as $key => $value ){
							add_post_meta($the_post_id, $key, $value, true);
							// insert tags
							if($key == 'departement' || $key == 'agrement_formateree' || $key == 'type_duree_formation'){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Insert checkboxs
						update_field( 'publics', $publics, $the_post_id );
						update_field( 'secteur', $secteur, $the_post_id );
						update_field( 'niveau_detude', $niveau_detude, $the_post_id );
						update_field( 'thematique', $thematique, $the_post_id );						

						// Insert tags
						if(!empty($publics)){
							foreach( $publics as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}
						if(!empty($secteur)){
							foreach( $secteur as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}
						if(!empty($niveau_detude)){
							foreach( $niveau_detude as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}
						if(!empty($thematique)){
							foreach( $thematique as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Notification mail admin
						notify_by_mail (array(CONTACTS_FORMATION_1,CONTACTS_FORMATION_2),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Formation en attente de validation',false,'<h2>Nouvelle formation ajoutée</h2><p>' . $current_user->user_firstname . ' vient d\'ajouter la formation <strong>"' . wp_strip_all_tags( $title ) . '"</strong>.<br>Vous devez la publier pour la rendre accessible à tous les utilisateurs du site.<br><br><a style="background-color:#86bd4c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_post_id . '&action=edit">Accéder à l\'offre</a></p>');

						// Notification mail current user
						$mail_new_formation = array(get_footer_mail(), $redirect_slug, $is_adherent);
						notify_by_mail (array($contact_email),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre formation est enregistrée', true, get_template_directory() . '/app/inc/mails/new-formation.php', $mail_new_formation);

						$message_response = 'Votre formation a été ajoutée. Elle sera publiée sur le site après avoir été validée par nos soins.';

					elseif( $action_form == 'mod' && verify_post_author( $current_user->ID, $the_idp ) && current_user_can( 'edit_post', $the_idp ) ):
						// Update post
						$update_post = array(
					      	'ID'           => $the_idp,
					      	'post_content' => $content,
					      	'post_title'   => wp_strip_all_tags( $title )
						);

						wp_update_post($update_post);

						// Clean all terms
						wp_delete_object_term_relationships( $the_idp, 'post_tag' );
						// Update metas
						foreach( $metas_tab as $key => $value ){
							update_post_meta($the_idp, $key, $value);
							if( $key == 'departement' ){
								wp_set_post_tags($the_idp, $value, true );
							}
						}

						// Update checkboxs
						update_field( 'niveau_detude', $niveau_detude, $the_idp );
						//update_field( 'modalite_candidature', $modalite_candidature, $the_idp );

						// Update tags
						wp_set_post_tags($the_idp, $niveau_detude, true );

						// Response
						$message_response = 'Votre formation a été mise à jour.';

					else:
						// no permission
						$reg_errors->add( 'rights', $message_response );
					endif;

				else:
					// unregistered action
					$reg_errors->add( 'acterror', $message_response );

				endif;

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

add_action('wp_ajax_nopriv_fluxi_manage_formation', 'fluxi_manage_formation');
add_action('wp_ajax_fluxi_manage_formation', 'fluxi_manage_formation');

