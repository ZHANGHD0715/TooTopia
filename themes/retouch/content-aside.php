<?php
    /**
     * The template for displaying posts in the Aside post format
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-wrap">
        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
        <!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'retouch' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'retouch' ), 'after' => '</div>' ) ); ?>
        </div>
        <!-- .entry-content -->
        <?php endif; ?>
        <footer class="entry-meta">
            <?php retouch_entry_meta(); ?>
        </footer>
        <!-- .entry-meta -->
    </div>
    <!-- .entry-wrap -->
    <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
    <div class="author-wrap">
        <div class="subpage-title">
            <h5>About The Author</h5>
        </div>
        <div class="author-info">
            <div class="author-avatar">
                <?php
                    /** This filter is documented in author.php */
                    $author_bio_avatar_size = apply_filters( 'retouch_author_bio_avatar_size', 68 );
                    echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
                ?>
            </div>
            <!-- .author-avatar -->
            <div class="author-description">
                <h2><?php printf( __( '%s', 'retouch' ), get_the_author() ); ?></h2>
                <p><?php the_author_meta( 'description' ); ?></p>
                <div class="author-link">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'retouch' ), get_the_author() ); ?>
                    </a>
                </div>
                <!-- .author-link	-->
            </div>
            <!-- .author-description -->
        </div>
        <!-- .author-info -->
    </div>
    <?php endif; ?>
</article><!-- #post -->
