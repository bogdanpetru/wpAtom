<?php
global $wp_query;

while ( have_posts() ) : the_post(); 
	get_template_part('parts/loop', 'item'); 
endwhile;
echo wp_pagenavi( array( 'query' => $wp_query ) );