<?php
    /**
     * The default template for displaying content
     *
     * Used for both single and index/archive/search.
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-wrap">

        <div>
            <?php the_category(); ?>
        </div>

        <!-- title -->
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

        <!-- meta information -->
        <div class="entry-meta-single" >
            <span class="entry-meta-avator">
                <span>作者:</span>
                <!--<?php echo get_avatar( get_the_author_meta('user_email'), $size = '20'); ?>-->
                <?php $customise_author = get_post_meta($post->ID, "author_name", $single = true); ?>

                <?php if(strlen($customise_author) > 0): ?>
                <a href="../../../../author/<?php echo $customise_author;?>">
                    <?php echo $customise_author; ?>
                </a>
                <?php else:?>
                <a href="../../../../author/<?php the_author(); ?>">
                    <?php the_author(); ?>
                </a>
                <?php endif;?>
            </span>

            <span class="entry-meta-date" >
                <span class="entry-meta-date-label">日期：</span>
                <?php the_date(); ?>
            </span>
        </div>


        <?php if ( is_single() ) { ?>

        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'retouch' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'retouch' ), 'after' => '</div>' ) ); ?>
        </div>
        <?php } ?>
        <!-- .entry-content -->

        <?php if ( the_tags() ) { ?>
        <div class="tagcloud">
            <?php the_tags(); ?>
        </div>
        <?php } ?>

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
