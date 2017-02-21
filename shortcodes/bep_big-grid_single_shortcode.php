<?php
// Add BIGGRID Shortcode
function bep_biggrid_single( $bep_biggrid_single_shortcode_atts) {

	// Shortcode Attributes
	$bep_biggrid_single_shortcode_atts = shortcode_atts(
		array(
			'bep_post_type' => 'post',
			'bep_taxonomy_type' => 'category'
		),
		$bep_biggrid_single_shortcode_atts, 'bep_biggrid_single'
	);

	// The query arguments for biggrid Single Image Template
	$bep_biggrid_single_big_query_args = array(
		'post_type' => $bep_biggrid_single_shortcode_atts['bep_post_type'],
		'posts_per_page'      => 4,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_single_shortcode_atts['bep_taxonomy_type'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_single_big_query = new WP_Query( $bep_biggrid_single_big_query_args );
	$prefix = "bep_" ;
	$return_string =	"<div class='{$prefix}block_wrap {$prefix}block_big_grid_3 {$prefix}uid_12_5857ad1ec83a8_rand {$prefix}grid-style-1 {$prefix}hover-1 {$prefix}pb-border-top {$prefix}shortcode_biggrid'>";
	$return_string .=		"<div id='{$prefix}uid_12_5857ad1ec83a8' class='{$prefix}block_inner'>";
	$return_string .=			"<div class='{$prefix}big-grid-wrapper'>";

	// The Loop for biggrid Single Image Template
	if ( $bep_biggrid_single_big_query->have_posts() ) :
		while ( $bep_biggrid_single_big_query->have_posts() ) : $bep_biggrid_single_big_query->the_post();
			if ($bep_biggrid_single_big_query->current_post == 0) {
				$return_string .=	"<div class='{$prefix}module_mx5 {$prefix}animation-stack {$prefix}big-grid-post-0 {$prefix}big-grid-post {$prefix}big-thumb'>";
				$return_string .=		bep_custom_thumb(649,500);          
				$return_string .=		"<div class='{$prefix}meta-info-container'>";
				$return_string .=			"<div class='{$prefix}meta-align''>";
				$return_string .=				"<div class='{$prefix}big-grid-meta'>	";
				$return_string .=					bep_custom_category();
				$return_string .=					bep_custom_title();               
				$return_string .=				"</div>";
				$return_string .=				"<div class='{$prefix}module-meta-info'>";
/*				$return_string .=					bep_custom_author_name(); */           
				$return_string .=					bep_custom_time();  
				$return_string .=				"</div>";
				$return_string .=			"</div>";
				$return_string .=		"</div>";
				$return_string .=	"</div>";
			}

			if ($bep_biggrid_single_big_query->current_post == 1) {
				$return_string .=	"<div class='{$prefix}module_mx11 {$prefix}animation-stack {$prefix}big-grid-post-1 {$prefix}big-grid-post {$prefix}medium-thumb'>	";
				$return_string .=		bep_custom_thumb(649,500);        
				$return_string .=		"<div class='{$prefix}meta-info-container'>	";
				$return_string .=			"<div class='{$prefix}meta-align'>	";
				$return_string .=				"<div class='{$prefix}big-grid-meta'>	";
				$return_string .=					bep_custom_category();
				$return_string .=					bep_custom_title();           
				$return_string .=				"</div>";
				$return_string .=			"</div>";
				$return_string .=		"</div>";
				$return_string .=	"</div>"; 
			}
			
			if ($bep_biggrid_single_big_query->current_post == 2) {
				$return_string .=	"<div class='{$prefix}module_mx6 {$prefix}animation-stack {$prefix}big-grid-post-2 {$prefix}big-grid-post {$prefix}small-thumb'>	";
				$return_string .=		bep_custom_thumb(324,235);
				$return_string .=		"<div class='{$prefix}meta-info-container'>	";
				$return_string .=			"<div class='{$prefix}meta-align'>	";
				$return_string .=				"<div class='{$prefix}big-grid-meta'>	";
				$return_string .=					bep_custom_category();
				$return_string .=					bep_custom_title(); 
				$return_string .=				"</div>";
				$return_string .=			"</div>";
				$return_string .=		"</div>";
				$return_string .=	"</div>";	        
			}

			if ($bep_biggrid_single_big_query->current_post == 3) {
				$return_string .=	"<div class='{$prefix}module_mx6 {$prefix}animation-stack {$prefix}big-grid-post-3 {$prefix}big-grid-post {$prefix}small-thumb'>	";
				$return_string .=		bep_custom_thumb(324,235);
				$return_string .=		"<div class='{$prefix}meta-info-container'>	";
				$return_string .=			"<div class='{$prefix}meta-align'>	";
				$return_string .=				"<div class='{$prefix}big-grid-meta'>	";
				$return_string .=					bep_custom_category();
				$return_string .=					bep_custom_title(); 
				$return_string .=				"</div>";
				$return_string .=			"</div>";
				$return_string .=		"</div>";
				$return_string .=	"</div>";	
			}
			
			wp_reset_postdata();
		endwhile;
	endif;
	$return_string .=				"</div>";
	$return_string .=			"</div>";
	$return_string .=	"<div class='clearfix'></div>	";
	$return_string .=	"</div>		";

   	wp_reset_query();
   	return $return_string;

 }
add_shortcode( 'bep_biggrid_single', 'bep_biggrid_single' );
?>