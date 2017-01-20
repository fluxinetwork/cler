<?php
/*
Template Name: Toutes les événements
*/
?>
<?php get_header(); ?>
<?php
	$nb_result = wp_count_posts('evenements')->publish;	
	$output = ($nb_result>1) ? $nb_result.' événements disponibles' : $nb_result.' événement disponible';
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

	<aside class="l-filterList">
		<form id="form-filter-posts" role="form">
			<div class="l-grid">		    
				<div class="l-filterList__filter l-grid__col">
					<label class="is-none" for="departement">Département</label>
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
				  <label class="is-none" for="publics_event">Publics</label>
				  <i class="fa fa-users" aria-hidden="true"></i>
				  <select class="c-form__select" name="publics_event" id="publics_event">
				  	<option disabled selected value="">Public</option>
					<option value="particuliers">Particuliers</option>
				    <option value="professionnels">Professionnels</option>			        
				  </select>			      
				</div>

				<div class="l-filterList__filter l-grid__col">
				  <label class="is-none" for="themes">Thèmes</label>
				  <i class="fa fa-tag" aria-hidden="true"></i>
				  <select class="c-form__select" name="themes" id="themes">
				  	<option disabled selected value="">Thème</option>
					<option value="energies_renouvelables">Énergies renouvelables</option>
				    <option value="maitrise_energie_batiment">Maîtrise de l’énergie/Bâtiment</option>
				    <option value="precarite_energetique">Précarité énergétique</option>
				    <option value="mobilite">Mobilité</option>
				    <option value="territoires_democratie">Territoires et démocratie</option>	
				    <option value="emploi_formation">Emploi/formation</option>	       
				  </select>	
				</div>
			</div>	

			<input type="hidden" value="evenements" name="pt_slug">
			<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

			<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>

			<div class="l-filterList__buttons">
				<a href="<?php echo home_url().'/mon-profil/gerer-evenement/?act=add'; ?>" class="c-link c-link--shy">Poster un événement</a>
				<div class="l-filterList__buttons__submit">
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
				'post_type' => 'evenements',
				'post_status' => 'publish',
				'posts_per_page' => 5,
				'paged' => $paged
	 		);
			$query_filtered = new WP_Query( $args_filtered );

			if ( $query_filtered->have_posts() ) : 

				echo '<ul class="l-postList results-list">';
					while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

					$ob_departement = get_field_object('field_577e40ac4281f');
					$label_departement = $ob_departement['choices'][ get_field('departement') ];

					$ob_publics = get_field_object('field_577e419326394');
					$ch_publics = $ob_publics['choices'];
					$val_publics = $ob_publics['value'];
					$label_publics = '';

					$date_event = date("d/m/y", strtotime(get_field('date_event')));

					if( $val_publics ):
						foreach( $val_publics as $v ):
							$label_publics .= '<span class="c-tag">'.$ch_publics[ $v ] .'</span>';
						endforeach;
					endif;

					$ob_themes = get_field_object('field_577e41d926395');
					$ch_themes = $ob_themes['choices'];
					$val_themes = $ob_themes['value'];
					$label_themes = '';

					if( $val_themes ):
						foreach( $val_themes as $v ):
							$label_themes .= '<span class="c-tag">'.$ch_themes[ $v ] .'</span>';
						endforeach;
					endif;

					$output = '<li classs="l-postList__item">';
					$output .= '<a href="'.get_permalink().'">';
					$output .= '<article class="c-offre">';

					$output .= '<h1 class="c-offre__title">'.get_the_title().'</h1>';

					$output .= '<div class="c-offre__meta">Le '.$date_event.' <i class="mgLeft--s fa fa-map-marker" aria-hidden="true"></i>'.get_field('ville').' <i class="mgLeft--s fa fa-location-arrow" aria-hidden="true"></i>'.$label_departement.'</div>';

					//$output .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

					$output .= '<div class="c-offre__tags">';
					$output .= $label_themes;
					$output .= $label_publics;
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

				echo '<p><strong>Il n\'y a aucun événement pour l\'instant.</strong></p>';

			endif;
			wp_reset_postdata();
		?>

		</div>
	</div>
</div>


<?php get_footer(); ?>

