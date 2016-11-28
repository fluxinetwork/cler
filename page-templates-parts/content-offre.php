<?php
/**
 * The template part for displaying the content
 */
?>

<?php 	

	$site_internet_structure = get_field( 'site_internet_structure' );

	$ob_type_de_poste = get_field_object('field_574dadcc3c7b1');
	$label_type_de_poste = $ob_type_de_poste['choices'][ get_field('type_de_poste') ];

	$ob_departement = get_field_object('field_574dab093c7b0');
	$label_departement = $ob_departement['choices'][ get_field('departement') ];

	$numero_departement = explode('_', get_field('departement'));

	$date_candidature = new DateTime( get_field( 'date_candidature', false, false ) );

	$ob_niveau_detude = get_field_object('field_574dae0e3c7b2');
	$ch_niveau_detude = $ob_niveau_detude['choices'];
	$val_niveau_detude = $ob_niveau_detude['value'];
	$label_niveau_detude = '';

	if( $val_niveau_detude ): 

		foreach( $val_niveau_detude as $v ):
		
			$label_niveau_detude .= '<span class="tag">'.$ch_niveau_detude[ $v ] .'</span>';
		
		endforeach;

	endif;

	$ob_modalite_candidature = get_field_object('field_576bdb28bb52a');
	$ch_modalite_candidature = $ob_modalite_candidature['choices'];
	$val_modalite_candidature = $ob_modalite_candidature['value'];	

?>


<article>

	<header>
		<h1><?php the_title(); ?> - <small><?php echo $label_departement.' ('.$numero_departement[1].')'; ?></small></h1>
		
		<span class="tag first"><?php echo $label_type_de_poste; ?></span><?php echo $label_niveau_detude; ?>
	</header>

	<div class="main-col">

		<h2>Notre <?php echo get_field('type_structure'); ?></h2>		
		<p>
			<?php echo get_field( 'descriptif_organisme' ); ?>
			<?php if($site_internet_structure) echo '<br><br>Plus d\'informations sur <a href="'.$site_internet_structure.'">notre site internet</a>.'; ?>
		</p>
		
		
		<h2>Missions</h2>		
		<p><?php echo get_field( 'missions' ); ?></p>

		<h2>Profil recherché</h2>		
		<p><?php echo get_field( 'profil_recherche' ); ?></p>

	</div>

	<aside class="sidebar">	

		<h3>Envoyez votre candidature avant le <?php echo $date_candidature->format('j M Y'); ?></h3>

		<?php
			if( $val_modalite_candidature ): 
				foreach( $val_modalite_candidature as $v ):
					if( $ch_modalite_candidature[ $v ] == 'Par courrier' ):	?>
						<p>
							<strong><?php echo $ch_modalite_candidature[ $v ]; ?> :</strong><br>
							<?php echo get_field( 'nom_structure' ); ?><br>
							<?php echo get_field( 'adresse' ); ?><br>		
							<?php echo get_field( 'code_postal' ); ?> 
							<?php echo get_field( 'ville' ); ?>
						</p>
					<?php elseif( $ch_modalite_candidature[ $v ] == 'Par mail' ):?>
						<p>
							<strong><?php echo $ch_modalite_candidature[ $v ]; ?> :</strong><br>
							<?php echo get_field( 'nom_prenom_contact' ); ?>, 
							<?php echo get_field( 'fonction_contact' ); ?><br>	
							<?php echo get_field( 'contact_email' ); ?> 			
						</p>
					<?php
					endif;
				endforeach;
			endif;
		?>
	</aside>
	

</article>





















