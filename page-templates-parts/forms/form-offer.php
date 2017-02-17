 <?php
/**
 * The template part for displaying the form "offre d'emploie" (add/update)
 */
?>
<?php 
	$statut_paiement = get_field('offer_payed', $the_idp);
	$id_recu = get_field('recu_offer', $the_idp);
?>

<div class="c-card__header">
	<h1 class="c-card__header__title"><?php echo $page_title; ?></h1>
</div>

<form id="form-manage-emploi" role="form" class="c-card__body">	
	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Votre offre</legend>
		<div class="c-form__fieldset__row">
	<?php 
		if(is_adherent_cler() ):			
			if( !empty($statut_paiement) && $statut_paiement == 'succeeded' ): ?>
				<p>Vous avez payé pour la publication de cette offre d'emploi, vous pouvez <a href="<?php echo get_the_permalink($id_recu); ?>">consulter le reçu</a>.</p>
			<?php
			endif;				
		else: ?>					
			<p>Vous n'êtes pas adhérent au CLER : une contribution de <strong><?php echo get_field('montant_publication_offre_emploi', 'option'); ?> euros</strong> vous sera donc demandée pour chaque nouvelle publication. Vous recevrez un email contenant les informations nécessaires au réglement dès que nous aurons validé votre offre. Pour devenir adhérent, vous pouvez <a class="c-link c-link--shy" href="<?php the_permalink(PAGE_ADHEREZ); ?>">consulter cette page</a>.</p>
	<?php endif; ?>
	</div>
	    <div class="c-form__fieldset__row">	    	
	    	<label class="c-form__label" for="title">Intitulé de l’offre<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" name="title" id="title" value="<?php echo $offer_title; ?>" data-validation="required"  placeholder="">
	    </div>	    

	    <div class="c-form__fieldset__row">
	    	<label for="type_de_poste" class="c-form__label">Type de poste<span class="i-required">•</span></label>
	    	<select class="c-form__select" name="type_de_poste" id="type_de_poste" data-validation="required">
	    		<option disabled selected value="">Quel type de poste ?<span class="i-required">•</span></option>
	    		<option value="stage" <?php if($type_de_poste=='stage')echo 'selected';?>>Stage</option>
	    		<option value="cdd" <?php if($type_de_poste=='cdd')echo 'selected';?>>CDD</option>
	    		<option value="cdi" <?php if($type_de_poste=='cdi')echo 'selected';?>>CDI</option>
	    		<option value="autre" <?php if($type_de_poste=='autre')echo 'selected';?>>Autre</option>
	    	</select>	    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="missions">Quelles missions ?<span class="i-required">•</span></label>
	    	<textarea class="c-form__input c-form__textarea" rows="6" name="missions" id="missions" data-validation="required"><?php echo $missions; ?></textarea>  
	    </div>

		<div class="c-form__fieldset__row">
	    	<label for="niveau_detude" class="c-form__label">Niveau d’étude requis<span class="i-required">•</span></label>
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
	    	<label for="experience" class="c-form__label">Expérience<span class="i-required">•</span></label>
	    	<select class="c-form__select" name="experience" id="experience" data-validation="required">
	    		<option disabled selected value="">Combien d'année d'expérience ?<span class="i-required">•</span></option>
	    		<option value="experience_0" <?php if($experience=='experience_0')echo 'selected';?>>Jeune diplômé(e)</option>
	    		<option value="experience_1" <?php if($experience=='experience_1')echo 'selected';?>>1 à 3 ans</option>
	    		<option value="experience_2" <?php if($experience=='experience_2')echo 'selected';?>>3 à 5 ans</option>
				<option value="experience_3" <?php if($experience=='experience_3')echo 'selected';?>>5 à 10 ans</option>
				<option value="experience_4" <?php if($experience=='experience_4')echo 'selected';?>>Plus de 10 ans</option>
	    	</select>	    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="profil_recherche">Profil recherché<span class="i-required">•</span></label>
	    	<textarea class="c-form__input c-form__textarea" rows="6" name="profil_recherche" id="profil_recherche" data-validation="required" placeholder=""><?php echo $profil_recherche; ?></textarea>
	    </div>
    </fieldset>

    <fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Votre structure</legend>

	    <div class="c-form__fieldset__row">
	    	<label for="type_structure" class="c-form__label">Type de structure<span class="i-required">•</span></label>
	    	<select class="c-form__select" name="type_structure" id="type_structure" data-validation="required">
	    		<option disabled selected value="">Quel type de structure ?<span class="i-required">•</span></option>
	    		<option value="entreprise" <?php if($type_structure=='entreprise')echo 'selected';?>>Entreprise</option>
	    		<option value="association" <?php if($type_structure=='association')echo 'selected';?>>Association</option>
	    		<option value="collectivite" <?php if($type_structure=='collectivite')echo 'selected';?>>Collectivité</option>
				<option value="formation" <?php if($type_structure=='formation')echo 'selected';?>>Organisme de formation</option>
	    	</select>	    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="nom_structure">Nom de la structure<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $nom_structure; ?>" name="nom_structure" id="nom_structure" data-validation="required">  
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="adresse">Adresse<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required">
	    </div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="code_postal">Code postal<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" maxlength="5" value="<?php echo $code_postal; ?>" name="code_postal" id="code_postal" data-validation="number">	    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="ville">Ville<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $ville; ?>" name="ville" id="ville" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label for="departement" class="c-form__label">Département<span class="i-required">•</span></label>
			<select class="c-form__select" name="departement" id="departement" data-validation="required">
				<option disabled selected value="">Dans quel département ?<span class="i-required">•</span></option>
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
	    	<label class="c-form__label" for="descriptif_organisme">Description de votre structure<span class="i-required">•</span></label>
	    	<textarea class="c-form__input c-form__textarea" rows="6" name="descriptif_organisme" id="descriptif_organisme" data-validation="required" placeholder=""><?php echo $descriptif_organisme; ?></textarea>	    	
	    </div>   
	</fieldset>

    <fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Contact et candidatures</legend>	     

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="nom_prenom_contact">Nom et prénom du contact<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $nom_prenom_contact; ?>" name="nom_prenom_contact" id="nom_prenom_contact" data-validation="required">	    	
	    </div>

	    <div class="c-form__fieldset__row">
	   		<label class="c-form__label" for="fonction_contact">Fonction du contact<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $fonction_contact; ?>" name="fonction_contact" id="fonction_contact" data-validation="required">
	    </div>

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="contact_email">Email de contact<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $contact_email; ?>" name="contact_email" id="contact_email" data-validation="email">	    	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="telephone">Téléphone de contact<span class="i-required">•</span></label>
		    <input class="c-form__input" type="text" maxlength="14" value="<?php echo $telephone; ?>" name="telephone" id="telephone" data-validation="required">		    
	    </div>

		<div class="c-form__fieldset__row">
	      	<label for="modalite_candidature" class="c-form__label">Modalité de candidature<span class="i-required">•</span></label>
	      	<label for="modalite_candidature_0" class="c-form__label c-form__label--checkbox">
	        	<input type="checkbox" class="c-form__label__checkbox" name="modalite_candidature[]" value="courrier" id="modalite_candidature_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($modalite_candidature) && in_array('courrier',$modalite_candidature))echo 'checked'; ?>>        
	        	<div class="c-form__label__txt"> Par courrier</div>
			</label>
	      	<label for="modalite_candidature_1" class="c-form__label c-form__label--checkbox">
	        	<input type="checkbox" class="c-form__label__checkbox" name="modalite_candidature[]" value="mail" id="modalite_candidature_1" <?php if(!empty($modalite_candidature) && in_array('mail',$modalite_candidature))echo 'checked'; ?>>	        
	        	<div class="c-form__label__txt"> Par mail</div>
	        </label>
	    </div>		

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="date_candidature">Date limite de candidature<span class="i-required">•</span></label>
	      	<input class="c-form__input" data-validation="date" data-validation-format="dd/mm/yyyy" type="text" value="<?php if($type_form == 'mod')echo $date_candidature->format('d/m/Y'); ?>" name="date_candidature" id="date_candidature">	      	
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="site_internet_structure">Votre site internet</label>
	    	<input class="c-form__input" type="url" value="<?php echo $site_internet_structure; ?>" name="site_internet_structure" id="site_internet_structure">   
	    </div>
    </fieldset>

    <input type="hidden" value="4796248892" name="toky_toky">
    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
    <input type="hidden" value="<?php echo $the_idp; ?>" name="idp">
    <?php wp_nonce_field( 'fluxi_manage_emploi', 'fluxi_manage_emploi_nonce_field' ); ?>

    <div class="c-form__notify js-notify"></div>

	<div class="c-form__submit">			
   		<button type="submit" id="submit-manage-emploi" class="c-btn"><?php echo $type_form_name; ?></button>
    </div>
</form>