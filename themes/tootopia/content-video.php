<?php
    /**
     * The template for displaying posts in the Video post format
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-wrap">
        <?php $post_video_url = rwmb_meta( 'rt_post_video_url' ); ?>
        <?php $post_video_poster = rwmb_meta( 'rt_post_video_poster' ); ?>
        <?php $post_video_embeded_code = rwmb_meta( 'rt_post_video_embeded_code' ); ?>


        <?php if ( !empty($post_video_url) ) { ?>
        <div class="entry-thumb">
            <?php echo do_shortcode('[video src="' . $post_video_url . '" poster="' . $post_video_poster . '"]'); ?>
        </div>
        <?php } else { ?>
        <?php  if ( !empty($post_video_embeded_code) ) { ?>
        <div class="entry-thumb">
            <?php echo $post_video_embeded_code; ?>
        </div>
        <?php } ?>
        <?php } ?>

        <header class="entry-header">
            <?php if ( is_single() ) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else : ?>
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h1>
            <?php endif; // is_single() ?>
        </header>
        <!-- .entry-header -->
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
            <span class="post-format">
                <i class="fa fa-play"></i> <a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>"><?php echo get_post_format_string( 'video' ); ?></a>
            </span>
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