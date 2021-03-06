<?php
/*
Template Name: Gérer événement
*/
?>
<?php get_header(); ?>
<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--large c-card">

			<?php
			// If user loged in
			if( is_user_logged_in() ):
				// vars
				$the_idp=$title_event=$type_form=$type_form_name=$departement=$adresse=$ville=$code_postal=$descriptif_event=$link_event='';

				if( !empty($_GET['act'])):

					$type_form = filter_var( $_GET['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );

					// Add
					if( $type_form == 'add' && current_user_can( 'publish_posts' ) ):

						$type_form_name = '<i class="fa fa-plus" aria-hidden="true"></i> Ajouter';
						$page_title = 'Ajouter un événement';

						require_once(  get_template_directory() . '/page-templates-parts/forms/form-event.php' );

					elseif( !empty( $_GET['idp'] ) && is_numeric( $_GET['idp'] ) ):

						$the_idp = filter_var($_GET['idp'], FILTER_SANITIZE_NUMBER_INT);

						if( verify_post_author( $current_user->ID, $the_idp ) ):

							// Modify
							if( $type_form == 'mod' && current_user_can( 'edit_published_posts', $the_idp ) ):

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

								$type_form_name = '<i class="fa fa-pencil" aria-hidden="true"></i> Mettre à jour';
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
					get_template_part( 'page-templates-parts/message', 'need-rights' );
				endif;

			else:

				get_template_part( 'page-templates-parts/message', 'need-login' );

			endif; // End if user loged in ?>

			<footer class="c-card__footer">
				<a href="<?php echo get_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
			</footer>
		</div>
	</div>
</section>

<?php get_footer(); ?>

