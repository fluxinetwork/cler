<?php
/**
 * The template part for displaying the reçus in profil
 */
?>
<?php
	$count_recus = 0;
	$query_recus = new WP_Query( array(
	    'post_type' => 'recus',
	    'posts_per_page' => -1,
	    'author' => get_current_user_id()
	));
	if( $query_recus->have_posts() ) : ?>

		<section class="l-row">
			<div class="l-col">
				<h2 class="c-section-title">Vos reçus</h2>
				
				<?php while( $query_recus->have_posts() ) : $query_recus->the_post();			    	

					$count_recus++;

					($count_recus==4) ? print('<div style="display:none;">') : '';

					echo '<a class="c-downloadItem__title" href="'.get_the_permalink().'">';					
					echo get_the_title();
					echo '</a>';

					($count_recus<$query_recus->post_count) ? print('<br>') : '';

					($count_recus==$query_recus->post_count) ? print('</div>') : '';

				endwhile; ?>
				

				<?php
					if($query_recus->post_count > 3):
						echo '<a href="#" class="c-btn js-toggle-list">Afficher tout</a>';
					endif;
				?>
		 	</div>
		</section>

	<?php 
	endif; 
?>