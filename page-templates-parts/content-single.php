<?php
/**
 * The template part for displaying the content
 */
?>

<article class="single">
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-col--pdL">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="single__header__meta">
				<div class="c-dash"></div>

				<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="t-meta t-meta--dark"><?php echo get_the_date(); ?></time> 

				<?php
					$categories = get_the_category();
					$cat_name = $categories[0]->name;
				?>
				<span><?php echo $cat_name; ?></span>
			</div>

			<?php
				$post_img_id = get_post_thumbnail_id();
				$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
				$post_img_url = $post_img_array[0];	
				$post_caption = get_post($post_img_id)->post_excerpt
			?>
			<figure class="single__header__figure c-figure">
			  <img src="<?php echo $post_img_url; ?>" class="c-figure__img">
			  <figcaption class="c-figure__caption"><?php echo $post_caption; ?></figcaption>
			</figure>

			<h2 class="single__header__excerpt"><?php echo get_the_excerpt(); ?></h2>

		</header>
	</div>
	
	<div class="single__body l-row">
		<div class="l-col">
		</div>
	</div>

	<?php //get_fluxi_content( get_the_id() ); ?>

	<?php //echo get_fluxi_fields( get_the_id() ); ?>

</article>


