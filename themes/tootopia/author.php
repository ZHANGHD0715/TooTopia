<?php
    /**
     * The template for displaying Author Archive pages
     *
     * Used to display archive-type pages for posts by an author.
     *
     * @link http://codex.wordpress.org/Template_Hierarchy
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
    get_header();
?>
<?php
    $curauth = get_user_by('slug', $author_name);
    $isSlug = isset($curauth->display_name);
    $author_real_name = $isSlug ? $curauth->display_name : urldecode($author_name);
?>
<header class="archive-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="archive-title"><?php printf( __( '作者名称: %s', 'retouch' ), '<span class="vcard">' . $author_real_name. '</span>' ); ?></h1>
            </div>
            <!-- /.col-sm-6 -->
            <div class="col-xs-6 hidden-xs">
                <?php if ( function_exists( 'breadcrumb_trail' ) ) breadcrumb_trail( array( 'labels' => array( 'browse' => __( '当前位置:', 'retouch' ) ) ) ); ?>
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
                        <div class="row">  
                            <?php if ( $isSlug ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <div class="col-xs-12 col-md-6 col-lg-4 article-wrap isotope-item" >
                                    <?php get_template_part( 'template-parts/content', 'teaser' ); ?>
                                </div>
                            <?php endwhile; ?>
                            <?php retouch_content_nav( 'nav-below' ); ?>
                            <?php else : ?>
                            <?php 
                                $args = array(
                                    'meta_key' => 'author_name',
                                    'meta_value' => urldecode($author_name)
                                );
                                $rd_query = new WP_Query($args);
                                $rd_query->the_post();
                            ?>
                            <?php if($rd_query->have_posts()) : ?>                       
                            <?php while($rd_query->have_posts()) : $rd_query->the_post(); ?>
                                <div class="col-xs-12 col-md-6 col-lg-4 article-wrap isotope-item">
                                    <?php get_template_part( 'template-parts/content', 'teaser' ); ?>
                                </div>   
                            <?php endwhile; wp_reset_query();?>         
                            <?php else : ?>
                                <?php get_template_part( 'content', 'none' ); ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
