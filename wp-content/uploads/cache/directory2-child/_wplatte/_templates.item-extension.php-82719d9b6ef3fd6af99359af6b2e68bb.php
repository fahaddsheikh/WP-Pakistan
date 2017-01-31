<?php //netteCache[01]000584a:2:{s:4:"time";s:21:"0.10229100 1485769606";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:99:"C:\xampp\htdocs\local_bepakistan\wp-content\plugins\ait-item-extension\templates\item-extension.php";i:2;i:1481664248;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\plugins\ait-item-extension\templates\item-extension.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'mua2wsw3qy')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//

$aitItemExtensionGeneralSettings = AitItemExtension::getGeneralSettings();

$displaySection = $aitItemExtensionGeneralSettings['section_display'];

$role = AitItemExtension::getUserPackage();
if($role != false){
	$post_meta = get_post_meta(get_the_ID(), '_ait-item_item-extension', true);
	$storedValueCount = 0;
	foreach(AitItemExtension::getGeneralOptions($role) as $index => $options){
		
		if(is_array($post_meta) && !empty($post_meta)){
			// use the stored value instead of default value from general options
			if($post_meta[ $options['type'] ][ $options['uid'] ] != ""){
				$storedValueCount = $storedValueCount + 1;
			} else {
				if($options['value'] != ""){
					$storedValueCount = $storedValueCount + 1;
				}
			}
		}
	}

	if($storedValueCount == 0){
		$displaySection = "off";
	}
} else {
	$displaySection = "off";
}


if($displaySection == "on"){
?>
<div class="item-extension-container">
	
	<?php 
		$title = AitLangs::getCurrentLocaleText($aitItemExtensionGeneralSettings['section_title'], __('Item Extension', 'ait-item-extension'));
		if($title != ""){
			echo '<h2>'.$title.'</h2>';
		}

		$desc = AitLangs::getCurrentLocaleText($aitItemExtensionGeneralSettings['section_description'], "");
		if($desc != ""){
			echo '<p>'.$desc.'</p>';
		}
?>

	<div class="content">
	<?php
	$role = AitItemExtension::getUserPackage();
	if($role != false){
		$post_meta = get_post_meta(get_the_ID(), '_ait-item_item-extension', true);
		foreach(AitItemExtension::getGeneralOptions($role) as $index => $options){
			
			if(is_array($post_meta) && !empty($post_meta)){
				// use the stored value instead of default value from general options
				$storedValue = $post_meta[ $options['type'] ][ $options['uid'] ] != "" ? $post_meta[ $options['type'] ][ $options['uid'] ] : $options['value'];
				$options['value']  = $storedValue;
			}

			// maybe dont show the input at all
			$showInput = $options['value'] != ""; // this may be modified from the admin in the future
			// if there is no value defined in the item and there is no default value for the input in theme admin
			$options['value'] = $options['value'] == "" ? "-" : $options['value']; 
			// this is overkill setting the empty value to "-" but when the $showInput will be managed from the admin and it will be set up to show the empty inputs, there need to be something to render

			switch($options['type']){
				case 'url':
					if($showInput){
?> 
					<div class="field-container">
						<div class="field-content">
							<div class="field-title"><h5><?php echo AitLangs::getCurrentLocaleText($options['label']) ?></h5></div>
							<div class="field-data"><p><a href="<?php echo $options['value'] ?>" target="_blank"><?php echo $options['value'] ?></a></p></div>
						</div>
					</div>
					<?php }
				break;
				case 'tel':
					if($showInput){
?> 
					<div class="field-container">
						<div class="field-content">
							<div class="field-title"><h5><?php echo AitLangs::getCurrentLocaleText($options['label']) ?></h5></div>
							<div class="field-data"><p><a href="tel: <?php echo $options['value'] ?>"><?php echo $options['value'] ?></a></p></div>
						</div>
					</div>
					<?php }
				break;
				case 'email':
					if($showInput){
?> 
					<div class="field-container">
						<div class="field-content">
							<div class="field-title"><h5><?php echo AitLangs::getCurrentLocaleText($options['label']) ?></h5></div>
							<div class="field-data"><p><a href="mailto: <?php echo $options['value'] ?>
"><?php echo $options['value'] ?></a></p></div>
						</div>
					</div>
					<?php }
				break;
				case 'onoff':
					if($showInput){
?> 
					<div class="field-container">
						<div class="field-content">
							<div class="field-title"><h5><?php echo AitLangs::getCurrentLocaleText($options['label']) ?></h5></div>
							<div class="field-data"><p><?php echo $options['value'] == 'on' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-remove"></i>' ?></p></div>
						</div>
					</div>
					<?php }
				break;
				default:
					if($showInput){
?> 
					<div class="field-container">
						<div class="field-content">
							<div class="field-title"><h5><?php echo AitLangs::getCurrentLocaleText($options['label']) ?></h5></div>
							<div class="field-data"><p><?php echo $options['value'] ?></p></div>
						</div>
					</div>
					<?php }
				break;
			}
		}
	} else {
		_e('No extension fields available', 'ait-item-extension');	
	}
?>
	</div>
</div>
<?php } 