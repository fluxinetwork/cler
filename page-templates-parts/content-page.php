<?php
/**
 * The template part for displaying the content
 */
?>

<article classe="page">

	<div class="l-row bg-light">
		<header class="l-col l-col--content l-intro">
			<h1><?php echo get_the_title(); ?></h1>
			<div class="c-meta l-intro__meta">
				<div class="c-dash"></div>
			</div>

			<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
		</header>
	</div>
	
	<div class="l-row">
		<div class="l-col l-col--content">
			<?php the_content(); ?>
		</div>
	</div>

</article>


