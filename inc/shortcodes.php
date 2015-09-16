<?php 	

/*==================================
=            Shortcodes            =
==================================*/

// [bartag foo="foo-value"]

function row( $atts, $content ) {

    $cols = do_shortcode( $content );
    // $cols = str_replace('<p>', '', $cols);
    // $cols = str_replace('</p>', '', $cols);
    $cols = str_replace("<div class='col-sm-6'>", "<div class='doc-list col-sm-6'>", $cols);
    return "<div class='row'>$cols</div>";

}



add_shortcode( 'row', 'row' );



// [bartag foo="foo-value"]

function col( $atts, $content ) {
    return "<div class='col-sm-6'>$content</div>";
}

add_shortcode( 'col', 'col' );

?>