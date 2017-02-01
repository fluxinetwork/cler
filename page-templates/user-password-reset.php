<?php
/*
Template Name: Récupération de password
*/
?>
<?php get_header(); ?>

<article>

	<header>
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>

 	<!-- Password reset-->	

	<div class="form">
		<form id="form-password-reset" role="form">
			<fieldset>
				<legend>Réinitialiser votre password</legend>
				<p class="form__detail">Veuillez entrer votre adresse email ci-dessous pour recevoir un message contenant un nouveau password.</p>
				<div class="form__row">	    	
					<input type="text" class="js-input-effect input-effect--2" name="email" id="email" value="<?php if( is_user_logged_in() ){ echo $current_user->user_email; } ?>" placeholder="" data-validation="email">
					<label for="email">Votre email<i class="i-required">*</i></label>
					<span class="focus-bg"></span>
				</div>				
			 </fieldset>

			<input type="hidden" value="4279361540" name="toky_toky">
			<?php wp_nonce_field( 'fluxi_password_reset_user', 'fluxi_password_reset_user_nonce_field' ); ?>

			<div class="notify"></div>

			<div class="form__buttons">
				<button type="submit" id="submit-password-reset" class="form__submit">Envoyer</button>
			</div>
		</form>
	</div>

</article>

<?php get_footer(); ?>
