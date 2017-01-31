<?php
/**
 * The template part for displaying the download zone
 */
?>
<?php 
	if( have_rows('onglet_documents') ):

		echo '<ul>';

		while ( have_rows('onglet_documents') ) : the_row();

			$texte_onglet = get_sub_field('texte_onglet');
			$documents = get_sub_field('documents');

			echo '<li><a href="#">'.$texte_onglet.'</a>';

			if( $documents ):

				echo '<ul>';

			    foreach( $documents as $post): 
			        setup_postdata($post);
			        
			        echo '<li><a href="'.$post->guid.'">'.$post->post_title.'</a></li>';

			    endforeach;			   
			    wp_reset_postdata();

			    echo '</ul>';
			endif;

			echo '</li>';

		endwhile;

		echo '</ul>';

	else:
		// No items
	endif;
?>