<?php
/**
 * The template part for displaying the content
 */
?>
<style type="text/css" media="print">
	.is-hide-print, .navBar, .l-footer, .l-navExtra, .js-print{
		display: none;
	}
	.is-none{
		display: block !important;
	}
	a{
		text-decoration: none;
		box-shadow:inherit !important;
	}
	.appel__contact{
		margin-top: 2rem;
	}
</style>

<?php
	$nom_structure = get_field('nom_structure');
	$adresse_structure = get_field('adresse_structure');	
	$date_creation = get_field('date_creation', false, false);
	$date_creation = new DateTime($date_creation);
	$annee_cotisation = get_field('annee_cotisation');
	$montant_cotisation = get_field('montant_cotisation');	
	$publication_id = get_field('publication', false, false);

	if(!empty($publication_id)){
		$publi_title = get_the_title($publication_id);
	}else{
		$publi_title = '';
	}

?>

<div class="l-row bg-light">
	<header class="l-col l-col--content">
		<?php the_title( '<h1>', '</h1>' ); ?>
		<h2 class="l-intro__excerpt"></h2>
	</header>
</div>

<section class="l-row">
	<div class="l-col l-col--content">
		<div class="fc">

			<h2>Montreuil, le <?= $date_creation->format('d/m/y'); ?></h2>

            <h3 class="t-fw--700"><strong>Destinataire :</strong><br>
            <?= $nom_structure; ?><br>
            <?= $adresse_structure; ?></h3>
            
            <p style="border:2px solid #000; padding:15px;font-family: qanelas,gotham,helvetica,arial,sans-serif;font-size: 2rem;margin-top: 6rem;">
              <strong style="background-color: #ccc;display: inline-block;width: 100%;text-align: center;font-size: 2.6rem;padding: 10px 20px;">APPEL A COTISATION <?= $annee_cotisation; ?></strong><br><br>

              <span style="display: inline-block; padding: 0 20px 20px 20px">Pour l'adhésion de <?= $nom_structure; ?> au CLER – Réseau pour la transition énergétique<sup>*</sup><br><br>

                      Montant de l'adhésion : <?= $montant_cotisation; ?>,00 €</span>
            </p>

            <p><small>* Association loi 1901 non assujettie à la TVA en application à l’article 223 septies du code général des impôts</small></p><br>
            <div class="appel__contact is-none"><?php echo get_footer_mail(); ?></div>

            <a href="javascript:window.print()" class="c-btn js-print mgTop--m">Imprimer l'appel</a>


		</di
	</div>
</section>
