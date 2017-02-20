/*------------------------------*\

    #SCROLL-TO

\*------------------------------*/

function scroll_to(position, duration, relative) {
	var coef;
	var top;
	var bottom;

	if (position === 'top') {
		position = 0;
		top = true;
	} else if (position === 'bottom') {
		position = $(document).height();
		bottom = true;
	} else {
		position = position.offset().top;
	}

	if (position != 'bottom') {
		position = position - ($(window).height()*0.1) - parseInt($('body').css('paddingTop'));
	}

	if (duration === 'fast') {
		coef = 0.1;
		duration = 200;
	} else if (duration === 'slow') {
		coef = 0.4;
		duration = 600;
	} else {
		coef = 0.25;
		duration= 400;
	}

	if (relative === true) {
		calc_windowH();
		if (top) {
			duration = $(document).scrollTop()*coef;
		} else if (bottom) {
			duration = ($(document).height()-$(document).scrollTop())*coef;
		}
	}

	$('html, body').animate({scrollTop: position}, duration);
}

$('.js-scroll-to').click(function(e){
	e.preventDefault();
	id = $($(this).attr('href'));
	scroll_to(id);
})

$('.js-scroll-top').click(function(e){
	scroll_to('top');
})

$('.js-scroll-bottom').click(function(e){
	scroll_to('bottom');
})
