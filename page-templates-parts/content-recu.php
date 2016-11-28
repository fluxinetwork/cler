<?php
/**
 * The template part for displaying the content
 */
?>
<?php 
	$type_recu = get_field('type_recu');
	$statut_paiement = get_field('statut_paiement');

	if( $statut_paiement == 'failed' ):
		$statut_paiement = 'Paiement échoué';
	elseif( $statut_paiement == 'succeeded' ):
		$statut_paiement = 'Paiement validé';
	else:
		$statut_paiement = 'Paiement en attente de validation';
	endif;
?>
<article>

	<header><?php the_title( '<h1>', '</h1>' ); ?></header>


	<h2>Adresse de facturation</h2>
	<p><?php echo get_field('nom_structure'); ?><br>
	<?php echo get_field('adresse'); ?></p>

	<h2>Coordonnées</h2>
	<p><?php echo get_field('nom_prenom_contact'); ?><br>
	<?php echo get_field('contact_email'); ?><br>
	<?php echo get_field('telephone'); ?></p>

	<?php echo get_adresse_cler(); ?>


	<h2>Votre paiement : <?php echo get_field('n_transaction'); ?></h2>
	<p>Vous avez réglé la publication de votre offre d'emploi le <?php echo get_field('date_paiement'); ?> avec la carte bancaire "<?php echo get_field('derniers_chiffres'); ?>".</p>
	

	<table class="table">
		<tr>
			<td></td>
			<td><strong>Quantité</strong></td>
			<td><strong>Prix unitaire</strong></td>
		</tr>
		<tr>
			<td>Publication d'une offre d'emploi<br><em><?php echo get_the_title(); ?></em></td>
			<td>1</td>
			<td><?php echo get_field('montant'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td>TOTAL</td>
			<td><?php echo get_field('montant'); ?></td>
		</tr>
	</table>


</article>

