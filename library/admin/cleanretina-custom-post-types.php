<?php
/**
 * Create Custom post type gallery
 *
 * @package Theme Horse
 * @subpackage Clean_Retina
 * @since Clean Retina 1.0
 */

add_action( 'init', 'cleanretina_custom_post' );
/**
 * Register custom post type.
 *
 * We register a new custom post type to show the gallery.
 */
function cleanretina_custom_post() {
   
	$labels = array(
		'name'                  => _x( 'Gallery', 'cleanretina_custom_post', 'cleanretina' ),
		'singular_name'         => _x( 'Gallery', 'cleanretina_custom_post', 'cleanretina' ),
		'all_items'             => _x( 'All Galleries', 'cleanretina_custom_post', 'cleanretina' ),
		'add_new'               => _x( 'Add New', 'cleanretina_custom_post', 'cleanretina' ),
		'add_new_item'          => _x( 'Add New', 'cleanretina_custom_post', 'cleanretina' ),
		'edit_item'             => _x( 'Edit Gallery', 'cleanretina_custom_post', 'cleanretina' ),
		'new_item'              => _x( 'New Gallery', 'cleanretina_custom_post', 'cleanretina' ),
		'view_item'             => _x( 'View Gallery', 'cleanretina_custom_post', 'cleanretina' ),
		'search_items'          => _x( 'search Gallery', 'cleanretina_custom_post', 'cleanretina' ),
		'not_found'             => _x( 'No Gallery Found', 'cleanretina_custom_post', 'cleanretina' ),
		'not_found_in_trash'    => _x( 'No Gallery found in Trash', 'cleanretina_custom_post', 'cleanretina' ),
		'parent_item_colon'     => _x( 'Parent Gallery:', 'cleanretina_custom_post', 'cleanretina' ),
		'menu_name'             => _x( 'Galleries', 'cleanretina_custom_post', 'cleanretina' )
	);
	$args = array(
		'labels'                => $labels,
		'hierarchical'          => false,
		'description'           => __( 'Custom Gallery Posts', 'cleanretina' ),
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'post-formats', 'custom-fields' ),
		'taxonomies'            => array( 'post_tag' ),
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => CLEANRETINA_ADMIN_IMAGES_URL . '/backend-theme-horse-icon.png',
		'show_in_nav_menus'     => true,
		'publicly_queryable'    => true,
		'exclude_from_search'   => false,
		'has_archive'           => true,
		'query_var'             => true,
		'can_export'            => true,
		'rewrite'               => true,
		'capability_type'       => 'post'
	);       


	register_post_type( 'gallery', $args );
}

?>