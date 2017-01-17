<?php
/*
Template Name: Toutes les actualités		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-main">
	<div class="l-col l-col--content">
		<ul class="l-list">
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 20,
			'tax_query' => array(
				array(
					'taxonomy' => 'publics-cible',
					'field'    => 'slug',
					'terms'    => 'adherent',
					'operator' => 'NOT IN'
				),
			)
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

				$output = '<li class="l-list__item">';
				$output .= '<a href="c-cardH">';
				$output .= '</a>';
				$output .= '</li>';

				//echo $output;

			endwhile;
		endif;
		wp_reset_postdata();
		?>

		<li class="l-list__item">
			<a href="#">
				<article class="c-newsH">
					<div class="c-newsH__img" style="background-image: url('http://localhost:8888/cler/wp-content/uploads/2016/11/adl1z8_ngy-stacy-wyss.jpg')"></div>
					<div class="c-newsH__body">
						<div class="c-newsH__body__meta">
							<span class="t-meta">12 sept. 2016</span>
							<span class="t-meta mgLeft--s">Précarité énergétique</span>
						</div>
						<h1 class="c-newsH__body__title">Respect des exigences de performance environnementale : tout reste à faire</h1>
					</div>
				</article>
			</a>
		</li>
		</ul>
	</div>
</section>

<?php get_footer(); ?>

