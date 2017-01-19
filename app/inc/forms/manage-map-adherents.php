<?php
/**
 * Load JSON for Google map
 * Must active admin-ajax.php in scripts.php
 */
function get_json_map(){

	// Global array
    $results = array();
    // Count
    $nb_items = 0;

	// Query parameters
	$suppress_filters = true;
    $post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : 'cartes';
	$posts_per_page = (isset($_POST["posts_per_page"])) ? $_POST["posts_per_page"] : -1;
	$post_status = (isset($_POST["post_status"])) ? $_POST["post_status"] : 'publish';

	$tag = (isset($_POST["tag"])) ? $_POST["tag"] : 'all_cat';

	// Query params for adherents
	if($post_type == 'cartes'):

		/*if($tag=='all_cat'):
			$tag = get_terms( 'type_structure', array(
				'hide_empty' => 0,
				'fields' => 'id=>slug'
			) );
		endif;*/

		$args = array(
			'suppress_filters' => $suppress_filters,
			'post_type' => $post_type,
			'posts_per_page' => $posts_per_page,
			'post_status' => $post_status/*,
			'tax_query' => array(
				array(
					'taxonomy' => 'type_structure',
					'field'    => 'slug',
					'terms'    => $tag,
				)
			)*/
		);
	endif; // End query params for adherents

    $loop = new WP_Query($args);

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
		// Count
		$nb_items++;

		// Query respons for projects
		if($post_type == 'cartes'):

			// Taxo Slug
			$field_type_s = get_field_object('type_structure');
			$value_type_s = get_field('type_structure');
			$label_type_s = $field_type_s['choices'][ $value_type_s ];
			$taxoslug = $value_type_s;
			$taxoname = $label_type_s;
			// Location
			$location = get_field('localisation');
			if( !empty($location) ){
				$latitude = $location['lat'];
				$longitude = $location['lng'];
			}
			$ville_s = get_field('ville');
			$code_postal = get_field('code_postal');
			$departement_s = substr($code_postal,0,-3);

			$data = array(
				'postType' => $post_type,
				'title' => get_field('nom_structure'),
				'permalink' => get_the_permalink(),
				'latitude' => $latitude,
				'longitude' => $longitude,
				'catSlug' => $taxoslug,
				'catName' => $taxoname,
				'departement' => $departement_s,
				'ville' => $ville_s
			);
		endif; // End query respons for projects

		// Push data to global array
		$results[] = $data;

    endwhile; endif;

	// Output JSON
	wp_send_json($results);

    wp_reset_postdata();
}

add_action('wp_ajax_nopriv_get_json_map', 'get_json_map');
add_action('wp_ajax_get_json_map', 'get_json_map');

