<?php
/*
Template Name: Confirmation de compte utilisateur
*/
?>
<?php get_header(); ?>


<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--large c-card">	

			<?php 
				if( !empty($_GET['confirme_utilisateur']) && !empty($_GET['utilisateur'])):

					$get_token_user = filter_var($_GET['confirme_utilisateur'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
					$mail_user = filter_var($_GET['utilisateur'], FILTER_SANITIZE_EMAIL);
					// If email is registered
					if( email_exists( $mail_user )) :
						$the_user = get_user_by('email', $mail_user);
						$the_user_id = $the_user->ID;
						$stored_token = get_user_meta( $the_user_id, 'token_activation', true );
						//$account_state = get_field('disable_account', 'user_'.$the_user_id); 		
						$account_state = get_field($the_user_id, 'disable_account', true);

						if( !is_user_logged_in () ): 
							$connexion_link = '<a href="connexion" class="js-popin-show">Connectez-vous</a>';
						else: 
							$connexion_link = '';
						endif;

						// If token is confirmed
						if( $stored_token == $get_token_user ):
							// If user is not already activate
							if( $account_state == NULL ):
								$date = new DateTime();
								
								update_user_meta( $the_user_id, 'disable_account', false );
								update_user_meta( $the_user_id, 'account_status', 'Confirmé' );
								update_user_meta( $the_user_id, 'confimation_date', $date->getTimestamp() );
								$result_message = '<span class="success">Votre compte utilisateur est maintenant activé. '.$connexion_link.'</span>';
							else:					
								$result_message = '<span class="success">Votre compte utilisateur est déjà activé. '.$connexion_link.'</span>';
							endif;				
						else:
							$result_message = '<span class="error">La vérification ne se passe pas correctement.<br>Essayez de cliquer à nouveau sur le lien que vous avez reçu par email.<br>Si le problème persite <a href="'.home_url().'/creation-utilisateur/">créez un nouveau compte utilisateur</a> ou contactez-nous.</span>';
						endif;

					else:
						$result_message = '<span class="error">Cette adresse email n\'est rattachée a aucun compte utilisateur.<br>Nous vous invitons à <a href="'.home_url().'/creation-utilisateur/">créer un nouveau compte utilisateur</a>.</span>';
					endif;

					// Output
					echo '<div class="notify">'.$result_message.'</div>';		
						
				else:		
					echo 'Vous n\'avez visiblement pas le droit d\'être sur cette page.<br> Nous vous invitons à retourner vers <a href="'.home_url().'">la page d\'accueil</a>.';
				endif;
			?> 	

			<footer class="c-card__footer">
				<a href="<?php the_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
			</footer>
		</div>
	</div>
</section>


<?php get_footer(); ?>
