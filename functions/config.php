<?php
/**
 * DEV
 */
define('THEME_DIR_NAME', 'cler');
define('THEME_DIR_PATH', get_template_directory_uri());
define('DEV', true);
define('ADMIN_STYLE', true);
define('EDITOR_STYLE', false);


/**
 * VALUES
 */
define('POST_EXCERPT_LENGTH', 40);
define('SLIDER_NB_POSTS', 10);
define('LIMIT_STRING', 90);

define('STRIPE_KEY', get_field('stripe_key','option'));
//define('STRIPE_KEY', 'sk_test_v6Ap9E383Hth1I9JkIuHXJFJ');

define('GOOGLE_ANALYTICS_ID', get_field('analitics_key','option'));
define('GOOGLE_MAP_API_KEY', get_field('google_map_key','option'));
/* ACF Google Maps */
function wpc_acf_init() {
	acf_update_setting('google_api_key', GOOGLE_MAP_API_KEY);
}
add_action('acf/init', 'wpc_acf_init');


/**
 * ACTIVATE
 */
define('PAGE_EXCERPT', false);
define('PAGE_TAXO', true);
define('ACF_OPTION_PAGE', true);
define('ADD_THUMBNAILS', false);
define('DISALLOW_FILE_EDIT', true);
// CRON
define('DISABLE_WP_CRON', false);


/**
 * MAILS
 */

define('CONTACT_GENERAL', 'info@cler.org');

define('CONTACTS_ADHESION_1', 'lucile.krezel@cler.org');
define('CONTACTS_ADHESION_2','alexis.monteil@cler.org');
define('CONTACT_TEPOS', 'esther.bailleul@cler.org');

define('CONTACTS_PAIEMENT_1', 'radhia.berdaoui@cler.org');
define('CONTACTS_PAIEMENT_2','lucile.krezel@cler.org');

define('CONTACTS_EVENT_1','lucile.krezel@cler.org');

define('CONTACTS_EMPLOI_1', 'lucile.krezel@cler.org');

define('CONTACTS_CONCOURS_1', 'lucile.krezel@cler.org');
define('CONTACTS_CONCOURS_2', 'jane.mery@cler.org');
define('CONTACTS_CONCOURS_3', 'jennifer.lavalle@cler.org');

define('CONTACTS_FORMATION_1', 'lucile.krezel@cler.org');
define('CONTACTS_FORMATION_2', 'alexis.monteil@cler.org');
/* 
define('CONTACT_GENERAL', 'rollandyann@gmail.com');

define('CONTACTS_ADHESION_1', 'rollandyann@gmail.com');
define('CONTACTS_ADHESION_2','rollandyann@gmail.com');
define('CONTACT_TEPOS', 'rollandyann@gmail.com');

define('CONTACTS_PAIEMENT_1', 'rollandyann@gmail.com');
define('CONTACTS_PAIEMENT_2','rollandyann@gmail.com');

define('CONTACTS_EVENT_1','rollandyann@gmail.com');

define('CONTACTS_EMPLOI_1', 'rollandyann@gmail.com');

define('CONTACTS_CONCOURS', 'rollandyann@gmail.com');

define('CONTACTS_FORMATION_1', 'rollandyann@gmail.com');
define('CONTACTS_FORMATION_2', 'rollandyann@gmail.com');
*/

/**
 * LINKS
 */
define('FACEBOOK', 'https://www.facebook.com/CLER-R%C3%A9seau-pour-la-Transition-%C3%A9nerg%C3%A9tique-437435406311054/');
define('TWITTER', 'https://twitter.com/assoCLER');

define('MAP_ADHERENT', '311');
define('PAGE_ADHEREZ', '1286');
define('PAGE_CA', '2655');
define('PAGE_EQUIPE', '2658');
define('PAGE_FORMATERE', '1270');

define('HUB_ADHERENT', '3024');
define('HUB_CITOYEN', '1288');
define('HUB_ELU', '1291');
define('HUB_PRESSE', '1292');

define('ALL_NEWS', '1276');

define('PAGE_OFFRE', '3067');
define('PAGE_OFFRES', '1300');

define('FORM_OFFRE', '143');
define('FORM_EVENT', '313');
define('FORM_FORMATION', '1234');
define('FORM_PROFIL', '9');
define('FORM_ADHESION', '141');

/*
define('FORM_OFFRE', '143');
define('FORM_EVENT', '313');
define('FORM_FORMATION', '1234');
define('FORM_PROFIL', '9');
define('FORM_ADHESION', '873');
*/

define('CREER_USER', '7');
define('RESET_PASSWORD', '10');

define('PAGE_ACTIONS', '1246');
define('PAGE_SLIME', '1269');
define('PAGE_TEPOS', '1250');
define('PAGE_RAPPEL', '1248');
define('PAGE_PROFIL', '8');
define('PAGE_MODE_EMP_WEBINAIRE', '3756');

define('CHARTE_CLER', '2659');
define('REGLEMENT_CLER', '2665');
define('CHARTE_TEPOS', 'http://www.territoires-energie-positive.fr/fre/content/download/49430/485703/file/Charte_TEPOS.pdf');

define('CONTACT', '3183');

define('NEWSLETTER_FORM_URL', 'http://eepurl.com/cBY7OD');

/**
 * Add excerpt to pages
 */

if ( PAGE_EXCERPT ) {
	function add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'add_excerpts_to_pages' );
}

/**
 * Add WP core taxonomy to pages
 */

if ( PAGE_TAXO ) {
	function add_taxo_to_pages() {
		register_taxonomy_for_object_type( 'category', 'page' );
	}
	add_action( 'init', 'add_taxo_to_pages' );
}


/**
 * Add post thumbnail
 */

if ( ADD_THUMBNAILS ) {
	function add_post_thumb() {
		add_theme_support( 'post-thumbnails', array('post','page') );
	}
	add_action('after_setup_theme', 'add_post_thumb');
}


/**
 * Activate ACF option page
 */

if ( ACF_OPTION_PAGE && function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page(array(
		'page_title'    => 'Options',
		'menu_title'    => 'Options',
		'menu_slug'     => 'options-generales',
		'capability'    => 'edit_posts',
		'redirect'      => true
	));

	acf_add_options_sub_page(array(
		'page_title'    => 'Formulaires',
		'menu_title'    => 'Formulaires',
		'menu_slug'     => 'formulaires',
		'parent_slug'   => $parent['menu_slug'],
	));
}

/**
 * GET vars
 */
function add_query_vars_filter( $vars ){
	// * User confirmation (fluxi-users plugin)	* //
  	$vars[] = 'confirme_utilisateur';
  	$vars[] = 'utilisateur';
  	// * Forms 	* //
  	$vars[] = 'act'; // action of the form : add, mod, del
  	$vars[] = 'idp'; // post id

  	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

