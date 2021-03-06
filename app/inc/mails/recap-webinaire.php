<?php

$nom=
$prenom=
$nombre_participants=
$date_webinaire=
$hour_webinaire=
$footer_mail='';

if ( $vars ) :   
    $nom = $vars[0];
    $prenom = $vars[1];
    $nombre_participants = $vars[2];
    $date_webinaire = $vars[3];
    $hour_webinaire = $vars[4];
    $footer_mail = $vars[5];    

endif;

$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Webinaire du '.$date_webinaire.'</title>
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
                    
                    <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Bonjour '.$prenom.' '.$nom.'</h3>

                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Vous êtes inscrit au prochain web-séminaire organisé par le CLER – Réseau pour la transition énergétique qui aura lieu le '.$date_webinaire.' à 16 h, et nous vous en remercions.<br><br>

                    Pour connaître le programme de ce « Mardi de la transition énergétique », les intervenants et les modalités de votre participation, rendez-vous sur <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.get_the_permalink(PAGE_MODE_EMP_WEBINAIRE).'" target="_blank">cette page</a> de notre site internet.<br><br>A bientôt, l\'équipe du CLER – Réseau pour la transition énergétique</p>

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