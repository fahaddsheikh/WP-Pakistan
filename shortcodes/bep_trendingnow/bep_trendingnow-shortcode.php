<?php 

function bep_trendingnow() {

    // Shortcode Attributes
    $bep_trendingnow_shortcode_atts = shortcode_atts(
        array(
            'number_of_posts' => '5'
        ),
        $bep_trendingnow_shortcode_atts, 'bep_trendingnow'
    );

    // The query arguments for Trending Now Template
    $bep_trendingnow_query_args = array(
        'post_type' => 'post',
        'show_posts'      => $bep_trendingnow_shortcode_atts['number_of_posts'],
        'posts_per_page'      => $bep_trendingnow_shortcode_atts['number_of_posts'],
        'post_status' => 'publish',
        'category_name' => 'trending-now'
    );

    $bep_trendingnow_query = new WP_Query( $bep_trendingnow_query_args );

    $prefix = 'bep_' ;
    $return_string =    "<div class='{$prefix}trending-now-wrapper' data-start=''>";
    $return_string .=        "<div class='{$prefix}trending-now-title'>Trending Now</div>";
    $return_string .=        "<div class='{$prefix}trending-now-display-area'>";
    // The Loop for biggrid Square Image Template
    if ( $bep_trendingnow_query->have_posts() ) :
        while ( $bep_trendingnow_query->have_posts() ) : $bep_trendingnow_query->the_post(); 
            $return_string .=   "<div class='{$prefix}module_trending_now {$prefix}trending-now-post'>";
            $return_string .=       "<h3 class='entry-title {$prefix}module-title'><a href='" . get_permalink() . "' rel='bookmark' title='" . get_the_title() . "'>" . get_the_title() . "</a></h3>";
            $return_string .=   "</div>";
            wp_reset_postdata();
        endwhile;
    endif;
    $return_string .=        "</div>";
/*    $return_string .=        "<div class='{$prefix}next-prev-wrap'>";
    $return_string .=            "<a href='#' class='{$prefix}ajax-prev-pagex {$prefix}trending-now-nav-left' data-block-id='{$prefix}uid_11_5850daa23682c' data-moving='left' data-control-start=''>";
    $return_string .=                "<i class='{$prefix}icon-menu-left'></i></a>";
    $return_string .=            "<a href='#' class='{$prefix}ajax-next-pagex {$prefix}trending-now-nav-right' data-block-id='{$prefix}uid_11_5850daa23682c' data-moving='right' data-control-start=''>";
    $return_string .=            "<i class='{$prefix}icon-menu-right'></i></a>";
    $return_string .=        "</div>";*/
    $return_string .=    "</div>";

    return $return_string;

}
add_shortcode('bep_trendingnow' , 'bep_trendingnow');
?> 
