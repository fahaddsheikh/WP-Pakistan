<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */

//Include Biggrid Shortcode
include( get_stylesheet_directory() . '/shortcodes/bep_shortcodes-core.php' );
include( get_stylesheet_directory() . '/profile-module/be_profile_core.php' );

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