<?php
/*
Template Name: Thématiques		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col thematique">
		<div class="thematique__content">
			<div class="thematique__content__txt">
				<h1 class="l-hero__title"><?php echo get_the_title(); ?></h1>
				<h2 class="l-hero__subtitle"><?php echo get_field('fluxi_resum', false, false); ?></h2>
			</div>
		
			<div class="thematique__content__extra">
				<div class="l-box thematique__content__extra__notions">
					<span class="t-meta">Notions clés</span>
					<p class="h5 mgTop--xs">justice, endettement, formation, respiration asynchrone, curcuma, service social.</p>
				</div>

				<div class="l-box thematique__content__extra__chiffre">
					<span class="t-meta">Chiffre clé</span>
					<p class="h5 mgTop--xs">La loi de transition énergétique fixe pour objectif une baisse de 20 % de la consommation d'énergie d'ici à 2030 (par rapport à 2012).</p>
				</div>
			</div>
		</div>

		<div class="thematique__aside">
			<?php include(TEMPLATEPATH.'/app/inc/proto/card-contact.php'); ?>
		</div>
	</div>
</section>

<section class="l-row bg-main bg-main--grad">
	<div class="l-col">
		<?php include(TEMPLATEPATH.'/app/inc/proto/card-slider.php'); ?>
	</div>
</section>

<section class="l-row">
	<div class="l-col t-align--c">
		<h2 class="c-section-title">Liens utiles</h2>
		<a href="#" class="c-link">Le C.A</a>
		<a href="#" class="c-link">L'équipe'</a>
		<a href="#" class="c-link">Le réseau</a>
	</div>
</section>

<?php get_footer(); ?>

