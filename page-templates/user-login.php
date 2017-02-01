<?php
/*
Template Name: Connexion utilisateur
*/
?>
<?php get_header(); ?>
<div id="popin" class="l-overlay bg-main bg-main--grad is-active">
		<div class="l-overlay__close">
			<a href="<?php bloginfo('url'); ?>" class="c-btn c-btn--close"></a>
		</div>

		<div class="l-overlay__content">
			<?php require_once( FU_PLUGIN_DIR . 'assets/inc/page-templates-parts/user-login.php' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
