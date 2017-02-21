/*------------------------------*\

    #NAV

\*------------------------------*/

function nav() {

	// DISPLAY NAV

	$(document).bind('mousewheel', monitorScroll);

	var posTrigger ;
	var firstChild = $( $('.main').children().eq(0) );
	if ( firstChild.is('article') ) {
		posTrigger = firstChild.children().eq(1).offset().top-$('.navBar').height();
	} else {
		posTrigger = $('.main').children().eq(1).offset().top-$('.navBar').height();
	}
	console.log(posTrigger)

	function monitorScroll(event) {
		var documentOffset = $(window).scrollTop();
	    if ( event.deltaY < 0 ) {
	    	if( documentOffset > posTrigger ) {
	    		$('.navBar').addClass('is-out');
	    		setTimeout(function(){
	    			$('.nav').addClass('is-compact')
	    		}, 400);
	    	}
	    } else if (event.deltaY > 0)  {
	    	if( $('.navBar').hasClass('is-out') ) {
	    		$('.navBar').removeClass('is-out');
	    	}
	    	if( documentOffset < posTrigger && $('.nav').hasClass('is-compact') ) {
	    		$('.nav').removeClass('is-compact');
	    	}
	    }
	}


	// MAIN NAV

	$('.js-open-nav').on('click', function(e){
		$('.nav').toggleClass('is-open');
		$(this).toggleClass('icon2');

		if (!$('.nav').hasClass('is-open')) {
			$('.js-close-subnav').removeClass('is-visible');
			$('.c-navList.is-open').removeClass('is-open');
		}
	})

	$('.js-mute-main').hover(
		function() {
			$('.main').addClass('is-overlayed');
		},
		function() {
			$('.main').removeClass('is-overlayed');
		}
	)


	// SUBNAV

	$('.js-open-subnav').on('click', function(e){
		e.preventDefault();

		if (windowW < 960) {
			$('.js-close-subnav').addClass('is-visible');
			$('.c-navList.is-front').removeClass('is-front');
			$(this).next().toggleClass('is-open is-front');
		}
	})

	$('.js-close-subnav').on('click', function(e){
		$('.c-navList.is-front').removeClass('is-open is-front');
		$('.c-navList.is-open').addClass('is-front');

		if ($('.c-navList.is-open').length == 0) {
			$('.js-close-subnav').removeClass('is-visible');
		}
	})


	// LOGOUT

	$('.js-tips-logout').hover(
		function() {
			$('.btn-profil').addClass('bg-error is-collapsed').data('title', $('.btn-profil').html()).html('A bientôt !')
		},
		function() {
			$('.btn-profil').removeClass('bg-error is-collapsed').html($('.btn-profil').data('title')).removeData();
		}
	)


	// SEARCH

	$('.js-open-search').on('click', function(){
		$(this).toggleClass('icon2');
		$('#search').toggleClass('is-open');
		$('#search-input').focus();
	})
}