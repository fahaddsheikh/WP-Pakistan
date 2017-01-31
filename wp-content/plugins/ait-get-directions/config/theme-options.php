<?php

return array(
	'raw' => array(
		'getDirections' => array(
			'title' => __('Get Directions', 'ait-get-directions'),
			'options' => array(
				array('section' => array('id' => 'directions-basic', 'title' => __('Directions Setup', 'ait-get-directions'))),

				'avoidHighways' => array(
					'label' => __('Avoid Highways', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Default value of option, can be changed on the frontend', 'ait-get-directions'),
				),

				'avoidTolls' => array(
					'label' => __('Avoid Tolls', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Default value of option, can be changed on the frontend', 'ait-get-directions'),
				),

				'travelMode' => array(
					'label' => __('Travel Mode', 'ait-get-directions'),
					'type' => 'select',
					'selected' => 'DRIVING',
					'default' => array(
						'DRIVING' => 'Driving',
						'BICYCLING' => 'Bicycling',
						'TRANSIT' => 'Transit',
						'WALKING' => 'Walking',
					),
					'help' => __('Default value of option, can be changed on the frontend', 'ait-get-directions'),
				),

				'unitSystem' => array(
					'label' => __('Unit System', 'ait-get-directions'),
					'type' => 'select',
					'selected' => '0',
					'default' => array(
						'1' => 'Imperial',
						'0' => 'Metric',
					),
					'help' => __('Units used for displayed route', 'ait-get-directions'),
				),

				array('section' => array('id' => 'directions-visual', 'title' => __('Directions Visual', 'ait-get-directions'))),

				'directionsIconStart' => array(
					'label' => __('Start Marker Icon', 'ait-get-directions'),
					'type' => 'image',
					'default'=> AitGetDirections::getPluginUrl("/design/img/marker_start.png"),
					'less' => false,
				),

				'directionsIconEnd' => array(
					'label' => __('Destination Marker Icon', 'ait-get-directions'),
					'type' => 'image',
					'default' => AitGetDirections::getPluginUrl("/design/img/marker_end.png"),
					'less' => false,
				),

				array('section' => array('id' => 'map-basic', 'title' => __('Map Setup', 'ait-get-directions'))),

				'mapType' => array(
					'label' => __('Map Type', 'ait-get-directions'),
					'type' => 'select',
					'selected' => 'roadmap',
					'default' => array(
						'hybrid' => 'Hybrid',
						'roadmap' => 'Roadmap',
						'satellite' => 'Satellite',
						'terrain' => 'Terrain',
					),
					'help' => __('Select type of Google Map', 'ait-get-directions'),
				),

				array('section' => array('id' => 'map-behaviour', 'title' => __('Map Behaviour', 'ait-get-directions'))),

				'disableDoubleClickZoom' => array(
					'label' => __('Disable Double Click Zoom', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Disable zoom of map after mouse button click', 'ait-get-directions'),
				),

				'draggable' => array(
					'label' => __('Draggable Map', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Allow or disallow dragging of the map', 'ait-get-directions'),
				),

				'scrollwheel' => array(
					'label' => __('MouseWheel Zoom', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Allow or disallow zoom with mouse wheel', 'ait-get-directions'),
				),

				array('section' => array('id' => 'map-controls', 'title' => __('Map Controls', 'ait-get-directions'))),

				'disableDefaultUi' => array(
					'label' => __('Disable Default UI', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable default map UI', 'ait-get-directions'),
				),

				'fullscreenControl' => array(
					'label' => __('Fullscreen Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable fullscreen control', 'ait-get-directions'),
				),

				'mapTypeControl' => array(
					'label' => __('Map Type Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Enable / Disable map type control', 'ait-get-directions'),
				),

				'overviewMapControl'  => array(
					'label' => __('Overview Map Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable overview map control', 'ait-get-directions'),
				),

				'panControl' => array(
					'label' => __('Pan Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable pan control', 'ait-get-directions'),
				),

				'rotateControl' => array(
					'label' => __('Rotate Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable rotate control', 'ait-get-directions'),
				),

				'scaleControl' => array(
					'label' => __('Scale Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable scale control', 'ait-get-directions'),
				),

				'signInControl' => array(
					'label' => __('SignIn Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable sign in control', 'ait-get-directions'),
				),

				'streetViewControl' => array(
					'label' => __('StreetView Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => false,
					'help' => __('Enable / Disable streetview control', 'ait-get-directions'),
				),

				'zoomControl' => array(
					'label' => __('Zoom Control', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Enable / Disable zoom control', 'ait-get-directions'),
				),

				array('section' => array('id' => 'map-visual', 'title' => __('Map Visual', 'ait-get-directions'))),

				'mapColor' => array(
					'label' => __('Map Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map', 'ait-get-directions'),
				),

				'mapSaturation' => array(
					'label' => __('Map Saturation', 'ait-get-directions'),
					'type' => 'range',
					'min' => -100,
					'max' => 100,
					'step' => 1,
					'default' => 0,
					'less' => false,
					'help' => __('Saturation level of Google Map', 'ait-get-directions'),
				),

				'mapBrightness' => array(
					'label' => __('Map Brightness', 'ait-get-directions'),
					'type' => 'range',
					'min' => -100,
					'max' => 100,
					'step' => 1,
					'default' => 0,
					'less' => false,
					'help' => __('Brightness level of Google Map', 'ait-get-directions'),
				),

				'objectSaturation' => array(
					'label' => __('Object Saturation', 'ait-get-directions'),
					'type' => 'range',
					'min' => -100,
					'max' => 100,
					'step' => 1,
					'default' => 0,
					'less' => false,
					'help' => __('Saturation level of Google Map objects', 'ait-get-directions'),
				),

				'objectBrightness' => array(
					'label' => __('Object Brightness', 'ait-get-directions'),
					'type' => 'range',
					'min' => -100,
					'max' => 100,
					'step' => 1,
					'default' => 0,
					'less' => false,
					'help' => __('Brightness level of Google Map objects', 'ait-get-directions'),
				),

				'administrativeShow' => array(
					'label' => __('Display administratives', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
				),

				'administrativeColor' => array(
					'label' => __('Administratives Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map administrative areas', 'ait-get-directions'),
				),

				'landscapeShow' => array(
					'label' => __('Display Landscapes', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
				),

				'landscapeColor' => array(
					'label' => __('Landscapes Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map landscape', 'ait-get-directions'),
				),

				'poiShow' => array(
					'label' => __('Display POI', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
				),

				'poiColor' => array(
					'label' => __('POI Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map Points Of Interest', 'ait-get-directions'),
				),

				'roadsShow' => array(
					'label' => __('Display roads', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
				),

				'roadsColor' => array(
					'label' => __('Roads Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map roads', 'ait-get-directions'),
				),

				'transitsShow' => array(
					'label' => __('Display transits', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
				),

				'transitsColor' => array(
					'label' => __('Transits Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map roads', 'ait-get-directions'),
				),

				'waterShow' => array(
					'label' => __('Display water', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
				),

				'waterColor' => array(
					'label' => __('Water Hue', 'ait-get-directions'),
					'type' => 'color',
					'default' => '',
					'less' => false,
					'help' => __('Hue color of Google Map water', 'ait-get-directions'),
				),

				array('section' => array('id' => 'form-setup', 'title' => __('Form Setup', 'ait-get-directions'))),

				'formInputGeolocation' => array(
					'label' => __('Enable Geolocation', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Allow or disallow visitors to use geolocation', 'ait-get-directions'),
				),

				'formInputCategoryEnable' => array(
					'label' => __('Enable Category Input', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Enable selection of Item Categories in the form, appliable for directory type themes', 'ait-get-directions'),
				),

				'formInputRadiusEnable' => array(
					'label' => __('Enable Radius Input', 'ait-get-directions'),
					'type' => 'on-off',
					'default' => true,
					'help' => __('Enable radius option in the form, appliable for directory type themes', 'ait-get-directions'),
				),

				'formInputRadiusDefaultValue' => array(
					'label' => __('Radius Input Default Value', 'ait-get-directions'),
					'type' => 'range',
					'min' => 1,
					'max' => 1000,
					'default' => 1,
					'help' => __('Define radius in kilometers around the route to display Item markers', 'ait-get-directions'),
				),

				'formButtonPlanMyRouteLabel' => array(
					'label' => __('Plan My Route Button Label', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Plan My Route', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'formButtonGetDirectionsLabel' => array(
					'label' => __('Get Directions Button Label', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Get Directions', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'formButtonTurnByTurnLabel' => array(
					'label' => __('TurnByTurn Button Label', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Turn-by-turn navigation', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'formStartAddressPlaceholder' => array(
					'label' => __('Start Address Placeholder', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Example: 330 Adams Street Brooklyn, NY 11201, US', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'formDestinationAddressPlaceholder' => array(
					'label' => __('Destination Address Placeholder', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Example: 330 Adams Street Brooklyn, NY 11201, US', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'messageNoGeolocationSupport' => array(
					'label' => __('No Geolocation Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Your browser does not support geolocation', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'messageGeolocationError' => array(
					'label' => __('Geolocation Error Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Could not determine your location, check if geolocation is enabled for this site', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'messageStartAddressMissing' => array(
					'label' => __('Start Address Missing Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Start address is missing, please fill start address or use geolocation', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),	
				),

				'messageDestinationAddressMissing' => array(
					'label' => __('Destination Address Missing Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('Destination address is missing, please fill destination address', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),	
				),

				'messageRouteNotFound' => array(
					'label' => __('Route Not Found Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __('No route to this destination, change the travel mode or use another start address', 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'messageAddressNotFound' => array(
					'label' => __('Address Not Found Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __("Can't find the address you entered", 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),

				'messageUnknownError' => array(
					'label' => __('Unknown Error Message', 'ait-get-directions'),
					'type' => 'text',
					'default' => __("There was an error during the request. Try again later or contact administrator", 'ait-get-directions'),
					'help' => __('', 'ait-get-directions'),
				),
			),
		),
	),
	'defaults' => array(
		'getDirections' => array(
			/* Directions Setup */
			'avoidHighways'						=> true,
			'avoidTolls'						=> true,
			'travelMode'						=> 'DRIVING',
			'unitSystem'						=> '0',
			/* Directions Setup */

			/* Directions Visual */
			'directionsIconStart'				=> AitGetDirections::getPluginUrl('/design/img/marker_start.png'),
			'directionsIconEnd'					=> AitGetDirections::getPluginUrl('/design/img/marker_end.png'),
			/* Directions Visual */

			/* Map Setup */
			'mapType'							=> 'roadmap',
			/* Map Setup */
			
			/* Map Behaviour */			
			'disableDoubleClickZoom'			=> false,
			'draggable'							=> true,
			'scrollwheel'						=> true,
			/* Map Behaviour */
			
			/* Map Controls */
			'disableDefaultUi'					=> false,
			'fullscreenControl'					=> false,
			'mapTypeControl'					=> true,
			'overviewMapControl'				=> false,
			'panControl'						=> false,
			'rotateControl'						=> false,
			'scaleControl'						=> false,
			'signInControl'						=> false,
			'streetViewControl'					=> false,
			'zoomControl'						=> true,
			/* Map Controls */

			/* Map Visual */
			'mapColor'							=> '',
			'mapSaturation'						=> 0,
			'mapBrightness'						=> 0,
			'objectSaturation'					=> 0,
			'objectBrightness'					=> 0,
			'administrativeShow'				=> true,
			'administrativeColor'				=> '',
			'landscapeShow'						=> true,
			'landscapeColor'					=> '',
			'poiShow'							=> true,
			'poiColor'							=> '',
			'roadsShow'							=> true,
			'roadsColor'						=> '',
			'waterShow'							=> true,
			'waterColor'						=> '',
			/* Map Visual */

			/* Form Setup */
			'formInputGeolocation'				=> true,
			'formInputCategoryEnable'			=> true,
			'formInputRadiusEnable'				=> true,
			'formInputRadiusDefaultValue'		=> 1,

			'formButtonPlanMyRouteLabel'		=> __('Plan My Route', 'ait-get-directions'),
			'formButtonGetDirectionsLabel'		=> __('Get Directions', 'ait-get-directions'),
			'formButtonTurnByTurnLabel'			=> __('Turn-by-turn navigation', 'ait-get-directions'),
			'formStartAddressPlaceholder'		=> __('Example: 330 Adams Street Brooklyn, NY 11201, US', 'ait-get-directions'),
			'formDestinationAddressPlaceholder'	=> __('Example: 330 Adams Street Brooklyn, NY 11201, US', 'ait-get-directions'),

			'messageNoGeolocationSupport'		=> __('Your browser does not support geolocation', 'ait-get-directions'),
			'messageGeolocationError'			=> __('Could not determine your location, check if geolocation is enabled for this site', 'ait-get-directions'),
			'messageStartAddressMissing'		=> __('Start address is missing, please fill start address or use geolocation', 'ait-get-directions'),
			'messageDestinationAddressMissing'	=> __('Destination address is missing, please fill destination address', 'ait-get-directions'),
			'messageRouteNotFound'				=> __('No route to this destination, change the travel mode or use another start address', 'ait-get-directions'),
			'messageAddressNotFound'			=> __("Can't find the address you entered", 'ait-get-directions'),
			'messageUnknownError'				=> __("There was an error during the request. Try again later or contact administrator", 'ait-get-directions'),
			/* Form Setup */
		)
	)
);

