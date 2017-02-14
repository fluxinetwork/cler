<?php
/**
 * The template part for displaying the download zone
 */
?>
<?php 
	if( have_rows('onglet_documents') ):
		$all_onglets = '';
		$all_pans = '';
		$nb_tabs = 0;		

		while ( have_rows('onglet_documents') ) : the_row();			
			
			$texte_onglet = get_sub_field('texte_onglet');
			$documents = get_sub_field('documents');

			$all_onglets .= '<a href="#" class="l-download__title js-tab" data-tab="'.$nb_tabs.'">'.$texte_onglet.'<span class="c-dash"></span></a>';

			//$all_pans .= '<li class="l-download is-active l-grid__col">';

			if( $documents ):

				$all_pans .= '<ul class="l-download__content__list ">';

			    foreach( $documents as $post): 
			        setup_postdata($post);
			        
			        $all_pans .= '<li class="l-download__content__list__item">
			        		<a href="'.$post->guid.'" class="c-downloadItem">
			        			<span class="c-downloadItem__icon c-btnIcon c-btn--ghost"><i class="fa fa-download"></i></span>
			        			<span class="c-downloadItem__title">'.$post->post_title.'</span>
			        		</a>
			        	  </li>';

			    endforeach;			   
			    wp_reset_postdata();

			    $all_pans .= '</ul>';


			endif;

			//$all_pans .= '</li>';

			 $nb_tabs ++;
			 
		endwhile;


		// OUTPUT

		echo '<section class="l-row">';
		echo '<div class="l-col">';
		echo '<h3 class="c-section-title">Zone téléchargements</h3>';

		echo '<div class="l-download__tabs">'.$all_onglets.'</div>';

		echo '<div class="l-download__content">';
			echo $all_pans;
		echo '</div>';	

		echo '</div>';	
		echo '</section>';		
		

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