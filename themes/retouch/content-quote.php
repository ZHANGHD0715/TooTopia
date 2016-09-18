<?php
    /**
     * The template for displaying posts in the Quote post format
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-wrap">
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'retouch' ) ); ?>
        </div><!-- .entry-content -->
        <footer class="entry-meta">
            <span class="post-format">
                <i class="fa fa-quote-right"></i> <a href="<?php echo esc_url( get_post_format_link( 'quote' ) ); ?>"><?php echo get_post_format_string( 'quote' ); ?></a>
            </span>
            <?php retouch_entry_meta(); ?>
        </footer><!-- .entry-meta -->
    </div><!-- .entry-wrap -->
</article><!-- #post -->
