<?php
    /**
     * The template for displaying Category pages
     *
     * Used to display archive-type pages for posts in a category.
     *
     * @link http://codex.wordpress.org/Template_Hierarchy
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
                <h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'retouch' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
                <?php if ( category_description() ) : // Show an optional category description ?>
                <div class="archive-meta"><?php echo category_description(); ?></div>
                <?php endif; ?>
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
</header><!-- .archive-header -->
<div id="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <section id="primary" class="site-content">
                    <div id="content" role="main">
                        <?php if ( have_posts() ) : ?>

                        <?php
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();
                                /* Include the post format-specific template for the content. If you want to
                                 * this in a child theme then include a file called called content-___.php
                                 * (where ___ is the post format) and that will be used instead.
                                 */
                                get_template_part( 'content', get_post_format() );
                            endwhile;
                            retouch_content_nav( 'nav-below' );
                        ?>
                        <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                        <?php endif; ?>
                    </div><!-- #content -->
                </section><!-- #primary -->
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>