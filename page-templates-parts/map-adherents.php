<?php
/**
 * The template part for displaying the content
 */
?>

<?php

	$ob_type_struct = get_field_object('field_577102c963035');	
?>

<article class="l-large">

	<header><?php the_title( '<h1>', '</h1>' ); ?></header>

	<?php the_content(); ?>

	<div class="map-holder">
		<div class="spinner"></div>

		<div id="map"></div>

		<div class="map-panel">

			<div class="form">
				<form id="form-filter-map" role="form">				    
				    <label class="c-form__label" for="type_structure">Type de structure</label>
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
					
					<button type="submit" id="submit-filters" class="c-btn">Filtrer</button>
					<button type="reset" class="c-btn">reset</button>
				</form>
			</div>

			<div class="map-cards"></div>			

		</div>

	</div>


</article>


