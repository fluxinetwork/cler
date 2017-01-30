<?php
/*
Template Name: Profil
*/
?>
<?php get_header(); ?>

<?php
	global $current_user;
	$current_user = wp_get_current_user();
	$nom = $current_user->user_firstname.' '.$current_user->user_lastname;
?>

<section class="l-row bg-light">
	<div class="l-col">
		<div class="l-cockpit">
			<div class="l-cockpit__infos l-box">
				<header class="l-cockpit__infos__header">
					<div>
						<span class="t-meta u-show@large">Adhérent</span>
						<h1 class="c-section-title"><?php echo $nom; ?></h1>
					</div>
					<a href="#" class="c-btn">Modifier</a>
				</header>
				<div class="l-cockpit__infos__body l-grid">
					<div class="l-grid__col">
						<div class="c-tile c-tile--noBdr c-tile--bg">
							<div class="c-tile__content"></div>
						</div>
					</div>
					<div class="l-grid__col"></div>
					<div class="l-grid__col"></div>
				</div>
				<footer class="l-cockpit__infos__footer">
					<a href="#" class="c-link c-link--more">Modifier mot de passe</a>
				</footer>
			</div>
			<aside class="l-cockpit__aside">
				<a href="#"><?php include(TEMPLATEPATH.'/app/inc/proto/card-contact.php'); ?></a>
			</aside>
		</div>
	</div>
</section>

<section class="l-row bg-accent bg-accent--grad">
	<div class="l-col">
		<?php include(TEMPLATEPATH.'/app/inc/proto/publications-slider.php'); ?>
	</div>
</section>

<section class="l-row">
	<div class="l-col">
		<h2 class="c-section-title">Publier un contenu</h2>

		<ul class="l-grid list-reset">
			<li class="l-grid__col">
				<div class="c-tile c-tile--square c-tile--noBdr c-tile--bg">
					<div class="c-tile__content">
						<div class="c-tile__content__img"></div>
						<a href="https://cler.org/dev-cler/outils/publiez-vos-offres-demploi/" class="c-link">Offre d'emploi</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</div>
			</li>
			<li class="l-grid__col">
				<div class="c-tile c-tile--square c-tile--noBdr c-tile--bg">
					<div class="c-tile__content">
						<div class="c-tile__content__img"></div>
						<a href="https://cler.org/dev-cler/mon-profil/gerer-evenement/?act=add" class="c-link">Évènement</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</div>
			</li>
			<li class="l-grid__col">
				<div class="c-tile c-tile--square c-tile--noBdr c-tile--bg">
					<div class="c-tile__content">
						<div class="c-tile__content__img"></div>
						<a href="https://cler.org/dev-cler/mon-profil/gerer-formations/?act=add" class="c-link">Formation</a>
						<span class="t-meta pdTop--s">Gratuit</span>
					</div>
				</div>
			</li>
		</ul>
	</div>
</section>

<?php get_footer(); ?>

