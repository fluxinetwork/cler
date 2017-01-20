<?php
/**
 * The template part for displaying the content
 */
?>

<?php 	
	$date_publi = get_the_date('d M Y');
	$date_candidature = new DateTime( get_field( 'date_candidature', false, false ) );

	$nom = get_field('nom_structure');	
	$field = get_field_object('type_structure');
	$value = $field['value'];
	$type_structure = $field['choices'][ $value ];
	$site_internet_structure = get_field( 'site_internet_structure' );

	$ob_departement = get_field_object('field_574dab093c7b0');
	$label_departement = $ob_departement['choices'][ get_field('departement') ];
	$code_postal = get_field('code_postal');
	$numero_departement = substr($code_postal,0,-3);
	$ville = get_field('ville');

	$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
	$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

	$ob_experience = get_field_object('field_5773a4bc97554');
	$label_experience = $ob_experience['choices'][ get_field('experience') ];

	$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
	$ch_niveau_detude = $ob_niveau_detude['choices'];
	$val_niveau_detude = $ob_niveau_detude['value'];
	$label_niveau_detude = '';

	if( $val_niveau_detude ): 

		foreach( $val_niveau_detude as $v ):
		
			$label_niveau_detude .= '<span class="c-tag">'.$ch_niveau_detude[ $v ] .'</span>';
		
		endforeach;

	endif;

	$ob_modalite_candidature = get_field_object('field_576bdb28bb52a');
	$ch_modalite_candidature = $ob_modalite_candidature['choices'];
	$val_modalite_candidature = $ob_modalite_candidature['value'];	
?>


<article>

	<div class="l-row bg-accent--grad">
		<header class="l-col l-col--content pdBottom--m">
			<h1 class="c-white"><?php echo get_the_title(); ?></h1>

			<div class="c-meta c-meta--white">
				<div class="c-dash"></div>
				<span class="c-meta__meta">Publié le <?php echo $date_publi; ?></span>
			</div>
		</header>

		<div class="offre-dashboard l-col l-col--content no-pdTop">
			<div class="offre-dashboard__tags">
				<div class="offre-dashboard__zone__tags__tags">
					<div class="c-tag"><?php echo $label_type_de_poste; ?></div>
					<div class="c-tag"><?php echo $label_experience; ?></div>
					<?php echo $label_niveau_detude; ?>
				</div>
				<span class="offre-dashboard__zone__tags__limite"><i class="fa fa-clock-o c-meta__meta__icon" aria-hidden="true"></i>Postuler avant le <?php echo $date_candidature->format('j M Y'); ?></span>
			</div>
			<div class="offre-dashboard__id">
				<div class="offre-dashboard__id__who">
					<span class="t-meta"><i class="fa fa-cube c-meta__meta__icon" aria-hidden="true"></i><?php echo $type_structure; ?></span>
					<h3 class="c-card__body__title"><?php echo $nom; ?></h3>
					<?php if ($site_internet_structure) :
						echo '<a href="'.$site_internet_structure.'" class="c-link c-link--more mgTop--m" target="_blank">Voir le site internet</a>';
					endif ?>
				</div>
				<div class="offre-dashboard__id__where">
					<div class="offre-dashboard__id__where__nb"><?php echo $numero_departement; ?></div>
					<div class="offre-dashboard__id__where__txt">
						<div class="t-meta t-meta--dark"><i class="fa fa-map-marker c-meta__meta__icon" aria-hidden="true"></i><?php echo $ville; ?></div>
						<div class="t-meta t-meta--dark mgTop--xs"><i class="fa fa-location-arrow c-meta__meta__icon" aria-hidden="true"></i><?php echo $label_departement; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="l-row">
		<div class="l-col l-col--content fc">
			<h2>Qui nous sommes</h2>	
			<p>
				<?php echo get_field( 'descriptif_organisme' ); ?>
				<?php if($site_internet_structure) echo '<br><br>Plus d\'informations sur <a href="'.$site_internet_structure.'">notre site internet</a>.'; ?>
			</p>
			<h2>Missions</h2>		
			<p><?php echo get_field( 'missions' ); ?></p>

			<h2>Profil recherché</h2>		
			<p><?php echo get_field( 'profil_recherche' ); ?></p>
		</div>
	</div>

	<div class="l-row bg-light">
		<div class="l-col l-col--content fc">
			<h2 clas>Postulez avant le <?php echo $date_candidature->format('j M Y'); ?></h2>

			<?php
				if( $val_modalite_candidature ): 
					foreach( $val_modalite_candidature as $v ):
						if( $ch_modalite_candidature[ $v ] == 'Par courrier' ):	?>
							<p class="h5">
								<span class="t-meta t-meta--dark mgBottom--xs"><i class="fa fa-envelope c-meta__meta__icon" aria-hidden="true"></i><?php echo $ch_modalite_candidature[ $v ]; ?> :</span><br>
								<?php echo get_field( 'nom_structure' ); ?><br>
								<?php echo get_field( 'adresse' ); ?><br>		
								<?php echo get_field( 'code_postal' ); ?> 
								<?php echo get_field( 'ville' ); ?>
							</p>
						<?php elseif( $ch_modalite_candidature[ $v ] == 'Par mail' ):?>
							<p class="h5">
								<span class="t-meta t-meta--dark mgBottom--xs"><i class="fa fa-paper-plane c-meta__meta__icon" aria-hidden="true"></i><?php echo $ch_modalite_candidature[ $v ]; ?> :</span><br>
								<?php echo get_field( 'nom_prenom_contact' ); ?>, 
								<?php echo get_field( 'fonction_contact' ); ?><br>	
								<?php echo get_field( 'contact_email' ); ?> 			
							</p>
						<?php
						endif;
					endforeach;
				endif;
			?>
		</div>
	</div>
</article>





















