<?php

$footer_mail=
$today=
$nom_structure=
$adresse_structure=
$nom_contact=
$montant_offre=
$refer_url='';

if ( $vars ) :   
    $footer_mail = $vars[0];    
    $today = $vars[1];
    $nom_structure = $vars[2];
    $adresse_structure = $vars[3];
    $nom_contact = $vars[4];
    $montant_offre = $vars[5];
    $refer_url = $vars[6];
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Paiement publication offre d\'emploi</title>
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

                    <h3>Montreuil, le '.$today.'</h3>

                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;"><strong>Destinataire :</strong><br>
                      '.$nom_structure.'<br>
                      '.$adresse_structure.'
                    </p>

                    <br>
                    <h3>Comment payer ?</h3>

                    <h4>Réglement par carte bancaire</h4>                 
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci de procéder au règlement via la page de <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.$refer_url.'" target="_blank">paiement en ligne</a>.</p>

                    <h4>Réglement par chèque</h4>
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci d\'adresser votre règlement de '.$montant_offre.',00 € à l\'ordre du CLER et de l\'envoyer par voie postale à :<br>Mundo-m, 47 avenue Pasteur, 93100 Montreuil.</p>                    
        
                    <h4>Réglement par mandat administratif</h4>
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci de nous adresser un bon de commande à l\'adresse suivante : reseau@cler.org </p>
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