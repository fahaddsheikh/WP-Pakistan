<?php
$formSettings = AitGetDirections::getFormSettings();

/* DISABLE BUTTON */
// button is disabled if the adress or latitude or longitude is missing from item
$dAddressLat = '';
$dAddressLng = '';
$buttonClass = 'button-disabled';
// if lat or lng are not empty
if(!empty($meta->map['latitude']) && !empty($meta->map['longitude'])){
	// and they are not on the default positions
	if(floatval($meta->map['latitude']) != 1 && floatval($meta->map['longitude']) != 1){
		if(floatval($meta->map['latitude']) != 0 && floatval($meta->map['longitude']) != 0){
			$dAddressLat = $meta->map['latitude'];
			$dAddressLng = $meta->map['longitude'];
		}
	}
}

// if address is not empty
if(!empty($meta->map['address'])){
	$buttonClass = "";
} else {
	// if it is empty, check the lat, lng values
	if(!empty($dAddressLat) && !empty($dAddressLng)){
		$buttonClass = "";
	}
}
/* DISABLE BUTTON */
?>

<div class="directions-button-container">
	<div class="content">

		<a href="#" class="ait-sc-button button-plan-my-route {$buttonClass}">
			<span class="container">
				<span class="wrap">
					<span class="text">
						<span class="title" style=""><?php echo AitLangs::getCurrentLocaleText($formSettings['formButtonPlanMyRouteLabel']) ?></span>
					</span>
				</span>
			</span>
		</a>

		<div class="directions-popup" style="display: none">
			{*includePart get-directions-form,
				inputsOverride => array('categories' => false, 'categoryRadius' => false),
				inputsValues => array('directions_address_end' => $meta->map)
			*}

			{includePart get-directions-form, 
				inputsValues => array('directions_address_end' => $meta->map),
				item => $post
			}
		</div>

	</div>
</div>
