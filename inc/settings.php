<?php

/*======================================
=            Theme Settings            =
======================================*/


/*==========  Register Menus  ==========*/

register_nav_menus( array(
    'primary' => __( 'Primary Menu',      'wpAtom' ),
    'social'  => __( 'Social Links Menu', 'wpAtom' ),
) );


/*==========  Register Sidebars  ==========*/

register_sidebar( array(
    'name' => __( 'Sidebar', 'wpAtom' ),
    'id' => 'sidebar',
    'description' => __( 'Gemeroc Sodebar.', 'wpAtom' ),
    'class'         => 'sidebar sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );



/*==========  Add capability  ==========*/

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );
add_theme_support( 'post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
) );

/*==========  Remove capability  ==========*/

add_filter('show_admin_bar', '__return_false');

/*==========  New Query vars  ==========*/


function add_date_query_var(){
    global $wp;
    $wp->add_query_var( 'query var name' );        
}
// add_filter( 'init', 'add_date_query_var' );


/*==========  Excerpt length  ==========*/

function new_excerpt_length($length) {
    return 55;
}
// add_filter('excerpt_length', 'new_excerpt_length');

/*==========  Image sizes  ==========*/

// add_image_size( 'post-img', 265, 180, true );

/*==========  Remove POST from dashboard  ==========*/

function remove_menus(){
  remove_menu_page( 'edit.php' );                   //Posts  
}
// add_action( 'admin_menu', 'remove_menus' );

/*==========  Make theme available for translation ==========*/

load_theme_textdomain( 'wpAtom', get_template_directory() . '/languages' );