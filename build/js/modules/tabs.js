/*------------------------------*\

    #TABS

\*------------------------------*/

function tabs() {

	$('.js-tab').on('click', function(e) {
		e.preventDefault();
		var $tabs = $(this).parent();
		var $pans = $tabs.next();
		var indexTab = $(this).data('tab');

		$pans.find('ul').removeClass('is-active');
		$pans.find('ul').eq(indexTab).addClass('is-active');
		$tabs.find('a').removeClass('is-active');
		$(this).addClass('is-active');
	});
	// Init
	if( $('.js-tab').length ) {
		$('.js-tab').first().trigger( 'click' );		
	}
	
}
