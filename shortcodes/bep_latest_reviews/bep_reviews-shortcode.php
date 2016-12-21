<?php 
// Add {$prefix}shortcode_1 Shortcode

function bep_shortcode_reviews($bep_shortcode_reviews_attr) {
	// Shortcode Attributes
	$bep_shortcode_reviews_attr = shortcode_atts ( array(
	'bep_title'=>'Latest Reviews',
	'bep_total_post' =>  '10'
	),$bep_shortcode_reviews_attr, 'bep_shortcode_reviews');
	

	$bep_shortcode_reviews_args = array(
	'post_type' => 'ait-review',
	'posts_per_page' => $bep_shortcode_reviews_attr['bep_total_post']
	);
	$bep_shortcode_reviews_query = new WP_Query( $bep_shortcode_reviews_args );


	$prefix = "bep_";



	$return_string ="<div class='{$prefix}block_wrap {$prefix}block_1 {$prefix}pb-border-top red-block {$prefix}shortcode_reviews'>";
	$return_string.=	"<div class='bep-block-title-wrap'><h4 class='block-title'><span style='margin-right: 0px;'>".$bep_shortcode_reviews_attr['bep_title']."</span></h4>";
	$return_string.="</div>";
	$return_string.="<div class='{$prefix}block_inner'>";
	$return_string.=	"<div class='{$prefix}block-row'>";
	$return_string.=		"<div class='{$prefix}review-template'>";
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_reviews_query ->have_posts() ) :
										while ( $bep_shortcode_reviews_query ->have_posts() ) : $bep_shortcode_reviews_query ->the_post();
	$return_string.=						"<div class='bep_module_6 bep_module_wrap {$prefix}review reviews-container ratings-shown reviews-ajax-shown'>";
	$return_string.=							"<div class='{$prefix}module-thumb'>";
	$return_string.=								"<a href='" . get_permalink(get_post_meta(get_the_id(), 'post_id', true)) . "' rel='bookmark' title='".get_the_title(get_post_meta(get_the_id(), 'post_id', true))."'>";
	$return_string.=				 				get_the_post_thumbnail( get_post_meta(get_the_id(), 'post_id', true) ,  'bep_shortcodes_1-small' );
	$return_string.=								"</a>";
	$return_string.=							"</div>";
	$return_string.=							"<div class='item-details'>";
	$return_string.=								"<div class='{$prefix}review-title'>";
	$return_string.= 									"<h3 class='entry-title {$prefix}module-title'>";
	$return_string.=										"<a href='" .get_permalink( get_post_meta(get_the_id(), 'post_id', true) ). "'>" .get_the_title( get_post_meta(get_the_id(), 'post_id', true) ). "</a>";
	$return_string.=									"</h3>";
		$return_string.=                        	"</div>";
	$return_string.=								"<div class='{$prefix}review-rating review-container'>";
														$rating_overall = get_post_meta(get_the_ID(), 'rating_mean', true);
														$rating_data = (array)json_decode(get_post_meta(get_the_ID(), 'ratings', true));
														$ratings = '';
														if(is_array($rating_data) && count($rating_data) > 0){
	$return_string.=										"<div class='review-stars'>";
	$return_string.=											"<span class='review-rating-overall' data-score='".$rating_overall."'></span>";
	$return_string.=											"<div class='review-ratings'>";
																foreach ($rating_data as $index => $rating) {
																	if ($rating->question != "") {
	$return_string.=													"<div class='review-rating'>";
	$return_string.=														"<span class='review-rating-question'>" .$rating->question. "</span>";
	$return_string.= 														"<span class='review-rating-stars' data-score='".$rating->value."'></span>";
	$return_string.= 													"</div>";
																	}
																}
	$return_string.=											"</div>";
	$return_string.=										"</div>";
														}
	$return_string.=								"</div>";
	$return_string.=								"<div class='bep_module-meta-info'>";
	$return_string.=									"<span class='{$prefix}post-author-name'>";
	$return_string .=										get_the_title();
	$return_string.=										"<span>-</span>";
	$return_string.=									"</span>";   
	$return_string.=									"<span class='{$prefix}post-date'>";
	$return_string.=										"<time class='entry-date updated {$prefix}module-date' datetime='". get_the_date('c' , get_the_ID() ) ."'>";
	$return_string.=										get_the_date('F j,Y' , get_the_ID() );
	$return_string.=										"</time>";
	$return_string.=									"</span>";
	$return_string.=								"</div>";
	$return_string.=								"<div class='{$prefix}review-description'>";
	$return_string.=									substr( strip_tags(get_the_content( get_the_ID() )), 0, 70) . '...';
	$return_string.=								"</div>";
	$return_string.=							"</div>";
	$return_string.=						"</div>";
											wp_reset_postdata();
										endwhile;
									endif;
	$return_string.=			"</div>";								
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

add_shortcode( 'bep_shortcode_reviews', 'bep_shortcode_reviews' );
?>