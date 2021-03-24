<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package esgalla
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function esgalla_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'esgalla_body_classes' );

/**
 * Adds a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function esgalla_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'esgalla_pingback_header' );

/**
 * Adds .current-menu-item active class to active menu item
 */
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );

function custom_active_item_classes($classes = array(), $menu_item = false){
	global $post;
	if(is_product_category()) $post = (object)[]; $post->post_type = 'product';
	// echo get_post_type_archive_link('product');
	$classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item active' : '';
	return $classes;
}
