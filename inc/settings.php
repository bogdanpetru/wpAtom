<?php

/*=================================
=            Seetings             =
=================================*/


// Hide admin bar
add_filter('show_admin_bar', '__return_false');



/*==========  Register Menus  ==========*/

register_nav_menus( array('primary' => 'Meniu Principal') );

/*==========  Register Sidebars  ==========*/


register_sidebar( array(
    'name' => __( 'Pagina - Coloana 1', 'theme-slug' ),
    'id' => 'page-sidebar-1',
    'description' => __( 'Widget-urile din aceasta zona vor aparea pe coloana 1 (sub submeniu).', 'theme-slug' ),
	'class'         => 'sidebar sidebar-1',
	'before_widget' => '',
	'after_widget'  => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );


/*==========  Enquire scripts  ==========*/

function enquire_scripts(){

    global $pagenow;

    // Widgets
    if ( 'widgets.php' === $pagenow ){
        wp_enqueue_script( 'widget-script', get_bloginfo( 'template_url' ) . '/inc/widget-editor-script.js', array( 'jquery' ), false, true );
    }

    // Jquery
     wp_enqueue_script( 'jquery' );

}

add_action( 'admin_init', 'enquire_scripts' );


/*==========  Add thumb capability  ==========*/
add_theme_support( 'post-thumbnails' );


/*==========  New Query vars  ==========*/

// add `author_more` to query vars
add_filter( 'init', 'add_date_query_var' );
function add_date_query_var(){
    global $wp;
    $wp->add_query_var( 'data' );    
}


/*==========  Excerpt length  ==========*/
function new_excerpt_length($length) {
    return 180;
}
add_filter('excerpt_length', 'new_excerpt_length');

?>