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




