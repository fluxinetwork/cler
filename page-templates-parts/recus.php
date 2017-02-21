<?php
/**
 * The template part for displaying the reçus in profil
 */
?>
<?php
	$query_recus = new WP_Query( array(
	    'post_type' => 'recus',
	    'posts_per_page' => -1,
	    'author' => get_current_user_id()
	));

	if( $query_recus->have_posts() ) :

		$count_recus = 0;
		$limit = 1;
		$valid = 0;
		$pending = 0;
		$error = 0;
?>


	<section class="l-row">
		<div class="l-col l-col--content receipts">
			<h2 class="c-section-title receipts__title">Vos reçus</h2>

			<ul class="l-postList receipts__list">	

			<?php
			while( $query_recus->have_posts() ) : $query_recus->the_post();	

				$title = get_the_title();
				$date = get_field('date_paiement');
				$permalink = get_the_permalink();
				$status = get_field('statut_paiement');
				if ( $status=='succeeded' ) {
					$valid ++;
					$status = 'Réglée';
					$color = 'c-valid';
					$icon = 'fa-check-circle';
				} else {
					if ( $status=='pending' ) {
						$pending ++;
						$status = 'Paiement en attente';
						$icon = 'fa-exclamation-circle';
						$color = 'c-error';
					} else {
						$error ++;
						$status = 'Echec du paiement';
						$icon = 'fa-times-circle';
						$color = 'c-dark';
					}
				}


				( $count_recus==$limit ) ? print('<div class="js-receipts-hidden">') : '';

				$output = '<li class="l-postList__item">';
					$output .= '<a href="'.$permalink.'">';
						$output .= '<article class="c-newsH l-flex--aic">';
							$output .= '<span class="c-downloadItem__icon c-btnIcon c-btn--ghost"><i class="fa fa-download"></i></span>';
							$output .= '<div class="c-newsH__body">';
								$output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
								$output .= '<div class="c-meta">';
									$output .= '<div class="c-dash"></div>';
									$output .= '<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date.'</span>';
									$output .= '<span class="c-meta__meta t-meta--dark '.$color.'"><i class="fa '.$icon.' c-meta__meta__icon" aria-hidden="true"></i>'.$status.'</span>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</article>';
					$output .= '</a>';
				$output .= '</li>';

				echo $output;

				$count_recus++;

				if ($count_recus>$limit && $count_recus==$query_recus->post_count) {
					echo '</div>';
					echo '<div class="receipts__btn"><a href="#" class="c-btn js-toggle-receipts"><i class="fa fa-search-plus c-meta__meta__icon"></i>Afficher tout</a></div>';
				}

			endwhile;
			?>
			</ul>

			<div class="receipts__overview">
				<div class="receipts__overview__col c-valid"><i class="fa fa-check-circle mgRight--xs"></i><?php echo $valid; ?></div>
				<div class="receipts__overview__col c-error"><i class="fa fa-exclamation-circle mgRight--xs"></i><?php echo $pending; ?></div>
				<div class="receipts__overview__col c-dark"><i class="fa fa-times-circle mgRight--xs"></i><?php echo $error; ?></div>
			</div>
	 	</div>
	</section>

	<?php 
	endif; 
?>