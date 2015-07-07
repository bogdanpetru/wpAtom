<?php 
/**
 * @name Search
 * @package wpApp
 * @author: Bogdan Petru Pintican
 */
global $wpApp;
the_post();
?>

<?php get_header(); ?>

	<div class="row">
		
	<main id="main col-sm-8">

		<div class="article-header">		
			<!-- Breadcrumbs -->
			<?php 
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb('<p id="breadcrumbs">','</p>');
				} 
			?>
			
			<h1 class="article-title"><?php printf( __( 'Rezultatul Cautarilor pentru: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

			<div class="search-wrapper">
				<?php get_search_form(); ?>
			</div>
		</div>			
		<!-- .article-header -->

		<div class="search-loop">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part("parts/list", "item"); ?>
				<?php endwhile; ?>					
			<?php else: ?>
				<h2><?php echo __('Nu a fost gasit nimic.', 'wpApp') ?></h2>
			<?php endif; ?>
		</div>
		<!-- .artocle-body -->
	
	</main>
	<!-- main -->

	<aside class="col-sm-4">
		<?php get_sidebar(); ?>
	</aside>

	</div>
	<!-- .row -->

<?php get_footer(); ?>
