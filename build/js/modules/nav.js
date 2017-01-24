/*------------------------------*\

    #NAV

\*------------------------------*/

function nav() {
	$('.js-open-nav').on('click', function(e){
		$('.navBar').toggleClass('is-open');

		if (!$('.navBar').hasClass('is-open')) {
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

	$('.js-tips-logout').hover(
		function() {
			$('.btn-profil').addClass('bg-error c-btn--collapse').data('title', $('.btn-profil').html()).html('A bientôt !')
		},
		function() {
			$('.btn-profil').removeClass('bg-error c-btn--collapse').html($('.btn-profil').data('title')).removeData();
		}
	)

	$('.js-open-search').on('click', function(){
		$(this).toggleClass('icon-close');
		$('#search').toggleClass('is-open');
		$('#search-input').focus();
	})
}