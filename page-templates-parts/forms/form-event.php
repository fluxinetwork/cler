 <?php
/**
 * The template part for displaying the form "événements" (add/update)
 */
?>

<div class="c-card__header">
	<h1 class="c-card__header__title"><?php echo $page_title; ?></h1>
</div>

<form id="form-manage-event" role="form" class="c-card__body">
	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Détail de l'événement</legend>
		<div class="c-form__fieldset__row">
		  	<label class="c-form__label" for="title">Intitulé de l’événement<span class="i-required">*</span></label>
	      	<input class="c-form__input" type="text" name="title" id="title" value="<?php echo $title_event; ?>" placeholder="" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="date_event">Date de l'événement<span class="i-required">*</span></label>
	      	<input type="text" data-validation="date" data-validation-format="dd/mm/yyyy" class="c-form__input" value="<?php if($type_form == 'mod')echo $date_event->format('d/m/Y'); ?>" name="date_event" id="date_event">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="descriptif_event">Description de votre événement<span class="i-required">*</span></label>
	      	<textarea rows="6" class="c-form__input c-form__textarea" placeholder="" name="descriptif_event" id="descriptif_event" data-validation="required"><?php echo $descriptif_event; ?></textarea>
	    </div>

	    <div class="c-form__fieldset__row">
	      <label class="c-form__label" for="publics_event">Publics concernés<span class="i-required">*</span></label>
	      <label for="publics_event_0" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="publics_event[]" value="particuliers" id="publics_event_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($publics_event) && in_array('particuliers',$publics_event))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Particuliers</div>
	      </label>
	      <label for="publics_event_1" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="publics_event[]" value="professionnels" id="publics_event_1" <?php if(!empty($publics_event) && in_array('professionnels',$publics_event))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Professionnels</div>
	      </label>
	    </div>

	    <div class="c-form__fieldset__row">
	      <label class="c-form__label" for="themes">Thèmes<span class="i-required">*</span></label>
	      <label for="themes_0" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="themes[]" value="energies_renouvelables" id="themes_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($themes) && in_array('energies_renouvelables',$themes))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Énergies renouvelables</div>
	      </label>
	      <label for="themes_1" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="themes[]" value="maitrise_energie_batiment" id="themes_1" <?php if(!empty($themes) && in_array('maitrise_energie_batiment',$themes))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Maîtrise de l’énergie/Bâtiment</div>
	      </label>
	      <label for="themes_2" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="themes[]" value="precarite_energetique" id="themes_2" <?php if(!empty($themes) && in_array('precarite_energetique',$themes))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Précarité énergétique</div>
	      </label>
	      <label for="themes_3" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="themes[]" value="mobilite" id="themes_3" <?php if(!empty($themes) && in_array('mobilite',$themes))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Mobilité</div>
	      </label>
	      <label for="themes_4" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="themes[]" value="territoires_democratie" id="themes_4" <?php if(!empty($themes) && in_array('territoires_democratie',$themes))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Territoires et démocratie</div>
	      </label>
	      <label for="themes_5" class="c-form__label c-form__label--checkbox">
	        <input class="c-form__label__checkbox" type="checkbox" name="themes[]" value="emploi_formation" id="themes_5" <?php if(!empty($themes) && in_array('emploi_formation',$themes))echo 'checked'; ?>>
	        <div class="c-form__label__txt">Emploi/formation</div>
	      </label>
	    </div>
    </fieldset>

    <fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Localisation et contacts</legend>

	     <div class="c-form__fieldset__row">
	     	<label class="c-form__label" for="adresse">Adresse<span class="i-required">*</span></label>
	      	<input class="c-form__input" type="text" placeholder="" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required">
	    </div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="code_postal">Code postal<span class="i-required">*</span></label>
	      	<input class="c-form__input" type="text" maxlength="5" placeholder="" value="<?php echo $code_postal; ?>" name="code_postal" id="code_postal" data-validation="number">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="ville">Ville<span class="i-required">*</span></label>
	      	<input class="c-form__input" type="text" placeholder="" value="<?php echo $ville; ?>" name="ville" id="ville" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="departement">Département<span class="i-required">*</span></label>
			<select class="c-form__select" name="departement" id="departement" data-validation="required">
				<option disabled selected value="">Dans quel département ?<span class="i-required">*</span></option>
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
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="link_event">Lien internet</label>
	      	<input class="c-form__input" type="url" placeholder="" value="<?php echo $link_event; ?>" name="link_event" id="link_event">
	    </div>

    </fieldset>

    <input type="hidden" value="6874269923" name="toky_toky">
    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
    <input type="hidden" value="<?php echo $the_idp; ?>" name="idp">
    <?php wp_nonce_field( 'fluxi_manage_event', 'fluxi_manage_event_nonce_field' ); ?>

    <div class="c-form__notify js-notify"></div>

	<div class="c-form__submit">
    	<button type="submit" id="submit-manage-event" class="c-btn"><?php echo $type_form_name; ?></button>
    </div>

</form>




