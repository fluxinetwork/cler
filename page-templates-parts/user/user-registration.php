<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--popin c-card">
			<div class="c-card__header">
				<h1 class="c-card__header__title">Création<br><span>de compte utilisateur</span></h1>
			</div>

			<form id="form-registration" role="form" class="c-card__body">
				<fieldset class="c-form__fieldset">
					<legend class="is-none">Vos informations</legend>
					
				   	<div>	
				    	<label for="nom" class="c-form__label">Nom<span class="i-required">•</span></label>
				    	<input type="text" class="c-form__input" name="nom" id="nom" value="" placeholder="" data-validation="required" data-validation-error-msg-required="Vous devez entrer un nom.">
				    </div>

				   	<div class="c-form__fieldset__row">	
				    	<label for="prenom" class="c-form__label">Prénom<span class="i-required">•</span></label>
				    	<input type="text" class="c-form__input" name="prenom" id="prenom" value="" placeholder="" data-validation="required" data-validation-error-msg-required="Vous devez entrer un prénom.">
				    </div>

				   	<div class="c-form__fieldset__row">	
				    	<label for="email" class="c-form__label">Email<span class="i-required">•</span></label>
				    	<input type="text" class="c-form__input" name="email" id="email" value="" data-validation="email" placeholder="">
				    </div>

				    <div class="c-form__fieldset__row">	
				    	<label for="password" class="c-form__label">Mot de passe<span class="i-required">•</span></label>
				    	<input type="text" class="c-form__input" name="password" id="password" value="" rel="gp" data-validation="required" data-character-set="a-z,A-Z,0-9,#" data-size="18" placeholder="">
				    	<button class="js-generate-password c-link c-link--shy mgTop--s" type="button">Générer un password</button>
				    </div>	

				    <div class="c-form__notify js-notify"></div>
					
					<div class="c-form__submit">
					    <button type="submit" id="submit-registration" class="c-btn">Enregistrement</button>
				    </div>

				</fieldset>

				<input type="hidden" value="9274565543" name="toky_toky">
	 			<?php wp_nonce_field( 'fluxi_new_user', 'fluxi_new_user_nonce_field' ); ?>
			</form>			
		</div>
	</div>
</section>