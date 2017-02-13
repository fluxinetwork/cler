<?php
/**
 * The template used for displaying user a message if registration or login is required
 */
?>

<div class="c-card__body t-align--c l-flexCol l-flex--jcc l-flex--aic pd--xl">
	<?php if( is_user_logged_in() ): ?>
		<a href="<?php echo home_url(); ?>/mon-profil/" class="c-btn">Mon profil</a>
	<?php else: ?>
		<a href="<?php echo home_url(); ?>" class="button">Accueil</a>
	<?php endif; ?>
	<p class="h3 font-subh">Vous n'avez pas la possibilité d'effectuer cette action. Contactez-nous si le problème persiste.</p>
</div>


