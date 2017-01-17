<?php

// DEV
define('THEME_DIR_NAME', 'cler');
define('THEME_DIR_PATH', get_template_directory_uri());
define('DEV', true);
define('ADMIN_STYLE', true);
define('EDITOR_STYLE', false);

// VALUES
define('POST_EXCERPT_LENGTH', 40);
define('STRIPE_KEY', 'sk_live_nIIBwPmVfcFQahFBHo6wfQpX');
define('GOOGLE_ANALYTICS_ID', '');
define('GOOGLE_MAP_API_KEY', 'AIzaSyCHOJtRqM6DSAm6HXYsYSITlHhzkvLKH_M');
/* ACF Google Maps */
function wpc_acf_init() {
	acf_update_setting('google_api_key', GOOGLE_MAP_API_KEY);
}
add_action('acf/init', 'wpc_acf_init');



// ACTIVATE
define('PAGE_EXCERPT', false);
define('ACF_OPTION_PAGE', true);
define('ADD_THUMBNAILS', false);
define('CUSTOM_POST_TYPE', true);
define('CUSTOM_TAXONOMY', true);
define('DISALLOW_FILE_EDIT', true);

// MAILS
/*
define('CONTACT_GENERAL', 'info@cler.org');

define('CONTACTS_ADHESION_1', 'lucile.krezel@cler.org');
define('CONTACTS_ADHESION_2','alexis.monteil@cler.org');
define('CONTACT_TEPOS', 'esther.bailleul@cler.org');

define('CONTACTS_PAIEMENT_1', 'radhia.berdaoui@cler.org');
define('CONTACTS_PAIEMENT_2','lucile.krezel@cler.org');

define('CONTACTS_EVENT_1','lucile.krezel@cler.org');
define('CONTACTS_EVENT_2','info@cler.org');

define('CONTACTS_EMPLOI_1', 'info@cler.org');
define('CONTACTS_EMPLOI_2', 'lucile.krezel@cler.org');

define('CONTACTS_CONCOURS', 'info@cler.org');

define('CONTACTS_FORMATION_1', 'info@cler.org');
*/

define('CONTACT_GENERAL', 'rollandyann@gmail.com');

define('CONTACTS_ADHESION_1', 'rollandyann@gmail.com');
define('CONTACTS_ADHESION_2','rollandyann@gmail.com');
define('CONTACT_TEPOS', 'rollandyann@gmail.com');

define('CONTACTS_PAIEMENT_1', 'rollandyann@gmail.com');
define('CONTACTS_PAIEMENT_2','rollandyann@gmail.com');

define('CONTACTS_EVENT_1','rollandyann@gmail.com');
define('CONTACTS_EVENT_2','rollandyann@gmail.com');

define('CONTACTS_EMPLOI_1', 'rollandyann@gmail.com');
define('CONTACTS_EMPLOI_2', 'rollandyann@gmail.com');

define('CONTACTS_CONCOURS', 'rollandyann@gmail.com');

define('CONTACTS_FORMATION_1', 'rollandyann@gmail.com');

/**
 * Custom post type & taxonomy
 */

if ( CUSTOM_POST_TYPE ) {
	// CPT : Offres d'emploi
	function cpts_offres_emploi() {
		$labels = array(
			'name' => __( 'Offres d\'emploi', '' ),
			'singular_name' => __( 'Offre d\'emploi', '' ),
			);

		$args = array(
			'label' => __( 'Offres d\'emploi', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'offres-emploi', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'offres-emploi', $args );

	}
	add_action( 'init', 'cpts_offres_emploi' );

	// CPT : Adhèrent
	function cpts_adherent() {
		$labels = array(
			'name' => __( 'Adhèrents', '' ),
			'singular_name' => __( 'Adhèrent', '' ),
			);

		$args = array(
			'label' => __( 'Adhèrents', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'le-reseau/les-adherents', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'page-attributes', 'author' ),
			'taxonomies' => array( 'post_tag' ),
		);
		register_post_type( 'adherents', $args );

	}
	add_action( 'init', 'cpts_adherent' );

	// Reçus
	function cpts_recus() {
		$labels = array(
			'name' => __( 'Reçus', '' ),
			'singular_name' => __( 'Reçu', '' ),
			);

		$args = array(
			'label' => __( 'Reçus', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'recus', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array(),
		);
		register_post_type( 'recus', $args );

	}
	add_action( 'init', 'cpts_recus' );



	// CPT : Événements
	function cpts_evenements() {
		$labels = array(
			'name' => __( 'Événements', '' ),
			'singular_name' => __( 'Événement', '' ),
			);

		$args = array(
			'label' => __( 'Événement', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'evenements', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'editor', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'evenements', $args );

	}
	add_action( 'init', 'cpts_evenements' );

	// CPT : Concours
	function cpts_concours() {
		$labels = array(
			'name' => __( 'Concours', '' ),
			'singular_name' => __( 'Concours', '' ),
			);

		$args = array(
			'label' => __( 'Concours', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'association/concours', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array(),
		);
		register_post_type( 'concours', $args );

	}
	add_action( 'init', 'cpts_concours' );

	// CPT : Webinaire
	function cpts_webinaires() {
		$labels = array(
			'name' => __( 'Webinaires', '' ),
			'singular_name' => __( 'Webinaire', '' ),
			);

		$args = array(
			'label' => __( 'Webinaire', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'webinaires', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'webinaires', $args );

	}
	add_action( 'init', 'cpts_webinaires' );

	// CPT : Formation
	function cpts_formations() {
		$labels = array(
			'name' => __( 'Formations', '' ),
			'singular_name' => __( 'Formation', '' ),
			);

		$args = array(
			'label' => __( 'Formation', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'formations', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'formations', $args );

	}
	add_action( 'init', 'cpts_formations' );

	// CPT : Portraits
	function cpts_portraits() {
		$labels = array(
			'name' => __( 'Portraits', '' ),
			'singular_name' => __( 'Portrait', '' ),
		);

		$args = array(
			'label' => __( 'Portrait', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'portraits', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'portraits', $args );
	}
	add_action( 'init', 'cpts_portraits' );

	// CPT : Retours d'expérience
	function cpts_retours() {
		$labels = array(
			'name' => __( 'Retours d\'expérience', '' ),
			'singular_name' => __( 'Retour d\'expérience', '' ),
		);

		$args = array(
			'label' => __( 'Retour d\'expérience', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'retours-experience', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'retours-experience', $args );
	}
	add_action( 'init', 'cpts_retours' );	

	// CPT : Équipes
	function cpts_equipes() {
		$labels = array(
			'name' => __( 'Équipes', '' ),
			'singular_name' => __( 'Équipe', '' ),
		);

		$args = array(
			'label' => __( 'Équipe', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'equipes', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'equipes', $args );
	}
	add_action( 'init', 'cpts_equipes' );

	fluxi_register_custom_taxo('publics-cible', 'Publics', 'post', true);
	fluxi_register_custom_taxo('public-cible', 'Publics', 'evenements', true);


	// CPT : Cartes
	function cpts_cartes() {
		$labels = array(
			'name' => __( 'Cartes', '' ),
			'singular_name' => __( 'Carte', '' ),
		);

		$args = array(
			'label' => __( 'Carte', '' ),
			'labels' => $labels,
			'description' => '',
			'public' => true,
			'show_ui' => true,
			'show_in_rest' => false,
			'rest_base' => '',
			'has_archive' => false,
			'show_in_menu' => true,
			'exclude_from_search' => false,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'carte-adherents', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category', 'post_tag' ),
		);
		register_post_type( 'cartes', $args );
	}
	add_action( 'init', 'cpts_cartes' );

}
if ( CUSTOM_TAXONOMY ) {
	//fluxi_register_custom_taxo('filtres', 'Filtres', array('offres-emploi'), false);
}


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

