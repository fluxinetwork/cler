<?php
/*
Template Name: Formateree
*/
?>
<?php get_header(); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$nb_formations = '';
		$args_adherents = array(
			'post_type' => 'cartes',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_key' => 'type_structure',
			'meta_value' => 'formation'
		);

	    $query_adherents = new WP_Query($args_adherents);
	    if ($query_adherents -> have_posts()) :
	    	while ($query_adherents -> have_posts()) : $query_adherents -> the_post();
	    		$nb_formations = $query_adherents->post_count;
	    	endwhile;
	    else:
	    	$nb_formations = '0';
	    endif;
	    wp_reset_postdata();

	    include(locate_template('page-templates-parts/content-formateree.php'));
	endwhile;
else:
	get_template_part( 'page-templates-parts/content', 'none' );
endif;
?>

<?php get_footer(); ?>