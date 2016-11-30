<?php
$footer_mail=$annee_cotisation=$accepte_charte_energie_positive=$refer_url=$type_adhesion='';
if ( $vars ) :   
    $footer_mail = $vars[0];
    $annee_cotisation = $vars[1];
    $accepte_charte_energie_positive = $vars[2];
    $refer_url = $vars[3];
    $type_adhesion = $vars[4];
endif;

if($type_adhesion=='rad'):

      $contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CLER - Réadhésion au CLER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
       <body bgcolor="#ffffff" style="margin:0;">
          <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <p>
                  Bonjour,<br><br>
                    Nous avons bien reçu votre demande de renouvellement d’adhésion au CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>
                  Après validation de votre demande, un appel à cotisation pour l\'année en cours vous sera envoyé automatiquement par email.<br><br>
                  Pour toute question relative à votre adhésion, vous pouvez contacter :<br>
                  Alexis Monteil au 01 55 86 80 09.<br><br>
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

else:  

      $contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CLER - Adhésion au CLER</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
      <body bgcolor="#ffffff" style="margin:0;">
          <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>
                <p>
                  Bonjour,<br><br>
                    Nous avons bien reçu votre dossier de candidature pour une demande d\'adhésion au CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>                   

                  Vous pouvez dès à présent, si vous le souhaitez, compléter ou <a href="'.$refer_url.'">modifier votre formulaire</a> dans votre espace privé sur le site CLER.org.<br><br>

                  Pour les entreprises uniquement : merci de nous envoyer un extrait Kbis de moins de trois mois en format PDF à l\'adresse reseau@cler.org.<p>';

                  if( $accepte_charte_energie_positive )
                  $contenu_mail .= '<p>La participation au réseau TEPOS est également soumise à l’agrément du conseil du réseau TEPOS. Dans l\'attente de sa confirmation, nous vous remercions de votre patience.</p>';

                  $contenu_mail .= '<p>Si le prochain Conseil d\'administration du CLER valide votre candidature, un appel à cotisation pour l\'année en cours vous sera envoyé automatiquement par email.<br><br>

                  Pour toute question relative à votre adhésion, vous pouvez contacter :<br>
                  Alexis Monteil au 01 55 86 80 09.<br><br>

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

endif;

?>