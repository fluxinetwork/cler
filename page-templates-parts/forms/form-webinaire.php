 <?php
/**
 * The template part for displaying the form "webinaire" (add)
 */
?>

<form id="form-participation-webinaire" role="form" class="c-card__body">
	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Inscription au webinaire</legend>

		<?php if( ! is_user_logged_in() ): ?>
			<div class="c-form__fieldset__row c-form--indicateur">
				<p> Pour remplir automatiquement le formulaire de participation : <a class="js-popin-show c-link c-link--shy" href="connexion">connectez-vous</a>.</p>
				<p class="is-none">Si vous n’être pas adhérent au CLER - Réseau pour la transition énergétique, contactez-nous directement : <strong>info@cler.org</strong>.</p>
			</div>		
		<?php endif; ?>	

		<div class="c-form__fieldset__row">
			<label class="c-form__label" for="nom">Nom<span class="i-required">•</span></label>	      
	      	<input type="text" class="c-form__input" placeholder="" value="<?php echo $user_lastname; ?>" name="nom" id="nom" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
	    	<label class="c-form__label" for="prenom">Prénom<span class="i-required">•</span></label>	      
	      	<input type="text" class="c-form__input" placeholder="" value="<?php echo $user_firstname; ?>" name="prenom" id="prenom" data-validation="required">	      	
	    </div>

		<div class="c-form__fieldset__row">
	      	<label class="c-form__label" for="email">Email<span class="i-required">•</span></label>
	      	<input type="text" class="c-form__input" placeholder="" value="<?php echo $user_email; ?>" name="email" id="email" data-validation="email">
	    </div>

		 <div class="c-form__fieldset__row">
			<label class="c-form__label" for="nombre_participants">Nombre de participants<span class="i-required">•</span></label>
			<input type="text" class="c-form__input" name="nombre_participants" id="nombre_participants" data-validation="number" value="">
		</div>

		<div class="c-form__fieldset__row">							 
			<label for="adherent_cler" class="c-form__label c-form__label--checkbox" >
				<input class="c-form__label__checkbox" type="checkbox" name="adherent_cler" id="adherent_cler" value="1" <?php if($adherent_cler=='1')echo 'checked'; ?>>
				<div class="c-form__label__txt">Etes-vous adhérent au CLER ?</div>			
			</label>							 
	    </div>		   

		<div class="js-nom-structure" style="display:none">
			<div class="c-form__fieldset__row">
				<label class="c-form__label" for="nom_structure">Nom de la structure<span class="i-required">•</span></label>		   		
		    	<input type="text" class="c-form__input" name="nom_structure" id="nom_structure" value="<?php echo $nom_structure; ?>" placeholder="" data-validation="required" data-validation-depends-on="adherent_cler">		    	
		    </div>
	    </div>
    </fieldset>		   	    

    <input type="hidden" value="3548597123" name="toky_toky">
    <input type="hidden" value="<?php echo get_the_ID(); ?>" name="idp">
    <input type="hidden" value="<?php echo get_field('date_webinaire'); ?>" name="date">
    <input type="hidden" value="<?php echo get_field('heure_webinaire'); ?>" name="heure">
    <?php wp_nonce_field( 'fluxi_participation_webinaire', 'fluxi_participation_webinaire_nonce_field' ); ?>

    <div class="c-form__notify js-notify"></div>

	<div class="c-form__submit">
    	<button type="submit" id="submit-participation-webinaire" class="c-btn"><i class="fa fa-plus" aria-hidden="true"></i> Envoyer</button>
    </div>
</form>	 	  
	    
