<?php 
	$return_string .=	"<div class='{$prefix}module_mx11 {$prefix}animation-stack {$prefix}big-grid-post-1 {$prefix}big-grid-post {$prefix}medium-thumb'>	";
	$return_string .=		"<div class='{$prefix}module-thumb'>	";
	$return_string .=			"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>	";
	$return_string .=				 get_the_post_thumbnail( get_the_id() ,  'bep_649x500' );
	$return_string .=			"</a>";
	$return_string .=		"</div>";        
	$return_string .=		"<div class='{$prefix}meta-info-container'>	";
	$return_string .=			"<div class='{$prefix}meta-align'>	";
	$return_string .=				"<div class='{$prefix}big-grid-meta'>	";
										$bep_selectedtype = get_post_meta( $bep_biggrid_square_big_query->post->ID, 'bep_type', true );
										if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
	$return_string .=						"<span class='{$prefix}post-category'>" . $bep_selectedtype . "</span>";
										}                     
	$return_string .=					"<h3 class='entry-title {$prefix}module-title'>";
	$return_string .=						"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>" . get_the_title() . "</a>	";
	$return_string .=					"</h3>";            
	$return_string .=				"</div>";
	$return_string .=			"</div>";
	$return_string .=		"</div>";
	$return_string .=	"</div>"; 
?>