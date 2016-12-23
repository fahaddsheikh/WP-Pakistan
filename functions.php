<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */

//Include Biggrid Shortcode
include( get_stylesheet_directory() . '/shortcodes/bep_shortcodes-core.php' );
include( get_stylesheet_directory() . '/profile-module/be_profile_core.php' );


//Add Theme Support

add_theme_support( 'html5', array( 'search-form' ) );

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

function overrite_customposttype_slugs() {

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

}
add_action( 'init', 'overrite_customposttype_slugs' );

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

