<?php
/**
 * The template part for displaying the download zone
 */
?>
<?php 
	if( have_rows('onglet_documents') ):

		echo '<ul class="l-col list-reset l-grid">';

		while ( have_rows('onglet_documents') ) : the_row();

			$texte_onglet = get_sub_field('texte_onglet');
			$documents = get_sub_field('documents');

			echo '<li class="l-download is-active l-grid__col"><a href="#" class="l-download__title">'.$texte_onglet.'</a>';

			if( $documents ):

				echo '<ul class="l-download__list">';

			    foreach( $documents as $post): 
			        setup_postdata($post);
			        
			        echo '<li class="l-download__list__item">
			        		<a href="'.$post->guid.'" class="c-downloadItem">
			        			<i class="fa fa-download c-downloadItem__icon"></i>
			        			<span class="c-downloadItem__title">'.$post->post_title.'</span>
			        		</a><
			        	  </li>';

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

<?php /*
<ul class="l-col list-reset l-grid">
	<li class="l-download is-active l-grid__col">
		<a href="#" class="l-download__title">Rapport financier 2015 <div class="c-dash"></div></a>
		<ul class="l-download__list">
			<li class="l-download__list__item">
				<a href="https://cler.org/dev-cler/wp-content/uploads/2017/01/rapporttresorier_cler2015.pdf" class="c-downloadItem">
					<i class="fa fa-download c-downloadItem__icon"></i>
					<span class="c-downloadItem__title">Rapport du trésorier 2015</span>
				</a>
			</li>
			<li class="l-download__list__item">
				<a href="https://cler.org/dev-cler/wp-content/uploads/2017/01/rapporttresorier_cler2015.pdf" class="c-downloadItem">
					<i class="fa fa-download c-downloadItem__icon"></i>
					<span class="c-downloadItem__title">Rapport du trésorier 2015</span>
				</a>
			</li>
			<li class="l-download__list__item">
				<a href="https://cler.org/dev-cler/wp-content/uploads/2017/01/rapporttresorier_cler2015.pdf" class="c-downloadItem">
					<i class="fa fa-download c-downloadItem__icon"></i>
					<span class="c-downloadItem__title">Rapport du trésorier 2015</span>
				</a>
			</li>
			<li class="l-download__list__item">
				<a href="https://cler.org/dev-cler/wp-content/uploads/2017/01/rapporttresorier_cler2015.pdf" class="c-downloadItem">
					<i class="fa fa-download c-downloadItem__icon"></i>
					<span class="c-downloadItem__title">Rapport du trésorier 2015</span>
				</a>
			</li>
			<li class="l-download__list__item">
				<a href="https://cler.org/dev-cler/wp-content/uploads/2017/01/rapporttresorier_cler2015.pdf" class="c-downloadItem">
					<i class="fa fa-download c-downloadItem__icon"></i>
					<span class="c-downloadItem__title">Rapport du trésorier 2015</span>
				</a>
			</li>
		</ul>
	</li>
	<li class="l-download l-grid__col">
		<a href="#" class="l-download__title">Rapport d'activités 2015 <div class="c-dash"></div></a>
		<ul class="l-download__list">
			<li class="l-download__list__item">
				<a href="https://cler.org/dev-cler/wp-content/uploads/2017/01/CLER-rapport2015.pdf" class="c-downloadItem">
					<i class="fa fa-download c-downloadItem__icon"></i>
					<span class="c-downloadItem__title">CLER-rapport2015</span>
				</a>
			</li>
		</ul>
	</li>
</ul> */ ?>