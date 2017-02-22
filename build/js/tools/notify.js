/*------------------------------*\

    #NOTIFY

\*------------------------------*/

function notify(message) {
	$('.js-notify-message').html(message);

	setTimeout(function(){
		$('.js-notify').addClass('is-open');
		setTimeout(function() {
		    $('.js-notify').removeClass('is-open');
		}, 10000);
	}, 2000);
}

$('.js-notify-close').on('click', function(){
	 $('.js-notify').removeClass('is-open');
})

