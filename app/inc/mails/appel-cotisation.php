<?php

$montant_cotisation=
$today=
$nom_structure=
$adresse_structure=
$annee_cotisation=
$footer_mail=
$refer_url='';

if ( $vars ) :   
    $footer_mail = $vars[0];
    $montant_cotisation = $vars[1];
    $today = $vars[2];
    $nom_structure = $vars[3];
    $adresse_structure = $vars[4];
    $annee_cotisation = $vars[5];
    $refer_url = $vars[6];
    $profil_url = $vars[7];
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Appel à cotisation</title>
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

                    <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Bonjour</h3>
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">
                      

                      Pour confirmer votre adhésion ou ré-adhésion au CLER – Réseau pour la transition énergétique, nous vous prions d\'acquitter rapidement votre cotisation pour l\'année '.$annee_cotisation.'.<br><br>

                      Vous trouverez votre appel à cotisation ci-dessous. Il est également à votre disposition (à conserver ou à imprimer) en ligne, dans <a href="'.$profil_url.'" target="_blank">votre espace adhérent</a>. Veuillez noter qu\'aucune facture ne vous sera envoyée par courrier ou email.<br><br>

                      A réception du paiement, un reçu attestant du règlement de votre cotisation vous parviendra par email. Ce reçu sera également téléchargeable dans votre espace adhérent.
                    </p>
                    
                    <p style="border:2px solid #000; padding:15px;text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">
                      <strong>Appel à cotisation '.$annee_cotisation.'</strong><br><br>

                      Pour l\'adhésion de '.$nom_structure.' au CLER – Réseau pour la transition énergétique<sup>*</sup><br><br>

                      Montant de l\'adhésion : '.$montant_cotisation.',00 €
                    </p>
                    <br>
                    <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Comment payer ?</h3>

                    <h4 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:17px;line-height: 20px;">Règlement par carte bancaire</h4>                 
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci de procéder au règlement via la page de <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.$refer_url.'" target="_blank">paiement en ligne</a>.</p>

                    <h4 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:17px;line-height: 20px;">Règlement par chèque</h4>
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci d\'adresser votre règlement à l\'ordre du CLER (référence à indiquer : Adhésion '.$annee_cotisation.') et de l\'envoyer par voie postale à :<br>Mundo-m, 47 avenue Pasteur, 93100 Montreuil.</p>                    
        
                    <h4 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:17px;line-height: 20px;">Règlement par mandat administratif</h4>
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci de nous adresser un bon de commande (référence à indiquer : Adhésion '.$annee_cotisation.') à l\'adresse suivante : reseau@cler.org </p>

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