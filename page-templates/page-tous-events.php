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
			<a href="<?php the_permalink(FORM_EVENT) ?>?act=add" class="c-link c-link--shy"><i class="fa fa-plus c-meta__meta__icon" aria-hidden="true"></i>Poster un événement</a>
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
			'post_type' 	=> 'evenements',
			'post_status' 	=> 'publish',
			'paged' 		=> $paged,
			'meta_key'		=> 'date_event',
			'orderby'		=> 'meta_value_num',
			'order'			=> 'ASC',
			'meta_query' => array(
			array(
		        'key'		=> 'date_event',
		        'compare'	=> '>=',
		        'value'		=> date('Ymd'),
		    ))
 		);
		$query_filtered = new WP_Query( $args_filtered );

		if ( $query_filtered->have_posts() ) : 

			echo '<ul class="l-postList">';
				while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

				$ob_departement = get_field_object('field_577e40ac4281f');
				$label_departement = $ob_departement['choices'][ get_field('departement') ];
				$code_postal = get_field('code_postal');
				$numero_departement = substr($code_postal,0,-3);
				
				$ob_publics = get_field_object('field_577e419326394');
				$ch_publics = $ob_publics['choices'];
				$val_publics = $ob_publics['value'];
				$label_publics = '';

				$date_event = get_field('date_event');				

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


				$output = '<li class="l-postList__item">';
				$output .= '<a href="'.get_permalink().'">';
				$output .= '<article class="offre">';

				$output .= '<h1 class="h2">'.get_the_title().'</h1>';

				$output .= '<div class="c-meta">';
				$output .= '<div class="c-dash"></div>';
				$output .= '<span class="c-meta__meta">'.$date_event.'</span>';
				$output .= '<span class="c-meta__meta"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i>'.get_field('ville').'</span>';
				$output .= '<span class="c-meta__meta"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i>'.$numero_departement.'</span>';
				$output .= '</div>';

				//$output .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

				$output .= '<div class="mgTop--s">';
				$output .= $label_themes;
				$output .= $label_publics;
				$output .= '</div>';

				$output .= '</article>';
				$output .= '</a>';
				$output .= '</li>';
				
				echo $output;

				endwhile;

			echo '</ul>';
	            
	        echo '<div class="pagination">';
	    		echo paginate_links( array(
	    			'base' => @add_query_arg('paged','%#%'),
	    			'format' => '?paged=%#%',
	    			'current' => max( 1, get_query_var('paged') ),
	    			'total' => $query_filtered->max_num_pages,
	          		'prev_next'=> false
	    		) );
	        echo '</div>';
				
		else :

			echo '<p class="mgTop--s font-subh"><strong>Il n\'y a aucun événement pour l\'instant.</strong></p>';

		endif;
		wp_reset_postdata();
	?>

	</div>
</div>



<?php get_footer(); ?>

