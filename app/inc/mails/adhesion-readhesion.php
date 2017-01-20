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
                            <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Bonjour</h3>
                              <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Nous avons bien reçu votre demande de renouvellement d’adhésion au CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>Après validation de votre demande, un appel à cotisation pour l\'année en cours vous sera envoyé automatiquement par email.</p>
                            <p style="font-size:14px;padding:20px 0; color:#999;font-family: gotham,helvetica,arial,sans-serif;line-height: 20px;">Pour toute question relative à votre adhésion, vous pouvez contacter :<br>
                            Alexis Monteil au 01 55 86 80 09.</p>
                            <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">En vous souhaitant une bonne journée,<br><br>
                            Bien cordialement, l\'équipe du CLER</p>
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

else:  

      $contenu_mail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>CLER - Adhésion au CLER</title>
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
                        <h3 style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:20px;line-height: 22px;">Bonjour</h3>
                        <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Nous avons bien reçu votre dossier de candidature pour une demande d\'adhésion au CLER – Réseau pour la transition énergétique, et nous vous en remercions.<br><br>

                        Vous pouvez dès à présent, si vous le souhaitez, compléter ou modifier <a style="color: #00c15f; display: inline-block; font-size: 13px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border-bottom: 3px solid #00c15f; text-decoration: none;" href="'.$refer_url.'" target="_blank">votre formulaire</a> dans votre espace privé sur le site CLER.org.<br><br>

                        Pour les entreprises uniquement : merci de nous envoyer un extrait Kbis de moins de trois mois en format PDF à l\'adresse reseau@cler.org.</p>';

                        if( $accepte_charte_energie_positive )
                        $contenu_mail .= '<p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">La participation au réseau TEPOS est également soumise à l’agrément du conseil du réseau TEPOS. Dans l\'attente de sa confirmation, nous vous remercions de votre patience.</p>';

                        $contenu_mail .= '<p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">Si le prochain Conseil d\'administration du CLER valide votre candidature, un appel à cotisation pour l\'année en cours vous sera envoyé automatiquement par email.</p>

                        <p style="font-size:14px;padding:20px 0; color:#999;line-height: 20px;">Pour toute question relative à votre adhésion, vous pouvez contacter :<br>
                        Alexis Monteil au 01 55 86 80 09.</p>

                        <p style="text-align:left; font-family: gotham,helvetica,arial,sans-serif; font-size:16px;line-height: 22px;">En vous souhaitant une bonne journée,<br><br>
                        Bien cordialement, l\'équipe du CLER</p>
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

endif;

?>