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
            <!-- <?php echo ( $layout_option == 'left-sidebar' ) ? 'pull-right' : 'pull-left'; ?> -->
            <div class="col-sm-12 col-md-8">
                <section id="primary" class="site-content">
                    <div id="content" role="main">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>

                        <?php $count_posts = wp_count_posts(); ?>
                        <?php $published_posts = $count_posts->publish; ?>
                        <nav class="nav-single"></nav>
                        <?php if ( $published_posts > 1 ) { ?>
                            <div id="related-post" class="row clearfix">
                                <?php wp_related_posts()?> 
                            </div>
                        <?php } ?>
                        <?php comments_template( '', true ); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div>
                    <!-- #content -->
                </section>
                <!-- #primary -->
            </div>
            <!--  <?php echo ( $layout_option == 'left-sidebar' ) ? 'pull-left' : 'pull-right'; ?> -->
            <div class="col-sm-12 col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #main .wrapper -->
<?php get_footer(); ?>