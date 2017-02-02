<?php
$footer_mail=$refer_url=$is_adherent= '';

if ( $vars ) :   
    $footer_mail = $vars[0];    
    $refer_url = $vars[1]; 
    $is_adherent = $vars[2];
endif;

$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Ajout d\'une offre d\'emploi</title>
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
                  <td style="background: #fff; padding:20px 30px 30px;">';

                  if( $is_adherent == true):

                    $contenu_mail .='
                      
                      <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Bonjour</h3>Bonjour</h3>
                      <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Vous venez de saisir une offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>

                        Vous pouvez actualiser ou supprimer cette offre dans votre <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.$refer_url.'" target="_blank">espace privé</a>.</p>

                        <p style="font-family: gotham,helvetica,arial,sans-serif;font-size:14px;padding:20px 0; color:#999;line-height: 20px;">Votre offre sera publiée prochainement sur notre site après vérification de notre équipe. Les offres qui ne concerneraient pas de manière explicite la transition énergétique, les énergies renouvelables ou la maîtrise de l\'énergie ne seront pas publiées.</p>';

                  else:  
                    $contenu_mail .='
                              
                      <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Bonjour</h3>Bonjour</h3>
                      <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Vous venez de saisir une offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>  

                        Vous pouvez actualiser ou supprimer cette offre dans votre <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.$refer_url.'" target="_blank">espace privé</a>.<br><br>  

                        Votre offre sera publiée prochainement sur notre site après vérification de notre équipe. Les offres qui ne concerneraient pas de manière explicite la transition énergétique, les énergies renouvelables ou la maîtrise de l\'énergie ne seront pas publiées.<br><br>  

                        Vous recevrez un email comportant les informations nécessaire au paiement de la publication.</p>    

                        <p style="font-family: gotham,helvetica,arial,sans-serif;font-size:14px;padding:20px 0; color:#999;line-height: 20px;">Vous souhaitez recevoir des informations concernant le CLER – Réseau pour la transition énergétique ? Contactez Alexis Monteil, responsable de projets Animation de réseau et Emploi-formation à l\'adresse : reseau@cler.org.</p>';

                  endif;

                  $contenu_mail .= '
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">En vous souhaitant une bonne journée,<br><br>
                      Bien cordialement, l\'équipe du CLER
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