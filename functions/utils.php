<?php

/* | Utils - V1.0 - 20/01/16 | 
--------------------------------
   | fluxi_register_post_type()
   | fluxi_register_custom_taxo()
   | notify_by_mail()
   | get_top_parent_page_id()
   | get_id_by_slug()
   | get_sanitize_string()
   | verify_post_author()
*/

/**
 * Create a custom post type
 */
function fluxi_register_post_type($post_type, $label_plural, $args, $feminin=false, $labels=array())
{
	// Verify if the post_type exist
	if (post_type_exists($post_type) === true) {
		return false;
	}

	// Singular post_type label
	$label = (isset($labels['singular_name'])) ? $labels['singular_name'] : substr($label_plural, 0, -1);

	// Default parameters
	$default_labels = array(
		'name' => $label_plural,
		'singular_name' => $label,
		'menu_name' => $label_plural,
		'all_items' => 'Liste',
		'add_new' => __('Ajouter'),
		'add_new_item' => 'Ajouter un nouveau '.strtolower($label),
		'edit_item' => 'Modifier un '.strtolower($label), // the edit item text. Default is Edit Post/Edit Page
		'new_item' => 'Nouveau '.strtolower($label),
		'view_item' => 'Voir',
		'search_items' => 'Chercher un '.strtolower($label),
		'not_found' => 'Aucun '.strtolower($label).' trouvé.',
		'not_found_in_trash' => 'Aucun '.strtolower($label).' trouvé dans la corbeille.', // the not found in trash text. Default is No posts found in Trash/No pages found in Trash
		//'parent_item_colon' => '', // the parent text. This string isn't used on non-hierarchical types. In hierarchical ones the default is Parent Page
	);

	// Feminin
	if($feminin !== false)
	{
		foreach($default_labels as $key => $val) {
			$default_labels[$key] = str_replace(array(' un ', ' nouveau', 'Nouveau ', 'Aucun ', ' trouvé'), array(' une ', ' nouvelle', 'Nouvelle ', 'Aucune ', ' trouvée'), $val);
		}
	}

	// Overwrite default label parameters
	foreach ($labels as $key => $val) {
		$default_labels[$key] = $val;
	}
	
	$default_args = array(
		'labels' => $default_labels,
		'public' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'rest_base' => '',		
		'show_in_menu' => true,		
		'capability_type' => 'post',		
		'hierarchical' => false,
		'rewrite' => array( 'slug' => $post_type, 'with_front' => true ),

		'query_var' => true,
		'supports' => array('title', 'editor', 'author'),

		'exclude_from_search' => false,
		'has_archive' => false,
		'map_meta_cap' => true,
		'taxonomies' => array('category','post_tag')
	);

	// Overwrite default parameters
	foreach ($args as $key => $val) {
		$default_args[$key] = $val;
	}

	// Register the post type
	return register_post_type($post_type, $default_args);
}

/**
 * Create a custom taxonomy
 */
function fluxi_register_custom_taxo($taxonomy, $label_plural, $post_type, $hierarchical=true)
{
	// Verify if the taxonomy exist
	if (taxonomy_exists($taxonomy) === true) {
		return false;
	}

	// Singular post_type label
	$label = (isset($labels['singular_name'])) ? $labels['singular_name'] : substr($label_plural, 0, -1);

	$default_labels = array(
		'name'              => _x( $label_plural, 'taxonomy general name' ),
		'singular_name'     => _x( $label, 'taxonomy singular name' ),
		'search_items'      => __( 'Chercher '.$label ),
		'all_items'         => __( 'Tout '.$label ),
		'parent_item'       => __( 'Parent '.$label ),
		'parent_item_colon' => __( 'Parent '.$label ),
		'edit_item'         => __( 'Editer '.$label ),
		'update_item'       => __( 'Mettre à jour '.$label ),
		'add_new_item'      => __( 'Ajouter nouveau '.$label ),
		'new_item_name'     => __( 'Nom du nouvel item' ),
		'menu_name'         => __( $label ),
	);

	$args = array(
		'hierarchical'      => $hierarchical,
		'labels'            => $default_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type' ),
	);

	return register_taxonomy( $taxonomy, $post_type, $args );
}


/**
 * Envoie du mail de notification
 * 
 * @param 	destinataires : array('mail@destinataire.com', 'mail@destinataire.com')
 * @param 	from : (string) : Ex : John Doe <contact@john-doe.com>
 * @param 	sujet : (string)
 * @param 	contenu html externe : false ou true
 * @param 	True : url vers le template mail / False : contenu (string)
 * @param 	variables : array
*/

function notify_by_mail ( $mail_to, $mail_from, $subject, $mode_content, $content_html, $vars ) {

	$multiple_to_recipients = $mail_to;
	$headers = 'From: '. $mail_from . "\r\n";
	$sujet_mail = $subject;

	$contenu_mail;

	if($mode_content==true):

		// contenu du mail dans page externe
		// le contenu du mail doit être définit par la var $contenu_mail dans la page externe.
		include ($content_html);

	else : $contenu_mail = $content_html;
	endif;

	add_filter( 'wp_mail_content_type', 'set_html_content_type_mail' );
	wp_mail( $multiple_to_recipients, $sujet_mail, $contenu_mail, $headers);
	remove_filter( 'wp_mail_content_type', 'set_html_content_type_mail' );
}

function set_html_content_type_mail() {
	return 'text/html';
}


/**
 * Get top parent page id
 *
 * @param   N/A
 *
 * return	int - top parent page ID
 */
function get_top_parent_page_id() {
	global $post;

	if ($post->ancestors) {
		return end($post->ancestors);
	} else {
		return $post->ID;
	}
}


/**
 * Get page id by slug
 *
 * @param   string - page slug
 *
 * return	int - page ID
 */

function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}


/**
 * Sanitize string
 *
 * @param   string - string to sanitize
 *
 * return	string - string sanitized
 */
function get_sanitize_string($string)
{
  	$string = strtolower($string);
  	$string = remove_accents($string);

  	$a = array('1°',  '°', '€', '@', '&', 'œ', '', '', '');
  	$b = array('1er', 'eme', 'euros', '-at-', '-and-', 'oe', '', '', '');
	$string = str_replace($a, $b, $string);

	// Remove accents 
	$string = strtr($string, '\'_/\;:,"#£§<>+.!?µ%*¨$^()[]{}`’=~²|«»¾–', '---------------------------------------');

	// Remove successive '-' 
  	$string = preg_replace('#\-+#', '-', $string);

  	// removes spaces at the beginning and end of string
  	$string = str_replace('-', ' ', $string);
  	$string = trim($string);
  	$string = str_replace(' ', '-', $string);

  return $string;
}

/**
 * Virify post author
 *
 * @param   integer $user_id user id
 * @param   integer $post_id
 *
 * return	boolean true/false
 */
function verify_post_author($user_id, $post_id){
	
	$is_post_author = false;
	$author_id = get_post_field ('post_author', $post_id);

	if($author_id == $user_id):
		$is_post_author = true;
	else:
		$is_post_author = false;
	endif;

	return $is_post_author;
}



/**
 * Determines if a post, identified by the specified ID, exist
 * within the WordPress database.
 * 
 * Note that this function uses the 'acme_' prefix to serve as an
 * example for how to use the function within a theme. If this were
 * to be within a class, then the prefix would not be necessary.
 *
 * @param    int    $id    The ID of the post to check
 * @return   bool          True if the post exists; otherwise, false.
 * @since    1.0.0
 */
function acme_post_exists( $id ) {
  return is_string( get_post_status( $id ) );
}


/**
 * Quick var_dump()
 */

function vardump($object) {
	echo '<pre>'.var_dump($object).'</pre>';
}

