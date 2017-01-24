<?php
/*
Template Name: Toutes les actualités	
*/
?>
<?php get_header(); ?>

<div class="l-row bg-main--grad">
	<header class="l-col l-col--content">
		<h1 class="c-white"><?php echo get_the_title(); ?></h1>
		<div class="c-meta">
			<div class="c-dash bg-white"></div>
			<span class="c-meta__meta c-white">Suivez nous sur</span><br>
			<a href="#" class="c-meta__meta"><i class="fa fa-facebook-square c-meta__meta__icon" aria-hidden="true"></i>Facebook</a>
			<a href="#" class="c-meta__meta"><i class="fa fa-twitter-square c-meta__meta__icon" aria-hidden="true"></i>Twitter</a>
		</div>
	</header>
</div>

<aside class="l-filterList l-filterList--small">
	<form id="form-auto-filter-posts" role="form" class="l-monoFilter">
	    <div class="l-filterList__filter">
	    	<label for="category" class="is-none">Thèmatique</label>
	    	<i class="fa fa-tag" aria-hidden="true"></i>
			<select name="category" id="category" data-validation="required" class="c-form__select">
				<option disabled selected value="">Thèmatique</option>
				<?php					
					$terms = get_terms( 'category', 'hide_empty=0' );
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){					   
					    foreach ( $terms as $term ) {					       
					        echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
					    }					    
					}
				?>
			</select>
	    </div>

		<input type="hidden" value="post" name="pt_slug">
		<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

		<?php wp_nonce_field( 'fluxi_auto_filter_posts', 'fluxi_auto_filter_posts_nonce_field' ); ?>

		<button type="submit" id="submit-filters" class="c-btn l-monoFilter__btn">Filtrer</button>
		<?php
		if ( isset( $_GET['toky_toky'] ) ) {
			echo '<button type="reset" class="c-btn c-btn--reset l-monoFilter__btn">Reset</button>';
		}
		?>

		<a href="<?php echo home_url(); ?>" class="c-link c-link--shy l-monoFilter__link">Abonnement newsletter</a>
	</form>
</aside>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<ul class="l-postList">
		<?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$args_filtered = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 2,
			'paged' => $paged
			// 'tax_query' => array(
			// 	array(
			// 		'taxonomy' => 'publics-cible',
			// 		'field'    => 'slug',
			// 		'terms'    => 'adherent',
			// 		'operator' => 'NOT IN'
			// 	),
			// )
		);
		$query_filtered = new WP_Query( $args_filtered );
		if ( $query_filtered->have_posts() ) :
			while ( $query_filtered->have_posts() ) :
				$query_filtered->the_post();

				$post_img_id = get_field('main_image');
				$post_img_array = wp_get_attachment_image_src($post_img_id, 'thumb', true);
				$post_img_url = $post_img_array[0];	

				$permalink = get_permalink();
				$date = get_the_date('d M Y');
				$categories = get_the_category();
				$cat_name = $categories[0]->cat_name;
				$title = get_the_title();

				$output = '<li class="l-postList__item">';
				$output .= '<a href="'.$permalink.'">';
				$output .= '<article class="c-newsH">';
				$output .= '<div class="c-newsH__img" style="background-image: url('.$post_img_url.')"></div>';
				$output .= '<div class="c-newsH__body">';
				$output .= '<h1 class="c-newsH__body__title">'.$title.'</h1>';
				$output .= '<div class="c-meta">';
				$output .= '<div class="c-dash"></div>';
				$output .= '<span class="c-meta__meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i>'.$date.'</span>';
				$output .= '<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$cat_name.'</span>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</article>';
				$output .= '</a>';
				$output .= '</li>';

				echo $output;

			endwhile;
		endif;
		wp_reset_postdata();
		?>
		</ul>

		<?php 
			echo '<div class="pagination">';
			echo paginate_links( array(
				'base' => @add_query_arg('paged','%#%'),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $query_filtered->max_num_pages,
	        	'prev_next'=> false
			) );
		    echo '</div>';
		?>
	</div>
</section>

<?php get_footer(); ?>

