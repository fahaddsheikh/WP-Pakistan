<?php 
// Add bep_shortcode_3 Shortcode

function bep_shortcode_3($bep_shortcode_3_attr) {
	// Shortcode Attributes
	$bep_shortcode_3_attr = shortcode_atts ( array(
	'bep_shortcode_3_title'=>'',
	'bep_shortcode_3_custom_post_type' =>  '',
	'bep_shortcode_3_taxonomy_terms_name' => '',
	'bep_shortcode_3_taxonomy_terms' => '',
	'bep_shortcode_3_taxonomy_tags_name' => '',
	'bep_shortcode_3_taxonomy_tags' => ''
	),$bep_shortcode_3_attr, 'bep_shortcode_3');
	
	
	$bep_shortcode_3_args_1 = array(
	'post_type' => $bep_shortcode_3_attr['bep_shortcode_3_custom_post_type'],
	'posts_per_page' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms_name'],
				'field'    => 'term_id',
				'terms'    => array( $bep_shortcode_3_attr['bep_shortcode_3_taxonomy_terms'] ),
			),
		),
	);
	$bep_shortcode_3_query_1 = new WP_Query( $bep_shortcode_3_args_1 );

	$prefix='bep_';
	$count = $bep_shortcode_3_query->post_count;
	$return_string =" <div class='{$prefix}block_wrap {$prefix}block_11 {$prefix}uid_28_585227ea93763_rand {$prefix}with_ajax_pagination {$prefix}pb-border-top black-block' data-{$prefix}block-uid='{$prefix}uid_28_585227ea93763'>";
    $return_string.="		<div class='{$prefix}block-title-wrap'>";
    $return_string.="    	<h4 class='block-title'>";
    $return_string.="	        <span style='margin-right: 0px;'>";
    $return_string.=           $bep_shortcode_3_attr['bep_shortcode_3_title'];
    $return_string.="      		 </span>";
    $return_string.="   </h4>";

	/* <!--<div class='{$prefix}subcat-filter' id='{$prefix}pulldown_{$prefix}uid_28_585227ea93763'>
			<ul class='{$prefix}subcat-list' id='{$prefix}pulldown_{$prefix}uid_28_585227ea93763_list'>
				<li class='{$prefix}subcat-item' style='transition: opacity 0.2s; opacity: 1;'>
					<a class='{$prefix}subcat-link' id='{$prefix}uid_29_585227ea982f6' data-{$prefix}filter_value='' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763' href='#'>
						All
					</a>
				</li>
				<li class='{$prefix}subcat-item' style='transition: opacity 0.2s; opacity: 1;'>
					<a class='{$prefix}subcat-link' id='{$prefix}uid_30_585227ea9833e' data-{$prefix}filter_value='1278' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763' href='#'>
						BeEat
					</a>
				</li>
				<li class='{$prefix}subcat-item' style='transition: opacity 0.2s; opacity: 1;'>
					<a class='{$prefix}subcat-link' id='{$prefix}uid_31_585227ea98382' data-{$prefix}filter_value='1302' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763' href='#'>
						BeEntertain
					</a>
				</li>
				<li class='{$prefix}subcat-item' style='transition: opacity 0.2s; opacity: 1;'>
					<a class='{$prefix}subcat-link' id='{$prefix}uid_32_585227ea983c5' data-{$prefix}filter_value='1281' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763' href='#'>
						BeFashion
					</a>
				</li>
				<li class='{$prefix}subcat-item' style='transition: opacity 0.2s; opacity: 1;'>
					<a class='{$prefix}subcat-link' id='{$prefix}uid_33_585227ea98408' data-{$prefix}filter_value='1274' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763' href='#'>
						BeTech
					</a>
				</li>
				<li class='{$prefix}subcat-item' style='transition: opacity 0.2s; opacity: 1;'>
					<a class='{$prefix}subcat-link' id='{$prefix}uid_34_585227ea9844c' data-{$prefix}filter_value='1282' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763' href='#'>
						BeTravel
					</a>
				</li>
			</ul>
			<div class='{$prefix}subcat-dropdown' style='display: none;'>
				<div class='{$prefix}subcat-more' aria-haspopup='true'>
					<span>
						More
					</span>
					<i class='{$prefix}icon-read-down'></i>
				</div>
				<ul class='{$prefix}pulldown-filter-list'>
					
				</ul>
			</div>
		</div>--> */
	$return_string.="</div>";
	$return_string.="	 <div id='{$prefix}uid_28_585227ea93763' class='{$prefix}block_inner'>";
	$return_string.="		<div class='{$prefix}block-span12'>";
	
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_3_query_1->have_posts() ) :
										while ( $bep_shortcode_3_query_1->have_posts() ) : $bep_shortcode_3_query_1->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortcodes_3/bep_shortcode_3-template.php');
											wp_reset_postdata();
										endwhile;
									endif;	
	
	$return_string.="		</div>";
	$return_string.="	</div>	";
				
	$return_string.="	<div class='{$prefix}next-prev-wrap'>";
    $return_string.="  	<a href='#' class='{$prefix}ajax-prev-page ajax-page-disabled' id='prev-page-{$prefix}uid_28_585227ea93763' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763'>";
    $return_string.="        <i class='{$prefix}icon-font {$prefix}icon-menu-left'>";
                    
    $return_string.="        </i>";
    $return_string.="   </a>";
    $return_string.="    <a href='#' class='{$prefix}ajax-next-page' id='next-page-{$prefix}uid_28_585227ea93763' data-{$prefix}block_id='{$prefix}uid_28_585227ea93763'>";
    $return_string.="        <i class='{$prefix}icon-font {$prefix}icon-menu-right'>";
                    
    $return_string.="        </i>";
    $return_string.="    </a>";
    $return_string.="</div>";

	$return_string.="</div>";

	wp_reset_query();
   	return $return_string;
	
	}

add_shortcode( 'bep_shortcode_3', 'bep_shortcode_3' );



?>