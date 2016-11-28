<?php
/*
Template Name: Gérer formation
*/
?>
<?php get_header(); ?>
<article>
	<?php
	// If user loged in
	if( is_user_logged_in() ):
		// vars
		$the_idp=$formation_title=$type_form=$type_form_name=$publics=$duree_formation=$cout_formation=$secteur=$niveau_detude=$thematique=$descriptif_formation=$agrement_formateree=$is_adherent=$nom_centre=$adresse=$code_postal=$ville=$departement=$telephone=$contact_email=$site_internet='';

		if( !empty($_GET['act'])):

			$type_form = filter_var( $_GET['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

			// Add
			if( $type_form == 'add' && current_user_can( 'publish_posts' ) ):

				$type_form_name = 'Ajouter';
				$page_title = 'Ajouter une formation';
				require_once(  get_template_directory() . '/page-templates-parts/forms/form-formation.php' );

			elseif( verify_post_author( $current_user->ID, $_GET['idp'] ) && !empty( $_GET['idp'] ) && is_numeric( $_GET['idp'] ) ):

				$the_idp = filter_var($_GET['idp'], FILTER_SANITIZE_NUMBER_INT);

				// Modify
				if( $type_form == 'mod' && current_user_can( 'edit_post', $the_idp ) ):

					$formation_title= get_the_title ( $the_idp );
					
					$publics = get_field('publics', $the_idp);
					$duree_formation = get_field('duree_formation', $the_idp);
					$cout_formation = get_field('cout_formation', $the_idp);
					$secteur = get_field('secteur', $the_idp);
					$niveau_detude = get_field('niveau_detude', $the_idp);
					$thematique = get_field('thematique', $the_idp);
					$descriptif_formation = get_field('descriptif_formation', $the_idp);
					$agrement_formateree = get_field('agrement_formateree', $the_idp);
					$is_adherent = get_field('is_adherent', $the_idp);
					$nom_centre = get_field('nom_centre', $the_idp);
					$adresse = get_field('adresse', $the_idp);
					$code_postal = get_field('code_postal', $the_idp);
					$ville = get_field('ville', $the_idp);
					$departement = get_field('departement', $the_idp);
					$telephone = get_field('telephone', $the_idp);
					$contact_email = get_field('contact_email', $the_idp);
					$site_internet = get_field('site_internet', $the_idp);'';	

					$type_form_name = 'Mettre à jour';
					$page_title = 'Modifier la formation';
					require_once( get_template_directory() . '/page-templates-parts/forms/form-formation.php' );

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

		get_template_part( 'page-templates-parts/message', 'need-login' );

	endif; // End if user loged in ?>

</article>

<?php get_footer(); ?>

