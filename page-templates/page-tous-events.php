<?php
/*
Template Name: Toutes les événements
*/
?>
<?php get_header(); ?>
<?php
	$count_event = wp_count_posts('evenements');
?>
<article>

	<header>
		<?php the_title( '<h1>', '</h1>' ); ?>
		<h4 class="sub-title">Il y a <?php echo $count_event->publish; ?> événements à consulter </h4>
	</header>

	<div class="main-col">
	<?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$args_filtered = array(
			'post_type' => 'evenements',
			'post_status' => 'publish',
			'posts_per_page' => 5,
			'paged' => $paged
 		);
		$query_filtered = new WP_Query( $args_filtered );

		if ( $query_filtered->have_posts() ) : ?>

			<div class="results-list">
				<?php while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

				$ob_departement = get_field_object('field_577e40ac4281f');
				$label_departement = $ob_departement['choices'][ get_field('departement') ];

				$ob_publics = get_field_object('field_577e419326394');
				$ch_publics = $ob_publics['choices'];
				$val_publics = $ob_publics['value'];
				$label_publics = '';

				if( $val_publics ):

					foreach( $val_publics as $v ):

						$label_publics .= '<span class="tag">'.$ch_publics[ $v ] .'</span>';

					endforeach;

				endif;

				$ob_themes = get_field_object('field_577e41d926395');
				$ch_themes = $ob_themes['choices'];
				$val_themes = $ob_themes['value'];
				$label_themes = '';

				if( $val_themes ):

					foreach( $val_themes as $v ):

						$label_themes .= '<span class="tag">'.$ch_themes[ $v ] .'</span>';

					endforeach;

				endif;

				?>

					<a class="results-list-item" href="<?php the_permalink(); ?>">
						<h2><?php echo get_the_title (); ?></h2>
						<h4><?php echo get_field('ville'); ?> - <?php echo $label_departement; ?></h4>
						<p class="description"><?php echo get_field('descriptif_event'); ?></p>
						<?php echo $label_publics; ?><?php echo $label_themes; ?>
					</a>

				<?php endwhile; ?>

				<?php
	            $big = 999999999;
	            echo '<div class="pager">';
	    			echo paginate_links( array(
	    				'base' => @add_query_arg('paged','%#%'),
	    				'format' => '?paged=%#%',
	    				'current' => max( 1, get_query_var('paged') ),
	    				'total' => $query_filtered->max_num_pages,
	              		'prev_next'=> false
	    			) );
	            echo '</div>';
				?>
			</div>

		<?php
		else :

			echo '<p><strong>Il n\'y a aucun événement pour l\'instant.</strong></p>';

		endif;
		wp_reset_postdata();
	?>
	</div>

	<aside class="sidebar">		
		<div class="form">
			<form id="form-filter-posts" role="form">
				<fieldset>
					<legend>Filtrer les événements</legend>
				    <div class="form__select">
				    	<label for="departement" class="label-effect--1">Département</label>
						<select name="departement" id="departement">
							<option disabled selected value="">Dans quel département ?</option>
							<?php
								foreach ( load_departements_fields() as $key => $value ) {
					            	echo '<option value="'.$key.'">'.$value.'</option>';
								}
							?>
						</select>
				    </div>

				    <div class="form__select">
				      <label for="publics_event" class="label-effect--1">Publics</label>
				      <select name="publics_event" id="publics_event">
				      	<option disabled selected value="">Quel public concerné ?</option>
						<option value="particuliers">Particuliers</option>
				        <option value="professionnels">Professionnels</option>			        
					  </select>			      
				    </div>

				    <div class="form__select">
				      <label for="themes" class="label-effect--1">Thèmes</label>
					  <select name="themes" id="themes">
				      	<option disabled selected value=""> - Quel thème ?</option>
						<option value="energies_renouvelables">Énergies renouvelables</option>
				        <option value="maitrise_energie_batiment">Maîtrise de l’énergie/Bâtiment</option>
				        <option value="precarite_energetique">Précarité énergétique</option>
				        <option value="mobilite">Mobilité</option>
				        <option value="territoires_democratie">Territoires et démocratie</option>	
				        <option value="emploi_formation">Emploi/formation</option>	       
					  </select>	
				    </div>
				</fieldset>

				<input type="hidden" value="evenements" name="pt_slug">
				<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

				<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>


				<div class="form__buttons">
					<button type="reset" class="button" class="form__reset">Reset</button>
				    <button type="submit" id="submit-filters" class="form__submit">Filtrer</button>
				</div>

			</form>
			<a href="/gerer-evenement?act=add" class="hide">Ajouter un événement</a>
		</div>

	</aside>
</article>

<?php get_footer(); ?>

