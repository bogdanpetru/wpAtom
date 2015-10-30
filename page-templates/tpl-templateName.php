<?php 
/**
 * Template Name: Name of themplate
 * @name Simple Page Template
 * @package WordPress
 * @subpackage wpAtom
 * @author: Bogdan Petru Pintican
 */
global $wpAtom;
the_post();
?>

<?php get_header(); ?>

	<div class="container">
		<div class="row">
			
			<main id="main col-sm-8">
				<?php the_content(); ?>
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
