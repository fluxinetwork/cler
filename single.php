<?php get_header(); ?>

<?php

  	if ( have_posts() ) :
    	while ( have_posts() ) : the_post();       
      	// Include the page content template.
			get_template_part( 'page-templates-parts/content', 'page' );
			
    	endwhile;
  	else:
      	get_template_part( 'page-templates-parts/content', 'none' );
  	endif;

?>

<?php get_footer(); ?>