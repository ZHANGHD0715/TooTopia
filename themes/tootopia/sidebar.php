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

        <h3 class="widget-title">炖新闻</h3>
        <?php query_posts('showposts=3&category_name="dun-xin-wen"'); ?>

        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="row">
                        <div class="col-xs-4 widget-entry-thumb-wrapper">
                            <!-- thumbnail -->
                            <?php if ( !is_single() && has_post_thumbnail() ) { ?>
                            <div class="post-thumb widget-entry-thumb">
                                <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
                                <a href="<?php the_permalink() ?>" >
                                  <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
                                </a>
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
    <aside class="widget widget-full-wrapper widget-float widget_tudou_tan" >

        <h3 class="widget-title">土逗摊</h3>
        <?php query_posts('showposts=1&category_name="tu-dou-tan"'); ?>

        <?php while (have_posts()) : the_post(); ?>
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="widget-event widget-full-thumb">
            <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
            <a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt=""></a>
            <div class="widget-float_content">
              <a href="<?php the_permalink() ?>" rel="bookmark" class="widget-float_title"><?php the_title(); ?></a>
              <a href="<?php the_permalink() ?>" rel="bookmark" class="widget-float_excerpt" ><?php the_excerpt(); ?></a>
            </div>
        </div>
        <?php } ?>
        <?php endwhile; ?>

    </aside>

    <aside class="widget">
        <div class="focus-us">
            <div class="focus-us-pic">

            </div>
            <div class="focus-us-content">
                <div class="main-title">
                    订阅土逗公社
                </div>
                <div class="sub-title ">
                    探索人类更好的活法
                </div>
            </div>
        </div>
    </aside>

    <?php dynamic_sidebar( $sidebar ); ?>

    <!-- 侧边栏 土豆活动 -->
    <aside class="widget widget_recent_entries widget-float" >

        <h3 class="widget-title">土逗活动</h3>
        <?php query_posts('showposts=1&category_name="tu-dou-huo-dong"'); ?>

        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="row">
                        <div class="col-xs-6 widget-entry-thumb-wrapper">
                            <!-- thumbnail -->
                            <?php if ( !is_single() && has_post_thumbnail() ) { ?>
                            <div class="widget-entry-thumb">
                                <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
                                <a href="<?php the_permalink() ?>" >
                                  <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
                                </a>
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

                            <a class="btn btn-white widget-float-half_more" href="<?php the_permalink() ?>" rel="bookmark">详情</a>
                        </div>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

    </aside>

    <aside class="widget">
        <div class="row">
            <span class="share-title">关注我们</span>
            <div class="share-icon-list">
                <span class="share-icon-wechat" data-toggle="modal" data-target=".js-share-wechat"></span>
                <a href="http://weibo.com/tootopia" target="about:blank">
                    <span class="share-icon-weibo"></span>
                </a>
                <a href="https://www.facebook.com/tootopiatw/?fref=ts" target="about:blank">
                    <span class="share-icon-facebook"></span>
                </a>
            </div>
        </div>
    </aside>
     <?php  rt_theme_get_modal_dialog(); ?>
</div><!-- #secondary -->
<?php endif; ?>
