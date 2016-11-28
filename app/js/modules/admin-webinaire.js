/*------------------------------*\

    #  Gestion admin adherent

\*------------------------------*/

jQuery( document ).ready(function() {
	initAdminWebinaire();
});

// Add adhésion
function initAdminWebinaire(){

	jQuery('#js-send-recap-participation').click(function(e){
        e.preventDefault();
        var $button = jQuery(this);
        var the_idp = $button.data('idp');
        var isConfirm = confirm('Êtes-vous sûr de vouloir envoyer un email récapitulatif à tous les participants ?');

        if (isConfirm == true) {

            $button.html('<i class="f-spinner"></i> En cours ...');

            jQuery.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=send_email_participation_webinaire&idp='+the_idp+'&security='+ajax_object.nonce,
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
