<?php
    /**
     * The template for displaying Archive pages
     *
     * Used to display archive-type pages if nothing more specific matches a query.
     * For example, puts together date-based pages if no date.php file exists.
     *
     * If you'd like to further customize these archive views, you may create a
     * new template file for each specific one. For example, ReTouch already
     * has tag.php for Tag archives, category.php for Category archives, and
     * author.php for Author archives.
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
                <h1 class="archive-title">Portfolio Archives</h1>
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
        <section id="primary" class="site-content">
            <div id="content" role="main">

                <?php if ( have_posts() ) : ?>

                <div class="row">
                    <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
                        
                            /* Include the post format-specific template for the content. If you want to
                             * this in a child theme then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                        
                    ?>


                    <div class="col-xs-12 col-sm-6 col-md-4 portfolio-item-wrapper">
                        <div class="portfolio-item">
                            <div class="portfolio-thumb">
                                <?php $images = rwmb_meta( 'rt_image_upload', array ( 'type' => 'plupload_image', 'size' => 'portfolio' ) ); ?>
                                <?php $portfolio_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portfolio' ); ?>
                                <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

                                <?php if ($images) { ?>
                                <?php $i = 0; ?>
                                <?php  foreach ( $images as $image ) { ?>
                                <?php if ($i == 0) { ?>
                                <img src="<?php echo $image['url']; ?>" class="img-responsive" alt="<?php echo $image['alt']; ?>">
                                <div class="image-overlay"></div>
                                <a href="<?php echo $image['full_url']; ?>" rel="prettyPhoto[pp_gal]" class="portfolio-zoom"><i class="fa fa-eye"></i></a>
                                <?php } ?>
                                <?php $i++; ?>
                                <?php   }?>
                                <?php } else { ?>
                                <img src="<?php echo $portfolio_thumbnail_src[0]; ?>" class="img-responsive" alt="1st Portfolio Thumb">
                                <div class="image-overlay"></div>
                                <a href="<?php echo $thumbnail_src[0]; ?>" rel="prettyPhoto[pp_gal]" class="portfolio-zoom"><i class="fa fa-eye"></i></a>
                                <?php } ?>

                                <a href="<?php the_permalink(); ?>" class="portfolio-link"><i class="fa fa-link"></i></a>
                            </div>
                            <div class="portfolio-details">
                                <h5><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.portfolio-item-wrapper -->
                    <?php endwhile; ?>
                </div>
                <?php retouch_content_nav( 'nav-below' ); ?>

                <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>
            </div>
            <!-- #content -->
        </section>
        <!-- #primary -->
    </div>
</div>
<!-- #main .wrapper -->
<?php get_footer(); ?>