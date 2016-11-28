/*------------------------------*\

    #  Gestion admin adherent

\*------------------------------*/

jQuery( document ).ready(function() {
	initAdminOffre();
});

// Add adhésion
function initAdminOffre(){    

    // Send the paiement mail
    jQuery('.js-send-paiement').click(function(e){
        e.preventDefault();
        var $button = jQuery(this);
        var the_idp = $button.data('idp');      
        
        var isConfirm = confirm('Êtes-vous sûr de vouloir envoyer la demande de paiement ?');

        if (isConfirm == true) {

            $button.html('<i class="f-spinner"></i> En cours ...');

            jQuery.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=send_email_paiement_offre_emp&idp='+the_idp+'&security='+ajax_object.nonce,
                success: function(data){

                    if(data[0].validation == 'error'){
                        jQuery('<p class="f-error-mess">'+data[0].message+'</p>').insertAfter($button);
                        $button.html('Envoyer la demande de paiement');
                    }else{
                        jQuery('<p class="f-success-mess">'+data[0].message+'</p>').insertAfter($button);
                        //$button.html('Envoyer le reçu');
                        $button.hide();

                        setTimeout(function() {
                            jQuery(location).attr( 'href',  window.location.href );
                        }, 300);
                    }

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.html('Envoyer la demande de paiement');
                }

            });
            return false;
        }

    });

    // Send the reçu 
    jQuery('.js-send-facture').click(function(e){
        e.preventDefault();
        var $button = jQuery(this);
        var the_idp = $button.data('idp');
        var the_idr = $button.data('idr');      
        
        var isConfirm = confirm('Êtes-vous sûr de vouloir envoyer le reçu ?');

        if (isConfirm == true) {

            $button.html('<i class="f-spinner"></i> En cours ...');

            jQuery.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=send_email_facture_offre&idp='+the_idp+'&idr='+the_idr+'&security='+ajax_object.nonce,
                success: function(data){

                    if(data[0].validation == 'error'){
                        jQuery('<p class="f-error-mess">'+data[0].message+'</p>').insertAfter($button);
                        $button.html('Envoyer le reçu');
                    }else{
                        jQuery('<p class="f-success-mess">'+data[0].message+'</p>').insertAfter($button);
                        //$button.html('Envoyer le reçu');
                        $button.hide();
                    }

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.html('Envoyer le reçu');
                }

            });
            return false;
        }

    });


}
