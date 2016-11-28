<?php

/**
 * Disable admin top bar on public site
 */
show_admin_bar( false );

/*
 * If user is not an admin, do not allow access to the dashboard AT ALL.
 */
function custom_remove_no_admin_access(){
  if ( ! defined( 'DOING_AJAX' ) && ! current_user_can( 'manage_options' ) ) {
    wp_redirect( home_url() );
    die();
  }
}
add_action( 'admin_init', 'custom_remove_no_admin_access', 1 );

/**
 * Remove unnecessary admin menu
 *
 */
function remove_menus () {
  global $menu;
  // $restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Appearance'), __('Tools'), __('Plugins'), __('Users'), __('Comments'));
  $restricted = array(__('Dashboard'), __('Links'), __('Comments'));
  end ($menu);
  while (prev($menu)){
      $value = explode(' ',$menu[key($menu)][0]);
      if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
  }
}
add_action('admin_menu', 'remove_menus');


/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 */
function remove_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'remove_dashboard_widgets');


/**
 * Modify admin footer infos & credits
 */
function remove_footer_admin () {
  echo 'Propulsé par <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Conception et création Thibaut Caroli et <a href="http://www.yannrolland.com" target="_blank">Yann Rolland</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');


/**
 * Remove the toolbar logo
 */
function remove_wp_logo( $wp_admin_bar ) {
  $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );


/*--------------------------

        LOGIN

---------------------------*/

/**
 * Disable error login return
 */
add_filter('login_errors', create_function('$no_login_error', "return 'Mauvais identifiants';"));


/**
 * Disable lost & reset password
 */
function disable_reset_lost_password() {
    return false;
}
add_filter( 'allow_password_reset', 'disable_reset_lost_password');

function remove_lost_your_password($text) {
    return str_replace( array('Mot de passe oublié ?', 'Mot de passe oublié'), '', trim($text, '?') ); 
}
add_filter( 'gettext', 'remove_lost_your_password'  );
 
 
/**
 * Modify connection page logo and background
 */
function my_custom_login_logo() {
   echo '<style type="text/css">.login h1 a {background-image:url('.get_bloginfo('template_directory').'/app/img/login/logo-login.png)!important;  -webkit-background-size:120px auto!important;background-size:240px auto!important;width:inherit!important;}</style>';
}
add_action('login_head', 'my_custom_login_logo');

function my_login_logo_url() {
  return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
  return 'Fluxi';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );