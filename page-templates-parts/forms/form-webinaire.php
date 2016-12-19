 <?php
/**
 * The template part for displaying the form "webinaire" (add)
 */
?>
<div class="form">
	<form id="form-participation-webinaire" role="form">
		<fieldset>
			<legend>Inscription au webinaire</legend>
			<div class="form__row">	      
		      	<input type="text" class="js-input-effect input-effect--2" placeholder="" value="<?php echo $user_lastname; ?>" name="nom" id="nom" data-validation="required">
		      	<label for="nom">Nom<i class="i-required">*</i></label>
		      	<span class="focus-bg"></span>
		    </div>

		    <div class="form__row">	      
		      	<input type="text" class="js-input-effect input-effect--2" placeholder="" value="<?php echo $user_firstname; ?>" name="prenom" id="prenom" data-validation="required">
		      	<label for="prenom">Prénom<i class="i-required">*</i></label>
		      	<span class="focus-bg"></span>
		    </div>

			<div class="form__row">	      
		      	<input type="text" class="js-input-effect input-effect--2" placeholder="" value="<?php echo $user_email; ?>" name="email" id="email" data-validation="email">
		      	<label for="email">Email<i class="i-required">*</i></label>
		      	<span class="focus-bg"></span>
		    </div>

			 <div class="form__row">			
				<input type="text" class="js-input-effect input-effect--2" name="nombre_participants" id="nombre_participants" data-validation="number" value="">
				<label for="nombre_participants">Nombre de participants<i class="i-required">*</i></label>
				<span class="focus-bg"></span>
			</div>

			<div class="form__group">
				<label>Si vous n’être pas adhérent au CLER - Réseau pour la transition énergétique, contactez-nous directement : <strong>info@cler.org</strong>.</label>							 
				<label for="adherent_cler" class="form__control form__control--checkbox" >Etes-vous adhérent au CLER ?<i class="i-required">*</i>
					<input type="checkbox" name="adherent_cler" id="adherent_cler" value="1" <?php if($adherent_cler=='1')echo 'checked'; ?>>
					<div class="form__control__indicator"></div>
				</label>							 
		    </div>		   

			<div class="hide js-nom-structure">
				<div class="form__row">		   		
			    	<input type="text" class="js-input-effect input-effect--2" name="nom_structure" id="nom_structure" value="<?php echo $nom_structure; ?>" placeholder="" data-validation="required" data-validation-depends-on="adherent_cler">
			    	<label for="nom_structure">Nom de la structure<i class="i-required">*</i></label>
			    	<span class="focus-bg"></span>
			    </div>
		    </div>
	    </fieldset>		   	    

	    <input type="hidden" value="3548597123" name="toky_toky">
	    <input type="hidden" value="<?php echo get_the_ID(); ?>" name="idp">
	    <input type="hidden" value="<?php echo get_field('date_webinaire'); ?>" name="date">
	    <input type="hidden" value="<?php echo get_field('heure_webinaire'); ?>" name="heure">
	    <?php wp_nonce_field( 'fluxi_participation_webinaire', 'fluxi_participation_webinaire_nonce_field' ); ?>

	    <div class="notify"></div>

		<div class="form__buttons">
	    	<button type="submit" id="submit-participation-webinaire" class="form__submit">Envoyer</button>
	    </div>
	</form>	 	  
	    
</div> 