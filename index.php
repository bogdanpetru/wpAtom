<?php 
/**
 * @package wpAtom
 * @author: Bogdan Petru Pintican
 */
global $wpAtom;

get_header();
?>
	<div class="container">
		<div class="row"> 
			
			<main id="main" role="main" class="content col-sm-8">

				<?php if( have_posts() ): ?>
					<h1 class="page-title"><?php the_title(); ?></h1>
				<?php
					
					while( have_posts() ):
						get_template_part('content/', get_post_format() );
					endwhile;	

				else: 
					get_template_part('content/404');
				?>

			</main>
			<!-- main -->

			<aside role="aside" class="aside col-sm-4">
				<?php get_sidebar(); ?>
			</aside>

		</div>
		<!-- .row -->
	</div>
	<!-- .container -->

<?php get_footer(); ?>
