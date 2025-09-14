<?php
/**
 * Basic Business Theme functions and definitions.
 */

// Enqueue styles and scripts
function basic_business_enqueue_styles() {
    wp_enqueue_style( 'basic-business-style', get_stylesheet_uri() ); // Loads style.css
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'basic_business_enqueue_styles' );

// Register navigation menu
function basic_business_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'basic-business' ),
    ) );
}
add_action( 'init', 'basic_business_register_menus' );

// Add theme support for basics
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

// Remove default theme sidebars to keep it full-width
function basic_business_remove_sidebars() {
    unregister_sidebar( 'sidebar-1' ); // Adjust if your theme has others
}
add_action( 'widgets_init', 'basic_business_remove_sidebars', 11 );

// Register Custom Post Type for Waitlist Entries
function register_waitlist_cpt() {
    $labels = array(
        'name'                  => _x( 'Waitlist Entries', 'Post Type General Name', 'basic-business' ),
        'singular_name'         => _x( 'Waitlist Entry', 'Post Type Singular Name', 'basic-business' ),
        'menu_name'             => __( 'Waitlist Entries', 'basic-business' ),
        'name_admin_bar'        => __( 'Waitlist Entry', 'basic-business' ),
        'archives'              => __( 'Entry Archives', 'basic-business' ),
        'attributes'            => __( 'Entry Attributes', 'basic-business' ),
        'parent_item_colon'     => __( 'Parent Entry:', 'basic-business' ),
        'all_items'             => __( 'All Entries', 'basic-business' ),
        'add_new_item'          => __( 'Add New Entry', 'basic-business' ),
        'add_new'               => __( 'Add New', 'basic-business' ),
        'new_item'              => __( 'New Entry', 'basic-business' ),
        'edit_item'             => __( 'Edit Entry', 'basic-business' ),
        'update_item'           => __( 'Update Entry', 'basic-business' ),
        'view_item'             => __( 'View Entry', 'basic-business' ),
        'view_items'            => __( 'View Entries', 'basic-business' ),
        'search_items'          => __( 'Search Entry', 'basic-business' ),
    );
    $args = array(
        'label'                 => __( 'Waitlist Entry', 'basic-business' ),
        'description'           => __( 'Waitlist form submissions', 'basic-business' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
    );
    register_post_type( 'waitlist_entry', $args );
}
add_action( 'init', 'register_waitlist_cpt', 0 );