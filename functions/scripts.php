<?php

/**
 * 01. STYLES
 * 02. SCRIPTS
 * 03. Google Analytics
 */


/**
 * 01 STYLES
 */

function enqueue_styles() {

    /* REGISTER */

    wp_register_style( 'css', THEME_DIR_PATH . '/app/css/main.css', array(), null );
    wp_register_style( 'css-min', THEME_DIR_PATH . '/app/css/main.min.css', array(), null );

    /* ENQUEUE */

    if ( DEV ) {
        //wp_enqueue_style('css');
        wp_enqueue_style('css-min');
    } else {
        wp_enqueue_style('css-min');
    }

}
add_action('wp_enqueue_scripts', 'enqueue_styles', 100);


/**
 * Ajoute une feuille de style à l'admin
 */

function load_admin_style() {
	wp_enqueue_style( 'admin_css', THEME_DIR_PATH .'/app/css/admin-style.css', false, '1.0.0' );
}
if ( ADMIN_STYLE ) {
    add_action( 'admin_enqueue_scripts', 'load_admin_style' );
}

/**
 * Adhèrent Admin JS
 */

function script_admin_adherent( $hook ) {
    $screen = get_current_screen();
    if ( $hook == 'post.php' && $screen->post_type != 'adherents' ) {
        return;
    }
    
    wp_enqueue_script( 'admin-adherent', THEME_DIR_PATH . '/app/js/modules/admin-adherent.js', array( 'jquery' ) );

    $admin_adherent_nonce = wp_create_nonce( 'admin_adherent_nonce' );

    wp_localize_script( 'admin-adherent', 'ajax_object', array('ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => $admin_adherent_nonce ) );
}
add_action( 'admin_enqueue_scripts', 'script_admin_adherent' );

/**
 * Adhèrent Offre d'emploi JS
 */

function script_admin_offre_emp( $hook ) {
    $screen = get_current_screen();
    if ( $hook == 'post.php' && $screen->post_type != 'offres-emploi' ) {
        return;
    }
    
    wp_enqueue_script( 'admin-offres-emploi', THEME_DIR_PATH . '/app/js/modules/admin-offre-emploi.js', array( 'jquery' ) );

    $admin_offre_emp_nonce = wp_create_nonce( 'admin_offre_emp_nonce' );

    wp_localize_script( 'admin-offres-emploi', 'ajax_object', array('ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => $admin_offre_emp_nonce ) );
}
add_action( 'admin_enqueue_scripts', 'script_admin_offre_emp' );


/**
 * Webinaire Admin JS
 */

function script_admin_webinaire( $hook ) {
    $screen = get_current_screen();
    if ( $hook == 'post.php' && $screen->post_type != 'webinaires' ) {
        return;
    }
    
    wp_enqueue_script( 'admin-webinaire', THEME_DIR_PATH . '/app/js/modules/admin-webinaire.js', array( 'jquery' ) );

    $admin_webinaire_nonce = wp_create_nonce( 'admin_webinaire_nonce' );

    wp_localize_script( 'admin-webinaire', 'ajax_object', array('ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => $admin_webinaire_nonce ) );
}
add_action( 'admin_enqueue_scripts', 'script_admin_webinaire' );


/**
 * Ajoute une feuille de style au MCE pour une mise en page équivalente au Front


function theme_add_editor_styles() {
    add_editor_style( THEME_DIRECTORY_PATH.'/app/css/editor-style.css' );
}
if ( EDITOR_STYLE ) {
    add_action( 'admin_init', 'theme_add_editor_styles' );
}
*/

/**
 * 02 SCRIPTS
 */

function enqueue_scripts() {

    /* REGISTER */

    wp_register_script( 'jQuery', THEME_DIR_PATH . '/app/js/vendors/jquery-1.11.3.min.js', array(), null, false );
    wp_register_script( 'imagesLoaded', THEME_DIR_PATH . '/app/js/vendors/imagesloaded.min.js', array(), null, true );
    wp_register_script( 'waypoint', THEME_DIR_PATH . '/app/js/vendors/base/waypoints.min.js', array(), null, true );
    wp_register_script( 'mousewheel', THEME_DIR_PATH . '/app/js/vendors/jquery.mousewheel.min.js', array(), null, true );
    wp_register_script( 'fitvids', THEME_DIR_PATH . '/app/js/vendors/base/jquery.fitvids.min.js', array(), null, true );

    wp_register_script( 'stripeApi', 'https://js.stripe.com/v2/', array(), null, true );

    // FORMS
    wp_register_script( 'form-validator', THEME_DIR_PATH . '/app/js/vendors/form-validator/jquery.form-validator.min.js', array(), null, true );
    wp_register_script( 'datetimepicker', THEME_DIR_PATH . '/app/js/vendors/datetimepicker/datetimepicker.js', array(), null, true );
    //wp_register_script( 'fullselect2', THEME_DIR_PATH . '/app/js/vendors/select2/select2.full.min.js', array(), null, true );

    // Offre d'emploi
    wp_register_script( 'form-offre-emploi', THEME_DIR_PATH . '/app/js/modules/form-offre-emploi.js', array('jQuery','form-validator', 'datetimepicker'), null, true );

    if( is_page_template( 'page-templates/page-manage-emploi.php' ) ){
        wp_localize_script( 'form-offre-emploi', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-offre-emploi' );
    }

    // Evenements
    wp_register_script( 'form-event', THEME_DIR_PATH . '/app/js/modules/form-event.js', array('jQuery','form-validator', 'datetimepicker'), null, true );

    if( is_page_template( 'page-templates/page-manage-event.php' ) ){
        wp_localize_script( 'form-event', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-event' );
    }

    // Adhèrent
    wp_register_script( 'form-adherent', THEME_DIR_PATH . '/app/js/modules/form-adherent.js', array('jQuery','form-validator'), null, true );

    if( is_page_template( 'page-templates/page-manage-adherent.php' ) ){
        wp_localize_script( 'form-adherent', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-adherent' );
    }

    // Map Adhérents
    wp_register_script( 'googlemap-api', 'https://maps.googleapis.com/maps/api/js?key='.GOOGLE_MAP_API_KEY , array(), null, true );
    wp_register_script( 'cluster-api', THEME_DIR_PATH . '/app/js/vendors/markerclusterer.js' , array(), null, true );
    wp_register_script( 'map-adherents', THEME_DIR_PATH . '/app/js/modules/map-adherents.js', array('jQuery','cluster-api'), null, true );
    if( is_page_template( 'page-templates/page-map-adherents.php' ) || is_page_template( 'page-templates/page-formateree.php' ) ){
        wp_enqueue_script( 'googlemap-api');
        wp_localize_script( 'map-adherents', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'map-adherents' );
    }

    // Webinaire
    wp_register_script( 'form-webinaire', THEME_DIR_PATH . '/app/js/modules/form-webinaire.js', array('jQuery','form-validator'), null, true );

    if( get_post_type() == 'webinaires' ){
        wp_localize_script( 'form-webinaire', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-webinaire' );
    }

    // Concours
    wp_register_script( 'form-concours', THEME_DIR_PATH . '/app/js/modules/form-concours.js', array('jQuery','form-validator'), null, true );

    if( get_post_type() == 'concours' ){
        wp_localize_script( 'form-concours', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-concours' );
    }

    // Formation
    wp_register_script( 'form-formation', THEME_DIR_PATH . '/app/js/modules/form-formation.js', array('jQuery','form-validator', 'datetimepicker'), null, true );

    if( is_page_template( 'page-templates/page-manage-formation.php' ) ){
        wp_localize_script( 'form-formation', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-formation' );
    }
    // https://js.stripe.com/v2/

    // Paiement
    wp_register_script( 'form-paiement', THEME_DIR_PATH . '/app/js/modules/form-paiement.js', array('jQuery', 'form-validator', 'stripeApi'), null, true );

    if( is_page_template( 'page-templates/page-paiement.php' ) ){
        wp_localize_script( 'form-paiement', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script( 'form-paiement' );
    }

    // Main
    wp_register_script( 'main', THEME_DIR_PATH . '/app/js/main.js', array('jQuery', 'imagesLoaded', 'waypoint', 'mousewheel', 'fitvids'), null, true );

    wp_register_script( 'full', THEME_DIR_PATH . '/app/js/full.min.js', array('jQuery'), null, true );


    /* ENQUEUE */

    if ( DEV ) {
        wp_localize_script( 'main', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script('main');
    } else {
        wp_localize_script( 'full', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        wp_enqueue_script('full');
    }

}
add_action('wp_enqueue_scripts', 'enqueue_scripts', 100);


/**
 * 03 Google Analytics
 * UA-code is set in config.php
 */

function google_analytics() { ?>

    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
    </script>

<?php }

if (GOOGLE_ANALYTICS_ID && GOOGLE_ANALYTICS_ID != '') {
  add_action('wp_footer', 'google_analytics', 20);
}
