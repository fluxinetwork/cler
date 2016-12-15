/*------------------------------*\

    #CONFIG

\*------------------------------*/

var siteURL = '';
var isHome = false;
var isLogged = false;

// Activate resize events
var resizeEvent = false;
var resizeDebouncer = true;

// Store window sizes
var windowH; 
var windowW; 
calc_window();

// Breakpoint
var bpSmall;
var bpMedium;
var bpLarge;
var bpXlarge;




/*------------------------------*\

    #LOAD

\*------------------------------*/


$(window).load(function() {
	// Manage label animation
	 //$('.form__row .js-input-effect').val('');
	
});


/*------------------------------*\

    #READY

\*------------------------------*/

var FOO = {
    common: {
        init: function() {
            // Delete post
            if($('.page-template-user-profil').length){
                initFluxiDelPost();
            }

            // Filtres
            if( $('.page-template-page-tous-emploi').length || $('.page-template-page-tous-events').length || $('.page-template-page-tous-formations').length){
                initFluxiFilterPosts();
            }

            // Init NAV
            nav();

            // Check if user is logged init
            if ( $('body').hasClass('logged-in') ) {
                isLogged = true;
            }
        }
    },
    home: {
        init: function() {
            isHome = true; 
        }
    },
    search:{
        init: function(){
            initCustomSearch();
        }
    }
    
};

var UTIL = {
    fire: function(func, funcname, args) {
        var namespace = FOO;
        funcname = (funcname === undefined) ? 'init' : funcname;
        if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
          namespace[func][funcname](args);
        }
    },
    loadEvents: function() {
        UTIL.fire('common');
        $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
          UTIL.fire(classnm);
        });
    }
};

$(document).ready(UTIL.loadEvents);





/*------------------------------*\

    #RESIZE

    Is activated by vars in config.js

\*------------------------------*/

/**
 * Get window sizes
 * Store results in windowW and windowH vars
 */

// Get width and height
function calc_window() {
    calc_windowW();
    calc_windowH();
}
// Get width
function calc_windowW() {
    windowW = $(window).width();
}
// Get height
function calc_windowH() {
    windowH = $(window).height();
}


/**
 * MAIN RESIZE EVENT
 *
 */

function resize_handler() {

}
if ( resizeEvent ) { $( window ).bind( "resize", resize_handler() ); }

/**
 * DEBOUNCER
 * Fire event when stop resizing
 */

function debouncer( func , timeout ) {
    var timeoutID;
    var timeoutVAR;

    if (timeout) {
        timeoutVAR = timeout;
    } else {
        timeoutVAR = 200;
    }

    return function() {
        var scope = this , args = arguments;
        clearTimeout( timeoutID );
        timeoutID = setTimeout( function () {
            func.apply( scope , Array.prototype.slice.call( args ) );
        }, timeoutVAR );
    };

}

function debouncer_handler() {
    calc_window();
}
if ( resizeDebouncer ) { $( window ).bind( "resize", debouncer(debouncer_handler) ); }





/*------------------------------*\

    #DELETE POST

\*------------------------------*/

/**
 * Ajax delete post
 */

function initFluxiDelPost(){

    $('.js-del-post').click(function(e){
        e.preventDefault();
        var $button = $(this);
        var postTitle = $button.data('title');
        var toky = $button.data('toky');
        var isConfirm = confirm('Êtes-vous sûr de vouloir supprimer définitivement "' + postTitle + '" ?');
        if (isConfirm == true) {

            var theIdp = $button.data('idp');
            var ajaxAction = 'fluxi_delete_post';

            $button.html('<i class="spinner"></i>');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action='+ajaxAction+'&idp='+theIdp+'&toky='+toky,
                success: function(data){

                    if(data[0].validation == 'error'){
                        $button.html('Supprimer').find('.spinner').remove();
                    }else{
                        
                        $('#js-idp-'+theIdp).fadeOut( 'slow', function() {
                            $('#js-idp-'+theIdp).remove();
                        });                        
                    }                    

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.find('.spinner').remove();
                }

            });
            return false;
        }
    });

}


/*------------------------------*\

    #DISABLE

\*------------------------------*/

function disable_links() {
	$('.js-disabled').click(function(e){
		e.preventDefault();
	});
}

function disable_titles() {
	$('.js-disable-title').hover(
		function(){
			var cible = $(this);
			cible.data( 'title', cible.attr('title') ).attr('title','');
		},
		function() {
			var cible = $(this);
			cible.attr( 'title', cible.data('title') );
		}		
	);
}

/*------------------------------*\

    #FILTERS POSTS

\*------------------------------*/

/**
 * Ajax filter posts
 */

function initFluxiFilterPosts(){

    $('.form').on('submit', 'form#form-filter-posts', function(e){

        var params = $(this).serialize();

       $('#submit-filters').html('<span class="spinner"></span> Chargement');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajax_object.ajax_url,
            data: 'action=fluxi_filter_posts&'+params,
            success: function(data){

                if(data[0].validation == 'error'){
                    //$('#submit-filters').html('Filtrer');                    
                }else{
                    if(data[0].total > 0){
                        
                        $('.results-list').html('').append('<div class="notify"><span class="'+data[0].validation+'">'+data[0].message+'</span></div>').append(data[0].content);
                    }else{
                        if($('.results-list .notify').length){
                            $('.results-list .notify').html('<span class="error">'+data[0].message+'</span>');
                        }else{
                            $('.results-list').prepend('<div class="notify"><span class="error">'+data[0].message+'</span></div>');
                        }
                    }
                }
                $('#submit-filters').html('Filtrer');
            },
            error : function(jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                $('#submit-filters').html('Filtrer');
            }

        });
        return false;
    });

}

/*------------------------------*\

    #IMAG-LOADING

    Using Images Loaded : http://imagesloaded.desandro.com

\*------------------------------*/

function loading_img(container, loader) {
	var nbImg = container.find('img').length-1;
	var hasLoadBar;
	var loadBar;
	var hasLoadNum;
	var loadNum;
	if (loader.find('.js-load-bar')) {
		hasLoadBar = true;
		loadBar = loader.find('.js-load-bar');
	}
	if (loader.find('.js-load-num')) {
		hasLoadNum = true;
		loadNum = loader.find('.js-load-num');
	}

	container.addClass('is-loading').imagesLoaded().progress(onProgress).always(onAlways);

	function onProgress(imgLoad, image) {
		var percent = Math.round(stepLoad*(100/nbImg));
		if (hasLoadBar) {
			loadBar.css('width', percent+'%');
		}
		if (hasLoadNum) {
			loadNum.html(percent+'%');
		}
	}

	function onAlways() {
		container.removeClass('is-loading');
		loader.remove();
	}
}


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
		position = $(document).height()-$('.footer').height();
		bottom = true;
	} else {
		position = position.offset().top;
	}

	if (duration === 'fast') {
		coef = 0.1;
		duration = 200;
	} else if (duration === 'normal') {
		coef = 0.25;
		duration = 350;
	} else if (duration === 'slow') {
		coef = 0.4;
		duration = 500;
	} else {
		coef = duration/1000;
	}

	if (relative === true) {
		calc_windowH();
		if (top) {
			duration = $(document).height()*coef;
		} else if (bottom) {
			duration = ($(document).height()-$(document).scrollTop())*coef;
		}
	}

	$('html, body').animate({scrollTop: position}, duration);
}

/*------------------------------*\

    #SEARCH

\*------------------------------*/

function initCustomSearch(){        	
    $('.nav__search__input').focus();
	// Test to select active filter option in search filters
	if((window.location.href).split("&")[1] != void 0){
		var activeFilter = (window.location.href).split("&")[1];
		var filterVal = activeFilter.substring(4);				
		$('#search-filters #filter option[value='+filterVal+']').attr('selected','selected');
	}
	
	$('#search-filters').change(function() {
		var filterType;
       var filterVal = $('#search-filters #filter option:selected').val();
	  	
		if($.isNumeric(filterVal)){
			filterType = 'cat';
		}else{
			filterType = 'cpt';
		}
		var urlSeach = (window.location.href).split('&')[0] ;
      location.href = urlSeach+'&'+filterType+'='+filterVal;
   });
}


/*------------------------------*\

    #SHARE

\*------------------------------*/

var popupCenter = function(url, title, width, height){
	var popupWidth = width || 640;
	var popupHeight = height || 320;
	var windowLeft = window.screenLeft || window.screenX;
	var windowTop = window.screenTop || window.screenY;
	var windowWidth = window.innerWidth || document.documentElement.clientWidth;
	var windowHeight = window.innerHeight || document.documentElement.clientHeight;
	var popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2 ;
	var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
	var popup = window.open(url, title, 'scrollbars=yes, width=' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop + ', left=' + popupLeft);
	popup.focus();
	return true;
};

$('.js-share').on('click', function(e){
	e.preventDefault();

	var network = $(this).attr('data-network');
	var url = $(this).attr('data-url');
	var shareUrl;

	if (network == 'facebook') {
		shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
		popupCenter(shareUrl, "Partager sur Facebook");
	} if (network == 'twitter') {
		var origin = "energiepartagee";
		shareUrl = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) +
            "&via=" + origin + "" +
            "&url=" + encodeURIComponent(url);
		popupCenter(shareUrl, "Partager sur Twitter");
	}
});


/*------------------------------*\

    #STRING

\*------------------------------*/

/**
 * Separate numbers
 */	

function formatNumber(number){
    var numberSplit = number.toFixed(0) + '';    
    var x = numberSplit.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? ' ' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ' ' + '$2');
    }
    return x1 + x2;
}

/*------------------------------*\

    #FLUXI

\*------------------------------*/

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
}