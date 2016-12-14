<?php

$return_string .=	"<div class='{$prefix}biggrid {$prefix}biggrid_square_big'>";
$return_string .=		"<div class='{$prefix}biggrid_thumb'>";
$return_string .=			"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>";
$return_string .=				"<img width='649' height='500' src='" . wp_get_attachment_image_src(get_post_thumbnail_id($id), 'biggrid-large-square', false)[0] . "' title='" . get_the_title() . "'>";
$return_string .=			"</a>";
$return_string .=		"</div>";           
$return_string .=		"<div class='{$prefix}details_container'>";
$return_string .=			"<div class='{$prefix}details_align'>";
$return_string .=				"<div class='{$prefix}details_meta'>	";
									$bep_selectedtype = get_post_meta( get_the_id(), 'bep_type', true );
									if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
$return_string .=						"<span class='bep_biggrid_category'>" . $bep_selectedtype . "</span>";
									}
$return_string .=					"<h3 class='{$prefix}post_title'>";
$return_string .=						"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>" . get_the_title() . "</a>";
$return_string .=					"</h3>";               
$return_string .=				"</div>";
$return_string .=				"<div class='{$prefix}details_info'>";
$return_string .=					"<span class='{$prefix}author_info'>";
$return_string .=						"<a href=". get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) . ">" . get_the_author_meta( 'display_name', get_the_id() ) . "</a>";
$return_string .=						"<span style='margin: 0 3px;'>-</span>	";
$return_string .=					"</span>";               
$return_string .=					"<span class='{$prefix}post_date'>";
$return_string .=						"<time class='entry-date updated td-module-date' datetime='" . get_the_date('c' , get_the_id()) . "'>" . get_the_date('F j,Y' , get_the_id()) . "</time>";
$return_string .=					"</span>";  
$return_string .=				"</div>";
$return_string .=			"</div>";
$return_string .=		"</div>";
$return_string .=	"</div>";

?>