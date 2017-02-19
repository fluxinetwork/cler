<?php
/*
Template Name: Gérer adhèrent
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
				$the_idp=$type_form=$type_form_name=
				$type_structure=$nom_structure=$adresse=$ville=$code_postal=
				$nom_contact1=$prenom_contact1=$fonction_contact1=$email_contact1=$telephone_contact1=$add_contact=$nom_contact2=$prenom_contact2=$fonction_contact2=$email_contact2=$telephone_contact2=
				$activites_territoire=$attente_du_reseau=$contribuer_au_reseau=$connu_cler=$reseaux_cler=
				$nom_elu=$prenom_elu=$fonction_elu=$email_elu=$telephone_elu=$nom_parrain=$accepte_charte_energie_positive=
				$montant_cotisation=$structure_fiscalisee=$reglement_cler=$charte_adherents='';

				if( !empty($_GET['act'])):

					$type_form = filter_var( $_GET['act'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH );
					$c_year = date('Y');
					$l_year = $c_year - 1;
					$n_year = $c_year + 1;

					if( $type_form == 'add' && current_user_can( 'publish_posts' ) && !is_adherent_cler() && get_adherent_status() == 'non_adherent' ):

						$page_title = 'Demande d\'adhésion';						
					
						$nom_contact1 = $current_user->user_lastname;
						$prenom_contact1 = $current_user->user_firstname;
						$email_contact1 = $current_user->user_email;
					
						// Button form label
						$type_form_name = '<i class="fa fa-plus" aria-hidden="true"></i> Envoyer la demande d\'adhésion';
						// Form option value for annee_cotisation
						$fields_annees_cotisation ='
							<option disabled selected value=""> Selectionner</option>
							<option value="'.$l_year.'">'.$l_year.'</option>
							<option value="'.$c_year.'">'.$c_year.'</option>
							<option value="'.$n_year.'">'.$n_year.'</option>';				

						require_once(  get_template_directory() . '/page-templates-parts/forms/form-adherent.php' );

					elseif( $type_form == 'add' && is_adherent_cler() || $type_form == 'mod' || $type_form == 'rad' || $type_form == 'add' && get_adherent_status() != 'non_adherent' ):

						if( isset($_GET['idp']) && is_numeric($_GET['idp']) && !empty($_GET['idp']) ):
							$the_idp = filter_var($_GET['idp'], FILTER_SANITIZE_NUMBER_INT);
						else:
							$the_idp = get_adherent_idp();
						endif;

						if( current_user_can( 'edit_post', $the_idp ) && $the_idp != 0 ):

							$type_structure = get_field('type_structure', $the_idp);
							$nom_structure = get_field('nom_structure', $the_idp);
							$adresse = get_field('adresse', $the_idp);
							$ville = get_field('ville', $the_idp);
							$code_postal = get_field('code_postal', $the_idp);

							$nom_contact1 = get_field('nom_contact1', $the_idp);
							$prenom_contact1 = get_field('prenom_contact1', $the_idp);
							$fonction_contact1 = get_field('fonction_contact1', $the_idp);
							$email_contact1 = get_field('email_contact1', $the_idp);
							$telephone_contact1 = get_field('telephone_contact1', $the_idp);

							$add_contact = get_field('add_contact', $the_idp);
							$nom_contact2 = get_field('nom_contact2', $the_idp);
							$prenom_contact2 = get_field('prenom_contact2', $the_idp);
							$fonction_contact2 = get_field('fonction_contact2', $the_idp);
							$email_contact2 = get_field('email_contact2', $the_idp);
							$telephone_contact2 = get_field('telephone_contact2', $the_idp);

							$activites_territoire= get_field('activites_territoire', $the_idp);
							$attente_du_reseau= get_field('attente_du_reseau', $the_idp);
							$contribuer_au_reseau= get_field('contribuer_au_reseau', $the_idp);
							$connu_cler= get_field('connu_cler', $the_idp);
							$reseaux_cler= get_field('reseaux_cler', $the_idp);

							$nom_elu= get_field('nom_elu', $the_idp);
							$prenom_elu= get_field('prenom_elu', $the_idp);
							$fonction_elu= get_field('fonction_elu', $the_idp);
							$email_elu= get_field('email_elu', $the_idp);
							$telephone_elu= get_field('telephone_elu', $the_idp);
							$nom_parrain= get_field('nom_parrain', $the_idp);
							$accepte_charte_energie_positive= get_field('accepte_charte_energie_positive', $the_idp);

							$repeater_cotisations = get_field('cotisations', $the_idp);
							$last_row_cotisations = end($repeater_cotisations);
							$last_year_cotisation = $last_row_cotisations['annee_cotisation'];
							$montant_cotisation = get_field('montant_cotisation', $the_idp);
							$last_montant_cotisation = $last_row_cotisations['montant_cotisation'];

							$structure_fiscalisee= get_field('structure_fiscalisee', $the_idp);
							$reglement_cler= get_field('reglement_cler', $the_idp);
							$charte_adherents= get_field('charte_adherents', $the_idp);


							if( $type_form == 'mod' || $type_form == 'add' ):

								$type_form = 'mod';
								$page_title = 'Mettre à jour mon adhésion '.$last_year_cotisation;
								
								// Button form label
								$type_form_name = '<i class="fa fa-pencil" aria-hidden="true"></i> Mettre à jour';
								$montant_cotisation = $last_montant_cotisation;
								// Form option value for annee_cotisation
								$fields_annees_cotisation = '<option value="'.$last_year_cotisation.'">Année de cotisation '.$last_year_cotisation.'</option>';						

							else:

								$page_title = 'Demande de ré-adhésion '.($last_year_cotisation + 1);
								
								// Button form label
								$type_form_name = '<i class="fa fa-refresh c-meta__meta__icon"></i> Renouveler mon adhésion';
								// Form option value for annee_cotisation
								$fields_annees_cotisation = '<option value="'.($last_year_cotisation + 1).'">Année de cotisation '.($last_year_cotisation + 1).'</option>';
								$fields_annees_cotisation .= '<option value="'.($last_year_cotisation + 2).'">Année de cotisation '.($last_year_cotisation + 2).'</option>';
								$fields_annees_cotisation .= '<option value="'.($last_year_cotisation + 3).'">Année de cotisation '.($last_year_cotisation + 3).'</option>';						

							endif;

							require_once( get_template_directory() . '/page-templates-parts/forms/form-adherent.php' );

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
				<a href="<?php the_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
			</footer>

		</div>
	</div>
</section>

<?php get_footer(); ?>

