<?php
/**
 * The template used for displaying user logout button
 */
?>

<?php 
if( is_user_logged_in() ):
	global $current_user;
	$current_user = wp_get_current_user();
	
	echo '<div class="l-nav__login__buttons">';
			if( !is_page('mon-profil')){ echo '<a href="'.home_url().'/mon-profil" class="c-btn btn-profil">Mon profil</a>'; }
			if( is_home() || is_page('connexion') ):		
				echo '<a href="'.wp_logout_url(esc_url(home_url())).'" class="c-btnIcon  bg-error mgLeft--xs js-tips-logout"><i class="fa fa-sign-out"></i></a>';
			else:
				echo '<a href="'.wp_logout_url(esc_url(get_the_permalink())).'" class="c-btnIcon  bg-error mgLeft--xs js-tips-logout"><i class="fa fa-sign-out"></i></a>';
			endif;
	echo '</div>'; ;
else:
	if( !is_page('connexion')):
		echo '<a href="connexion" class="c-btn js-popin-show"><i class="fa fa-sign-in mgRight--xs"></i>Connexion</a>';
	else:
		echo '<a href="connexion" class="c-btn"><i class="fa fa-sign-in mgRight--xs"></i>Connexion</a>';
	endif; 
endif;
?>