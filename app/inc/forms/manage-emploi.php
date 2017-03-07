<?php
/**
* Process "Offres d'emploi"
* ----------------------------------------------------
*/

/**
 * Add or modify "Offres d'emploi"
 */

function fluxi_manage_emploi(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$current_user = wp_get_current_user();
	$redirect_slug = get_site_url().'/mon-profil/';
	$toky_toky = filter_var( $_POST['toky_toky'], FILTER_SANITIZE_NUMBER_INT);
	$action_form = filter_var($_POST['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Erreur dans l\'envoie du formulaire. Essayez de l\'envoyer à nouveau. Contacter-nous si le problème persiste.';

	// Verify nonce
	if ( isset( $_POST['fluxi_manage_emploi_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_manage_emploi_nonce_field'], 'fluxi_manage_emploi' )) :
		// Verify email & token
		if ( is_numeric($toky_toky) && $toky_toky == 4796248892 ):

			if ( !empty($_POST['title']) && !empty($_POST['departement']) && !empty($_POST['type_de_poste']) && !empty($_POST['niveau_detude']) && !empty($_POST['descriptif_organisme']) && !empty($_POST['type_structure']) && !empty($_POST['nom_structure']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['code_postal']) && !empty($_POST['telephone']) && !empty($_POST['contact_email']) && !empty($_POST['missions']) && !empty($_POST['profil_recherche']) && !empty($_POST['nom_prenom_contact']) && !empty($_POST['fonction_contact']) && !empty($_POST['modalite_candidature']) && !empty($_POST['date_candidature_submit']) && !empty($_POST['experience']) ):

				if($action_form == 'add' || $action_form == 'mod'):
					$title = wp_strip_all_tags($_POST['title']);
					$content = '';

					$date_candidature = filter_var( $_POST['date_candidature_submit'], FILTER_SANITIZE_NUMBER_INT);
					$contact_email = filter_var( $_POST['contact_email'], FILTER_SANITIZE_EMAIL);
					$is_adherent = is_adherent_cler();

					$metas_tab = array(
						'departement'		=> filter_var( $_POST['departement'], FILTER_SANITIZE_STRING),
						'type_de_poste'		=> filter_var( $_POST['type_de_poste'], FILTER_SANITIZE_STRING),
						'descriptif_organisme'	=> filter_var( $_POST['descriptif_organisme'], FILTER_SANITIZE_STRING),
						'missions'			=> filter_var( $_POST['missions'], FILTER_SANITIZE_STRING),
						'experience'		=> filter_var( $_POST['experience'], FILTER_SANITIZE_STRING),
						'profil_recherche'	=> filter_var( $_POST['profil_recherche'], FILTER_SANITIZE_STRING),
						'type_structure'	=> filter_var( $_POST['type_structure'], FILTER_SANITIZE_STRING),
						'nom_structure'		=> filter_var( $_POST['nom_structure'], FILTER_SANITIZE_STRING),
						'adresse'			=> filter_var( $_POST['adresse'], FILTER_SANITIZE_STRING),
						'ville'				=> filter_var( $_POST['ville'], FILTER_SANITIZE_STRING),
						'code_postal'		=> filter_var( $_POST['code_postal'], FILTER_SANITIZE_NUMBER_INT),
						'site_internet_structure'	=> filter_var( $_POST['site_internet_structure'], FILTER_SANITIZE_URL),
						'nom_prenom_contact' => filter_var( $_POST['nom_prenom_contact'], FILTER_SANITIZE_STRING),
						'fonction_contact'	=> filter_var( $_POST['fonction_contact'], FILTER_SANITIZE_STRING),
						'telephone'			=> preg_replace('/[^0-9]/', '', $_POST['telephone']),
						'contact_email'		=> $contact_email,
						'date_candidature'	=> $date_candidature

					);

					$niveau_detude = array_map('strip_tags', $_POST['niveau_detude']);
					$modalite_candidature = array_map('strip_tags', $_POST['modalite_candidature']);
					$content = $metas_tab['descriptif_organisme'].'<br>'.$metas_tab['missions'].'<br>'.$metas_tab['profil_recherche'];

					if( $action_form == 'add' && current_user_can( 'publish_posts' ) ):
						// Insert post
						$new_post = array(
						  'post_title'    => $title,
						  'post_content'  => $content,
						  'post_status'   => 'pending',
						  'post_author'   => $current_user->ID,
						  'post_type' 	  => 'offres-emploi'
						);

						$the_post_id = wp_insert_post( $new_post );

						// Insert meta
						foreach( $metas_tab as $key => $value ){
							add_post_meta($the_post_id, $key, $value, true);
							// insert tags
							if($key == 'departement' || $key == 'type_de_poste' || $key == 'type_structure' || $key == 'experience'){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Insert checkboxs
						update_field( 'niveau_detude', $niveau_detude, $the_post_id );
						update_field( 'modalite_candidature', $modalite_candidature, $the_post_id );

						// Insert tags
						if(!empty($niveau_detude)){
							foreach( $niveau_detude as $key => $value ){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Notification mail admin
						notify_by_mail (array(CONTACTS_EMPLOI_1),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Offre d\'emploi en attente de validation',false,'<h2>Nouvelle offre d\'emploi ajoutée</h2><p>' . $current_user->user_firstname . ' vient d\'ajouter l\'offre <strong>"' .  $title . '"</strong>.<br>Vous devez la publier pour la rendre accessible à tous les utilisateurs du site.<br><br><a style="background-color:#86bd4c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_post_id . '&action=edit">Accéder à l\'offre</a></p>');

						// Notification mail contact
						$mail_new_offre = array(get_footer_mail(), $redirect_slug, $is_adherent);
						notify_by_mail (array($current_user->user_email),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre offre d\'emploi est enregistrée', true, get_template_directory() . '/app/inc/mails/new-offre.php', $mail_new_offre);

						if( $is_adherent ):
							$message_response = 'Votre offre a été ajoutée. Elle sera publiée sur le site après avoir été validée par nos soins.';
						else:
							// Message
							$message_response = 'Votre offre a été ajoutée. Une fois validée par nos soins, vous recevrez un email vous permettant de régler la participation de '. get_field('montant_publication_offre_emploi', 'option').' € due pour la publication de votre offre.';
						endif;

					elseif( $action_form == 'mod' && verify_post_author( $current_user->ID, $the_idp ) && current_user_can( 'edit_published_posts', $the_idp ) ):
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
							if( $key == 'departement' || $key == 'type_de_poste' || $key == 'type_structure' || $key == 'experience' ){
								wp_set_post_tags($the_idp, $value, true );
							}
						}

						// Update checkboxs
						update_field( 'niveau_detude', $niveau_detude, $the_idp );
						update_field( 'modalite_candidature', $modalite_candidature, $the_idp );

						// Update tags
						wp_set_post_tags($the_idp, $niveau_detude, true );

						// Response
						$message_response = 'Votre offre a été mise à jour.';

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

add_action('wp_ajax_nopriv_fluxi_manage_emploi', 'fluxi_manage_emploi');
add_action('wp_ajax_fluxi_manage_emploi', 'fluxi_manage_emploi');

/**
*
*	Admin controles
*
*
*/

/**
* Add a metabox with buttons to send email (reçu/ré-adhésion)
*/
function add_control_offre_emp() {
	add_meta_box('manage_offre_metabox', 'Notifications', 'manage_offre_metabox', 'offres-emploi', 'side', 'high');
}

function manage_offre_metabox() {
	global $post;
	$is_payed = get_field('offer_payed');
	$id_recu = get_field('recu_offer', false, false);
	$post_id = $post->ID;
	$author = $post->post_author;

	if(get_field('nb_send_mail_recu')):
		$nb_send_mail_recu = get_field('nb_send_mail_recu');
	else:
		$nb_send_mail_recu = 0;
	endif;

	if(get_field('nb_send_mail_paiement_offre')):
		$nb_send_mail_paiement_offre = get_field('nb_send_mail_paiement_offre');
	else:
		$nb_send_mail_paiement_offre = 0;
	endif;

	echo '<div class="fluxi-metabox">';

		if( $is_payed ):

			echo '<p class="f-success-mess">L\'offre d\'emploi est payée.</p>';
			if( $id_recu && get_post_status( $id_recu ) != '' && get_post_status( $id_recu ) != 'trash' ):
				echo '<a href="#" class="f-button js-send-facture" data-idp="'.$post_id.'" data-idr="'.$id_recu.'">Envoyer le reçu ('.$nb_send_mail_recu.')</a>';

				echo '<p><a href="'.get_edit_post_link($id_recu).'">Consulter le reçu</a></p>';
			else :
				echo '<p class="f-error-mess">Envoyez la demande de paiement et le reçu sera créé automatiquement. Si vous créez le reçu manuellement n\'oublier de relier les posts.</p>';
			endif;

		elseif( is_adherent_cler($author) ):

			echo '<p class="f-success-mess">Offre postée par un adhérent.</p>';

		else:

			echo '<a href="#" class="f-button js-send-paiement" data-idp="'.$post_id.'">Envoyer la demande de paiement ('.$nb_send_mail_paiement_offre.')</a>';

			if( $id_recu && get_post_status( $id_recu ) != '' && get_post_status( $id_recu ) != 'trash' ):
				echo '<p><a href="'.get_edit_post_link($id_recu).'">Consulter le reçu</a></p>';
			endif;
		endif;

	echo '</div>';
}
add_action( 'add_meta_boxes', 'add_control_offre_emp' );
/**
* Send email (paiement)
*
* @param n/a
* @return Json - process response
*/

function send_email_paiement_offre_emp() {

	check_ajax_referer( 'admin_offre_emp_nonce','security');

	// Global array
	$results = array();
	global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$message_response = 'Vous n\'avez pas les droits requis pour effectuer cette action.';
	$montant_offre = get_field('montant_publication_offre_emploi', 'option');

	if( is_user_logged_in() && current_user_can( 'publish_posts' ) ):

		$args_offre_emp = array(
			'post_type' => 'offres-emploi',
			'p' => $the_idp
		);

		$query_offre_emp = new WP_Query( $args_offre_emp );

		if ( $query_offre_emp->have_posts() ) :

			while ( $query_offre_emp->have_posts() ) : $query_offre_emp->the_post();				
				
				if( get_field('recu_offer', false, false) && get_post_status( get_field('recu_offer', false, false) ) != '' && get_post_status( get_field('recu_offer', false, false) ) != 'trash' ):

					// Update reçu
					$id_recu = get_field('recu_offer', false, false);

					$title_offer = get_the_title();
					$date_creation = date('Ymd');
					$today = date('d/m/Y');
					$montant_offre = get_field('montant_publication_offre_emploi', 'option');
					$nom_structure = get_field('nom_structure');
					$nom_contact = get_field('nom_prenom_contact');
					$adresse_structure = get_field('adresse').' '.get_field('code_postal').' '.get_field('ville');
					$author_id = get_the_author_meta( 'ID' );
					$mail_contact = get_the_author_meta( 'user_email', $author_id );
					$telephone = get_field('telephone');
					// security token
					$security_token = bin2hex(random_bytes(24));

					$metas_tab = array(
						'type_recu'		=> 'recu_emploi',
						'montant'		=> $montant_offre,
						'date_creation' => $date_creation,
						'publication'	=> $the_idp,
						'nom_prenom_contact' => $nom_contact,
						'nom_structure' => $nom_structure,
						'adresse' 		=> $adresse_structure,
						'contact_email' => $mail_contact,
						'telephone'		=> $telephone,
						'security_token'=> $security_token
					);

					$update_recu = array(
					  	'ID'           => $id_recu,
					  	'post_title'    => 'Reçu offre : ' . $title_offer,
						'post_status'   => 'pending',
						'post_author'   => $author_id,
						'post_type' 	=> 'recus'
					);

					wp_update_post($update_recu);

					// Update metas
					foreach( $metas_tab as $key => $value ){
						update_post_meta($id_recu, $key, $value);
					}
				else:
					// Création d'un reçu
					$title = get_the_title();
					$date_creation = date('Ymd');
					$today = date('d/m/Y');
					$montant_offre = get_field('montant_publication_offre_emploi', 'option');
					$nom_structure = get_field('nom_structure');
					$nom_contact = get_field('nom_prenom_contact');
					$adresse_structure = get_field('adresse').' '.get_field('code_postal').' '.get_field('ville');
					$telephone = get_field('telephone');
					$author_id = get_the_author_meta( 'ID' );
					$mail_contact = get_the_author_meta( 'user_email', $author_id );
					// security token
					$security_token = bin2hex(random_bytes(24));

					$metas_tab = array(
						'type_recu'		=> 'recu_emploi',
						'montant'		=> $montant_offre,
						'date_creation' => $date_creation,
						'publication'	=> $the_idp,
						'nom_prenom_contact' => $nom_contact,
						'nom_structure' => $nom_structure,
						'adresse' 		=> $adresse_structure,
						'contact_email' => $mail_contact,
						'telephone'		=> $telephone,
						'security_token'=> $security_token
					);

					$new_recu = array(
						'post_title'    => 'Reçu offre : ' . $title,
						'post_status'   => 'pending',
						'post_author'   => $author_id,
						'post_type' 	=> 'recus'
					);

					$id_recu = wp_insert_post( $new_recu );

					// Insert meta
					foreach( $metas_tab as $key => $value ){
						add_post_meta($id_recu, $key, $value, true);
					}

					// Update recu_offer field of offer
					update_post_meta($the_idp, 'recu_offer', $id_recu);
				endif;


				// Update count sending
				$nb_send_mail_paiement_offre = get_field('nb_send_mail_paiement_offre');
				if( $nb_send_mail_paiement_offre ):
					$nb_send_mail_paiement_offre = ($nb_send_mail_paiement_offre + 1);
					update_field( 'nb_send_mail_paiement_offre', $nb_send_mail_paiement_offre, $the_idp );
				else:
					add_post_meta($the_idp, 'nb_send_mail_paiement_offre', 1);
				endif;

				// Paiement url
				$refer_url = home_url().'/payer/?st='.$security_token.'&ido='.$the_idp.'&idr='.$id_recu;

				// Procédure de paiement offre d'emploi
				$mail_vars_paiement = array(get_footer_mail(), $today, $nom_structure, $adresse_structure, $nom_contact, $montant_offre, $refer_url );
				notify_by_mail (array($mail_contact),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Payer le publication de votre offre d\'emploi sur le site du CLER', true, get_template_directory() . '/app/inc/mails/paiement-offre.php', $mail_vars_paiement);				
				

				$message_response = 'L\'email contenant la procédure de paiement a bien été envoyé.';
				
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

    // Handle the ajax request
    wp_die();
}
add_action( 'wp_ajax_send_email_paiement_offre_emp', 'send_email_paiement_offre_emp' );



/**
* Send email (reçu)
*
* @param n/a
* @return Json - process response
*/

function send_email_facture_offre() {

	check_ajax_referer( 'admin_offre_emp_nonce','security');

	// Global array
	$results = array();
	global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$the_idr = filter_var($_POST['idr'], FILTER_SANITIZE_NUMBER_INT);
	$message_response = 'Vous n\'avez pas les droits requis pour effectuer cette action.';

	if( is_user_logged_in() && current_user_can( 'publish_posts' ) ):

		$args_adherent = array(
			'post_type' => 'recus',
			'p' => $the_idr
		);

		$query_adherent = new WP_Query( $args_adherent );

		if ( $query_adherent->have_posts() ) :

			while ( $query_adherent->have_posts() ) : $query_adherent->the_post();

				$today = date('d/m/Y');
				$title_post = get_the_title($the_idp);
				$mail_contact = get_field('contact_email');
				$nom_prenom_contact = get_field('nom_prenom_contact');
				$nom_structure = get_field('nom_structure');
				$adresse_structure = get_field('adresse').' '.get_field('code_postal').' '.get_field('ville');
				$telephone = get_field('telephone');
				$date_paiement = get_field('date_paiement');
				$montant = get_field('montant');

				$mode_paiement = get_field('mode_paiement');
				if($mode_paiement=='cb'):
					$num_mode_paiement = get_field('derniers_chiffres');
				elseif($mode_paiement=='virement'):
					$num_mode_paiement = get_field('num_virement');
				else:	
					$num_mode_paiement = get_field('num_cheque');
				endif;

				// Update count sending
				$nb_send_mail_slug = 'nb_send_mail_recu';
				$nb_send_mail_recu = get_field($nb_send_mail_slug);
				if( $nb_send_mail_recu ):
					$nb_send_mail_recu = ($nb_send_mail_recu+1);
					update_field( $nb_send_mail_slug, $nb_send_mail_recu, $the_idp );
				else:
					add_post_meta($the_idp, $nb_send_mail_slug, 1);
				endif;

				// Mail du reçu
				$mail_vars_recu = array(get_footer_mail(), $montant, $today, $nom_structure, $adresse_structure, $date_paiement, $num_mode_paiement, $mode_paiement, $title_post);
				notify_by_mail (array($mail_contact),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Reçu de votre paiement', true, get_template_directory() . '/app/inc/mails/recu-offre-emploi.php', $mail_vars_recu);

				$message_response = 'L\'email contenant le reçu a bien été envoyé.';

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

    // Handle
    wp_die();
}
add_action( 'wp_ajax_send_email_facture_offre', 'send_email_facture_offre' );

