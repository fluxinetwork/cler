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
			<?php get_template_part( 'page-templates-parts/user/user', 'login' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
