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

	$date_webiniare = get_field('date_webinaire');
	$heure_webinaire = get_field('heure_webinaire');
	$themes = get_field('themes');
	$liste_themes = '';
	foreach ($themes as $theme) {
		$liste_themes .= $theme.', ';
	}
?>

<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-intro">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="l-miniDashboard ">
				<div class="l-miniDashboard__row">
					<span class="l-miniDashboard__row__element"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i><?php echo $date_webiniare; ?></span>
					<span class="l-miniDashboard__row__element"><i class="fa fa-clock-o c-meta__meta__icon" aria-hidden="true"></i><?php echo $heure_webinaire; ?></span>
					<a href="#inscription" class="l-miniDashboard__row__element l-miniDashboard__row__element--btn c-btn c-btn--ghost js-scroll-to"><i class="fa fa-user-plus" aria-hidden="true"></i>Inscription</a>
				</div>
			</div>

			<h2 class="l-intro__excerpt"><?php echo get_field('fluxi_resum', false, false); ?></h2>

			<?php get_template_part( 'page-templates-parts/share' ); ?>
		</header>
	</div>

	<section class="l-row bg-valid--grad" id="inscription">
		<div class="l-col l-col--content">
			<div class="c-form c-form--large c-card">
				<?php require_once( get_template_directory() . '/page-templates-parts/forms/form-webinaire.php' ); ?>
			</div>
		</div>
	</section>

</article>


