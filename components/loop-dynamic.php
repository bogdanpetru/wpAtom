<?php 

$year = isset($wp_query->query_vars['an']) ? $wp_query->query_vars['an'] : false;
$luna = isset($wp_query->query_vars['luna']) ? $wp_query->query_vars['luna'] : false;
$category_name = isset($wp_query->query['category_name']) ? $wp_query->query['category_name'] : false;


$args = array(
	'post_type'=> array('post'),
);

// Add month restriction
if( $year && $luna  ){;
	$args['date_query'] = array(
		array(
			'year'  => $year,
			'month' => $luna,
		),
	);
}


// Add category
if( (bool) $category_name ){
	$args['category_name'] = $category_name;
}

// Paged option
$paged2 = $_SERVER['REQUEST_URI'];
preg_match('/page\/(\d)\//', $paged2, $page_no);

if($page_no){
	$page_no = (int) $page_no[1];
	$args['paged'] = $page_no;
}


$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ):
	while ( $the_query->have_posts() ):
		$the_query->the_post();
		get_template_part("parts/list", "item");
	endwhile;
endif;
/* Restore original Post Data */


// Pagination
echo wp_pagenavi( array( 'query' => $the_query ) );

wp_reset_postdata();
?>



