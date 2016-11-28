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
<body bgcolor="#ffffff" style="margin:0;">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>';

      if( $is_adherent == true):

        $contenu_mail .='
          <p>
          Bonjour,<br><br>

            Vous venez de saisir une offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>

            Vous pouvez actualiser ou supprimer cette offre dans votre <a href="'.$refer_url.'">espace privé</a>.<br><br>

            Votre offre sera publiée prochainement sur notre site après vérification de notre équipe. Les offres qui ne concerneraient pas de manière explicite la transition énergétique, les énergies renouvelables ou la maîtrise de l\'énergie ne seront pas publiées.
          </p>';

      else:  
        $contenu_mail .='
          <p>        
            Bonjour,<br><br>  

            Vous venez de saisir une offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>  

            Vous pouvez actualiser ou supprimer cette offre dans votre <a href="'.$refer_url.'">espace privé</a>.<br><br>  

            Votre offre sera publiée prochainement sur notre site après vérification de notre équipe. Les offres qui ne concerneraient pas de manière explicite la transition énergétique, les énergies renouvelables ou la maîtrise de l\'énergie ne seront pas publiées.<br><br>  

            Vous recevrez un email comportant les informations nécessaire au paiement de la publication.<br><br>    

            Vous souhaitez recevoir des informations concernant le CLER – Réseau pour la transition énergétique ? Contactez Alexis Monteil, responsable de projets Animation de réseau et Emploi-formation à l\'adresse : reseau@cler.org.
          </p>';

      endif;

      $contenu_mail .= '
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