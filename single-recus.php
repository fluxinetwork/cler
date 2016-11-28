<?php get_header(); ?>

<?php

  	if ( have_posts() ) :
    	while ( have_posts() ) : the_post();       
      		
			get_template_part( 'page-templates-parts/content', 'recu' );

    	endwhile;
  	else:
      	get_template_part( 'page-templates-parts/content', 'none' );
  	endif;

?>

<?php get_footer(); ?>