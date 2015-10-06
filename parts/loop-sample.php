<?php 

$args = array(
	'post_type'=>'total_proiecte',
	'posts_per_page'=>-1,
	'orderby'=>'menu_order',
	'order' => 'DESC',
	// 'meta_key' => 'metaname',
	// 'meta_value' => 1
);

$all_pages = new WP_Query($args);


if($all_pages->have_posts()):
	while ($all_pages->have_posts()): $all_pages->the_post(); 

	$img =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$bfi_args = array( 'width'=> 573, 'height'=>244 );
	$bfi_img = bfi_thumb( $img[0], $bfi_args );

	endwhile;
	wp_reset_query();

	if(function_exists(wp_pagenavi)){
		echo wp_pagenavi( array( 'query' => $wp_query ) );
	}
	 
endif;
?>
