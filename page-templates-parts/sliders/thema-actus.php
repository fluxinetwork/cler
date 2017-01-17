<div class="l-card-slider">
	<aside class="l-card-slider__aside">
		<div class="l-card-slider__aside__title">
			<?php 
			$categories = get_the_category();
			$cat_slug = $categories[0]->slug;
			$cat_id = $categories[0]->cat_ID;

			echo '<span class="c-section-title">L\'actualité<br> <span class="t-fw--400 h5">#'.$cat_slug.'</span></span>';
			?>
		</div>
		<div class="l-card-slider__aside__link">
			<a href="#" class="c-link">Voir tout</a>
		</div>
	</aside>

	<div class="l-card-slider__cards">
		<ul class="l-card-slider__cards__row">
			<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 6,
				'cat' => $cat_id
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();

					$post_img_id = get_post_thumbnail_id();
					$post_img_array = wp_get_attachment_image_src($post_img_id, 'full', true);
					$post_img_url = $post_img_array[0];	

					$permalink = get_permalink();
					$date = get_the_date('d M Y');
					$title = get_the_title();

					$output = '<li class="l-card-slider__cards__row__col">';
					$output .= '<a href="'.$permalink.'">';
					$output .= '<article class="c-card c-card--emploi">';
					$output .= '<header class="c-card__header" style="background-image: url('.$post_img_url.');"></header>';
					$output .= '<div class="c-card__body">';
					$output .= '<span class="t-meta">'.$date.'</span>';
					$output .= '<h1 class="c-card__body__title">'.$title.'</h1>';
					$output .= '</div>';
					$output .= '<footer class="c-card__footer">';
					$output .= '<span class="c-link c-link--more">Lire la suite</span>';
					$output .= '</footer>';
					$output .= '</article>';
					$output .= '</a>';
					$output .= '</li>';

					echo $output;

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

	<div class="l-card-slider__controls">
		<button class="c-btnArrow"></button>
		<button class="c-btnArrow c-btnArrow--right"></button>
	</div>
</div>