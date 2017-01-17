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

					$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
					$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

					$ob_departement = get_field_object('field_574dab093c7b0');
					$label_departement = $ob_departement['choices'][ get_field('departement') ];

					$cat = get_the_category();
					$cat = $cat[0]->name;

					$permalink = get_permalink();
					$date = get_the_date('d M Y');
					$title = get_the_title();

					$output = '<li class="l-card-slider__cards__row__col">';
					$output .= '<a href="'.$permalink.'">';
					$output .= '<article class="c-card c-card--emploi">';
					$output .= '<header class="c-card__header">';
					$output .= '<div class="c-card__header__tag"><div>'.$label_type_de_poste.'</div></div>';
					$output .= '<div class="c-card__header__tag"><div>'.$label_departement.'</div></div>';
					$output .= '<h5 class="c-card__header__cat">'.$cat.'</h5>';
					$output .= '</header>';
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