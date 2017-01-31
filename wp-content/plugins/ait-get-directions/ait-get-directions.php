<?php

/*
Plugin Name: AIT Get Directions
Plugin URI: http://ait-themes.club
Description: Adds Get Directions functionality for AIT themes
Version: 2.8
Author: AitThemes.Club
Author URI: http://ait-themes.club
Text Domain: ait-get-directions
Domain Path: /languages
License: GPLv2 or later
*/

/* DEV NOTES */
// future ideas >
// >>>>>> add button "get directions" to marker infobox and refresh current directions map with new position
// >>>>>> use google places api to autocomplete address inputs / frontend
/* DEV NOTES */

define("AIT_GET_DIRECTIONS_ENABLED" , true);

AitGetDirections::init();

class AitGetDirections {
	protected static $themeOptionsKey;

	protected static $currentTheme;
	protected static $compatibleThemes;
	protected static $paths;

	public static function init(){
		$theme = wp_get_theme();
		self::$currentTheme = $theme->parent() != false ? $theme->parent()->stylesheet : $theme->stylesheet;	// this return parent theme on active child theme
		self::$compatibleThemes = array('skeleton', 'cityguide', 'directory2', 'eventguide', 'foodguide', 'businessfinder2');

		self::$themeOptionsKey = sanitize_key(get_stylesheet()); // because theme options are stored _ait_{$theme}_theme_opts and on child theme _ait_{$childTheme}_theme_opts

		self::$paths = array(
			'config' => dirname( __FILE__ ).'/config',
			'design' => dirname( __FILE__ ).'/design',
			'templates'	 => dirname( __FILE__ ).'/templates',
		);

		// WP Plugin functions
		register_activation_hook( __FILE__, array(__CLASS__, 'onActivation') );
		register_deactivation_hook(  __FILE__, array(__CLASS__, 'onDeactivation') );
		add_action('after_switch_theme', array(__CLASS__, 'themeSwitched'));

		add_action('plugins_loaded', array(__CLASS__, 'onLoaded'));

		add_action('init', array(__CLASS__, 'onInit'));

		// Element Configuration Options
		add_action('ait-theme-run', array(__CLASS__, 'elementExternalClassFile'));
		add_filter('ait-elements-config', array(__CLASS__, 'elementConfig') , 13);
		add_filter('ait-element-options-file', array(__CLASS__, 'elementOptionsFile') , 13, 2);
		add_filter('ait-element-options-filename', array(__CLASS__, 'elementOptionsFileName') , 13, 2);
		add_filter('ait-theme-configuration', array(__CLASS__, 'elementThemeConfiguration'), 13);

		// Template functions
		add_filter('wplatte-get-template-part', array(__CLASS__, 'getTemplate'), 10, 3);

		// Design functions
		add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueueDesign') );

		// Ajax functions
		add_action('wp_ajax_nopriv_getRouteItems', array(__CLASS__, 'ajaxGetRouteItems'));
		add_action('wp_ajax_getRouteItems', array(__CLASS__, 'ajaxGetRouteItems'));
	}

	/* WP PLUGIN FUNCTIONS */
	public static function onActivation(){
		AitGetDirections::checkPluginCompatibility(true);

		AitGetDirections::updateThemeOptions();

		flush_rewrite_rules();
		self::cleanThemeCache();
	}


	public static function onDeactivation(){
		add_filter('ait-elements-config', array(__CLASS__, 'elementConfigDeactivate') , 13);
		
		flush_rewrite_rules();
		self::cleanThemeCache();
	}

	public static function themeSwitched(){
		AitGetDirections::checkPluginCompatibility();
	}

	protected static function cleanThemeCache(){
		if(class_exists('AitCache')){
			AitCache::clean();
		}
	}

	public static function checkPluginCompatibility($die = false){
		if ( !in_array(self::$currentTheme, self::$compatibleThemes) ) {
			require_once(ABSPATH . 'wp-admin/includes/plugin.php' );
			deactivate_plugins(plugin_basename( __FILE__ ));
			if($die){
				wp_die('Current theme is not compatible with Get Directions plugin :(', '',  array('back_link'=>true));
			} else {
				add_action( 'admin_notices', function(){
					echo "<div class='error'><p>" . _x('Current theme is not compatible with Get Directions plugin!', 'ait-claim-listing') . "</p></div>";
				} );
			}
		}
	}

	public static function onLoaded(){
		load_plugin_textdomain('ait-get-directions', false,  dirname(plugin_basename(__FILE__ )) . '/languages');

		add_filter('ait-theme-config',array(__CLASS__, 'prepareThemeConfig'));
	}

	public static function onInit(){
		wp_register_script( 'googlemaps-routeBoxer', plugins_url( '/design/js/libs/RouteBoxer.js' , __FILE__ ), array('jquery'));
		wp_register_script( 'ait-get-directions-frontend', plugins_url( '/design/js/script.js' , __FILE__ ), array('jquery', 'googlemaps-api', 'jquery-colorbox', 'googlemaps-routeBoxer', 'modernizr'));
	}
	/* WP PLUGIN FUNCTIONS */

	/* CONFIGURATION FUNCTIONS */
	public static function loadThemeConfig($type = 'raw'){
		$config = include self::$paths['config'].'/theme-options.php';
		return $config[$type];
	}

	public static function prepareThemeConfig($config = array()){
		$plugin = AitGetDirections::loadThemeConfig();

		if(count($config) == 0){
			$theme = self::$themeOptionsKey;
			$config = get_option("_ait_{$theme}_theme_opts", array());
			$plugin = AitGetDirections::loadThemeConfig('defaults');
		}

		return array_merge($config, $plugin);
	}

	public static function updateThemeOptions(){
		// check if the settings already exists
		$theme = self::$themeOptionsKey;
		$themeOptions = get_option("_ait_{$theme}_theme_opts");

		if(!isset($themeOptions['getDirections'])){
			// check for old settings instance
			$updatedConfig = AitGetDirections::prepareThemeConfig();

			// update function from old data format to new
			$oldConfig = get_option('ait_directions_options', array());
			$updatedConfig = AitGetDirections::mergeOldConfiguration($oldConfig, $updatedConfig);

			update_option("_ait_{$theme}_theme_opts", $updatedConfig);
		}
	}

	public static function mergeOldConfiguration($oldConfig, $currentConfig){
		if(is_array($oldConfig) && !empty($oldConfig)){
			$currentConfig['getDirections']['unitSystem']						= $oldConfig['unitSystem'];

			$currentConfig['getDirections']['mapType']							= $oldConfig['mapTypeId'];

			$currentConfig['getDirections']['disableDoubleClickZoom']			= filter_var($oldConfig['disableDoubleClickZoom'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['draggable']						= filter_var($oldConfig['draggable'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['scrollwheel']						= filter_var($oldConfig['scrollwheel'], FILTER_VALIDATE_BOOLEAN);

			$currentConfig['getDirections']['disableDefaultUi']					= filter_var($oldConfig['disableDefaultUI'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['mapTypeControl']					= filter_var($oldConfig['mapTypeControl'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['panControl']						= filter_var($oldConfig['panControl'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['rotateControl']					= filter_var($oldConfig['rotateControl'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['zoomControl']						= filter_var($oldConfig['zoomControl'], FILTER_VALIDATE_BOOLEAN);

			$currentConfig['getDirections']['landscapeColor']					= $oldConfig['landscape'];
			$currentConfig['getDirections']['poiColor']							= $oldConfig['poi'];
			$currentConfig['getDirections']['roadsColor']						= $oldConfig['road'];
			$currentConfig['getDirections']['transitsColor']					= $oldConfig['transit'];
			$currentConfig['getDirections']['waterColor']						= $oldConfig['water'];

			$currentConfig['getDirections']['formInputGeolocation']				= filter_var($oldConfig['geolocation'], FILTER_VALIDATE_BOOLEAN);
			$currentConfig['getDirections']['formButtonPlanMyRouteLabel']		= $oldConfig['buttonLabel'];
			$currentConfig['getDirections']['formButtonGetDirectionsLabel']		= $oldConfig['formButtonLabel'];
		}
		return $currentConfig;
	}

	public static function getThemeOptions(){
		return (object)aitOptions()->getOptionsByType('theme');
	}

	public static function getPluginThemeOptions(){
		$themeOptions = AitGetDirections::getThemeOptions();
		return $themeOptions->getDirections;
	}

	public static function getPluginUrl($path){
		$url = plugins_url( $path , __FILE__ );
		return $url;
	}
	/* CONFIGURATION FUNCTIONS */

	/* ELEMENT CONFIGURATION FUNCTIONS */
	public static function elementConfig($localConfig){
		$elementConfig = include dirname(__FILE__).'/elements/get-directions/get-directions.php';
		$localConfig['get-directions'] = $elementConfig;
		return $localConfig;
	}

	public static function elementConfigDeactivate($localConfig){
		unset($localConfig['get-directions']);
		return $localConfig;
	}

	public static function elementExternalClassFile(){
		include dirname(__FILE__).'/elements/get-directions/AitGetDirectionsElement.php';
	}

	public static function elementOptionsFile($file, $elementId){
		if($elementId === 'get-directions'){
			$file = dirname(__FILE__).'/elements/get-directions/get-directions.options.neon';
		}
		return $file;
	}

	public static function elementOptionsFileName($filename, $elementId){
		if($elementId === 'get-directions'){
			$filename = '/elements/get-directions/get-directions.options.neon';
		}
		return $filename;
	}

	public static function elementThemeConfiguration($themeConfiguration){
		array_push($themeConfiguration['ait-theme-support']['elements'], 'get-directions');
		return $themeConfiguration;
	}
	/* ELEMENT CONFIGURATION FUNCTIONS */

	/* TEMPLATE FUNCTIONS */
	public static function getTemplate($templates, $slug, $name){
		$ok = true;
		foreach(glob(self::$paths['templates'] . '/*.php') as $file){
			$filename = basename($file, '.php');
			if(!self::contains($slug, $filename)){
				$ok = false;
			}else{
				$ok = true;
				break;
			}
		}

		if(!$ok){
			return $templates;
		}

		// create name of file
		// e.g. 'parts/entry-date-format-<NAME>-loop.php'
		// e.g. 'parts/entry-date-format-<NAME>.php'
		if($name){
			//if(!is_singular()) $templates[] = "{$slug}-{$name}-loop.php";
			$templates[] = "{$slug}-{$name}.php";
		}

		// e.g. 'parts/entry-date-format-loop.php'
		// e.g. 'parts/entry-date-format.php'
		//if(!is_singular()) $templates[] = "{$slug}-loop.php";
			$templates[] = "{$slug}.php";

		$locatedInTheme = locate_template($templates, false, false);


		$pluginDir = self::$paths['templates'];

		if(!$locatedInTheme){ // in theme file does not exist, load it from plugin
			$newTemplate = '';
			foreach($templates as $tmpl){
				$tmpl = basename($tmpl);

				if(file_exists("$pluginDir/$tmpl")){
					$newTemplate = "$pluginDir/$tmpl";
				}else{
					continue;
				}
			}
			if(!$newTemplate){
				trigger_error("Template '$tmpl' does not exist in plugin dir nor theme dir");
			}
			return $newTemplate;
		} else {
			return $locatedInTheme; // exist in theme
		}
	}
	/* TEMPLATE FUNCTIONS */

	/* DESIGN FUNCTIONS */
	public static function enqueueDesign(){
		// styles
		$assetPath = file_exists(aitPath('css').'/ait-get-directions.css') ? aitUrl('css').'/ait-get-directions.css' : plugins_url( '/design/css/frontend.css' , __FILE__ );
		wp_enqueue_style( 'ait-get-directions-frontend', $assetPath, false, false, 'screen' );

		// scripts
		wp_enqueue_script('ait-get-directions-frontend');
	}
	/* DESIGN FUNCTIONS */

	/* HELPER FUNCTIONS */
	public static function contains($haystack, $needle){
		return strpos($haystack, $needle) !== FALSE;
	}

	public static function getMapSettings($raw = false){
		$themeOptions = AitGetDirections::getPluginThemeOptions();

		$settings = array(
			'mapTypeId'					=> $themeOptions['mapType'],
			'zoom'						=> 10,

			'disableDefaultUi'			=> filter_var($themeOptions['disableDefaultUi'], FILTER_VALIDATE_BOOLEAN),
			'disableDoubleClickZoom'	=> filter_var($themeOptions['disableDoubleClickZoom'], FILTER_VALIDATE_BOOLEAN),
			'draggable'					=> filter_var($themeOptions['draggable'], FILTER_VALIDATE_BOOLEAN),
			'scrollwheel'				=> filter_var($themeOptions['scrollwheel'], FILTER_VALIDATE_BOOLEAN),

			'fullscreenControl'			=> filter_var($themeOptions['fullscreenControl'], FILTER_VALIDATE_BOOLEAN),
			'mapTypeControl'			=> filter_var($themeOptions['mapTypeControl'], FILTER_VALIDATE_BOOLEAN),
			'overviewMapControl'		=> filter_var($themeOptions['overviewMapControl'], FILTER_VALIDATE_BOOLEAN),
			'panControl'				=> filter_var($themeOptions['panControl'], FILTER_VALIDATE_BOOLEAN),
			'rotateControl'				=> filter_var($themeOptions['rotateControl'], FILTER_VALIDATE_BOOLEAN),
			'scaleControl'				=> filter_var($themeOptions['scaleControl'], FILTER_VALIDATE_BOOLEAN),
			'signInControl'				=> filter_var($themeOptions['signInControl'], FILTER_VALIDATE_BOOLEAN),
			'streetViewControl'			=> filter_var($themeOptions['streetViewControl'], FILTER_VALIDATE_BOOLEAN),
			'zoomControl'				=> filter_var($themeOptions['zoomControl'], FILTER_VALIDATE_BOOLEAN),

			'styles'					=> array(
				(object)array(
					'stylers' => array(
						(object)array('hue'			=> $themeOptions['mapColor']),
						(object)array('saturation'	=> $themeOptions['mapSaturation']),
						(object)array('brightness'	=> $themeOptions['mapBrightness']),
					)
				),
				(object)array(
					'featureType' => 'administrative',
					'stylers' => array(
						(object)array('visibility'	=> $themeOptions['administrativeShow'] == true ? 'on' : 'off'),
						(object)array('hue'			=> $themeOptions['administrativeColor']),
						(object)array('saturation'	=> $themeOptions['administrativeColor'] != "" ? $themeOptions['objectSaturation'] : ''),
						(object)array('brightness'	=> $themeOptions['administrativeColor'] != "" ? $themeOptions['objectBrightness'] : ''),
					)
				),
				(object)array(
					'featureType' => 'landscape',
					'stylers' => array(
						(object)array('visibility'	=> $themeOptions['landscapeShow'] == true ? 'on' : 'off'),
						(object)array('hue'			=> $themeOptions['landscapeColor']),
						(object)array('saturation'	=> $themeOptions['landscapeColor'] != "" ? $themeOptions['objectSaturation'] : ''),
						(object)array('brightness'	=> $themeOptions['landscapeColor'] != "" ? $themeOptions['objectBrightness'] : ''),
					)
				),
				(object)array(
					'featureType' => 'poi',
					'stylers' => array(
						(object)array('visibility'	=> $themeOptions['poiShow'] == true ? 'on' : 'off'),
						(object)array('hue'			=> $themeOptions['poiColor']),
						(object)array('saturation'	=> $themeOptions['poiColor'] != "" ? $themeOptions['objectSaturation'] : ''),
						(object)array('brightness'	=> $themeOptions['poiColor'] != "" ? $themeOptions['objectBrightness'] : ''),
					)
				),
				(object)array(
					'featureType' => 'roads',
					'stylers' => array(
						(object)array('visibility'	=> $themeOptions['roadsShow'] == true ? 'on' : 'off'),
						(object)array('hue'			=> $themeOptions['roadsColor']),
						(object)array('saturation'	=> $themeOptions['roadsColor'] != "" ? $themeOptions['objectSaturation'] : ''),
						(object)array('brightness'	=> $themeOptions['roadsColor'] != "" ? $themeOptions['objectBrightness'] : ''),
					)
				),
				(object)array(
					'featureType' => 'transit',
					'stylers' => array(
						(object)array('visibility'	=> $themeOptions['transitsShow'] == true ? 'on' : 'off'),
						(object)array('hue'			=> $themeOptions['transitsColor']),
						(object)array('saturation'	=> $themeOptions['transitsColor'] != "" ? $themeOptions['objectSaturation'] : ''),
						(object)array('brightness'	=> $themeOptions['transitsColor'] != "" ? $themeOptions['objectBrightness'] : ''),
					)
				),
				(object)array(
					'featureType' => 'water',
					'stylers' => array(
						(object)array('visibility'	=> $themeOptions['waterShow'] == true ? 'on' : 'off'),
						(object)array('hue'			=> $themeOptions['waterColor']),
						(object)array('saturation'	=> $themeOptions['waterColor'] != "" ? $themeOptions['objectSaturation'] : ''),
						(object)array('brightness'	=> $themeOptions['waterColor'] != "" ? $themeOptions['objectBrightness'] : ''),
					)
				),
			),
		);

		return $raw ? $settings : json_encode((object)$settings);
	}

	public static function getDirectionsSettings($raw = false){
		$themeOptions = AitGetDirections::getPluginThemeOptions();

		$settings = array(
			'avoidHighways'	=> filter_var($themeOptions['avoidHighways'], FILTER_VALIDATE_BOOLEAN),
			'avoidTolls'	=> filter_var($themeOptions['avoidTolls'], FILTER_VALIDATE_BOOLEAN),
			'travelMode'	=> $themeOptions['travelMode'],
			'unitSystem'	=> intval($themeOptions['unitSystem']),
		);

		return $raw ? $settings : json_encode((object)$settings);
	}

	public static function getDirectionsVisual($raw = false){
		$themeOptions = AitGetDirections::getPluginThemeOptions();

		$settings = array(
			'markerStart'	=> $themeOptions['directionsIconStart'],
			'markerEnd'		=> $themeOptions['directionsIconEnd'],
		);

		return $raw ? $settings : json_encode((object)$settings);
	}

	public static function getFormSettings(){
		$themeOptions = AitGetDirections::getPluginThemeOptions();

		$settings = array(
			'formInputGeolocation'				=> filter_var($themeOptions['formInputGeolocation'], FILTER_VALIDATE_BOOLEAN),
			'formInputCategoryEnable'			=> filter_var($themeOptions['formInputCategoryEnable'], FILTER_VALIDATE_BOOLEAN),
			'formInputRadiusEnable'				=> filter_var($themeOptions['formInputRadiusEnable'], FILTER_VALIDATE_BOOLEAN),
			'formInputRadiusDefaultValue'		=> intval($themeOptions['formInputRadiusDefaultValue']),
			'formInputRadiusUnits'				=> intval($themeOptions['unitSystem']) == 0 ? 'km' : 'mi',

			'formButtonPlanMyRouteLabel'		=> $themeOptions['formButtonPlanMyRouteLabel'],
			'formButtonGetDirectionsLabel'		=> $themeOptions['formButtonGetDirectionsLabel'],
			'formButtonTurnByTurnLabel'			=> $themeOptions['formButtonTurnByTurnLabel'],
			'formStartAddressPlaceholder'		=> $themeOptions['formStartAddressPlaceholder'],
			'formDestinationAddressPlaceholder' => $themeOptions['formDestinationAddressPlaceholder'],
			'messageNoGeolocationSupport'		=> $themeOptions['messageNoGeolocationSupport'],
			'messageGeolocationError'			=> $themeOptions['messageGeolocationError'],
			'messageStartAddressMissing'		=> $themeOptions['messageStartAddressMissing'],
			'messageDestinationAddressMissing'	=> $themeOptions['messageDestinationAddressMissing'],
			'messageRouteNotFound'				=> $themeOptions['messageRouteNotFound'],
			'messageAddressNotFound'			=> $themeOptions['messageAddressNotFound'],
			'messageUnknownError'				=> $themeOptions['messageUnknownError'],
		);

		return $settings;
	}

	public static function getItemIcon($itemId, $defaultIcon){
		$options = AitGetDirections::getThemeOptions();
		$item_terms = get_the_terms($itemId, 'ait-items');

		$icon = $options->items['categoryDefaultPin'];

		if (!$item_terms) {
			$item_terms = array();
		}

		foreach ($item_terms as $cat) {
			$parent = get_term($cat->parent, 'ait-items');
			$cat_options = get_option('ait-items_category_'.$cat->term_id);

			if (!empty($cat_options['map_icon'])) {
				$icon = $cat_options['map_icon'];
			} elseif(isset($parent) && !($parent instanceof WP_Error)) {
				$parent_options = get_option('ait-items_category_'.$parent->term_id);
				if (!empty($parent_options['map_icon'])) {
					$icon = $parent_options['map_icon'];
				}
			}
		}

		return !empty($icon) ? $icon : $defaultIcon;
	}
	/* HELPER FUNCTIONS */

	/* AJAX FUNCTIONS */
	public static function ajaxGetRouteItems(){
		// get item markers based on the defined route and specified radius from routeboxer js library
		$result = array(
			'data' => array(),
		);

		$themeOptions = AitGetDirections::getThemeOptions();

		$term_id = $_POST['data']['category'];
		if($term_id == -1){
			$terms = get_terms("ait-items");
			$term_id = wp_list_pluck( $terms, 'term_id');
		}

		if(!empty($_POST['data']['category'])){
			$query = new WP_Query(array(
				'post_type' => 'ait-item',
				'post_status' => 'publish',
				'nopaging' => true,
				'tax_query' => array(
					array(
						'taxonomy'	=> 'ait-items',
						'field'		=> 'term_id',
						'terms'		=> $term_id,
					),
				),
			));
		}

		// if there are any items in the category, check them against the bounds
		if(!empty($query->posts)){
			if(!empty($_POST['data']['bounds'])){

				for($i = 0; $i < min(count($_POST['data']['bounds']['northEast']), count($_POST['data']['bounds']['southWest'])); $i++){
					$northEast = explode(',', $_POST['data']['bounds']['northEast'][$i]);
					$southWest = explode(',', $_POST['data']['bounds']['southWest'][$i]);

					$bounds = array(
						'northEast' => array(
							'lat' => floatval($northEast[0]),
							'lng' => floatval($northEast[1]),
						),
						'southWest' => array(
							'lat' => floatval($southWest[0]),
							'lng' => floatval($southWest[1]),
						),
					);

					foreach($query->posts as $post){
						$meta = get_post_meta($post->ID, '_ait-item_item-data', true);

						if(isset($meta['map']['latitude']) && isset($meta['map']['longitude'])){
							$lat = floatval($meta['map']['latitude']);
							$lng = floatval($meta['map']['longitude']);

							if($bounds['southWest']['lat'] < $lat && $bounds['northEast']['lat'] > $lat){
								if($bounds['southWest']['lng'] < $lng && $bounds['northEast']['lng'] > $lng){
									// this item is in the bounds
									$icon = AitGetDirections::getItemIcon($post->ID, AitGetDirections::getPluginUrl('/design/img/marker_default.png'));

									// infobox data
									$close_image = AitGetDirections::getPluginUrl('/design/img/infobox_close.png');

									$image_default = $themeOptions->item['noFeatured'];
									$image = wp_get_attachment_url(get_post_meta($post->ID , '_thumbnail_id' , true ));
									$image = $image != "" ? $image : $image_default;
									$image = aitResizeImage( $image , array('width' => 145, 'height' => 180, 'crop' => 1));

									$permalink = get_permalink($post->ID);

									/* functionality to get directions to the marker displayed on map */
									/* beta for now */
									$directionsButton = "";
									//$directionsButton = '<a href="#" onclick="event.preventDefault(); jQuery(document).trigger(\'get_directions_map_infobox_directions\', {caller: event})" data-position-lat="'.$meta['map']['latitude'].'" data-position-lng="'.$meta['map']['longitude'].'"><span class="item-button">Get Directions</span></a>';
									/* beta for now */
									/* functionality to get directions to the marker displayed on map */

									// ready js item
									$item = array(
										'marker' => array(
											'title' => $post->post_title,
											'position' => array(
												'lat' => $meta['map']['latitude'],
												'lng' => $meta['map']['longitude'],
											),
											'icon' => $icon,
										),
										'infobox' => '<div class="headermap-infowindow-container"><div class="item-data"><h3>'.$post->post_title.'</h3><span class="item-address">'.$meta['map']['address'].'</span><a href="'.get_permalink($post->ID).'"><span class="item-button">Show More</span></a>'.$directionsButton.'</div><div class="item-picture"><img src="'.$image.'" alt="image"></div></div>',
										'close_image' => $close_image,
									);

									array_push($result['data'], $item);
								}
							}

						}
					}
				}
			}
		}

		echo json_encode($result);
		exit();
	}
	/* AJAX FUNCTIONS */
}