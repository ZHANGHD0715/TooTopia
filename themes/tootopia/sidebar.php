<?php
    /**
     * The sidebar containing the main widget area
     *
     * If no active widgets are in the sidebar, hide it completely.
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>
<?php $sidebar_option = rwmb_meta( 'rt_sidebar_option' ); ?>
<?php if ( $sidebar_option ) { ?>
<?php $sidebar = $sidebar_option ?>
<?php } else { ?>
<?php $sidebar = 'sidebar-1' ?>
<?php } ?>
<?php if ( is_active_sidebar( $sidebar ) ) : ?>
<div id="secondary" class="widget-area" role="complementary">

    <!-- 侧边栏 专栏 -->
    <aside class="widget widget_recent_entries" >
        
        <h3 class="widget-title">土逗专栏</h3>
        <?php query_posts('showposts=5&category_name="tu-dou-zhuan-lan"'); ?>
        
        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="row">
                        <div class="col-xs-4 widget-entry-thumb-wrapper">
                            <!-- thumbnail -->
                            <?php if ( !is_single() && has_post_thumbnail() ) { ?>
                            <div class="post-thumb widget-entry-thumb">
                                <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
                                <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
                            </div>
                            <?php } ?>
                        </div>
                        
                        <div class="col-xs-8 widget-entry-summary-wrapper">
                            <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                            <div class="widget-post-date" >
                                <span class="text-date">
                                    <?php the_date() ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </aside>

    <!-- 侧边栏 土豆摊 -->
    <aside class="widget widget_recent_entries" >
        
        <h3 class="widget-title">土逗摊</h3>
        <?php query_posts('showposts=1&category_name="tu-dou-tan"'); ?>
        
        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="row">
                        <div class="col-xs-6 widget-entry-thumb-wrapper">
                            <!-- thumbnail -->
                            <?php if ( !is_single() && has_post_thumbnail() ) { ?>
                            <div class="widget-entry-thumb">
                                <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
                                <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
                            </div>
                            <?php } ?>
                        </div>
                        
                        <div class="col-xs-6 widget-entry-summary-wrapper">
                            <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
                            <div class="widget-post-date" >
                                <span class="text-date">
                                    <?php the_date() ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

    </aside>

    <!-- 侧边栏 活动 -->
    <aside class="widget widget-full-wrapper" >
        
        <!-- <h3 class="widget-title">活动</h3> -->
        <?php query_posts('showposts=1&category_name="tu-dou-huo-dong"'); ?>
        
        <?php while (have_posts()) : the_post(); ?>
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="widget-event widget-full-thumb">
            <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
            <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
        </div>
        <?php } ?>
        <?php endwhile; ?>

    </aside>

    <?php dynamic_sidebar( $sidebar ); ?>

    <aside class="widget">
        <div class="row">
            <span class="share-title">关注我们</span>
            <div class="share-icon-list">
                <span class="share-icon-wechat"></span>
                <span class="share-icon-weibo"></span>
                <span class="share-icon-douban"></span>
                <span class="share-icon-facebook"></span>
            </div>
        </div>
    </aside>
</div><!-- #secondary -->
<?php endif; ?>