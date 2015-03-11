<?php 



function be_sample_metaboxes( $meta_boxes ) {
    $prefix = 'simpleTheme'; // Prefix for all fields

    $meta_boxes['on_home'] = array(
        'id' => 'on_home',
        'title' => 'Apare pe homepage',
        'pages' => array('post'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name'    => 'In Carusel',
                'id'      => $prefix . 'in_carusel',
                'type'    => 'radio_inline',
                'options' => array(
                    '0' => __( 'Nu', 'val1' ),
                    '1'   => __( 'Da', 'val1' ),
                ),
            ),
            array(
                'name'    => 'In Stiri si Evenimente',
                'id'      => $prefix . 'in_stiri',
                'type'    => 'radio_inline',
                'options' => array(
                    '0' => __( 'Nu', '0' ),
                    '1'   => __( 'Da', '1' ),
                ),
            ),
        ),
    );





    return $meta_boxes;
}

add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );


/*==========  Include metaboxes framework  ==========*/

// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( 'Custom-Metaboxes-and-Fields-for-WordPress/init.php' );
    }
}

?>