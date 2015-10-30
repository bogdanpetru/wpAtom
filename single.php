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

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <article <?php post_class(); ?>>
        <header>
          <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
        <?php comments_template(); ?>
      </article>
    </div>
  </div>
</div>
<!-- .container -->

<?php get_footer(); ?>