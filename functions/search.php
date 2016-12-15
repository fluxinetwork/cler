<?php

/* | Search - V1.0 - 14/12/16 |
--------------------------------
   | cf_search_join()   
   | cf_search_where()   
   | cf_search_distinct()   
*/

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

/**
 * This function modifies the main WordPress query to include an array of 
 * post types instead of the default 'post' post type.
 *
 * @param object $query  The original query.
 * @return object $query The amended query.
 */
function ex_cpt_search( $query ) {	
	
	if ( is_admin() || ! $query->is_main_query() )
    return;

	if ( $query->is_search ) {
			
		if (isset($_GET['cpt']) && !empty($_GET['cpt'])) {
		  	$query->set( 'post_type', array( $_GET['cpt'] ) );		  
		}else{			
			$query->set( 'post_type', array( 'post', 'page', 'offres-emploi', 'adherents', 'evenements', 'concours', 'webinaires', 'formations' ) );
		}		
		
		if (isset($_GET['cat']) && !empty($_GET['cat'])) {
			$query->set( 'cat', $_GET['cat'] );
		}
	
		return $query;
	}  
    
}
add_filter( 'pre_get_posts', 'ex_cpt_search' );

