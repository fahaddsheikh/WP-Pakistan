<?php
// Add BIGGRID Shortcode
function bep_biggrid( $bep_biggrid_square_shortcode_atts ) {

	// Shortcode Attributes
	$bep_biggrid_square_shortcode_atts = shortcode_atts(
		array(
			'custom_post_type_box_one' => '',
			'custom_post_type_box_two' => '',
			'custom_post_type_box_three' => '',
			'custom_post_type_box_four' => '',
			'custom_one_taxonomy' => '',
			'custom_two_taxonomy' => '',
			'custom_three_taxonomy' => '',
			'custom_four_taxonomy' => ''
		),
		$bep_biggrid_square_shortcode_atts, 'bep_biggrid'
	);

	// The query arguments for biggrid Square Image Template
	$bep_biggrid_square_big_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['custom_post_type_box_one'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['custom_one_taxonomy'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_square_big_query = new WP_Query( $bep_biggrid_square_big_query_args );
	// END

	// The query arguments for biggrid Horizontal Image Template
	$bep_biggrid_horizontal_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['custom_post_type_box_two'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['custom_two_taxonomy'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_horizontal_query = new WP_Query( $bep_biggrid_horizontal_query_args );
	// END

	// The query arguments for biggrid Small One Image Template
	$bep_biggrid_small_one_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['custom_post_type_box_three'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['custom_three_taxonomy'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_small_one_query = new WP_Query( $bep_biggrid_small_one_query_args );
	// END

	// The query arguments for biggrid Small Two Image Template
	$bep_biggrid_small_two_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['custom_post_type_box_four'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['custom_four_taxonomy'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_small_two_query = new WP_Query( $bep_biggrid_small_two_query_args );
	// END

	$prefix = "bep_" ;
	$return_string =	"<div class='{$prefix}biggrid-container'>";
	$return_string .=		"<div id='{$prefix}biggrid_inner'>";
	$return_string .=			"<div class='{$prefix}biggrid_wrapper'>";

	// The Loop for biggrid Square Image Template
	if ( $bep_biggrid_square_big_query->have_posts() ) :
		while ( $bep_biggrid_square_big_query->have_posts() ) : $bep_biggrid_square_big_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_big_template.php' );
			wp_reset_postdata();
		endwhile;
	endif;

	// The Loop for biggrid Horizontal Image Template
	if ( $bep_biggrid_horizontal_query->have_posts() ) :
		while ( $bep_biggrid_horizontal_query->have_posts() ) : $bep_biggrid_horizontal_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_horizontal_template.php' );
			wp_reset_postdata();
		endwhile;
	endif;

	// The Loop for biggrid Small One Image Template
	if ( $bep_biggrid_small_one_query->have_posts() ) :
		while ( $bep_biggrid_small_one_query->have_posts() ) : $bep_biggrid_small_one_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_small_one_template.php' );
			wp_reset_postdata();
		endwhile;
	endif;

	// The Loop for biggrid Small Two Image Template
	if ( $bep_biggrid_small_two_query->have_posts() ) :
		while ( $bep_biggrid_small_two_query->have_posts() ) : $bep_biggrid_small_two_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_small_two_template.php' );
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
add_shortcode( 'bep_biggrid', 'bep_biggrid' );
?>