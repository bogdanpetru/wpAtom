<?php

/*=================================
=            Seetings             =
=================================*/


// Hide admin bar
add_filter('show_admin_bar', '__return_false');

/*==========  Register Menus  ==========*/
register_nav_menus( array('primary' => 'Primary menu') );


/*==========  Register Sidebars  ==========*/


register_sidebar( array(
    'name' => __( 'Sidebar', 'wpApp' ),
    'id' => 'sidebar',
    'description' => __( 'Widget-urile din aceasta zona vor aparea pe coloana 1 (sub submeniu).', 'wpApp' ),
    'class'         => 'sidebar sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );



/*==========  Enquire scripts  ==========*/
function enquire_scripts(){

    global $pagenow;

    // Widgets
    if ( 'widgets.php' === $pagenow ){
        wp_enqueue_script( 'widget-script', get_bloginfo( 'template_url' ) . '/assets/js/widget-scripts.js', array( 'jquery' ), false, true );
    }

    // Jquery
     wp_enqueue_script( 'jquery' );
     wp_enqueue_script( 'jquery-ui-core' );
     wp_enqueue_script( 'jquery-ui-widget' );
     wp_enqueue_script( 'jquery-ui-slider' );
     wp_enqueue_script( 'jquery-ui-selectmenu' );
}

add_action( 'admin_init', 'enquire_scripts' );
add_action( 'wp_enqueue_scripts', 'enquire_scripts' );


/*==========  Add thumb capability  ==========*/
add_theme_support( 'post-thumbnails' );


/*==========  New Query vars  ==========*/

// add `author_more` to query vars
function add_date_query_var(){
    global $wp;
    $wp->add_query_var( 'chiffre' );      
    // $wp->add_query_var( '' );    
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
    add_editor_style('assets/css/editor-style.css');
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );


/*==========  Remove POST from dashboard  ==========*/
function remove_menus(){
  remove_menu_page( 'edit.php' );                   //Posts  
}
// add_action( 'admin_menu', 'remove_menus' );




?>