<?php 
global $post;


// Initate images wrapper
$images = array();


// If has featured image
if( has_post_thumbnail( $post->ID ) ):

	$img =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$bfi_args = array( 'height'=>355 );
	$bfi_img = bfi_thumb( $img[0], $bfi_args );

	$images[] = $bfi_img;

endif;


// Add Featured Images
$featured_images = false;
if( class_exists('Dynamic_Featured_Image') ) {
	global $dynamic_featured_image;
	global $post;

	$featured_images = $dynamic_featured_image->get_featured_images( $post->ID );
}

if ( ( bool ) $featured_images ):

	foreach( $featured_images as $img ){

		$bfi_args = array( 'height'=>355 );
		$bfi_img = bfi_thumb( $img['full'], $bfi_args );
		
		$images[] = $bfi_img;
	}

endif;


// if 1 img display if more activate slider
if( count($images) > 1 ){
	$images_html = '';

	foreach( $images as $img ){
		$images_html .= "<div class='slider-item'> <img src='$img'> </div>";			
	}

	echo "<div class='page-slider'> $images_html </div>";

} elseif ( count($images) ) {
	echo "<div class='featured-image'><img src='$images[0]'></div>";
}

?>

