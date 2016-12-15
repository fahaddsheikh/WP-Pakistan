<?php

$return_string.= $bep_shortcode_1_query->current_post;
$return_string.='<div class="bep_module_4 bep_module_wrap bep-animation-stack">';
$return_string.='	<div class="bep-module-image">';
$return_string.='		<div class="bep-module-thumb">';
$return_string.='			<a href="' . get_permalink() . '" rel="bookmark" title="'.get_the_title().'">';
$return_string.='				<img width="324" height="235" class="entry-thumb bep-animation-stack-type0-1" src="' . wp_get_attachment_image_src(get_post_thumbnail_id($id), 'bep_shortcode_1', false)[0] . '" alt="" title="'. get_the_title() . '">';
$return_string.='			</a>';
$return_string.='		</div>';
								$bep_selectedtype = get_post_meta( get_the_id(), 'bep_type', true );
									if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
$return_string.='			<span class="bep-post-category">';
$return_string.='				'. $bep_selectedtype .' ';
$return_string.='			</span>';
									}
$return_string.='	</div>';
$return_string.='	<h3 class="entry-title bep-module-title">';
$return_string.='		<a href="' . get_permalink() . '" rel="bookmark" title="'.get_the_title().'">';
$return_string.='			'.get_the_title().'';
$return_string.='		</a>';
$return_string.='	</h3>';
$return_string.='	<div class="bep-module-meta-info">';
$return_string.='		<span class="bep-post-author-name">';
$return_string.='			<a href="'. get_author_posts_url( get_the_ID() ) .'">';

/*$return_string.='				'. get_the_author_meta( 'display_name', get_the_ID() ) . '';*/
$return_string.=''.get_the_author() .'';
$return_string.='			</a>';
$return_string.='			<span>-</span>';
$return_string.='		</span>';
$return_string.='		<span class="bep-post-date">';
$return_string.='			<time class="entry-date updated bep-module-date" datetime="'. get_the_date('c' , get_the_ID() ) .'">';
$return_string.='				'. get_the_date('F j,Y' , get_the_ID() ) .'';
$return_string.='			</time>';
$return_string.='		</span> ';
$return_string.='		<div class="bep-module-comments">';
/*$return_string.='			<a href="http://bekarachi.com/junaid-rahim-thinking-out-of-the-box/#respond">';
$return_string.='				0';
$return_string.='			</a>';*/
$return_string.='		</div>';
$return_string.='	</div>';

$return_string.='	<div class="bep-excerpt">';
$return_string.='		'.get_the_content( get_the_ID() ).'';
$return_string.='	</div>';
$return_string.='</div>';

?>
