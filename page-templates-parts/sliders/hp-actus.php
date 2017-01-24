<div class="l-card-slider js-slider">
	<aside class="l-card-slider__aside">
		<div class="l-card-slider__aside__title">
			<span class="c-section-title">L'actualité de la transition</span>
		</div>

		<div class="l-card-slider__aside__link">
			<a href="#" class="c-link">Voir tout</a>
		</div>

		<?php get_template_part( 'page-templates-parts/sliders/follow' ); ?>
	</aside>

	<div class="l-card-slider__cards">
		<ul class="l-card-slider__cards__row">
			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => SLIDER_NB_POSTS
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();

					get_template_part( 'page-templates-parts/sliders/actu' );

				endwhile;
			endif;
			wp_reset_postdata();
			?>
			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="#" class="cockpit-add">
					<span class="c-link c-link--white">voir tout</span>
				</a>
			</li>
		</ul>
	</div>

	<?php get_template_part( 'page-templates-parts/sliders/controls' ); ?>
</div>