<?php //netteCache[01]000592a:2:{s:4:"time";s:21:"0.00328500 1485769606";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:106:"C:\xampp\htdocs\local_bepakistan\wp-content\plugins\ait-get-directions\templates\get-directions-button.php";i:2;i:1481664224;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\plugins\ait-get-directions\templates\get-directions-button.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '0t2iz3pzz9')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//

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

		<a href="#" class="ait-sc-button button-plan-my-route <?php echo NTemplateHelpers::escapeHtml($buttonClass, ENT_COMPAT) ?>">
			<span class="container">
				<span class="wrap">
					<span class="text">
						<span class="title" style=""><?php echo AitLangs::getCurrentLocaleText($formSettings['formButtonPlanMyRouteLabel']) ?></span>
					</span>
				</span>
			</span>
		</a>

		<div class="directions-popup" style="display: none">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("get-directions-form", ""), array('inputsValues' => array('directions_address_end' => $meta->map),
				'item' => $post) + get_defined_vars(), $_l->templates['0t2iz3pzz9'])->render() ?>
		</div>

	</div>
</div>
