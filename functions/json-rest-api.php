<?php

/**
 * Add ACF metabox to JSON REST API return
 *
 * 01. Put ACF fields slugs in $fields
 * 02. Optional : set the json node name to access data
 */

$fields[];
$node_name = 'acf';

if ( sizeof($fields) > 0 ) {
	function custom_json_api_prepare_post( $post_response, $post, $context, $node_name ) {
		$array[];
		foreach ($fields as $key => $field) {
			if ( get_field($field, $post['ID']) ) {
		 		array_push($array, get_field($field, $post['ID'], true));
		 	}
		}
		$post_response[$node_name] = $array;
	    return $post_response;
	}
	add_filter( 'json_prepare_post', 'custom_json_api_prepare_post', 10, 3 );
}
