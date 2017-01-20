<?php
/**
 * The template part for displaying the content
 */
?>

<?php $ob_type_struct = get_field_object('field_577102c963035'); ?>

<div class="l-row bg-dark--grad">
	<header class="l-col l-col--content">
		<h1 class="c-white"><?php echo get_the_title(); ?></h1>
		<div class="c-meta c-meta--white">
			<div class="c-dash"></div>
			<span class="c-meta__meta"><i class="fa fa-user c-meta__meta__icon" aria-hidden="true"></i>275 adhérents</span>
		</div>
	</header>
</div>

<div class="map__holder">
	<aside class="l-filterList l-filterList--small map__holder__filters">
		<form id="form-filter-map" role="form" class="l-monoFilter">
		    <div class="l-filterList__filter">
		    	<label for="departement" class="is-none">Département</label>
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

			<input type="hidden" value="offres-emploi" name="pt_slug">
			<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">
			<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>

			<button type="submit" id="submit-filters" class="c-btn l-monoFilter__btn">Filtrer</button>

			<a href="" class="c-link c-link--shy l-monoFilter__link">Devenir adhérent</a>
		</form>
	</aside>

	<div class="spinner map__holder__loader"></div>

	<div id="map"></div>

	<div class="map__holder__cards"></div>			
</div>

<?php the_content(); ?>



