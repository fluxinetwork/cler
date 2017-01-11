
<?php
/*
Template Name: Toutes les offres d'emploi
*/
?>
<?php get_header(); ?>
<?php
$nb_result = wp_count_posts('offres-emploi')->publish;
$output = ($nb_result>1) ? $nb_result.' offres disponibles' : $nb_result.' offre disponible';
?>

<div class="page">
	<div class="l-row">
		<header class="l-col l-col--content l-col--pdL l-header">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="l-header__meta">
				<div class="c-dash"></div>
				<span class="sub-title">&nbsp;<span class="js-nb-results"><?php echo $output; ?></span></span>
			</div>
		</header>
	</div>

	<aside class="c-filterList">
		<form id="form-filter-posts" role="form">
		<div class="l-grid">
		    <div class="c-filterList__filter l-grid__col">
		    	<label for="departement" class="is-none">Département</label>
		    	<i class="fa fa-location-arrow" aria-hidden="true"></i>
				<select name="departement" id="departement" data-validation="required" class="c-form__select">
					<option disabled selected value="">Département</option>
					<?php
						foreach ( load_departements_fields() as $key => $value ) {
			            	echo '<option value="'.$key.'">'.$value.'</option>';
						}
					?>
				</select>
		    </div>

		    <div class="c-filterList__filter l-grid__col">
		      <label for="type_de_poste" class="is-none">Contrat</label>
		      <i class="fa fa-file-text" aria-hidden="true"></i>
		      <select name="type_de_poste" id="type_de_poste" class="c-form__select">
		        <option disabled selected value="">Contrat</option>
		        <option value="stage">Stage</option>
		        <option value="cdd">CDD</option>
		        <option value="cdi">CDI</option>
		        <option value="autre">Autre</option>
		      </select>
		    </div>

		    <div class="c-filterList__filter l-grid__col">
		      <label for="niveau_detude" class="is-none">Diplôme</label>
		      <i class="fa fa-graduation-cap" aria-hidden="true"></i>
		      <select name="niveau_detude" id="niveau_detude" class="c-form__select">
		        <option disabled selected value="">Diplôme</option>
		        <option value="bac">BAC</option>
		        <option value="bac_2">BAC+2</option>
		        <option value="bac_3">BAC+3</option>
		        <option value="bac_5">BAC+5</option>
		      </select>
		    </div>

		    <div class="c-filterList__filter l-grid__col">
		      <label for="experience" class="is-none">Expérience</label>
		      <i class="fa fa-arrows-h" aria-hidden="true"></i>
		      <select name="experience" id="experience" class="c-form__select">
		        <option disabled selected value="">Expérience</option>
		        <option value="experience_0">Jeune diplômé(e)</option>
		        <option value="experience_1">1 à 3 ans</option>
		        <option value="experience_2">3 à 5 ans</option>
				<option value="experience_3">5 à 10 ans</option>
				<option value="experience_4">Plus de 10 ans</option>
		      </select>
		    </div>

		    <div class="c-filterList__filter l-grid__col">
		      <label for="type_structure" class="is-none">Structure</label>
		      <i class="fa fa-cube" aria-hidden="true"></i>
		      <select name="type_structure" id="type_structure" class="c-form__select">
		        <option disabled selected value="">Structure</option>
		        <option value="entreprise">Entreprise</option>
		        <option value="association">Association</option>
		        <option value="collectivite">Collectivité</option>
		        <option value="formation">Organisme de formation</option>
		      </select>
		    </div>
		</div>

			<input type="hidden" value="offres-emploi" name="pt_slug">
			<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

			<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>


			<div class="c-filterList__buttons">
				<a href="<?php echo home_url().'/mon-profil/gerer-offre-emploi/?act=add'; ?>" class="c-link c-link--shy">Poster une offre</a>
				<div class="c-filterList__buttons__submit">
					<?php
					if ( isset( $_GET['toky_toky'] ) ) {
						echo '<button type="reset" class="c-btn c-btn--reset">Reset</button>';
					}
					?>
					<button type="submit" id="submit-filters" class="c-btn">Filtrer</button>
				</div>
			</div>

		</form>
	</aside>

	<div class="l-row">
		<div class="l-col l-col--content no-pdTop">
			
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

				$args_filtered = array(
					'post_type' => 'offres-emploi',
					'post_status' => 'publish',
					'posts_per_page' => 5,
					'paged' => $paged
		 		);
				$query_filtered = new WP_Query( $args_filtered );

				if ( $query_filtered->have_posts() ) :
					echo '<ul class="l-postList results-list">';
						while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

							$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
							$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

							$ob_departement = get_field_object('field_574dab093c7b0');
							$label_departement = $ob_departement['choices'][ get_field('departement') ];

							$ob_experience = get_field_object('field_5773a4bc97554');
							$label_experience = $ob_experience['choices'][ get_field('experience') ];

							$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
							$ch_niveau_detude = $ob_niveau_detude['choices'];
							$val_niveau_detude = $ob_niveau_detude['value'];
							$label_niveau_detude = '';

							if( $val_niveau_detude ):
								foreach( $val_niveau_detude as $v ):
									$label_niveau_detude .= '<div class="c-tag">'.$ch_niveau_detude[ $v ] .'</div>';
								endforeach;
							endif;

							$output = '<li classs="l-postList__item">';
							$output .= '<a href="'.get_permalink().'">';
							$output .= '<article class="c-offre">';

							$output .= '<h1 class="c-offre__title">'.get_the_title().'</h1>';

							$output .= '<div class="c-offre__meta">'.get_field('nom_structure').' <i class="mgLeft--s fa fa-map-marker" aria-hidden="true"></i>'.get_field('ville').' <i class="mgLeft--s fa fa-location-arrow" aria-hidden="true"></i>'.$label_departement.'</div>';

							//$output .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

							$output .= '<div class="c-offre__tags">';
							$output .= '<div class="c-tag">'.$label_type_de_poste.'</div>';
							$output .= '<div class="c-tag">'.$label_experience.'</div>';
							$output .= $label_niveau_detude;
							$output .= '</div>';

							$output .= '</article>';
							$output .= '</a>';
							$output .= '</li>';
							
							echo $output;

						endwhile;

					echo '</ul>';

			        echo '<div class="pager">';
					echo paginate_links( array(
						'base' => @add_query_arg('paged','%#%'),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $query_filtered->max_num_pages,
		          		'prev_next'=> false
					) );
			        echo '</div>';

				else :
					echo '<p><strong>Il n\'y a aucune offre d\'emploi pour l\'instant.</strong></p>';
				endif;
				wp_reset_postdata();
			?>

		</div>
	</div>
</div>

<?php get_footer(); ?>



