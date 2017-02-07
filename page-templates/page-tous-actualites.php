<?php
/*
Template Name: Toutes les actualités
*/
?>
<?php get_header(); ?>
<?php
	
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	$page_title = get_the_title();
	$category_slug = '';
	$public_slug = '';	

	if( isset( $_GET['public'] ) && !empty( $_GET['public'] ) ):
		$public_slug = filter_var($_GET['public'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$args_filtered = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => $paged,
			'tax_query' => array(
				array(
			        'taxonomy' => 'publics-cible',
			        'field' => 'name',
			        'terms' => $public_slug
		        )
		    ),
		);
	else:
		if(isset( $_GET['cat'] ) && !empty( $_GET['cat'] )){
			$category_slug = filter_var($_GET['cat'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		}
		$args_filtered = array(
			'post_type' => 'post',
			'post_status' => 'publish',			
			'paged' => $paged,
			'category_name' => $category_slug
		);
	endif;

	if ( $public_slug == 'adherent' ):		$public_label = 'Blog de l\'association';
	elseif( $public_slug == 'presse' ):		$public_label = 'Communiqués de presse';
	elseif( $public_slug == 'elu' ):		$public_label = 'Élu, agissez !';
	elseif( $public_slug == 'citoyen' ):	$public_label = 'Citoyens, agissez !';
	else:									$public_label = 'Actualités';
	endif;

	$query_filtered = new WP_Query( $args_filtered );
?>

<div class="l-row bg-main--grad">
	<header class="l-col l-col--content">		

		<h1 class="c-white"><?php echo ( $public_slug != '' ? $public_label : $page_title ) ?></h1>
		
		<div class="c-meta">
			<div class="c-dash bg-white"></div>
			<span class="c-meta__meta c-white">Suivez nous sur</span><br>
			<a href="https://www.facebook.com/pages/CLER-R%C3%A9seau-pour-la-transition-%C3%A9nerg%C3%A9tique/437435406311054" class="c-meta__meta" target="_blank"><i class="fa fa-facebook-square c-meta__meta__icon" aria-hidden="true"></i>Facebook</a>
			<a href="https://twitter.com/assoCLER" class="c-meta__meta" target="_blank"><i class="fa fa-twitter-square c-meta__meta__icon" aria-hidden="true"></i>Twitter</a>
		</div>
	</header>
</div>

<?php if($public_slug == ''): ?>

	<aside class="l-filterList l-filterList--small">
		<form id="form-auto-filter-posts" role="form" class="l-monoFilter">
		    <div class="l-filterList__filter">
		    	<label for="category" class="is-none">Thématique</label>
		    	<i class="fa fa-tag" aria-hidden="true"></i>
				<select name="category" id="category" data-validation="required" class="c-form__select">
					<option disabled selected value="">Thématique</option>
					<?php
						$terms = get_terms( 'category', 'hide_empty=0' );
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						    foreach ( $terms as $term ) {
						        echo '<option value="'.$term->slug.'" '.( $category_slug == $term->slug ? 'selected' : '' ).'>'.$term->name.'</option>';
						    }
						}
					?>
				</select>
		    </div>

			<input type="hidden" value="post" name="pt_slug">
			<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">
			<?php wp_nonce_field( 'fluxi_auto_filter_posts', 'fluxi_auto_filter_posts_nonce_field' ); ?>
			
			<span class="js-loader"></span>
			<button type="button" class="c-btn c-btn--reset l-monoFilter__btn js-reload is-none">Reset</button>
			<a href="<?php echo home_url(); ?>" class="c-link c-link--shy l-monoFilter__link">Abonnement newsletter</a>
		</form>

	</aside>

<?php endif; ?>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<div class="js-notify"></div>		
		<ul class="l-postList">	
		<?php
		
		if ( $query_filtered->have_posts() ) :
			while ( $query_filtered->have_posts() ) :
				$query_filtered->the_post();

				$post_img_id = get_field('main_image');
				$post_img_array = wp_get_attachment_image_src($post_img_id, 'thumbnail', true);
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

		else:

			echo '<li><p class="mgTop--s"><strong>Il n\'y a pas d\'actualités dans cette catégorie pour le moment.</strong></p></li>';

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

