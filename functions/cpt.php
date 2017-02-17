<?php
/**
 * Custom post type & taxonomy
 */

// ACTIVATE
define('CUSTOM_POST_TYPE', true);
define('CUSTOM_TAXONOMY', true);

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
			'rewrite' => array( 'slug' => 'outils/offres-emploi', 'with_front' => true ),
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
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'le-reseau/adherents', 'with_front' => true ),
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
			'rewrite' => array( 'slug' => 'rendez-vous/evenements', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'post_tag' ),
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
			'rewrite' => array( 'slug' => 'association/concour', 'with_front' => true ),
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
			'rewrite' => array( 'slug' => 'rendez-vous/webinaires', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category' ),
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
			'rewrite' => array( 'slug' => 'outils/formations', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'post_tag' ),
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
			'rewrite' => array( 'slug' => 'le-reseau/portraits', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category' ),
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
			'rewrite' => array( 'slug' => 'le-reseau/retours-experience', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'category' ),
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
			'taxonomies' => array( ),
		);
		register_post_type( 'equipes', $args );
	}
	add_action( 'init', 'cpts_equipes' );	


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
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'carte-adherents', 'with_front' => true ),
			'query_var' => true,

			'supports' => array( 'title', 'author' ),
			'taxonomies' => array( 'post_tag' ),
		);
		register_post_type( 'cartes', $args );
	}
	add_action( 'init', 'cpts_cartes' );

}

if ( CUSTOM_TAXONOMY ) {
	fluxi_register_custom_taxo('publics-cible', 'Publics', array('post', 'evenements', 'page'), true);
}

