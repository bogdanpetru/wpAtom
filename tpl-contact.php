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

	<div class="row">
		
	<main id="main col-sm-8">
	</main>
	<!-- main -->

	<aside class="col-sm-4">
		<?php get_sidebar(); ?>
	</aside>

	</div>
	<!-- .row -->

<?php get_footer(); ?>
