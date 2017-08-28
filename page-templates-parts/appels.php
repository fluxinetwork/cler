<?php
/**
 * The template part for displaying the appels in profil
 */
?>
<?php
	$query_appels = new WP_Query( array(
	    'post_type' => 'appelcotise',
	    'posts_per_page' => -1,
	    'author' => get_current_user_id()
	));

	if( $query_appels->have_posts() ) :

		$count_appels = 0;
		$limit = 1;
?>

	<section class="l-row">
		<div class="l-col l-col--content receipts">
			<h2 class="c-section-title receipts__title">Vos appels à cotisation</h2>

			<ul class="l-postList receipts__list">	

			<?php
			while( $query_appels->have_posts() ) : $query_appels->the_post();	

				$title = get_the_title();
				$date = get_field('date_creation', false, false);
				$date = new DateTime($date);

				$permalink = get_the_permalink();
				$color = 'c-valid';					
				
				( $count_appels==$limit ) ? print('<div class="js-appels-hidden">') : '';

				$output = '<li class="l-postList__item">';
					$output .= '<a href="'.$permalink.'">';
						$output .= '<article class="c-newsH l-flex--aic">';
							$output .= '<span class="c-downloadItem__icon c-btnIcon c-btn--ghost"><i class="fa fa-download"></i></span>';
							$output .= '<div class="c-newsH__body">';
								$output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
								$output .= '<div class="c-meta">';
									$output .= '<div class="c-dash bg-'.substr($color, 2).'"></div>';							
									$output .= '<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date->format('d/m/Y').'</span>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</article>';
					$output .= '</a>';
				$output .= '</li>';

				echo $output;

				$count_appels++;

				if ($count_appels>$limit && $count_appels==$query_appels->post_count) {
					echo '</div>';
					echo '<div class="receipts__btn"><a href="#" class="c-btn js-toggle-appels"><i class="fa fa-search-plus c-meta__meta__icon"></i>Afficher tout</a></div>';
				}
				
				

			endwhile;
			?>
			</ul>

			
	 	</div>
	</section>

	<?php 
	endif; 
?>