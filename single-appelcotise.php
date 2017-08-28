<?php get_header(); ?>

<?php

if( is_user_logged_in() ):

  	if ( have_posts() ) :
    	while ( have_posts() ) : the_post();       
      		
      	if( verify_post_author(get_current_user_id(), get_the_ID()) ):
    			get_template_part( 'page-templates-parts/content', 'appelcotise' );
    		else:
    			get_template_part( 'page-templates-parts/message-need', 'rights' );
    		endif;

    	endwhile;
  	else:
      	get_template_part( 'page-templates-parts/content', 'none' );
  	endif;

else:
    get_template_part( 'page-templates-parts/message-need', 'login' );
endif;
?>

<?php get_footer(); ?>