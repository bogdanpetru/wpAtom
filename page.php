<?php 
/**
 * Template Name: Name of themplate
 * @name Simple Page Template
 * @package wpApp
 * @author: Bogdan Petru Pintican
 */
global $wpApp;
the_post();
?>

<?php get_header(); ?>

	<div class="container">
		<div class="row">
			
			<main id="main col-sm-8">
				<article class="<?php post_class() ?>">
					<?php the_content(); ?>
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
