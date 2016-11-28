/*------------------------------*\

    #  Evénements

\*------------------------------*/

$( document ).ready(function() {
	if($('.page-template-page-manage-event').length){
        initManageEventForm();
    }
});
// Add offer

function initManageEventForm(){

    var formID = '#form-manage-event';

    $(formID+' button[type=submit]').prop('disabled', false);
    $formObj = $('#form-manage-event');

    fluxiAjaxTry( formID, $formObj, 'fluxi_manage_event', false, true );

    
	$('#date_event').pickadate({
		monthsFull: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
		weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		today: 'Aujourd\'hui',
		clear: 'Effacer',
		close: 'Fermer',
		format: 'dd/mm/yyyy',
		formatSubmit: 'yyyymmdd'
	});

	$('#date_event').on('change', function(){
	    $(this).focus();
	})
   
}

