<?php
// Add BIGGRID Shortcode
function bep_biggrid( $bep_biggrid_square_shortcode_atts ) {

	// Shortcode Attributes
	$bep_biggrid_square_shortcode_atts = shortcode_atts(
		array(
			'bep_post_type' => '',
			'bep_post_type_two' => '',
			'bep_post_type_three' => '',
			'bep_post_type_four' => '',
			'bep_taxonomy_type' => '',
			'bep_taxonomy_type_two' => '',
			'bep_taxonomy_type_three' => '',
			'bep_taxonomy_type_four' => ''
		),
		$bep_biggrid_square_shortcode_atts, 'bep_biggrid'
	);

	// The query arguments for biggrid Square Image Template
	$bep_biggrid_square_big_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['bep_post_type'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['bep_taxonomy_type'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),

	);
	$bep_biggrid_square_big_query = new WP_Query( $bep_biggrid_square_big_query_args );
	// END

	// The query arguments for biggrid Horizontal Image Template
	$bep_biggrid_horizontal_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['bep_post_type_two'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['bep_taxonomy_type_two'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_horizontal_query = new WP_Query( $bep_biggrid_horizontal_query_args );
	// END

	// The query arguments for biggrid Small One Image Template
	$bep_biggrid_small_one_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['bep_post_type_three'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['bep_taxonomy_type_three'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_small_one_query = new WP_Query( $bep_biggrid_small_one_query_args );
	// END

	// The query arguments for biggrid Small Two Image Template
	$bep_biggrid_small_two_query_args = array(
		'post_type' => $bep_biggrid_square_shortcode_atts['bep_post_type_four'],
		'posts_per_page'      => 1,
		'post_status' => 'publish',
		'tax_query' => array(
			array(
				'taxonomy' => $bep_biggrid_square_shortcode_atts['bep_taxonomy_type_four'],
				'field'    => 'slug',
				'terms'    => 'featured',
			),
		),
	);
	$bep_biggrid_small_two_query = new WP_Query( $bep_biggrid_small_two_query_args );
	// END

	$prefix = "bep_" ;
	$return_string =	"<div class='{$prefix}block_wrap {$prefix}block_big_grid_3 {$prefix}uid_12_5857ad1ec83a8_rand {$prefix}grid-style-1 {$prefix}hover-1 {$prefix}pb-border-top {$prefix}shortcode_biggrid'>";
	$return_string .=		"<div id='{$prefix}uid_12_5857ad1ec83a8' class='{$prefix}block_inner'>";
	$return_string .=			"<div class='{$prefix}big-grid-wrapper'>";

	// The Loop for biggrid Square Image Template
	if ( $bep_biggrid_square_big_query->have_posts() ) :
		while ( $bep_biggrid_square_big_query->have_posts() ) : $bep_biggrid_square_big_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_big_template_4.php' );
			wp_reset_postdata();
		endwhile;
	endif;

	// The Loop for biggrid Horizontal Image Template
	if ( $bep_biggrid_horizontal_query->have_posts() ) :
		while ( $bep_biggrid_horizontal_query->have_posts() ) : $bep_biggrid_horizontal_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_horizontal_template_4.php' );
			wp_reset_postdata();
		endwhile;
	endif;

	// The Loop for biggrid Small One Image Template
	if ( $bep_biggrid_small_one_query->have_posts() ) :
		while ( $bep_biggrid_small_one_query->have_posts() ) : $bep_biggrid_small_one_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_small_one_template_4.php' );
			wp_reset_postdata();
		endwhile;
	endif;

	// The Loop for biggrid Small Two Image Template
	if ( $bep_biggrid_small_two_query->have_posts() ) :
		while ( $bep_biggrid_small_two_query->have_posts() ) : $bep_biggrid_small_two_query->the_post(); 
			include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big_grid_square_small_two_template_4.php' );
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