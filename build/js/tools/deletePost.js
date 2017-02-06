/*------------------------------*\

    #DELETE POST

\*------------------------------*/

/**
 * Ajax delete post
 */

function initFluxiDelPost(){

    $('.js-del-post').click(function(e){
        e.preventDefault();
        var $button = $(this);
        var postTitle = $button.data('title');
        var toky = $button.data('toky');
        var isConfirm = confirm('Êtes-vous sûr de vouloir supprimer définitivement "' + postTitle + '" ?');
        if (isConfirm == true) {

            var theIdp = $button.data('idp');
            var ajaxAction = 'fluxi_delete_post';

            $button.html('<i class="spinner"></i>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action='+ajaxAction+'&idp='+theIdp+'&toky='+toky,
                success: function(data){

                    if(data[0].validation == 'error'){
                        $button.find('.spinner').remove();
                        console.log('Erreur pendant suppression. Rechargez la page puis essayez à nouveau.');
                    }else{
                        
                        $('#js-idp-'+theIdp).fadeOut( 'slow', function() {
                            //$('#js-idp-'+theIdp).remove();
                            console.log('Votre publication a bien été supprimée.'+theIdp);
                        });                        
                    }                    

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.find('.spinner').remove();
                }

            });
            return false;
        }
    });

}

