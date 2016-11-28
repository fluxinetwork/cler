<?php
/**
* Process Paiement
* ----------------------------------------------------
*/


function fluxi_manage_paiement(){
	// Global array
    $results = array();
    global $reg_errors;
	$reg_errors = new WP_Error;
	// vars
	$current_user = wp_get_current_user();
	$redirect_slug = home_url().'/mon-profil/';
	$toky_toky = filter_var( $_POST['toky_toky'], FILTER_SANITIZE_NUMBER_INT);

	$message_response = 'Erreur dans le traitement du paiement. Essayez à nouveau, si le problème persiste, contactez-nous.';

	// Verify nonce & toky_toky
	if ( isset( $_POST['fluxi_manage_paiement_nonce_field'] ) && wp_verify_nonce( $_POST['fluxi_manage_paiement_nonce_field'], 'fluxi_manage_paiement' ) && is_numeric($toky_toky) && $toky_toky == 39733105819 ) :
		// Verify vars for concordance
		if( !empty($_POST['idp']) && !empty($_POST['idr']) && !empty($_POST['security_token']) ):

			$idp = filter_var( $_POST['idp'], FILTER_SANITIZE_NUMBER_INT);
			$idr = filter_var( $_POST['idr'], FILTER_SANITIZE_NUMBER_INT);
			$security_tok = filter_var( $_POST['security_token'], FILTER_SANITIZE_STRING);
			$post_type = get_post_type($idp);

			// Verify concordance post/reçu
			if ( get_field('publication', $idr) == $idp && get_field('security_token', $idr) == $security_tok ):
				if( is_user_logged_in() ):
					if ( !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['token_s']) ):

						require (get_template_directory() . '/app/inc/forms/Stripe.php');

						$title_post = get_the_title($idp);
						$contact_email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);
						$today = date('d/m/Y');
						$nom_structure = filter_var( $_POST['nom_structure'], FILTER_SANITIZE_STRING);
						$adresse = filter_var( $_POST['adresse'], FILTER_SANITIZE_STRING);
						$date_paiement = date('Ymd');

						if( $post_type == 'offres-emploi' ):
							$description_charge = 'Publication offre d\'emploi - '.$title_post;
						else:
							$annee_cotisation = get_field('annee_cotisation', $idr);
							$description_charge = 'Cotisation '.$annee_cotisation.' - '.$title_post;
						endif;

						$metas_tab = array(
							'mode_paiement'		=> 'cb',
							'date_paiement'		=> $date_paiement,
							'contact_email' 	=> $contact_email,
							'nom_prenom_contact' => filter_var( $_POST['name'], FILTER_SANITIZE_STRING),
							'nom_structure' => $nom_structure,
							'adresse' 			=> $adresse,
							'telephone' 		=> filter_var( $_POST['telephone'], FILTER_SANITIZE_STRING)
						);

						$user_stripe_id = get_field('id_stripe', 'user_'.get_current_user_id());
						$token_s = filter_var( $_POST['token_s'], FILTER_SANITIZE_STRING);
						$montant_cent = filter_var( $_POST['amount'], FILTER_SANITIZE_NUMBER_INT);
						$montant = ($montant_cent/100);

						$stripe = new Stripe(STRIPE_KEY);

						// If customer already exist
						if( !empty($user_stripe_id) ):

							$charge = $stripe->api('charges',[
								'amount' => $montant_cent,
								'currency' => 'eur',
								'customer' =>$user_stripe_id,
								'description' => $description_charge
							]);

							if( property_exists($charge, 'error') || $charge->status == 'failed'):
								$reg_errors->add( 'stripefail', $message_response );
							else:

								$last4 = 'XXXX XXXX XXXX ' . $charge->source->last4;
								$metas_tab['n_transaction'] = $charge->id;
								$metas_tab['id_stripe'] = $user_stripe_id;
								$metas_tab['id_carte'] = $charge->source->id;
								$metas_tab['derniers_chiffres'] = $last4;
								$metas_tab['statut_paiement'] = $charge->status;

								// Update reçu
								wp_update_post(array(
								    'ID'           => $idr,
								    'post_status'  => 'publish'
								));
								foreach( $metas_tab as $key => $value ){
									update_post_meta($idr, $key, $value);
								}

								// ********** Paiement offre d'emploi
								if( $post_type == 'offres-emploi' ):
									// Update POST (offre)
									wp_update_post(array(
									    'ID'           => $idp,
									    'post_status'  => 'publish'
									));
									update_field('offer_payed', 1, $idp);

									// Update count sending
									$nb_send_mail_slug = 'nb_send_mail_recu';
									$nb_send_mail_recu = get_field($nb_send_mail_slug);
									if( $nb_send_mail_recu ):
										$nb_send_mail_recu = ($nb_send_mail_recu+1);
										update_field( $nb_send_mail_slug, $nb_send_mail_recu, $idp );
									else:
										add_post_meta($idp, $nb_send_mail_slug, 1);
									endif;

									// Notification mail user (offre)
									$mail_offre_payee = array(get_footer_mail(), $montant, $today, $nom_structure, $adresse, $today, $last4, 'cb', $title_post );
									notify_by_mail (array($contact_email),'Le CLER <' . CONTACT_GENERAL . '>', 'Reçu de votre paiement', true, get_template_directory() . '/app/inc/mails/recu-offre-emploi.php', $mail_offre_payee);

								// ********** Paiement adhésion
								else:									

									// Update count sending
									$nb_send_mail_slug = 'nb_send_mail_recu_' . $annee_cotisation;
									$nb_send_mail_recu = get_field($nb_send_mail_slug);
									if( $nb_send_mail_recu ):
										$nb_send_mail_recu = ($nb_send_mail_recu+1);
										update_field( $nb_send_mail_slug, $nb_send_mail_recu, $idp );
									else:
										add_post_meta($idp, $nb_send_mail_slug, 1);
									endif;

									// Update repeater
									$counter_cotisations = 0;
									if( have_rows('cotisations', $idp) ):					
										while( have_rows('cotisations', $idp) ): the_row();
									        if( get_sub_field('annee_cotisation') == $annee_cotisation ):	
												
												$cotisations_value[$counter_cotisations] = array(
													'annee_cotisation' => get_sub_field('annee_cotisation'),
													'montant_cotisation' => get_sub_field('montant_cotisation'),
													'date_paiement' => $date_paiement,
													'recu' => get_sub_field('recu', false, false)
												);
												
												update_field( 'cotisations', $cotisations_value, $idp );
											else:
												
												$cotisations_value[$counter_cotisations] = array(
													'annee_cotisation' => get_sub_field('annee_cotisation'),
													'montant_cotisation' => get_sub_field('montant_cotisation'),
													'date_paiement' => get_sub_field('date_paiement', false, false),
													'recu' => get_sub_field('recu', false, false)
												);												
												
											endif;
											$counter_cotisations++;
										endwhile;
									endif;

									// Update statut_adhesion
									update_field( 'statut_adhesion', 'cotisation_ok', $idp );


									// Mail du reçu
									$mail_vars_recu = array(get_footer_mail(), $montant, $today, $nom_structure, $adresse, $annee_cotisation, $today, 'cb', $last4);
									notify_by_mail (array($contact_email),'Le CLER <' . CONTACT_GENERAL . '>', 'Votre reçu de cotisation d\'adhésion '.$annee_cotisation, true, get_template_directory() . '/app/inc/mails/recu-cotisation-adherent.php', $mail_vars_recu);

								endif;

								$message_response = 'Votre paiement a été pris en compte. Vous allez recevoir votre reçu par email.';

							endif;


						// If new customer
						else :

							$customer = $stripe->api('customers',[
								'source' => $token_s,
								'description' => $metas_tab['nom_structure'],
								'email' => $metas_tab['contact_email']
							]);

							if( property_exists($customer, 'error') ):
								$reg_errors->add( 'stripefail', $message_response );
							else:

								$charge = $stripe->api('charges',[
									'amount' => $montant_cent,
									'currency' => 'eur',
									'customer' =>$customer->id,
									'description' => $description_charge
								]);

								if( property_exists($charge,'error') || $charge->status == 'failed'):
									$reg_errors->add( 'stripefail', $message_response );
								else:

									$last4 = 'XXXX XXXX XXXX ' . $charge->source->last4;
									$metas_tab['n_transaction'] = $charge->id;
									$metas_tab['id_stripe'] = $user_stripe_id;
									$metas_tab['id_carte'] = $charge->source->id;
									$metas_tab['derniers_chiffres'] = $last4;
									$metas_tab['statut_paiement'] = $charge->status;

									// Update reçu
									wp_update_post(array(
									    'ID'           => $idr,
									    'post_status'  => 'publish'
									));
									foreach( $metas_tab as $key => $value ){
										update_post_meta($idr, $key, $value);
									}

									// ********** Paiement offre d'emploi
									if( $post_type == 'offres-emploi' ):
										// Update POST (offre)
										wp_update_post(array(
										    'ID'           => $idp,
										    'post_status'  => 'publish'
										));
										update_field('offer_payed', 1, $idp);

										// Update count sending
										$nb_send_mail_slug = 'nb_send_mail_recu';
										$nb_send_mail_recu = get_field($nb_send_mail_slug);
										if( $nb_send_mail_recu ):
											$nb_send_mail_recu = ($nb_send_mail_recu+1);
											update_field( $nb_send_mail_slug, $nb_send_mail_recu, $idp );
										else:
											add_post_meta($idp, $nb_send_mail_slug, 1);
										endif;

										// Notification mail user (offre)
										$mail_offre_payee = array(get_footer_mail(), $montant, $today, $nom_structure, $adresse, $today, $last4, 'cb', $title_post );
										notify_by_mail (array($contact_email),'Le CLER <' . CONTACT_GENERAL . '>', 'Reçu de votre paiement', true, get_template_directory() . '/app/inc/mails/recu-offre-emploi.php', $mail_offre_payee);

									// ********** Paiement adhésion
									else:

										$annee_cotisation = get_field('annee_cotisation', $idr);

										// Update count sending
										$nb_send_mail_slug = 'nb_send_mail_recu_' . $annee_cotisation;
										$nb_send_mail_recu = get_field($nb_send_mail_slug);
										if( $nb_send_mail_recu ):
											$nb_send_mail_recu = ($nb_send_mail_recu+1);
											update_field( $nb_send_mail_slug, $nb_send_mail_recu, $idp );
										else:
											add_post_meta($idp, $nb_send_mail_slug, 1);
										endif;

										// Update repeater
										$counter_cotisations = 0;
										if( have_rows('cotisations', $idp) ):					
											while( have_rows('cotisations', $idp) ): the_row();
										        if( get_sub_field('annee_cotisation', $idp) == $annee_cotisation ):	
													
													$cotisations_value[$counter_cotisations] = array(
														'annee_cotisation' => get_sub_field('annee_cotisation', $idp),
														'montant_cotisation' => get_sub_field('montant_cotisation', $idp),
														'date_paiement' => $date_paiement,
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

										// Update statut_adhesion
										update_field( 'statut_adhesion', 'cotisation_ok', $idp );

										// Mail du reçu
										$mail_vars_recu = array(get_footer_mail(), $montant, $today, $nom_structure, $adresse, $annee_cotisation, $today, 'cb', $last4);
										notify_by_mail (array($contact_email),'Le CLER <' . CONTACT_GENERAL . '>', 'Votre reçu de cotisation d\'adhésion '.$annee_cotisation, true, get_template_directory() . '/app/inc/mails/recu-cotisation-adherent.php', $mail_vars_recu);

									endif;

									// Update user Stripe ID
									update_user_meta( get_current_user_id(), 'id_stripe', $customer->id );

									$message_response = 'Votre paiement a été pris en compte. Vous allez recevoir votre reçu par email.';
								endif;
							endif;

						endif;

					else:
						// Empty required field
						$reg_errors->add( 'emptyfield', 'Veuillez renseigner tous les champs obligatoires.' );
					endif;
				else:
					// Empty required field
					$reg_errors->add( 'loged', 'Vous n\'avez pas les droits requis pour effectuer cette action.' );
				endif;

			else:
				// Invalid concordance reçu/post
				$reg_errors->add( 'novars', 'Il semble y avoir un problème dans la référence de votre paiement. Essayez à nouveau, si le problème persiste, contactez-nous.' );

			endif;

		else:
			// Invalid concordance reçu/post
			$reg_errors->add( 'nomatch', 'Il semble y avoir un problème dans la référence de votre paiement. Essayez à nouveau, si le problème persiste, contactez-nous.' );

		endif;

	else :
		// If invalid nonce or hack toky
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

	die();
}

add_action('wp_ajax_nopriv_fluxi_manage_paiement', 'fluxi_manage_paiement');
add_action('wp_ajax_fluxi_manage_paiement', 'fluxi_manage_paiement');

