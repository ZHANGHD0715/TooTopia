<?php
        /**
         * The Template for displaying portfolio single posts
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
<div id="main" class="wrapper">
    <div class="container">
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <?php if ( have_posts() ) { ?>
                <?php while ( have_posts() ) { ?>
                <?php the_post(); ?>
                <?php $do_not_duplicate = $post->ID; ?>
                <?php $count_posts = wp_count_posts('rt_portfolio'); ?>
                <?php $published_posts = $count_posts->publish; ?>
                <?php $portfolio_video_url = rwmb_meta( 'rt_portfolio_video_url' ); ?>
                <?php $portfolio_video_poster = rwmb_meta( 'rt_portfolio_video_poster' ); ?>
                <?php $portfolio_embeded_code = rwmb_meta( 'rt_portfolio_embeded_code' ); ?>
                <?php $images = rwmb_meta( 'rt_portfolio_image_upload', array ( 'type' => 'plupload_image', 'size' => 'landscape-full' ) ); ?>

                <?php if ( $published_posts > 1 ) { ?>
                <nav class="portfolio-navigation">
                    <ul class="portfolio-navigation-list">
                        <li><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></li>
                        <li><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></li>
                    </ul>
                </nav>
                <!-- .portfolio-navigation -->
                <?php } ?>

                <?php if ( !empty($portfolio_video_url) ) { ?>
                <div class="portfolio-thumbnail">
                    <?php echo do_shortcode('[video src="' . $portfolio_video_url . '" poster="' . $portfolio_video_poster . '"]'); ?>
                </div>
                <!-- .portfolio-thumbnail -->
                <?php } elseif ( !empty($portfolio_embeded_code) ) { ?>
                <div class="portfolio-thumbnail">
                    <?php echo $portfolio_embeded_code; ?>
                </div>
                <!-- .portfolio-thumbnail -->
                <?php } elseif ( !empty($images) ) { ?>
                <?php $total_images = count( $images ); ?>
                <div class="portfolio-thumbnail">
                    <div id="carousel-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php for ($i = 0; $i < $total_images; $i++) { ?>
                            <?php if ($i == 0) { ?>
                            <li data-target="#carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i ?>" class="active"></li>
                            <?php } else { ?>
                            <li data-target="#carousel-<?php the_ID(); ?>" data-slide-to="<?php echo $i ?>"></li>
                            <?php } ?>
                            <?php } ?>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php  $i = 0; ?>
                            <?php  foreach ( $images as $image ) { ?>
                            <?php if ($i == 0) { ?>
                            <div class="item active">
                                <?php echo "<img src='{$image['url']}' alt='{$image['alt']}' />"?>
                            </div>
                            <?php } else { ?>
                            <div class="item">
                                <?php echo "<img src='{$image['url']}' alt='{$image['alt']}' />"?>
                            </div>
                            <?php } ?>
                            <?php $i++; ?>
                            <?php } ?>
                        </div>
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-<?php the_ID(); ?>" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>

                <?php } else { ?>
                <?php if ( has_post_thumbnail() ) { ?>
                <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-full' ); ?>
                <div class="portfolio-thumbnail">
                    <img src="<?php echo $thumbnail[0] ?>" class="img-responsive" alt="1st Portfolio Thumb">
                </div>
                <!-- .portfolio-thumbnail -->
                <?php } ?>
                <?php } ?>

                <div class="row">
                    <div class="col-md-8">
                        <aside id="project-description" class="widget widget_project_description">
                            <h3 class="widget-title">Project Description</h3>
                            <?php the_content(); ?>
                        </aside>
                    </div>
                    <!-- /.col-md-8 -->
                    <div class="col-md-4">
                        <aside id="project-details" class="widget widget_project_details">
                            <h3 class="widget-title">Project Details</h3>
                            <ul class="project-details-list">
                                <?php $portfolio_company_name = rwmb_meta( 'rt_portfolio_company_name' ); ?>
                                <?php if ( !empty($portfolio_company_name) ) {?>
                                <li>
                                    <h6>Company</h6>
                                    <div class="project-terms">
                                        <?php echo $portfolio_company_name; ?>
                                    </div>
                                </li>
                                <?php } ?>
                                <?php $taxonomy = 'portfolio_cats'; ?>
                                <?php $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) ); ?>
                                <?php $separator = ', '; ?>
                                <?php if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) { ?>
                                <?php $term_ids = implode( ',' , $post_terms ); ?>
                                <?php $terms = wp_list_categories( 'title_li=&style=none&echo=0&taxonomy=' . $taxonomy . '&include=' . $term_ids ); ?>
                                <?php $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator ); ?>
                                <li>
                                    <h6>Categories</h6>
                                    <div class="project-terms">
                                        <?php echo  $terms; ?>
                                    </div>
                                </li>
                                <?php } ?>
                                <?php $portfolio_date = get_the_date(); ?>
                                <?php if ( !empty($portfolio_date) ) {?>
                                <li>
                                    <h6>Date</h6>
                                    <div class="project-terms">
                                        <?php echo $portfolio_date; ?>
                                    </div>
                                </li>
                                <?php } ?>
                                <?php $product_terms = wp_get_object_terms($post->ID, 'skills'); ?>
                                <?php if(!empty($product_terms)){ ?>
                                <?php if(!is_wp_error( $product_terms )){ ?>
                                <?php foreach($product_terms as $term){ ?>
                                <?php $skills[] = '<a href="'.get_term_link($term->slug, 'skills').'">'.$term->name.'</a>'; ?>
                                <?php } ?>
                                <li>
                                    <h6>Skills</h6>
                                    <div class="project-terms">
                                        <?php echo implode( ', ' , $skills ); ?>
                                    </div>
                                </li>
                                <?php } ?>
                                <?php } ?>
                                <?php $portfolio_website_url = rwmb_meta( 'rt_portfolio_website_url' ); ?>
                                <?php if ( !empty($portfolio_website_url) ) {?>
                                <li>
                                    <h6>Website</h6>
                                    <div class="project-terms">
                                        <a href="<?php echo $portfolio_website_url; ?>"><?php echo $portfolio_website_url; ?></a>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </aside>
                    </div>
                    <!-- /.col-md-4 -->
                </div>
                <!-- .row -->
                <?php } ?>
                <?php } else { ?>
                <p>not Found</p>
                <?php } ?>



                <?php $the_query = new WP_Query( array( 'post_type' => 'rt_portfolio', 'posts_per_page' => 5 ) ); ?>
                <?php $post_count = $the_query->post_count; ?>

                <?php if ( $the_query->have_posts() ) { ?>
                <?php if ( $post_count > 1 ) { ?>
                <section id="releted-works" class="caroufredsel-portfolio">
                    <div class="subpage-title">
                        <h5>Releted Works</h5>
                        <?php if($post_count > 4) { ?>
                        <!-- Controls -->
                        <div class="controls">
                            <span id="caroufredsel-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>
                            <span id="caroufredsel-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- .subpage-title -->
                    <div class="row flush">
                        <div id="caroufredsel-container">
                            <!-- the loop -->
                            <?php while ( $the_query->have_posts() ) { ?>
                            <?php $the_query->the_post(); ?>
                            <?php if( $post->ID == $do_not_duplicate ) continue; ?>
                            <div class="col-xs-12 col-sm-6 col-md-4 portfolio-item-wrapper">
                                <div class="portfolio-item">
                                    <div class="portfolio-thumb">
                                        <?php $images = rwmb_meta( 'rt_portfolio_image_upload', array ( 'type' => 'plupload_image', 'size' => 'portrait-medium' ) ); ?>
                                        <?php $portfolio_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portrait-medium' ); ?>
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
                                        <img src="<?php echo $portfolio_thumbnail_src[0]; ?>" class="img-responsive" alt="">
                                        <div class="image-overlay"></div>
                                        <a href="<?php echo $thumbnail_src[0]; ?>" rel="prettyPhoto[pp_gal]" class="portfolio-zoom"><i class="fa fa-eye"></i></a>
                                        <?php } ?>

                                        <a href="<?php the_permalink(); ?>" class="portfolio-link"><i class="fa fa-link"></i></a>
                                    </div>
                                    <div class="portfolio-details">
                                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.portfolio-item-wrapper -->
                            <?php } ?>
                        </div>
                        <!-- /.caroufredsel-container -->
                    </div>
                    <!-- /.row -->
                    <?php if($post_count > 4) { ?>
                    <script type="text/javascript">
                        // jQuery CarouFredSel
                        var caroufredsel = function() {
                            jQuery('#caroufredsel-container').carouFredSel({
                                responsive: true,
                                scroll: 1,
                                circular: false,
                                infinite: false,
                                items: {
                                    visible: {
                                        min: 1,
                                        max: 3
                                    }
                                },
                                prev: '#caroufredsel-prev',
                                next: '#caroufredsel-next',
                                auto: {
                                    play: false
                                }
                            });
                        };
                        
                        jQuery(window).load(function($) {
                            caroufredsel();
                        });
                        jQuery(window).resize(function($) {
                            caroufredsel();
                        });
                    </script>
                    <?php } ?>
                </section>
                <!-- /#releted-works -->
                <?php } else { ?>
                <section class="section">
                    <div class="subpage-title">
                        <h5>Releted Works</h5>
                    </div>
                    <div class="zero-results">
                        <h3>No more portfolios to display!</h3>
                        <?php if ( current_user_can( 'edit_posts' ) ) { ?>
                        <p>Ready to create more portfolio items? <a href="' . admin_url( 'post-new.php?post_type=rt_portfolio' ) . '">Get started here.</a></p>
                        <?php } else { ?>
                        <p>Apologies, but no results were found.</p>
                        <?php } ?>

                    </div>
                </section>
                <?php } ?>

                <?php } ?>

                <?php wp_reset_postdata(); ?>

            </div>
            <!-- #content -->
        </div>
        <!-- #primary -->
    </div>
    <!-- .container -->
</div>
<!-- #main .wrapper -->
<?php get_footer(); ?>