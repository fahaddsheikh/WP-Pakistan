<?php 
// Add bep_shortcode_1 Shortcode

function bep_shortcode_1($bep_shortcode_1_attr) {
	// Shortcode Attributes
	$bep_shortcode_1_attr = shortcode_atts ( array(
	'bep_shortcode_1_title'=>'',
	'bep_shortcode_1_custom_post_type' =>  '',
	'bep_shortcode_1_taxonomy_terms_name' => '',
	'bep_shortcode_1_taxonomy_terms' => '',
	'bep_shortcode_1_taxonomy_tags_name' => '',
	'bep_shortcode_1_taxonomy_tags' => ''
	),$bep_shortcode_1_attr, 'bep_shortcode_1');
	
	
	$bep_shortcode_1_args_1 = array(
	'post_type' => $bep_shortcode_1_attr['bep_shortcode_1_custom_post_type'],
	'posts_per_page' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms_name'],
				'field'    => 'term_id',
				'terms'    => array( $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms'] ),
			),
		),
	);
	$bep_shortcode_1_query_1 = new WP_Query( $bep_shortcode_1_args_1 );

	$bep_shortcode_1_args_2 = array(
	'post_type' => $bep_shortcode_1_attr['bep_shortcode_1_custom_post_type'],
	'posts_per_page' => 4,
	'offset' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms_name'],
				'field'    => 'term_id',
				'terms'    => array( $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms'] ),
			),
		),
	);
	$bep_shortcode_1_query_2 = new WP_Query( $bep_shortcode_1_args_2 );

	$count = $bep_shortcode_1_query->post_count;
	$return_string =' <div class="bep_block_wrap bep_block_1 bep_uid_13_584f75f11d0a6_rand bep_with_ajax_pagination bep-pb-border-top red-block" data-bep-block-uid="bep_uid_13_584f75f11d0a6">';
	$return_string.='	<div class="bep-block-title-wrap"><h4 class="block-title"><span style="margin-right: 0px;">'.$bep_shortcode_1_attr['bep_shortcode_1_title'].'</span></h4>';
	/*$return_string.='		<div class="bep-subcat-filter" id="bep_pulldown_bep_uid_13_584f75f11d0a6">';
	$return_string.='			<ul class="bep-subcat-list" id="bep_pulldown_bep_uid_13_584f75f11d0a6_list">';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="bep_uid_14_584f75f1201a8" data-bep_filter_value="" data-bep_block_id="bep_uid_13_584f75f11d0a6" href="#">';
	$return_string.='						All';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="bep_uid_15_584f75f1201fe" data-bep_filter_value="1278" data-bep_block_id="bep_uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeEat';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="bep_uid_16_584f75f12024a" data-bep_filter_value="1302" data-bep_block_id="bep_uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeEntertain';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="bep_uid_17_584f75f12028c" data-bep_filter_value="1281" data-bep_block_id="bep_uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeFashion';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="bep_uid_18_584f75f1202d4" data-bep_filter_value="1274" data-bep_block_id="bep_uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeTech';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="bep_uid_19_584f75f120319" data-bep_filter_value="1282" data-bep_block_id="bep_uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeTravel';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='			</ul>';
	$return_string.='		<div class="bep-subcat-dropdown" style="display: none;">';
	$return_string.='			<div class="bep-subcat-more" aria-haspopup="true">';
	$return_string.='				<span>';
	$return_string.='					More';
	$return_string.='				</span>';
	$return_string.='				<i class="bep-icon-read-down">';
	$return_string.='				</i>';
	$return_string.='			</div>';
	$return_string.='			<ul class="bep-pulldown-filter-list">';
	$return_string.='			</ul>';
	$return_string.='		</div>';
	$return_string.='	</div>';*/
	$return_string.='</div>';
	$return_string.='	<div id="bep_uid_13_584f75f11d0a6" class="bep_block_inner">';
	$return_string.='		<div class="bep-block-row">';
	$return_string.='			<div class="bep-block-span6">';
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_1_query_1->have_posts() ) :
										while ( $bep_shortcode_1_query_1->have_posts() ) : $bep_shortcode_1_query_1->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortodes_1/bep_shortcode_template.php');
											wp_reset_postdata();
										endwhile;
									endif;	
	$return_string.='		  	</div>';
	$return_string.='			<div class="bep-block-span6">';
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_1_query_2->have_posts() ) :
										while ( $bep_shortcode_1_query_2->have_posts() ) : $bep_shortcode_1_query_2->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortodes_1/bep_shortcode_template2.php');
											wp_reset_postdata();
										endwhile;
									endif;
	$return_string.='		  	</div>';
			
	$return_string.='		</div>';
	$return_string.='	</div>	';
				
	$return_string.='	<div class="bep-next-prev-wrap">';
	$return_string.='		<a href="#" class="bep-ajax-prev-page ajax-page-disabled" id="prev-page-bep_uid_13_584f75f11d0a6" data-bep_block_id="bep_uid_13_584f75f11d0a6"><i class="bep-icon-font bep-icon-menu-left"></i></a><a href="#" class="bep-ajax-next-page" id="next-page-bep_uid_13_584f75f11d0a6" data-bep_block_id="bep_uid_13_584f75f11d0a6"><i class="bep-icon-font bep-icon-menu-right"></i>';
	$return_string.='		</a>';
	$return_string.='	</div>';

	$return_string.='</div>';

	wp_reset_query();
   	return $return_string;
	
	}

add_shortcode( 'bep_shortcode_1', 'bep_shortcode_1' );



?>