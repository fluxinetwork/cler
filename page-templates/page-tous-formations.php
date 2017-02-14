<?php
/*
Template Name: Toutes les formations
*/
?>
<?php get_header(); ?>
<?php
	$nb_result = wp_count_posts('formations')->publish;	
	$output = ($nb_result>1) ? $nb_result.' formations disponibles' : $nb_result.' formation disponible';
?>
<div class="l-row bg-accent--grad">
	<header class="l-col l-col--content">
		<h1 class="c-white"><?php echo get_the_title(); ?></h1>

		<div class="c-meta">
			<div class="c-dash bg-white"></div>
			<span class="c-meta__meta c-white">&nbsp;<span class="js-nb-results"><?php echo $output; ?></span></span>
		</div>
	</header>
</div>

<aside class="l-filterList">
	<form id="form-filter-posts" role="form">
		<div class="l-grid">	

			<div class="l-filterList__filter l-grid__col">
				<label for="departement" class="is-none">Département</label>
				<i class="fa fa-location-arrow" aria-hidden="true"></i>
				<select class="c-form__select" name="departement" id="departement">
					<option disabled selected value="">Département</option>
					<?php
						foreach ( load_departements_fields() as $key => $value ) {
			            	echo '<option value="'.$key.'">'.$value.'</option>';
						}
					?>
				</select>
			</div>

			<div class="l-filterList__filter l-grid__col">
			  <label for="secteur" class="is-none">Secteur</label>
			  <i class="fa fa-briefcase" aria-hidden="true"></i>
			  <select class="c-form__select" name="secteur" id="secteur">
			    <option disabled selected value="">Secteur</option>				      
			    <option value="secteur_1">Étude/ingénierie</option>
				<option value="secteur_2">Conseil/Accompagnement</option>
				<option value="secteur_3">Réalisation/Installation</option>
				<option value="secteur_4">Maintenance/Exploitation</option>
				<option value="secteur_5">Production industrielle/Fabrication</option>
				<option value="secteur_6">Distribution/Vente/Commercialisation</option>
				<option value="secteur_7">Maîtrise d’ouvrage</option>
			  </select>
			</div>

			<div class="l-filterList__filter l-grid__col">
			  <label for="thematique" class="is-none">Thématique</label>
			  <i class="fa fa-tag" aria-hidden="true"></i>
			  <select class="c-form__select" name="thematique" id="thematique">
			    <option disabled selected value="">Thématique</option>
			    <option value="thematique_1">Maîtrise de l’énergie</option>
				<option value="thematique_2">Énergies renouvelables/Généraliste </option>
				<option value="thematique_3">Énergies renouvelables/Solaire thermique</option>
				<option value="thematique_4">Énergies renouvelables/Solaire photovoltaïque</option>
				<option value="thematique_5">Énergies renouvelables/Biomasse</option>
				<option value="thematique_6">Énergies renouvelables/Biogaz</option>
				<option value="thematique_7">Énergies renouvelables/Eolien</option>
				<option value="thematique_8">Énergies renouvelables/Hydraulique</option>
				<option value="thematique_9">Énergies renouvelables/Géothermie</option>
				<option value="thematique_10">Territoires &amp; environnement </option>
				<option value="thematique_11">Précarité énergétique</option>
				<option value="thematique_12">Mobilité</option>
			  </select>
			</div>

			<div class="l-filterList__filter l-grid__col">
			  <label for="publics" class="is-none">Public</label>
			  <i class="fa fa-users" aria-hidden="true"></i>
			  <select class="c-form__select" name="publics" id="publics">
			    <option disabled selected value="">Public</option>
			    <option value="public_1">lycéens, étudiants, apprentis</option>
				<option value="public_2">salariés, demandeurs d’emplois</option>
			  </select>
			</div>

			<div class="l-filterList__filter l-grid__col">
			  <label for="agrement_formateree" class="is-none">Format’eree</label>
			  <i class="fa fa-check-circle" aria-hidden="true"></i>
			  <select class="c-form__select" name="agrement_formateree" id="agrement_formateree">
			    <option disabled selected value="">Format’eree</option>
			    <option value="oui">Formation agréée</option>
			    <option value="non">Formation non agréée</option>
			  </select>
			</div>
		
		</div>

		<input type="hidden" value="formations" name="pt_slug">
		<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

		<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>

		<div class="l-filterList__buttons">
			<a href="<?php the_permalink(FORM_FORMATION); ?>?act=add" class="c-link c-link--shy"><i class="fa fa-plus mgRight--xs"></i>Poster une formation</a>
			<div class="l-filterList__buttons__submit">
				<button type="reset" class="c-btn c-btn--reset js-reload is-none">Reset</button>
				<button type="submit" id="submit-filters" class="c-btn c-btn--ghost"><i class="fa fa-filter c-meta__meta__icon"></i>Filtrer</button>
			</div>
		</div>			

	</form>

</aside>

<div class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<div class="js-notify"></div>
		<?php
			$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

			$args_filtered = array(
				'post_type' => 'formations',
				'post_status' => 'publish',
				'paged' => $paged
	 		);
			$query_filtered = new WP_Query( $args_filtered );

			if ( $query_filtered->have_posts() ) :

				echo '<ul class="l-postList">';
					while ( $query_filtered->have_posts() ) : $query_filtered->the_post();					

						$ob_departement = get_field_object('field_57b6eab6f05cd');
						$label_departement = $ob_departement['choices'][ get_field('departement') ];

						$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
						$ch_niveau_detude = $ob_niveau_detude['choices'];
						$val_niveau_detude = $ob_niveau_detude['value'];
						$label_niveau_detude = '';

						if( $val_niveau_detude ):
							foreach( $val_niveau_detude as $v ):
								$label_niveau_detude .= '<span class="c-tag">'.$ch_niveau_detude[ $v ] .'</span>';
							endforeach;
						endif;

						$ob_thematique = get_field_object('field_57b6ebc6f05d3');
						$ch_thematique = $ob_thematique['choices'];
						$val_thematique = $ob_thematique['value'];
						$label_thematique = '';

						if( $val_thematique ):
							foreach( $val_thematique as $v ):
								$label_thematique .= '<span class="c-tag">'.$ch_thematique[ $v ] .'</span>';
							endforeach;
						endif;

						$ob_secteur = get_field_object('field_57b6eb62f05d1');
						$ch_secteur = $ob_secteur['choices'];
						$val_secteur = $ob_secteur['value'];
						$label_secteur = '';

						if( $val_secteur ):
							foreach( $val_secteur as $v ):
								$label_secteur .= '<span class="c-tag">'.$ch_secteur[ $v ] .'</span>';
							endforeach;
						endif;

						$agrement_formateree = get_field_object('agrement_formateree');
						if($agrement_formateree == 'oui'):
							$formateree_label = 'Agrément Format’eree';
						else:
							$formateree_label = 'Non agréée Format’eree';
						endif;

						$output = '<li classs="l-postList__item">';
						$output .= '<a href="'.get_permalink().'">';
						$output .= '<article class="c-offre">';

						$output .= '<h1 class="c-offre__title">'.get_the_title().'</h1>';

						$output .= '<div class="c-offre__meta">'.get_field('nom_centre').' <i class="mgLeft--s fa fa-map-marker" aria-hidden="true"></i>'.get_field('ville').' <i class="mgLeft--s fa fa-location-arrow" aria-hidden="true"></i>'.$label_departement.' - '.$formateree_label.'</div>';

						//$output .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

						$output .= '<div class="c-offre__tags">';
						$output .= $label_secteur;
						$output .= $label_thematique;
						//$output .= $label_niveau_detude;						
						$output .= '</div>';

						$output .= '</article>';
						$output .= '</a>';
						$output .= '</li>';
						
						echo $output;						

					endwhile;

					echo '</ul>';
					
		            echo '<div class="pagination">';
		            echo '<div class="nav-links">';
		            echo paginate_links( array(
		            	'base' => @add_query_arg('paged','%#%'),
		            	'before_page_number' => 'Page ',
		            	'format' => '?paged=%#%',
		            	'current' => max( 1, get_query_var('paged') ),
		            	'prev_next'=> false
		            ) );
		            echo '</div>';
		            echo '</div>';
				
			else :

				echo '<p class="mgTop--s font-subh"><strong>Il n\'y a aucune formation pour l\'instant.</strong></p>';

			endif;
			wp_reset_postdata();
		?>

	</div>
</div>



<?php get_footer(); ?>

