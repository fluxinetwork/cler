<?php
/**
 * The template part for displaying the content webinaire
 */
?>
<?php

	$user_firstname=$user_lastname=$user_email=$adherent_cler=$nom_structure='';
	if( is_user_logged_in() ):

		$current_user = wp_get_current_user();
		$user_firstname = $current_user->user_firstname;
		$user_lastname = $current_user->user_lastname;
		$user_email = $current_user->user_email;

		if( is_adherent_cler() ):
			$adherent_cler = '1';			
			$nom_structure = get_field('nom_structure', get_adherent_idp(), true); 
		endif;

	endif;

	$date_publi = get_the_date('d M Y');
	$date_webiniare = new DateTime(get_field('date_webinaire', false, false));
	$heure_webinaire = get_field('heure_webinaire');
	$themes = get_field('themes');
	$liste_themes = '';
	foreach ($themes as $theme) {
		$liste_themes .= $theme.', ';
	}
?>

<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-header no-pdBottom">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="c-meta">
				<div class="c-dash"></div>
				<span class="c-meta__meta">Publié le <?php echo $date_publi; ?></span>
			</div>

			<div class="offre-dashboard mgTop--m">
				<div class="offre-dashboard__tags">
					<span class="webinaire-meta"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i><?php echo $date_webiniare->format('j M Y'); ?></span>
					<span class="webinaire-meta"><i class="fa fa-clock-o c-meta__meta__icon" aria-hidden="true"></i><?php echo $heure_webinaire; ?></span>
					<a href="#inscription" class="c-btn webinaire-meta webinaire-meta--btn">Inscription</a>
				</div>
			</div>

			<?php
			if (get_field('add_image') == 1) {
				//$post_img_id = get_post_thumbnail_id();
				$post_img_id = get_field('main_image');

				if ($post_img_id) {
					$post_img_array = wp_get_attachment_image_src($post_img_id, 'large', true);
					$post_img_url = $post_img_array[0];	
					//$post_caption = get_post($post_img_id)->post_excerpt;

					$output = '<figure class="c-figure l-header__figure is-none">';
					$output .= ' <img src="'.$post_img_url.'" class="c-figure__img">';
					//$output .= ' <figcaption class="c-figure__caption">'.$post_caption.'</figcaption>';
					$output .= '</figure>';
					echo $output;
				}
			}
			?>

			<h2 class="l-header__excerpt"><?php echo get_field('fluxi_resum', false, false); ?></h2>

		</header>
	</div>
</article>

<section class="l-row bg-light" id="inscription">
	<div class="l-col l-col--content">
		<div class="c-form c-form--large c-card">
			<?php require_once( get_template_directory() . '/page-templates-parts/forms/form-webinaire.php' ); ?>
		</div>
	</div>
</section>


