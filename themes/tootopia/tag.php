<?php
    /**
     * The template for displaying Tag pages
     *
     * Used to display archive-type pages for posts in a tag.
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
                <h1 class="archive-title"><?php printf( __( '热门话题: %s', 'retouch' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
                <?php if ( tag_description() ) : // Show an optional tag description ?>
                <div class="archive-meta"><?php echo tag_description(); ?></div>
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
    <section id="primary" class="site-content">
        <div id="content" role="main">
            <div class="container">
                <div id="content" role="main">
                    <div class="row">

                    <?php if ( have_posts() ) : ?>

                        <?php while ( have_posts() ) : the_post(); ?>
                            
                            <div class="col-xs-12 col-md-4 col-lg-3 article-wrap isotope-item" >
                            <?php get_template_part( 'template-parts/content', 'teaser' ); ?>
                            </div>

                        <?php endwhile; ?>

                        <?php retouch_content_nav( 'nav-below' ); ?>

                    <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>

                    </div>
                </div><!-- #content -->
            </div>
        </div>
    </section><!-- #primary -->
</div><!-- #main .wrapper -->
<?php get_footer(); ?>