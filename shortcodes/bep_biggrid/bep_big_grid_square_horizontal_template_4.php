<?php
$bep_selectedtype = get_post_type(); 
	$return_string .=	"<div class='{$prefix}module_mx11 {$prefix}animation-stack {$prefix}big-grid-post-1 {$prefix}big-grid-post {$prefix}medium-thumb'>	";
	$return_string .=		"<div class='{$prefix}module-thumb'>	";
	$return_string .=			"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>	";
								if ($bep_selectedtype == 'ait-event-pro') {
									$bep_selectedtype_array = get_post_meta(get_the_id(), '_ait-event-pro_event-pro-data', true);
	$return_string .= 				"<img width='649' height='500' src='" . $bep_selectedtype_array['headerImage'] . "'>";							
								}
									else {
	$return_string .=				 get_the_post_thumbnail( get_the_id() ,  'bep_649x500' );
								}
	$return_string .=			"</a>";
	$return_string .=		"</div>";        
	$return_string .=		"<div class='{$prefix}meta-info-container'>	";
	$return_string .=			"<div class='{$prefix}meta-align'>	";
	$return_string .=				"<div class='{$prefix}big-grid-meta'>	";
										$bep_selectedtype = get_post_type();
										if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
	$return_string.='						<span class="bep_post-category">';
											if ($bep_selectedtype == 'ait-item') {
	$return_string.='							Business';
											}
											elseif ($bep_selectedtype == 'post') {
	$return_string.='							Blog';
											}
											elseif ($bep_selectedtype == 'ait-event-pro') {
	$return_string.='							Event';
											}
											elseif ($bep_selectedtype == 'profile') {
	$return_string.='							Profile';
											}
	$return_string.='						</span>';
										}                  
	$return_string .=					"<h3 class='entry-title {$prefix}module-title'>";
	$return_string .=						"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>" . get_the_title() . "</a>	";
	$return_string .=					"</h3>";            
	$return_string .=				"</div>";
	$return_string .=			"</div>";
	$return_string .=		"</div>";
	$return_string .=	"</div>"; 
?>