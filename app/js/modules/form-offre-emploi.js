/*------------------------------*\

    #  Offres d'emploi

\*------------------------------*/

$( document ).ready(function() {
	if($('.page-template-page-manage-emploi').length){
        initaddOfferForm();
    }
});
// Add offer

function initaddOfferForm(){

    var formID = '#form-manage-emploi';

    $(formID+' button[type=submit]').prop('disabled', false);
    $formObj = $('#form-manage-emploi');

    fluxiAjaxTry( formID, $formObj, 'fluxi_manage_emploi', false, true );

	$('#date_candidature').pickadate({
		monthsFull: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
		weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		today: 'Aujourd\'hui',
		clear: 'Effacer',
		close: 'Fermer',
		format: 'dd/mm/yyyy',
		formatSubmit: 'yyyymmdd'
	});

	$('#date_candidature').on('change', function(){
	    $(this).focus();
	})

}

