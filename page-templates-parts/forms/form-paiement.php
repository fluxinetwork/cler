 <?php
/**
 * The template part for displaying the form "paiement Stripe" 
 */
?>
<form action="" method="POST" id="form-paiement" role="form" class="c-card__body">
	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Contact et facturation</legend>
		
		<div class="c-form__fieldset__row">
			<label for="name" class="c-form__label">Nom complet<span class="i-required">•</span></label>
	      	<input class="c-form__input" type="text" name="name" value="<?php echo $current_user->user_lastname .' '.$current_user->user_firstname; ?>" data-validation="required">
		</div>

		<div class="c-form__fieldset__row">
			<label for="email" class="c-form__label">Email de contact<span class="i-required">•</span></label>
		    <input class="c-form__input" type="email" name="email" value="<?php echo $current_user->user_email; ?>" data-validation="required">
		</div>

		<div class="c-form__fieldset__row">
			<label for="nom_structure" class="c-form__label">Nom de la structure<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $nom_structure; ?>" name="nom_structure" id="nom_structure" data-validation="required">
	    </div>

		<div class="c-form__fieldset__row">
			<label for="adresse" class="c-form__label">Adresse complète<span class="i-required">•</span></label>
	    	<input class="c-form__input" type="text" value="<?php echo $adresse; ?>" name="adresse" id="adresse" data-validation="required">
	    </div>

	    <div class="c-form__fieldset__row">
			<label for="telephone" class="c-form__label">Téléphone de contact<span class="i-required">•</span></label>
		    <input class="c-form__input" type="text" maxlength="14" value="<?php echo $telephone; ?>" name="telephone" id="telephone" data-validation="required">
	    </div>

	</fieldset>    

	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Vos informations de paiement</legend>
		
		<p class="c-valid c-form--indicateur">Vos informations de paiement ne sont pas conservées sur notre site.</p>
		<a href="https://stripe.com/fr" traget="_blank" class="c-link c-link--shy">Informations sur la plateforme de paiement</a>
		
		<div class="c-form__fieldset__flexrow c-form__fieldset__flexrow--asy2">
			<div class="c-form__fieldset__row">
				<label class="c-form__label">Numéro de carte<span class="i-required">•</span></label>
			    <input class="c-form__input" type="text" maxlength="16" size="18" data-stripe="number" value="" data-validation="required">
			</div>

			<div class="c-form__fieldset__row">
				<label class="c-form__label">Cryptogramme<span class="i-required">•</span></label>
			    <input class="c-form__input" type="text" maxlength="3" size="4" data-stripe="cvc" value="" data-validation="required">
			</div>	
		</div>
		
		<div class="c-form__fieldset__flexrow">
			<div class="c-form__fieldset__row">
				<label class="c-form__label">Mois d'expiration (MM)<span class="i-required">•</span></label>
			    <input class="c-form__input" type="text" maxlength="2" size="2" data-stripe="exp_month" value="" data-validation="required">
			</div>

			<div class="c-form__fieldset__row">
				<label class="c-form__label">Année d'expiration (YY)<span class="i-required">•</span></label>
			  	<input class="c-form__input" type="text" maxlength="2" size="2" data-stripe="exp_year" value="" data-validation="required">
			</div>		
		</div>
  	</fieldset>

    <input type="hidden" value="39733105819" name="toky_toky">
    <input type="hidden" value="<?php echo $security_tok; ?>" name="security_token">
    <input type="hidden" value="<?php echo $id_post_source; ?>" name="idp">
    <input type="hidden" value="<?php echo $id_recu; ?>" name="idr">	    

    <input type="hidden" value="<?php echo $amount_cent; ?>" name="amount">

    <?php wp_nonce_field( 'fluxi_manage_paiement', 'fluxi_manage_paiement_nonce_field' ); ?>
	
	<fieldset class="c-form__fieldset">
		<legend class="c-form__legend c-form--indicateur">Total à payer</legend>
		<h3 class="t-fw--700 mgTop--s c-txt"><?php echo number_format($amount, 2, ',', ' '); ?> €</h3>
	</fieldset>

	<div class="c-form__notify js-notify"></div>

  	<div class="c-form__submit">
  		<button type="submit" class="c-btn"><i class="fa fa-eur" aria-hidden="true"></i> Payer</button>
  	</div>
</form>