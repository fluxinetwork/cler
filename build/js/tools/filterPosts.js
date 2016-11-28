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
