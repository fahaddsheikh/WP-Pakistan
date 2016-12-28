<?php 
$return_string.= $bep_shortcode_1_query->current_post;				
$return_string.='	<div class="bep_module_6 bep_module_wrap bep_animation-stack">';
$return_string.='		<div class="bep_module-thumb">';
$return_string.='			<a href="' . get_permalink() .'" rel="bookmark" title="'.get_the_title().'">';
$return_string.=				 get_the_post_thumbnail( get_the_id() ,  'bep_100x70' );
$return_string.='			</a>';
$return_string.='		</div>';
$return_string.='		<div class="item-details">';
$return_string.='			<h3 class="entry-title bep_module-title">';

if (strlen(get_the_title())>=60)
{ 
	 $return_string.='<a href="'. get_permalink() .'" rel="bookmark" title="'.get_the_title().'">';
	 $return_string.= substr_replace(get_the_title(),'...', 60);
}
else {
	$return_string.='<a href="'. get_permalink() .'" rel="bookmark" title="'.get_the_title().'">';
	$return_string.=get_the_title();
}
$return_string.='				</a>';
$return_string.='			</h3>';
$return_string.='			<div class="bep_module-meta-info">';
$return_string.='				<span class="bep_post-date">';
$return_string.='					<time class="entry-date updated bep_module-date" '. get_the_date('c' , get_the_ID() ) .'">';
$return_string.='						'. get_the_date('F j,Y' , get_the_ID() ) .'';
$return_string.='					</time>';
$return_string.='				</span> ';    
$return_string.='			</div>';
$return_string.='		</div>';
$return_string.='	</div>';
?>	        
				
	

