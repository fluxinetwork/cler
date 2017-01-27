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

        $formObj.find('button[type=submit]').html('<span class="spinner"></span> Chargement');
        $results.prev().html('');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajax_object.ajax_url,
            data: 'action=fluxi_filter_posts&'+params,
            success: function(data){

                if(data[0].validation == 'error'){
                    $formObj.find('button[type=submit]').html('Filtrer');
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
                        //$formObj.find('.js-notify').html('<span class="'+data[0].validation+'">'+data[0].message+'</span>');
                    }else{
                        $results.prev().html('<p class="mgTop--s"><strong>'+data[0].message+'</strong></p>');
                    }
                }
                $formObj.find('button[type=submit]').html('Filtrer');
            },
            error : function(jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
                $formObj.find('button[type=submit]').html('Filtrer');
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

        $formObj.find('.js-loader').html('<span class="c-btn"><span class="spinner"></span></span>');
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
