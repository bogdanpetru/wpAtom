<?php 
/**
 * @name Simple Page Template
 * @package wpApp
 * @author: Bogdan Petru Pintican
 */
get_header();
?>
	<div class="row">
		
		<!-- Home sidebar 1 -->
		<?php get_sidebar('page-col-1') ?>

		<main class="column-2 col-md-8 col-sm-9">

			<article class="article">

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

				<div class="article-body">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part("parts/list", "item"); ?>
						<?php endwhile; ?>					
					<?php else: ?>
						<h2>Nu a fost gasit nimic.</h2>
					<?php endif; ?>
				</div>
				<!-- .artocle-body -->
				
			</article>	

		</main>

		<?php get_sidebar() ?>

	</div>
	<!-- .row -->

<?php get_footer(); ?>
