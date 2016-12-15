<?php 
	$return_string .=	"<div class='{$prefix}biggrid {$prefix}biggrid_horizontal_thumb'>	";
	$return_string .=		"<div class='{$prefix}biggrid_thumb'>	";
	$return_string .=			"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>	";
	$return_string .=				 get_the_post_thumbnail( get_the_id() ,  'biggrid-horizontal' );
	$return_string .=			"</a>";
	$return_string .=		"</div>";        
	$return_string .=		"<div class='{$prefix}details_container'>	";
	$return_string .=			"<div class='{$prefix}details_align'>	";
	$return_string .=				"<div class='{$prefix}details_meta'>	";
										$bep_selectedtype = get_post_meta( $bep_biggrid_square_big_query->post->ID, 'bep_type', true );
										if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
	$return_string .=						"<span class='bep_biggrid_category'>" . $bep_selectedtype . "</span>";
										}                     
	$return_string .=					"<h3 class='{$prefix}post_title'>";
	$return_string .=						"<a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>" . get_the_title() . "</a>	";
	$return_string .=					"</h3>";            
	$return_string .=				"</div>";
	$return_string .=			"</div>";
	$return_string .=		"</div>";
	$return_string .=	"</div>"; 
?>