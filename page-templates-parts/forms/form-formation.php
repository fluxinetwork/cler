 <?php
/**
 * The template part for displaying the form "formation" (add/update)
 */
?>
<header>
	<h1><?php echo $page_title; ?></h1>
</header>

<div class="form">
	<form id="form-manage-formation" role="form">

		<fieldset>
    		<legend>Votre formation</legend>
		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" name="title" id="title" value="<?php echo $formation_title; ?>" data-validation="required"  placeholder="">
		    	<label for="title">Intitulé de la formation<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__group">
		    	<label for="publics">Publics<i class="i-required">*</i></label>
		    	<label for="publics_0" class="form__control form__control--checkbox">Lycéens, étudiants, apprentis
		    		<input type="checkbox" name="publics[]" value="public_1" id="publics_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($publics) && in_array('public_1',$publics))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="publics_1" class="form__control form__control--checkbox">Salariés, demandeurs d’emplois
		    		<input type="checkbox" name="publics[]" value="public_2" id="publics_1" <?php if(!empty($publics) && in_array('public_2',$publics))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    </div>

		    <div class="form__group">
		    	<label for="secteur">Secteur<i class="i-required">*</i></label>
		    	<label for="secteur_0" class="form__control form__control--checkbox">Étude/ingénierie
		    		<input type="checkbox" name="secteur[]" value="secteur_1" id="secteur_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($secteur) && in_array('secteur_1',$secteur))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="secteur_1" class="form__control form__control--checkbox">Conseil/Accompagnement
		    		<input type="checkbox" name="secteur[]" value="secteur_2" id="secteur_1" <?php if(!empty($secteur) && in_array('secteur_2',$secteur))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="secteur_2" class="form__control form__control--checkbox">Réalisation/Installation
		    		<input type="checkbox" name="secteur[]" value="secteur_3" id="secteur_2" <?php if(!empty($secteur) && in_array('secteur_3',$secteur))echo 'checked'; ?>>
		    	 	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="secteur_3" class="form__control form__control--checkbox">Maintenance/Exploitation
		    	  	<input type="checkbox" name="secteur[]" value="secteur_4" id="secteur_3" <?php if(!empty($secteur) && in_array('secteur_4',$secteur))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="secteur_4" class="form__control form__control--checkbox">Production industrielle/Fabrication
		    	  	<input type="checkbox" name="secteur[]" value="secteur_5" id="secteur_4" <?php if(!empty($secteur) && in_array('secteur_5',$secteur))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="secteur_5" class="form__control form__control--checkbox">Distribution/Vente/Commercialisation
		    	  	<input type="checkbox" name="secteur[]" value="secteur_6" id="secteur_5" <?php if(!empty($secteur) && in_array('secteur_6',$secteur))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="secteur_6" class="form__control form__control--checkbox">Maîtrise d’ouvrage
		    	  	<input type="checkbox" name="secteur[]" value="secteur_7" id="secteur_6" <?php if(!empty($secteur) && in_array('secteur_7',$secteur))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    </div>

			<div class="form__group">
		    	<label for="niveau_detude">Niveau d’étude requis<i class="i-required">*</i></label>
		    	<label for="niveau_detude_0" class="form__control form__control--checkbox">BAC
		    		<input type="checkbox" name="niveau_detude[]" value="bac" id="niveau_detude_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($niveau_detude) && in_array('bac',$niveau_detude))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="niveau_detude_1" class="form__control form__control--checkbox">BAC+2
		    		<input type="checkbox" name="niveau_detude[]" value="bac_2" id="niveau_detude_1" <?php if(!empty($niveau_detude) && in_array('bac_2',$niveau_detude))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="niveau_detude_2" class="form__control form__control--checkbox">BAC+3
		    		<input type="checkbox" name="niveau_detude[]" value="bac_3" id="niveau_detude_2" <?php if(!empty($niveau_detude) && in_array('bac_3',$niveau_detude))echo 'checked'; ?>>
		    	 	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="niveau_detude_3" class="form__control form__control--checkbox">BAC+5
		    	  	<input type="checkbox" name="niveau_detude[]" value="bac_5" id="niveau_detude_3" <?php if(!empty($niveau_detude) && in_array('bac_5',$niveau_detude))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    </div>

		     <div class="form__group">
		    	<label for="thematique">Thématique<i class="i-required">*</i></label>
		    	<label for="thematique_0" class="form__control form__control--checkbox">Maîtrise de l’énergie
		    		<input type="checkbox" name="thematique[]" value="thematique_1" id="thematique_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($thematique) && in_array('thematique_1',$thematique))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_1" class="form__control form__control--checkbox">Énergies renouvelables/Généraliste
		    		<input type="checkbox" name="thematique[]" value="thematique_2" id="thematique_1" <?php if(!empty($thematique) && in_array('thematique_2',$thematique))echo 'checked'; ?>>
		    		<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_2" class="form__control form__control--checkbox">Énergies renouvelables/Solaire thermique
		    		<input type="checkbox" name="thematique[]" value="thematique_3" id="thematique_2" <?php if(!empty($thematique) && in_array('thematique_3',$thematique))echo 'checked'; ?>>
		    	 	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_3" class="form__control form__control--checkbox">Énergies renouvelables/Solaire photovoltaïque
		    	  	<input type="checkbox" name="thematique[]" value="thematique_4" id="thematique_3" <?php if(!empty($thematique) && in_array('thematique_4',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_4" class="form__control form__control--checkbox">Énergies renouvelables/Biomasse
		    	  	<input type="checkbox" name="thematique[]" value="thematique_5" id="thematique_4" <?php if(!empty($thematique) && in_array('thematique_5',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_5" class="form__control form__control--checkbox">Énergies renouvelables/Biogaz
		    	  	<input type="checkbox" name="thematique[]" value="thematique_6" id="thematique_5" <?php if(!empty($thematique) && in_array('thematique_6',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_6" class="form__control form__control--checkbox">Énergies renouvelables/Eolien
		    	  	<input type="checkbox" name="thematique[]" value="thematique_7" id="thematique_6" <?php if(!empty($thematique) && in_array('thematique_7',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_7" class="form__control form__control--checkbox">Énergies renouvelables/Hydraulique
		    	  	<input type="checkbox" name="thematique[]" value="thematique_8" id="thematique_7" <?php if(!empty($thematique) && in_array('thematique_8',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_8" class="form__control form__control--checkbox">Énergies renouvelables/Géothermie
		    	  	<input type="checkbox" name="thematique[]" value="thematique_9" id="thematique_8" <?php if(!empty($thematique) && in_array('thematique_9',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_9" class="form__control form__control--checkbox">Territoires &amp; environnement
		    	  	<input type="checkbox" name="thematique[]" value="thematique_10" id="thematique_9" <?php if(!empty($thematique) && in_array('thematique_10',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_10" class="form__control form__control--checkbox">Précarité énergétique
		    	  	<input type="checkbox" name="thematique[]" value="thematique_11" id="thematique_10" <?php if(!empty($thematique) && in_array('thematique_11',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    	<label for="thematique_11" class="form__control form__control--checkbox">Mobilité
		    	  	<input type="checkbox" name="thematique[]" value="thematique_12" id="thematique_11" <?php if(!empty($thematique) && in_array('thematique_12',$thematique))echo 'checked'; ?>>
		    	  	<div class="form__control__indicator"></div>
		    	</label>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" name="duree_formation" id="duree_formation" value="<?php echo $duree_formation; ?>"  placeholder="">
		    	<label for="duree_formation">Durée</label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" name="cout_formation" id="cout_formation" value="<?php echo $cout_formation; ?>" placeholder="">
		    	<label for="cout_formation">Coût</label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<textarea class="js-input-effect input-effect--2" rows="6" name="descriptif_formation" id="descriptif_formation" data-validation="required" placeholder=""><?php echo $descriptif_formation; ?></textarea>
		    	<label for="descriptif_formation">Description formation<i class="i-required">*</i></label>
		    	 <span class="focus-bg"></span>
		    </div>

			<div class="form__group">
		    	<label>Êtes-vous labellisé par le CLER - Réseau pour la transition énergétique (Agrément Format’eree) <i class="i-required">*</i></label>
			    <label class="form__control form__control--radio">
			    	Non
			    	<input type="radio" name="agrement_formateree" data-validation="required" value="non" <?php if( !empty($agrement_formateree) && $agrement_formateree == 'non')echo 'checked';?>>
			    	<div class="form__control__indicator"></div>
			    </label>

				<label class="form__control form__control--radio">
					Oui
			  		<input type="radio" name="agrement_formateree" value="oui" <?php if( !empty($agrement_formateree) && $agrement_formateree == 'oui')echo 'checked';?>>
			  		<div class="form__control__indicator"></div>
		  		</label>
		    </div>

	    </fieldset>

	    <fieldset>
    		<legend>Structure et contacts</legend>

		    <div class="form__group">
		    	<label>Étes-vous adhérent au CLER ?<i class="i-required">*</i></label>
			    <label class="form__control form__control--radio">
			    	Non
			    	<input type="radio" name="is_adherent" value="nonadherent" <?php if(!is_adherent_cler())echo 'checked';?>>
			    	<div class="form__control__indicator"></div>
			    </label>

				<label class="form__control form__control--radio">
					Oui
			  		<input type="radio" name="is_adherent" value="adherent" <?php if(is_adherent_cler())echo 'checked';?>>
			  		<div class="form__control__indicator"></div>
		  		</label>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $nom_centre; ?>" name="nom_centre" id="nom_centre" data-validation="required">
		    	<label for="nom_centre">Centre de formation<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required">
		    	<label for="adresse">Adresse<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

			<div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" maxlength="5" value="<?php echo $code_postal; ?>" name="code_postal" id="code_postal" data-validation="number">
		    	<label for="code_postal">Code postal<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $ville; ?>" name="ville" id="ville" data-validation="required">
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
			    <input class="js-input-effect input-effect--2" type="text" maxlength="10" value="<?php echo $telephone; ?>" name="telephone" id="telephone" data-validation="number">
			    <label for="telephone">Téléphone de contact<i class="i-required">*</i></label>
			    <span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $contact_email; ?>" name="contact_email" id="contact_email" data-validation="email">
		    	<label for="contact_email">Email de contact<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="url" value="<?php echo $site_internet; ?>" name="site_internet" id="site_internet" data-validation="url">
		    	<label for="site_internet">Site internet<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		</fieldset>



	    <input type="hidden" value="68415684348" name="toky_toky">
	    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
	    <input type="hidden" value="<?php echo $the_idp; ?>" name="idp">
	    <?php wp_nonce_field( 'fluxi_manage_formation', 'fluxi_manage_formation_nonce_field' ); ?>

	    <div class="notify"></div>

		<div class="form__buttons">
	   		<button type="submit" id="submit-manage-formation" class="form__submit"><?php echo $type_form_name; ?></button>
	    </div>
	</form>

</div>


