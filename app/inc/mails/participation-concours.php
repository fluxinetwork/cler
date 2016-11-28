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
<body bgcolor="#ffffff" style="margin:0;">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>         
            <h3>Bonjour '.$nom_prenom.',</h3>
           </td>
        </tr>

        <tr>
          <td>
            <p>Merci pour votre participation "'.$titre_participation.'" à '.$title_concours.'.<br><br>
              
              Elle sera traitée par nos soins et sera publiée sur la <a href="'.$redirect_slug.'">page du concours</a>. 
            </p>
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