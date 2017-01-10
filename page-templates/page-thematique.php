<?php
/*
Template Name: Thématiques		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col l-grid l-hub-header">
		<div class="l-grid__col l-hub-header__main">
			<h1 class="l-hero__title"><?php echo get_the_title(); ?></h1>
			<h2 class="l-hero__subtitle"><?php echo get_field('fluxi_resum', false, false); ?></h2>
		</div>

		<div class="l-grid__col l-hub-header__meta">
			<div class="l-hub-header__meta__top l-box">
				<span class="t-meta">Notions clés</span>
				<p class="h5 mgTop--xs">justice, endettement, formation, respiration asynchrone, curcuma,
service social.</p>
			</div>
			<div class="l-hub-header__meta__bottom l-box">
				<span class="t-meta">Chiffre clé</span>
				<p class="h5 mgTop--xs">La loi de transition énergétique fixe pour objectif une baisse de 20 % de la consommation d'énergie d'ici à 2030 (par rapport à 2012).</p>
			</div>
		</div>

		<div class="l-grid__col l-hub-header__contact">
			<?php include(TEMPLATEPATH.'/app/inc/proto/card-contact.php'); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>

