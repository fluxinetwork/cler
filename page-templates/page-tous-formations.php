<?php
/*
Template Name: Toutes les formations
*/
?>
<?php get_header(); ?>
<?php
	$count_formations = wp_count_posts('formations');
?>
<section>

	<header>
		<?php the_title( '<h1>', '</h1>' ); ?>
		<h4 class="sub-title">Il y a <span class="js-nb-results"><?php echo $count_formations->publish; ?></span> formations à consulter </h4>
	</header>

	<div class="main-col">
	<?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$args_filtered = array(
			'post_type' => 'formations',
			'post_status' => 'publish',
			'posts_per_page' => 5,
			'paged' => $paged
 		);
		$query_filtered = new WP_Query( $args_filtered );

		if ( $query_filtered->have_posts() ) : ?>

			<div class="results-list">
				<?php while ( $query_filtered->have_posts() ) : $query_filtered->the_post();					

					$ob_departement = get_field_object('field_57b6eab6f05cd');
					$label_departement = $ob_departement['choices'][ get_field('departement') ];

					$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
					$ch_niveau_detude = $ob_niveau_detude['choices'];
					$val_niveau_detude = $ob_niveau_detude['value'];
					$label_niveau_detude = '';

					if( $val_niveau_detude ):

						foreach( $val_niveau_detude as $v ):

							$label_niveau_detude .= '<span class="tag">'.$ch_niveau_detude[ $v ] .'</span>';

						endforeach;

					endif;

					$ob_thematique = get_field_object('field_57b6ebc6f05d3');
					$ch_thematique = $ob_thematique['choices'];
					$val_thematique = $ob_thematique['value'];
					$label_thematique = '';

					if( $val_thematique ):

						foreach( $val_thematique as $v ):

							$label_thematique .= '<span class="tag">'.$ch_thematique[ $v ] .'</span>';

						endforeach;

					endif;

					$ob_secteur = get_field_object('field_57b6eb62f05d1');
					$ch_secteur = $ob_secteur['choices'];
					$val_secteur = $ob_secteur['value'];
					$label_secteur = '';

					if( $val_secteur ):

						foreach( $val_secteur as $v ):

							$label_secteur .= '<span class="tag">'.$ch_secteur[ $v ] .'</span>';

						endforeach;

					endif;

					$agrement_formateree = get_field_object('agrement_formateree');
					if($agrement_formateree == 'oui'):
						$formateree_label = 'Agrément Format’eree';
					else:
						$formateree_label = 'Non agréée Format’eree';
					endif;

					?>

					<a class="results-list-item" href="<?php the_permalink(); ?>">
						<h2><?php echo get_the_title (); ?></h2>
						<h4><?php echo get_field('nom_centre'); ?> - <?php echo get_field('ville'); ?> - <?php echo $label_departement; ?></h4>
						<p class="description"><?php echo get_field('descriptif_formation'); ?></p>
						<span class="tag first"><?php echo $formateree_label; ?></span>
						<?php echo $label_thematique; ?>
						<?php echo $label_secteur; ?>
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

			echo '<p><strong>Il n\'y a aucune formation pour l\'instant.</strong></p>';

		endif;
		wp_reset_postdata();
	?>
	</div>

	<aside class="l-row bg-light">

		<div class="l-col">
			<div class="c-form c-form--large c-card">

				<form id="form-filter-posts" role="form" class="c-card__body">
					<fieldset class="c-form__fieldset">

						<legend class="c-form__legend c-form--indicateur">Filtrer les formations</legend>
					    <div class="c-form__fieldset__row">
					    	<label for="departement" class="c-form__label is-none">Département</label>
							<select class="c-form__select" name="departement" id="departement">
								<option disabled selected value="">Dans quel département ?</option>
								<?php
									foreach ( load_departements_fields() as $key => $value ) {
						            	echo '<option value="'.$key.'">'.$value.'</option>';
									}
								?>
							</select>
					    </div>

					    <div class="c-form__fieldset__row">
					      <label for="secteur" class="c-form__label is-none">Secteur</label>
					      <select class="c-form__select" name="secteur" id="secteur">
					        <option disabled selected value="">Quel secteur ?</option>				      
					        <option value="secteur_1">Étude/ingénierie</option>
							<option value="secteur_2">Conseil/Accompagnement</option>
							<option value="secteur_3">Réalisation/Installation</option>
							<option value="secteur_4">Maintenance/Exploitation</option>
							<option value="secteur_5">Production industrielle/Fabrication</option>
							<option value="secteur_6">Distribution/Vente/Commercialisation</option>
							<option value="secteur_7">Maîtrise d’ouvrage</option>
					      </select>
					    </div>

					    <div class="c-form__fieldset__row">
					      <label for="thematique" class="c-form__label is-none">Thématique</label>
					      <select class="c-form__select" name="thematique" id="thematique">
					        <option disabled selected value="">Quelle thématique ?</option>
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

					    <div class="c-form__fieldset__row">
					      <label for="publics" class="c-form__label is-none">Public</label>
					      <select class="c-form__select" name="publics" id="publics">
					        <option disabled selected value="">Quel public ?</option>
					        <option value="public_1">lycéens, étudiants, apprentis</option>
							<option value="public_2">salariés, demandeurs d’emplois</option>
					      </select>
					    </div>

					    <div class="c-form__fieldset__row">
					      <label for="agrement_formateree" class="c-form__label is-none">Agréée Format’eree</label>
					      <select class="c-form__select" name="agrement_formateree" id="agrement_formateree">
					        <option disabled selected value="">Agréée Format’eree ?</option>
					        <option value="non">Formation non agréée</option>
					        <option value="oui">Formation agréée</option>
					      </select>
					    </div>
					</fieldset>

					<input type="hidden" value="formations" name="pt_slug">
					<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

					<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>

					<div class="c-form__notify js-notify"></div>

					<div class="c-form__submit">
						<button class="c-btn" type="reset">Reset</button>
					    <button class="c-btn" type="submit" id="submit-filters">Filtrer</button>
					</div>

				</form>
			</div>
		</div>

	</aside>
</section>

<?php get_footer(); ?>

