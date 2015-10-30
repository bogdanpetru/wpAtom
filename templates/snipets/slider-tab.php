<?php

/**
 * Tab slider component
 */

$args = array(
	'post_type'=> array('post'),
	'posts_per_page'=>3,
	'orderby'=>'date',
	'order' => 'DESC',
	// Restrict by metabox
	'meta_key' => 'adrc_in_carusel',
	'meta_value' => 1
);

$all_pages = new WP_Query($args);

// Construct html text
$slider_items = '';
$slider_button = '';

// Increment
$i = 0;


/**
 * Start loop
 */
while ($all_pages->have_posts()): 
	$all_pages->the_post();



$img =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
$bfi_args = array( 'width'=> 573, 'height'=>244 );
$bfi_img = bfi_thumb( $img[0], $bfi_args );

$bfi_thumb_args = array( 'width'=> 170, 'height'=> 96 );
$bfi_thumb = bfi_thumb( $img[0], $bfi_thumb_args );

$title = get_the_title();
$title = strlen($title) > 73 ? substr($title, 0, 73 - 5) . '[...]' : $title;
$url = get_permalink();
$excerpt = get_the_excerpt();
$first_class = $i == 0 ? "active" : "";

/**
 * Build up slider items
 */
$slider_items .= <<<SLIDER_ITEMS
<div class='slider-item'> 
	<a href='$url'>
		<img src='$bfi_img'>
		<div class='text-box'>
			<span class='arrow'></span>
			$title			
		</div>
	</a>
 </div>
SLIDER_ITEMS;

/**
 * Different title length
 */
$title = strlen($title) < 105 ? $title : substr($title, 0, 105 - 5) . '[...]';

$slider_button .= <<<SLIDER_BUTTON
		<div class='slider-button $first_class col-sm-4'>
			<div class='inner-wrapper'>
				<a href='$url'>
					<div class='img-box'> 
						<span class="inner-wrapper2">
							<img src='$bfi_thumb'>
						</span> 
					</div>
					<div class='text-box'>
						$title
					</div>
				</a>
			</div>
			<!-- .inner-wrapper -->
		</div>
		<!-- .slide-button -->
SLIDER_BUTTON;

// Increment
$i++;

endwhile; 
wp_reset_postdata(); 

?>

<div class='home-slider'>
	
	<div class='slider-body'>
		<?= $slider_items ?>
	</div>
	<!-- .slider-body -->

	<div class='slider-nav row'>
		<?= $slider_button ?>
	</div>
	<!-- .slider-nav -->

</div>
<!-- .home-slider -->


