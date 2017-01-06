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
?>

<section>
	<header><?php the_title( '<h1>', '</h1>' ); ?></header>

	<?php the_content(); ?>
</section>

<section class="l-row bg-light">
	<div class="l-col">
		<div class="c-form c-form--large c-card">
		
			<div class="c-card__header">
				<h1 class="c-card__header__title"><?php the_title(); ?></h1>
			</div>			

			<?php require_once( get_template_directory() . '/page-templates-parts/forms/form-webinaire.php' ); ?>

			<footer class="c-card__footer">
				<a href="#" class="c-link c-link--more">Contactez-nous</a>
			</footer>
		</div>
	</div>
</section>


