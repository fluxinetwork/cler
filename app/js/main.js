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
            nav();
            slider();
            tabs();
            
            if ( $('.fitvid').length ) {
                $('.fitvid').fitVids({ customSelector: "iframe[src*='dailymotion.com']"});
            }
        }
    },
    home: {
        init: function() {
            isHome = true; 
        }
    },
    search: {
        init: function(){
            initCustomSearch();
        }
    },
    page_template_user_profil: {
        init: function(){
             initFluxiDelPost();

             $('.js-receipts-hidden').slideToggle(0);
             var list_is_open = false;

             $('.js-toggle-receipts').click( function(e) {          
                 e.preventDefault();
                 $('.js-receipts-hidden').slideToggle();

                 if( list_is_open===false ){
                     $(this).html('<i class="fa fa-search-minus mgRight--xs"></i>Afficher moins');
                     list_is_open=true;
                 } else {
                     $(this).html('<i class="fa fa-search-plus mgRight--xs"></i>Afficher tout');
                     list_is_open=false;
                 }
             });
        }
    },
    page_has_filters: {
        init: function(){
            initFluxiFilterPosts();
        }
    },
    page_has_auto_filters: {
        init: function(){            
            initFluxiAutoFilterPosts();
        }
    },
    logged_in: {
        init: function(){
            isLogged = true;
        }
    },
    formateree: {
        init: function(){ 
            var first = true;
            $('.fc__title').each(function(){
                $(this).append('<span class="fc__title__tail"></span>').addClass('js-scroll-to');
                if (first) {
                    $(this).attr('id', 'organisme');
                } else {
                    $(this).attr('id', 'recherche');
                }
                first = false;
            });

            $('.js-scroll-top').on('click', function(){
                $('.nav').removeClass('is-compact');
                $('.navBar').removeClass('is-out');
            });
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

    $('.l-card-slider .js-del-post').click(function(e){
        e.preventDefault();
        var $button = $(this);
        var $slider = $button.parents('.l-card-slider');        
        var $notify = $slider.find('.js-notify');
        var $controles = $slider.find('.js-slider-controls');       
        var step = $controles.data('step');
        var nbSlides = $controles.data('slides');   
        var postTitle = $button.data('title');
        var toky = $button.data('toky');
        var isConfirm = confirm('Êtes-vous sûr de vouloir supprimer définitivement "' + postTitle + '" ?');

        if (isConfirm == true) {

            var theIdp = $button.data('idp');
            var ajaxAction = 'fluxi_delete_post';
            $button.html('<i class="fa fa-cog fa-spin js-spinner" aria-hidden="true"></i>');
            $('.l-card-slider .js-notify').html('');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: ajax_object.ajax_url,
                data: 'action='+ajaxAction+'&idp='+theIdp+'&toky='+toky,
                success: function(data){

                    if(data[0].validation == 'error'){
                        $button.html('<i class="fa fa-trash" aria-hidden="true"></i>');
                        $notify.html('Erreur pendant suppression. Rechargez la page puis essayez à nouveau.');
                    }else{
                        $notify.html('Votre publication a bien été supprimée.');

                        $('#js-idp-'+theIdp).addClass('is-off');
                        $('#js-idp-'+theIdp).animate({ borderLeftWidth: '0px' }, 200 , 'linear', function() {
                            $('#js-idp-'+theIdp).remove();
                        });
                        $controles.data('slides', nbSlides-1);
                        if(step > 0){
                            $controles.data('step', step-1);   
                        }  
                    }                    

                },
                error : function(jqXHR, textStatus, errorThrown) {
                    //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                    $button.html('<i class="fa fa-trash" aria-hidden="true"></i>');
                    $notify.html('Erreur pendant suppression. Rechargez la page puis essayez à nouveau.');
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

    $('#form-filter-posts').on('submit', function(e){

        var params = $(this).serialize();

        var $results = $('.l-postList');
        var $formObj = $('#form-filter-posts');
        var formID = '#form-filter-posts';
        var cpt = $('[name="pt_slug"]').val();
        var label = '';
        var pluriel = '';

        if( cpt == 'offres-emploi' ){
            label = 'offre d\'emploi';
        }else if ( cpt == 'evenements' ){
            label = 'événement';
        }else if ( cpt == 'formations' ){
            label = 'formation';
        }else {
            label = 'publication';
        }

        $formObj.find('button[type=submit]').html('<i class="fa fa-cog fa-spin js-spinner"></i> Chargement');
        $results.prev().html('');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajax_object.ajax_url,
            data: 'action=fluxi_filter_posts&'+params,
            success: function(data){

                if(data[0].validation == 'error'){
                    $formObj.find('button[type=submit]').html('<i class="fa fa-filter c-meta__meta__icon"></i> Filtrer');
                }else{
                    if(data[0].total > 0){

                        if($('.pagination').length){
                           $('.pagination').remove();
                        }

                        if(data[0].total > 1){
                            pluriel = 's';
                            if( cpt == 'offres-emploi' ){
                                label = 'offres d\'emploi';
                            }
                        }

                        $('.js-nb-results').html(data[0].total+' '+label+' disponible'+pluriel);

                        $results.html('').append(data[0].content);

                        $('.js-reload').removeClass('is-none');
                        
                        //$formObj.find('.js-notify').html('<span class="'+data[0].validation+'">'+data[0].message+'</span>');
                    }else{
                        $results.prev().html('<p class="mgTop--s"><strong>'+data[0].message+'</strong></p>');
                    }
                }
                $formObj.find('button[type=submit]').html('<i class="fa fa-filter c-meta__meta__icon"></i> Filtrer');
            },
            error : function(jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                $formObj.find('button[type=submit]').html('<i class="fa fa-filter c-meta__meta__icon"></i> Filtrer');
            }

        });
        return false;
    });

    /* Reset by reload */
    $('.js-reload').on('click', function(e){
        var curr_location = window.location.href
        window.location = window.location.href;
    });

}

/**
 * Ajax auto filter posts by cat
 *
 * Use a single field "category"
 *
 */

function initFluxiAutoFilterPosts(){

    $('[name="category"]').on('change', function(e){
         $('#form-auto-filter-posts').trigger( 'submit' );
    });

    $('#form-auto-filter-posts').on('submit', function(e){

        var params = $(this).serialize();

        var $results = $('.l-postList');
        var $formObj = $('#form-auto-filter-posts');
        var formID = '#form-auto-filter-posts';
        var cpt = $('[name="pt_slug"]').val();
        var label = '';
        var pluriel = '';

        if ( cpt == 'post' ){
            label = 'actualité';
        }else {
            label = 'publication';
        }

        $formObj.find('.js-loader').html('<span class="c-btn l-monoFilter__btn"><i class="fa fa-cog fa-spin js-spinner" aria-hidden="true"></i></span>');
        $results.prev().html('');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajax_object.ajax_url,
            data: 'action=fluxi_auto_filter_posts&'+params,
            success: function(data){
                $formObj.find('.js-loader').html('');
                if(data[0].validation == 'error'){
                    $results.prev().html('<p class="mgTop--s"><strong>Il semble y avoir un problème, veuillez ré-essayer.</strong></p>');
                }else{
                    if(data[0].total > 0){
                        if($('.pagination').length){ $('.pagination').remove(); }
                        if(data[0].total > 1){ pluriel = 's'; }
                        $results.html('').append(data[0].content);
                        //$results.prev().html('<ps class="'+data[0].validation+'">'+data[0].message+'</ps>');
                    }else{
                        $results.prev().html('<p class="mgTop--s">'+data[0].message+'</strong></p>');
                    }
                    $formObj.find('.js-reload').removeClass('is-none');
                }
            },
            error : function(jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                $formObj.find('.js-loader').html('');
                $results.prev().html('<p class="mgTop--s"><strong>Il semble y avoir un problème, veuillez ré-essayer.</strong></p>');
            }

        });
        return false;
    });

    /* Reset by reload */
    $('.js-reload').on('click', function(e){
        var curr_location = window.location.href
        window.location = window.location.href;
    });

}

/*------------------------------*\

    #FLEXBOX WARNING

    Add an overlay for browsers which doesn't support flexbox with links to update them
    Flexbox support detection use Modernizr : https://modernizr.com/download?flexbox&q=flex

\*------------------------------*/

if (!Modernizr.flexbox) {
	var ieLink = 'http://windows.microsoft.com/fr-fr/internet-explorer/download-ie';
	var edgeLink = 'https://www.microsoft.com/fr-fr/windows/microsoft-edge';
	var ffLink = 'https://www.mozilla.org/fr/firefox/new/';
	var gcLink = 'https://www.google.com/chrome/browser/desktop/index.html'
	var cliqzLink = 'https://cliqz.com/fr/download';
	var operaLink = 'http://www.opera.com/fr/computer';

	var typo = 'font-family:Helvetica,Tahoma,Arial!important;';
	var h3Style = 'style="color:#F44336;margin-top:32px;background-color:#fff;display:inline-block;padding:8px 16px;border-radius:3px;'+typo+'"';
	var ulStyles = 'style="list-style:none;padding-left:16px;margin-top:24px;"';
	var liStyle = 'style="display:inline-block;margin-right:24px;"';
	var linkStyle = 'style="font-weight:700;color:#fff;text-decoration:none;display:inline-block;'+typo+'"';
	var buttonStyle = 'style="position:absolute;bottom:0;left:0;background-color:#000;padding:16px 80px 16px 80px;width:100%;color:#fff;text-align:left;'+typo+'"';
	var displayIcon = 'display:inline-block';

	var dom = '<div style="position:fixed;left:0;top:0;z-index:100000;width:100%;height:100%;background-color:#F44336;padding:64px;" class="flexwarning">';

	dom += '<h1 style="color:#fff;'+typo+'">Votre navigateur est obsolète,<br> la mise en page du site risque d\'être endommagée.</h1>';
	dom += '<h2 style="color:#fff;margin-top:40px;'+typo+'">Nous vous conseillons de le mettre à jour !</h2>';

	dom += '<h3 '+h3Style+'"><i class="fa fa-windows" style="margin-right:8px;'+displayIcon+'"></i><i class="fa fa-apple" style="margin-right:16px;'+displayIcon+'"></i>Navigateurs multi-plateformes</h3>';
	dom += '<ul '+ulStyles+'>';
	dom += '<li '+liStyle+'><a href="'+ffLink+'" '+linkStyle+'"><i class="fa fa-firefox" style="margin-right:8px;'+displayIcon+'"></i>Firefox</a></li>';
	dom += '<li '+liStyle+'><a href="'+gcLink+'" '+linkStyle+'"><i class="fa fa-chrome" style="margin-right:8px;'+displayIcon+'"></i>Chrome</a></li>';
	dom += '<li '+liStyle+'><a href="'+operaLink+'" '+linkStyle+'"><i class="fa fa-opera" style="margin-right:8px;'+displayIcon+'"></i>Opera</a></li>';
	dom += '</ul>';

	dom += '<h3 '+h3Style+'"><i class="fa fa-windows" style="margin-right:16px;'+displayIcon+'"></i>Navigateurs pour Windows</h3>';
	dom += '<ul '+ulStyles+'>';
	dom += '<li '+liStyle+'><a href="'+ieLink+'" '+linkStyle+'"><i class="fa fa-internet-explorer" style="margin-right:8px;'+displayIcon+'"></i>Internet Explorer</a></li>';
	dom += '<li '+liStyle+'><a href="'+edgeLink+'" '+linkStyle+'"><i class="fa fa-edge" style="margin-right:8px;'+displayIcon+'"></i>Edge pour Windows 10</a></li>';
	dom += '</ul>';

	dom += '<h3 '+h3Style+'">À découvrir</h3>';
	dom += '<ul '+ulStyles+'>';
	dom += '<li '+liStyle+'><a href="'+cliqzLink+'" '+linkStyle+'"><i class="fa fa-shield" style="margin-right:8px;'+displayIcon+'"></i>Cliqz, le navigateur qui respecte la vie privée</a></li>';
	dom += '</ul>';

	dom += '<button '+buttonStyle+' class="js-close-warning"><i class="fa fa-times-circle" style="color:#fff;margin-right:8px;'+displayIcon+'"></i>Fermer cet avertissement (on vous aura prévenu...)</button>';

	dom += '</div>';

	$('body').append(dom);

	if(!$('html').is('[class*="fa-events"]')) {
		$('.flexwarning .fa').css('display','none');
	}

	$('.js-close-warning').on('click', function(){
		$('.flexwarning').remove();
	})
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
	$('.navBar').addClass('is-out');
	id = $($(this).attr('href'));
	scroll_to(id);
})

$('.js-scroll-top').click(function(e){
	scroll_to('top');
})

$('.js-scroll-bottom').click(function(e){
	scroll_to('bottom');
})

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
		var origin = "assoCLER";
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


	// DISPLAY NAV


	// Where to trigger nav hiding

	var posTrigger ;
	var childNumber = $('.main').children().length;
	if ( childNumber == 1 ) {
		posTrigger = '400';
	} else {
		var firstChild = $( $('.main').children().eq(0) );
		if ( firstChild.is('article') ) {
			posTrigger = firstChild.children().eq(1).offset().top-$('.navBar').height();
		} else {
			posTrigger = $('.main').children().eq(1).offset().top-$('.navBar').height();
		}
	} 
	(posTrigger<=0) ? posTrigger = '400' : '';


	// Listen to scroll

	$(document).bind('mousewheel', monitorScroll);

	function monitorScroll(event) {
		var documentOffset = $(window).scrollTop();
	    if ( event.deltaY < 0 && documentOffset > posTrigger ) { // if scroll down
    		$('.navBar').addClass('is-out');
    		setTimeout(function(){
    			$('.nav').addClass('is-compact')
    		}, 400);
	    } else if (event.deltaY > 0)  {  // if scroll up
	    	if( $('.navBar').hasClass('is-out') ) {
	    		$('.navBar').removeClass('is-out');
	    	}
	    	if( documentOffset < 10 && $('.nav').hasClass('is-compact') ) {
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
		openSearch();
		$('.footer').removeClass('is-out');
	})

	$('.js-force-search').on('click', function(){
		$('.footer').toggleClass('is-out');
		openSearch();
	})

	function openSearch() {
		$('.js-open-search').toggleClass('icon2 c-btn--ghost');
		$('#search').toggleClass('is-open');
		$('#search-input').focus();
	}
}
/*------------------------------*\

    #SLIDER

\*------------------------------*/

function slider() {

	var colW = $('.l-card-slider__cards__row__col').outerWidth(true);

	$('.js-slider-controls').each(function(){
		var nbSlides = $(this).parent().find('ul').children().length-1;
		$(this).data('slides', nbSlides).data('step', 0);
	})

	$('.js-slide').on('click', function(e) {
		$this = $(this);
		var $slides = $this.parent().prev().find('ul');
		var nbSlides = $this.parent().data('slides');
		var step = $this.parent().data('step');

		if( $this.data('direction') == 'prev' && step > 0 ) {
			$slides.css('left', (step-1)*colW*-1)
			$slides.children().eq(step-1).toggleClass('is-off');
			$this.parent().data('step', step-1);

		} else if( $this.data('direction') == 'next' && step < nbSlides ) {
			$slides.children().eq(step).toggleClass('is-off');
			$this.parent().data('step', step+1);
			$slides.css('left', (step+1)*colW*-1);
		}
	});

}
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
