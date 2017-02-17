<article>

	<div class="l-row bg-pattern-formateree">
		<header class="l-col l-col--content l-header">
			<h1><?php echo get_the_title(); ?></h1>
			<div class="c-meta l-header__meta">
				<div class="c-dash"></div>
				<?php
					echo '<span class="c-meta__meta"><i class="fa fa-graduation-cap c-meta__meta__icon" aria-hidden="true"></i>'.$nb_formations.' organismes de formation</span>';
				?>
			</div>
			<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
		</header>
	</div>
	
	<div class="l-row">
			<?php the_content(); ?>
	</div>

</article>


