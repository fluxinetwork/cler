<?php
/*
Template Name: Toutes les offres d'emploi
*/
?>
<?php get_header(); ?>
<?php
$nb_result = wp_count_posts('offres-emploi')->publish;
$output = ($nb_result>1) ? $nb_result.' offres d\'emploi disponibles' : $nb_result.' offre d\'emploi disponible';
?>

<div class="l-row bg-accent--grad">
	<header class="l-col l-col--content">
		<h1 class="c-white"><?php echo get_the_title(); ?></h1>

		<div class="c-meta">
			<div class="c-dash bg-white"></div>
			<span class="c-meta__meta c-white"><i class="fa fa-briefcase c-meta__meta__icon"></i><span class="js-nb-results"><?php echo $output; ?></span></span>
		</div>
	</header>
</div>

<aside class="l-filterList">
	<form id="form-filter-posts" role="form">
	<div class="l-grid">
	    <div class="l-filterList__filter l-grid__col">
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

	    <div class="l-filterList__filter l-grid__col">
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

	    <div class="l-filterList__filter l-grid__col">
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

	    <div class="l-filterList__filter l-grid__col">
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

	    <div class="l-filterList__filter l-grid__col">
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


		<div class="l-filterList__buttons">
			<a href="<?php echo home_url().'/outils/publiez-vos-offres-demploi/'; ?>" class="c-link c-link--shy"><i class="fa fa-plus c-meta__meta__icon" aria-hidden="true"></i>Poster une offre</a>
			<div class="l-filterList__buttons__submit">
				<button type="reset" class="c-btn c-btn--reset js-reload is-none">Reset</button>
				<button type="submit" id="submit-filters" class="c-btn c-btn--ghost"><i class="fa fa-filter c-meta__meta__icon"></i> Filtrer</button>
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
				'post_type' => 'offres-emploi',
				'post_status' => 'publish',
				'paged' => $paged
	 		);
			$query_paged = new WP_Query( $args_filtered );

			if ( $query_paged->have_posts() ) :
				
				echo '<ul class="l-postList">';
					while ( $query_paged->have_posts() ) : $query_paged->the_post();

						$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
						$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];
						$nom = limitString(get_field('nom_structure'), 0, 60, ' [...]');

						$code_postal = get_field('code_postal');
						$numero_departement = substr($code_postal,0,-3);

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

						$output = '<li class="l-postList__item">';
						$output .= '<a href="'.get_permalink().'">';
						$output .= '<article class="offre">';
						$output .= '<time datetime="'.get_the_date('Y-m-d').'" class="t-meta l-intro__date">'.get_the_date('d M Y').'</time> ';
						$output .= '<h1 class="h2">'.get_the_title().'</h1>';

						$output .= '<div class="c-meta">';
						$output .= '<div class="c-dash"></div>';
						$output .= '<span class="c-meta__meta"><i class="fa fa-cube c-meta__meta__icon" aria-hidden="true"></i>'.$nom.'</span>';
						$output .= '<span class="c-meta__meta"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i>'.get_field('ville').'</span>';
						$output .= '<span class="c-meta__meta"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i>'.$numero_departement.'</span>';
						$output .= '</div>';

						//$output .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

						$output .= '<div class="mgTop--s">';
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

		        include(locate_template('page-templates-parts/base/pagination.php'));

			else :
				echo '<p class="mgTop--s font-subh"><strong>Il n\'y a aucune offre d\'emploi pour l\'instant.</strong></p>';
			endif;
			wp_reset_postdata();
		?>

	</div>
</div>

<?php get_footer(); ?>



