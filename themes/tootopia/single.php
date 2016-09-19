<?php
        /**
         * The Template for displaying all single posts
         *
         * @package WordPress
         * @subpackage ReTouch
         * @since ReTouch 1.0
         */
    
    get_header();
?>

<?php $show_breadcrumbs = rwmb_meta( 'rt_breadcrumbs_option' ); ?>
<?php $layout_option = rwmb_meta( 'rt_layout_option' ); ?>
<div id="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 <?php echo ( $layout_option == 'left-sidebar' ) ? 'pull-right' : 'pull-left'; ?>">
                <section id="primary" class="site-content">
                    <div id="content" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>

                        <?php $count_posts = wp_count_posts(); ?>
                        <?php $published_posts = $count_posts->publish; ?>
                        <?php if ( $published_posts > 1 ) { ?>
                        <nav class="nav-single">
                            <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
                            <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
                            <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
                        </nav>
                        <!-- .nav-single -->
                        <?php } ?>
                        <?php comments_template( '', true ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                    <!-- #content -->
                </section>
                <!-- #primary -->
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 <?php echo ( $layout_option == 'left-sidebar' ) ? 'pull-left' : 'pull-right'; ?>">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #main .wrapper -->
<?php get_footer(); ?>