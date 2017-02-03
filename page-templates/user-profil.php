<?php
/*
Template Name: Profil
*/
?>
<?php get_header(); ?>

<?php
	if( is_user_logged_in() ):

	global $current_user;
	$current_user = wp_get_current_user();
	$fullname = $current_user->user_firstname.' '.$current_user->user_lastname;
	$email = $current_user->user_email;
	(is_adherent_cler()) ? $adherent = true : $adherent = false;
?>
<section class="l-row bg-light">
	<div class="l-col no-pdBottom">
		<div class="l-cockpit">
			<div class="l-cockpit__infos l-box">
				<header class="l-cockpit__infos__header">
					<div>
						<span class="t-meta u-show@large">
						<?php ($adherent) ? print('Adhérent') : print('Utilisateur'); ?>
						</span>
						<h1 class="c-section-title">Mes informations</h1>
					</div>
					<a href="<?php echo get_the_permalink(FORM_PROFIL); ?>" class="c-link">Modifier</a>
				</header>

				<div class="l-cockpit__infos__body l-grid">
					
					<div class="l-grid__col l-center">
						<div class="l-grid__col__content l-center pd--s">
							<p class="t-fw--700"><?php echo $fullname; ?></p>
						</div>
					</div>
					<div class="l-grid__col l-center">
						<div class="l-grid__col__content l-center pd--s">
							<p class="t-break"><?php echo $email ?></p>
						</div>
					</div>
				</div>

				<footer class="l-cockpit__infos__footer">
					<a href="<?php echo get_the_permalink(FORM_PROFIL); ?>?tf=mdp" class="c-link c-link--more">Modifier mot de passe</a>
				</footer>
			</div>

			<aside class="l-cockpit__aside u-show@large">
				<?php include(TEMPLATEPATH.'/page-templates-parts/card-contact.php'); ?>
			</aside>
		</div>
		
		<div class="l-col l-col--med l-grid l-center">
		<?php if ($adherent) : ?>

			<div class="l-grid__col l-center">
				<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=mod" class="c-link">Modifier votre adhésion</a>
			</div>
			<div class="l-grid__col l-center">
				<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=rad" class="c-btn c-btn--cta"><div>Renouveler votre adhésion</div></a>
			</div>

		<?php else : ?>

			<a href="<?php echo get_the_permalink(FORM_ADHESION); ?>?act=add" class="c-btn c-btn--cta"><div>Devenir adhérent</div></a>

		<?php endif; ?>
		</div>
	</div>
</section>


<section class="l-row bg-accent bg-accent--grad">
	<div class="l-col">

		<?php include(TEMPLATEPATH.'/app/inc/proto/publications-slider.php'); ?>

	</div>
</section>


<section class="l-row bg-white">
	<div class="l-col">
		<h2 class="c-section-title">Publier un contenu</h2>

		<ul class="l-grid list-reset">
			<li class="l-grid__col">
				<div class="c-tile c-tile--square c-tile--noBdr c-tile--bg">
					<div class="c-tile__content">
						<div class="c-tile__content__img"></div>
						<a href="<?php echo get_the_permalink(FORM_OFFRE); ?>?act=add" class="c-link">Offre d'emploi</a>
						<span class="t-meta pdTop--s"><?php ($adherent) ? print('Gratuit') : print('Payant'); ?></span>
					</div>
				</div>
			</li>
			<li class="l-grid__col">
				<div class="c-tile c-tile--square c-tile--noBdr c-tile--bg">
					<div class="c-tile__content">
						<div class="c-tile__content__img"></div>
						<a href="<?php echo get_the_permalink(FORM_EVENT); ?>?act=add" class="c-link">Évènement</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</div>
			</li>
			<li class="l-grid__col">
				<div class="c-tile c-tile--square c-tile--noBdr c-tile--bg">
					<div class="c-tile__content">
						<div class="c-tile__content__img"></div>
						<a href="<?php echo get_the_permalink(FORM_FORMATION); ?>?act=add" class="c-link">Formation</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</div>
			</li>
		</ul>
	</div>
</section>

<?php else : ?>

<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--popin c-card">
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

<?php get_footer(); ?>
