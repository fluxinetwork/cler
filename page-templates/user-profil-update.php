<?php
/*
Template Name: Modifier compte utilisateur
*/
?>
<?php
	get_header();
	
	if(!empty($_GET['tf'])):
		$type_form = filter_var( $_GET['tf'], FILTER_SANITIZE_STRING);
	else:
		$type_form = 'all';
	endif;
?>

<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--popin c-card">
		<?php
		if( is_user_logged_in() ):

			if($type_form == 'mdp'):?>

	 			<!-- Password -->

				<div class="c-card__header">
					<h1 class="c-card__header__title">Modification<br><span>du mot de passe</span></h1>
				</div>

				<form id="form-update-password" role="form" class="c-card__body">
					<fieldset class="c-form__fieldset">
						<p>Votre mot de passe doit contenir au moins 8 caractères.</p>
					    <div class="c-form__fieldset__row">
							<label class="c-form__label" for="password">Mot de passe<span class="i-required">•</span></label>
					    	<input type="text" class="c-form__input" name="password" id="password" value="" rel="gp" placeholder="•••••" data-validation="required length" data-character-set="a-z,A-Z,0-9,#" data-size="12" data-validation-length="min8" data-validation-error-msg-required="Vous devez entrer un password">
					    	<button class="js-generate-password c-link c-link--shy mgTop--s" type="button">Générer un mot de passe</button>
					    </div>
					</fieldset>

					<input type="hidden" value="685349752" name="toky_toky">
					<?php wp_nonce_field( 'fluxi_password_user', 'fluxi_password_user_nonce_field' ); ?>

					<div class="c-form__notify js-notify"></div>

						<div class="c-form__submit">
						<button type="submit" id="submit-password-profil" class="c-btn">Modifier</button>
					</div>
				</form>

			<?php else: ?>

				<!-- Profil infos -->
				<div class="c-card__header">
					<h1 class="c-card__header__title">Modification<br><span>de vos informations</span></h1>
				</div>

				<form id="form-update-profil" role="form" class="c-card__body">
				 	<fieldset class="c-form__fieldset">
					    <div>
					    	<label class="c-form__label" for="nom">Votre nom<span class="i-required">•</span></label>
					    	<input type="text" class="c-form__input" name="nom" id="nom" value="<?php echo $current_user->user_lastname; ?>" placeholder="" data-validation="required" data-validation-error-msg-required="Vous devez entrer un nom.">
					    </div>

					    <div class="c-form__fieldset__row">
					    	<label class="c-form__label" for="prenom">Votre prénom<span class="i-required">•</span></label>
					    	<input type="text" class="c-form__input" name="prenom" id="prenom" value="<?php echo $current_user->user_firstname; ?>" placeholder="" data-validation="required" data-validation-error-msg-required="Vous devez entrer un prénom.">
					    </div>

					    <div class="c-form__fieldset__row">
					    	<label class="c-form__label" for="email">Votre email<span class="i-required">•</span></label>
					    	<input type="text" class="c-form__input" name="email" id="email" value="<?php echo $current_user->user_email; ?>" placeholder="" data-validation="email">
					    </div>
				 	</fieldset>

				 	<input type="hidden" value="3476954852" name="toky_toky">
				 	<?php wp_nonce_field( 'fluxi_update_user', 'fluxi_update_user_nonce_field' ); ?>

				    <div class="c-form__notify js-notify"></div>

				    	<div class="c-form__submit">
				    	<button type="submit" id="submit-password-profil" class="c-btn">Modifier</button>
				    </div>
				</form>
		
		<?php endif;
			
		else:

			get_template_part( 'page-templates-parts/message', 'need-login' );

		 endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
