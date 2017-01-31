<?php 
// Add {$prefix}shortcode_1 Shortcode

function bep_shortcode_events($bep_shortcode_events_attr) {
	// Shortcode Attributes
	$bep_shortcode_events_attr = shortcode_atts ( array(
	'bep_title'=>'Upcomming Events',
	'bep_total_post' =>  '10',
	'bep_taxonomy_name' => '',
	'bep_taxonomy_terms' => ''
	),$bep_shortcode_events_attr, 'bep_shortcode_events');

	// If taxonomy terms are provided in the shortcode load them. Or load all posts from the provided or default taxonomy.
	if (!empty($bep_shortcode_events_attr['bep_taxonomy_terms'])) {
		$bep_shortcode_events_terms_array = array_map('intval', explode(',', $bep_shortcode_events_attr['bep_taxonomy_terms']));
	}
	else {
		$bep_shortcode_events_terms_array = get_terms( $bep_shortcode_events_attr['bep_taxonomy_name'], 'hide_empty=0&fields=ids' );
	}
	
	$bep_shortcode_events_args = array(
	    'post_type' => 'ait-event-pro', // Tell WordPress which post type we want
        'orderby' => 'meta_value', // We want to organize the events by date    
        'meta_key' => 'be_event_datefrom', // Grab the "start date" field created via "More Fields" plugin (stored in YYYY-MM-DD format)
        'order' => 'ASC', // ASC is the other option    
	    'posts_per_page' => $bep_shortcode_events_attr['bep_total_post'], // Let's show them all.
	    'meta_query'	=>	array( // WordPress has all the results, now, return only the events after today's date
        	array(
            	'key' => 'be_event_datefrom', // Check the start date field
            	'value' => time(), // Set today's date (note the similar format)
            	'compare' => '>=', // Return the ones greater than today's date
            	'type' => 'NUMERIC,' // Let WordPress know we're working with numbers
        	)
    	)

    );

	if (!empty($bep_shortcode_events_attr['bep_taxonomy_name'])) {
		$bep_shortcode_events_args['tax_query'] = array (
			array (		
					'taxonomy' => $bep_shortcode_events_attr['bep_taxonomy_name'],
					'field'    => 'term_id',
					'terms'    => $bep_shortcode_events_terms_array,
			)
		);
	}

	$bep_shortcode_events_query = new WP_Query( $bep_shortcode_events_args );

	$prefix = "bep_";
	$return_string ="<div class='{$prefix}block_wrap {$prefix}block_1 {$prefix}pb-border-top red-block {$prefix}shortcode_events'>";
	$return_string.=	"<div class='bep-block-title-wrap'><h4 class='block-title'><span style='margin-right: 0px;'>".$bep_shortcode_events_attr['bep_title']."</span></h4>";
	$return_string.="</div>";
	$return_string.="<div class='{$prefix}block_inner'>";
	$return_string.=	"<div class='{$prefix}block-row'>";
	$return_string.=		"<div class='{$prefix}event-template'>";
									// The Loop for biggrid Square Image Template
								if ( $bep_shortcode_events_query ->have_posts() ) :
									while ( $bep_shortcode_events_query ->have_posts() ) : $bep_shortcode_events_query ->the_post();

											

	$return_string.=					"<div class='bep_module_6 bep_module_wrap {$prefix}event events-container ratings-shown events-ajax-shown'>";
	$return_string.=						bep_custom_thumb("","","normal");
	$return_string.=							"<div class='item-details'>";
	$return_string.=								"<div class='{$prefix}event-title'>";
	$return_string.= 									bep_custom_title();
	$return_string.=                    			"</div>";
	$return_string.=								bep_custom_excerpt(0,70);
	$return_string.=							"</div>";
	$return_string.=					"</div>";
									wp_reset_postdata();
									endwhile;
								endif;
	$return_string.=		"</div>";								
	$return_string.=	"</div>";
	$return_string.=	"<div class='clearfix'></div>";		
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

add_shortcode( 'bep_shortcode_events', 'bep_shortcode_events' );
?>