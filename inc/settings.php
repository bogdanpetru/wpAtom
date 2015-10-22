<?php

/*=================================
=            Seetings             =
=================================*/

// Hide admin bar
add_filter('show_admin_bar', '__return_false');

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

/*==========  New Query vars  ==========*/

// add `author_more` to query vars
function add_date_query_var(){
    global $wp;
    $wp->add_query_var( 'chiffre' );        
}
// add_filter( 'init', 'add_date_query_var' );


/*==========  Excerpt length  ==========*/
function new_excerpt_length($length) {
    return 55;
}
add_filter('excerpt_length', 'new_excerpt_length');

/*==========  Image sizes  ==========*/
// add_image_size( 'post-img', 265, 180, true );


/*==========  Enable editor style  ==========*/
function my_theme_add_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:300,400,700' );
    add_editor_style( $font_url );
    add_editor_style('dist/css/editor-style.css');
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );


/*==========  Remove POST from dashboard  ==========*/
function remove_menus(){
  remove_menu_page( 'edit.php' );                   //Posts  
}
// add_action( 'admin_menu', 'remove_menus' );





/*==========  Post2Post register relationships ==========*/
function register_relations() {
    p2p_register_connection_type( array(
        'name' => 'solution-pr',
        'from' => 'solutions',
        'to' => 'pr',
        // 'admin_column' => 'any',
         // 'admin_dropdown' => 'any',
    ) );
}

// add_action( 'p2p_init', 'register_relations' );