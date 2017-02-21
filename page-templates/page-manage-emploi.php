<?php
/*
Template Name: Gérer offre d'emploi
*/
?>
<?php get_header(); ?>
<section class="l-row bg-light">
	<div class="l-col">
	<?php
	// If user loged in
	if( is_user_logged_in() ):

		echo '<div class="c-form c-form--large c-card">';

		// vars
		$the_idp=$offer_title=$type_form=$type_form_name=$departement=$type_de_poste=$niveau_detude=$descriptif_organisme=$type_structure=$nom_structure=$adresse=$ville=$code_postal=$telephone=$contact_email=$missions=$experience=$profil_recherche=$nom_prenom_contact=$fonction_contact=$modalite_candidature=$date_candidature=$site_internet_structure='';

		if( !empty($_GET['act']) ):

			$type_form = filter_var( $_GET['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

			// Add
			if( $type_form == 'add' && current_user_can( 'publish_posts' ) ):

				$type_form_name = '<i class="fa fa-plus" aria-hidden="true"></i>Ajouter';
				$page_title = 'Ajouter une offre d\'emploi';
				require_once(  get_template_directory() . '/page-templates-parts/forms/form-offer.php' );

			elseif( !empty( $_GET['idp'] ) && is_numeric( $_GET['idp'] ) ):

				$the_idp = filter_var($_GET['idp'], FILTER_SANITIZE_NUMBER_INT);

				if( verify_post_author( $current_user->ID, $the_idp ) ):

					// Modify
					if( $type_form == 'mod' && current_user_can( 'edit_post', $the_idp ) ):

						$offer_title = get_the_title ( $the_idp );
						$type_de_poste = get_field('type_de_poste', $the_idp);
						$niveau_detude = get_field('niveau_detude', $the_idp);
						$descriptif_organisme = get_field('descriptif_organisme', $the_idp);
						$missions = get_field('missions', $the_idp);
						$experience = get_field('experience', $the_idp);
						$profil_recherche = get_field('profil_recherche', $the_idp);
						$type_structure = get_field('type_structure', $the_idp);
						$nom_structure = get_field('nom_structure', $the_idp);
						$adresse = get_field('adresse', $the_idp);
						$ville = get_field('ville', $the_idp);
						$code_postal = get_field('code_postal', $the_idp);
						$departement = get_field('departement', $the_idp);
						$site_internet_structure = get_field('site_internet_structure', $the_idp);
						$nom_prenom_contact = get_field('nom_prenom_contact', $the_idp);
						$fonction_contact = get_field('fonction_contact', $the_idp);
						$contact_email = get_field('contact_email', $the_idp);
						$telephone = get_field('telephone', $the_idp);
						$modalite_candidature = get_field('modalite_candidature', $the_idp);					

						$date_candidature = new DateTime( get_field('date_candidature', $the_idp, false) );

						$type_form_name = '<i class="fa fa-pencil" aria-hidden="true"></i>Mettre à jour';
						$page_title = 'Modifier l\'offre d\'emploi';
						require_once( get_template_directory() . '/page-templates-parts/forms/form-offer.php' );

					else:
						get_template_part( 'page-templates-parts/message', 'need-rights' );
					endif;
				else:
					get_template_part( 'page-templates-parts/message', 'need-rights' );
				endif;
			else:
				get_template_part( 'page-templates-parts/message', 'need-rights' );
			endif;
		else:
			get_template_part( 'page-templates-parts/message', 'need-rights' );
		endif;

	else:

		echo '<div class="c-form c-form--popin c-card">';
		echo '<div class="c-card__header"><h1 class="c-card__header__title">Pas si vite !</h1></div>';
		get_template_part( 'page-templates-parts/message', 'need-login' );

	endif; // End if user loged in
	?>


			<footer class="c-card__footer">
				<a href="<?php the_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
			</footer>
		</div>
	</div>
</section>

<?php get_footer(); ?>

