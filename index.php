<?php 
/**
 * @package simpleTheme
 * @name Index Plage
 * 
 * 404, blog, archive
 */
$pageID = $wp_query->get_queried_object_id();
get_header();
?>



	<div class="row">
		
		<div class="featured-image col-xs-12">
			<!-- to be added -->
		</div>
		<!-- .featured-image -->

	<main id="main col-sm-8">

		<div class="article title">
			<?php if( is_archive() ): ?>
				<h1 class="page-title"><?php echo $wp_query->query_vars['taxonomy_name']; ?></h1>
			<?php else: ?>
				<h1 class="page-title"><?= get_the_title($pageID); ?></h1>
			<?php endif; ?>
		</div>

		<div class="article-body">
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); 
					$img =  wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
					$bfi_args = array( 'width'=> 120, 'height'=>90 );
					$bfi_img = bfi_thumb( $img[0], $bfi_args );
				?>
					<div class="loop-item">	
						<img src="<?= $bfi_img ?>">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a> <br><span class="date"><?php the_date('d M. Y') ?></span></h3>
						<?php the_excerpt(); ?>
					</div>
				<?php endwhile; 
					echo wp_pagenavi( array( 'query' => $wp_query ) );
				?>

			<?php else : ?>

				<h1>404 Pagina nu a fost găsită</h1>

			<?php endif; ?>
		</div>
		<!-- .article-body -->


	</main>
	<!-- main -->

	<aside class="col-sm-4">
		<?php get_sidebar(); ?>
	</aside>

	</div>
	<!-- .row -->

<?php get_footer(); ?>
