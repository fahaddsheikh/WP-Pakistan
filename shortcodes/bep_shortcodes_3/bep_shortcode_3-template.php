<?php
$return_string.="<div class='{$prefix}module_10 {$prefix}module_wrap {$prefix}animation-stack'>";
$return_string.="	<div class='{$prefix}module-thumb'>";
$return_string.="		<a href='" . get_permalink() . "' rel='bookmark' title='".get_the_title()."'>";
$return_string.=				 get_the_post_thumbnail( get_the_id() ,  'bep_shortcodes_3' );
$return_string.="		</a>";
$return_string.="	</div>";
$return_string.="	<div class='item-details'>";
$return_string.="		<h3 class='entry-title {$prefix}module-title'>";
$return_string.="			 <a href='" . get_permalink() . "' rel='bookmark' title='".get_the_title()."'>" . get_the_title() . '</a>';
$return_string.="		</h3>";
$return_string.="		<div class='{$prefix}module-meta-info'>";
$return_string.="			<span class='{$prefix}post-author-name'>";
$return_string .=				"<a href=". get_author_posts_url( get_the_author_meta( get_the_id() ), get_the_author_meta( 'user_nicename' ) ) . ">" . get_the_author() . "</a>";
$return_string.="				<span>-</span>";
$return_string.="			</span>";   
$return_string.="			<span class='{$prefix}post-date'>";
$return_string.="           <time class='entry-date updated {$prefix}module-date' datetime='". get_the_date('c' , get_the_ID() ) ."'>";
$return_string.="               ". get_the_date('F j,Y' , get_the_ID() ) ."";
$return_string.="           </time>";
$return_string.="			</span>";
$return_string.="		</div>";
$return_string.=	"<div class='{$prefix}excerpt'>";
$return_string.=		substr( strip_tags(get_the_content( get_the_ID() )), 0, 300) . '...';
$return_string.='	</div>';
$return_string.="	</div>";
$return_string.="</div>";
?>