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
<body bgcolor="#ffffff" style="margin:0;">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>          
            <p>Bonjour '.$prenom.' '.$nom.',<br><br>

            Vous venez de vous inscrire au prochain <em>Mardi de la transition énergétique</em> organisé par le CLER – Réseau pour la transition énergétique, et nous vous en remercions. Votre participation au web-séminaire du '.$date_webinaire.' a bien été prise en compte.<br><br>

            Vous recevrez un email récapitulant le programme de ce web-séminaire, les intervenants et les modalités de votre participation quelques jours précédents l\'événement.</p>
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