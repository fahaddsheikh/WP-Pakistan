<?php
$prefix = "bep_";
function bep_custom_thumb($image_width = '',$image_height = '', $module_type = '') {

	global $prefix;
	$bep_selectedtype = get_post_type();
	$image_link = get_permalink();
	$get_title = get_the_title();

	if ($bep_selectedtype == "ait-review") {

		$image_link = get_permalink(get_post_meta(get_the_id(), 'post_id', true));
		$get_title = get_the_title(get_post_meta(get_the_id(), 'post_id', true));
		$image_src_link =  get_the_post_thumbnail( get_post_meta(get_the_id(), 'post_id', true) ,  'bep_'.$image_width.'x'.$image_height );

	}
	elseif ($bep_selectedtype == "ait-event-pro") {
		$bep_event_array = get_post_meta(get_the_id(), '_ait-event-pro_event-pro-data', true);
		$bep_event_date = strtotime($bep_event_array['dates'][0]['dateFrom']);
		$bep_eventfrom_date = date('j', $bep_event_date);
		$bep_eventfrom_date_suffix = date('S', $bep_event_date);
		$bep_eventfrom_month = date('M', $bep_event_date);

			if($module_type == 'biggrid') {
				
				$image_src_link =  get_post_meta(get_the_id(), '_ait-event-pro_event-pro-data', true);

			}
			else {

				$image_link =  get_permalink(get_post_meta(get_the_id(), 'post_id', true)) ;
				$image_src_link = get_the_title(get_post_meta(get_the_id(), 'post_id', true));

			}
	}

	else {

		$image_src_link =  get_the_post_thumbnail( get_the_id() ,  'bep_'.$image_width.'x'.$image_height);

	}

	$return_string ="	<div class='{$prefix}module-thumb'>";
	$return_string.="		<a href='" . $image_link . "' rel='bookmark' title='".$get_title."'>";

	if ($module_type == 'biggrid') {
		$bep_selectedtype_array = $image_src_link;
		$return_string .= 				"<img width='324' height='235' src='" . $bep_selectedtype_array['headerImage'] . "'>";	

	}

	else if ($module_type == 'normal') {

		$return_string.=    "<span class='event-date'>" . $bep_eventfrom_date . "<sup>" . $bep_eventfrom_date_suffix . "</sup></span>";
		$return_string.=    "<span class='event-month'>" . $bep_eventfrom_month . "</span>";					
	}

	else {

		$return_string.=$image_src_link;

	}

	$return_string.="		</a>";
	$return_string.="	</div>";
	    
	return $return_string;
 }

function bep_custom_title() {

	$bep_selectedtype = get_post_type();
	global $prefix;
	$post_link = get_permalink();
	$get_title = get_the_title();	
	if ($bep_selectedtype=="ait-review") {
		$get_title = get_the_title( get_post_meta(get_the_id(), 'post_id', true) );
	}

	$return_string ="		<h3 class='entry-title {$prefix}module-title'>";
	$return_string.="			 <a href='" . $post_link . "' rel='bookmark' title='".$get_title."'>";
	if  ((($bep_selectedtype == "profile") ||  ($bep_selectedtype == "ait-item")) && (strlen($get_title)>=20) ) {
		
		 	$return_string.= substr_replace($get_title,'...', 20);
		}
	
	else {

		$return_string.=$get_title;
	}
		
	$return_string.='	</a>';
	$return_string.='		</h3>';
	
	return $return_string;

}


function bep_custom_author_name() {

	global $prefix;
	$return_string ="			<span class='{$prefix}post-author-name'>";
	$return_string.=				"<a href=". get_author_posts_url( get_the_author_meta( get_the_id() ), get_the_author_meta( 'user_nicename' ) ) . ">" . get_the_author() . "</a>";
	$return_string.="				<span>-</span>";
	$return_string.="			</span>";
	
	return $return_string;
}


function bep_custom_time() {

	global $prefix;
	$return_string ="			<span class='{$prefix}post-date'>";
	$return_string.="           <time class='entry-date updated {$prefix}module-date' datetime='". get_the_date('c' , get_the_ID() ) ."'>";
	$return_string.="               ". get_the_date('F j,Y' , get_the_ID() ) ."";
	$return_string.="           </time>";
	$return_string.="			</span>";

	return $return_string;

}

function bep_custom_excerpt($to,$from) {

	global $prefix;
	$return_string =	"<div class='{$prefix}excerpt'>";
	$return_string.=		substr( strip_tags(get_the_content( get_the_ID() )), $to, $from) . '...';
	$return_string.='	</div>';

	return $return_string;
}

function bep_custom_category() {

	global $prefix;
	$bep_selectedtype = get_post_type();
	if (isset($bep_selectedtype) && !empty($bep_selectedtype) ) {
	$return_string ='<span class="bep_post-category">';
					 	if ($bep_selectedtype == 'ait-item') {
	$return_string.='		Business';
						}
						elseif ($bep_selectedtype == 'post') {
	$return_string.='		Blog';
						}
						elseif ($bep_selectedtype == 'ait-event-pro') {
	$return_string.='		Event';
						}
						elseif ($bep_selectedtype == 'profile') {
	$return_string.='		Profile';
						}
	$return_string.='</span>';
	return $return_string;
	}
}

?>