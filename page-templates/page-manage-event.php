<?php
/*
Template Name: Gérer événement
*/
?>
<?php get_header(); ?>
<article>

	<?php
	// If user loged in
	if( is_user_logged_in() ):
		// vars
		$the_idp=$title_event=$type_form=$type_form_name=$departement=$adresse=$ville=$code_postal=$descriptif_event=$link_event='';

		if( !empty($_GET['act'])):

			$type_form = filter_var( $_GET['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

			// Add
			if( $type_form == 'add' && current_user_can( 'publish_posts' ) ):

				$type_form_name = 'Ajouter';
				$page_title = 'Ajouter un événement';

				require_once(  get_template_directory() . '/page-templates-parts/forms/form-event.php' );

			elseif( verify_post_author( $current_user->ID, $_GET['idp'] ) && !empty( $_GET['idp'] ) && is_numeric( $_GET['idp'] ) ):

				$the_idp = filter_var($_GET['idp'], FILTER_SANITIZE_NUMBER_INT);

				// Modify
				if( $type_form == 'mod' && current_user_can( 'edit_post', $the_idp ) ):

					$title_event = get_the_title ( $the_idp );
					$publics_event = get_field('publics_event', $the_idp);
					$themes = get_field('themes', $the_idp);
					$departement = get_field('departement', $the_idp);
					$adresse = get_field('adresse', $the_idp);
					$ville = get_field('ville', $the_idp);
					$code_postal = get_field('code_postal', $the_idp);
					$descriptif_event = get_field('descriptif_event', $the_idp);
					$link_event = get_field('link_event', $the_idp);					

					$date_event = new DateTime( get_field('date_event', $the_idp, false) );

					$type_form_name = 'Mettre à jour';
					$page_title = 'Modifier l\'événement';

					require_once( get_template_directory() . '/page-templates-parts/forms/form-event.php' );

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

