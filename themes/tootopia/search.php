<?php
    /**
     * The template for displaying Search Results pages
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
    get_header();
?>
<header class="archive-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'retouch' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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

                        <?php retouch_content_nav( 'nav-above' ); ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
                        <?php retouch_content_nav( 'nav-below' ); ?>
                        <?php else : ?>
                        <article id="post-0" class="post no-results not-found">
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h3><?php _e( 'Nothing Found', 'retouch' ); ?></h3>
                                </header>
                                <div class="entry-content">
                                    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'retouch' ); ?></p>
                                    <?php get_search_form(); ?>
                                </div><!-- .entry-content -->
                            </div><!-- .entry-content -->
                        </article><!-- #post-0 -->
                        <?php endif; ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>
