/*------------------------------*\

    #  Formation

\*------------------------------*/

$( document ).ready(function() {
	if($('.page-template-page-manage-formation').length){
        initaddFormationForm();
    }
});
// Add offer

function initaddFormationForm(){

    var formID = '#form-manage-formation';

    $(formID+' button[type=submit]').prop('disabled', false);
    $formObj = $('#form-manage-formation');

    fluxiAjaxTry( formID, $formObj, 'fluxi_manage_formation', false, true );

	

}

