<?php
/*
Template Name: Hub adhérents		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col l-grid l-hub-header">
		<div class="l-grid__col l-hub-header__main">
			<h1 class="l-hero__title">espace adhérents</h1>
			<h2 class="l-hero__subtitle">For many of us, our very first experience of learning about the celestial bodies begins when we saw our first full moon in the sky. It is truly a magnificent view even to the naked eye.</h2>

			<div class="l-hub-header__main__more">
				<div class="h3 t-fw--700 mgBottom--s">Vous cherchez quelqu'un ?</div>
				<a href="#" class="c-link mgRight--xs">Le C.A</a>
				<a href="#" class="c-link mgRight--xs">L'équipe'</a>
				<a href="#" class="c-link mgRight--xs">Le réseau</a>
			</div>
		</div>

		<div class="l-grid__col l-hub-header__contact">
			<?php include(TEMPLATEPATH.'/app/inc/proto/card-contact.php'); ?>
		</div>

		<div class="l-grid__col l-hub-header__events">
			<p>Test</p>
		</div>
	</div>
</section>

<?php get_footer(); ?>

