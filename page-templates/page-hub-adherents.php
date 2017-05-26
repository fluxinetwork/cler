<?php
/*
Template Name: Hub adhérents		
*/
?>
<?php get_header(); ?>

<section class="l-row bg-light">
	<div class="l-col adherents">
		<div class="adherents__main">
			<h1 class="l-hero__title">espace adhérents</h1>
			<h2 class="l-hero__subtitle"><?php echo get_field('fluxi_resum', false, false);?></h2>

			<div class="adherents__main__links">
				<div class="h3 t-fw--700 mgBottom--s">Vous cherchez quelqu'un ?</div>
				<a href="<?php echo get_permalink(PAGE_CA); ?>" class="c-link">Le C.A</a>
				<a href="<?php echo get_permalink(PAGE_EQUIPE); ?>" class="c-link">L'équipe</a>
				<a href="<?php echo get_permalink(MAP_ADHERENT); ?>" class="c-link">Le réseau</a>
			</div>
		</div>
		
		<aside class="adherents__aside">
			<div class="adherents__aside__contact">
				<?php get_template_part( 'page-templates-parts/card','contact' ); ?>
			</div>

			<div class="adherents__aside__events">
				<div class="adherents__aside__events__title">Agenda</div>
				<ul class="eventList">
				<?php
				$args = array(
					'post_type' => 'evenements',
					'posts_per_page' => 3,
					'tax_query' => array(
						array(
							'taxonomy' => 'publics-cible',
							'field'    => 'slug',
							'terms'    => 'adherent',
							'operator' => 'IN'
						),
					)
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();

						$permalink = get_permalink();
						$ville = get_field('ville');
						$title = get_the_title();

						$output = '<li class="eventList__item">';
						$output .= '<a href="'.$permalink.'">';
						$output .= '<article class="miniEvent">';
						$output .= '<h2 class="miniEvent__meta"><i class="fa fa-calendar c-meta__meta__icon"></i>'.get_field('date_event').' <i class="fa fa-map-marker c-meta__meta__icon mgLeft--s"></i>'.$ville.'</h2>';
						$output .= '<h1 class="miniEvent__title">'.$title.'</h1>';
						$output .= '</article>';
						$output .= '</a>';
						$output .= '</li>';

						echo $output;

					endwhile;
				else :
					echo '<li><p class="mgTop--s"><strong>Rien de prévu pour le moment...</strong></p></li>';
				endif;
				wp_reset_postdata();
				?>
				</ul>
			</div>
		</aside>
	</div>
</section>

<section class="l-row bg-main bg-main--grad">
	<div class="l-col">
		<?php get_template_part( 'page-templates-parts/sliders/adherents','actus' ); ?>
	</div>
</section>

<section class="l-row bg-white">
	<?php
	if( is_user_logged_in() ):
		(is_adherent_cler()) ? $adherent = true : $adherent = false;
	else : 
		$adherent = false;
	endif;
	?>
	<div class="l-col l-col--content">
		<h2 class="c-section-title">Publier un contenu</h2>

		<ul class="l-grid list-reset">
			<li class="l-grid__col">
				<div class="user-postLink">
					<a href="<?php echo get_permalink(FORM_EVENT); ?>?act=add" class="c-btn c-btn--ghost"><i class="u-show@large fa fa-calendar"></i>Évènement</a>
					<span class="t-meta pdTop--s">Gratuit</span>
				</div>
			</li>
			<li class="l-grid__col">
				<div class="user-postLink">
					<a href="<?php echo get_permalink(FORM_OFFRE); ?>?act=add" class="c-btn c-btn--ghost"><i class="u-show@large fa fa-briefcase"></i>Offre <span class="u-show@xlarge">d'</span>emploi</a>
					<span class="t-meta pdTop--s"><?php ($adherent) ? print('Gratuit') : print('Payant'); ?></span>
				</div>
			</li>
			<li class="l-grid__col">
				<div class="user-postLink">
					<a href="<?php echo get_permalink(FORM_FORMATION); ?>?act=add" class="c-btn c-btn--ghost"><i class="u-show@large fa fa-graduation-cap"></i>Formation</a>
					<span class="t-meta pdTop--s">Gratuit</span>
				</div>
			</li>
		</ul>
	</div>
</section>

<section class="l-row">
<?php get_template_part( 'page-templates-parts/downloads' ); ?>
</section>

<?php get_footer(); ?>

