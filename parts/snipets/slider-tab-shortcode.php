<?php

/**
 * Tab slider component
 */

$gallery_shortcode =  get_post_meta( get_the_id(), 'wpcf-galerie-produs' )[0];

preg_match("/ids=\"(.+)\"]/", $gallery_shortcode , $imgIds);
$has_galerie = false;

if ( $imgIds ){
	$has_galerie = true;
	$image_IDs = $imgIds[1];
	$imgIds = explode( ',', $imgIds[1] );
}

// Construct html text
$slider_items = '';
$slider_thumbs = '';

// Increment
$i = 0;

/**
 * Start loop
 */
foreach( $imgIds as $imgId ):

// Img
$img =  wp_get_attachment_image_src( $imgId, array(530, 670) );
$img = $img[0];

// Thumb
$thumb_size = array( 92, 115 );
$thumb = wp_get_attachment_image_src( $imgId, $thumb_size );
$thumb = $thumb[0];

$first_class = $i == 0 ? "active" : "";

/**
 * Build up slider items
 */
$slider_items .= <<<SLIDER_ITEMS
<div class='slider-item'> 
		<img src='$img'>
</div>
SLIDER_ITEMS;


$slider_thumbs .= <<<SLIDER_BUTTON
<div class='slider-button $first_class'>
	<div class='inner-wrapper'>
		<img src='$thumb'>
	</div>
</div>
<!-- .slide-button -->
SLIDER_BUTTON;

// Increment
$i++;
		
endforeach;

?>

<div class='home-slider'>
	
	<div class='slider-body'>
		<?= $slider_items ?>
	</div>
	<!-- .slider-body -->

	<div class='slider-nav'>
		<?= $slider_thumbs ?>
	</div>
	<!-- .slider-nav -->

</div>
<!-- .home-slider -->