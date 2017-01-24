/*------------------------------*\

    #FILTERS POSTS

\*------------------------------*/

/**
 * Ajax filter posts
 */

function initFluxiFilterPosts(){

    $('#form-filter-posts').on('submit', function(e){

        var params = $(this).serialize();
       
        var $results = $('.results-list');
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
        }else if ( cpt == 'actualites' ){
            label = 'actualité';
        }else {
            label = 'publication';
        }

        $formObj.find('button[type=submit]').html('<span class="spinner"></span> Chargement');

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

                        if(data[0].total > 1){
                            pluriel = 's';
                            if( cpt == 'offres-emploi' ){
                                label = 'offres d\'emploi';
                            }
                        }

                        $('.js-nb-results').html(data[0].total+' '+label+' disponible'+pluriel);

                        $results.html('').append(data[0].content);
                        $formObj.find('.js-notify').html('<span class="'+data[0].validation+'">'+data[0].message+'</span>');
                    }else{                        
                        $formObj.find('.js-notify').html('<span class="error">'+data[0].message+'</span>');
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

}

/**
 * Ajax auto filter posts by cat
 */

function initFluxiAutoFilterPosts(){

    $('#form-auto-filter-posts').on('submit', function(e){

        var params = $(this).serialize();
       
        var $results = $('.results-list');
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

        $formObj.find('button[type=submit]').html('<span class="spinner"></span> Chargement');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: ajax_object.ajax_url,
            data: 'action=fluxi_auto_filter_posts&'+params,
            success: function(data){

                if(data[0].validation == 'error'){
                    $formObj.find('button[type=submit]').html('Filtrer');                    
                }else{
                    if(data[0].total > 0){

                        if(data[0].total > 1){
                            pluriel = 's';                            
                        }

                        $('.js-nb-results').html(data[0].total+' '+label+' disponible'+pluriel);

                        $results.html('').append(data[0].content);
                        $formObj.find('.js-notify').html('<span class="'+data[0].validation+'">'+data[0].message+'</span>');
                    }else{                        
                        $formObj.find('.js-notify').html('<span class="error">'+data[0].message+'</span>');
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

}
