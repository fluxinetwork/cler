 <?php
/**
 * The template part for displaying the form "formation" (add/update)
 */
?>
<div class="c-card__header">
	<h1 class="c-card__header__title"><?php echo $page_title; ?><br><span>Rejoignez notre réseau !</span></h1>
</div>


<form id="form-manage-formation" role="form" class="c-card__body">

	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Votre formation</legend>
	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="title">Intitulé de la formation<span class="i-required">*</span></label>
	    	<input class="c-form__input" type="text" name="title" id="title" value="<?php echo $formation_title; ?>" data-validation="required" placeholder="">		    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="publics" class="c-form__label">Publics<span class="i-required">*</span></label>
	    	<label for="publics_0" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="publics[]" value="public_1" id="publics_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($publics) && in_array('public_1',$publics))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Lycéens, étudiants, apprentis</div>    		
	    	</label>
	    	<label for="publics_1" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="publics[]" value="public_2" id="publics_1" <?php if(!empty($publics) && in_array('public_2',$publics))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Salariés, demandeurs d’emplois</div>    		
	    	</label>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="secteur" class="c-form__label">Secteur<span class="i-required">*</span></label>
	    	<label for="secteur_0" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_1" id="secteur_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($secteur) && in_array('secteur_1',$secteur))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Étude/ingénierie</div>	    		
	    	</label>
	    	<label for="secteur_1" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_2" id="secteur_1" <?php if(!empty($secteur) && in_array('secteur_2',$secteur))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Conseil/Accompagnement</div>		    		
	    	</label>
	    	<label for="secteur_2" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_3" id="secteur_2" <?php if(!empty($secteur) && in_array('secteur_3',$secteur))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Réalisation/Installation</div>		    	 	
	    	</label>
	    	<label for="secteur_3" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_4" id="secteur_3" <?php if(!empty($secteur) && in_array('secteur_4',$secteur))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Maintenance/Exploitation</div>		    	  	
	    	</label>
	    	<label for="secteur_4" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_5" id="secteur_4" <?php if(!empty($secteur) && in_array('secteur_5',$secteur))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Production industrielle/Fabrication</div>		    	  	
	    	</label>
	    	<label for="secteur_5" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_6" id="secteur_5" <?php if(!empty($secteur) && in_array('secteur_6',$secteur))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Distribution/Vente/Commercialisation</div>		    	  	
	    	</label>
	    	<label for="secteur_6" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="secteur[]" value="secteur_7" id="secteur_6" <?php if(!empty($secteur) && in_array('secteur_7',$secteur))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Maîtrise d’ouvrage</div>		    	  	
	    	</label>
	    </div>

		<div class="c-form__fieldset__row">
	    	<label for="niveau_detude" class="c-form__label">Niveau d’étude requis<span class="i-required">*</span></label>
	    	<label for="niveau_detude_0" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="niveau_detude[]" value="bac" id="niveau_detude_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($niveau_detude) && in_array('bac',$niveau_detude))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">BAC</div>		    		
	    	</label>
	    	<label for="niveau_detude_1" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="niveau_detude[]" value="bac_2" id="niveau_detude_1" <?php if(!empty($niveau_detude) && in_array('bac_2',$niveau_detude))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">BAC+2</div>		    		
	    	</label>
	    	<label for="niveau_detude_2" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="niveau_detude[]" value="bac_3" id="niveau_detude_2" <?php if(!empty($niveau_detude) && in_array('bac_3',$niveau_detude))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">BAC+3</div>		    	 	
	    	</label>
	    	<label for="niveau_detude_3" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="niveau_detude[]" value="bac_5" id="niveau_detude_3" <?php if(!empty($niveau_detude) && in_array('bac_5',$niveau_detude))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">BAC+5</div>		    	  	
	    	</label>
	    </div>

	     <div class="c-form__fieldset__row">
	    	<label for="thematique" class="c-form__label">Thématique<span class="i-required">*</span></label>
	    	<label for="thematique_0" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_1" id="thematique_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($thematique) && in_array('thematique_1',$thematique))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Maîtrise de l’énergie</div>		    		
	    	</label>
	    	<label for="thematique_1" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_2" id="thematique_1" <?php if(!empty($thematique) && in_array('thematique_2',$thematique))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Énergies renouvelables/Généraliste</div>		    		
	    	</label>
	    	<label for="thematique_2" class="c-form__label c-form__label--checkbox">
	    		<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_3" id="thematique_2" <?php if(!empty($thematique) && in_array('thematique_3',$thematique))echo 'checked'; ?>>
	    		<div class="c-form__label__txt">Énergies renouvelables/Solaire thermique</div>		    	 	
	    	</label>
	    	<label for="thematique_3" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_4" id="thematique_3" <?php if(!empty($thematique) && in_array('thematique_4',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Énergies renouvelables/Solaire photovoltaïque</div>		    	  	
	    	</label>
	    	<label for="thematique_4" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_5" id="thematique_4" <?php if(!empty($thematique) && in_array('thematique_5',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Énergies renouvelables/Biomasse</div>		    	  	
	    	</label>
	    	<label for="thematique_5" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_6" id="thematique_5" <?php if(!empty($thematique) && in_array('thematique_6',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Énergies renouvelables/Biogaz</div>		    	  	
	    	</label>
	    	<label for="thematique_6" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_7" id="thematique_6" <?php if(!empty($thematique) && in_array('thematique_7',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Énergies renouvelables/Eolien</div>		    	  	
	    	</label>
	    	<label for="thematique_7" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_8" id="thematique_7" <?php if(!empty($thematique) && in_array('thematique_8',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Énergies renouvelables/Hydraulique</div>		    	  	
	    	</label>
	    	<label for="thematique_8" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_9" id="thematique_8" <?php if(!empty($thematique) && in_array('thematique_9',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Énergies renouvelables/Géothermie</div>		    	  	
	    	</label>
	    	<label for="thematique_9" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_10" id="thematique_9" <?php if(!empty($thematique) && in_array('thematique_10',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Territoires &amp; environnement</div>		    	  	
	    	</label>
	    	<label for="thematique_10" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_11" id="thematique_10" <?php if(!empty($thematique) && in_array('thematique_11',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Précarité énergétique</div>		    	  	
	    	</label>
	    	<label for="thematique_11" class="c-form__label c-form__label--checkbox">
	    	  	<input type="checkbox" class="c-form__label__checkbox" name="thematique[]" value="thematique_12" id="thematique_11" <?php if(!empty($thematique) && in_array('thematique_12',$thematique))echo 'checked'; ?>>
	    	  	<div class="c-form__label__txt">Mobilité</div>		    	  	
	    	</label>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="duree_formation" class="c-form__label">Durée</label>
	    	<input class="c-form__input" type="text" name="duree_formation" id="duree_formation" value="<?php echo $duree_formation; ?>"  placeholder="">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="cout_formation" class="c-form__label">Coût</label>
	    	<input class="c-form__input" type="text" name="cout_formation" id="cout_formation" value="<?php echo $cout_formation; ?>" placeholder="">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="descriptif_formation" class="c-form__label">Description formation<span class="i-required">*</span></label>
	    	<textarea class="c-form__input c-form__textarea" rows="6" name="descriptif_formation" id="descriptif_formation" data-validation="required" placeholder=""><?php echo $descriptif_formation; ?></textarea>		    	
	    </div>

		<div class="c-form__fieldset__row">
	    	<label class="c-form__label">Êtes-vous labellisé par le CLER - Réseau pour la transition énergétique (Agrément Format’eree) <span class="i-required">*</span></label>
		    <label class="c-form__label c-form__label--checkbox">			    	
		    	<input type="radio" name="agrement_formateree" data-validation="required" value="non" <?php if( !empty($agrement_formateree) && $agrement_formateree == 'non')echo 'checked';?>>
		    	<div class="c-form__label__txt">Non</div>
		    </label>

			<label class="c-form__label c-form__label--checkbox">					
		  		<input type="radio" name="agrement_formateree" value="oui" <?php if( !empty($agrement_formateree) && $agrement_formateree == 'oui')echo 'checked';?>>
		  		<div class="c-form__label__txt">Oui</div>
	  		</label>
	    </div>

    </fieldset>

    <fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Structure et contacts</legend>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label">Étes-vous adhérent au CLER ?<span class="i-required">*</span></label>
		    <label class="c-form__label c-form__label--checkbox">			    	
		    	<input type="radio" name="is_adherent" value="nonadherent" <?php if(!is_adherent_cler())echo 'checked';?>>
		    	<div class="c-form__label__txt">Non</div>
		    </label>

			<label class="c-form__label c-form__label--checkbox">					
		  		<input type="radio" name="is_adherent" value="adherent" <?php if(is_adherent_cler())echo 'checked';?>>
		  		<div class="c-form__label__txt">Oui</div>
	  		</label>
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="nom_centre" class="c-form__label">Centre de formation<span class="i-required">*</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $nom_centre; ?>" name="nom_centre" id="nom_centre" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="adresse" class="c-form__label">Adresse<span class="i-required">*</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required">
	    </div>

		<div class="c-form__fieldset__row">
			<label for="code_postal" class="c-form__label">Code postal<span class="i-required">*</span></label>
	    	<input class="c-form__input" type="text" maxlength="5" value="<?php echo $code_postal; ?>" name="code_postal" id="code_postal" data-validation="number">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="ville" class="c-form__label">Ville<span class="i-required">*</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $ville; ?>" name="ville" id="ville" data-validation="required">		    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="departement" class="c-form__label">Département<span class="i-required">*</span></label>
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
	    	<label for="telephone" class="c-form__label">Téléphone de contact<span class="i-required">*</span></label>
		    <input class="c-form__input" type="text" maxlength="14" value="<?php echo $telephone; ?>" name="telephone" id="telephone" data-validation="required">			   
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="contact_email" class="c-form__label">Email de contact<span class="i-required">*</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $contact_email; ?>" name="contact_email" id="contact_email" data-validation="email">		    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="site_internet" class="c-form__label">Site internet</label>
	    	<input class="c-form__input" type="url" value="<?php echo $site_internet; ?>" name="site_internet" id="site_internet">
	    </div>

	</fieldset>


    <input type="hidden" value="68415684348" name="toky_toky">
    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
    <input type="hidden" value="<?php echo $the_idp; ?>" name="idp">
    <?php wp_nonce_field( 'fluxi_manage_formation', 'fluxi_manage_formation_nonce_field' ); ?>

    <div class="c-form__notify js-notify"></div>

	<div class="c-form__submit">
   		<button type="submit" id="submit-manage-formation" class="c-btn"><?php echo $type_form_name; ?></button>
    </div>
</form>




