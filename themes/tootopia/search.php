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
            <div class="col-sm-12">
                <h1 class="archive-title"><?php printf( __( '%s 的搜索结果：', 'retouch' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>
<!-- .archive-header -->
<div id="main" class="wrapper">
    <div class="container">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                
                <?php if ( have_posts() ) : ?>
                <?php retouch_content_nav( 'nav-above' ); ?>
                
                <div class="row">
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                    <div class="col-xs-12 col-md-4 col-lg-3 article-wrap isotope-item" >
                    <?php get_template_part( 'template-parts/content', 'teaser' ); ?>
                    </div>

                    <?php endwhile; ?>
                    <?php retouch_content_nav( 'nav-below' ); ?>
                </div>                        

                <?php else : ?>

                <article id="post-0" class="post no-results not-found">
                    <div class="entry-wrap">
                        <header class="entry-header">
                            <h3><?php _e( '没有结果', 'retouch' ); ?></h3>
                        </header>
                        <div class="entry-content">
                            <p><?php _e( '抱歉，没有找到任何与搜索关键字相关的信息。', 'retouch' ); ?></p>
                        </div><!-- .entry-content -->
                    </div><!-- .entry-content -->
                </article><!-- #post-0 -->

                <?php endif; ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>
