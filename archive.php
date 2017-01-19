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

<aside class="c-filterList c-filterList--small">
	<form id="form-filter-posts" role="form">
	<div class="l-grid">
	    <div class="c-filterList__filter l-grid__col">
	    	<label for="departement" class="is-none">Département</label>
	    	<i class="fa fa-filter" aria-hidden="true"></i>
			<select name="departement" id="departement" data-validation="required" class="c-form__select">
				<option disabled selected value="">Département</option>
				<?php
					foreach ( load_departements_fields() as $key => $value ) {
		            	echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
			</select>
	    </div>
	</div>

		<input type="hidden" value="offres-emploi" name="pt_slug">
		<input type="hidden" value="<?php echo mt_rand(0,9999); ?>" name="toky_toky">

		<?php wp_nonce_field( 'fluxi_filter_posts', 'fluxi_filter_posts_nonce_field' ); ?>


		<div class="c-filterList__buttons">
			<a href="<?php echo home_url().'/mon-profil/gerer-offre-emploi/?act=add'; ?>" class="c-link c-link--shy">Abonnement newsletter</a>
			<div class="c-filterList__buttons__submit">
				<?php
				if ( isset( $_GET['toky_toky'] ) ) {
					echo '<button type="reset" class="c-btn c-btn--reset">Reset</button>';
				}
				?>
				<button type="submit" id="submit-filters" class="c-btn">Filtrer</button>
			</div>
		</div>

	</form>
</aside>

<section class="l-row">
	<div class="l-col l-col--content no-pdTop">
		<ul class="l-postList">
		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 20,
			// 'tax_query' => array(
			// 	array(
			// 		'taxonomy' => 'publics-cible',
			// 		'field'    => 'slug',
			// 		'terms'    => 'adherent',
			// 		'operator' => 'NOT IN'
			// 	),
			// )
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();

				$post_img_id = get_field('main_image');
				$post_img_array = wp_get_attachment_image_src($post_img_id, 'full', true);
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
	</div>
</section>

<?php get_footer(); ?>

