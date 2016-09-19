<?php
    /**
     * The template for displaying Author Archive pages
     *
     * Used to display archive-type pages for posts by an author.
     *
     * @link http://codex.wordpress.org/Template_Hierarchy
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
    get_header();
?>
<?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<header class="archive-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'retouch' ), '<span class="vcard">' . $curauth->display_name . '</span>' ); ?></h1>
            </div>
            <!-- /.col-sm-6 -->
            <div class="col-xs-6 hidden-xs">
                <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail( array( 'labels' => array( 'browse' => __( 'You are here:', 'retouch' ) ) ) ); ?>
            </div>
            <!-- /.col-xs-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>
<!-- .archive-header -->
<div id="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="primary" class="site-content">
                    <div id="content" role="main">

                        <?php if ( have_posts() ) : ?>
                        <?php
                            /* Queue the first post, that way we know
                             * what author we're dealing with (if that is the case).
                             *
                             * We reset this later so we can run the loop
                             * properly with a call to rewind_posts().
                             */
                            the_post();
                        ?>
                        <?php
                            /* Since we called the_post() above, we need to
                             * rewind the loop back to the beginning that way
                             * we can run the loop properly, in full.
                             */
                            rewind_posts();
                        ?>
                        <?php
                            // If a user has filled out their description, show a bio on their entries.
                            if ( get_the_author_meta( 'description' ) ) :
                        ?>
                        <div class="author-wrap">
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
                                    <h2><?php printf( __( 'About %s', 'retouch' ), get_the_author() ); ?></h2>
                                    <p><?php the_author_meta( 'description' ); ?></p>
                                    <!-- .author-link	-->
                                </div>
                                <!-- .author-description -->
                            </div>
                            <!-- .author-info -->
                        </div>
                        <?php endif; ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
                        <?php retouch_content_nav( 'nav-below' ); ?>
                        <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                        <?php endif; ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
