<?php

function registrar_custom_post() {
	//Landings
	$labels = array(
		'name'  => _x( 'Landings', 'post type general name', 'your-plugin-textdomain' )
	);

	$args = array(
	'labels' => $labels,
	'description' => __( 'Description.', 'your-plugin-textdomain' ),
	'public'  => true,
	'publicly_queryable' => true,
	'show_ui'  => true,
	'show_in_menu'  => true,
	'query_var'  => true,
	'rewrite'  => array( 'slug' => 'landings' ),
	'capability_type'   => 'page',
	'has_archive' => true,
	'hierarchical' => true,
	'menu_position' => null,
	'exclude_from_search' => true,
	'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
	'menu_position' => 5
	);

	register_post_type( 'landings', $args );


}
add_action( 'init', 'registrar_custom_post');


function registrar_taxonomias() {
	//
	// $labels = array(
	// 		'name' => _x( 'Categorías Landings', 'taxonomy general name', 'textdomain' ),
	// );
	// $args = array(
	// 		'hierarchical'      => true,
	// 		'labels'            => $labels,
	// 		'show_ui'           => true,
	// 		'show_admin_column' => true,
	// 		'query_var'         => true,
	// 		'rewrite'           => array( 'slug' => 'landings-categorias' ),
	// );
	//
	// register_taxonomy( 'categorias_landing', array( 'landings'), $args );


}
// add_action( 'init', 'registrar_taxonomias', 0 );
