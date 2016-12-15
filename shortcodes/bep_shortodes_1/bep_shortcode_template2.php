<?php 
$return_string.= $bep_shortcode_1_query->current_post;				
$return_string.='	<div class="bep_module_6 bep_module_wrap bep-animation-stack">';
$return_string.='		<div class="bep-module-thumb">';
$return_string.='			<a href="' . get_permalink() .'" rel="bookmark" title="'.get_the_title().'">';
$return_string.='				<img width="100" height="70" class="entry-thumb bep-animation-stack-type0-1" src=" '. wp_get_attachment_image_src(get_post_thumbnail_id($id), 'biggrid-small', false)[0] .'" srcset="' . wp_get_attachment_image_src(get_post_thumbnail_id($id), 'bep_shortcode_1', false)[0] .' 100w,' . wp_get_attachment_image_src(get_post_thumbnail_id($id), 'bep_shortcode_1', false)[0] .' 218w" sizes="(max-width: 100px) 100vw, 100px" alt="" title="'. get_the_title() . '">';
$return_string.='			</a>';
$return_string.='		</div>';
$return_string.='		<div class="item-details">';
$return_string.='			<h3 class="entry-title bep-module-title">';
$return_string.='				<a href="'. get_permalink() .'" rel="bookmark" title="'.get_the_title().'">'.get_the_title().'';
$return_string.='				</a>';
$return_string.='			</h3>';
$return_string.='			<div class="bep-module-meta-info">';
$return_string.='				<span class="bep-post-date">';
$return_string.='					<time class="entry-date updated bep-module-date" '. get_the_date('c' , get_the_ID() ) .'">';
$return_string.='						'. get_the_date('F j,Y' , get_the_ID() ) .'';
$return_string.='					</time>';
$return_string.='				</span> ';    
$return_string.='			</div>';
$return_string.='		</div>';
$return_string.='	</div>';
?>	        
				
	

