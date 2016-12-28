// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    console.log( "ready!" );

    // Checks if the .bep-seach div exists. 
    // if exists = true then: move the search bar template inside the .bep-search div.
    if ( $( ".bep-search" ).length ) {
    	$( ".bep-search" ).append( $( ".header-search-wrap" ) );
    	console.log("bep-search exists");
    }

    // Checks if the .page-profiles div exists. 
    // if exists = true then: 
    // Add post_type = profiles to add search for profiles.
    // Remove radius functionality.
    // Remove radius value from form as an input type.
    
    if ( $( ".page-profiles" ).length ) {
    	$( ".bep-search form .searchinput-wrap" ).append( $( "<input type='hidden' name='post_type' value='profile'>" ) );
    	$( ".radius" ).remove();
    	$( "input[name='a']" ).remove();
    	console.log("page-profiles exists");
    }





    /* RADIUS SCRIPT */

    var lat,
        lon,
        tmp = [];
    window.location.search
    //.replace ( "?", "" )
    // this is better, there might be a question mark inside
    .substr(1)
    .split("&")
    .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === 'lat'){
            lat = decodeURIComponent(tmp[1]);
        }
        if (tmp[0] === 'lon'){
            lon = decodeURIComponent(tmp[1]);
        }
    });
    var coordinatesSet = false;
    if(typeof lat != 'undefined' & typeof lon != 'undefined') {
        coordinatesSet = true;
    }

    var $radiusContainer = jQuery('#bep_custom-search-form .radius');
    var $radiusToggle = $radiusContainer.find('.radius-toggle');
    var $radiusDisplay = $radiusContainer.find('.radius-display');
    var $radiusPopup = $radiusContainer.find('.radius-popup-container');

    $radiusToggle.click(function(e, invoker){
        if(invoker == 'advanced-search') {
            coordinatesSet = true;
        }
        jQuery(this).removeClass('radius-input-visible').addClass('radius-input-hidden');
        $radiusContainer.find('input').each(function(){
            jQuery(this).removeAttr('disabled');
        });
        $radiusDisplay.removeClass('radius-input-hidden').addClass('radius-input-visible');

        $radiusDisplay.trigger('click');

        $radiusDisplay.find('.radius-value').html($radiusPopup.find('input').val());
        $radiusPopup.find('.radius-value').html($radiusPopup.find('input').val());
    });

    $radiusDisplay.click(function(){
        $radiusPopup.removeClass('radius-input-hidden').addClass('radius-input-visible');
        if(!coordinatesSet) {
            setGeoData();
        }
    });
    $radiusDisplay.find('.radius-clear').click(function(e){
        e.stopPropagation();
        $radiusDisplay.removeClass('radius-input-visible').addClass('radius-input-hidden');
        $radiusContainer.find('input').each(function(){
            jQuery(this).attr('disabled', true);
        });
        $radiusPopup.find('.radius-popup-close').trigger('click');
        $radiusToggle.removeClass('radius-input-hidden').addClass('radius-input-visible');
        $radiusContainer.removeClass('radius-set');
    });
    $radiusPopup.find('.radius-popup-close').click(function(e){
        e.stopPropagation();
        $radiusPopup.removeClass('radius-input-visible').addClass('radius-input-hidden');
    });
    $radiusPopup.find('input').change(function(){
        $radiusDisplay.find('.radius-value').html(jQuery(this).val());
        $radiusPopup.find('.radius-value').html(jQuery(this).val());
    });

    /* RADIUS SCRIPT */

    function setGeoData() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            jQuery("#latitude-search").attr('value', pos.lat());
            jQuery("#longitude-search").attr('value', pos.lng());
        });
    }
}

});