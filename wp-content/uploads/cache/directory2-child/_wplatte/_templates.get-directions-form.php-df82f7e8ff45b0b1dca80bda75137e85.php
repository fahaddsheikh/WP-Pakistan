<?php //netteCache[01]000590a:2:{s:4:"time";s:21:"0.04928800 1485769606";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:104:"C:\xampp\htdocs\local_bepakistan\wp-content\plugins\ait-get-directions\templates\get-directions-form.php";i:2;i:1481664224;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\plugins\ait-get-directions\templates\get-directions-form.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'y09jtpoqa0')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//

$directionsSettings = AitGetDirections::getDirectionsSettings(true);
$formSettings 		= AitGetDirections::getFormSettings();

$avoidHighways 	= $directionsSettings['avoidHighways'] ? 'checked="checked"' : '';
$avoidTolls 	= $directionsSettings['avoidTolls'] ? 'checked="checked"' : '';

$destinationAddress = !empty($inputsValues['directions_address_end']) ? $inputsValues['directions_address_end'] : '';

/* DESTINATION ADDRESS OVERRIDE */
// in every occasion the destination address is an array from the map input [address|latitude|longitude|etc]
// we just need a string representation, either "address" or "lat, lng"
// lat 0, lng 0 - default position .. dont use
// lat 0, lng 1 - can use / not a default
// lat 1, lng 0 - can use / not a default
// lat 1, lng 1 - default position .. dont use

$dAddress = "";
$dAddressLat = '';
$dAddressLng = '';

// if lat or lng are not empty
if(!empty($destinationAddress['latitude']) && !empty($destinationAddress['longitude'])){
	// and they are not on the default positions
	if(floatval($destinationAddress['latitude']) != 1 && floatval($destinationAddress['longitude']) != 1){
		if(floatval($destinationAddress['latitude']) != 0 && floatval($destinationAddress['longitude']) != 0){
			$dAddressLat = $destinationAddress['latitude'];
			$dAddressLng = $destinationAddress['longitude'];
		}
	}
}

// location preference
if(!empty($dAddressLat) && !empty($dAddressLng)){
	$dAddress = $dAddressLat.', '.$dAddressLng;
} else {
	if(!empty($destinationAddress['address'])){
		$dAddress = $destinationAddress['address'];
	}
}
/* DESTINATION ADDRESS OVERRIDE */

/* CATEGORY AND RADIUS OVERRIDE */
$terms = get_terms("ait-items");
// if there are no terms ... no inputs
if(!isset($inputsOverride)){
	$inputsOverride = array();
}
// if there are categories ..  get the user settings for the inputs
$inputsOverride['categories'] = is_array($terms) && !empty($terms) ? $formSettings['formInputCategoryEnable'] : false;
$inputsOverride['categoryRadius'] = is_array($terms) && !empty($terms) ? $formSettings['formInputRadiusEnable'] : false;
/* CATEGORY AND RADIUS OVERRIDE */

/* CATEGORY HACK TO ADD ALL */
// add "All" to the first position
if(is_array($terms) && !empty($terms)){
	array_unshift($terms, (object)array(
		'term_id' 	=> -1,
		'slug' 		=> 'all',
		'name' 		=> __('All', 'ait-get-directions'),
	));
}
/* CATEGORY HACK TO ADD ALL  */

/* ITEM DETAIL HACK */
// when the categories input is disabled, but radius input is enabled in the theme options ... use the items category to set the default category
// this enables user to view map markers from the same category around the route
// note > for element the $categoryDefaultId will be always -1 to show items from all categories
$categoryDefaultId = -1; // this is a custom id meaning to show all categories .. see line 58 to 64 .. mainly line 60
if(isset($item)){
	// $item object contains $post data / this data is passed by get-directions-button because he is rendered on a single detail page, so $post is avalaible
	// always should be WpLattePostEntity
	$post_terms = get_the_terms($item->id, 'ait-items');
	if(is_array($post_terms) && !empty($post_terms)){
		// get the first term to be the default
		// future idea ... return all term_ids to view the markers from all categories
		$categoryDefaultId = $post_terms[0]->term_id;
	}
}
/* ITEM DETAIL HACK */

// use config to enable / disable each input
$enabledInputs = array(
	'startAddress'		=> true,
	'endAddress'		=> true,
	'geolocation'		=> $formSettings['formInputGeolocation'],
	'travelMode'		=> true,
	'avoidHighways'		=> true,
	'avoidTolls'		=> true,
	'categories'		=> defined('AIT_THEME_TYPE') && AIT_THEME_TYPE == 'directory' ? true : false,
	'categoryRadius'	=> defined('AIT_THEME_TYPE') && AIT_THEME_TYPE == 'directory' ? true : false,
);
$inputsOverride = isset($inputsOverride) ? $inputsOverride : array();
$enabledInputs = array_merge($enabledInputs, $inputsOverride);

$columnInputsCount = 0;
if($enabledInputs['startAddress']){ $columnInputsCount++; }
if($enabledInputs['endAddress'] && empty($dAddress)){ $columnInputsCount++; }
if($enabledInputs['travelMode']){ $columnInputsCount++; }
if($enabledInputs['categories']){ $columnInputsCount++; }
?>

<div class="directions-form-container">
	<div class="content">

		<div class="directions-form" data-ait-map-settings="<?php echo NTemplateHelpers::escapeHtml(AitGetDirections::getMapSettings(), ENT_COMPAT) ?>
" data-ait-directions-settings="<?php echo NTemplateHelpers::escapeHtml(AitGetDirections::getDirectionsSettings(), ENT_COMPAT) ?>
" data-ait-directions-visual="<?php echo NTemplateHelpers::escapeHtml(AitGetDirections::getDirectionsVisual(), ENT_COMPAT) ?>">
			<div class="content">

				<div class="form-inputs">

					<div class="col panel">

						<?php if($enabledInputs['geolocation']) { ?>
						<div class="form-input-container">
							<div class="input-container" data-default-chacked="true">
								<input type="hidden" name="directions_address_geolocation_lat" value="" />
								<input type="hidden" name="directions_address_geolocation_lng" value="" />
								<label class="input-container-checkbox">
									<input type="checkbox" name="directions_address_geolocation" value="true" />
									<div class="custom-checkbox">
										<div class="custom-checkbox-control"><i class="fa fa-times"></i></div>
										<span><?php _e('Use geolocation', 'ait-get-directions') ?></span>
									</div>
								</label>
							</div>
						</div>
						<?php } ?>

						<?php if($enabledInputs['avoidHighways']) { ?>
						<div class="form-input-container">
							<div class="input-container" data-default-checked="<?php echo NTemplateHelpers::escapeHtml($directionsSettings['avoidHighways'], ENT_COMPAT) ?>">
								<label class="input-container-checkbox">
								<input type="checkbox" name="directions_settings_avoidHighways" value="true" <?php echo NTemplateHelpers::escapeHtml($avoidHighways, ENT_COMPAT) ?> />
									<div class="custom-checkbox">
										<div class="custom-checkbox-control"><i class="fa fa-times"></i></div>
										<span><?php _e('Avoid Highways', 'ait-get-directions') ?></span>
									</div>
								</label>
							</div>
						</div>
						<?php } ?>

						<?php if($enabledInputs['avoidTolls']) { ?>
						<div class="form-input-container">
							<div class="input-container" data-default-checked="<?php echo NTemplateHelpers::escapeHtml($directionsSettings['avoidTolls'], ENT_COMPAT) ?>">
								<label class="input-container-checkbox">
									<input type="checkbox" name="directions_settings_avoidTolls" value="true" <?php echo NTemplateHelpers::escapeHtml($avoidTolls, ENT_COMPAT) ?> />
									<div class="custom-checkbox">
										<div class="custom-checkbox-control"><i class="fa fa-times"></i></div>
										<span><?php _e('Avoid Tolls', 'ait-get-directions') ?></span>
									</div>
								</label>
							</div>
						</div>
						<?php } ?>

						<?php if($enabledInputs['categoryRadius']) { ?>
						<div class="form-input-container">
							<div class="input-container type-number">
								<label><?php echo sprintf( __("Radius to show items on route (%s)", 'ait-get-directions'), $formSettings['formInputRadiusUnits']) ?></label>
								<input type="number" name="directions_settings_category_radius" min="0.1" max="1000" step="0.1" value="<?php echo $formSettings['formInputRadiusDefaultValue'] ?>
" data-units="<?php echo $formSettings['formInputRadiusUnits'] ?>" />
							</div>
						</div>
						<?php } else { ?>
						<?php // if the input is disabled but category input is enabled, render hidden input with default radius ?>
							<?php if($enabledInputs['categories']) { ?>
							<div class="form-input-container" style="display: none">
								<div class="input-container type-number">
									<label><?php echo sprintf( __("Radius to show items on route (%s)", 'ait-get-directions'), $formSettings['formInputRadiusUnits']) ?></label>
									<input type="hidden" name="directions_settings_category_radius" value="<?php echo $formSettings['formInputRadiusDefaultValue'] ?>
" data-units="<?php echo $formSettings['formInputRadiusUnits'] ?>" />
								</div>
							</div>
							<?php } ?>
						<?php } ?>

					</div>

					<div class="col inputs" data-inputs="<?php echo $columnInputsCount ?>">

						<?php if($enabledInputs['startAddress']) { ?>
						<div class="form-input-container address">
							<div class="label-container">
								<label><?php _e('Start address', 'ait-get-directions') ?></label>
							</div>
							<div class="input-container">
								<input type="text" name="directions_address_start" placeholder="<?php echo AitLangs::getCurrentLocaleText($formSettings['formStartAddressPlaceholder']) ?>
" data-geolocation-text="<?php echo __('My actual position', 'ait-get-directions') ?>" />
								<i class="fa fa-circle-o-notch"></i>
							</div>
						</div>
						<?php } ?>

						<?php if($enabledInputs['endAddress']) { ?>
						<?php $style = !empty($dAddress) ? 'style="display: none"' : '' ?>
						<div class="form-input-container" <?php echo $style ?>>
							<div class="label-container">
								<label><?php _e('Destination address', 'ait-get-directions') ?></label>
							</div>
							<div class="input-container">
								<?php if(!empty($dAddress)) { ?>
								<input type="hidden" name="directions_address_end" placeholder="<?php echo AitLangs::getCurrentLocaleText($formSettings['formDestinationAddressPlaceholder']) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($dAddress, ENT_COMPAT) ?>" />
								<?php } else { ?>
								<input type="text" name="directions_address_end" placeholder="<?php echo AitLangs::getCurrentLocaleText($formSettings['formDestinationAddressPlaceholder']) ?>" />
								<?php } ?>
							</div>
						</div>
						<?php } ?>

						<?php if($enabledInputs['travelMode']) { ?>
						<div class="form-input-container">
							<div class="label-container">
								<label><?php _e('Choose travel mode', 'ait-get-directions') ?></label>
							</div>
							<div class="input-container">
								<select name="directions_settings_travelMode">
									<option value="DRIVING" <?php echo $directionsSettings['travelMode'] == 'DRIVING' ? 'selected="selected"' : '' ?>
 ><?php _e('Driving', 'ait-get-directions') ?></option>
									<option value="BICYCLING" <?php echo $directionsSettings['travelMode'] == 'BICYCLING' ? 'selected="selected"' : '' ?>
 ><?php _e('Bicycling', 'ait-get-directions') ?></option>
									<option value="TRANSIT" <?php echo $directionsSettings['travelMode'] == 'TRANSIT' ? 'selected="selected"' : '' ?>
 ><?php _e('Transit', 'ait-get-directions') ?></option>
									<option value="WALKING" <?php echo $directionsSettings['travelMode'] == 'WALKING' ? 'selected="selected"' : '' ?>
 ><?php _e('Walking', 'ait-get-directions') ?></option>
								</select>
							</div>
						</div>
						<?php } ?>

						<!-- CUSTOM FUNCTIONALITY -->
						<?php if($enabledInputs['categories']) { ?>
						<div class="form-input-container">
							<div class="label-container">
								<label><?php _e('Categories to show on road', 'ait-get-directions') ?></label>
							</div>
							<div class="input-container">
								<select name="directions_settings_categories">
								<?php foreach ($terms as $term) { ?>
									<option value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						<?php } else { ?>
							<?php if($enabledInputs['categoryRadius']) { ?>
							<?php // if the input is disabled but radius input is enabled, render hidden input with default category -1 ?>
							<?php // if the form is rendered on single detail page and this alternative occurs ... get the items category id ?>
							<div class="form-input-container" style="display: none">
								<div class="label-container">
									<label><?php _e('Categories to show on road', 'ait-get-directions') ?></label>
								</div>
								<div class="input-container">
									<select name="directions_settings_categories" disabled="true">
										<option value="<?php echo $categoryDefaultId ?>" selected="selected"><?php echo __('All', 'ait-get-directions') ?></option>
									</select>
								</div>
							</div>
							<?php } ?>
						<?php } ?>

						<!-- CUSTOM FUNCTIONALITY -->

					</div>
				</div>

				<!-- BUTTONS -->

				<div class="form-buttons">
					<div class="form-input-container">
						<div class="input-container">
							<a href="#" class="ait-sc-button button-get-directions simple">
								<span class="container">
									<span class="wrap">
										<span class="text" style="text-align:center;">
											<span class="title" style=""><?php echo AitLangs::getCurrentLocaleText($formSettings['formButtonGetDirectionsLabel']) ?></span>
										</span>
									</span>
								</span>
							</a>
						</div>
					</div>

					<div class="form-input-container">
						<div class="input-container">
							<a href="#" class="ait-sc-button button-turn-by-turn simple">
								<span class="container">
									<span class="wrap">
										<span class="text" style="text-align:center;">
											<span class="title" style=""><?php echo AitLangs::getCurrentLocaleText($formSettings['formButtonTurnByTurnLabel']) ?></span>
										</span>
									</span>
								</span>
							</a>
						</div>
					</div>
				</div>
				<!-- BUTTONS -->

			</div>
		</div>

		<div class="directions-messages">
			<div class="content">

				<div class="ait-sc-notification info directions-no-geolocation-support" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageNoGeolocationSupport']) ?>
					</div>
				</div>

				<div class="ait-sc-notification attention directions-geolocation-error" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageGeolocationError']) ?>
					</div>
				</div>

				<div class="ait-sc-notification attention directions-form-start-address-missing" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageStartAddressMissing']) ?>
					</div>
				</div>

				<div class="ait-sc-notification attention directions-form-end-address-missing" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageDestinationAddressMissing']) ?>
					</div>
				</div>

				<div class="ait-sc-notification attention directions-route-not-found" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageRouteNotFound']) ?>
					</div>
				</div>

				<div class="ait-sc-notification attention directions-address-not-found" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageAddressNotFound']) ?>
					</div>
				</div>

				<div class="ait-sc-notification error directions-undefined-error" style="display: none">
					<div class="notify-wrap">
						<?php echo AitLangs::getCurrentLocaleText($formSettings['messageUnknownError']) ?>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
