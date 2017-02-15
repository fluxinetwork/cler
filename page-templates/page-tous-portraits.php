<?php
/*
Template Name: Tous les portraits
*/
?>
<?php get_header(); ?>
<?php

	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	$args = array(
		'post_type' => 'portraits',
		'post_status' => 'publish',
		'paged' => $paged
	);

	$query_all = new WP_Query( $args );

?>

<div class="l-row bg-light">
	<header class="l-col l-col--content">
		<h1><?php echo get_the_title(); ?></h1>
		<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
	</header>
</div>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<div class="js-notify"></div>
		<ul class="l-postList">
		<?php

		if ( $query_all->have_posts() ) :
			while ( $query_all->have_posts() ) : $query_all->the_post();

				$permalink = get_permalink();
				$date = get_the_date('d M Y');
				$title = get_the_title();
				$description = get_field('fluxi_resum', false, false);

				
				include(locate_template('page-templates-parts/get-thumb.php'));

				$categories = get_the_category();
				if($categories){
					$cat_name = '<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$categories[0]->cat_name.'</span>';
				}else{
					$cat_name = '';
				}

				$output = '<li class="l-postList__item">';
				$output .= '<a href="'.$permalink.'">';
				$output .= '<article class="c-newsH c-newsH--contact">';
				$output .= '<div class="c-newsH__img" style="background-image:url('.$post_img_url.')"></div>';
				$output .= '<div class="c-newsH__body">';
				$output .= '<span class="c-newsH__body__meta">'.$date.'</span>';
				$output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
				$output .= '<p class="c-newsH__body__desc">'.$description.'</p>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '</a>';
				$output .= '</li>';

				echo $output;

			endwhile;

		else:

			echo '<li><p class="mgTop--s font-subh"><strong>Il n\'y a pas de portrait pour le moment.</strong></p></li>';

		endif;
		wp_reset_postdata();
		?>
		</ul>

		<?php
			echo '<div class="pagination">';
			echo '<div class="nav-links">';
			echo paginate_links( array(
				'base' => @add_query_arg('paged','%#%'),
				'before_page_number' => 'Page ',
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $query_all->max_num_pages,
				'prev_next'=> false
			) );
			echo '</div>';
			echo '</div>';
		?>
	</div>
</section>

<?php get_footer(); ?>
