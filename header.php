<!DOCTYPE html>
<html lang="<?php echo get_locale() ?>">	
<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="<?php if ( is_front_page() ) :
		bloginfo('description');
	else:
		if( !empty(get_field('fluxi_resum', false, false)) ):
			echo esc_attr(get_field('fluxi_resum', false, false));
		else:
			bloginfo('description');
		endif;
	endif;?>"> 

	<title><?php get_template_part( 'page-templates-parts/base/title'); ?></title>
	
	<link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url'); ?>/app/img/favicon.png" /> 
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
	<script src="https://use.fontawesome.com/441df5285e.js"></script>
	<?php wp_head(); ?>
	
</head>

<?php include( TEMPLATEPATH.'/app/inc/bodyclass.php' ); ?>
<body <?php body_class($bodyclass); ?> >

	<div class="global">

		<?php 
		if (is_page_template('page-templates/page-formateree.php')) :
			get_template_part('page-templates-parts/base/nav-formateree');
		else :
			get_template_part('page-templates-parts/base/nav');
		endif;
		?>

		<main role="main" class="main">