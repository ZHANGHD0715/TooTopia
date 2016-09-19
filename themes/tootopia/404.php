<?php
    /**
     * The template for displaying 404 pages (Not Found)
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
                <h1 class="archive-title">404 Not Found</h1>
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
            <div class="col-md-6">
                <div id="primary" class="site-content">
                    <div id="content" role="main">
                        <section class="section">
                            <div class="rt-error404">
                                <h1>404</h1>
                            </div>
                        </section>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-6">
                <section class="section">
                    <div class="details404">
                        <h3><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'retouch' ); ?></h3>
                        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'retouch' ); ?></p>
                        <?php get_search_form(); ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-flat btn-rounded flat-color"><i class="fa fa-long-arrow-left"></i> Back to Home</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>