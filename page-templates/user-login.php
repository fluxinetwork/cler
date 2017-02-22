<?php
/*
Template Name: Connexion utilisateur
*/
?>
<?php get_header(); ?>

<?php if( !is_user_logged_in() ): ?>

	<section class="l-row bg-light">
		<div class="l-col">
			<?php get_template_part( 'page-templates-parts/user/user', 'login' ); ?>
		</div>
	</section>

<?php else : ?>
	
	<article class="l-row">
		<header class="l-col l-col--content">
			<h1>Vous êtes déjà connecté.</h1>
			<a href="<?php echo home_url(); ?>/mon-profil" class="c-btn c-btn--cta mgTop--m"><span><i class="fa fa-user"></i>Voir profil</span></a>
			<a href="<?php echo home_url(); ?>" class="c-btn c-btn--ghost mgTop--m mgLeft--m"><span><i class="fa fa-home"></i>Retour accueil</span></a>
		</header>
	</article>

<?php endif; ?>

<?php get_footer(); ?>
