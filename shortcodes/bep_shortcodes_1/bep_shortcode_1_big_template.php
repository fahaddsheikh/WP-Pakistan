<?php

$return_string.='<div class="bep_module_4 bep_module_wrap bep_animation-stack">';
$return_string.='	<div class="bep_module-image">';
$return_string.='		<div class="bep_module-thumb">';
$return_string.='			<a href="' . get_permalink() . '" rel="bookmark" title="'.get_the_title().'">';
$return_string.=				 get_the_post_thumbnail( get_the_id() ,  'bep_324x235' );
$return_string.='			</a>';
$return_string.='		</div>';
								$bep_selectedtype = get_post_type();
									if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
$return_string.='						<span class="bep_post-category">';
										if ($bep_selectedtype == 'ait-item') {
$return_string.='							Business';
										}
										elseif ($bep_selectedtype == 'post') {
$return_string.='							Blog';
										}
										elseif ($bep_selectedtype == 'ait-event-pro') {
$return_string.='							Event';
										}
										elseif ($bep_selectedtype == 'profile') {
$return_string.='							Profile';
										}
$return_string.='						</span>';
									}
$return_string.='	</div>';
$return_string.='	<h3 class="entry-title bep_module-title">';
$return_string.='		<a href="' . get_permalink() . '" rel="bookmark" title="'.get_the_title().'">';
$return_string.='			'.get_the_title().'';
$return_string.='		</a>';
$return_string.='	</h3>';
$return_string.='	<div class="bep_module-meta-info">';
$return_string.='		<span class="bep_post-author-name">';
$return_string .=			"<a href=". get_author_posts_url( get_the_author_meta( get_the_id() ), get_the_author_meta( 'user_nicename' ) ) . ">" . get_the_author() . "</a>";
$return_string.='			<span>-</span>';
$return_string.='		</span>';
$return_string.='		<span class="bep_post-date">';
$return_string.='			<time class="entry-date updated bep_module-date" datetime="'. get_the_date('c' , get_the_ID() ) .'">';
$return_string.='				'. get_the_date('F j,Y' , get_the_ID() ) .'';
$return_string.='			</time>';
$return_string.='		</span> ';
$return_string.='	</div>';
$return_string.='	<div class="bep_excerpt">';
$return_string.=		substr( strip_tags(get_the_content( get_the_ID() )), 0, 180) . '...';
$return_string.='	</div>';
$return_string.='</div>';

?>
