<?php 

/*========== Register Enquire scripts and styles  ==========*/
function wpApp_register_scripts_and_styles() {
    $theme_uri = get_template_directory_uri();

    // Register
    //!wp_register_script( $handle, $src, $deps, $ver, $in_footer );
    wp_register_script('googleMaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array(), 3);
    wp_register_script('wpAppJs', $theme_uri . '/dist/bundle.js', array(), 3);
    // google fonts
    $google_fonts = array(
      'open-sans' => 'http://fonts.googleapis.com/css?family=Roboto:600,400,300,300italic,700,700italic,900'
    );
    foreach( $google_fonts as $name => $src ){
        wp_register_script($name, $src);
    }
    // icon fonts
    wp_register_script('fontAwesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

    //!wp_register_style( $handle, $src, $deps, $ver, $media );
    wp_register_style('bootstrap', $theme_uri . '/dist/css/bootstrap.css');
    wp_register_style('wpAppCss', $theme_uri . '/dist/css/main.css');
    wp_register_style('wpAppIe8', $theme_uri . '/dist/css/ie8.css');

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
        wp_enqueue_script( 'widget-script', get_bloginfo( 'template_url' ) . '/dist/js/widget-scripts.js', array( 'jquery' ), false, true );
    }
}
add_action( 'admin_init', 'wpApp_enquire_admin_scripts_and_styles' );