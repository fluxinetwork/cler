 <?php
/**
 * The template part for displaying the form "événements" (add/update)
 */
?>

<header>
	<h1><?php echo $page_title; ?></h1>
</header>

<div class="form">
	<form id="form-manage-event" role="form">
		<fieldset>
    		<legend>Détail de l'événement</legend>
			<div class="form__row">	      
		      <input class="js-input-effect input-effect--2" type="text" name="title" id="title" value="<?php echo $title_event; ?>" placeholder="" data-validation="required">
		      <label for="title">Intitulé de l’événement<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

		    <div class="form__row">	      
		      <input type="text" data-validation="date" data-validation-format="dd/mm/yyyy" class="js-input-effect input-effect--2" value="<?php if($type_form == 'mod')echo $date_event->format('d/m/Y'); ?>" name="date_event" id="date_event">
		      <label for="date_event">Date de l'événement<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

		    <div class="form__row">	      
		      <textarea rows="6" class="js-input-effect input-effect--2" placeholder="" name="descriptif_event" id="descriptif_event" data-validation="required"><?php echo $descriptif_event; ?></textarea>
		      <label for="descriptif_event">Description de votre événement<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

		    <div class="form__group">
		      <label for="publics_event">Publics concernés<i class="i-required">*</i></label>
		      <label for="publics_event_0" class="form__control form__control--checkbox">Particuliers
		        <input type="checkbox" name="publics_event[]" value="particuliers" id="publics_event_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($publics_event) && in_array('particuliers',$publics_event))echo 'checked'; ?>>
		        <div class="form__control__indicator"></div>
		      </label>
		      <label for="publics_event_1" class="form__control form__control--checkbox">Professionnels
		        <input type="checkbox" name="publics_event[]" value="professionnels" id="publics_event_1" <?php if(!empty($publics_event) && in_array('professionnels',$publics_event))echo 'checked'; ?>>
		        <div class="form__control__indicator"></div>
		      </label>
		    </div>	    

		    <div class="form__group">
		      <label for="themes">Thèmes<i class="i-required">*</i></label>
		      <label for="themes_0" class="form__control form__control--checkbox">Énergies renouvelables
		        <input type="checkbox" name="themes[]" value="energies_renouvelables" id="themes_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($themes) && in_array('energies_renouvelables',$themes))echo 'checked'; ?>>	        
		        <div class="form__control__indicator"></div>
		      </label>
		      <label for="themes_1" class="form__control form__control--checkbox">Maîtrise de l’énergie/Bâtiment
		        <input type="checkbox" name="themes[]" value="maitrise_energie_batiment" id="themes_1" <?php if(!empty($themes) && in_array('maitrise_energie_batiment',$themes))echo 'checked'; ?>>
		        <div class="form__control__indicator"></div>
		      </label>
		      <label for="themes_2" class="form__control form__control--checkbox">Précarité énergétique
		        <input type="checkbox" name="themes[]" value="precarite_energetique" id="themes_2" <?php if(!empty($themes) && in_array('precarite_energetique',$themes))echo 'checked'; ?>>
		        <div class="form__control__indicator"></div>
		      </label>
		      <label for="themes_3" class="form__control form__control--checkbox">Mobilité
		        <input type="checkbox" name="themes[]" value="mobilite" id="themes_3" <?php if(!empty($themes) && in_array('mobilite',$themes))echo 'checked'; ?>>	        
		        <div class="form__control__indicator"></div>
		      </label>
		      <label for="themes_4" class="form__control form__control--checkbox">Territoires et démocratie
		        <input type="checkbox" name="themes[]" value="territoires_democratie" id="themes_4" <?php if(!empty($themes) && in_array('territoires_democratie',$themes))echo 'checked'; ?>>
		        <div class="form__control__indicator"></div>
		      </label>
		      <label for="themes_5" class="form__control form__control--checkbox">Emploi/formation
		        <input type="checkbox" name="themes[]" value="emploi_formation" id="themes_5" <?php if(!empty($themes) && in_array('emploi_formation',$themes))echo 'checked'; ?>>
		        <div class="form__control__indicator"></div>
		      </label>
		    </div>
	    </fieldset>

	    <fieldset>
    		<legend>Localisation et contacts</legend>		    

		     <div class="form__row">	      
		      <input type="text" class="js-input-effect input-effect--2" placeholder="" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required">
		      <label for="adresse">Adresse<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

			<div class="form__row">	     
		      <input type="text" class="js-input-effect input-effect--2" maxlength="5" placeholder="" value="<?php echo $code_postal; ?>" name="code_postal" id="code_postal" data-validation="number">
		      <label for="code_postal">Code postal<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

		    <div class="form__row">	      
		      <input type="text" class="js-input-effect input-effect--2" placeholder="" value="<?php echo $ville; ?>" name="ville" id="ville" data-validation="required">
		      <label for="ville">Ville<i class="i-required">*</i></label>
		      <span class="focus-bg"></span>
		    </div>

		    <div class="form__select">
		    	<label for="departement" class="label-effect--1">Département<i class="i-required">*</i></label>
				<select name="departement" id="departement" data-validation="required">
					<option disabled selected value="">Dans quel département ?<i class="i-required">*</i></option>
					<?php
						foreach ( load_departements_fields() as $key => $value ) {

			            	if( $departement == $key ):
			            		echo '<option value="'.$key.'" selected>'.$value.'</option>';
			            	else:
			            		echo '<option value="'.$key.'">'.$value.'</option>';
			            	endif;

						}

					?>
				</select>
				<div class="form__select__arrow"></div>
		    </div>	    

		    <div class="form__row">	      
		      <input type="url" class="js-input-effect input-effect--2" placeholder="" value="<?php echo $link_event; ?>" name="link_event" id="link_event">
		      <label for="link_event">Lien internet</label>
		      <span class="focus-bg"></span>
		    </div>

	    </fieldset>

	    <input type="hidden" value="6874269923" name="toky_toky">
	    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
	    <input type="hidden" value="<?php echo $the_idp; ?>" name="idp">
	    <?php wp_nonce_field( 'fluxi_manage_event', 'fluxi_manage_event_nonce_field' ); ?>

	    <div class="notify"></div>

	    <div class="form__buttons">			
	    	<button type="submit" id="submit-manage-event" class="form__submit"><?php echo $type_form_name; ?></button>
	    </div>

	</form>

</div>


