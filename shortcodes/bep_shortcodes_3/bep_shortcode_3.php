<?php 
// Add bep_shortcode_3 Shortcode

function bep_shortcode_3($bep_shortcode_3_attr) {
	// Shortcode Attributes
	$bep_shortcode_3_attr = shortcode_atts ( array(
	'bep_shortcode_3_title'=>'Title',
	'bep_shortcode_3_custom_post_type' =>  'post',
	'bep_shortcode_3_number_of_posts' => '10',
	'bep_shortcode_3_taxonomy_terms_name' => 'category',
	'bep_shortcode_3_taxonomy_terms' => '',
	),$bep_shortcode_3_attr, 'bep_shortcode_3');
	
	// If taxonomy terms are provided in the shortcode load them. Or load all posts from the provided or default taxonomy.
	if (!empty($bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms'])) {
		$bep_shortcode_3_terms_array = array_map('intval', explode(',', $bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms']));
	}
	else {
		$bep_shortcode_3_terms_array = get_terms( $bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms_name'], 'hide_empty=0&fields=ids' );
	}

	$bep_shortcode_3_args = array(
	'post_type' => $bep_shortcode_3_attr['bep_shortcode_3_custom_post_type'],
	'posts_per_page' => intval($bep_shortcode_3_attr['bep_shortcode_3_number_of_posts']),
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms_name'],
				'field'    => 'term_id',
				'terms'    => $bep_shortcode_3_terms_array,
			),
		),
	);
	$bep_shortcode_3_query = new WP_Query( $bep_shortcode_3_args );

	$prefix='bep_';
	$return_string  = "<div class='{$prefix}block_wrap {$prefix}block_11 {$prefix}uid_28_585227ea93763_rand {$prefix}with_ajax_pagination {$prefix}pb-border-top black-block' >";
    $return_string .= "		<div class='{$prefix}block-title-wrap'>";
    $return_string .= "    	<h4 class='block-title'>";
    $return_string .= "	        <span style='margin-right: 0px;'>";
    $return_string .=           $bep_shortcode_3_attr['bep_shortcode_3_title'];
    $return_string .= "      		 </span>";
    $return_string .= "   </h4>";
	$return_string .= "</div>";
	$return_string .= "	 <div class='{$prefix}block_inner'>";
	$return_string .= "		<div class='{$prefix}block-span12'>";	
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_3_query->have_posts() ) :
										while ( $bep_shortcode_3_query->have_posts() ) : $bep_shortcode_3_query->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortcodes_3/bep_shortcode_3-template.php');
											wp_reset_postdata();
										endwhile;
									endif;	
	
	$return_string .= "		</div>";
	$return_string .= "	</div>	";
	$return_string .= "</div>";

	wp_reset_query();
   	return $return_string;
	
}

add_shortcode( 'bep_shortcode_3', 'bep_shortcode_3' );



?>