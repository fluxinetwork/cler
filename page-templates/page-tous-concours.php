<?php
/*
Template Name: Tous les concours
*/
?>
<?php get_header(); ?>
<?php
	
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	$args = array(
		'post_type' => 'concours',
		'post_status' => 'publish',
		'paged' => $paged	
	);	

	$query_paged = new WP_Query( $args );
?>

<div class="l-row bg-light">
	<header class="l-col l-col--content">
		<h1><?php the_title(); ?></h1>
		<div class="c-meta l-intro__meta">
			<div class="c-dash"></div>
		</div>
		<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
	</header>
</div>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<ul class="l-postList">		
		<?php
		
		if ( $query_paged->have_posts() ) :
			while ( $query_paged->have_posts() ) : $query_paged->the_post();

				$permalink = get_permalink();
				$title = get_the_title();
				$date_debut_candidatures = get_field('date_debut_candidatures');
				$date_fin_candidatures = get_field('date_fin_candidatures');
				
				include(locate_template('page-templates-parts/get-thumb.php'));
				
				$categories = get_the_category();
				if($categories){					
					$cat_name = '<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$categories[0]->cat_name.'</span>';
				}else{
					$cat_name = '';
				}				

				$output = '<li class="l-postList__item">';
				$output .= '<a href="'.$permalink.'">';
				$output .= '<article class="c-newsH">';
				$output .= '<div class="c-newsH__img" style="background-image:url('.$post_img_url.')"></div>';
				$output .= '<div class="c-newsH__body">';
				$output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
				$output .= '<div class="c-meta">';
				$output .= '<div class="c-dash"></div>';
				$output .= '<span class="c-meta__meta"><i class="fa fa-toggle-on c-meta__meta__icon" aria-hidden="true"></i>Participez du '.$date_debut_candidatures.' au '.$date_fin_candidatures.'</span>';
				$output .= $cat_name;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '</a>';
				$output .= '</li>';

				echo $output;

			endwhile;

		else:

			echo '<li><p class="mgTop--s font-subh"><strong>Il n\'y a pas de concours pour le moment.</strong></p></li>';

		endif;
		wp_reset_postdata();
		?>
		</ul>

		<?php include(locate_template('page-templates-parts/base/pagination.php')); ?>
	</div>
</section>

<?php get_footer(); ?>

