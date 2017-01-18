<div class="l-card-slider">
	<aside class="l-card-slider__aside">
		<div class="l-card-slider__aside__title">
			<?php 
			$categories = get_the_category();
			$cat_id = $categories[0]->cat_ID;

			echo '<span class="c-section-title">Les offres d\'emploi</span>';
			?>
		</div>
		<div class="l-card-slider__aside__link">
			<a href="#" class="c-link">Voir tout</a>
		</div>
		<div class="l-card-slider__aside__more">
			<a href="#" class="c-link c-link--white">Postez votre offre</a>
		</div>
	</aside>

	<div class="l-card-slider__cards">
		<ul class="l-card-slider__cards__row">
			<?php
			$args = array(
				'post_type' => 'offres-emploi',
				'posts_per_page' => 6
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();

					get_template_part( 'page-templates-parts/sliders/offre' );

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