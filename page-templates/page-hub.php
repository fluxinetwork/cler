<?php
/*
Template Name: Hub		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<header class="l-col l-col--content l-header">
		<h1><?php echo get_the_title(); ?></h1>
		<h2 class="l-header__excerpt"><?php echo get_field('fluxi_resum', false, false); ?></h2>
	</header>
</section>

<section class="l-row bg-main bg-main--grad">
	<div class="l-col"> 
		<?php get_template_part( 'page-templates-parts/sliders/hub','actus' ); ?>
	</div>
</section>

<section class="l-row">
	<div class="l-col l-col--content">
		<?php the_content(); ?>
	</div>
</section>

<?php get_footer(); ?>

