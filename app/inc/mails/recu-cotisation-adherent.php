<?php
$footer_mail=
$montant_cotisation=
$today=
$nom_structure=
$adresse_structure=
$annee_cotisation=
$date_paiement=
$mode_paiement=
$num_mode_paiement='';

if ( $vars ) :   
    $footer_mail = $vars[0];
    $montant_cotisation = $vars[1];
    $today = $vars[2];
    $nom_structure = $vars[3];
    $adresse_structure = $vars[4];
    $annee_cotisation = $vars[5];
    $date_paiement = $vars[6];
    $mode_paiement = $vars[7];
    $num_mode_paiement = $vars[8];
endif;

if($mode_paiement=='cb'):
  $infos_paiement = 'par carte bancaire n°'.$num_mode_paiement;
else:
  $infos_paiement = 'par chéque n°'.$num_mode_paiement;
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Reçu de cotisation d\'adhésion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body bgcolor="#ffffff" style="margin:0;">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>         
            <p>            
              Montreuil, le '.$today.'<br><br>

              Destinataire :<br>
              '.$nom_structure.'<br>
              '.$adresse_structure.'
            </p>
           </td>
        </tr>

        <tr>
          <td>
            <p>Cher membre,<br><br>
            Nous avons reçu votre paiement pour votre adhésion ou ré-adhésion au CLER – Réseau pour la transition énergétique et nous vous en remercions. Votre adhésion ou ré-adhésion pour l\'année '.$annee_cotisation.' est désormais enregistrée. Vous trouverez ci-dessous le reçu de votre cotisation.</p>
          </td>
        </tr>

        <tr>
          <td>
            <p style="border:2px solid #000; padding:15px;">
              <strong>REÇU - appel à cotisation '.$annee_cotisation.' acquitté </strong><br><br>

              Pour l\'adhésion de '.$nom_structure.' au CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) acquitté le '.$today.' '.$infos_paiement.'. <br><br>

              Montant de l\'adhésion : '.$montant_cotisation.',00 €
            </p>
          </td>
        </tr>

        <tr>
          <td>
            <p>Nous avons le plaisir de vous compter parmi les membres adhérents de notre association. Dès à présent, vous pouvez :</p>
            <ul>
              <li>contribuer à construire l\'action et les propositions du réseau et diffuser nos propositions pour mettre en œuvre ensemble la transition énergétique aux niveaux local, national et européen</li>
              <li>recevoir notre revue trimestrielle CLER Infos</li>
              <li>échanger sur une liste de discussion modérée réunissant plus de 500 contributeurs professionnels</li>
              <li>avoir accès au plus grand centre de documentation français consacré à la transition énergétique ainsi qu’à sa revue de presse exhaustive sous format électronique : Doc&CLER</li>
              <li>publier gratuitement vos offres d’emplois sur le site Internet du CLER</li>
              <li>participer à nos événements : assemblée générale, formations, webinaires, salons, conférences et groupes de travail</li>
            </ul>
            <p>Pour toute question relative à votre adhésion, vous pouvez contacter Alexis Monteil au 01 55 86 80 09.</p>
          </td>
        </tr> 

        <tr>
          <td>
            '.$footer_mail.'
          </td>
        </tr> 

    </table>
</body>
</html>';
?>