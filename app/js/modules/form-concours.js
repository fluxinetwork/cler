/*------------------------------*\

    #Concours

\*------------------------------*/

$( document ).ready(function() {
	if($('.single-concours').length){
        initParticipationConcoursForm();

        if($('.js-haiku').length){        	
        	initMultiVoteConcours();
        }else{
        	initOneVoteConcours();
        }
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

function initOneVoteConcours(){
	// Test if user already rate & hide rating button
	var concoursId = $('.js-is-concours').data('idp');
	var localS = localStorage.getItem('fluxi_r_c-'+concoursId);
	
	if( localS == '42' ) {		
		$('.form-rating').remove();
	}
	
	// On submit rating
	$('.form-rating').on('submit', function(e){		
		e.preventDefault();
		var $formObj = $(this);
        var params = $formObj.serialize();		
        var $button = $formObj.find('button[type=submit]');

        var the_idp = $formObj.find('input[name=idp]').val();
        var the_idc = $formObj.find('input[name=idc]').val();

        var user_r_v = localStorage.getItem('fluxi_r_c-'+the_idp);

        if( user_r_v != '42' ) {

        	$button.html('<i class="fa fa-cog fa-spin js-spinner mgRight--xs" aria-hidden="true"></i>En cours').prop('disabled', true);

	        $.ajax({
	            type: 'POST',
	            dataType: 'JSON',
	            url: ajax_object.ajax_url,
	            data: 'action=fluxi_rating_concours&'+params,
	            success: function(data){

	                if(data[0].validation == 'error'){                
	                	$('<p class="error">'+data[0].message+'</p>').insertAfter($button);
	                    $button.prop('disabled', false).html('Voter');
	                }else{
	                    $('<p class="success">'+data[0].message+'</p>').insertAfter($button);

	                    var nb_votes = parseInt($formObj.parent().find('.js-nb-rate').text()) + 1;
	                    $formObj.parent().find('.js-nb-rate').html(nb_votes);
	                   	
	                    $button.hide();

	                    $button.prop('disabled', true);

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


function initMultiVoteConcours(){
	// Test if user already rate & hide rating button
	var concoursId = $('js-is-concours').data('idp');		
	var totalParts = $('.l-contest').children().length;
	$('.participation').each(function( id ) {	  	
	  	var current_id = parseInt(id+1);
	  	if( localStorage.getItem('fluxi_r_c-'+current_id) == '42'){
	  		$(this).find('.form-rating button[type=submit]').hide().prop('disabled', true);	
	  	}
	});
	
	// On submit rating
	$('.form-rating').on('submit', function(e){		
		e.preventDefault();
		var $formObj = $(this);
        var params = $formObj.serialize();		
        var $button = $formObj.find('button[type=submit]');

        var the_idp = $formObj.find('input[name=idp]').val();
        var the_idc = $formObj.find('input[name=idc]').val(); 

        $button.html('<i class="fa fa-cog fa-spin js-spinner mgRight--xs" aria-hidden="true"></i>En cours').prop('disabled', true);
        var user_r_v = localStorage.getItem('fluxi_r_c-'+the_idc);

        if( user_r_v != '42' ) {

		    $.ajax({
		        type: 'POST',
		        dataType: 'JSON',
		        url: ajax_object.ajax_url,
		        data: 'action=fluxi_rating_concours&'+params,
		        success: function(data){

		            if(data[0].validation == 'error'){                
		            	$('<p class="error">'+data[0].message+'</p>').insertAfter($button);
		                $button.prop('disabled', false).html('Voter');
		            }else{
		                $('<p class="success">'+data[0].message+'</p>').insertAfter($button);

		                var nb_votes = parseInt($formObj.parent().find('.js-nb-rate').text()) + 1;
		                $formObj.parent().find('.js-nb-rate').html(nb_votes);
		               	
		                $button.hide();
		                $button.prop('disabled', true);		                
		                localStorage.setItem('fluxi_r_c-'+the_idc, '42');
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
