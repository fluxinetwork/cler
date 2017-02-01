<?php
/*
Template Name: Confirmation de compte utilisateur
*/
?>
<?php get_header(); ?>


  <article>
	<header>
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>	

	<?php 
		confirm_user_registration ();
	?> 	

</article>


<?php get_footer(); ?>
