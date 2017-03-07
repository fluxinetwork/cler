<?php

$footer_mail=
$montant=
$today=
$nom_structure=
$adresse_structure=
$date_paiement=
$num_mode_paiement=
$mode_paiement=
$title_post='';

if ( $vars ) :   
    $footer_mail = $vars[0];
    $montant = $vars[1];
    $today = $vars[2];
    $nom_structure = $vars[3];
    $adresse_structure = $vars[4];
    $date_paiement = $vars[5];
    $num_mode_paiement = $vars[6];
    $mode_paiement = $vars[7];
    $title_post = $vars[8];
endif;

if($mode_paiement=='cb'):
  $infos_paiement = 'par carte bancaire n°'.$num_mode_paiement.')';
elseif($mode_paiement=='virement'):
  $infos_paiement = 'par virement n°'.$num_mode_paiement;
else : 
  $infos_paiement = 'par chéque n°'.$num_mode_paiement.')';
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Reçu paiement offre d\'emploi</title>
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
                  <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Nous avons reçu votre paiement pour la publication de votre offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique et nous vous en remercions.</p>
                
                  <p style="border:2px solid #000; padding:15px;text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">
                    <strong>REÇU - publication d\'une offre d\'emploi acquitté </strong><br><br>

                    Pour la publication "'.$title_post.'" sur le site du CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) acquitté le '.$date_paiement.' '.$infos_paiement.'. <br><br>

                    Montant : '.$montant.',00 €
                  </p>
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