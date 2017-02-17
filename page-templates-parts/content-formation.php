<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-header">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="c-meta l-header__meta">
				<div class="c-dash"></div>
				<?php
				$formateree = get_field('agrement_formateree');
				if ($formateree == 'oui') : 
					echo '<span class="c-meta__meta"><i class="fa fa-check-circle c-meta__meta__icon" aria-hidden="true"></i>Agréé Format\'eree</span>';
				else :
					echo '<span class="c-meta__meta"><i class="fa fa-times-circle c-meta__meta__icon" aria-hidden="true"></i>Non agréé Format\'eree</span>';
				endif;
				?>
			</div>

			<?php
				$ville = get_field('adresse_formation');
				$adresse = get_field('adresse');
				$nom = get_field('nom_centre');

				$formateree = get_field('agrement_formateree');

				$ob_departement = get_field_object('field_574dab093c7b0');
				$label_departement = $ob_departement['choices'][ get_field('departement') ];
				$code_postal = get_field('code_postal');
				$numero_departement = substr($code_postal,0,-3);
				
				$link_formation = get_field( 'site_internet' );
			?>

			<div class="l-miniDashboard">

				<div class="l-miniDashboard__duo">
					<div class="l-miniDashboard__duo__left">
						<span class="t-meta"><i class="fa fa-id-card-o c-meta__meta__icon" aria-hidden="true"></i><?php echo $nom; ?></span>
						<h3 class="c-card__body__title l-miniDashboard__duo__left__title"><?php echo $adresse; ?></h3>
						<?php if ($link_formation) : ?>
							<a href="<?php echo $link_formation; ?>" class="c-link c-link--more l-miniDashboard__duo__left__link" target="_blank">Site internet de la formation</a>
						<?php endif; ?>
					</div>
					<div class="l-miniDashboard__duo__right">
						<div class="l-miniDashboard__duo__right__nb"><?php echo $numero_departement; ?></div>
						<div class="l-miniDashboard__duo__right__txt">
							<div class="t-meta t-meta--dark"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i><?php echo $ville; ?></div>
							<div class="t-meta t-meta--dark mgTop--xs"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i><?php echo $label_departement; ?></div>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>
	
	<div class="l-row">
		<div class="l-col l-col--content fc">			
			<p><?php the_content(); ?></p>
		</div>
	</div>
</article>