<?php
/*
Template Name: Thématique	
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col thematique">
		<div class="thematique__content">
			<div class="thematique__content__txt">
				<h1 class="l-hero__title"><?php echo get_the_title(); ?></h1>
				<h2 class="l-hero__subtitle"><?php echo get_field('fluxi_resum', false, false); ?></h2>
			</div>
		
			<div class="thematique__content__extra">
				<div class="l-box thematique__content__extra__notions">
					<span class="t-meta">Notions clés</span>
					<p class="h5 mgTop--xs"><?php echo get_field('notions_cles'); ?></p>
				</div>

				<div class="l-box thematique__content__extra__chiffre">
					<span class="t-meta">Chiffre clé</span>
					<p class="h5 mgTop--xs"><?php echo get_field('chiffre_cle'); ?></p>
				</div>
			</div>
		</div>

		<div class="thematique__aside">
			<?php
				$portrait = get_field('portrait_referent');
				$id = $portrait[0];

				global $isMobile;
				($isMobile) ? $img_size = 'medium' : $img_size = 'thumbnail';
				$post_img_id = get_field('main_image', $id);
				$post_img_array = wp_get_attachment_image_src($post_img_id, $img_size, true);
				$post_img_url = $post_img_array[0];	
				
				$title = get_the_title($id);
				$permalink = get_permalink($id);
			?>
			<a href="<?php echo $permalink; ?>">
				<article class="c-card">
					<div class="c-card__header" style="background-image: url(<?php echo $post_img_url; ?>);"></div>
					<div class="c-card__body">
						<span class="t-meta">Portrait</span>
						<h1 class="c-card__body__title"><?php echo $title; ?></h1>
					</div>
					<div class="c-card__footer">
						<span class="c-link c-link--more">Lire la suite</span>
					</div>
				</article>
			</a>
		</div>
	</div>
</section>

<section class="l-row bg-main bg-main--grad">
	<div class="l-col">
		<?php get_template_part( 'page-templates-parts/sliders/thema-actus' ); ?>
	</div>
</section>

<?php if (get_field('liens_utiles')) : ?>
<section class="l-row">
	<div class="l-col t-align--c">
		<h2 class="c-section-title">Liens utiles</h2>
		<?php
		$liens = get_field('liens_utiles');
		foreach ($liens as $lien) {
			echo '<a href="'.$lien['url_lien'].'" class="c-link">'.$lien['texte_lien'].'</a>';
		}
		?>
	</div>
</section>
<?php endif; ?>

<section class="l-row bg-accent bg-accent--grad">
	<div class="l-col">
		<?php get_template_part( 'page-templates-parts/sliders/thema-offres' ); ?>
	</div>
</section>


<section>
	<?php get_template_part( 'page-templates-parts/downloads' ); ?>
</section>

<?php get_footer(); ?>

