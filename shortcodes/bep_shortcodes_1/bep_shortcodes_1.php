<?php 
// Add {$prefix}shortcode_1 Shortcode

function bep_shortcode_1($bep_shortcode_1_attr) {
	// Shortcode Attributes
	$bep_shortcode_1_attr = shortcode_atts ( array(
	'bep_title'=>'Title',
	'bep_post_type' =>  'post',
	'bep_taxonomy_name' => 'category',
	'bep_taxonomy_terms' => ''
	),$bep_shortcode_1_attr, 'bep_shortcode_1');
	
	// If taxonomy terms are provided in the shortcode load them. Or load all posts from the provided or default taxonomy.
	if (!empty($bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms'])) {
		$bep_shortcode_1_terms_array = array_map('intval', explode(',', $bep_shortcode_1_attr['bep_taxonomy_terms']));;
	}
	else {
		$bep_shortcode_1_terms_array = get_terms( $bep_shortcode_1_attr['bep_taxonomy_name'], 'hide_empty=0&fields=ids' );
	}

	$bep_shortcode_1_args_1 = array(
	'post_type' => $bep_shortcode_1_attr['bep_post_type'],
	'posts_per_page' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_1_attr['bep_taxonomy_name'],
				'field'    => 'term_id',
				'terms'    => $bep_shortcode_1_terms_array,
			),
		),
	);
	$bep_shortcode_1_query_1 = new WP_Query( $bep_shortcode_1_args_1 );

	$bep_shortcode_1_args_2 = array(
	'post_type' => $bep_shortcode_1_attr['bep_post_type'],
	'posts_per_page' => 8,
	'offset' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_1_attr['bep_taxonomy_name'],
				'field'    => 'term_id',
				'terms'    => $bep_shortcode_1_terms_array,
			),
		),
	);
	$bep_shortcode_1_query_2 = new WP_Query( $bep_shortcode_1_args_2 );
	$prefix = "bep_";
	$return_string ="<div class='{$prefix}block_wrap {$prefix}block_1 {$prefix}pb-border-top red-block {$prefix}shortcode_1'>";
	$return_string.=	"<div class='bep-block-title-wrap'><h4 class='block-title'><span style='margin-right: 0px;'>".$bep_shortcode_1_attr['bep_title']."</span></h4>";
	$return_string.="</div>";
	$return_string.="<div class='{$prefix}block_inner'>";
	$return_string.=	"<div class='{$prefix}block-row'>";
	$return_string.=		"<div class='{$prefix}shortcode-1-template-big'>";
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_1_query_1->have_posts() ) :
										while ( $bep_shortcode_1_query_1->have_posts() ) : $bep_shortcode_1_query_1->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortcodes_1/bep_shortcode_1_big_template.php');
											wp_reset_postdata();
										endwhile;
									endif;	
	$return_string.=		"</div>";
	$return_string.=		"<div class='{$prefix}shortcode-1-template-wide'>";
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_1_query_2->have_posts() ) :
										while ( $bep_shortcode_1_query_2->have_posts() ) : $bep_shortcode_1_query_2->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortcodes_1/bep_shortcode_1_small_template.php');
											wp_reset_postdata();
										endwhile;
									endif;
	$return_string.=		"</div>";
	$return_string.=		"<div class='clearfix'></div>";		
	$return_string.=	"</div>";
	$return_string.="</div>";
				
/*	$return_string.="<div class='{$prefix}next-prev-wrap'>";
	$return_string.= "<a href='#' class='{$prefix}ajax-prev-page ajax-page-disabled'><i class='{$prefix}icon-font {$prefix}icon-menu-left'></i></a><a href='#'' class='bep-ajax-next-page'><i class='{$prefix}icon-font {$prefix}icon-menu-right'></i>";
	$return_string.=	"</a>";
	$return_string.=	"</div>";*/

	$return_string.="</div>";

	wp_reset_query();
   	return $return_string;
	
	}

add_shortcode( 'bep_shortcode_1', 'bep_shortcode_1' );
?>