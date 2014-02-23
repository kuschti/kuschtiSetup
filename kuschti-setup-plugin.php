<?php
/*
Plugin Name: Kuschti Setup
Description: kuschti.ch spezifische Konfigurationen
*/

/* Start Adding Functions Below this Line */

// 1. Register Review Post Type

function ctp_rewrite_flush() {
    ctp_ku_reviews_init();
    cpt_ku_reviewstypes_init();
    flush_rewrite_rules(false);
}
register_activation_hook( __FILE__, 'ctp_rewrite_flush' );


// let's create the function for the custom type
function ctp_ku_reviews_init() {
    // creating (registering) the custom type
    register_post_type( 'ku_reviews', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        // let's now add all the options for this post type
        array('labels' => array(
            'name' => __('Reviews', 'kuTheme'), /* This is the Title of the Group */
            'singular_name' => __('Review', 'kuTheme'), /* This is the individual type */
            'all_items' => __('Alle Reviews', 'kuTheme'), /* the all items menu item */
            'add_new' => __('Neues Review', 'kuTheme'), /* The add new menu item */
            'add_new_item' => __('Neues Review erstellen', 'kuTheme'), /* Add New Display Title */
            'edit' => __( 'Bearbeiten', 'kuTheme' ), /* Edit Dialog */
            'edit_item' => __('Reviews bearbeiten', 'kuTheme'), /* Edit Display Title */
            'new_item' => __('Neues Review', 'kuTheme'), /* New Display Title */
            'view_item' => __('Review anzeigen', 'kuTheme'), /* View Display Title */
            'search_items' => __('Review suchen', 'kuTheme'), /* Search Custom Type Title */
            'not_found' =>  __('Nothing found in the Database.', 'kuTheme'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash', 'kuTheme'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'This is the example custom post type', 'kuTheme' ), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon' => 'dashicons-star-filled',
            'rewrite'   => array( 'slug' => 'reviews', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => 'reviews', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title', 'editor', 'author', 'thumbnail')
        ) /* end of options */
    ); /* end of register post type */

}

// adding the function to the Wordpress init
add_action( 'init', 'ctp_ku_reviews_init');

// 2. reviews Kategorien
function cpt_ku_reviewstypes_init() {
    // now let's add custom categories (these act like categories)
    register_taxonomy( 'ku_reviewstypes',
        array('ku_reviews'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
        array('hierarchical' => true,     /* if this is true, it acts like categories */
            'labels' => array(
                'name' => __( 'Review Typ', 'kuTheme' ), /* name of the custom taxonomy */
                'singular_name' => __( 'Review Typ', 'kuTheme' ), /* single taxonomy name */
                'search_items' =>  __( 'Review Typen suchen', 'kuTheme' ), /* search title for taxomony */
                'all_items' => __( 'Alle Review Typen', 'kuTheme' ), /* all title for taxonomies */
                'parent_item' => __( 'Parent Custom Category', 'kuTheme' ), /* parent title for taxonomy */
                'parent_item_colon' => __( 'Parent Custom Category:', 'kuTheme' ), /* parent taxonomy title */
                'edit_item' => __( 'Review Typ bearbeiten', 'kuTheme' ), /* edit custom taxonomy title */
                'update_item' => __( 'Update Custom Category', 'kuTheme' ), /* update title for taxonomy */
                'add_new_item' => __( 'Neuer Review Typ', 'kuTheme' ), /* add new title for taxonomy */
                'new_item_name' => __( 'New Custom Category Name', 'kuTheme' ) /* name title for taxonomy */
            ),
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'reviews/typ' ),
        )
    );
}

add_action( 'init', 'cpt_ku_reviewstypes_init');

// 10. Add Theme/Blog Supports

// wp thumbnails (sizes handled in functions.php)
add_theme_support('post-thumbnails');

// default thumb size
set_post_thumbnail_size(125, 125, true);

// Add default posts and comments RSS feed links to head
add_theme_support('automatic-feed-links');

// adding post format support
add_theme_support( 'post-formats',
    array(
        'aside',             // title less blurb
        'gallery',           // gallery of images
        'link',              // quick link to other site
        'image',             // an image
        'quote',             // a quick quote
        'status',            // a Facebook like status update
        'video',             // video
        'chat'               // chat transcript
    )
);

// wp menus
add_theme_support( 'menus' );

// registering wp3+ menus
register_nav_menus(
    array(
        'mainNav' => __( 'Main Nav', 'kuTheme' ),   // main nav in header
        'footerNav' => __( 'Footer Nav', 'kuTheme' ) // secondary nav in footer
    )
);

/* Stop Adding Functions Below this Line */
?>
