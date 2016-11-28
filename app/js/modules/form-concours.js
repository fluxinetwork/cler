/*------------------------------*\

    #Concours

\*------------------------------*/

$( document ).ready(function() {
	if($('.single-concours').length){
        initParticipationConcoursForm();
        initVoteConcours();
    }
});

// Notification de participation au concours

function initParticipationConcoursForm(){

    var formID = '#form-participation-concours';

    $(formID+' button[type=submit]').prop('disabled', false);
    $formObj = $('#form-participation-concours');

    fluxiAjaxTry( formID, $formObj, 'fluxi_participation_concours', false, true );
   
}


// Vote

function initVoteConcours(){
	// Test if user already rate & hide rating button
	var concoursId = $('#form-participation-concours').data('idp');
	var localS = localStorage.getItem('fluxi_r_c-'+concoursId);

	if( localS == '42' ) {
		$('.form-rating button[type=submit]').remove();
	}
	// On submit rating
	$('.rating').on('submit', 'form.form-rating', function(e){		
		e.preventDefault();
		var $formObj = $(this);
        var params = $formObj.serialize();		
        var $button = $formObj.find('button[type=submit]');

        var the_idp = $formObj.find('input[name=idp]').val();
        var the_idc = $formObj.find('input[name=idc]').val();

        var user_r_v = localStorage.getItem('fluxi_r_c-'+the_idp);

        if( user_r_v != '42' ) {

        	$button.html('<i class="f-spinner"></i> En cours ...').prop('disabled', true);

	        $.ajax({
	            type: 'POST',
	            dataType: 'JSON',
	            url: ajax_object.ajax_url,
	            data: 'action=fluxi_rating_concours&'+params,
	            success: function(data){

	                if(data[0].validation == 'error'){                
	                	$('<p class="f-error-mess">'+data[0].message+'</p>').insertAfter($button);
	                    $button.prop('disabled', false).html('Voter');
	                }else{
	                    $('<p class="f-success-mess">'+data[0].message+'</p>').insertAfter($button);

	                    var nb_votes = parseInt($formObj.parent().find('.js-nb-rate').text()) + 1;
	                    $formObj.parent().find('.js-nb-rate').html(nb_votes);
	                   	
	                    $button.hide();

	                    $('.form-rating button[type=submit]').prop('disabled', true);

	                    localStorage.setItem('fluxi_r_c-'+the_idp, '42');
	                }

	            },
	            error : function(jqXHR, textStatus, errorThrown) {
	                //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
	                $button.prop('disabled', false).html('Voter');
	            }

	        });
	        return false;
	        
	    }else{
	    	// Déjà voté
	    	$('.form-rating button[type=submit]').hide().prop('disabled', true);
	    }

	});    
   
}

