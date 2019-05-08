<?php
/*
function bigcity_posttype_ITEM() {
	$single = 'Item';
	$plural = 'Items';
	$labels = array(
		'name'              => _x( $plural, 'taxonomy general name' ),
		'singular_name'     => _x( $single, 'taxonomy singular name' ),
		'search_items'      => __( 'Search'.$plural ),
		'all_items'         => __( 'All '.$plural ),
		'parent_item'       => __( 'Parent '.$single ),
		'parent_item_colon' => __( 'Parent '.$single.':' ),
		'edit_item'         => __( 'Edit '.$single ),
		'update_item'       => __( 'Update '.$single ),
		'add_new_item'      => __( 'Add New '.$single ),
		'new_item_name'     => __( 'New '.$single.' Name' ),
		'menu_name'         => __( $plural ),
	);
	$args = array(
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'revisions', 'thumbnail' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'rewrite'             => array('with_front' => false,'slug' => ''),
		'menu_icon'           => '', // https://developer.wordpress.org/resource/dashicons
	);
	register_post_type( 'ITEM', $args );
}

add_action( 'init', 'bigcity_posttype_ITEM', 0 );
*/

// flush permalink cache
// ONLY DO THIS ONCE then comment it out again. This is bad if loaded on every page.
//flush_rewrite_rules();