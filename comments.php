<?php 
/**
 * @package wpAtom
 * @author: Bogdan Petru Pintican
 */
if (post_password_required()) {
  return;
}
?>
<section id="comments" class="comments">
  <?php if (have_comments()) : ?>
    <h2>
    <?php 
        printf(
            _nx(
                'One response to &ldquo;%2$s&rdquo;', 
                '%1$s responses to &ldquo;%2$s&rdquo;', 
                get_comments_number(), 
                'comments title', 
                'wpAtom'
                ), 
                number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'
            ); 
    ?>
    </h2>

    <ol class="comment-list">
      <?php wp_list_comments(); ?>
    </ol>

    <?php endif; ?>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert">
      <?php _e('Comments are closed.', 'wpAtom'); ?>
    </div>
  <?php endif; ?>

  <?php comment_form(); ?>
</section>
<!-- .comments -->