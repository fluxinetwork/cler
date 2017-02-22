<?php
/**
* Process "Adhèrent"
* ----------------------------------------------------
*/

/**
 * Add or modify "Adhèrent"
 */

function fluxi_manage_adherent(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$current_user = wp_get_current_user();
	$redirect_slug = home_url().'/mon-profil/';
	$toky_toky = filter_var( $_POST['toky_toky'], FILTER_SANITIZE_NUMBER_INT);
	$action_form = filter_var($_POST['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	//$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Erreur dans l\'envoie du formulaire. Essayez de l\'envoyer à nouveau. Contacter-nous si le problème persiste.';

	// Verify nonce
	if ( isset( $_POST['fluxi_manage_adherent_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_manage_adherent_nonce_field'], 'fluxi_manage_adherent' )) :
		// Verify email & token
		if ( is_numeric($toky_toky) && $toky_toky == 6348972154 ):

			if ( !empty($_POST['type_structure']) && !empty($_POST['nom_structure']) && !empty($_POST['adresse']) && !empty($_POST['ville']) && !empty($_POST['code_postal']) && !empty($_POST['telephone_contact1']) && !empty($_POST['email_contact1']) && !empty($_POST['nom_contact1']) && !empty($_POST['prenom_contact1']) && !empty($_POST['fonction_contact1']) && !empty($_POST['activites_territoire']) && !empty($_POST['attente_du_reseau']) && !empty($_POST['contribuer_au_reseau']) && !empty($_POST['connu_cler']) && !empty($_POST['annee_cotisation']) && !empty($_POST['montant_cotisation']) && !empty($_POST['reglement_cler']) && !empty($_POST['charte_adherents'])):

				if( $action_form == 'add' || $action_form == 'mod' || $action_form == 'rad' ):

					$nom_structure = filter_var( $_POST['nom_structure'], FILTER_SANITIZE_STRING);
					$email_contact1 = filter_var( $_POST['email_contact1'], FILTER_SANITIZE_EMAIL);

					$montant_cotisation	= filter_var( $_POST['montant_cotisation'], FILTER_SANITIZE_NUMBER_INT);
					$annee_cotisation = filter_var( $_POST['annee_cotisation'], FILTER_SANITIZE_NUMBER_INT);
					$accepte_charte_energie_positive = filter_var( $_POST['accepte_charte_energie_positive'], FILTER_SANITIZE_STRING);

					$type_adhesion = 'add';

					$metas_tab = array(
						'type_structure'	=> filter_var( $_POST['type_structure'], FILTER_SANITIZE_STRING),
						'nom_structure'		=> $nom_structure,
						'adresse'			=> filter_var( $_POST['adresse'], FILTER_SANITIZE_STRING),
						'ville'				=> filter_var( $_POST['ville'], FILTER_SANITIZE_STRING),
						'code_postal'		=> filter_var( $_POST['code_postal'], FILTER_SANITIZE_NUMBER_INT),
						'nom_contact1' 		=> filter_var( $_POST['nom_contact1'], FILTER_SANITIZE_STRING),
						'prenom_contact1' 	=> filter_var( $_POST['prenom_contact1'], FILTER_SANITIZE_STRING),
						'fonction_contact1'	=> filter_var( $_POST['fonction_contact1'], FILTER_SANITIZE_STRING),
						'email_contact1'	=> $email_contact1,
						'telephone_contact1'=> preg_replace('/[^0-9]/', '', $_POST['telephone_contact1']),
						'add_contact' 		=> filter_var( $_POST['add_contact'], FILTER_SANITIZE_STRING),
						'nom_contact2' 		=> filter_var( $_POST['nom_contact2'], FILTER_SANITIZE_STRING),
						'prenom_contact2' 	=> filter_var( $_POST['prenom_contact2'], FILTER_SANITIZE_STRING),
						'fonction_contact2'	=> filter_var( $_POST['fonction_contact2'], FILTER_SANITIZE_STRING),
						'email_contact2'		=> filter_var( $_POST['email_contact2'], FILTER_SANITIZE_EMAIL),
						'telephone_contact2'=> preg_replace('/[^0-9]/', '', $_POST['telephone_contact2']),
						'activites_territoire'	=> filter_var( $_POST['activites_territoire'], FILTER_SANITIZE_STRING),
						'attente_du_reseau'		=> filter_var( $_POST['attente_du_reseau'], FILTER_SANITIZE_STRING),
						'contribuer_au_reseau'	=> filter_var( $_POST['contribuer_au_reseau'], FILTER_SANITIZE_STRING),
						'connu_cler'			=> filter_var( $_POST['connu_cler'], FILTER_SANITIZE_STRING),
						'nom_elu'		=> filter_var( $_POST['nom_elu'], FILTER_SANITIZE_STRING),
						'prenom_elu'	=> filter_var( $_POST['prenom_elu'], FILTER_SANITIZE_STRING),
						'fonction_elu'	=> filter_var( $_POST['fonction_elu'], FILTER_SANITIZE_STRING),
						'email_elu'		=> filter_var( $_POST['email_elu'], FILTER_SANITIZE_EMAIL),
						'telephone_elu'	=> preg_replace('/[^0-9]/', '', $_POST['telephone_elu']),
						'nom_parrain'	=> filter_var( $_POST['nom_parrain'], FILTER_SANITIZE_STRING),
						'accepte_charte_energie_positive'	=> $accepte_charte_energie_positive,
						'structure_fiscalisee'	=> filter_var( $_POST['structure_fiscalisee'], FILTER_SANITIZE_STRING),
						'reglement_cler'		=> filter_var( $_POST['reglement_cler'], FILTER_SANITIZE_STRING),
						'charte_adherents'		=> filter_var( $_POST['charte_adherents'], FILTER_SANITIZE_STRING)
					);

					// Sanitize Checkbox group
					$reseaux_cler = array_map('strip_tags', $_POST['reseaux_cler']);

					// Title & content
					$title = $nom_structure;
					$content = '';

					// Add action
					if( $action_form == 'add' && current_user_can( 'publish_posts' ) ):
						// Insert post
						$new_post = array(
						  'post_title'    => $title,
						  'post_content'  => $content,
						  'post_status'   => 'pending',
						  'post_author'   => $current_user->ID,
						  'post_type' 	  => 'adherents'
						);

						$the_post_id = wp_insert_post( $new_post );

						// Insert meta
						foreach( $metas_tab as $key => $value ){
							add_post_meta($the_post_id, $key, $value, true);
							// insert tags
							if($key == 'type_structure'){
								wp_set_post_tags($the_post_id, $value, true );
							}
						}

						// Insert checkboxs
						update_field( 'reseaux_cler', $reseaux_cler, $the_post_id );

						// Update année/montant
						$cotisations_value = array(
							array(
								'annee_cotisation' => $annee_cotisation,
								'montant_cotisation' => $montant_cotisation
							)
						);
						update_field( 'field_579614d5a4388', $cotisations_value, $the_post_id );


						// Notification mail admin
						$contacts_equipe_adhesion = array(CONTACTS_ADHESION_1, CONTACTS_ADHESION_2);
						if($accepte_charte_energie_positive){
							$contacts_equipe_adhesion[] = CONTACT_TEPOS;
						}

						notify_by_mail ( $contacts_equipe_adhesion, 'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Adhésion en attente de validation',false,'<h2>Nouvelle demande d\'adhésion</h2><p>' . $current_user->user_firstname . ' ' . $current_user->user_lastname . ' vient d\'ajouter une demande d\'adhésion pour <strong>"' . $nom_structure . '"</strong>.<br><br><a style="background-color:#005d8c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_post_id . '&action=edit">Accéder à l\'adhésion</a></p>');


						// Notification mail adhérent contact1
						$mail_new_adherent = array(get_footer_mail(), $annee_cotisation, $accepte_charte_energie_positive, $redirect_slug, $type_adhesion);
						notify_by_mail (array($email_contact1),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre demande d\'adhésion '.$annee_cotisation, true, get_template_directory() . '/app/inc/mails/adhesion-readhesion.php', $mail_new_adherent);

						$message_response = 'Nous vous remercions de l’intérêt porté au CLER - Réseau pour la transition énergétique. L’équipe du CLER prendra contact avec vous pour un échange téléphonique afin de mieux connaître votre structure, vos activités et votre motivation.';

					// Modify action
					elseif( $action_form == 'mod' || $action_form == 'rad' ):

						$the_idp = get_adherent_idp();

						if( $the_idp != 0 && verify_post_author( $current_user->ID, $the_idp ) && current_user_can( 'edit_post', $the_idp ) ):
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
								if( $key == 'type_structure' ){
									wp_set_post_tags($the_idp, $value, true );
								}
							}

							// Update checkboxs
							update_field( 'reseaux_cler', $reseaux_cler, $the_idp );

							// If is a réadhésion
							if( $action_form == 'rad' ):

								$type_adhesion = 'rad';

								update_field( 'statut_adhesion', 'readhesion', $the_idp );

								// Update année/montant
								$cotisations_value = array(
									'annee_cotisation' => $annee_cotisation,
									'montant_cotisation' => $montant_cotisation
								);
								add_row( 'cotisations', $cotisations_value, $the_idp );

								$message_response = 'Votre demande de réadhésion a été envoyée.';

								// mail à l'utilisateur
								$mail_readhesion = array(get_footer_mail(), $annee_cotisation, $accepte_charte_energie_positive, $redirect_slug, $type_adhesion);
								notify_by_mail (array($email_contact1),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre demande de ré-adhésion '.$annee_cotisation, true, get_template_directory() . '/app/inc/mails/adhesion-readhesion.php', $mail_readhesion);

								// Notification mail admin
								$contacts_equipe_readhesion = array(CONTACTS_ADHESION_1);
								if($accepte_charte_energie_positive){
									$contacts_equipe_readhesion[] = CONTACT_TEPOS;
								}

								notify_by_mail ( $contacts_equipe_readhesion, 'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Ré-adhésion en attente de validation',false,'<h2>Demande de ré-adhésion</h2><p>' . $current_user->user_firstname . ' ' . $current_user->user_lastname . ' vient d\'ajouter une demande de ré-adhésion pour <strong>"' . $nom_structure . '"</strong>.<br><br><a style="background-color:#005d8c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_idp . '&action=edit">Accéder à l\'adhésion</a></p>');


							// if is a modification
							else:								

								// Update repeater
								$counter_cotisations = 0;
								if( have_rows('cotisations', $the_idp) ):					
									while( have_rows('cotisations', $the_idp) ): the_row();
								        if( get_sub_field('annee_cotisation') == $annee_cotisation ):	
											
											$cotisations_value[$counter_cotisations] = array(
												'annee_cotisation' => get_sub_field('annee_cotisation'),
												'montant_cotisation' => $montant_cotisation,
												'date_paiement' => get_sub_field('date_paiement', false, false),
												'recu' => get_sub_field('recu', false, false)
											);
											
											update_field( 'cotisations', $cotisations_value, $the_idp );
										else:
											
											$cotisations_value[$counter_cotisations] = array(
												'annee_cotisation' => get_sub_field('annee_cotisation'),
												'montant_cotisation' => get_sub_field('montant_cotisation'),
												'date_paiement' => get_sub_field('date_paiement', false, false),
												'recu' => get_sub_field('recu', false, false)
											);
											
											update_field( 'cotisations', $cotisations_value, $the_idp );
										endif;
										$counter_cotisations++;
									endwhile;
								endif;

								// notify équipier if is modification
								$contacts_equipe_mod_adhesion = array(CONTACTS_ADHESION_1);
								if($accepte_charte_energie_positive){
									$contacts_equipe_mod_adhesion[] = CONTACT_TEPOS;
								}

								notify_by_mail ( $contacts_equipe_mod_adhesion, 'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>','Modification d\'adhésion en attente de validation',false,'<h2>Modification d\'un bulletin d\'adhésion</h2><p>' . $current_user->user_firstname . ' ' . $current_user->user_lastname . ' vient de modifier le bulletin d\'adhésion pour <strong>"' . $nom_structure . '"</strong>.<br><br><a style="background-color:#005d8c; display:inline-block; padding:10px 20px; color:#fff; text-decoration:none;" href="' .home_url() . '/wp-admin/post.php?post=' . $the_idp . '&action=edit">Accéder à l\'adhésion</a></p>');

								$message_response = 'Votre bulletin d\'adhésion a été mise à jour.';


							endif;

						else:
							// No permission
							$reg_errors->add( 'rights', $message_response );
						endif;
					else:
						// No permission
						$reg_errors->add( 'rights', $message_response );
					endif;

				else:
					// Unregistered action
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

add_action('wp_ajax_nopriv_fluxi_manage_adherent', 'fluxi_manage_adherent');
add_action('wp_ajax_fluxi_manage_adherent', 'fluxi_manage_adherent');





/**
*
*	Admin controles
*
*
*/

/**
* Add a metabox with buttons to send email (reçu/ré-adhésion)
*/
function add_control_adhesion() {
	add_meta_box('manage_adhesion_metabox', 'Notifications', 'manage_adhesion_metabox', 'adherents', 'side', 'default');
}

function manage_adhesion_metabox() {
	global $post;

	$status_adhesion = get_field( 'statut_adhesion' );
	$demande_recu = get_field( 'structure_fiscalisee' );

	echo '<div class="fluxi-metabox">';
		/*if( $status_adhesion == 'cotisation_ok' && $demande_recu ):
			echo '<a href="#" class="f-button" id="js-send-facture" data-idp="'.$post->ID.'">Envoyer le reçu</a>';
		endif;*/

		//if( $status_adhesion == 'attente_validation' || $status_adhesion == 'attente_paiement' || $status_adhesion == 'readhesion'):


			if( have_rows('cotisations') ):
				echo '<ul class="list-reset">';

					// Get recu_id
					while( have_rows('cotisations') ): the_row();

						$recu_id = get_sub_field('recu', false, false);
						$recu_status = get_post_status( $recu_id );

						// Count var mail paiement
						$nb_send_mail_paie_slug = 'nb_send_mail_paiement_' . get_sub_field('annee_cotisation');
						if(get_field($nb_send_mail_paie_slug)):
							$nb_send_mail_paiement = get_field($nb_send_mail_paie_slug);
						else:
							$nb_send_mail_paiement = 0;
						endif;
						// Count var mail recu
						$nb_send_mail_recu_slug = 'nb_send_mail_recu_' . get_sub_field('annee_cotisation');
						if(get_field($nb_send_mail_recu_slug)):
							$nb_send_mail_recu = get_field($nb_send_mail_recu_slug);
						else:
							$nb_send_mail_recu = 0;
						endif;

						// Link to reçu
						$link_recu = '';
						if( $recu_id && get_post_status($recu_id) != '' && get_post_status($recu_id) != 'trash' ):
							$link_recu = '<a href="'.get_edit_post_link($recu_id).'">Modifier le reçu</a>';

						else:
							echo '<p class="f-error-mess">Envoyez l\'appel à cotisation et le reçu sera créé automatiquement. Si vous créez le reçu manuellement n\'oublier pas de relier les posts.</p>';
						endif;


						// Send paiement & reçu
						if( get_sub_field('date_paiement') != '' && get_post_status($recu_id) != '' && get_post_status($recu_id) != 'trash'):
							if( $recu_status != 'publish' ):
								echo '<li><p class="f-error-mess">Veuillez publier le reçu associé pour envoyer l\'email de la cotisation ' . get_sub_field('annee_cotisation') . '.<br>&darr;&darr;<br>' . $link_recu . '.</p></li>';
							else:	
								echo '<li><a href="#" class="f-button js-send-facture" data-idp="'.$post->ID.'" data-year="'. get_sub_field('annee_cotisation') .'" data-montant="'. get_sub_field('montant_cotisation') .'" data-datepaiement="'. get_sub_field('date_paiement') .'" data-idr="'. $recu_id .'">Envoyer le reçu '. get_sub_field('annee_cotisation') .' ('.$nb_send_mail_recu.')</a></li> '. $link_recu;
							endif;
						else:
							echo '<li><a href="#" class="f-button js-send-paiement" data-idp="'.$post->ID.'" data-year="'. get_sub_field('annee_cotisation') .'" data-montant="'. get_sub_field('montant_cotisation') .'">Envoyer l\'appel à cotisation '. get_sub_field('annee_cotisation') .' ('.$nb_send_mail_paiement.')</a></li> '. $link_recu;
						endif;

						echo '<hr>';

				    endwhile;

				echo '</ul>';
			endif;
		//endif;

	echo '</div>';

}
add_action( 'add_meta_boxes', 'add_control_adhesion' );



/**
* Send email (paiement)
*
* @param n/a
* @return Json - process response
*/

function send_email_paiement() {

	check_ajax_referer( 'admin_adherent_nonce','security');

	// Global array
	$results = array();
	global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$annee_cotisation = filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT);
	$montant_cotisation = filter_var($_POST['montant'], FILTER_SANITIZE_NUMBER_INT);
	$message_response = 'Vous n\'avez pas les droits requis pour effectuer cette action.';

	if( is_user_logged_in() && current_user_can( 'publish_posts' ) ):
		if( get_field('email_contact1', $the_idp) ):
			$args_adherent = array(
				'post_type' => 'adherents',
				'p' => $the_idp
			);

			$query_adherent = new WP_Query( $args_adherent );

			if ( $query_adherent->have_posts() ) :

				while ( $query_adherent->have_posts() ) : $query_adherent->the_post();

					$author_id = get_the_author_meta( 'ID' );
					$mail_contact = get_field('email_contact1');
					$today = date('d/m/Y');
					$nom_structure = get_field('nom_structure');
					$nom_prenom_contact = get_field('nom_contact1') .' '.get_field('prenom_contact1');
					$telephone = get_field('telephone_contact1');
					$adresse_structure = get_field('adresse').' '.get_field('code_postal').' '.get_field('ville');
					$security_token_r = bin2hex(random_bytes(24));

					$metas_tab_r = array(
						'type_recu'		=> 'recu_adhesion',
						'annee_cotisation' => $annee_cotisation,
						'montant'		=> $montant_cotisation,
						'date_creation' => date('Ymd'),
						'publication'	=> $the_idp,
						'nom_prenom_contact' => $nom_prenom_contact,
						'nom_structure' => $nom_structure,
						'adresse' 		=> $adresse_structure,
						'contact_email' => $mail_contact,
						'telephone'		=> $telephone,
						'security_token'=> $security_token_r
					);

					// Update status adhésion
					//$statut_adhesion = get_field('statut_adhesion');
					//if( $statut_adhesion == 'attente_validation' ):
						update_field( 'statut_adhesion', 'attente_paiement', $the_idp );
					//endif;

					// Create/update count sending & create/update mail paiement
					$nb_send_mail_slug = 'nb_send_mail_paiement_' . $annee_cotisation;
					$nb_send_mail_paiement = get_field($nb_send_mail_slug);
					if( $nb_send_mail_paiement ):
						$nb_send_mail_paiement = ($nb_send_mail_paiement + 1);
						update_field( $nb_send_mail_slug, $nb_send_mail_paiement, $the_idp );
					else:
						add_post_meta($the_idp, $nb_send_mail_slug, 1);
					endif;

					$counter_cotisations = 0;
					if( have_rows('cotisations') ):					
						while( have_rows('cotisations') ): the_row();
					        if( get_sub_field('annee_cotisation') == $annee_cotisation ):
					        	
					        	$recu_id = get_sub_field('recu', false, false);

					        	if( $recu_id && get_post_status($recu_id) != '' && get_post_status($recu_id) != 'trash' ):		            

									// Update reçu
									$update_recu = array(
										'ID'			=> $recu_id,
										'post_title'    => 'Reçu cotisation '.$annee_cotisation.' - ' . $nom_structure,
										'post_status'   => 'pending',
										'post_author'   => $author_id,
										'post_type' 	=> 'recus'
									);

									wp_update_post($update_recu);

									// Update metas reçu
									foreach( $metas_tab_r as $key => $value ){
										update_post_meta($recu_id, $key, $value);
									}

									$cotisations_value[$counter_cotisations] = array(
										'annee_cotisation' => $annee_cotisation,
										'montant_cotisation' => $montant_cotisation,
										'date_paiement' => get_sub_field('date_paiement', false, false),
										'recu' => $recu_id
									);
									update_field( 'cotisations', $cotisations_value, $the_idp );

									// Paiement url
							        $paiement_url = home_url().'/payer/?st='.$security_token_r.'&ido='.$the_idp.'&idr='.$recu_id;

							        // Appel à cotisation
									$mail_vars_paiement = array(get_footer_mail(), $montant_cotisation, $today, $nom_structure, $adresse_structure, $annee_cotisation, $paiement_url );
									notify_by_mail (array($mail_contact),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Payer votre cotisation d\'adhésion '.$annee_cotisation.' au CLER', true, get_template_directory() . '/app/inc/mails/appel-cotisation.php', $mail_vars_paiement);

									$message_response = 'L\'email contenant la procédure de paiement de la cotisation '.$annee_cotisation.' a bien été envoyé.';

						        else:

						        	// Création d'un pré-reçu
									$new_recu = array(
										'post_title'    => 'Reçu cotisation '.$annee_cotisation.' - ' . $nom_structure,
										'post_status'   => 'pending',
										'post_author'   => $author_id,
										'post_type' 	=> 'recus'
									);

									$recu_id = wp_insert_post( $new_recu );

									// Insert meta
									foreach( $metas_tab_r as $key => $value ){
										add_post_meta($recu_id, $key, $value, true);
									}

									$cotisations_value[$counter_cotisations] = array(
										'annee_cotisation' => $annee_cotisation,
										'montant_cotisation' => $montant_cotisation,
										'date_paiement' => get_sub_field('date_paiement', false, false),
										'recu' => $recu_id
									);
									update_field( 'cotisations', $cotisations_value, $the_idp );
								

									$paiement_url = home_url().'/payer/?st='.$security_token_r.'&ido='.$the_idp.'&idr='.$recu_id;

									// Appel à cotisation
									$mail_vars_paiement = array(get_footer_mail(), $montant_cotisation, $today, $nom_structure, $adresse_structure, $annee_cotisation, $paiement_url );
									notify_by_mail (array($mail_contact),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Payer votre cotisation d\'adhésion '.$annee_cotisation.' au CLER', true, get_template_directory() . '/app/inc/mails/appel-cotisation.php', $mail_vars_paiement);

									$message_response = 'L\'email contenant la procédure de paiement de la cotisation '.$annee_cotisation.' a bien été envoyé.';

								endif;
							else:	
									// Update repeater
									$cotisations_value[$counter_cotisations] = array(
										'annee_cotisation' => get_sub_field('annee_cotisation'),
										'montant_cotisation' => get_sub_field('montant_cotisation'),
										'date_paiement' => get_sub_field('date_paiement', false, false),
										'recu' => get_sub_field('recu', false, false)
									);
									
									update_field( 'cotisations', $cotisations_value, $the_idp );
					        endif;

					        $counter_cotisations++;
				    	endwhile;

				    else:
				    	$reg_errors->add( 'recu', 'Vérifiez que le reçu existe. Sinon envoyez l\'appel à cotisation et le reçu sera créé automatiquement. Si vous créez le reçu manuellement n\'oublier de relier les posts.' );
				    endif;
					

				endwhile;

			endif;
			wp_reset_postdata();

		else:

			$reg_errors->add( 'noid', $message_response );

		endif;

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
    wp_die(); // All ajax handlers die when finished
}
add_action( 'wp_ajax_send_email_paiement', 'send_email_paiement' );



/**
* Send email (reçu)
*
* @param n/a
* @return Json - process response
*/

function send_email_facture() {

	check_ajax_referer( 'admin_adherent_nonce','security');

	// Global array
	$results = array();
	global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$the_idp = filter_var($_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
	$the_idr = filter_var($_POST['idr'], FILTER_SANITIZE_NUMBER_INT);
	$annee_cotisation = filter_var($_POST['year'], FILTER_SANITIZE_NUMBER_INT);
	$montant_cotisation = filter_var($_POST['montant'], FILTER_SANITIZE_NUMBER_INT);
	$date_paiement = filter_var($_POST['date_paiement'], FILTER_SANITIZE_STRING);
	$message_response = 'Vous n\'avez pas les droits requis pour effectuer cette action.';

		if( is_user_logged_in() && current_user_can( 'publish_posts' ) ):

			if( get_post_status($the_idr) == 'publish' ):

				$today = date('d/m/Y');
				$title_post = get_the_title($the_idp);
				$mail_contact = get_field('contact_email', $the_idr);
				$nom_prenom_contact = get_field('nom_prenom_contact', $the_idr);
				$nom_structure = get_field('nom_structure', $the_idr);
				$adresse_structure = get_field('adresse', $the_idr).' '.get_field('code_postal', $the_idr).' '.get_field('ville', $the_idr);
				$telephone = get_field('telephone', $the_idr);	

				if( $mail_contact && $nom_prenom_contact && $nom_structure && get_field('adresse', $the_idr) && get_field('code_postal', $the_idr) && get_field('ville', $the_idr) && $telephone ):						

					$mode_paiement = get_field('mode_paiement', $the_idr);
					if($mode_paiement=='cb'):
						$num_mode_paiement = get_field('derniers_chiffres', $the_idr);
					else:
						$num_mode_paiement = get_field('num_cheque', $the_idr);
					endif;

					// Create/update count sending & create/update reçu
					$nb_send_mail_slug = 'nb_send_mail_recu_' . $annee_cotisation;				
					if( get_field($nb_send_mail_slug, $the_idp) ):
						$nb_send_mail_recu = (get_field($nb_send_mail_slug, $the_idp) + 1);
						update_field( $nb_send_mail_slug, $nb_send_mail_recu, $the_idp );
					else:						
						update_field( $nb_send_mail_slug, 1, $the_idp );
					endif;

					// Mail du reçu
					$mail_vars_recu = array(get_footer_mail(), $montant_cotisation, $today, $nom_structure, $adresse_structure, $annee_cotisation, $date_paiement, $mode_paiement, $num_mode_paiement);
					notify_by_mail (array($mail_contact),'CLER - Réseau pour la transition énergétique <' . CONTACT_GENERAL . '>', 'Votre reçu de cotisation d\'adhésion '.$annee_cotisation, true, get_template_directory() . '/app/inc/mails/recu-cotisation-adherent.php', $mail_vars_recu);

					$message_response = 'L\'email contenant le reçu '.$annee_cotisation.' a bien été envoyé.';

			else:

				$reg_errors->add( 'emptyfields', 'Veuillez renseigner toutes les données du reçu associé pour envoyer l\'email.' );

			endif;

			else:

				$reg_errors->add( 'notpub', 'Veuillez publier le reçu associé pour envoyer l\'email.' );

			endif;
			
			
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
add_action( 'wp_ajax_send_email_facture', 'send_email_facture' );
