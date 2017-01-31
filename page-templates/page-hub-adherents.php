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
			<h2 class="l-hero__subtitle">For many of us, our very first experience of learning about the celestial bodies begins when we saw our first full moon in the sky. It is truly a magnificent view even to the naked eye.</h2>

			<div class="adherents__main__links">
				<div class="h3 t-fw--700 mgBottom--s">Vous cherchez quelqu'un ?</div>
				<a href="#" class="c-link">Le C.A</a>
				<a href="#" class="c-link">L'équipe</a>
				<a href="#" class="c-link">Le réseau</a>
			</div>
		</div>
		
		<aside class="adherents__aside">
			<div class="adherents__aside__contact">
				<?php
					$contact = get_field('contact_referent');
					$contact_id = $contact[0];
					$descriptif_contact = get_field('descriptif_contact', false, false);	
					

					if( $contact ):			
						$photo = get_field('photo', $contact_id);

						$output = '<a href="mailto:'.get_field('mail_contact', $contact_id).'">';
						$output .= '<article class="c-card">';
						$output .= '<div class="c-card__header" style="background-image: url('.$photo['sizes']['thumbnail'].')"></div>';
						$output .= '<div class="c-card__body">';
						$output .= '<div class="c-card__body__meta"><span class="t-meta">'.$descriptif_contact.'</span></div>';
						$output .= '<h1 class="c-card__body__title">'.get_the_title($contact_id).'</h1>';
						$output .= '</div>';
						$output .= '<div class="c-card__footer"><span class="c-link c-link--more c-card__body__link">Contactez moi</span></div>';
						$output .= '</article>';
						$output .= '</a>';

						echo $output;
						
					endif;
				?>
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
						$dateformatstring = "d M";
						$unixtimestamp = strtotime(get_field('date_event'));
						$ville = get_field('ville');
						$title = get_the_title();

						$output = '<li class="eventList__item">';
						$output .= '<a href="'.$permalink.'">';
						$output .= '<article class="miniEvent">';
						$output .= '<h2 class="miniEvent__meta">'.date_i18n($dateformatstring, $unixtimestamp).'. à '.$ville.'</h2>';
						$output .= '<h1 class="miniEvent__title">'.$title.'</h1>';
						$output .= '</article>';
						$output .= '</a>';
						$output .= '</li>';

						echo $output;

					endwhile;
				else :
					echo '<p class="t-meta mgTop--s">Rien de prévu pour le moment...</p>';
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
		<?php get_template_part( 'page-templates-parts/sliders/adherents-actus' ); ?>
	</div>
</section>

<section>
<?php get_template_part( 'page-templates-parts/zone-telechargement' ); ?>
</section>

<?php get_footer(); ?>

