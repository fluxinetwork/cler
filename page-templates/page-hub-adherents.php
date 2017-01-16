<?php
/*
Template Name: Hub adhérents		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col adherents">
		<div class="adherents__main">
			<h1 class="l-hero__title">espace adhérents</h1>
			<h2 class="l-hero__subtitle">For many of us, our very first experience of learning about the celestial bodies begins when we saw our first full moon in the sky. It is truly a magnificent view even to the naked eye.</h2>

			<div class="adherents__main__links">
				<div class="h3 t-fw--700 mgBottom--s">Vous cherchez quelqu'un ?</div>
				<a href="#" class="c-link">Le C.A</a>
				<a href="#" class="c-link">L'équipe'</a>
				<a href="#" class="c-link">Le réseau</a>
			</div>
		</div>
		
		<div class="adherents__aside">
			<div class="adherents__aside__contact">
				<?php include(TEMPLATEPATH.'/app/inc/proto/card-contact.php'); ?>
			</div>

			<div class="adherents__aside__events">
				<?php include(TEMPLATEPATH.'/app/inc/proto/card-contact.php'); ?>
			</div>
		</div>
	</div>
</section>

<section class="l-row bg-main bg-main--grad">
	<div class="l-col">
		<?php include(TEMPLATEPATH.'/app/inc/proto/card-slider.php'); ?>
	</div>
</section>

<?php get_footer(); ?>

