<?php
$comments_count = get_comments_number();
?>

<div class="col-12 col-md-6 col-lg-7">
  <div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
      <?php if ( '1' === $comments_count ) : ?>
        <?php esc_html_e( '1 Comentario', 'comercioseguro' ); ?>
      <?php else : ?>
        <?php
        printf(
          /* translators: %s: Comment count number. */
          esc_html( _nx( '%s comment', '%s comments', $comments_count, 'Comments title', 'comercioseguro' ) ),
          esc_html( number_format_i18n( $comments_count ) )
        );
        ?>
      <?php endif; ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments(
        array(
          'avatar_size' => 60,
          'style'       => 'ol',
          'short_ping'  => true,
          'max_depth' => 1,
        )
      );
      ?>
    </ol><!-- .comment-list -->

      <?php
      the_comments_pagination(
        array(
          'before_page_number' => esc_html__( 'Page', 'comercioseguro' ) . ' ',
          'mid_size'           => 0,
          'prev_text'          => '<span class="nav-prev-text">%s</span>',
          'next_text'          => '<span class="nav-next-text">%s</span> %s',
        )
      );
      ?><!-- .comment-navigation -->

      <?php if ( ! comments_open() ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'comercioseguro' ); ?></p>
      <?php endif; ?>

    <?php else: // have_comments() ?>
    <h2>Se el primero en dejar un comentario</h2>
    <?php endif; // have_comments() ?>

  </div><!-- #comments -->
</div>
<div class="col-12 col-md-6 col-lg-5 mt-5 mt-md-0">
  <?php
    comment_form(
      array(
        'title_reply'        => esc_html__( 'Dejanos un comentario', 'comercioseguro' ),
        'title_reply_before' => '<h2 id="reply-title" class="cs-comments-form__title">',
        'title_reply_after'  => '</h2>',
      )
    );
  ?>
</div>