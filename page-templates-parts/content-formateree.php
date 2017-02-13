<?php
/**
 * The template part for displaying the content
 */
?>

<article classe="page formateree">

	<div class="l-row bg-pattern-formateree">
		<header class="l-col l-col--content l-header">
			<h1><?php echo get_the_title(); ?></h1>
			<div class="c-meta l-header__meta">
				<div class="c-dash"></div>
			</div>
			<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
		</header>
	</div>
	
	<div class="l-row">
			<?php the_content(); ?>
	</div>

</article>


