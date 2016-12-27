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
				include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_big_template_4.php' );
			}
			if ($bep_biggrid_single_big_query->current_post == 1) {
				include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_horizontal_template_4.php' );
			}
			if ($bep_biggrid_single_big_query->current_post == 2) {
				include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_small_one_template_4.php' );
			}
			if ($bep_biggrid_single_big_query->current_post == 3) {
				include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_small_two_template_4.php' );
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