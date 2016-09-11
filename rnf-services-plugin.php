<?php
/*
Plugin Name: Roughneck Fitness Services
Plugin URI: 
Description: Create Services that you offer. 
Author: Chris Davies
Author URI:
Version: 1.0
Text Domain: services
*/

/*
|--------------------------------------------------------------------------
| SERVICES POST TYPE - SETUP
|--------------------------------------------------------------------------
*/

function rnf_services_post_type()
{

	// SET UI LABELS FOR CPT
	$labels = array(
		'name'                => _x( 'Services', 'Post Type General Name', 'services' ),
		'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'services' ),
		'menu_name'           => __( 'Services', 'services' ),
		'all_items'           => __( 'All Services', 'services' ),
		'view_item'           => __( 'View Service', 'services' ),
		'add_new_item'        => __( 'Add New Service', 'services' ),
		'add_new'             => __( 'Add New', 'services' ),
		'edit_item'           => __( 'Edit Service', 'services' ),
		'update_item'         => __( 'Update Service', 'services' ),
		'search_items'        => __( 'Search Services', 'services' ),
		'not_found'           => __( 'Not Found', 'services' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'services' ),
	);
	
	// SET OTHER OPTIONS FOR CPT	
	$args = array(
		'label'               => __( 'Services', 'services' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ), // Features this CPT supports in Post Editor
		'taxonomies'          => array( 'services' ),	// You can associate this CPT with a taxonomy or custom taxonomy.
		'hierarchical'        => true, // A hierarchical CPT is like Pages and can have Parent and child items. A non-hierarchical CPT is like Posts.
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'			  => 'dashicons-book',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite' => array( 'slug' => 'services' ),
	);
	
	// REGISTER THE CPT
	register_post_type( 'services', $args );

}

function rnf_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    rnf_services_post_type();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'rnf_rewrite_flush' );

add_action( 'init', 'rnf_services_post_type', 0 );

/*
|--------------------------------------------------------------------------
| PLUGIN FUNCTIONS
|--------------------------------------------------------------------------
*/

define( 'RNF_SERVICES_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// TAB LAYOUT SHORTCODE

function rnf_tab_services_shortcode() {
    ob_start();
    include ( RNF_SERVICES_PLUGIN_PATH . 'templates/tab-layout.php');
    $content = ob_get_clean();
    return $content;
}

add_shortcode( 'services_tabs', 'rnf_tab_services_shortcode' );

?>