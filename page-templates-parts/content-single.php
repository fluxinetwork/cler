<?php
/**
 * The template part for displaying the content
 */
?>

<article class="single">
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-col--pdL l-header l-header--single">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="l-header__meta">
				<div class="c-dash"></div>

				<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="t-meta"><?php echo get_the_date(); ?></time> 

				<?php
					$categories = get_the_category();
					$cat_name = $categories[0]->name;
				?>
				<span class="c-tag"><?php echo $cat_name; ?></span>
			</div>

			<?php
			if (get_field('add_image') == 1) {
				//$post_img_id = get_post_thumbnail_id();
				$post_img_id = get_field('main_image');

				if ($post_img_id) {
					$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
					$post_img_url = $post_img_array[0];	
					$post_caption = get_post($post_img_id)->post_excerpt;

					$output = '<figure class="c-figure">';
					$output .= ' <img src="'.$post_img_url.'" class="c-figure__img">';
					$output .= ' <figcaption class="c-figure__caption">'.$post_caption.'</figcaption>';
					$output .= '</figure>';
					echo $output;
				}
			}
			?>

			<h2 class="l-header__excerpt"><?php echo get_field('fluxi_resum', false, false); ?></h2>

		</header>
	</div>
	
	<div class="l-row">
		<div class="l-col l-col--content">
			<?php the_content(); ?>
		</div>
	</div>
</article>


