<?php
/*
Template Name: Toutes les actions
*/
?>
<?php get_header(); ?>
<?php
	$subpages = new WP_Query( array(
	    'post_type' => 'page',
	    'post_parent' => PAGE_ACTIONS,
	    'posts_per_page' => -1
	));
?>

<div class="l-row bg-light">
	<header class="l-col l-col--content">
		<h1><?php echo get_the_title(); ?></h1>
		<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
	</header>
</div>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<ul class="l-postList">		
		
		<?php if( $subpages->have_posts() ) :

		    while( $subpages->have_posts() ) : $subpages->the_post();
		      	get_template_part( 'page-templates-parts/content', 'thumb' );

				$permalink = get_permalink();
				$title = get_the_title();
				$description = get_field('fluxi_resum', false, false);

				$output = '<li class="l-postList__item">';
				$output .= '<a href="'.$permalink.'">';
				$output .= '<article class="c-newsH">';
				$output .= '<div class="c-newsH__img" style="background-image: url('.$post_img_url.')"></div>';
				$output .= '<div class="c-newsH__body">';
				$output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
				$output .= '<p class="c-newsH__body__desc">'.$description.'</p>';
				$output .= '<div class="c-meta">';
				$output .= '<div class="c-dash"></div>';
				$output .= '<span class="c-link c-link--more c-newsH__body__link" target="_blank">En savoir plus</span>';				
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '</a>';
				$output .= '</li>';

				echo $output;

		    endwhile;

		else:    
			echo '<li><p class="mgTop--s font-subh"><strong>Il n\'y a pas d\'actions pour le moment.</strong></p></li>';
		endif;

		?>
		
		</ul>
		
	</div>
</section>

<?php get_footer(); ?>

