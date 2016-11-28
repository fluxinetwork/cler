<?php

$montant_cotisation=
$today=
$nom_structure=
$adresse_structure=
$annee_cotisation=
$footer_mail=
$refer_url='';

if ( $vars ) :   
    $footer_mail = $vars[0];
    $montant_cotisation = $vars[1];
    $today = $vars[2];
    $nom_structure = $vars[3];
    $adresse_structure = $vars[4];
    $annee_cotisation = $vars[5];
    $refer_url = $vars[6];
endif;


$contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>CLER - Appel à cotisation</title>
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
            <p>
              Bonjour,<br><br>

              Pour confirmer votre adhésion ou ré-adhésion au CLER – Réseau pour la transition énergétique, nous vous prions d\'acquitter rapidement votre cotisation pour l\'année '.$annee_cotisation.'.<br><br>

              A réception du paiement, nous vous ferons parvenir un reçu attestant du règlement de votre cotisation.<br><br>

              Vous trouverez ci-dessous l’appel à cotisation :
            </p>
          </td>
        </tr>

        <tr>
          <td>
            <p style="border:2px solid #000; padding:15px;">
              <strong>Appel à cotisation '.$annee_cotisation.'</strong><br><br>

              Pour l\'adhésion de '.$nom_structure.' au CLER – Réseau pour la transition énergétique (Association loi 1901 non assujettie à la TVA) demandée le '.$today.'.<br><br>

              Montant de l’adhésion : '.$montant_cotisation.',00 €
            </p>
          </td>
        </tr>

        <tr>
          <td>
            <h2>Comment payer ?</h2>
            <ul>
              <li>Si vous souhaitez régler l\'adhésion par carte bancaire, merci de procéder au règlement via la page de <a href="'.$refer_url.'">paiement en ligne</a>.</li>
              <li>Si vous souhaitez payer par chèque, merci d\'adresser votre règlement à l\'ordre du CLER et de l\'envoyer par voie postale au Mundo-m, 47 avenue Pasteur, 93100 Montreuil.</li>
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