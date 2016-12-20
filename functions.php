<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */

//Include Biggrid Shortcode
include( get_stylesheet_directory() . '/shortcodes/bep_shortcodes-core.php' );
include( get_stylesheet_directory() . '/profile-module/be_profile_core.php' );

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

}
add_action( 'init', 'overrite_customposttype_slugs' );