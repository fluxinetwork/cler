/*------------------------------*\

    #  Gestion admin adherent

\*------------------------------*/

jQuery( document ).ready(function() {
	initAdminAdherent();
});

// Add adhésion
function initAdminAdherent(){

    // Send the reçu
	jQuery('.js-send-facture').click(function(e){
        e.preventDefault();
        var $button = jQuery(this);
        var the_idp = $button.data('idp');
        var the_idr = $button.data('idr');
        var the_year = $button.data('year');
        var montant_cotisation = $button.data('montant');
        var date_paiement = $button.data('datepaiement');
        
        var isConfirm = confirm('Êtes-vous sûr de vouloir envoyer le reçu par email ?');

        if (isConfirm == true) {

            $button.html('<i class="f-spinner"></i> En cours ...');

            jQuery.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=send_email_facture&idp='+the_idp+'&idr='+the_idr+'&year='+the_year+'&montant='+montant_cotisation+'&date_paiement='+date_paiement+'&security='+ajax_object.nonce,
                success: function(data){

                    if(data[0].validation == 'error'){
                    	jQuery('<p class="f-error-mess">'+data[0].message+'</p>').insertAfter($button);
                        $button.html('Envoyer le reçu '+the_year);
                    }else{
                        jQuery('<p class="f-success-mess">'+data[0].message+'</p>').insertAfter($button);
                       	//$button.html('Envoyer le reçu');
                        $button.hide();
                    }

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.html('Envoyer le reçu '+the_year);
                }

            });
            return false;
        }

    });

    // Send the paiement mail
    jQuery('.js-send-paiement').click(function(e){
        e.preventDefault();
        var $button = jQuery(this);
        var the_idp = $button.data('idp');
        var the_idr = $button.data('idr');
        var the_year = $button.data('year');
        var montant_cotisation = $button.data('montant');
        
        var isConfirm = confirm('Êtes-vous sûr de vouloir envoyer la demande de paiement ?');

        if (isConfirm == true) {

            $button.html('<i class="f-spinner"></i> En cours ...');

            jQuery.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=send_email_paiement&idp='+the_idp+'&year='+the_year+'&montant='+montant_cotisation+'&security='+ajax_object.nonce,
                success: function(data){

                    if(data[0].validation == 'error'){
                        jQuery('<p class="f-error-mess">'+data[0].message+'</p>').insertAfter($button);
                        $button.html('Envoyer l\'appel à cotisation '+ the_year);
                    }else{
                        jQuery('<p class="f-success-mess">'+data[0].message+'</p>').insertAfter($button);
                        
                        $button.hide();

                        setTimeout(function() {
                            jQuery(location).attr( 'href',  window.location.href );
                        }, 300);
                        
                    }

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.html('Envoyer l\'appel à cotisation '+ the_year);
                }

            });
            return false;
        }

    });


}
