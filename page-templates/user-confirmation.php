<?php
/*
Template Name: Confirmation de compte utilisateur
*/
?>
<?php get_header(); ?>

<section class="l-row">
	<div class="l-col l-col--content">
		<?php 
			if( !empty($_GET['confirme_utilisateur']) && !empty($_GET['utilisateur']) ):

				$get_token_user = filter_var($_GET['confirme_utilisateur'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
				$mail_user = filter_var($_GET['utilisateur'], FILTER_SANITIZE_EMAIL);

				// If email is registered
				if( email_exists( $mail_user ) ) :
					
					$the_user = get_user_by('email', $mail_user);
					$the_user_id = $the_user->ID;
					$stored_token = get_user_meta( $the_user_id, 'token_activation', true );					 		
					$account_state = get_field($the_user_id, 'disable_account', true);

					if( !is_user_logged_in () ): 
						$result_btn = '<a href="connexion" class="c-btn c-btn--cta mgTop--m js-popin-show"><span><i class="fa fa-sign-in"></i>Connexion</span></a>';
					else: 
						$result_btn = '<a href="'.home_url().'/mon-profil" class="c-btn c-btn--cta mgTop--m"><span><i class="fa fa-user"></i>Voir profil</span></a>';
					endif;

					// If token is confirmed
					if( $stored_token == $get_token_user ):

						// If user is not already activate
						if( $account_state == true ):

							$date = new DateTime();
							
							update_user_meta( $the_user_id, 'disable_account', false );
							update_user_meta( $the_user_id, 'account_status', 'Confirmé' );
							update_user_meta( $the_user_id, 'confimation_date', $date->getTimestamp() );

							$result_message = '<h1>Votre compte utilisateur est maintenant activé.</h1>';

						else:		

							$result_message = '<h1>Votre compte utilisateur est déjà activé.</h1>';

						endif;	

					else:

						$result_message = '<h1>La vérification ne se passe pas correctement.</h1>';
						$result_message .= '<p>Essayez de cliquer à nouveau sur le lien que vous avez reçu par email.<br>Si le problème persite :</p>';

						$result_btn = '<a href="'.home_url().'/creation-utilisateur/" class="c-btn c-btn--cta mgTop--m"><span><i class="fa fa-user-plus"></i>Créer un compte</span></a>';
						$result_btn .= '<a href="'.get_permalink(CONTACT).'" class="c-btn c-btn--ghost mgLeft--m">Contact</a>';

					endif;

				else:

					$result_message = '<h1>Cette adresse email n\'est rattachée a aucun compte utilisateur.</h1>';
					$result_btn = '<a href="'.home_url().'/creation-utilisateur/" class="c-btn c-btn--cta mgTop--m"><span><i class="fa fa-user-plus"></i>Créer un compte</span></a>';

				endif;

				// Output
				echo $result_message;
				echo $result_btn;		
					
			else:	

				echo '<h1>Vous n\'avez visiblement pas le droit d\'être sur cette page.</h1>';
				echo '<p> Nous vous invitons à retourner vers la page d\'accueil.</p>';
				echo '<a href="'.home_url().'" class="c-btn c-btn--cta mgTop--m"><span><i class="fa fa-home"></i>Retour accueil</span></a>';

			endif;
		?> 	
	</div>
</section>


<?php get_footer(); ?>
