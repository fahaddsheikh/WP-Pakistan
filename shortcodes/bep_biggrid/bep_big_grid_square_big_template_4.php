<?php

$return_string .=	"<div class='{$prefix}module_mx5 {$prefix}animation-stack {$prefix}big-grid-post-0 {$prefix}big-grid-post {$prefix}big-thumb'>";
$return_string .=		"<div class='{$prefix}module-thumb'>";
$return_string .=			"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>";
$return_string .=				 get_the_post_thumbnail( get_the_id() ,  'bep_649x500' );
$return_string .=			"</a>";
$return_string .=		"</div>";           
$return_string .=		"<div class='{$prefix}meta-info-container'>";
$return_string .=			"<div class='{$prefix}meta-align''>";
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
$return_string .=						"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>" . get_the_title() . "</a>";
$return_string .=					"</h3>";               
$return_string .=				"</div>";
$return_string .=				"<div class='{$prefix}module-meta-info'>";
$return_string .=					"<span class='{$prefix}post-author-name'>";
$return_string .=			"<a href=". get_author_posts_url( get_the_author_meta( get_the_id() ), get_the_author_meta( 'user_nicename' ) ) . ">" . get_the_author() . "</a>";
$return_string .=						"<span style='margin: 0 3px;'>-</span>	";
$return_string .=					"</span>";               
$return_string .=					"<span class='{$prefix}post-date'>";
$return_string .=						"<time class='entry-date updated td-module-date' datetime='" . get_the_date('c' , get_the_id()) . "'>" . get_the_date('F j,Y' , get_the_id()) . "</time>";
$return_string .=					"</span>";  
$return_string .=				"</div>";
$return_string .=			"</div>";
$return_string .=		"</div>";
$return_string .=	"</div>";

?>