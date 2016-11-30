<?php
/**
* Process "Participation au webinaire"
* ----------------------------------------------------
*/

/**
 * Add "Participation au webinaire"
 */

function fluxi_participation_webinaire(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$current_user = wp_get_current_user();
	$redirect_slug = home_url().'/mon-profil/';
	$toky_toky = $_POST['toky_toky'];
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$date_webinaire = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
	$hour_webinaire = filter_var($_POST['heure'], FILTER_SANITIZE_STRING);

	$message_response = 'Erreur dans l\'envoie du formulaire. Essayez de l\'envoyer à nouveau. Contacter-nous si le problème persiste.';

	// Verify nonce
	if ( isset( $_POST['fluxi_participation_webinaire_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_participation_webinaire_nonce_field'], 'fluxi_participation_webinaire' )) :
		// Verify email & token
		if ( is_numeric($toky_toky) && $toky_toky == 3548597123 ):

			if ( !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['nombre_participants']) ):

				$email_participant = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);

				if( !participation_webinaire_registered($email_participant, $the_idp) ):

					$metas_tab = array(
						'nom'		=> filter_var( $_POST['nom'], FILTER_SANITIZE_STRING),
						'prenom'	=> filter_var( $_POST['prenom'], FILTER_SANITIZE_STRING),
						'email'		=> $email_participant,
						'nombre_participants'	=> filter_var( $_POST['nombre_participants'], FILTER_SANITIZE_NUMBER_INT),
						'adherent_cler'	=> filter_var( $_POST['adherent_cler'], FILTER_SANITIZE_STRING),
						'nom_structure'		=> filter_var( $_POST['nom_structure'], FILTER_SANITIZE_STRING),
					);

					// Add row in the repeater
					$participation = add_row('participants', $metas_tab, $the_idp);

					// Notification mail participation
					$mail_vars_recap_webinaire = array($metas_tab['nom'],$metas_tab['prenom'],$metas_tab['nombre_participants'],$date_webinaire, $hour_webinaire, get_footer_mail());
					notify_by_mail (array($metas_tab['email']),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Webinaire du '.$date_webinaire, true, get_template_directory() . '/app/inc/mails/recap-webinaire.php', $mail_vars_recap_webinaire);

					$message_response = 'Votre demande de participation au webinaire est enregistrée.';

				else:
					// A participation to the webinaire is already registered
					$reg_errors->add( 'alreadysend', 'Vous avez déjà envoyé une demande de participation à ce webinaire. Pour modifier votre participation contactez-nous directement par téléphone au 01 55 86 80 00.' );
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

add_action('wp_ajax_nopriv_fluxi_participation_webinaire', 'fluxi_participation_webinaire');
add_action('wp_ajax_fluxi_participation_webinaire', 'fluxi_participation_webinaire');




/**
*
*	Admin controles
*
*
*/

/**
* Add a metabox with buttons to send email with webinaires infos
*/
function add_control_webinaire() {
	add_meta_box('manage_webinaire_metabox', 'Notifications', 'manage_webinaire_metabox', 'webinaires', 'side', 'default');
}

function manage_webinaire_metabox() {
	global $post;

	echo '<div class="fluxi-metabox">';

		$mail_already_send = get_post_meta( $post->ID, 'email_participation_webinaire_sended', true );
		$texte_bouton = 'Envoyer un email aux participants';
		if ( ! empty( $mail_already_send ) && $mail_already_send == 1) {
			$texte_bouton = 'Ré-envoyer un email aux participants';
		    echo '<p class="f-warning-mess">Vous avez déjà envoyé un email à tous les participants !</p>';
		}

		echo '<a href="#" class="f-button" id="js-send-recap-participation" data-idp="'.$post->ID.'">'.$texte_bouton.'</a>';

	echo '</div>';

}
add_action( 'add_meta_boxes', 'add_control_webinaire' );



/**
* Add a metabox with buttons to send email with webinaires infos
*
* @param n/a
* @return Json - process response
*/

function send_email_participation_webinaire() {

	check_ajax_referer( 'admin_webinaire_nonce','security');

	// Global array
	$results = array();
	global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$message_response = 'Vous n\'avez pas les droits requis pour effectuer cette action.';


	if( is_user_logged_in() && current_user_can( 'publish_posts' ) ):

		$args_adherent = array(
			'post_type' => 'webinaires',
			'p' => $the_idp
		);

		$query_adherent = new WP_Query( $args_adherent );

		if ( $query_adherent->have_posts() ) :

			while ( $query_adherent->have_posts() ) : $query_adherent->the_post();

				$date_webinaire = get_field('date_webinaire');
				$hour_webinaire = get_field('heure_webinaire');

				$rows = get_field('participants');
				if($rows):
					foreach($rows as $row){
						// notify
						$mail_vars_recap_webinaire = array($metas_tab['nom'],$metas_tab['prenom'],$metas_tab['nombre_participants'],$date_webinaire, $hour_webinaire, get_footer_mail());
						notify_by_mail (array($row['email']),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Webinaire du '.$date_webinaire,true, get_template_directory() . '/app/inc/mails/recap-webinaire.php', $mail_vars_recap_webinaire);
					}

					update_post_meta($the_idp, 'email_participation_webinaire_sended', '1');

					$message_response = 'L\'email contenant le récapitulatif du webinaire a bien été envoyé.';

				else:	
					$message_response = 'Il n\'y a pas de participant, aucun email n\'a été envoyé.';	
				endif;				

			endwhile;

		endif;
		wp_reset_postdata();


	else:

		$reg_errors->add( 'nonce', $message_response );

	endif;

	// Error process
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
			'message' => $message_response
		);
		$results[] = $data;
	endif;

	// Output JSON
	wp_send_json($results);

    wp_die();
}
add_action( 'wp_ajax_send_email_participation_webinaire', 'send_email_participation_webinaire' );



