<?php
/**
* Process "Offres d'emploi"
* ----------------------------------------------------
*/

/**
 * Add or modify "Offres d'emploi"
 */

function fluxi_manage_event(){
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
	if ( isset( $_POST['fluxi_manage_event_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_manage_event_nonce_field'], 'fluxi_manage_event' )) :
		// Verify email & token
		if ( is_numeric($toky_toky) && $toky_toky == 6874269923 ):

			if ( !empty($_POST['title']) && !empty($_POST['publics_event']) && !empty($_POST['themes']) && !empty($_POST['date_event_submit']) && !empty($_POST['departement']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['code_postal']) && !empty($_POST['descriptif_event']) ):

				if($action_form == 'add' || $action_form == 'mod'):
					$title = wp_strip_all_tags($_POST['title']);
					$content = '';					

					$date_event = filter_var( $_POST['date_event_submit'], FILTER_SANITIZE_NUMBER_INT);					

					$metas_tab = array(						
						'date_event'	=> $date_event,
						'departement'	=> filter_var( $_POST['departement'], FILTER_SANITIZE_STRING),
						'adresse'		=> filter_var( $_POST['adresse'], FILTER_SANITIZE_STRING),
						'ville'			=> filter_var( $_POST['ville'], FILTER_SANITIZE_STRING),
						'code_postal'	=> filter_var( $_POST['code_postal'], FILTER_SANITIZE_STRING),
						'descriptif_event'	=> filter_var( $_POST['descriptif_event'], FILTER_SANITIZE_STRING),
						'link_event'		=> filter_var( $_POST['link_event'], FILTER_SANITIZE_URL)

					);

					$publics_event = array_map('strip_tags', $_POST['publics_event']);
					$themes = array_map('strip_tags', $_POST['themes']);

					$content = $metas_tab['descriptif_event'];

					if( $action_form == 'add' && current_user_can( 'publish_posts' ) ):
						// Insert post
						$new_post = array(
						  'post_title'    => $title,
						  'post_content'  => $content,
						  'post_status'   => 'pending',
						  'post_author'   => $current_user->ID,
						  'post_type' 	  => 'evenements'
						);

						$the_post_id = wp_insert_post( $new_post );

						// Insert meta
						foreach( $metas_tab as $key => $value ){
							add_post_meta($the_post_id, $key, $value, true);
							// insert tags
							if($key == 'departement'){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Insert checkboxs
						update_field( 'publics_event', $publics_event, $the_post_id );
						update_field( 'themes', $themes, $the_post_id );

						// Insert tags
						if(!empty($publics_event)){
							foreach( $publics_event as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}
						if(!empty($themes)){
							foreach( $themes as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Notification mail admin
						notify_by_mail (array(CONTACTS_EVENT_1),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Événement en attente de validation',false,'<h2>Nouvel événement ajouté</h2><p>' . $current_user->user_firstname . ' vient d\'ajouter l\'événement <strong>"' . wp_strip_all_tags( $title ) . '"</strong>.<br>Vous devez le publier pour le rendre accessible à tous les utilisateurs du site.<br><br><a style="background-color:#005d8c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_post_id . '&action=edit">Accéder à l\'événement</a></p>');

						// Notification mail current user
						$mail_new_event = array(get_footer_mail(), $redirect_slug);
						notify_by_mail (array($current_user->user_email),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre événement est enregistré', true, get_template_directory() . '/app/inc/mails/new-event.php', $mail_new_event);

						$message_response = 'Votre événement a été ajouté. Il sera publié sur le site après avoir été validé par nos soins.';

					elseif( $action_form == 'mod' && verify_post_author( $current_user->ID, $the_idp ) && current_user_can( 'edit_post', $the_idp ) ):
						// Update post
						$update_post = array(
					      	'ID'           => $the_idp,
					      	'post_content' => $content,
					      	'post_title'   => $title
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

						// Insert checkboxs
						update_field( 'publics_event', $publics_event, $the_idp );
						update_field( 'themes', $themes, $the_idp );

						// Insert tags
						if(!empty($publics_event)){
							foreach( $publics_event as $key => $value ){
								wp_set_post_tags($the_idp, $value, true );
							}
						}
						if(!empty($themes)){
							foreach( $themes as $key => $value ){
								wp_set_post_tags($the_idp, $value, true );
							}
						}

						notify_by_mail ( array(CONTACTS_EVENT_1), 'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Modification d\'un événement',false,'<h2>Modification d\'un événement</h2><p>' . $current_user->user_firstname . ' ' . $current_user->user_lastname . ' vient de modifier l\'événement "' . wp_strip_all_tags( $title ). '".<br><br><a style="background-color:#005d8c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_idp . '&action=edit">Accéder à l\'événement</a></p>');

						// Response
						$message_response = 'Votre événement a été mis à jour.';

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

add_action('wp_ajax_nopriv_fluxi_manage_event', 'fluxi_manage_event');
add_action('wp_ajax_fluxi_manage_event', 'fluxi_manage_event');

