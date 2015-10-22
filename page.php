<?php 
/**
 * Template Name: Name of themplate
 * @name Simple Page Template
 * @package wpAtom
 * @author: Bogdan Petru Pintican
 */
global $wpAtom;
the_post(); 
?>
<?php get_header(); ?>

	<div class="container">
		<div class="row">
			
			<main id="main col-sm-8">
				<article class="<?php post_class() ?>">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<!-- .entry-content -->
				</article>
			</main>
			<!-- main -->

			<aside class="col-sm-4">
				<?php get_sidebar(); ?>
			</aside>

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

<?php get_footer(); ?>
