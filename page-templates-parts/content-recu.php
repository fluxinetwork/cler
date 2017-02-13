<?php
/**
 * The template part for displaying the content
 */
?>
<style type="text/css" media="print">
	.is-hide-print, .wrap-navBar{
		display: none;
	}
	.is-none{
		display: block !important;
	}
	a{
		text-decoration: none;
		box-shadow:inherit !important;
	}
	.recu__contact{
		margin-top: 2rem;
	}
</style>

<?php 
	$type_recu = get_field('type_recu');
	$statut_paiement = get_field('statut_paiement');
	$message = '';
	$recu = '';

	if( $statut_paiement == 'failed' ):
		$message = '<p class="mgTop--s font-subh"><strong>Votre paiement a échoué.<br>Veuillez suivre la procédure de paiement ou <a href="'.get_the_permalink(CONTACT).'">nous contacter</a>.</strong></p>';
	elseif( $statut_paiement == 'succeeded' ):

		$nom_structure = get_field('nom_structure');
		$adresse_structure = get_field('adresse');				
		$nom_prenom_contact = get_field('nom_prenom_contact');
		$contact_email = get_field('contact_email');
		$telephone = get_field('telephone');
		$n_transaction = get_field('n_transaction');
		$date_paiement = get_field('date_paiement');
		$derniers_chiffres = get_field('derniers_chiffres');
		$montant = get_field('montant');
		$mode_paiement = get_field('mode_paiement');
		$publication_id = get_field('publication', false, false);

		if(!empty($publication_id)){
			$publi_title = get_the_title($publication_id);
		}else{
			$publi_title = '';
		}

		if( $mode_paiement == 'cb' ){
			$infos_paiement = ' par carte bancaire n° '.get_field('derniers_chiffres').'.';
		}elseif($mode_paiement == 'cheque'){
			$infos_paiement = ' par chèque n° '.get_field('num_cheque').'.';
		}else{
			$infos_paiement = '.';
		}

		if( $type_recu == 'recu_adhesion' ): 
			$annee_cotisation = get_field('annee_cotisation');

			$recu = '                       
			<h2>Montreuil le '.$date_paiement.',</h2>

			<h3 class="t-fw--700"><strong>Destinataire :</strong> '.$nom_structure.', '.$adresse_structure.'</h3>						
			
			<p style="border:2px solid #000; padding:15px;">
			  <strong>REÇU - appel à cotisation '.$annee_cotisation.' acquitté </strong><br><br>

			  Pour l\'adhésion de '.$nom_structure.' au CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) acquitté le '.$date_paiement.''.$infos_paiement.' <br><br>

			  Montant de l\'adhésion : '.$montant.',00 €
			</p>

			<div class="is-hide-print">

				<a href="javascript:window.print()" class="c-btn js-print">Imprimer le reçu</a>

				<h2>Cher membre</h2>
				
				<p>Nous avons reçu votre paiement pour votre adhésion ou ré-adhésion au CLER – Réseau pour la transition énergétique et nous vous en remercions. Votre adhésion ou ré-adhésion pour l\'année '.$annee_cotisation.' est désormais enregistrée. Vous trouverez ci-dessous le reçu de votre cotisation.</p>			

				<h3 class="t-fw--700">Nous avons le plaisir de vous compter parmi les membres adhérents de notre association.</h3>
				<h3 class="t-fw--700">Dès à présent, vous pouvez :</h3>

				<ul class="c-list">
				  <li class="c-list__item">contribuer à construire l\'action et les propositions du réseau et diffuser nos propositions pour mettre en œuvre ensemble la transition énergétique aux niveaux local, national et européen</li>
				  <li class="c-list__item">recevoir notre revue trimestrielle CLER Infos</li>
				  <li class="c-list__item">échanger sur une liste de discussion modérée réunissant plus de 500 contributeurs professionnels</li>
				  <li class="c-list__item">avoir accès au plus grand centre de documentation français consacré à la transition énergétique ainsi qu’à sa revue de presse exhaustive sous format électronique : Doc&CLER</li>
				  <li class="c-list__item">publier gratuitement vos offres d\'emplois sur le site Internet du CLER</li>
				  <li class="c-list__item">participer à nos événements : assemblée générale, formations, webinaires, salons, conférences et groupes de travail</li>
				</ul>

				<p>Pour toute question relative à votre adhésion, vous pouvez contacter Alexis Monteil au 01 55 86 80 09.</p>

			</div>
			<div class="recu__contact is-none">'.get_footer_mail().'</div>';


		elseif( $type_recu == 'recu_emploi' ):

			$recu = '<h2>Montreuil, le '.$today.'</h2>

                  <h3 class="t-fw--700"><strong>Destinataire :</strong><br>
                  '.$nom_structure.'<br>
                  '.$adresse_structure.'</h3>
                
                  <h3>Cher membre</h3>
                  <p>Nous avons reçu votre paiement pour la publication de votre offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique et nous vous en remercions.</p>
                
                  <p style="border:2px solid #000; padding:15px;">
                    <strong>REÇU - publication d\'une offre d\'emploi acquitté </strong><br><br>

                    Pour la publication "'.$publi_title.'" sur le site du CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) acquitté le '.$date_paiement.''.$infos_paiement.' <br><br>

                    Montant : '.$montant.',00 €
                  </p>
                  <div class="recu__contact is-none">'.get_footer_mail().'</div>';
		
		endif;	
	
	
	else:
		$message = '<p class="mgTop--s font-subh"><strong>Votre paiement est en attente de validation.<br>Veuillez suivre la procédure de paiement ou <a href="'.get_the_permalink(CONTACT).'">nous contacter</a>.</strong></p>';
	endif;
	
?>

<div class="l-row bg-light">
	<header class="l-col l-col--content">
		<?php the_title( '<h1>', '</h1>' ); ?>
		<h2 class="l-header__excerpt"><?php echo $message; ?></h2>
	</header>
</div>

<section class="l-row">
	<div class="l-col l-col--content">
		<div class="fc">
			<?php echo $recu; ?>
		</div>
	</div>
</section>
