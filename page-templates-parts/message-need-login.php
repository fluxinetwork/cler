<?php
/**
 * The template used for displaying user a message if registration or login is required
 */
?>

<div class="c-card__body c-card__body--need">
	<a href="<?php echo home_url(); ?>/creation-utilisateur/" class="c-btn"><i class="fa fa-user-plus"></i>Créez un compte</a>
	<div class="c-section-title h4 mg--m">ou</div>
	<a href="connexion" class="js-popin-show c-btn c-btn--ghost"><i class="fa fa-sign-in"></i>Connectez-vous</a>
	<p class="h3 font-subh">pour accéder à ce service.</p>
</div>

