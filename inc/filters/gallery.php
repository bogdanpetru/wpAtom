<?php 

/**
 *  Custom wordpress gallery
 */

// add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'full',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"gallery-wrapper row\">\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
 
        $img = wp_get_attachment_image_src($id, 'full');
        $bfi_args = array('width'=> 180, 'height'=>180);
        $bfi_img = bfi_thumb( $img[0], $bfi_args );

        $output .= "<div class='gallery-item col-lg-3 col-sm-4 col-xs-2'>";
        $output .= "<a href='$img[0]'><img src=\"{$bfi_img}\" /></a>";
        $output .= "</div>";
    }

    $output .= "</div>\n";

    return $output;
}

?>