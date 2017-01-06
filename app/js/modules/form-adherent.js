/*------------------------------*\

    #  Offres d'emploi

\*------------------------------*/

$( document ).ready(function() {
	if($('.page-template-page-manage-adherent').length){
        initAdherentForm();
    }
});

// Add adhésion
function initAdherentForm(){

    var formID = '#form-manage-adherent';
    $(formID+' button[type=submit]').prop('disabled', false);
    $formObj = $('#form-manage-adherent');

    // Add secondary contact
    $('input[name=add_contact]').click(function() {
    	if($('input[name=add_contact]').is(':checked')){
		    $('.js-contact2').toggleClass('is-visible');
		}else{
			$('.js-contact2').toggleClass('is-visible');

			$('input[name=nom_contact2]').val('').removeClass('has-content');
			$('input[name=prenom_contact2]').val('').removeClass('has-content');
			$('input[name=fonction_contact2]').val('').removeClass('has-content');
			$('input[name=email_contact2]').val('').removeClass('has-content');
			$('input[name=telephone_contact2]').val('').removeClass('has-content');

		}
	});

	if($('input[name=add_contact]').is(':checked')){
		$('.js-add-conatct').triggerHandler('click');
	}

	// Add TEPOS fields
	$('input#reseaux_cler_1').click(function() {
    	if(this.checked){
		    $('.js-tepos').toggleClass('is-visible');
		}else{
			$('.js-tepos').toggleClass('is-visible');
			// reset
			$('input[name=nom_elu]').val('').removeClass('has-content');
			$('input[name=prenom_elu]').val('').removeClass('has-content');
			$('input[name=fonction_elu]').val('').removeClass('has-content');
			$('input[name=email_elu]').val('').removeClass('has-content');
			$('input[name=telephone_elu]').val('').removeClass('has-content');
			$('input[name=nom_parrain]').val('').removeClass('has-content');
			$('input[name=accepte_charte_energie_positive]').removeProp('checked');
		}
	});

	if($('input#reseaux_cler_1').is(':checked')){
		$('input#reseaux_cler_1').triggerHandler('click');
	}

    // Toggle mode d'emploi

    $('.js-toggle-mode-emploi').on('click', function(){
        $('.js-mode-emploi').toggleClass('is-visible');
    })


    // Validation
    $.validate({
        form : formID,
        scrollToTopOnError : true,
        lang : 'fr',
        validateOnBlur : true,
        modules : 'logic',
        onError : function($form) {
            $form.find('button[type=submit]').prop('disabled', false).find('.spinner').remove();
        },
        onSuccess : function($form) {

            var params = $formObj.serialize();

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action=fluxi_manage_adherent&'+params,
                success: function(data){
                    $formObj.find('button[type=submit] .spinner').remove();

                    if(data[0].validation == 'error'){
                        $formObj.find('button[type=submit]').prop('disabled', false);
                    }else{
                        //$formObj.find('button[type=submit]').hide();
                        $formObj.find('.c-form__submit').html('<a href="'+data[0].redirect+'" class="button">Retour</a>');
                    }
                    $formObj.find('.js-notify').html('<span class="'+data[0].validation+'">'+data[0].message+'</span>');                   

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $formObj.find('button[type=submit]').prop('disabled', false).find('.spinner').remove();
                }

            });
            return false;
        },
        onValidate : function($form) {
            $formObj.find('.js-notify').html('');
            $formObj.find('button[type=submit]').prop('disabled', true).prepend('<i class="spinner"></i>');
        }
    });

}

