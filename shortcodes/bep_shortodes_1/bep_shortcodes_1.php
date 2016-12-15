<?php 
// Add {$prefix}shortcode_1 Shortcode

function bep_shortcode_1($bep_shortcode_1_attr) {
	// Shortcode Attributes
	$bep_shortcode_1_attr = shortcode_atts ( array(
	'bep_shortcode_1_title'=>'Title',
	'bep_shortcode_1_custom_post_type' =>  'post',
	'bep_shortcode_1_taxonomy_terms_name' => 'category',
	'bep_shortcode_1_taxonomy_terms' => ''
	),$bep_shortcode_1_attr, 'bep_shortcode_1');
	
	$bep_shortcode_1_terms_array = array_map('intval', explode(',', $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms']));

	$bep_shortcode_1_args_1 = array(
	'post_type' => $bep_shortcode_1_attr['bep_shortcode_1_custom_post_type'],
	'posts_per_page' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms_name'],
				'field'    => 'term_id',
				'terms'    => $bep_shortcode_1_terms_array,
			),
		),
	);
	$bep_shortcode_1_query_1 = new WP_Query( $bep_shortcode_1_args_1 );

	$bep_shortcode_1_args_2 = array(
	'post_type' => $bep_shortcode_1_attr['bep_shortcode_1_custom_post_type'],
	'posts_per_page' => 8,
	'offset' => 1,
	'tax_query' => array(		
			array(
				'taxonomy' => $bep_shortcode_1_attr['bep_shortcode_1_taxonomy_terms_name'],
				'field'    => 'term_id',
				'terms'    => $bep_shortcode_1_terms_array,
			),
		),
	);
	$bep_shortcode_1_query_2 = new WP_Query( $bep_shortcode_1_args_2 );
	$prefix = "bep_";
	$return_string ="<div class='{$prefix}block_wrap {$prefix}block_1 {$prefix}pb-border-top red-block'>";
	$return_string.=	"<div class='bep-block-title-wrap'><h4 class='block-title'><span style='margin-right: 0px;'>".$bep_shortcode_1_attr['bep_shortcode_1_title']."</span></h4>";
	/*$return_string.='		<div class="bep-subcat-filter" id="{$prefix}pulldown_{$prefix}uid_13_584f75f11d0a6">';
	$return_string.='			<ul class="bep-subcat-list" id="{$prefix}pulldown_{$prefix}uid_13_584f75f11d0a6_list">';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="{$prefix}uid_14_584f75f1201a8" data-{$prefix}filter_value="" data-{$prefix}block_id="{$prefix}uid_13_584f75f11d0a6" href="#">';
	$return_string.='						All';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="{$prefix}uid_15_584f75f1201fe" data-{$prefix}filter_value="1278" data-{$prefix}block_id="{$prefix}uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeEat';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="{$prefix}uid_16_584f75f12024a" data-{$prefix}filter_value="1302" data-{$prefix}block_id="{$prefix}uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeEntertain';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="{$prefix}uid_17_584f75f12028c" data-{$prefix}filter_value="1281" data-{$prefix}block_id="{$prefix}uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeFashion';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="{$prefix}uid_18_584f75f1202d4" data-{$prefix}filter_value="1274" data-{$prefix}block_id="{$prefix}uid_13_584f75f11d0a6" href="#">';
	$return_string.='						BeTech';
	$return_string.='					</a>';
	$return_string.='				</li>';
	$return_string.='				<li class="bep-subcat-item" style="transition: opacity 0.2s; opacity: 1;">';
	$return_string.='					<a class="bep-subcat-link" id="{$prefix}uid_19_584f75f120319" data-{$prefix}filter_value="1282" data-{$prefix}block_id="{$prefix}uid_13_584f75f11d0a6" href="#">';
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
	$return_string.="</div>";
	$return_string.="<div class='{$prefix}block_inner'>";
	$return_string.=	"<div class='{$prefix}block-row'>";
	$return_string.=		"<div class='{$prefix}shortcode-1-template-big'>";
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_1_query_1->have_posts() ) :
										while ( $bep_shortcode_1_query_1->have_posts() ) : $bep_shortcode_1_query_1->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortodes_1/bep_shortcode_1_big_template.php');
											wp_reset_postdata();
										endwhile;
									endif;	
	$return_string.=		"</div>";
	$return_string.=		"<div class='{$prefix}shortcode-1-template-wide'>";
									// The Loop for biggrid Square Image Template
									if ( $bep_shortcode_1_query_2->have_posts() ) :
										while ( $bep_shortcode_1_query_2->have_posts() ) : $bep_shortcode_1_query_2->the_post();
											include( get_stylesheet_directory() .'/shortcodes/bep_shortodes_1/bep_shortcode_1_small_template.php');
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