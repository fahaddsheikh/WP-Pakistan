<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */

//Include Biggrid Shortcode
include( get_stylesheet_directory() . '/shortcodes/bep_shortcodes-core.php' );

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

