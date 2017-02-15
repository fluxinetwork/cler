<?php
/*
Template Name: Tous les concours
*/
?>
<?php get_header(); ?>
<?php
	
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	if( isset( $_GET['type'] ) && !empty( $_GET['type'] ) ):
		$type_concours = filter_var($_GET['type'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

		if( $type_concours == 'haiku' ):
			$page_title = get_the_title(1275);
			$fluxi_resum = get_field('fluxi_resum', 1275);
		elseif( $type_concours == 'cler_obscur' ):
			$page_title = get_the_title(3117);
			$fluxi_resum = get_field('fluxi_resum', 3117);		
		else:	
			$page_title = 'Nos concours';
			$fluxi_resum = "Afin de donner la parole aux citoyens, le CLER a créé deux concours ouverts à tous. Grâce à ces deux compétitions réunissant des films courts et des haïkus, nous souhaitons récompenser la créativité et encourager l'expression de messages positifs autour des énergies renouvelables et de la maîtrise de l'énergie. L'enthousiasme, l'esprit collectif et la capacité mobilisatrice des oeuvres amateurs, scolaires ou semi-professionnelles présentées chaque année montrent les multiples visages de la transition énergétique sur le terrain.";
		endif;

		$args = array(
			'post_type' => 'concours',
			'post_status' => 'publish',
			'paged' => $paged,
			'meta_key'		=> 'type_concours',
			'meta_value'	=> $type_concours	
		);

	else:
		$page_title = 'Nos concours';

		$args = array(
			'post_type' => 'concours',
			'post_status' => 'publish',
			'paged' => $paged	
		);

		$fluxi_resum = "Afin de donner la parole aux citoyens, le CLER a créé deux concours ouverts à tous. Grâce à ces deux compétitions réunissant des films courts et des haïkus, nous souhaitons récompenser la créativité et encourager l'expression de messages positifs autour des énergies renouvelables et de la maîtrise de l'énergie. L'enthousiasme, l'esprit collectif et la capacité mobilisatrice des oeuvres amateurs, scolaires ou semi-professionnelles présentées chaque année montrent les multiples visages de la transition énergétique sur le terrain.";
	endif;

	$query_all = new WP_Query( $args );
?>

<div class="l-row bg-light">
	<header class="l-col l-col--content">
		<h1><?php echo $page_title; ?></h1>
		<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
	</header>
</div>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<ul class="l-postList">		
		<?php
		
		if ( $query_all->have_posts() ) :
			while ( $query_all->have_posts() ) : $query_all->the_post();

				$permalink = get_permalink();
				$date = get_the_date('d M Y');
				$title = get_the_title();

				
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
				$output .= '<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date.'</span>';
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

		<?php
			echo '<div class="pagination">';
			echo '<div class="nav-links">';
			echo paginate_links( array(
				'base' => @add_query_arg('paged','%#%'),
				'before_page_number' => 'Page ',
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'prev_next'=> false
			) );
			echo '</div>';
			echo '</div>';
		?>
	</div>
</section>

<?php get_footer(); ?>

