<?php
    /**
     * The template for displaying all pages
     *
     * This is the template that displays all pages by default.
     * Please note that this is the WordPress construct of pages
     * and that other 'pages' on your WordPress site will use a
     * different template.
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
    get_header();
?>

<?php $show_breadcrumbs = rwmb_meta( 'rt_breadcrumbs_option' ); ?>
<?php $layout_option = rwmb_meta( 'rt_layout_option' ); ?>
<?php if ( !$show_breadcrumbs ) { ?>
<header class="archive-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="archive-title"><?php echo get_the_title(); ?></h1>
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
<?php } ?>
<div id="main" class="wrapper">
    <?php if( $layout_option ) { ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 <?php echo ( $layout_option == 'left-sidebar' ) ? 'pull-right' : 'pull-left'; ?>">
                <?php } ?>
                <div id="primary" class="site-content">
                    <div id="content" role="main">

                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                        <?php endwhile; // end of the loop. ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
                <?php if( $layout_option ) { ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 <?php echo ( $layout_option == 'left-sidebar' ) ? 'pull-left' : 'pull-right'; ?>">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>