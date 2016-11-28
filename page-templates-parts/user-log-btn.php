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
			echo '<a href="'.home_url().'/mon-profil" class="c-btn btn-profil">Mon profil</a>';
			if( is_home() || is_page('connexion') ):		
				echo '<a href="'.wp_logout_url(esc_url(home_url())).'" class="c-btn c-btn--warning c-btnLogOut js-tips-logout"></a>';
			else:
				echo '<a href="'.wp_logout_url(esc_url(get_the_permalink())).'" class="c-btn c-btn--warning c-btnLogOut js-tips-logout"></a>';
			endif;
	echo '</div>'; ;
else:
	if( !is_page('connexion')):
		echo '<a href="connexion" class="c-btn js-popin-show">Connexion</a>';
	else:
		echo '<a href="connexion" class="c-btn">Connexion</a>';
	endif; 
endif;
?>