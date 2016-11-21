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
                <?php 
                    $query_string = get_search_query();
                    $pattern = '/^author_name\/(.*)/';
                    $template = "";
                    $is_regular_search = true;
                    preg_match($pattern, $query_string, $matches);
                    if(count($matches) == 2) {
                        $query_string = $matches[1];
                        $template = "对作者: %s 的搜索结果";
                        $args = array(
                                    'meta_key' => 'author_name',
                                    'meta_value' => urldecode($query_string)
                                );
                        $is_regular_search = false;
                        $rd_query = new WP_Query($args);
                        $rd_query->the_post();
                    }
                    else {
                        $template = "%s 的搜索结果";
                    }
                ?> 
                <h1 class="archive-title"><?php printf( __( $template , 'retouch' ), '<span>' . $query_string . '</span>' ); ?></h1>
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
                <?php if ($is_regular_search) : ?>
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
                <?php else : ?>
                    <?php if($rd_query->have_posts()) : ?>                       
                            <?php while($rd_query->have_posts()) : $rd_query->the_post(); ?>
                                <div class="col-xs-12 col-md-4 col-lg-3 article-wrap isotope-item">
                                <?php get_template_part( 'template-parts/content', 'teaser' ); ?>
                                </div>   
                            <?php endwhile; wp_reset_query();?>         
                    <?php else : ?>
                        <article id="post-0" class="post no-results not-found">
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h3><?php _e( '没有结果', 'retouch' ); ?></h3>
                                </header>
                                <div class="entry-content">
                                    <p><?php _e( '抱歉，没有找到任何与该作者相关的信息。', 'retouch' ); ?></p>
                                </div><!-- .entry-content -->
                            </div><!-- .entry-content -->
                        </article><!-- #post-0 -->
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>
