<?php
    /**
     * The Header template for our theme
     *
     * Displays all of the <head> section and everything up till <div id="main">
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */

    global $data; 
    $media_logo_upload = stripslashes($data['media_logo_upload']); 
    $media_favicon_upload = stripslashes($data['media_favicon_upload']);
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ($media_favicon_upload) { ?>
        <link rel="shortcut icon" href="<?php echo $media_favicon_upload; ?>" />
        <?php } else{ ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/ico/favicon.png" />
        <?php } ?>
        <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">
            <header id="masthead" class="site-header" role="banner">
                <nav id="site-navigation" class="main-navigation navbar navbar-default navbar-static-top" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                                <?php if ($media_logo_upload) { ?>
                                <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo $media_logo_upload; ?>">
                                <?php } else{ ?>
                                <?php bloginfo( 'name' ); ?>
                                <?php } ?>
                            </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <?php
                            wp_nav_menu( array(
                                'menu'              => 'primary',
                                'theme_location'    => 'primary',
                                'depth'             => 0,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => 'nav navbar-nav navbar-right',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker())
                            );
                        ?>

                        <div class="navbar-right" style="font-size: 30px;">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </div><!-- /.container -->
                </nav>
                <!-- /.navbar -->
            </header><!-- #masthead -->
   