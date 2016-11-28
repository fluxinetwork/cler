/*------------------------------*\

    #NOTIFY

\*------------------------------*/

function notify(message) {
	$('.js-notify').addClass('is-open');
	$('.js-notify-message').html(message);

	setTimeout(function() {
	    $('.js-notify').removeClass('is-open');
	}, 4000);
}

$('.js-notify-close').on('click', function(){
	 $('.js-notify').removeClass('is-open');
})

