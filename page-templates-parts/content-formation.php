<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-header">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="t-meta l-header__date"><?php echo get_the_date(); ?></time> 
			<h1><?php echo get_the_title(); ?></h1>

			<div class="c-meta l-header__meta">
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