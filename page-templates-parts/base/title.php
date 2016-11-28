<?php
if ( is_front_page() ) :
	bloginfo('name');
	print(' | Accueil');
else :
	wp_title('');
	print(' | ');
	bloginfo('name');
endif;
?>