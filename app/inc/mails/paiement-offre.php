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
            <h2>Nous avons publier</h2>
            <ul>
              <li>Si vous souhaitez régler la publication par carte bancaire, merci de procéder au règlement via la page de <a href="'.$refer_url.'">paiement en ligne</a>.</li>
              <li>Si vous souhaitez payer par chèque, merci d\'adresser votre règlement de '.$montant_offre.',00 € à l\'ordre du CLER et de l\'envoyer par voie postale au Mundo-m, 47 avenue Pasteur, 93100 Montreuil.</li>
              <li>Pour tout paiement par mandat administratif, merci de nous adresser un bon de commande à l\'adresse suivante : reseau@cler.org </li>
          </ul>
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