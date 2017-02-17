<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-header">
			<time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="t-meta l-header__date is-none"><?php echo get_the_date(); ?></time> 
			<h1><?php echo get_the_title(); ?></h1>

			<div class="c-meta l-header__meta">
				<div class="c-dash"></div>
			</div>

			<?php
				$date = get_field('date_event');

				$ville = get_field('ville');
				$internet = (substr($ville,-3) == 'net') ? true : false;
				$adresse = get_field('adresse');

				$ob_departement = get_field_object('field_574dab093c7b0');
				$label_departement = $ob_departement['choices'][ get_field('departement') ];
				$code_postal = get_field('code_postal');
				$numero_departement = substr($code_postal,0,-3);
				
				$link_event = get_field( 'link_event' );

				$publics = get_field('publics_event');
				$first_public = true;
				foreach ($publics as $public) {
					($first_public) ? $publics = $public : $publics .= ' & '.$public;
					$first_public = false;
				}
			?>

			<div class="l-miniDashboard">
				<div class="l-miniDashboard__row">
					<span class="l-miniDashboard__row__element"><i class="fa fa-calendar c-meta__meta__icon" aria-hidden="true"></i><?php echo $date; ?></span>
					<?php if ($internet) : ?>
						<span class="l-miniDashboard__row__element"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i>Sur Internet</span>
					<?php endif; ?>
					<span class="l-miniDashboard__row__element"><i class="fa fa-users c-meta__meta__icon" aria-hidden="true"></i><?php echo $publics; ?></span>
				</div>

				<?php if (!$internet) : ?>
				<div class="l-miniDashboard__duo">
					<div class="l-miniDashboard__duo__left">
						<span class="t-meta">Adresse</span>
						<h3 class="c-card__body__title l-miniDashboard__duo__left__title"><?php echo $adresse; ?></h3>
						<?php if ($link_event) : ?>
							<a href="<?php echo $link_event; ?>" class="c-link c-link--more l-miniDashboard__duo__left__link" target="_blank">Site internet de l'évènement</a>
						<?php endif; ?>
					</div>
					<div class="l-miniDashboard__duo__right">
						<div class="l-miniDashboard__duo__right__nb"><?php echo $numero_departement; ?></div>
						<div class="l-miniDashboard__duo__right__txt">
							<div class="t-meta t-meta--dark"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i><?php echo $ville; ?></div>
							<?php if ($ville != 'Paris') : ?>
								<div class="t-meta t-meta--dark mgTop--xs"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i><?php echo $label_departement; ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</header>
	</div>
	
	<div class="l-row">
		<div class="l-col l-col--content fc">			
			<?php the_content(); ?>
		</div>
	</div>
</article>