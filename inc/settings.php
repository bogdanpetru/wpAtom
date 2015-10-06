<?php

/*=================================
=            Seetings             =
=================================*/

// Hide admin bar
add_filter('show_admin_bar', '__return_false');

/*==========  Register Menus  ==========*/
register_nav_menus( array(
    'primary' => __( 'Primary Menu',      'wpApp' ),
    'social'  => __( 'Social Links Menu', 'wpApp' ),
) );


/*==========  Register Sidebars  ==========*/
register_sidebar( array(
    'name' => __( 'Sidebar', 'wpApp' ),
    'id' => 'sidebar',
    'description' => __( 'Gemeroc Sodebar.', 'wpApp' ),
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
    add_editor_style('assets/css/editor-style.css');
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );


/*==========  Remove POST from dashboard  ==========*/
function remove_menus(){
  remove_menu_page( 'edit.php' );                   //Posts  
}
// add_action( 'admin_menu', 'remove_menus' );


/*========== Register Enquire scripts and styles  ==========*/
function wpApp_register_scripts_and_styles() {
    $theme_uri = get_template_directory_uri();

    // Register
    //!wp_register_script( $handle, $src, $deps, $ver, $in_footer );
    wp_register_script('googleMaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array(), 3);
    wp_register_script('wpAppJs', $theme_uri . '/assets/js/main.js', array(), 3);
    // google fonts
    $google_fonts = array(
            'open-sans': 'http://fonts.googleapis.com/css?family=Roboto:600,400,300,300italic,700,700italic,900'
    );
    foreach( $google_fonts as $name => $src ){
        wp_register_script($name, $src);
    }
    // icon fonts
    wp_register_script('fontAwesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

    //!wp_register_style( $handle, $src, $deps, $ver, $media );
    wp_register_style('bootstrap', $theme_uri . '/assets/css/bootstrap.css');
    wp_register_style('wpAppCss', $theme_uri . '/assets/css/app.css');
    wp_register_style('wpAppIe8', $theme_uri . '/assets/css/ie8.css');

}
add_action( 'wp_enqueue_scripts', 'wpApp_register_scripts_and_styles' );

function wpApp_enquire_scripts_and_styles() {
    // wp_enqueue_style( $handle, $src, $deps, $ver, $media );

    // scripts
    wp_enqueue_script( 'wpAppJs', false, array('google-maps') );
    wp_enqueue_script( 'jquery' );
    // wp_enqueue_script( 'jquery-ui-widget' );
    // wp_enqueue_script( 'jquery-ui-slider' );
    // wp_enqueue_script( 'jquery-ui-selectmenu' );

    // styles
    wp_enqueue_style( 'wpAppCss', false, array(), 0.1 );
    wp_style_add_data( 'wpAppIe', 'conditional', 'lt IE 9' );
    wp_enqueue_style( 'wpAppIe', false, array( 'wpApp-css' ) );
    
}
add_action( 'wp_enqueue_scripts', 'wpApp_enquire_scripts_and_styles' );

function wpApp_enquire_admin_scripts_and_styles(){
    global $pagenow;

    // Widgets
    if ( 'widgets.php' === $pagenow ){
        wp_enqueue_script( 'widget-script', get_bloginfo( 'template_url' ) . '/assets/js/widget-scripts.js', array( 'jquery' ), false, true );
    }
}
add_action( 'admin_init', 'wpApp_enquire_admin_scripts_and_styles' );


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