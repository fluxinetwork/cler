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
	<aside class="c-filterList c-filterList--small map__holder__filters">
		<form id="form-filter-map" role="form">
		<div class="l-grid">
		    <div class="c-filterList__filter l-grid__col">
		    	<label for="departement" class="is-none">Département</label>
		    	<i class="fa fa-filter" aria-hidden="true"></i>
				<select class="c-form__select" name="type_structure" id="type_structure" data-validation="required">
					<option disabled selected value=""> Quel type de structure ?</option>
					<?php
						if( $ob_type_struct ):
							foreach( $ob_type_struct['choices'] as $k => $v ):
								echo '<option value="' . $k . '">' . $v . '</option>';
							endforeach;
						endif;
					?>
				</select>	
		    </div>
		</div>

			<input type="hidden" value="offres-emploi" name="pt_slug">
			<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

			<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>


			<div class="c-filterList__buttons">
				<a href="<?php echo home_url().'/mon-profil/gerer-offre-emploi/?act=add'; ?>" class="c-link c-link--shy">Adhérer au CLER</a>
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

	<div class="spinner map__holder__loader"></div>

	<div id="map"></div>

	<div class="map__holder__cards"></div>			
</div>

<?php the_content(); ?>



