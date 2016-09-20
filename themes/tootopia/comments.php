<?php
    /**
     * The template for displaying Comments
     *
     * The area of the page that contains both current comments
     * and the comment form. The actual display of comments is
     * handled by a callback to retouch_comment() which is
     * located in the functions.php file.
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>
<div id="comments" class="comments-area padding-panel">
    <?php // You can start editing here -- including this comment! ?>
    <?php if ( have_comments() ) : ?>
    
    <ol class="commentlist">
        <?php wp_list_comments( array( 'callback' => 'retouch_comment', 'style' => 'ol' ) ); ?>
    </ol><!-- .commentlist -->
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-below" class="navigation" role="navigation">
        <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'retouch' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'retouch' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'retouch' ) ); ?></div>
    </nav>
    <?php endif; // check for comment navigation ?>
    <?php
        /* If there are no comments and comments are closed, let's leave a note.
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if ( ! comments_open() && get_comments_number() ) :
    ?>
    <div class="nocomments-wrap">
        <p class="nocomments"><?php _e( 'Comments are closed!' , 'retouch' ); ?></p>
    </div>
    <?php endif; ?>
    <?php endif; // have_comments() ?>

    <?php
        
        $args = array(
           'comment_field' =>  '<p class="comment-form-comment">' .
            '<textarea id="comment" class="form-control" placeholder="' . __( 'Your Comment (required)', 'domainreference' ) . '" name="comment" cols="45" rows="5" aria-required="true">' .
            '</textarea></p>',
        
          'fields' => apply_filters( 'comment_form_default_fields', array(
        
            'author' =>
              '<div class="row"><div class="col-md-4"><p class="comment-form-author">' .
              '<input id="author" class="form-control" placeholder="' . __( 'Name (required)', 'domainreference' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
              '" size="30"' . $aria_req . ' /></p></div>',
        
            'email' =>
              '<div class="col-md-4"><p class="comment-form-email">' .
              '<input id="email" class="form-control" placeholder="' . __( 'Email (required)', 'domainreference' ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
              '" size="30"' . $aria_req . ' /></p></div>',
        
            'url' =>
              '<div class="col-md-4"><p class="comment-form-url">' .
              '<input id="url" class="form-control" placeholder="' . __( 'Website (Optional)', 'domainreference' ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
              '" size="30" /></p></div></div>'
            )
          ),
        );
    ?>

    <?php comment_form($args); ?>
</div><!-- #comments .comments-area -->