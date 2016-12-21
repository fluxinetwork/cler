
<?php
/*
Template Name: Toutes les offres d'emploi
*/
?>
<?php get_header(); ?>
<?php
$nb_offres = wp_count_posts('offres-emploi')->publish;
$output = ($nb_offres>1) ? $nb_offres.' offres' : $nb_offres.' offre';
?>

<div class="page">
	<div class="l-row">
		<header class="l-col l-col--content">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="single__header__meta">
				<div class="c-dash"></div>
				<?php 
					//
					// Ici ajouter <span class="js-nb-results"></span> pour le comptage des posts via filtre	
					//
				?>
				<span class="sub-title">Il y a <span class="js-nb-results"></span> <?php echo $output; ?>  d'emploi à consulter </span>
			</div>

		</header>
	</div>

	<div class="l-row">
		<div class="l-col">
			
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

				$args_filtered = array(
					'post_type' => 'offres-emploi',
					'post_status' => 'publish',
					'posts_per_page' => 5,
					'paged' => $paged
		 		);
				$query_filtered = new WP_Query( $args_filtered );

				if ( $query_filtered->have_posts() ) :
					echo '<ul class="l-postList results-list">';
					while ( $query_filtered->have_posts() ) : $query_filtered->the_post();

						$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
						$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

						$ob_departement = get_field_object('field_574dab093c7b0');
						$label_departement = $ob_departement['choices'][ get_field('departement') ];

						$ob_experience = get_field_object('field_5773a4bc97554');
						$label_experience = $ob_experience['choices'][ get_field('experience') ];

						$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
						$ch_niveau_detude = $ob_niveau_detude['choices'];
						$val_niveau_detude = $ob_niveau_detude['value'];
						$label_niveau_detude = '';

						if( $val_niveau_detude ):
							foreach( $val_niveau_detude as $v ):
								$label_niveau_detude .= '<span class="tag">'.$ch_niveau_detude[ $v ] .'</span>';
							endforeach;
						endif;

						$output = '<li classs="l-postList__item">';
						$output .= '<a href="'.get_permalink().'">';
						$output .= '<article class="c-offre">';

						$output .= '<h1 class="c-offre__title">'.get_the_title().'</h1>';

						$output .= '<span class="c-offre__meta">'.get_field('nom_structure').' - '.get_field('ville').' - '.$label_departement.'</span>';

						$output .= '<p class="c-offre_description">'.get_field('descriptif_organisme').'</p>';

						$output .= '<div class="c-offre__tags">';
						$output .= '<span class="c-tag">'.$label_type_de_poste.'</span>';
						$output .= '<span class="c-tag">'.$label_experience.'</span>';
						$output .= $label_niveau_detude;
						$output .= '</div>';

						$output .= '</article>';
						$output .= '</a>';
						$output .= '</li>';
						
						echo $output;

					endwhile;

			        echo '<div class="pager">';
					echo paginate_links( array(
						'base' => @add_query_arg('paged','%#%'),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $query_filtered->max_num_pages,
		          		'prev_next'=> false
					) );
			        echo '</div>';

				else :
					echo '<p><strong>Il n\'y a aucune offre d\'emploi pour l\'instant.</strong></p>';
				endif;
				wp_reset_postdata();
			?>

			<aside class="c-filterList">
				
			</aside>
		</div>
	</div>
</div>

<?php get_footer(); ?>



