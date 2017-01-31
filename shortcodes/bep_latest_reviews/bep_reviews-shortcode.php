<?php 
// Add {$prefix}shortcode_1 Shortcode

function bep_shortcode_reviews($bep_shortcode_reviews_attr) {
	// Shortcode Attributes
	$bep_shortcode_reviews_attr = shortcode_atts ( array(
		'bep_title'=>'Latest Reviews',
		'bep_total_post' =>  '10',
		'bep_review_category' => '0'
	),$bep_shortcode_reviews_attr, 'bep_shortcode_reviews');
	

	$bep_shortcode_reviews_args = array(
		'post_type' => 'ait-review',
		'posts_per_page' => $bep_shortcode_reviews_attr['bep_total_post'],
	);

	$bep_provided_category = intval($bep_shortcode_reviews_attr['bep_review_category']);
	$bep_shortcode_reviews_query = new WP_Query( $bep_shortcode_reviews_args );
	$prefix = "bep_";
	$return_string ="<div class='{$prefix}block_wrap {$prefix}block_1 {$prefix}pb-border-top red-block {$prefix}shortcode_reviews'>";
	$return_string.=	"<div class='bep-block-title-wrap'><h4 class='block-title'><span style='margin-right: 0px;'>".$bep_shortcode_reviews_attr['bep_title']."</span></h4></div>";
	$return_string.="<div class='{$prefix}block_inner'>";
	$return_string.=	"<div class='{$prefix}block-row'>";
	$return_string.=		"<div class='{$prefix}review-template'>";
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_reviews_query ->have_posts() ) :
										while ( $bep_shortcode_reviews_query ->have_posts() ) : $bep_shortcode_reviews_query ->the_post();
											$bep_review_parent = get_post_meta(get_the_id(), 'post_id', true);
											$bep_review_parent_categories = get_the_terms( $bep_review_parent, 'ait-locations' );
											if (!empty($bep_review_parent_categories)) {        
										        foreach($bep_review_parent_categories as $bep_review_parent_category) {
										            $bep_review_categories[] =  $bep_review_parent_category->term_id;
										    	}
											}
										    if ((!empty($bep_provided_category) && (in_array ($bep_provided_category, $bep_review_categories))) || ((empty($bep_provided_category) && ($bep_provided_category == 0)))){
										    	$bep_selectedtype = get_post_type();
												$return_string.="<div class='bep_module_6 bep_module_wrap {$prefix}review reviews-container ratings-shown reviews-ajax-shown'>";
												$return_string.=	bep_custom_thumb('100','70');
												$return_string.=	"<div class='item-details'>";
												$return_string.=		"<div class='{$prefix}review-title'>";
												$return_string.= 			bep_custom_title();
												$return_string.=        "</div>";

												$return_string.=	"<div class='{$prefix}review-rating review-container'>";
																		$rating_overall = get_post_meta(get_the_ID(), 'rating_mean', true);
																		$rating_data = (array)json_decode(get_post_meta(get_the_ID(), 'ratings', true));
																		$ratings = '';
																		if(is_array($rating_data) && count($rating_data) > 0){
												$return_string.=		"<div class='review-stars'>";
												$return_string.=			"<span class='review-rating-overall' data-score='".$rating_overall."'></span>";
												$return_string.=			"<div class='review-ratings'>";
																			foreach ($rating_data as $index => $rating) {
																			 	if ($rating->question != "") {
												$return_string.=					"<div class='review-rating'>";
												$return_string.=						"<span class='review-rating-question'>" .$rating->question. "</span>";
												$return_string.= 						"<span class='review-rating-stars' data-score='".$rating->value."'></span>";
												$return_string.= 					"</div>";
																}
															}
												$return_string.=			"</div>";
												$return_string.=		"</div>";
														}
												$return_string.=	"</div>";
												$return_string.=	"<div class='bep_module-meta-info'>";
												$return_string.=		bep_custom_author_name();   
												$return_string.=		bep_custom_time();
												$return_string.=		bep_custom_excerpt(0,70);
												$return_string.=	"</div>";
												$return_string.="</div>";
											}
											
											unset($bep_review_categories);
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
	$return_string.=	"</div>";

	$return_string.="</div>";*/

	wp_reset_query();
   	return $return_string;
	
	}

add_shortcode( 'bep_shortcode_reviews', 'bep_shortcode_reviews' );
?>