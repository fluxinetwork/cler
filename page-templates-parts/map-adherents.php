<?php
/**
 * The template part for displaying the content
 */
?>

<?php 
	$ob_type_struct = get_field_object('field_577102c963035');	
	$nb_adherent = wp_count_posts('cartes');
	$nb_adherent_publish = $nb_adherent->publish;
?>

<div class="l-row bg-dark--grad">
	<header class="l-col l-col--content">
		<h1 class="c-white"><?php echo get_the_title(); ?></h1>
		<div class="c-meta c-meta--white">
			<div class="c-dash"></div>
			<span class="c-meta__meta"><i class="fa fa-user c-meta__meta__icon" aria-hidden="true"></i><?php echo $nb_adherent_publish; ?> adhérents</span>
		</div>
	</header>
</div>

<div class="map__holder">
	<aside class="l-filterList l-filterList--small map__holder__filters">
		<form id="form-filter-map" role="form" class="l-monoFilter">
		    <div class="l-filterList__filter">
		    	<label for="departement" class="is-none">Type de structure</label>
		    	<i class="fa fa-filter" aria-hidden="true"></i>
				<select class="c-form__select" name="type_structure" id="type_structure" data-validation="required">
					<option disabled selected value="">Type de structure ?</option>
					<?php
						if( $ob_type_struct ):
							foreach( $ob_type_struct['choices'] as $k => $v ):
								echo '<option value="' . $k . '">' . $v . '</option>';
							endforeach;
						endif;
					?>
				</select>
		    </div>			
			
			<button type="reset" class="c-btn c-btn--reset l-monoFilter__btn js-reload is-none">Reset</button>
			<button type="submit" id="submit-filters" class="c-btn c-btn--ghost l-monoFilter__btn is-none">Filtrer</button>

			<a href="<?php the_permalink(PAGE_ADHEREZ); ?>" class="c-link c-link--shy l-monoFilter__link"><i class="fa fa-user-plus c-meta__meta__icon"></i>Devenir adhérent</a>
		</form>
	</aside>

	<div class="spinner map__holder__loader"></div>

	<div id="map"></div>

	<div class="map__holder__cards"></div>
</div>

<div class="l-row">
	<div class="l-col l-col--content">
		<?php the_content(); ?>
	</div>
</div>

<?php the_content(); ?>
