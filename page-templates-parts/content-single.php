<?php
/**
 * The template part for displaying the content
 */
?>

<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-header">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="t-meta l-header__date"><?php echo get_the_date(); ?></time> 
			<h1><?php echo get_the_title(); ?></h1>

			<div class="c-meta l-header__meta">
				<div class="c-dash"></div>
				<?php				
				$categories = get_the_category();
				if(! empty( $categories )):
					$cat_name = '';
					$cat_count = 0;
					foreach( $categories as $category ) {
						$cat_count++;
						// Limit
						if( $cat_count < 4 )		
				        $cat_name .= ($cat_count > 1 ? ', ' : '').esc_html( $category->name );
				    }
					echo '<span class="c-meta__meta"><i class="fa fa-bookmark c-meta__meta__icon" aria-hidden="true"></i>'.$cat_name.'</span>';
				endif;
				?>
			</div>

			<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
		</header>
	</div>
	
	<div class="l-row">
		<div class="l-col l-col--content">
			<?php the_content(); ?>
		</div>
	</div>
</article>

<section class="l-row bg-main--grad">
	<div class="l-col">
		<?php get_template_part( 'page-templates-parts/sliders/hp-actus' ); ?>
	</div>
</section>


