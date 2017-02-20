<article>

	<div class="l-row bg-pattern-formateree">
		<header class="l-col l-col--content l-intro">
			<h1><?php echo get_the_title(); ?></h1>
			<div class="c-meta l-intro__meta">
				<div class="c-dash"></div>
				<?php
					echo '<span class="c-meta__meta"><i class="fa fa-graduation-cap c-meta__meta__icon" aria-hidden="true"></i>'.$nb_formations.' organismes de formation</span>';
				?>
			</div>
			<?php get_template_part( 'page-templates-parts/content', 'intro'); ?>
		</header>
	</div>
	
	<div class="l-row">
			<?php the_content(); ?>
	</div>

	<div class="l-row bg-light" id="contact">
		<div class="l-col l-col--content">
		<?php
			$contact = get_field('contact_referent');
			$contact_id = $contact[0];
			$descriptif_contact = get_field('descriptif_contact', false, false);					

			if( $contact ):			
				$photo = get_field('photo', $contact_id);
				global $isMobile;
				($isMobile) ? $img_size = 'thumb2x' : $img_size = 'thumbnail';

				$output = '<a href="mailto:'.get_field('mail_contact', $contact_id).'" class="c-newsH c-newsH--contact">';
				$output .= '<div class="c-newsH__img" style="background-image: url('.$photo['sizes'][$img_size].')"></div>';
				$output .= '<div class="c-newsH__body">';
				$output .= '<span class="c-newsH__body__meta">Contact</span>';
				$output .= '<h1 class="c-newsH__body__title">'.get_the_title($contact_id).'</h1>';
				$output .= '<p class="c-newsH__body__desc">'.$descriptif_contact.'</p>';
				$output .= '<span class="c-link c-link--more c-newsH__body__link">'.get_field('mail_contact', $contact_id).'</span>';
				$output .= '</div>';
				$output .= '</a>';

				echo $output;
				
			endif;
		?>
		</div>
	</div>

</article>


