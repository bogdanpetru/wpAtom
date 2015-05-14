<?php 
/**
 * Template name: Contactez-nous
 * @name Contact
 * @package wpApp
 * @author: Bogdan Petru Pintican
 */
get_header(); 
the_post();
global $wpApp;
?>
<main id="main" class="main">

	<section class="page-top">
		<div class="row">
			
			<div class="box-map col-sm-6">
				<div class="inner-wrapper">
					<div id="map-canvas" data-adress="<?= $wpApp['gmap-adress'] ?>"></div>
				</div>
			</div>
			<!-- .box-img.col-sm-6 -->
			
			<?php $secondary_img = get_field('top_page_secondary_image'); ?>
			<div class="box-text col-sm-6"
			<?php if( isset($secondary_img['sizes']['top-img']) ): ?>
			style="background-image: url(<?= $secondary_img['sizes']['top-img'] ?>)"
			<?php endif; ?>
			>
				<div class="inner-wrapper">
					<!-- Breadcrumbs -->
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
					} ?>
					<span class="box-title">
						Nos coordonnées
					</span>
					
					<div class="contact-info">
						<?php the_content(); ?>
					</div>

				</div>
			</div>
			<!-- .box-featured.col-sm-6 -->

		</div>
	</section>
	<!-- .page-top -->
	
	
	<article class="article contact-form">
		<h1 class="page-title">Laissez-nous un message</h1>
		<?= get_field('contact_form'); ?>
	</article>


	<div class="bottom-widget-area">
		<?php dynamic_sidebar( 'page-bottom' ); ?>
	</div>
	<!-- .bottom-widget-area -->
	
</main>
<?php get_footer(); ?>
