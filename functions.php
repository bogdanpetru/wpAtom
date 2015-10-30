<?php

$dh = opendir(dirname(__FILE__).'/inc');

while (false !== ($file = readdir($dh))) {
	if ($file != '.' && $file != '..' && preg_match('/.+\.php$/',$file)) {
		require_once dirname(__FILE__).'/inc/'.$file;
	}
}



/**
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest,  * or null if none.
 */
function my_awesome_func( $data ) {
    $posts = get_posts( array(
        'author' => $data['id'],
    ) );

    if ( empty( $posts ) ) {
       return new WP_Error( 'awesome_no_author', 'Invalid author', array( 'status' => 404 ) );
    }

    return $posts[0]->post_title;
}


// register route
add_action( 'rest_api_init', function () {
  // register_rest_route ( $namespace, $route, $args = array(), $override = false ) 

  register_rest_route( 'myplugin/v1', '/author/', array(
      'methods' => 'GET',
      'callback' => 'my_awesome_func',
      'args'    => array(
          'id' => array(
              'validate_callback' => 'is_numeric'
            )
        )
  ) );
});