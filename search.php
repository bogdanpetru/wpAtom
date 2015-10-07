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
<div class="container">	
	<div class="row">
		
		<main id="main col-sm-8">
			<div class="article__header">		
				<!-- Breadcrumbs -->
				<?php 
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
					} 
				?>
				<h1 class="article__title"><?php printf( __( 'Searched term: %s', '_s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

				<div class="search-wrapper">
					<?php get_search_form(); ?>
				</div>
			</div>			
			<!-- .article-header -->
			<div class="list__loop">
				<?php 
					if ( have_posts() ):
						while ( have_posts() ) : the_post();
							get_template_part("parts/article", "list");
						endwhile;
					else: 
					?>
					<h2><?php echo __('Nothing Found.', 'wpApp') ?></h2>
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
</div>
<!-- .container -->

<?php get_footer(); ?>
