/*------------------------------*\

    #  Offres d'emploi

\*------------------------------*/

var map = null;
var themeURL = 'https://cler.org/dev-cler/wp-content/themes/cler';

var windowW = $(window).width();
var bpSmall = '400';

var nbMakers = 0;
var nbShowMakers = 0;
var nbloadedCards = 6;
var gmarkers = [];
var prevCardMapId = null;
var previousMarker = null;
var isOpenMarker = false;

var activateFilters = false;
var filterCat = 'all_cat';
var is_filtered = false;

var infowindow;

var markerCluster = null;
var cluster_markers = [];

var stylesMap = [
   {
        "featureType": "landscape.natural.terrain",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "simplified"
            },
            {
                "hue": "#0500ff"
            },
            {
                "saturation": "-100"
            },
            {
                "lightness": "45"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#007bff"
            },
            {
                "visibility": "on"
            },
            {
                "lightness": "-9"
            }
        ]
    }
];


var markerShadow;
var iconShadow = {
    url: themeURL+'/app/img/marker-shadow.png',
    size: new google.maps.Size(38, 38),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(34, 34)
};



var iconsMap = {
    entreprise: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#5ab1bb',
        fillOpacity: 1,
    },
    association: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#83ab00',
        fillOpacity: 1,
    },
    collectivite: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#e9af00',
        fillOpacity: 1,
    },
    formation: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#ffffff',
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: '#5268b9',
        fillOpacity: 1,
    }
};

var iconsSelMap = {
    entreprise: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#5ab1bb',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    association: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#83ab00',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    collectivite: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#e9af00',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    },
    formation: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 10,
        strokeColor: '#5268b9',
        strokeOpacity: 1,
        strokeWeight: 4,
        fillColor: '#ffffff',
        fillOpacity: 1,
    }
};



$( document ).ready( function() {

	if( $('.page-template-page-map-adherents').length ){        
        activateFilters = true;
        initAdherentsMap();
    }

    if( $('.formateree').length ){
        filterCat = 'formation';
        initAdherentsMap();  
    }

});


/*
 * Init Adherents Map
 * - Add a dom container
 * - latlng = new google.maps.LatLng(47.50,2.20);
 * - activateFilters : default = false
 * - mapOptions = { zoom: 6, scrollwheel: false, panControl: true}
 */
function initAdherentsMap(){

    //console.log('Init Google Map Obj for "Adherents Map"');

    var mapContainer = document.getElementById("map");

    var latlng = new google.maps.LatLng(47.50,2.20);    

    var mapOptions = {
        zoom: 6,
        scrollwheel: false,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        mapTypeControl: false,
        streetViewControl: false,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROAD
    };
    
    loadGoogleMap(mapContainer, mapOptions);
}
/* Init the google map
 *  mapContainer = DOM element | mapOptions = option array
 */
function loadGoogleMap(mapContainer, mapOptions){

    //console.log('Load Google Map Obj');

    map = new google.maps.Map(mapContainer,mapOptions);
    map.setOptions({styles: stylesMap});

    //mapContainer.className += 'loader';

    loadMarkers(map);
}

/* Load markers by JSON ajax custom request
 * map = Google map object
 * filterCat : default = 'all_cat' / String : cat_slug
 */
function loadMarkers(map){

    //console.log('loadMarkers '+filterCat);
    
    var str = 'action=get_json_map&tag='+filterCat;

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
            addMakers(map, data);            
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false;
}

function addMakers(map, data){

    //console.log('Add Makers ');

    nbMakers = Object.keys(data).length;

    $.each(data, function(i){

        // If it's an adherent
        if(data[i].postType == 'cartes'){
            // Slug tag
            var tag = data[i].catSlug;

            //  Add markers on the map only on desktop
            if(windowW >= bpSmall){

                var newLatLng = {lat: Number(data[i].latitude), lng: Number(data[i].longitude)};

                var marker = new google.maps.Marker({
                    position: newLatLng,
                    map: map,
                    title: data[i].title,
                    icon: iconsMap[tag],
                    category : data[i].catSlug                   
                });


                infowindow = new google.maps.InfoWindow({
                    content: '<div class="infowindow--content">'+
                                '<h3 class="infowindow--content--title">'+
                                    data[i].title+
                                '</h3>'+
                                '<p>'+
                                    data[i].ville+
                                    ' ('+data[i].departement+')'+
                                '</p>'+
                                '<p>'+
                                    data[i].catName+
                                '</p>'+
                                '<p>'+
                                    data[i].catName+
                                '</p>'+
                                //'<a class="button" href="'+data[i].permalink+'">Consulter la fiche</a>'+

                              '</div>'
                });


                marker.addListener('click', function(e) {
                    onClickMarker(i,map,marker,tag,e);
                    if (infowindow) { infowindow.close();}
                    infowindow.open(map, marker);
                });

                // Add class to info window
                google.maps.event.addListener(infowindow, 'domready', function() {

                    $infoBg = $('.gm-style-iw').prev();                  

                    $infoBg.addClass('infowindow--bg');
                    $('.gm-style-iw').next().addClass('infowindow--close');

                    $infoBg.find('div:eq(0)').addClass('infowindow--bg--shadow__corne')
                    $infoBg.find('div:eq(1)').addClass('infowindow--bg--shadow__bubble');

                    $infoBg.find('div:eq(2)').addClass('infowindow--bg--corne');
                    $infoBg.find('div:eq(2) div:eq(0)').addClass('infowindow--bg--corne__l');
                    $infoBg.find('div:eq(2) div:eq(0)').next().addClass('infowindow--bg--corne__r');

                    $infoBg.find('div:eq(2)').next().addClass('infowindow--bg--bubble');
                });

                gmarkers.push(marker);
                                
                if(i==nbMakers-1 && activateFilters){
                    // Init all filters once if activateFilters = true
                    initFilters(map);
                    activateFilters=false;

                    markerCluster = new MarkerClusterer(map, gmarkers, {imagePath: themeURL+'/app/img/m'});
                    markerCluster.setIgnoreHidden(true);
                    markerCluster.setMaxZoom(10);

                    centerMapOnMarkers(map);

                }
            }
            // Add info card
            var markerContent = '<div class="card-map c-'+tag+' hide">';
                    markerContent += '<a href="'+data[i].permalink+'">';
                        markerContent += data[i].title;
                    markerContent += '</a>';

                    markerContent += '<div class="details">';
                       markerContent += 'Des détails..........';
                    markerContent += '</div>';

                    markerContent += '<a class="button" href="'+data[i].permalink+'">Voir la fiche</a>';

                markerContent += '</div>';

            $('.map-cards').append(markerContent);            

        }
        
        // End each
   });

}


// Event on click  on a marker
function onClickMarker(index,map,marker,tag,e){

    // Add a shadow
   /* if (markerShadow && markerShadow.setPosition) {
        markerShadow.setPosition(marker.getPosition());
        markerShadow.show();
    } else {
        markerShadow = new MarkerShadow(marker.getPosition(), iconShadow, map);
        markerShadow.show();
    }*/
    // Modify previous marker
    if(isOpenMarker){
        previousMarker.setIcon(iconsMap[previousTag]);
        previousMarker.setZIndex(1);
    }
    // Change the icon
    marker.setIcon(iconsSelMap[tag]);
    previousMarker = marker;
    previousTag = tag;

    marker.setZIndex(10000);
    // center on marker
    map.setCenter( e.latLng );

    // Get the card
    /*if(index != prevCardMapId){
        if(isOpenMarker){
            $('.map-cards .card-map:eq('+prevCardMapId+')').toggleClass('hide');
            setTimeout(function() {
                $('.map-cards .card-map:eq('+index+')').toggleClass('hide');
              
            }, 220);

        }else{
            $('.map-cards .card-map:eq('+index+')').toggleClass('hide');
     
        }
    }
    prevCardMapId = index;*/
    isOpenMarker = true;

}


function initFilters(map){

    //console.log('Init filters');

    $('#form-filter-map').on('submit', function(e){
        e.preventDefault();
        e.stopPropagation();
        if( $('#type_structure').val() ){
            is_filtered = true;
            resetMarkers();
            var $form = $('#form-filter-map');
            filterCat = $('#type_structure').val();

            $('#form-filter-map').find('.js-reload').removeClass('is-none');

            for (i = 0; i < nbMakers; i++) {
                // If is same category or category not picked
                if (gmarkers[i].category == filterCat || filterCat.length === 0){               
                    gmarkers[i].setVisible(true); 
                }
                // Categories don't match
                else{
                    gmarkers[i].setVisible(false);
                }
                if(i==nbMakers-1 && windowW >= bpSmall){              
                    markerCluster.repaint();
                    centerMapOnMarkers(map);
                }
            }
        }


    });

    $('#type_structure').on('change', function(e){
        $('#form-filter-map').triggerHandler('submit');
    });

    // reset
    $('button[type="reset"]').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        resetMarkers();
        if(is_filtered){
            $('#form-filter-map').find('.js-reload').remove();
            resetFilters();
            resetMarkers();
            markerCluster.repaint();
            centerMapOnMarkers(map);            
            $('#type_structure option').prop('selected', function() {
                return this.defaultSelected;
            });
            is_filtered = false;
        }
    });
   
}

function resetFilters(){
    for (i = 0; i < gmarkers.length; i++) {
        if (gmarkers[i].category != filterCat ) {            
            gmarkers[i].setVisible(true);            
        }
        if(i == gmarkers.length-1){
            filterCat = 'all_cat';
        }
    }
}


function resetMarkers() {    
    if(isOpenMarker){
        // reset icon       
        previousMarker.setIcon(iconsMap[previousTag]);
       // markerShadow.hide();
        isOpenMarker = false;
        // close infowindow
        if (infowindow) { infowindow.close();}
        // reset card
        //$('.map-cards .card-map:eq('+prevCardMapId+')').toggleClass('hide');
        //prevCardMapId = null;
    }
}


function centerMapOnMarkers(map){
    nbShowMakers = nbMakers;
    var LatLngList = new Array ();
    var bounds = new google.maps.LatLngBounds ();
    // Bind all marker's positions
    for (i = 0; i < gmarkers.length; i++) {
        if(gmarkers[i].visible)
        LatLngList.push(gmarkers[i].getPosition());
        else
        nbShowMakers--;
    }
    //  And increase the bounds to take this point
    for (var j = 0, LtLgLen = LatLngList.length; j < LtLgLen; j++) {
        bounds.extend (LatLngList[j]);
    }

    if(nbShowMakers >= 3){
        map.fitBounds (bounds);
    }else if(nbShowMakers == 2){
        map.setZoom(6);
        map.setCenter(bounds.getCenter());
    }else if(nbShowMakers == 1){
        map.setZoom(7);
        map.setCenter(bounds.getCenter());
    }
}

function removeMarkers() {
    //console.log('Remove All Markers');
     for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }
}

/*
 * Reload map page on resize
 *
 */
function reloadCurrentPage(){
    if(lastWindowW <= bpSmall && windowW >= bpSmall && $('.map-adherents').length == 1){
        location.reload(true);
        lastWindowW = windowW;
    }
}


/*
 * Marker shadow prototype
 *
 */
MarkerShadow.prototype = new google.maps.OverlayView();
MarkerShadow.prototype.setPosition = function(latlng) {
    this.posn_ = latlng;
    this.draw();
  }
  /** @constructor */

function MarkerShadow(position, options, map) {

    // Initialize all properties.
    this.posn_ = position;
    this.map_ = map;
    if (typeof(options) == "string") {
      this.image = options;
    } else {
      this.options_ = options;
      if (!!options.size) this.size_ = options.size;
      if (!!options.url) this.image_ = options.url;
    }

    // Define a property to hold the image's div. We'll
    // actually create this div upon receipt of the onAdd()
    // method so we'll leave it null for now.
    this.div_ = null;

    // Explicitly call setMap on this overlay.
    this.setMap(map);
  }
  /**
   * onAdd is called when the map's panes are ready and the overlay has been
   * added to the map.
   */
MarkerShadow.prototype.onAdd = function() {
  // if no url, return, nothing to do.
  if (!this.image_) return;
  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = this.options_.size.x + 'px';
  img.style.height = this.options_.size.y + 'px';
  img.style.position = 'absolute';

  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayShadow.appendChild(div);
};

MarkerShadow.prototype.draw = function() {
  // if no url, return, nothing to do.
  if (!this.image_) return;
  // We use the coordinates of the overlay to peg it to the correct position
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  var posn = overlayProjection.fromLatLngToDivPixel(this.posn_);

  // Resize the image's div to fit the indicated dimensions.
  if (!this.div_) return;
  var div = this.div_;
  if (!!this.options_.anchor) {
    div.style.left = Math.floor(posn.x - this.options_.anchor.x) + 'px';
    div.style.top = Math.floor(posn.y - this.options_.anchor.y) + 'px';
  }
  if (!!this.options_.size) {
    div.style.width = this.size_.x + 'px';
    div.style.height = this.size_.y + 'px';
  }
};

// The onRemove() method will be called automatically from the API if
// we ever set the overlay's map property to 'null'.
MarkerShadow.prototype.onRemove = function() {
  if (!this.div_) return;
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};

// Set the visibility to 'hidden' or 'visible'.
MarkerShadow.prototype.hide = function() {
  if (this.div_) {
    // The visibility property must be a string enclosed in quotes.
    this.div_.style.visibility = 'hidden';
  }
};

MarkerShadow.prototype.show = function() {
  if (this.div_) {
    this.div_.style.visibility = 'visible';
  }
};




