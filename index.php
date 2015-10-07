<?php 
/**
 * @package wpApp
 * @author: Bogdan Petru Pintican
 */

global $wpApp;
$pageID = $wp_query->get_queried_object_id();

get_header();
?>
	<div class="container">
		<div class="row">
			
			<main id="main col-sm-8">

				<?php if( is_archive() ): ?>
					<h1 class="page-title"><?= $wp_query->query_vars['taxonomy_name']; ?></h1>
				<?php else: ?>
					<h1 class="page-title"><?= get_the_title($pageID); ?></h1>
				<?php endif; ?>

				<?php 
				if ( have_posts() ) :
				/* Start the Loop */ 
					get_template_part('content', 'archive');	
				else:
					get_template_part('content', '404');
				endif; 
			?>
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
