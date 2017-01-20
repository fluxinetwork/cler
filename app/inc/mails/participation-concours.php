<?php

$footer_mail=
$nom_prenom=
$title_concours=
$titre_participation=
$redirect_slug=
$modalites='';

if ( $vars ) :   
    $footer_mail = $vars[0];
    $nom_prenom = $vars[1];
    $title_concours = $vars[2];
    $titre_participation = $vars[3];
    $redirect_slug = $vars[4];
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Participation au concours '.$title_concours.'</title>
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

                    <h3>Bonjour '.$nom_prenom.'</h3>          
                    <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Merci pour votre participation "'.$titre_participation.'" à '.$title_concours.'.<br><br>Elle sera traitée par nos soins et sera publiée sur la <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.$redirect_slug.'" target="_blank">page du concours</a> après validation.</p>
                    
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