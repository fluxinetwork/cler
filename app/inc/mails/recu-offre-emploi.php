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
else:
  $infos_paiement = 'par chéque n°'.$num_mode_paiement.')';
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Reçu de cotisation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body bgcolor="#ffffff" style="margin:0;">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>         
            <p>            
              Montreuil, le '.$today.'<br><br>

              Destinataire :<br>
              '.$nom_structure.'<br>
              '.$adresse_structure.'
            </p>
           </td>
        </tr>

        <tr>
          <td>
            <p>Cher membre,<br><br>
            Nous avons reçu votre paiement pour la publication de votre offre d\'emploi sur le site du CLER – Réseau pour la transition énergétique et nous vous en remercions.</p>
          </td>
        </tr>

        <tr>
          <td>
            <p style="border:2px solid #000; padding:15px;">
              <strong>REÇU - publication d\'une offre d\'emploi acquitté </strong><br><br>

              Pour la publication "'.$title_post.'" sur le site du CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) acquitté le '.$date_paiement.' '.$infos_paiement.'. <br><br>

              Montant : '.$montant.',00 €
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