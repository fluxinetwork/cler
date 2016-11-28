<?php
/*
Template Name: Carte des adhérents
*/
?>
<?php 
	get_header(); 
	
  	if ( have_posts() ) :
    	while ( have_posts() ) : the_post();
      	// Include the page content template.
			get_template_part( 'page-templates-parts/map', 'adherents' );
			
    	endwhile;
  	else:
      	get_template_part( 'page-templates-parts/content', 'none' );
  	endif;

	get_footer();
?>

