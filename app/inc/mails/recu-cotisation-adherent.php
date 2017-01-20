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
<body style="background-color: #fff5e5; color: #333; margin:0; font-family: gotham,helvetica,arial,sans-serif; font-size: 16px;">
  <table width="100%" style="background-color: #fff5e5; color: #333; font-family: gotham,helvetica,arial,sans-serif; font-size: 16px; text-align:center; margin:0; padding:0;" border="0" cellpadding="0" cellspacing="0">
    <tr style="margin:0;padding:0;">
      <td style="margin:0;padding:0;">
        <table style="text-align:center; max-width:600px; width:100%;margin:0 auto 40px;padding:20px;" border="0" cellpadding="0" cellspacing="0">
          <tr style="margin:0;padding:0;">
            <td style="margin:0;padding:0;">
              <table width="100%" style="text-align:left; margin:20px 0;" border="0" cellpadding="0" cellspacing="0">
                <tr style="margin:0;padding:0;">
                  <td style="background: #fff; padding:20px 30px 30px;">
                       
                    <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Montreuil, le '.$today.'</h3>

                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;"><strong>Destinataire :</strong><br>
                    '.$nom_structure.'<br>
                    '.$adresse_structure.'</p>

                    <hr style="border:1px dashed #ccc">

                    <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Cher membre</h3>
           
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Nous avons reçu votre paiement pour votre adhésion ou ré-adhésion au CLER – Réseau pour la transition énergétique et nous vous en remercions. Votre adhésion ou ré-adhésion pour l\'année '.$annee_cotisation.' est désormais enregistrée. Vous trouverez ci-dessous le reçu de votre cotisation.</p>
                  
                    <p style="border:2px solid #000; padding:15px;text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">
                      <strong>REÇU - appel à cotisation '.$annee_cotisation.' acquitté </strong><br><br>

                      Pour l\'adhésion de '.$nom_structure.' au CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) acquitté le '.$today.' '.$infos_paiement.'. <br><br>

                      Montant de l\'adhésion : '.$montant_cotisation.',00 €
                    </p>
                    <br>

                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;"><strong>Nous avons le plaisir de vous compter parmi les membres adhérents de notre association.</strong><br><br> Dès à présent, vous pouvez :</p>
                    <ul>
                      <li><p>contribuer à construire l\'action et les propositions du réseau et diffuser nos propositions pour mettre en œuvre ensemble la transition énergétique aux niveaux local, national et européen</p></li>
                      <li><p>recevoir notre revue trimestrielle CLER Infos</p></li>
                      <li><p>échanger sur une liste de discussion modérée réunissant plus de 500 contributeurs professionnels</p></li>
                      <li><p>avoir accès au plus grand centre de documentation français consacré à la transition énergétique ainsi qu’à sa revue de presse exhaustive sous format électronique : Doc&CLER</p></li>
                      <li><p>publier gratuitement vos offres d’emplois sur le site Internet du CLER</p></li>
                      <li><p>participer à nos événements : assemblée générale, formations, webinaires, salons, conférences et groupes de travail</p></li>
                    </ul>

                    <p style="font-family: gotham,helvetica,arial,sans-serif;font-size:14px;padding:20px 0; color:#999;line-height: 20px;">Pour toute question relative à votre adhésion, vous pouvez contacter Alexis Monteil au 01 55 86 80 09.</p>

                  </td>
                </tr> 
              </table>
        
              '.$footer_mail.'
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';
?>