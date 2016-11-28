<?php
$footer_mail=$refer_url= '';

if ( $vars ) :   
    $footer_mail = $vars[0];    
    $refer_url = $vars[1];   
endif;

$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Ajout d\'un événement</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body bgcolor="#ffffff" style="margin:0;">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <p>
            Bonjour,<br><br>         
            Vous venez de saisir un événement sur le site du CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>
            Vous pouvez compléter ou supprimer cet événement dans votre <a href="'.$refer_url.'">espace privé</a>.<br><br>
            Ces informations seront prochainement publiées sur notre site après vérification de notre équipe.<br><br>
            Les événements qui ne concerneraient pas de manière explicite la transition énergétique, les énergies renouvelables ou la maîtrise de l’énergie ne seront pas publiés.<br><br>
            En vous souhaitant une bonne journée,
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