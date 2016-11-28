<?php 

	/**
	 * Wordpress snippets library
	 *
	 * #loop
	 * #wpquery 
	 * #thumbURL
	 * #searchfilter
	 */


	/**
	 * BEM notation
	 * #bemnotation
	 *	 
	 */
    
   	block__element--modifier
   	js-element-action

   	// Format numbers
	$nombre_format_francais = number_format($number, 2, ',', ' ');
	// 1 234,56

	/**
	 * The Loop
	 * #loop
	 */

	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post(); 
		endwhile;
	endif;


	/**
	 * WP Query
	 * #wpquery
	 *
	 * List of params https://codex.wordpress.org/Class_Reference/WP_Query
	 *
	 * WARNING : if "posts_per_page" param is not set Wordpress use reading preferences
	 */

	$args = array(
		'post_type' => 'post'
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
		endwhile;
	endif;
	wp_reset_postdata();


	/**
	 * Repeater field acf
	 * #acfrepeater	 	 
	 */

	if( have_rows('repeater_name') ):
		
	    while ( have_rows('repeater_name') ) : the_row();

	        the_sub_field('sub_field_name');

	    endwhile;

	else : // no rows found 
	endif;


	/**
	 * Get post thumbnail URL
	 * #thumbURL
	 */

	$post_img_id = get_post_thumbnail_id();
	$post_img_array = wp_get_attachment_image_src($post_img_id, 'full', true);
	$post_img_url = $post_img_array[0];	


	/**
	 * Filter search results
	 * #searchfilter
	 */

	function search_filter($query) {
	    if ($query->is_search && !is_admin() ) {
	        $query->set('post_type',array('post','page'));
	    }
	    return $query;
	}
	add_filter('pre_get_posts','search_filter');


	/**
	 * Get all key/value from $_POST
	 * #allformval
	 */

	foreach( $_POST as $cle=>$value ) { echo $cle."/".$value; }


	/**
	 * Get all post_tag from a post
	 * #alltags
	 */

	$getslugid = wp_get_post_terms( get_the_ID(), 'post_tag' );
						
	foreach( $getslugid as $thisslug ) {
		$message_response .= $thisslug->slug . ',';
	}	


	/**
	 * Count posts
	 * #countpost
	 */

	$count_pages = wp_count_posts('page');
	echo $count_pages->publish;
	$count_cpt = wp_count_posts('post_type');
	echo $count_pages->draft;

?>