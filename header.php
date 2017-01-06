<!DOCTYPE html>
<html lang="<?php echo get_locale() ?>">	
<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title><?php get_template_part( 'page-templates-parts/base/title'); ?></title>
	
	<script src="https://use.fontawesome.com/441df5285e.js"></script>
	<?php wp_head(); ?>
	
</head>

<?php include( TEMPLATEPATH.'/app/inc/bodyclass.php' ); ?>
<body <?php body_class($bodyclass); ?> >

	<div class="global">

		<?php get_template_part( 'page-templates-parts/base/nav'); ?>

		<main role="main" class="main">