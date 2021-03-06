<?php 
	$args_publications = array(
		'post_type' => array( 'offres-emploi', 'evenements', 'formations' ),
		'post_status' => array( 'pending', 'publish' ),
		'posts_per_page' => -1,
		'author' => get_current_user_id()
 	);
	$query_publications = new WP_Query( $args_publications );
?>


<div class="l-card-slider">
	<aside class="l-card-slider__aside">
		<div class="l-card-slider__aside__title"><span class="c-section-title">Gérer vos publications</span></div>

		<div class="l-card-slider__aside__link">
			<strong class="js-notify"></strong>
		</div>

		<?php get_template_part( 'page-templates-parts/sliders/follow' ); ?>
	</aside>

	<div class="l-card-slider__cards">
		<ul class="l-card-slider__cards__row">

			<?php if ( $query_publications->have_posts() ) : while ( $query_publications->have_posts() ) : $query_publications->the_post(); 

				$post_cpt = get_post_type( get_the_ID() );

				if( $post_cpt == 'offres-emploi'):
					$mod_post_url = get_the_permalink(FORM_OFFRE).'?act=mod&amp;idp='.get_the_ID();
					$cpt_label = 'Offre d\'emploi';
				elseif($post_cpt == 'evenements'):
					$mod_post_url = get_the_permalink(FORM_EVENT).'?act=mod&amp;idp='.get_the_ID();
					$cpt_label = 'Evénement';
				elseif($post_cpt == 'formations'):
					$mod_post_url = get_the_permalink(FORM_FORMATION).'?act=mod&amp;idp='.get_the_ID();
					$cpt_label = 'Formation';
				endif;
			?>

				<li class="l-card-slider__cards__row__col u-show@med">
					
					<article class="c-card c-card--emploi">
						<header class="c-card__header">
							<div class="c-card__header__tag"><a title="Modifier la publication" href="<?php echo $mod_post_url; ?>"><i class="fa fa-pencil" aria-hidden="true"></i>
</a></div>
							<div class="c-card__header__tag"><a title="Supprimer la publication" href="#" class="js-del-post" data-idp="<?php echo get_the_ID(); ?>" data-toky="<?php echo mt_rand(0,9999); ?>" data-title="<?php echo get_the_title (); ?>"><i class="fa fa-trash" aria-hidden="true"></i>
</a></div>
							<h5 class="c-card__header__cat"><?php echo $cpt_label; ?></h5>
						</header>
						<div class="c-card__body">
							<span class="t-meta"></span>
							<h1 class="c-card__body__title"><?php the_title(); ?></h1>
						</div>
						<footer class="c-card__footer">
							<a href="<?php echo get_the_permalink(get_the_ID()); ?>" target="_blank"><span class="c-link c-link--more">Voir la publication</span></a>
						</footer>
					</article>

				</li>

			<?php endwhile; endif; wp_reset_postdata(); ?>

			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="<?php echo get_the_permalink(FORM_OFFRE); ?>?act=add" class="c-ghostCard">
					<button class="c-btn c-btn--add"></button>
					<span class="c-link c-link--white">offre d'emploi</span>
					<span class="t-meta t-meta--white pdTop--s"><?php ($adherent) ? print('') : print('Payant'); ?></span>
				</a>
			</li>
			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="<?php echo get_the_permalink(FORM_EVENT); ?>?act=add" class="c-ghostCard">
					<button class="c-btn c-btn--add"></button>
					<span class="c-link c-link--white">évènement</span>
					<span class="t-meta t-meta--white pdTop--s">Gratuit</span>
				</a>
			</li>
			<li class="l-card-slider__cards__row__col u-show@med">
				<a href="<?php echo get_the_permalink(FORM_FORMATION); ?>?act=add" class="c-ghostCard">
					<button class="c-btn c-btn--add"></button>
					<span class="c-link c-link--white">formation</span>
					<span class="t-meta t-meta--white pdTop--s">Gratuit</span>
				</a>
			</li>
			
		</ul>
	</div>

	<?php get_template_part( 'page-templates-parts/sliders/controls' ); ?>
</div>
