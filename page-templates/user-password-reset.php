<?php
/*
Template Name: Récupération de password
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--popin c-card">
			<div class="c-card__header">
				<h1 class="c-card__header__title">Réinitialiser<br><span>votre mot de passe</span></h1>
			</div>

			<form id="form-password-reset" role="form" role="form" class="c-card__body">
				<fieldset class="c-form__fieldset">
					<legend class="is-none">Réinitialiser votre mot de passe</legend>

					<div class="c-form__fieldset__row">
						<label for="email" class="c-form__label">Email de votre compte utilisateur<i class="i-required">*</i></label>	    	
						<input type="text" class="c-form__input" name="email" id="email" value="<?php if( is_user_logged_in() ){ echo $current_user->user_email; } ?>" placeholder="" data-validation="email">					
					</div>	

					<div class="c-form__notify js-notify"></div>

					<div class="c-form__submit">
						<button type="submit" id="submit-password-reset" class="c-btn">Envoyer</button>
					</div>

				</fieldset>

				<input type="hidden" value="4279361540" name="toky_toky">
				<?php wp_nonce_field( 'fluxi_password_reset_user', 'fluxi_password_reset_user_nonce_field' ); ?>

			</form>

		</div>
	</div>
</section>

<?php get_footer(); ?>
