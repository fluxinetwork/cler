<?php if( !is_user_logged_in() ): ?>

<div class="c-form c-form--popin c-card">
	<div class="c-card__header">
		<h1 class="c-card__header__title">Connexion<br><span>au compte utilisateur</span></h1>
	</div>

	<form id="form-login" role="form" class="c-card__body">
		<fieldset class="c-form__fieldset">
			<legend class="is-none">Connectez-vous</legend>

		    <div>		
		    	<label for="identifiant" class="c-form__label">Identifiant<span class="i-required">•</span></label>
		    	<input type="text" class="c-form__input" name="identifiant" value="" placeholder="Votre email">
		    </div>

		    <div class="c-form__fieldset__row">		
		    	<label for="password" class="c-form__label">Mot de passe<span class="i-required">•</span></label>
		    	<input type="password" class="c-form__input" name="password" id="password" value="" placeholder="•••••••">
			</div>				

		 	<?php wp_nonce_field( 'fluxi_login_user', 'fluxi_login_user_nonce_field' ); ?>

		    <div class="c-form__notify js-notify">
		    	<?php
		    		if( isset($_GET['login']) && !empty($_GET['login']) && $_GET['login'] == 'requis' ):
		    			echo '<span class="error">Connectez-vous pour accéder à cette page.</span>';
		    		endif;
		    	?>
		    </div>
			
			<div class="c-form__submit">
			    <button type="submit" id="submit-login" class="c-btn">Connexion</button>
			    <a class="c-link c-link--shy t-align--r" href="<?php echo get_the_permalink(RESET_PASSWORD); ?>">Mot de passe oublié ?</a>
		    </div>

		</fieldset>
	</form>			
	
	<footer class="c-card__footer">
		<a href="<?php echo get_the_permalink(CREER_USER); ?>" class="c-link c-link--more">Créer un compte</a>
	</footer>
</div>

<?php else : ?>

	<section class="l-row bg-light">
		<div class="l-col">
			<div class="c-form c-form--large c-card">
				<div class="c-card__header">
					<h1 class="c-card__header__title">Pas si vite !</h1>
				</div>
				<?php get_template_part( 'page-templates-parts/message', 'need-login' ); ?>
				<footer class="c-card__footer">
					<a href="<?php echo get_the_permalink(CONTACT); ?>" class="c-link c-link--more">Contactez-nous</a>
				</footer>
			</div>
		</div>
	</section>
	
<?php endif; ?>

