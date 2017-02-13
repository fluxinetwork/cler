/*------------------------------*\

    #DELETE POST

\*------------------------------*/

/**
 * Ajax delete post
 */

function initFluxiDelPost(){

    $('.l-card-slider .js-del-post').click(function(e){
        e.preventDefault();
        var $button = $(this);
        var $slider = $button.parents('.l-card-slider');        
        var $notify = $slider.find('.js-notify');
        var $controles = $slider.find('.js-slider-controls');       
        var step = $controles.data('step');
        var nbSlides = $controles.data('slides');   
        var postTitle = $button.data('title');
        var toky = $button.data('toky');
        var isConfirm = confirm('Êtes-vous sûr de vouloir supprimer définitivement "' + postTitle + '" ?');

        if (isConfirm == true) {

            var theIdp = $button.data('idp');
            var ajaxAction = 'fluxi_delete_post';
            $button.html('<i class=”fa fa-circle-o-notch fa-spin js-spinner”></i>');
            $('.l-card-slider .js-notify').html('');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action='+ajaxAction+'&idp='+theIdp+'&toky='+toky,
                success: function(data){

                    if(data[0].validation == 'error'){
                        $button.html('<i class="fa fa-trash" aria-hidden="true"></i>');
                        $notify.html('Erreur pendant suppression. Rechargez la page puis essayez à nouveau.');
                    }else{
                        $notify.html('Votre publication a bien été supprimée.');

                        $('#js-idp-'+theIdp).addClass('is-off');
                        $('#js-idp-'+theIdp).animate({ borderLeftWidth: '0px' }, 200 , 'linear', function() {
                            $('#js-idp-'+theIdp).remove();
                        });
                        $controles.data('slides', nbSlides-1);
                        if(step > 0){
                            $controles.data('step', step-1);   
                        }  
                    }                    

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.html('<i class="fa fa-trash" aria-hidden="true"></i>');
                    $notify.html('Erreur pendant suppression. Rechargez la page puis essayez à nouveau.');
                }

            });
            return false;
        }
    });

}

