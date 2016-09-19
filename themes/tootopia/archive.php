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
                <h1 class="archive-title"><?php
                    if ( is_day() ) :
                        printf( __( 'Daily Archives: %s', 'retouch' ), '<span>' . get_the_date() . '</span>' );
                    elseif ( is_month() ) :
                        printf( __( 'Monthly Archives: %s', 'retouch' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'retouch' ) ) . '</span>' );
                    elseif ( is_year() ) :
                        printf( __( 'Yearly Archives: %s', 'retouch' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'retouch' ) ) . '</span>' );
                    else :
                        _e( 'Archives', 'retouch' );
                    endif;
                    ?></h1>
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
            <div class="col-md-8">
                <div id="primary" class="site-content">
                    <div id="content" role="main">

                        <?php if ( have_posts() ) : ?>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
                        <?php retouch_content_nav( 'nav-below' ); ?>
                        <?php else : ?>
                        <article id="post-0" class="post no-results not-found">
                            <?php
                                if ( current_user_can( 'edit_posts' ) ) :
                                               // Show a different message to a logged-in user who can add posts.
                            ?>
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h3><?php _e( 'No posts to display!', 'retouch' ); ?></h3>
                                </header>
                                <div class="entry-content">
                                    <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'retouch' ), admin_url( 'post-new.php' ) ); ?></p>
                                </div><!-- .entry-content -->
                            </div>
                            <?php
                                else :
                                               // Show the default message to everyone else.
                            ?>
                            <div class="entry-wrap">
                                <header class="entry-header">
                                    <h3><?php _e( 'Nothing Found!', 'retouch' ); ?></h3>
                                </header>
                                <div class="entry-content">
                                    <p><?php _e( 'Apologies, but no results were found.', 'retouch' ); ?></p>
                                </div><!-- .entry-content -->
                            </div>
                            <?php endif; // end current_user_can() check ?>
                        </article><!-- #post-0 -->
                        <?php endif; // end have_posts() check ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
            <div class="col-md-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>