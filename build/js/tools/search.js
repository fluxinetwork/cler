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

