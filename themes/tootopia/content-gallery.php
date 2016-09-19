<?php
    /**
     * The template for displaying posts in the Gallery Post Format on index and archive pages
     *
     * Learn more: http://codex.wordpress.org/Post_Formats
     *
     * @package WordPress
     * @subpackage Twenty_Eleven
     * @since Twenty Eleven 1.0
     */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-wrap">
        <?php $images = rwmb_meta( 'rt_post_image_upload', array ( 'type' => 'plupload_image', 'size' => 'landscape-medium' ) ); ?>
        <?php $total_images = count( $images ); ?>
        <?php if ( $images ) { ?>
        <div class="entry-thumb">
            <div id="carousel-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < $total_images; $i++) { ?>
                    <?php if ($i == 0) { ?>
                    <li data-target="#carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i ?>" class="active"></li>
                    <?php } else { ?>
                    <li data-target="#carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i ?>"></li>
                    <?php } ?>
                    <?php } ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php  $i = 0; ?>
                    <?php  foreach ( $images as $image ) { ?>
                    <?php if ($i == 0) { ?>
                    <div class="item active">
                        <?php echo "<img src='{$image['url']}' alt='{$image['alt']}' />"?>
                    </div>
                    <?php } else { ?>
                    <div class="item">
                        <?php echo "<img src='{$image['url']}' alt='{$image['alt']}' />"?>
                    </div>
                    <?php } ?>
                    <?php $i++; ?>
                    <?php } ?>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
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
        <?php if ( is_search() ) : // Only display Excerpts for search pages ?>
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