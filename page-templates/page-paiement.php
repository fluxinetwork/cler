<?php
/*
Template Name: Gestion de paiement
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--large c-card">
			<?php
			if( is_user_logged_in() ):
				if( !empty($_GET['ido']) && isset($_GET['ido']) && !empty($_GET['idr']) && isset($_GET['idr']) && !empty($_GET['st']) && isset($_GET['st']) ):

					$id_post_source = filter_var( $_GET['ido'], FILTER_SANITIZE_NUMBER_INT);
					$security_tok = filter_var( $_GET['st'], FILTER_SANITIZE_STRING);
					$id_recu = filter_var( $_GET['idr'], FILTER_SANITIZE_NUMBER_INT);
					$nom_structure=$adresse=$telephone='';

					if( get_field('publication', $id_recu, false) == $id_post_source && get_field('security_token', $id_recu) == $security_tok ):

						$nom_structure = get_field('nom_structure', $id_post_source);
						$adresse = get_field('adresse', $id_post_source).' '.get_field('code_postal', $id_post_source).' '.get_field('ville', $id_post_source);

						if( get_field('statut_paiement', $id_recu) == 'succeeded' ):

							echo '<div class="c-card__header"><h1 class="c-card__header__title">Vous avez déjà réglé cette facture</h1>';
							echo '<a href="'.get_the_permalink($id_recu).'" class="c-btn mgTop--s"><i class="fa fa-eye" aria-hidden="true"></i>
 Consulter le reçu</a></div>';

						elseif( get_field('statut_paiement', $id_recu) == 'failed' ):

							echo '<div class="c-card__header"><h1 class="c-card__header__title">Echec du paiement</h1>';
							echo '<a href="'.get_the_permalink($id_recu).'" class="c-btn mgTop--s"><i class="fa fa-eye" aria-hidden="true"></i>
 Consulter le reçu</a></div>';

						else:

							// Paiement des offres d'emploi
							if( get_post_type($id_post_source) == 'offres-emploi'):

								$amount = get_field('montant_publication_offre_emploi', 'option');
								$amount_cent = ( $amount * 100 );
								$telephone = get_field('telephone', $id_post_source);

								echo '<div class="c-card__header"><h1 class="c-card__header__title">Payer la publication de l\'offre :<br><span> '.get_the_title($id_post_source).'</span></h1></div>';
								require_once( get_template_directory() . '/page-templates-parts/forms/form-paiement.php' );

							// Paiement des cotisations d'ahésion
							elseif ( get_post_type($id_post_source) == 'adherents') :

								$annee_cotisation = get_field('annee_cotisation', $id_recu);
								$amount = get_field('montant', $id_recu);
								$amount_cent = ( $amount * 100 );
								$telephone = get_field('telephone_contact1', $id_post_source);

								echo '<div class="c-card__header"><h1 class="c-card__header__title">Payer votre cotisation d\'adhésion<br><span> pour l\'année '.$annee_cotisation.'</span></h1></div>';
								require_once( get_template_directory() . '/page-templates-parts/forms/form-paiement.php' );
							else:
								echo '<div class="c-card__header"><h1 class="c-card__header__title">Erreur<br><span>sur la page de paiement</span></h1></div>';
								get_template_part( 'page-templates-parts/message', 'need-rights' );
							endif;

						endif;
					else:
						// Verify token and post matching
						echo '<div class="c-card__header"><h1 class="c-card__header__title">Erreur<br><span>sur la page de paiement</span></h1></div>';
						get_template_part( 'page-templates-parts/message', 'need-rights' );
					endif;
				else:
					// Empty required get var
					echo '<div class="c-card__header"><h1 class="c-card__header__title">Erreur<br><span>sur la page de paiement</span></h1></div>';
					get_template_part( 'page-templates-parts/message', 'need-rights' );
				endif;
			else:
				// Non login user
				echo '<div class="c-card__header"><h1 class="c-card__header__title">Erreur<br><span>sur la page de paiement</span></h1></div>';
				get_template_part( 'page-templates-parts/message', 'need-login' );

			endif;
			?>
			<footer class="c-card__footer">
				<a href="<?php the_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
			</footer>
		</div>
	</div>
</section>

<?php get_footer(); ?>

