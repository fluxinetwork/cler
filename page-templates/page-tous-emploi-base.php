<?php
/*
Template Name: Toutes les offres d'emploi Yann
*/
?>
<?php get_header(); ?>
<?php
	$count_offres = wp_count_posts('offres-emploi');
?>
<article>

	<header>
		<?php the_title( '<h1>', '</h1>' ); ?>
		<h4 class="sub-title">Il y a <?php echo $count_offres->publish; ?> offres d'emploi à consulter </h4>
	</header>

	<div class="main-col">
	<?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$args_filtered = array(
			'post_type' => 'offres-emploi',
			'post_status' => 'publish',
			'posts_per_page' => 5,
			'paged' => $paged
 		);
		$query_filtered = new WP_Query( $args_filtered );

		if ( $query_filtered->have_posts() ) : ?>

			<div class="results-list">
				<?php while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

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

							$label_niveau_detude .= '<span class="tag">'.$ch_niveau_detude[ $v ] .'</span>';

						endforeach;

					endif;

					?>

					<a class="results-list-item" href="<?php the_permalink(); ?>">
						<h2><?php echo get_the_title (); ?></h2>
						<h4><?php echo get_field('nom_structure'); ?> - <?php echo get_field('ville'); ?> - <?php echo $label_departement; ?></h4>
						<p class="description"><?php echo get_field('descriptif_organisme'); ?></p>
						<span class="tag first"><?php echo $label_type_de_poste; ?></span>
						<span class="tag"><?php echo $label_experience; ?></span>
						<?php echo $label_niveau_detude; ?>
					</a>

				<?php endwhile; ?>

				<?php
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

			echo '<p><strong>Il n\'y a aucune offre d\'emploi pour l\'instant.</strong></p>';

		endif;
		wp_reset_postdata();
	?>
	</div>

	<aside class="sidebar">
		<div class="form">
			<form id="form-filter-posts" role="form">
				<fieldset>
					<legend>Filtrer les offres d'emploi</legend>
				    <div class="form__select">
				    	<label for="departement" class="label-effect--1">Département</label>
						<select name="departement" id="departement" data-validation="required">
							<option disabled selected value="">Dans quel département ?</option>
							<?php
								foreach ( load_departements_fields() as $key => $value ) {
					            	echo '<option value="'.$key.'">'.$value.'</option>';
								}
							?>
						</select>
				    </div>

				    <div class="form__select">
				      <label for="type_de_poste" class="label-effect--1">Type de poste</label>
				      <select name="type_de_poste" id="type_de_poste">
				        <option disabled selected value="">Quel type de poste ?</option>
				        <option value="stage">Stage</option>
				        <option value="cdd">CDD</option>
				        <option value="cdi">CDI</option>
				        <option value="autre">Autre</option>
				      </select>
				    </div>

				    <div class="form__select">
				      <label for="niveau_detude" class="label-effect--1">Niveau d’étude</label>
				      <select name="niveau_detude" id="niveau_detude">
				        <option disabled selected value="">Quel niveau d’étude ?</option>
				        <option value="bac">BAC</option>
				        <option value="bac_2">BAC+2</option>
				        <option value="bac_3">BAC+3</option>
				        <option value="bac_5">BAC+5</option>
				      </select>
				    </div>

				    <div class="form__select">
				      <label for="experience" class="label-effect--1">Expérience demandée</label>
				      <select name="experience" id="experience">
				        <option disabled selected value="">Combien d'année d'expérience ?</option>
				        <option value="experience_0">Jeune diplômé(e)</option>
				        <option value="experience_1">1 à 3 ans</option>
				        <option value="experience_2">3 à 5 ans</option>
						<option value="experience_3">5 à 10 ans</option>
						<option value="experience_4">Plus de 10 ans</option>
				      </select>
				    </div>

				    <div class="form__select">
				      <label for="type_structure" class="label-effect--1">Type de structure</label>
				      <select name="type_structure" id="type_structure">
				        <option disabled selected value="">Quel de structure ?</option>
				        <option value="entreprise">Entreprise</option>
				        <option value="association">Association</option>
				        <option value="collectivite">Collectivité</option>
				        <option value="formation">Organisme de formation</option>
				      </select>
				    </div>
				</fieldset>

				<input type="hidden" value="offres-emploi" name="pt_slug">
				<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

				<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>


				<div class="form__buttons">
					<button type="reset" class="button" class="form__reset">Reset</button>
				    <button type="submit" id="submit-filters" class="form__submit">Filtrer</button>
				</div>

			</form>

			<br><a href="<?php echo get_home_url(); ?>/gerer-offre-emploi?act=add" class="hide">Ajouter une offre d'emploi</a>
		</div>

	</aside>
</article>

<?php get_footer(); ?>

