<?php 
	$img =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$bfi_args = array( 'width'=> 200, 'height'=>133 );
	$bfi_img = bfi_thumb( $img[0], $bfi_args );
	$date = get_the_date('d M. Y');

	$has_image = has_post_thumbnail( $post->ID );
?>


<div class="list-item <?= $has_image ? 'has-image' : '' ?>">
	<div class="row">
		<?php if( $has_image ): ?>
		<div class="col-sm-3 img-box">
			<img src="<?= $bfi_img ?>">
		</div>
		<?php endif; ?>
		<!-- .img-box -->
		<div class="text-box <?= $has_image ? 'col-sm-9' : 'col-sm-12' ?>">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p>
				<span class="date"><?= $date ?> -</span> 
				<?= substr(strip_tags(get_the_excerpt()), 0, 213); ?>
			</p>
			<p class="more">
				<a href="<?php the_permalink(); ?>" class="button">Detalii</a>
			</p>
		</div>
		<!-- .text-box -->
	</div>
	<!-- .row -->
</div>
<!-- .article-item -->