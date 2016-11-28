<?php
/**
 * The template part for displaying the content
 */
?>

<article>

	<header><?php the_title( '<h1>', '</h1>' ); ?></header>

	<?php the_content(); ?>

	<?php //get_fluxi_content( get_the_id() ); ?>

	<?php //echo get_fluxi_fields( get_the_id() ); ?>

</article>


