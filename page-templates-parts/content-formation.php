<article>
	<div class="l-row bg-light">
		<header class="l-col l-col--content l-intro">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="c-meta l-intro__meta">
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
				// ORGANISME
				$nom_centre = get_field('nom_centre');
				$ville_centre = get_field('ville');
				$code_postal_centre = get_field('code_postal');
				$adresse_centre = get_field('adresse');
				$telephone_centre = get_field('telephone');
				$mail_centre = get_field('contact_email');

				//FORMATION
				$ville_formation = get_field('adresse_formation');
				$ob_departement = get_field_object('field_574dab093c7b0');
				$label_departement_formation = $ob_departement['choices'][ get_field('departement') ];
				$numero_departement_formation = substr($ob_departement['value'], 12, 3);
				$duree_formation = get_field('type_duree_formation');
				$duree_formation = ($duree_formation=='longue') ? 'Formation longue' : 'Formation courte';
				$formateree = get_field('agrement_formateree');
				$link_formation = get_field( 'site_internet' );
			?>

			<div class="l-miniDashboard">

				<div class="l-miniDashboard__duo">
					<div class="l-miniDashboard__duo__left">
						<span class="t-meta mgBottom--xs">La formation</span>
						<div class="l-miniDashboard__duo__left__title">
							<h3 class="c-card__body__title"><?php echo $ville_formation; ?></h3>
							<h4 class="h5"><?php echo $label_departement_formation; ?></h4>
							<span class="t-meta"><i class="fa fa-arrows-h mgRight--xs"></i><?php echo $duree_formation; ?></span>
						</div>
						
						<?php if ($link_formation) : ?>
							<a href="<?php echo $link_formation; ?>" class="c-link c-link--more l-miniDashboard__duo__left__link" target="_blank">Site internet de la formation</a>
						<?php endif; ?>
					</div>
					<div class="l-miniDashboard__duo__right l-miniDashboard__duo__right--formation"> 
						<span class="t-meta mgBottom--xs">L'organisme de formation</span>
						<div class="l-miniDashboard__duo__left__title">
							<h3 class="c-card__body__title"><?php echo $nom_centre; ?></h3>
							<h4 class="h5"><?php echo $adresse_centre.'<br>'.$code_postal_centre.', '.$ville_centre; ?></h4>
							<span class="t-meta "><i class="fa fa-envelope mgRight--xs"></i><?php echo $mail_centre; ?></span><br>	
							<span class="t-meta"><i class="fa fa-phone mgRight--xs"></i><?php echo $telephone_centre; ?></span>
						</div>
					</div>
				</div>
			</div>

			<?php get_template_part( 'page-templates-parts/share' ); ?>
		</header>
	</div>
	
	<div class="l-row">
		<div class="l-col l-col--content fc">			
			<p><?php the_content(); ?></p>
		</div>
	</div>
</article>