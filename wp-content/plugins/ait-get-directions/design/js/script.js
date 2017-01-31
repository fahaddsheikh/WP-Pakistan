jQuery(document).ready(function(){
	/* Colorbox Init */
	if(jQuery('.button-plan-my-route').hasClass('button-disabled') == false){
		// init the colorbox only if the button hasnt been disabled
		jQuery('.button-plan-my-route').colorbox({
			inline:true,
			href: jQuery('.button-plan-my-route').parent().find('.directions-popup').clone(true).removeAttr('style'),
			//width: "450px",
			overlayClose: true,
			className: 'directions-colorbox',
		});
	} else {
		jQuery('.button-plan-my-route').on('click', function(e){
			e.preventDefault();
		});
	}
	/* Colorbox Init */

	// this is triggered for the element
	jQuery(document).trigger('get_directions_form_init', {inColorbox: false});
});

jQuery(document).bind('get_directions_form_init', function(e, callerParams){
	jQuery('.directions-form-container').attr('data-incolorbox', callerParams.inColorbox);

	jQuery('.directions-form-container .button-turn-by-turn').on('click', function(e){
		e.preventDefault();
		// get the buttons parent container .. usual way would be .parent().parent() etc
		// this gets the parents to the top of tree untill directions-form-container (we need this to stop somewhere)
		// and because we need the mentioned container we get the last known parent (top) and do .parent() to retrieve the wanted container
		var $formContainer = jQuery(this).parentsUntil('.directions-form-container').last().parent(); 

		var start = $formContainer.find('input[name=directions_address_start]').val();
		var end = $formContainer.find('input[name=directions_address_end]').val();

		var start_geo_lat = $formContainer.find('input[name=directions_address_geolocation_lat]').length > 0 ? $formContainer.find('input[name=directions_address_geolocation_lat]').val() : "";
		var start_geo_lng = $formContainer.find('input[name=directions_address_geolocation_lng]').length > 0 ? $formContainer.find('input[name=directions_address_geolocation_lng]').val() : "";

		if(end !== ""){
			// geo preference
			if(start_geo_lat !== "" && start_geo_lng !== ""){
				start = start_geo_lat+","+start_geo_lng;
				var url = "https://www.google.com/maps/dir/"+start+"/"+end;
				window.open(url);
			} else {
				if(start !== ""){
					var url = "https://www.google.com/maps/dir/"+start+"/"+end;
					window.open(url);
				} else {
					jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-form-start-address-missing'});
				}
			}
		} else {
			jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-form-end-address-missing'});
		}
	});

	jQuery('.directions-form-container .button-get-directions').on('click', function(e){
		e.preventDefault();
		var $formContainer = jQuery(this).parentsUntil('.directions-form-container').last().parent();		
		var $displayContainer = $formContainer.parent().find('.directions-display-container');

		var settings = {};
		settings.map = JSON.parse($formContainer.find('.directions-form').attr('data-ait-map-settings'));
		settings.directions = JSON.parse($formContainer.find('.directions-form').attr('data-ait-directions-settings'));
		settings.directionsVisual = JSON.parse($formContainer.find('.directions-form').attr('data-ait-directions-visual'));

		var start = $formContainer.find('input[name=directions_address_start]').val();
		var end = $formContainer.find('input[name=directions_address_end]').val();
		var start_geo_lat = $formContainer.find('input[name=directions_address_geolocation_lat]').length > 0 ? $formContainer.find('input[name=directions_address_geolocation_lat]').val() : "";
		var start_geo_lng = $formContainer.find('input[name=directions_address_geolocation_lng]').length > 0 ? $formContainer.find('input[name=directions_address_geolocation_lng]').val() : "";
		var runrequest = true;

		if(end == ""){
			jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-form-end-address-missing'});
			runrequest = false;	
		} else {
			// geo preference
			if(start_geo_lat !== "" && start_geo_lng !== ""){
				start = new google.maps.LatLng(start_geo_lat, start_geo_lng);
			} else {
				if(start == ""){
					jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-form-start-address-missing'});
					runrequest = false;
				}
			}
		}
		
		if(runrequest){
			var directionsRequest = {};
			directionsRequest.origin = start;
			directionsRequest.destination = end;
			directionsRequest.travelMode = $formContainer.find('select[name=directions_settings_travelMode]').val();
			directionsRequest.avoidHighways = $formContainer.find('input[name=directions_settings_avoidHighways]').is(':checked');
			directionsRequest.avoidTolls = $formContainer.find('input[name=directions_settings_avoidTolls]').is(':checked');
			
			var routeBoxerRequest = {};			
			/* fix for decimal numbers entered into the input */
			routeBoxerRequest.radius = false;
			if($formContainer.find('input[name=directions_settings_category_radius]').length > 0){
				var inputval = parseFloat($formContainer.find('input[name=directions_settings_category_radius]').val());
				var inputmin = parseFloat($formContainer.find('input[name=directions_settings_category_radius]').attr('min'));
				// here parse the inputunittype .. always convert into km
				var inputunits = $formContainer.find('input[name=directions_settings_category_radius]').attr('data-units');
				
				routeBoxerRequest.radius = inputval <= 0 ? inputmin : inputval;
				routeBoxerRequest.radius = inputunits === 'mi' ? routeBoxerRequest.radius * 1.609344 : routeBoxerRequest.radius;
			}
			/* fix for decimal numbers entered into the input */
			routeBoxerRequest.category = $formContainer.find('select[name=directions_settings_categories]').length > 0 ? $formContainer.find('select[name=directions_settings_categories]').val() : false;
			routeBoxerRequest.runrequest = routeBoxerRequest.radius !== false && routeBoxerRequest.category !== false ? true : false;

			jQuery(document).trigger('get_directions_directions_init', {formContainer: $formContainer, displayContainer: $displayContainer, directionsRequest: directionsRequest, routeBoxerRequest: routeBoxerRequest, settings: settings});
		}
	});

	jQuery('.directions-form-container input[name=directions_address_geolocation]').on('click', function(){
		var $formContainer = jQuery(this).parentsUntil('.directions-form-container').last().parent();

		if(jQuery(this).is(':checked')){
			if(navigator.geolocation) {
				$formContainer.find('.address').addClass('loader');

				navigator.geolocation.getCurrentPosition(function(position){
					$formContainer.find('input[name=directions_address_geolocation_lat]').val(position.coords.latitude);
					$formContainer.find('input[name=directions_address_geolocation_lng]').val(position.coords.longitude);
					// hide the address input
					//$formContainer.find('input[name="directions_address_start"]').parent().parent().hide();
					$startAddress = $formContainer.find('input[name="directions_address_start"]');
					$startAddress.attr('disabled', 'disabled');

					// try google reverse geocode
					var geocoder = new google.maps.Geocoder;
					geocoder.geocode({'location': {lat: position.coords.latitude, lng: position.coords.longitude} }, function(results, status) {
						if (status === google.maps.GeocoderStatus.OK) {
							if (results[1]) {
								$startAddress.val(results[1].formatted_address);
							} else {
								// no results = use default text
								$startAddress.val($startAddress.attr('data-geolocation-text'));
							}
						} else {
							// geocoder failed = use default text
							$startAddress.val($startAddress.attr('data-geolocation-text'));
						}
						
						// hide loader
						$formContainer.find('.address').removeClass('loader');
					});
				}, function(positionError){
					jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-geolocation-error'});
					$formContainer.find("input[name=directions_address_geolocation]").get(0).checked = false;
					// hide loader
					$formContainer.find('.address').removeClass('loader');
				});
			} else {
				jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-no-geolocation-support'});
				$formContainer.find("input[name=directions_address_geolocation]").get(0).checked = false;
			}
		} else {
			// show the address input
			//$formContainer.find('input[name="directions_address_start"]').parent().parent().show();
			$formContainer.find('input[name="directions_address_start"]').val("");
			$formContainer.find('input[name="directions_address_start"]').removeAttr('disabled');
			// clear the lat lng fields
			$formContainer.find('input[name=directions_address_geolocation_lat]').val("");
			$formContainer.find('input[name=directions_address_geolocation_lng]').val("");
		}
	});
});

/* Form Messages */
jQuery(document).bind('get_directions_form_message', function(e, callerParams){
	var $messageContainer = callerParams.container.find('.'+callerParams.msgid);
	$messageContainer.fadeIn(0, function(){
		if(callerParams.container.attr('data-incolorbox') === "true"){
			jQuery.colorbox.resize();
		}
	}).delay(3000).fadeOut(250, function(){
		if(callerParams.container.attr('data-incolorbox') === "true"){
			jQuery.colorbox.resize();
		}
	});
});
/* Form Messages */

jQuery(document).bind('get_directions_form_reset', function(e, callerParams){
	var $formContainer = callerParams.formContainer;
	// text inputs
	$formContainer.find('input[type="text"]').val(""); 
	// selects
	$formContainer.find('select').prop('selectedIndex',0);
	// checkboxes
	$formContainer.find('input[type="checkbox"]').each(function(){
		if(jQuery(this).parentsUntil('.form-input-container').last().attr('data-default-checked')){
			jQuery(this).attr('checked', "checked");
		} else {
			jQuery(this).removeAttr('checked');
		}
	});
});

/* Colorbox */
jQuery(document).bind('cbox_complete', function(){
	// set up pretty selectbox
	if(typeof jQuery.selectbox !== "undefined"){
		jQuery('.directions-form-container select').selectbox();
	}

	// this is triggered for the colorbox
	jQuery(document).trigger('get_directions_form_init', {inColorbox: true});

	jQuery.colorbox.resize();
});
/* Colorbox */

jQuery(document).bind('get_directions_map_init', function(e, callerParams){
	var $formContainer = callerParams.formContainer;
	var $displayContainer = callerParams.displayContainer;	// jQuery object

	if($formContainer.attr('data-incolorbox') === "true"){
		// create new dom to store the map and panel
		// check if the item detail has .map-container .. if hasnt ... create the container near the button 
		if(jQuery('.item-content-wrap .map-container').length != 0){
			// map exist .. use this
			var $oldMapContainer = jQuery('.item-content-wrap .map-container');
			$oldMapContainer.html("");
			$oldMapContainer.addClass('directions-display-container');
			$oldMapContainer.append('<div class="content"><div class="directions-map"><div class="content"></div></div><div class="directions-panel"><div class="content"></div></div></div>');
			$displayContainer = $oldMapContainer;
		} else {
			if(jQuery('.single-ait-item .directions-display-container').length != 0){
				// element is present
				$displayContainer = jQuery('.single-ait-item .directions-display-container');
			} else {
				// create new dom node
				// or dont render the data
			}
		}
	}

	var $mapContainer = $displayContainer.find('.directions-map');
	var $mapContent = $mapContainer.find('.content');
	var $panelContainer = $displayContainer.find('.directions-panel');
	var $panelContent = $panelContainer.find('.content');

	$displayContainer.show();
	$mapContent.height(500);

	var mapSettings = callerParams.settings.map;
	mapSettings.center = {lat: 40.771, lng: -73.974};
	var map = new google.maps.Map($mapContent.get(0), mapSettings);
	
	/* icon setup */
	var directionsVisual = callerParams.settings.directionsVisual;
	var markerLegs = callerParams.directionsResponse.routes[0].legs[0];
	
	var markerStart = new google.maps.Marker({
		position: markerLegs.start_location, 
		map: map
	});

	var markerEnd = new google.maps.Marker({
		position: markerLegs.end_location, 
		map: map
	});

	if(directionsVisual.markerStart !== ""){
		markerStart.setIcon({
			url: directionsVisual.markerStart,
			size: new google.maps.Size( 100, 100 ),
			origin: new google.maps.Point( 0, 0 ),
			anchor: new google.maps.Point( 33, 60 )
		});
	} else {
		markerStart.setIcon({
			url: "http://mt.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=A&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1",
		});
	}

	if(directionsVisual.markerEnd !== ""){
		markerEnd.setIcon({
			url: directionsVisual.markerEnd,
			size: new google.maps.Size( 100, 100 ),
			origin: new google.maps.Point( 0, 0 ),
			anchor: new google.maps.Point( 33, 60 )
		});
	} else {
		markerEnd.setIcon({
			url: "http://mt.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png&text=B&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=1",
		});
	}
	/* icon setup */

	/* route markers */
	if(callerParams.routeBoxerRequest.runrequest){
		var routeBoxer = new RouteBoxer();
		var routeBoxes = routeBoxer.box(callerParams.directionsResponse.routes[0].overview_path, callerParams.routeBoxerRequest.radius);

		var routeBounds = {};
		routeBounds.northEast = [];
		routeBounds.southWest = [];

		for (var i = 0; i < routeBoxes.length; i++){
			routeBounds.northEast[i] = routeBoxes[i].getNorthEast().lat()+","+routeBoxes[i].getNorthEast().lng();
			routeBounds.southWest[i] = routeBoxes[i].getSouthWest().lat()+","+routeBoxes[i].getSouthWest().lng();
		}

		jQuery.ajax(ait.ajax.url, {
			data: {
				'action': 'getRouteItems',
				'data': {
					'category': callerParams.routeBoxerRequest.category,
					'bounds': routeBounds,
				}
			},
			method: 'POST',
			cache: false,
			dataType: 'json',
			success: function(json){
				for(index in json.data){
					jQuery(document).trigger('get_directions_map_attach_marker', {displayContainer: $displayContainer, map: map, item: json.data[index]});
				}				
			},
			error: function(xhr){
				console.error('AIT Get Directions: Ajax failed to retrieve route items');
			},
		});
	}
	/* route markers */

	callerParams.directionsDisplay.setMap(map);
	$panelContent.html("");
	callerParams.directionsDisplay.setPanel($panelContent.get(0));

	/* attach checker for a dom change */
	jQuery(document).trigger('get_directions_panel_change', {panel: $panelContent, directionsVisual: directionsVisual});
	/* attach checker for a dom change */

	/* scroll to container */
	var mapOffset = $mapContent.offset().top;
	if(jQuery('body').hasClass('sticky-menu-enabled')){
		mapOffset = mapOffset - parseInt(jQuery('body').find('.sticky-menu').outerHeight(true));
	}
	if(jQuery('body').hasClass('admin-bar')){
		mapOffset = mapOffset - parseInt(jQuery('body').find('#wpadminbar').outerHeight(true));
	}
	jQuery('html, body').animate({
		scrollTop: mapOffset
	}, 1000);
	/* scroll to container */

	/* map activation button */
	if(Modernizr.touchevents){
		map.setOptions({ draggable : false });
		jQuery(document).trigger('get_directions_map_attach_button', {map: map});
	}
	/* map activation button */
});

jQuery(document).bind('get_directions_directions_init', function(e, callerParams){
	var $formContainer = callerParams.formContainer;	// jQuery object
	
	var directionsSettings = callerParams.settings.directions;

	var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
	var directionsService = new google.maps.DirectionsService;

	var directionsRequest = directionsSettings;
	jQuery.extend( directionsRequest, callerParams.directionsRequest );

	directionsService.route(directionsRequest, function(response, status) {
		switch(status){
			case google.maps.DirectionsStatus.OK:
				// trigger map init
				directionsDisplay.setDirections(response);
				jQuery(document).trigger('get_directions_map_init', {formContainer: callerParams.formContainer, displayContainer: callerParams.displayContainer, directionsDisplay: directionsDisplay, directionsResponse: response, routeBoxerRequest: callerParams.routeBoxerRequest, settings: callerParams.settings});

				if($formContainer.attr('data-incolorbox') === "true"){
					/* reset the form */
					jQuery(document).trigger('get_directions_form_reset', {formContainer: $formContainer});
					/* reset the form */

					jQuery.colorbox.close();
				}
			break;
			case google.maps.DirectionsStatus.NOT_FOUND:
				// address not found error
				jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-address-not-found'});
			break;
			case google.maps.DirectionsStatus.ZERO_RESULTS:
				// route not found error
				jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-route-not-found'});
			break;
			default:
				// all other error => google.maps.DirectionsStatus.UNKNOWN_ERROR 
				jQuery(document).trigger('get_directions_form_message', {container: $formContainer, msgid: 'directions-undefined-error'});
			break;
		}
	});
});

jQuery(document).bind('get_directions_map_attach_marker', function(e, callerParams){
	var $displayContainer = callerParams.displayContainer;

	var map = callerParams.map;
	var item = callerParams.item;

	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(item.marker.position.lat, item.marker.position.lng),
		title: item.marker.title,
		icon: item.marker.icon,
		map: map,
	});
	marker.addListener('click', function(){
		$displayContainer.find('.infoBox').remove();

		var infoWindow = new InfoBox({
			pixelOffset: new google.maps.Size(-145, -203),
			closeBoxURL: item.close_image,
			enableEventPropagation: true,
			zIndex: 99,
			disableAutoPan: false,
			maxWidth: 150,
			infoBoxClearance: new google.maps.Size(1, 1),
			boxStyle: {
				background: "white",
				opacity: 1,
				width: "290px"
			}
		});

		infoWindow.setContent(item.infobox);
		infoWindow.open(map, marker);
		map.panTo(marker.getPosition());
	});
});

jQuery(document).bind('get_directions_panel_change', function(e, callerParams){
	var checkInterval = setInterval(function(){
		// check for dom change
		if(callerParams.panel.html() != ""){
			var $markerStart = callerParams.panel.find('img:first');
			var $markerEnd = callerParams.panel.find('img:last');
			
			if(callerParams.directionsVisual.markerStart !== ""){
				$markerStart.attr('src', callerParams.directionsVisual.markerStart);
				$markerStart.css({'width': '40px'});
			}
			if(callerParams.directionsVisual.markerEnd !== ""){
				$markerEnd.attr('src', callerParams.directionsVisual.markerEnd);
				$markerEnd.css({'width': '40px'});
			}

			clearInterval(checkInterval);
		}
	}, 100);
});

jQuery(document).bind('get_directions_map_attach_button', function(e, callerParams){
	var map = callerParams.map;

	var button = document.createElement('div');
	button.className = "draggable-toggle-button";
	
	var innerhtmlstyle = 'style="font-size: 14px"'
	button.innerHTML = '<i class="fa fa-lock" '+innerhtmlstyle+'></i>';
	
	button.style.margin = "10px";
	button.style.borderRadius = "2px";

	button.onclick = function(e){
		if(jQuery(this).hasClass('active')){
			jQuery(this).removeClass('active').html('<i class="fa fa-lock" '+innerhtmlstyle+'></i>');
			map.setOptions({ draggable : false });
		} else {
			jQuery(this).addClass('active').html('<i class="fa fa-unlock" '+innerhtmlstyle+'></i>');
			map.setOptions({ draggable : true });
		}
	};
	map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(button);
});

/* functionality to get directions to the marker displayed on map */
/* beta for now */
/*jQuery(document).bind('get_directions_map_infobox_directions', function(e, callerParams){
	var $caller = jQuery(callerParams.caller.srcElement);	// this is the span on which the user clicked
	var $parent = $caller.parent();	// this should be a

	var lat = parseFloat($parent.attr('data-position-lat'));
	var lng = parseFloat($parent.attr('data-position-lng'));

	var $displayContainer = $caller.parentsUntil('.directions-display-container').last().parent();
	var $formContainer = $displayContainer.parent().find('.directions-form-container');	// only in element .. try the length
	
	var settings = {};
	settings.map = JSON.parse($formContainer.find('.directions-form').attr('data-ait-map-settings'));
	settings.directions = JSON.parse($formContainer.find('.directions-form').attr('data-ait-directions-settings'));
	settings.directionsVisual = JSON.parse($formContainer.find('.directions-form').attr('data-ait-directions-visual'));

	var start = $formContainer.find('input[name=directions_address_start]').val();
	var start_geo_lat = $formContainer.find('input[name=directions_address_geolocation_lat]').length > 0 ? $formContainer.find('input[name=directions_address_geolocation_lat]').val() : "";
	var start_geo_lng = $formContainer.find('input[name=directions_address_geolocation_lng]').length > 0 ? $formContainer.find('input[name=directions_address_geolocation_lng]').val() : "";
	if(start_geo_lat !== "" && start_geo_lng !== ""){
		start = new google.maps.LatLng(start_geo_lat, start_geo_lng);
	}

	var directionsRequest = {};
	directionsRequest.origin = start;	// this should be the the original requests place
	directionsRequest.destination = lat+", "+lng;
	directionsRequest.travelMode = $formContainer.find('select[name=directions_settings_travelMode]').val();
	directionsRequest.avoidHighways = $formContainer.find('input[name=directions_settings_avoidHighways]').is(':checked');
	directionsRequest.avoidTolls = $formContainer.find('input[name=directions_settings_avoidTolls]').is(':checked');

	var routeBoxerRequest = {};			
	routeBoxerRequest.radius = $formContainer.find('input[name=directions_settings_category_radius]').length > 0 ? parseInt($formContainer.find('input[name=directions_settings_category_radius]').val()) : false;
	routeBoxerRequest.category = $formContainer.find('select[name=directions_settings_categories]').length > 0 ? $formContainer.find('select[name=directions_settings_categories]').val() : false;
	routeBoxerRequest.runrequest = routeBoxerRequest.radius !== false && routeBoxerRequest.category !== false ? true : false;

	jQuery(document).trigger('get_directions_directions_init', {
		formContainer: $formContainer, 
		displayContainer: $displayContainer, 
		directionsRequest: directionsRequest, 
		routeBoxerRequest: routeBoxerRequest, 
		settings: settings
	});
});*/
/* beta for now */
/* function to get directions to the marker displayed on map */