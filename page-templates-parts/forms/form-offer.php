 <?php
/**
 * The template part for displaying the form "offre d'emploie" (add/update)
 */
?>
<?php 
	$statut_paiement = get_field('offer_payed', $the_idp);
	$id_recu = get_field('recu_offer', $the_idp);
?>

<header>
	<h1><?php echo $page_title; ?></h1>
</header>


<?php 
	if(!is_adherent_cler() ):

		if( !empty($statut_paiement) && $statut_paiement == 'succeeded' ): ?>

			<p>Vous avez payé pour la publication de cette offre d'emploi, vous pouvez <a href="<?php echo get_the_permalink($id_recu); ?>">consulter le reçu</a>.</p>
		<?php else: ?>
			<p>Vous n'êtes pas adhérent au CLER, une contribution de <strong><?php echo get_field('montant_publication_offre_emploi', 'option'); ?>€</strong> vous sera demandé pour chaque nouvelle publication. Vous recevrez un email contenant les informations nécessaire au réglement dès que nous aurons validé votre offre. Pour devenir adhérent vous pouvez consulter <a href="#">cette page</a>.</p>
		<?php
		endif;	
 	endif; 
 ?>



<div class="form">
	<form id="form-manage-emploi" role="form">	

		<fieldset>
    		<legend>Votre offre</legend>
		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" name="title" id="title" value="<?php echo $offer_title; ?>" data-validation="required"  placeholder="">
		    	<label for="title">Intitulé de l’offre<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__select">
		    	<label for="type_de_poste" class="label-effect--1">Type de poste<i class="i-required">*</i></label>
		    	<select name="type_de_poste" id="type_de_poste" data-validation="required">
		    		<option disabled selected value="">Quel type de poste ?<i class="i-required">*</i></option>
		    		<option value="stage" <?php if($type_de_poste=='stage')echo 'selected';?>>Stage</option>
		    		<option value="cdd" <?php if($type_de_poste=='cdd')echo 'selected';?>>CDD</option>
		    		<option value="cdi" <?php if($type_de_poste=='cdi')echo 'selected';?>>CDI</option>
		    		<option value="autre" <?php if($type_de_poste=='autre')echo 'selected';?>>Autre</option>
		    	</select>
		    	<div class="form__select__arrow"></div>
		    </div>	    

		    <div class="form__row">
		    	<textarea class="js-input-effect input-effect--2" rows="6" name="missions" id="missions" data-validation="required"><?php echo $missions; ?></textarea>
		    	<label for="missions">Quelles missions ?<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
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

		    <div class="form__select">
		    	<label for="experience" class="label-effect--1">Expérience<i class="i-required">*</i></label>
		    	<select name="experience" id="experience" data-validation="required">
		    		<option disabled selected value="">Combien d'année d'expérience ?<i class="i-required">*</i></option>
		    		<option value="experience_0" <?php if($experience=='experience_0')echo 'selected';?>>Jeune diplômé(e)</option>
		    		<option value="experience_1" <?php if($experience=='experience_1')echo 'selected';?>>1 à 3 ans</option>
		    		<option value="experience_2" <?php if($experience=='experience_2')echo 'selected';?>>3 à 5 ans</option>
					<option value="experience_3" <?php if($experience=='experience_3')echo 'selected';?>>5 à 10 ans</option>
					<option value="experience_4" <?php if($experience=='experience_4')echo 'selected';?>>Plus de 10 ans</option>
		    	</select>
		    	<div class="form__select__arrow"></div>
		    </div>

		    <div class="form__row">
		    	<textarea class="js-input-effect input-effect--2" rows="6" name="profil_recherche" id="profil_recherche" data-validation="required" placeholder=""><?php echo $profil_recherche; ?></textarea>
		    	<label for="profil_recherche">Profil recherché<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>
	    </fieldset>

	    <fieldset>
    		<legend>Votre structure</legend>

		    <div class="form__select">
		    	<label for="type_structure" class="label-effect--1">Type de structure<i class="i-required">*</i></label>
		    	<select name="type_structure" id="type_structure" data-validation="required">
		    		<option disabled selected value="">Quel type de structure ?<i class="i-required">*</i></option>
		    		<option value="entreprise" <?php if($type_structure=='entreprise')echo 'selected';?>>Entreprise</option>
		    		<option value="association" <?php if($type_structure=='association')echo 'selected';?>>Association</option>
		    		<option value="collectivite" <?php if($type_structure=='collectivite')echo 'selected';?>>Collectivité</option>
					<option value="formation" <?php if($type_structure=='formation')echo 'selected';?>>Organisme de formation</option>
		    	</select>
		    	<div class="form__select__arrow"></div>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $nom_structure; ?>" name="nom_structure" id="nom_structure" data-validation="required">
		    	<label for="nom_structure">Nom de la structure<i class="i-required">*</i></label>
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
		    	<textarea class="js-input-effect input-effect--2" rows="6" name="descriptif_organisme" id="descriptif_organisme" data-validation="required" placeholder=""><?php echo $descriptif_organisme; ?></textarea>
		    	<label for="descriptif_organisme">Description de votre structure<i class="i-required">*</i></label>
		    	 <span class="focus-bg"></span>
		    </div>   
		</fieldset>

	    <fieldset>
    		<legend>Contact et candidatures</legend>	     

			<div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $nom_prenom_contact; ?>" name="nom_prenom_contact" id="nom_prenom_contact" data-validation="required">
		    	<label for="nom_prenom_contact">Nom et prénom du contact<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $fonction_contact; ?>" name="fonction_contact" id="fonction_contact" data-validation="required">
		    	<label for="fonction_contact">Fonction du contact<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

			<div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="text" value="<?php echo $contact_email; ?>" name="contact_email" id="contact_email" data-validation="email">
		    	<label for="contact_email">Email de contact<i class="i-required">*</i></label>
		    	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">
			    <input class="js-input-effect input-effect--2" type="text" maxlength="10" value="<?php echo $telephone; ?>" name="telephone" id="telephone" data-validation="number">
			    <label for="telephone">Téléphone de contact<i class="i-required">*</i></label>
			    <span class="focus-bg"></span>
		    </div>

			<div class="form__group">
		      	<label for="modalite_candidature">Modalité de candidature<i class="i-required">*</i></label>
		      	<label for="modalite_candidature_0" class="form__control form__control--checkbox">Par courrier
		        	<input type="checkbox" name="modalite_candidature[]" value="courrier" id="modalite_candidature_0" data-validation="checkbox_group" data-validation-qty="min1" <?php if(!empty($modalite_candidature) && in_array('courrier',$modalite_candidature))echo 'checked'; ?>>	        
		        	<div class="form__control__indicator"></div>
				</label>
		      	<label for="modalite_candidature_1" class="form__control form__control--checkbox">Par mail
		        	<input type="checkbox" name="modalite_candidature[]" value="mail" id="modalite_candidature_1" <?php if(!empty($modalite_candidature) && in_array('mail',$modalite_candidature))echo 'checked'; ?>>	        
		        	<div class="form__control__indicator"></div>
		        </label>
		    </div>		

		    <div class="form__row">
		      	<input class="js-input-effect input-effect--2" data-validation="date" data-validation-format="dd/mm/yyyy" type="text" value="<?php if($type_form == 'mod')echo $date_candidature->format('d/m/Y'); ?>" name="date_candidature" id="date_candidature">
		      	<label for="date_candidature">Date limite de candidature<i class="i-required">*</i></label>
		    </div>

		    <div class="form__row">
		    	<input class="js-input-effect input-effect--2" type="url" value="<?php echo $site_internet_structure; ?>" name="site_internet_structure" id="site_internet_structure">
		    	<label for="site_internet_structure">Votre site internet</label>
		    	<span class="focus-bg"></span>
		    </div>
	    </fieldset>

	    <input type="hidden" value="4796248892" name="toky_toky">
	    <input type="hidden" value="<?php echo $type_form; ?>" name="act">
	    <input type="hidden" value="<?php echo $the_idp; ?>" name="idp">
	    <?php wp_nonce_field( 'fluxi_manage_emploi', 'fluxi_manage_emploi_nonce_field' ); ?>

	    <div class="notify"></div>

		<div class="form__buttons">			
	   		<button type="submit" id="submit-manage-emploi" class="form__submit"><?php echo $type_form_name; ?></button>
	    </div>
	</form>

</div>


