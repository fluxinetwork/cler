<div class="l-card-slider">
	<aside class="l-card-slider__aside">
		<div class="l-card-slider__aside__title">
			<?php 
			$categories = get_the_category();
			$cat_slug = $categories[0]->slug;
			$cat_id = $categories[0]->cat_ID;

			echo '<span class="c-section-title">L\'actualité<br> <span class="t-fw--400 h5 u-show@large">#'.$cat_slug.'</span></span>';
			?>
		</div>

		<div class="l-card-slider__aside__link">
			<a href="<?php the_permalink(ALL_NEWS); ?>?cat=<?php echo $cat_slug?>" class="c-link">Voir tout</a>
		</div>

		<?php get_template_part( 'page-templates-parts/sliders/follow' ); ?>
	</aside>

	<div class="l-card-slider__cards">
		<ul class="l-card-slider__cards__row">
			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => SLIDER_NB_POSTS,
				'cat' => $cat_id
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
				<a href="<?php the_permalink(ALL_NEWS); ?>?cat=<?php echo $cat_slug?>" class="cockpit-add">
					<span class="c-link c-link--white">voir tout</span>
				</a>
			</li>
		</ul>
	</div>
	
	<?php get_template_part( 'page-templates-parts/sliders/controls' ); ?>
</div>