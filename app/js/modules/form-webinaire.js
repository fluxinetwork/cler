/*------------------------------*\

    #  Evénements

\*------------------------------*/

$( document ).ready(function() {
	if($('.single-webinaires').length){
        initWebinairesForm();
    }
});
// Add offer

function initWebinairesForm(){

    var formID = '#form-participation-webinaire';

    $(formID+' button[type=submit]').prop('disabled', false);
    $formObj = $('#form-participation-webinaire');

    // Add nom structure
    $('input[name=adherent_cler]').click(function() {
    	if(this.checked){
		    $('.js-nom-structure').slideToggle();		    
		}else{
			$('.js-nom-structure').slideToggle();
			$('input[name=nom_structure]').val('');			
		}
	});

	if($('input[name=adherent_cler]').is(':checked')){
		$('input[name=adherent_cler]').triggerHandler('click');
	}

    // Validation
    $.validate({
        form : formID,
        scrollToTopOnError : false,
        lang : 'fr',
        validateOnBlur : true,
        modules : 'logic',
        onError : function($form) {
            $form.find('button[type=submit]').prop('disabled', false).find('.js-spinner').remove();
        },
        onSuccess : function($form) {

            var params = $formObj.serialize();

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=fluxi_participation_webinaire&'+params,
                success: function(data){
                    $formObj.find('button[type=submit] .js-spinner').remove();

                    if(data[0].validation == 'error'){
                        $formObj.find('button[type=submit]').prop('disabled', false);
                    }else{
                        $formObj.find('button[type=submit]').hide();                      
                    }
                    $formObj.find('.js-notify').html('<span class="'+data[0].validation+'">'+data[0].message+'</span>');                    

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $formObj.find('button[type=submit]').prop('disabled', false).find('.js-spinner').remove();
                }

            });
            return false;
        },
        onValidate : function($form) {
            $formObj.find('.js-notify').html('');
            $formObj.find('button[type=submit]').prop('disabled', true).prepend('<i class="fa fa-cog fa-spin js-spinner" aria-hidden="true"></i>');
        }
    });
   
}

