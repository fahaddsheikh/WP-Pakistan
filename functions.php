<?php

/**

 * Register our sidebars and widgetized areas.

 *

 */



//Include Biggrid Shortcode

include( get_stylesheet_directory() . '/shortcodes/bep_shortcodes-core.php' );

include( get_stylesheet_directory() . '/profile-module/be_profile_core.php' );





//Add Theme Support

function unregister_unused_post_types() {

	unregister_post_type( 'ait-job-offer' );

	unregister_post_type( 'ait-member' );

	unregister_post_type( 'ait-partner' );

	unregister_post_type( 'ait-event' );

	unregister_post_type( 'ait-service-box' );

	unregister_post_type( 'ait-price-table' );

	unregister_post_type( 'ait-portfolio-item' );

	unregister_post_type( 'ait-toggle' );

	unregister_post_type( 'ait-testimonial' );

	unregister_post_type( 'ait-faq' );

	unregister_post_type( 'ait-ad-space' );

}

add_action('init','unregister_unused_post_types');





//Sort posts in archive pages alphabetically

function my_change_sort_order($query){

    if(is_post_type_archive('ait-item') ||  is_post_type_archive('ait-review') || is_post_type_archive('ait-event-pro')):

     //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )

       //Set the order ASC or DESC

       $query->set( 'order', 'DESC' );

       //Set the orderby

       $query->set( 'orderby', 'date' );

    endif;    

};

add_action( 'pre_get_posts', 'my_change_sort_order'); 





function bep_custom_includes() {

    wp_enqueue_script( 'bep-custom-javascript', get_stylesheet_directory_uri() . '/js/bep-custom-javascript.js', true );

}

add_action( 'wp_enqueue_scripts', 'bep_custom_includes' );



function be_pakistan_custom_widgets_init() {



	// TOP GOOGLE ADVERTISEMENT BANNER

	register_sidebar( array(

		'name'          => 'Top Banner Widget',

		'id'            => 'top_banner_widget',

		'before_widget' => '<div>',

		'after_widget'  => '</div>',

	) );



}

add_action( 'widgets_init', 'be_pakistan_custom_widgets_init' );



function override_customposttype_slugs() {

	$args = get_post_type_object("ait-event-pro");
	$args->rewrite["slug"] = "eventss";
	register_post_type($args->name, $args);

	$args = get_post_type_object("ait-item");
	$args->rewrite["slug"] = "businesses";
	register_post_type($args->name, $args);

	$args = get_post_type_object("profile");
	$args->rewrite["slug"] = "profiles";
	register_post_type($args->name, $args);

	register_taxonomy_for_object_type( 'ait-locations', 'post' );
	register_taxonomy_for_object_type( 'ait-locations', 'profile' );
}

add_action( 'init', 'override_customposttype_slugs');



//[obj]
function check_post_type_obj()
{
	var_dump(get_post_type_object("ait-item"));
}
add_shortcode( 'obj', 'check_post_type_obj' );



//Page Slug Body Class



function add_slug_body_class( $classes ) {

	global $post;

	if ( isset( $post ) ) {

		$classes[] = $post->post_type . '-' . $post->post_name;

	}

	return $classes;

}

add_filter( 'body_class', 'add_slug_body_class' );



function bep_set_max_posts_archive_layouts( $query ){

    if ($query->is_post_type_archive( array( 'ait-review' , 'ait-item' , 'profile') ) && $query->is_main_query() ){

            $query->set( 'posts_per_page', 10 );

    }

}

add_action( 'pre_get_posts', 'bep_set_max_posts_archive_layouts', 100 , 2);



// Handle the post_type parameter given in get_terms function

function df_terms_clauses($clauses, $taxonomy, $args) {

	if (!empty($args['post_type']))	{

		global $wpdb;



		$post_types = array();



		foreach($args['post_type'] as $cpt)	{

			$post_types[] = "'".$cpt."'";

		}



	    if(!empty($post_types))	{

			$clauses['fields'] = 'DISTINCT '.str_replace('tt.*', 'tt.term_taxonomy_id, tt.term_id, tt.taxonomy, tt.description, tt.parent', $clauses['fields']).', COUNT(t.term_id) AS count';

			$clauses['join'] .= ' INNER JOIN '.$wpdb->term_relationships.' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN '.$wpdb->posts.' AS p ON p.ID = r.object_id';

			$clauses['where'] .= ' AND p.post_type IN ('.implode(',', $post_types).')';

			$clauses['orderby'] = 'GROUP BY t.term_id '.$clauses['orderby'];

		}

    }

    return $clauses;

}

add_filter('terms_clauses', 'df_terms_clauses', 10, 3);



