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




