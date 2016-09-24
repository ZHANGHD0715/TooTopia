<?php
    /**
     * ReTouch functions and definitions
     *
     * Sets up the theme and provides some helper functions, which are used
     * in the theme as custom template tags. Others are attached to action and
     * filter hooks in WordPress to change core functionality.
     *
     * When using a child theme (see http://codex.wordpress.org/Theme_Development and
     * http://codex.wordpress.org/Child_Themes), you can override certain functions
     * (those wrapped in a function_exists() call) by defining them first in your child theme's
     * functions.php file. The child theme's functions.php file is included before the parent
     * theme's file, so the child theme functions would be used.
     *
     * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
     * to a filter or action hook.
     *
     * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
    // Set up the content width value based on the theme's design and stylesheet.
    if ( ! isset( $content_width ) )
        $content_width = 1000;
    /**
     * ReTouch setup.
     *
     * Sets up theme defaults and registers the various WordPress features that
     * ReTouch supports.
     *
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses add_editor_style() To add a Visual Editor stylesheet.
     * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
     * 	custom background, and post formats.
     * @uses register_nav_menu() To add support for navigation menus.
     * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
     *
     * @since ReTouch 1.0
     */
    function retouch_setup() {
        /*
         * Makes ReTouch available for translation.
         *
         * Translations can be added to the /languages/ directory.
         * If you're building a theme based on ReTouch, use a find and replace
         * to change 'retouch' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'retouch', get_template_directory() . '/languages' );
        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();
        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );
        // This theme supports a variety of post formats.
        add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menu( 'primary', __( 'Primary Menu', 'retouch' ) );
        register_nav_menu( 'secondary', __( 'Secondary Menu', 'retouch' ) );
        // This theme uses a custom image size for featured images, displayed on "standard" posts.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1020, 9999 ); // Unlimited height, soft crop
        add_image_size( 'landscape-medium', 767, 431, true);
        add_image_size( 'landscape-full', 1020, 574, true);
        add_image_size( 'portrait-medium', 767, 575, true);
        add_image_size( 'portrait-full', 1020, 765, true);
    }
    add_action( 'after_setup_theme', 'retouch_setup' );
    require_once( get_template_directory() . '/framework/wp_bootstrap_navwalker.php' );
    require_once( get_template_directory() . '/framework/shortcodes.php' );
    // Re-define meta box path and URL
    define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/framework/plugins/meta-box' ) );
    define( 'RWMB_DIR', trailingslashit( STYLESHEETPATH . '/framework/plugins/meta-box' ) );
    // Include the meta box script
    require_once RWMB_DIR . 'meta-box.php';
    // Include the meta box definition (the file where you define meta boxes, see `demo/demo.php`)
    include get_template_directory() . '/framework/meta-boxes.php';
    /* Extra check in case the script is being loaded by a theme. */
    if ( !function_exists( 'breadcrumb_trail' ) ) {
        require_once( get_template_directory() . '/framework/breadcrumb-trail.php' );
    }
    
    require_once( get_template_directory() . '/framework/widgets/social_links.php' );
    global $data; 
    require_once( get_template_directory() . '/admin/index.php' );
    
    /**
     * Include the TGM_Plugin_Activation class.
     */
    require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
    add_action( 'tgmpa_register', 'rt_theme_register_required_plugins' );
    /**
     * Register the required plugins for this theme.
     *
     * In this example, we register two plugins - one included with the TGMPA library
     * and one from the .org repo.
     *
     * The variable passed to tgmpa_register_plugins() should be an array of plugin
     * arrays.
     *
     * This function is hooked into tgmpa_init, which is fired within the
     * TGM_Plugin_Activation class constructor.
     */
    function rt_theme_register_required_plugins() {
        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(
            // This is an example of how to include a plugin pre-packaged with a theme.
            array(
                'name'               => 'Revolution Slider', // The plugin name.
                'slug'               => 'revslider', // The plugin slug (typically the folder name).
                'source'             => get_stylesheet_directory() . '/framework/plugins/revslider.zip', // The plugin source.
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
                'version'            => '4.6.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
                'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            ),
            // Contact Form 7 is a plugin from the WordPress Plugin Repository.
            array(
                'name'      => 'Contact Form 7',
                'slug'      => 'contact-form-7',
                'required'  => false,
            ),
            // Flickr Badges Widget is a plugin from the WordPress Plugin Repository.
            array(
                'name'      => 'Flickr Badges Widget',
                'slug'      => 'flickr-badges-widget',
                'required'  => false,
            ),
            // SMK Sidebar Generator is a plugin from the WordPress Plugin Repository.
            array(
                'name'      => 'SMK Sidebar Generator',
                'slug'      => 'smk-sidebar-generator',
                'required'  => false,
            ),
            // WordPress Importer is a plugin from the WordPress Plugin Repository.
            array(
                'name'      => 'WordPress Importer',
                'slug'      => 'wordpress-importer',
                'required'  => false,
            ),
        );
        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
                'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
                'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
                'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
                'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
                'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );
        tgmpa( $plugins, $config );
    }
    
    /**
     * Return the Google font stylesheet URL, if available.
     *
     * The use of Open Sans and Montserrat by default is localized. For languages
     * that use characters not supported by the font, the font can be disabled.
     *
     * @since ReTouch 1.0
     *
     * @return string Font stylesheet or empty string if disabled.
     */
    function retouch_get_font_url() {
        $fonts_url = '';
        /* Translators: If there are characters in your language that are not
         * supported by Open Sans, translate this to 'off'. Do not translate
         * into your own language.
         */
        $open_sans = _x( 'on', 'Open Sans font: on or off', 'retouch' );
        /* Translators: If there are characters in your language that are not
         * supported by Montserrat, translate this to 'off'. Do not translate into your
         * own language.
         */
        $montserrat = _x( 'on', 'Montserrat font: on or off', 'retouch' );
        if ( 'off' !== $open_sans || 'off' !== $montserrat ) {
            $subsets = 'latin,latin-ext';
            /* translators: To add an additional Open Sans character subset specific to your language, translate
               this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
            $subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );
            if ( 'cyrillic' == $subset )
                $subsets .= ',cyrillic,cyrillic-ext';
            elseif ( 'greek' == $subset )
                $subsets .= ',greek,greek-ext';
            elseif ( 'vietnamese' == $subset )
                $subsets .= ',vietnamese';
            $font_families = array();
            if ( 'off' !== $open_sans )
                $font_families[] = 'Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic';
            if ( 'off' !== $montserrat )
                $font_families[] = 'Montserrat:400,700';
            $protocol = is_ssl() ? 'https' : 'http';
            $query_args = array(
                'family' => implode( '|', $font_families ),
                'subset' => $subsets,
            );
            $fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
        }
        return $fonts_url;
    }
    /**
     * Enqueue scripts and styles for front-end.
     *
     * @since ReTouch 1.0
     *
     * @return void
     */
    function retouch_scripts_styles() {
        global $wp_styles;
        /*
         * Adds JavaScript to pages with the comment form to support
         * sites with threaded comments (when in use).
         */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );
        // Register Bootstrap JS & Other JavaScript Plugins 
        wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.js', array( 'jquery' ), '3.0.0', true );  
        wp_register_script( 'holder', get_template_directory_uri() . '/assets/js/holder.js', array(), '1.0.0', true ); 
        wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/assets/prettyPhoto/js/jquery.prettyPhoto.js', array(), '1.0.0', true ); 
        wp_register_script( 'jquery-easing', get_template_directory_uri() . '/assets/UItoTop/js/easing.js', array(), '1.0.0', true ); 
        wp_register_script( 'UItoTop', get_template_directory_uri() . '/assets/UItoTop/js/jquery.ui.totop.js', array(), '1.0.0', true );     
        wp_register_script( 'carouFredSel', get_template_directory_uri() . '/assets/js/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery' ), '1.0.0'); 
        wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array( 'jquery' ), '1.0.0');
        wp_register_script( 'FitVids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array(), '1.0.0', true ); 
        wp_register_script( 'ObjectFitPloyfill', get_template_directory_uri() . '/assets/js/ofi.browser.js', array(), '1.0.0', true ); 
        wp_register_script( 'custom-script', get_template_directory_uri() . '/assets/js/custom-script.js', array(), '1.0.0', true ); 
        wp_register_script( 'stickeyHeader', get_template_directory_uri() . '/assets/js/stickeyHeader.js', array(), '1.0.0', true ); 
        wp_register_script( 'toggleSearchForm', get_template_directory_uri() . '/assets/js/searchFormToggle.js', array(), '1.0.0', true ); 

        wp_register_script( 'main', get_template_directory_uri() . '/assets/javascript/main.js', array(), '1.0.0', true ); 
    
        // Loads Bootstrap JS & Other JavaScript Plugins  
        wp_enqueue_script( 'bootstrap' ); 
        wp_enqueue_script( 'holder' );
        wp_enqueue_script( 'prettyPhoto' );
        wp_enqueue_script( 'jquery-easing' );
        wp_enqueue_script( 'UItoTop' );    
        wp_enqueue_script( 'carouFredSel' );
        wp_enqueue_script( 'isotope' );
        wp_enqueue_script( 'FitVids' );
        wp_enqueue_script( 'ObjectFitPloyfill' );
        wp_enqueue_script( 'custom-script' );
        wp_enqueue_script( 'stickeyHeader' );
        wp_enqueue_script( 'toggleSearchForm' );

        $font_url = retouch_get_font_url();
        if ( ! empty( $font_url ) )
            wp_enqueue_style( 'retouch-fonts', esc_url_raw( $font_url ), array(), null );
        // Register Bootstrap CSS & Other Stylesheets
        wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css', array(), '3.0.0', 'all' ); 
        wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/assets/prettyPhoto/css/prettyPhoto.css', array(), '3.0.0', 'all' ); 
        wp_register_style( 'UItoTop', get_template_directory_uri() . '/assets/UItoTop/css/ui.totop.css', array(), '3.0.0', 'all' ); 
        wp_register_style( 'skins', get_template_directory_uri() . '/assets/css/skins.css', array(), '3.0.0', 'all' ); 
        wp_register_style( 'retouch-style', get_template_directory_uri() . '/assets/stylesheets/main.css', array(), '3.0.0', 'all' ); 
        // Loads Bootstrap CSS & Other Stylesheets
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'prettyPhoto' );
        wp_enqueue_style( 'UItoTop' );
        wp_enqueue_style( 'tp_twitter_plugin_css' );
        // Register Font Awesome stylesheet.
        wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css', array(), '4.0.1', 'all' ); 
        // Loads Font Awesome stylesheet.
        wp_enqueue_style( 'font-awesome' );
        // Loads our main stylesheet.
        // wp_enqueue_style( 'retouch-style', get_stylesheet_uri() );
        wp_enqueue_style( 'skins' );
        // Loads the Internet Explorer specific stylesheet.
        wp_enqueue_style( 'retouch-ie', get_template_directory_uri() . '/css/ie.css', array( 'retouch-style' ), '20121010' );
        $wp_styles->add_data( 'retouch-ie', 'conditional', 'lt IE 9' );
    }
    add_action( 'wp_enqueue_scripts', 'retouch_scripts_styles' );
    /**
     * Filter TinyMCE CSS path to include Google Fonts.
     *
     * Adds additional stylesheets to the TinyMCE editor if needed.
     *
     * @uses retouch_get_font_url() To get the Google Font stylesheet URL.
     *
     * @since ReTouch 1.0
     *
     * @param string $mce_css CSS path to load in TinyMCE.
     * @return string Filtered CSS path.
     */
    function retouch_mce_css( $mce_css ) {
        $font_url = retouch_get_font_url();
        if ( empty( $font_url ) )
            return $mce_css;
        if ( ! empty( $mce_css ) )
            $mce_css .= ',';
        $mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );
        return $mce_css;
    }
    add_filter( 'mce_css', 'retouch_mce_css' );
    /**
     * Filter the page title.
     *
     * Creates a nicely formatted and more specific title element text
     * for output in head of document, based on current view.
     *
     * @since ReTouch 1.0
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string Filtered title.
     */
    function retouch_wp_title( $title, $sep ) {
        global $paged, $page;
        if ( is_feed() )
            return $title;
        // Add the site name.
        $title .= get_bloginfo( 'name' );
        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";
        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'retouch' ), max( $paged, $page ) );
        return $title;
    }
    add_filter( 'wp_title', 'retouch_wp_title', 10, 2 );
    /**
     * Filter the page menu arguments.
     *
     * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
     *
     * @since ReTouch 1.0
     */
    function retouch_page_menu_args( $args ) {
        if ( ! isset( $args['show_home'] ) )
            $args['show_home'] = true;
        return $args;
    }
    add_filter( 'wp_page_menu_args', 'retouch_page_menu_args' );
    /**
     * Register sidebars.
     *
     * Registers our main widget area and the front page widget areas.
     *
     * @since ReTouch 1.0
     */
    function retouch_widgets_init() {
        register_sidebar( array(
            'name' => __( 'Main Sidebar', 'retouch' ),
            'id' => 'sidebar-1',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Secondary Sidebar', 'retouch' ),
            'id' => 'sidebar-2',
            'description' => __( 'The sidebar for the optional Showcase Template', 'retouch' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Area One', 'retouch' ),
            'id' => 'sidebar-3',
            'description' => __( 'An optional widget area for your site footer', 'retouch' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Area Two', 'retouch' ),
            'id' => 'sidebar-4',
            'description' => __( 'An optional widget area for your site footer', 'retouch' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Area Three', 'retouch' ),
            'id' => 'sidebar-5',
            'description' => __( 'An optional widget area for your site footer', 'retouch' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Area Four', 'retouch' ),
            'id' => 'sidebar-6',
            'description' => __( 'An optional widget area for your site footer', 'retouch' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => "</aside>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    }
    add_action( 'widgets_init', 'retouch_widgets_init' );
    if ( ! function_exists( 'retouch_content_nav' ) ) :
    /**
     * Displays navigation to next/previous pages when applicable.
     *
     * @since ReTouch 1.0
     */
    function retouch_content_nav() {
    global $wp_query;
    
    $big = 999999999; // need an unlikely integer
    echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type' => 'list'
    ) );
    }
    endif;
    if ( ! function_exists( 'retouch_comment' ) ) :
    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own retouch_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Twenty Eleven 1.0
     *
     * @param object $comment The comment object.
     * @param array  $args    An array of comment arguments. @see get_comment_reply_link()
     * @param int    $depth   The depth of the comment.
     */
    function retouch_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
?>
<li class="post pingback">
    <p><?php _e( 'Pingback:', 'retouch' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'retouch' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
        <footer class="comment-meta">
            <div class="comment-author vcard">
                <?php
                    $avatar_size = 68;
                    if ( '0' != $comment->comment_parent )
                        $avatar_size = 39;
                    echo get_avatar( $comment, $avatar_size );
                    /* translators: 1: comment author, 2: date and time */
                    printf( __( '%1$s on %2$s <span class="says">said:</span>', 'retouch' ),
                        sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                        sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s at %2$s', 'retouch' ), get_comment_date(), get_comment_time() )
                        )
                    );
                ?>
                <?php edit_comment_link( __( 'Edit', 'retouch' ), '<span class="edit-link">', '</span>' ); ?>
            </div><!-- .comment-author .vcard -->
            <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'retouch' ); ?></em>
            <br />
            <?php endif; ?>
        </footer>
        <div class="comment-content"><?php comment_text(); ?></div>
        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'retouch' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
    </article><!-- #comment-## -->
    <?php
                    break;
            endswitch;
        }
        endif; // ends check for retouch_comment()
        if ( ! function_exists( 'retouch_entry_meta' ) ) :
        /**
         * Set up post entry meta.
         *
         * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
         *
         * Create your own retouch_entry_meta() to override in a child theme.
         *
         * @since ReTouch 1.0
         *
         * @return void
         */
        function retouch_entry_meta() {
            // Translators: used between list items, there is a space after the comma.
            $categories_list = get_the_category_list( __( ', ', 'retouch' ) );
            // Translators: used between list items, there is a space after the comma.
            $tag_list = get_the_tag_list( '', __( ', ', 'retouch' ) );
            $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
                esc_url( get_permalink() ),
                esc_attr( get_the_time() ),
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() )
            );
            $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                esc_attr( sprintf( __( 'View all posts by %s', 'retouch' ), get_the_author() ) ),
                get_the_author()
            );
        
            // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
    ?>
    
    <?php if ( $categories_list ) { ?>
    <span class="post-cats"><i class="fa fa-th-list"></i> <?php echo $categories_list ?></span>
    <?php } ?>
    <span class="post-date"><i class="fa fa-clock-o"></i> <?php echo $date ?></span>
    
    <?php
        }
        endif;
        /**
         * Extend the default WordPress body classes.
         *
         * Extends the default WordPress body class to denote:
         * 1. Using a full-width layout, when no active widgets in the sidebar
         *    or full-width template.
         * 2. Front Page template: thumbnail in use and number of sidebars for
         *    widget areas.
         * 3. White or empty background color to change the layout and spacing.
         * 4. Custom fonts enabled.
         * 5. Single or multiple authors.
         *
         * @since ReTouch 1.0
         *
         * @param array $classes Existing class values.
         * @return array Filtered class values.
         */
        function retouch_body_class( $classes ) {
            $background_color = get_background_color();
            $background_image = get_background_image();
            if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
                $classes[] = 'full-width';
            if ( is_page_template( 'page-templates/front-page.php' ) ) {
                $classes[] = 'template-front-page';
                if ( has_post_thumbnail() )
                    $classes[] = 'has-post-thumbnail';
                if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
                    $classes[] = 'two-sidebars';
            }
            if ( empty( $background_image ) ) {
                if ( empty( $background_color ) )
                    $classes[] = 'custom-background-empty';
                elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
                    $classes[] = 'custom-background-white';
            }
            // Enable custom font class only if the font CSS is queued to load.
            if ( wp_style_is( 'retouch-fonts', 'queue' ) )
                $classes[] = 'custom-font-enabled';
            if ( ! is_multi_author() )
                $classes[] = 'single-author';
            return $classes;
        }
        add_filter( 'body_class', 'retouch_body_class' );
        /**
         * Adjust content width in certain contexts.
         *
         * Adjusts content_width value for full-width and single image attachment
         * templates, and when there are no active widgets in the sidebar.
         *
         * @since ReTouch 1.0
         *
         * @return void
         */
        function retouch_content_width() {
            if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
                global $content_width;
                $content_width = 1020;
            }
        }
        add_action( 'template_redirect', 'retouch_content_width' );
        /**
         * Register postMessage support.
         *
         * Add postMessage support for site title and description for the Customizer.
         *
         * @since ReTouch 1.0
         *
         * @param WP_Customize_Manager $wp_customize Customizer object.
         * @return void
         */
        function retouch_customize_register( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        }
        add_action( 'customize_register', 'retouch_customize_register' );
        /**
         * Enqueue Javascript postMessage handlers for the Customizer.
         *
         * Binds JS handlers to make the Customizer preview reload changes asynchronously.
         *
         * @since ReTouch 1.0
         *
         * @return void
         */
        function retouch_customize_preview_js() {
            wp_enqueue_script( 'retouch-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
        }
        add_action( 'customize_preview_init', 'retouch_customize_preview_js' );
        /**
         * Retrieve the IDs for images in a gallery.
         *
         * @uses get_post_galleries() First, if available. Falls back to shortcode parsing,
         *                            then as last option uses a get_posts() call.
         *
         * @since Twenty Eleven 1.6
         *
         * @return array List of image IDs from the post gallery.
         */
        function retouch_get_gallery_images() {
            $images = array();
            if ( function_exists( 'get_post_galleries' ) ) {
                $galleries = get_post_galleries( get_the_ID(), false );
                if ( isset( $galleries[0]['ids'] ) )
                    $images = explode( ',', $galleries[0]['ids'] );
            } else {
                $pattern = get_shortcode_regex();
                preg_match( "/$pattern/s", get_the_content(), $match );
                $atts = shortcode_parse_atts( $match[3] );
                if ( isset( $atts['ids'] ) )
                    $images = explode( ',', $atts['ids'] );
            }
            if ( ! $images ) {
                $images = get_posts( array(
                    'fields'         => 'ids',
                    'numberposts'    => 999,
                    'order'          => 'ASC',
                    'orderby'        => 'menu_order',
                    'post_mime_type' => 'image',
                    'post_parent'    => get_the_ID(),
                    'post_type'      => 'attachment',
                ) );
            }
            return $images;
        }
        
        /**
         * Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
         */
        function get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
            global $wpcommentspopupfile, $wpcommentsjavascript;
        
            $id = get_the_ID();
        
            if ( false === $zero ) $zero = __( 'No Comments' );
            if ( false === $one ) $one = __( '1 Comment' );
            if ( false === $more ) $more = __( '% Comments' );
            if ( false === $none ) $none = __( 'Comments Off' );
        
            $number = get_comments_number( $id );
        
            $str = '';
        
            if ( 0 == $number && !comments_open() && !pings_open() ) {
                $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
                return $str;
            }
        
            if ( post_password_required() ) {
                $str = __('Enter your password to view comments.');
                return $str;
            }
        
            $str = '<a href="';
            if ( $wpcommentsjavascript ) {
                if ( empty( $wpcommentspopupfile ) )
                    $home = home_url();
                else
                    $home = get_option('siteurl');
                $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
                $str .= '" onclick="wpopen(this.href); return false"';
            } else { // if comments_popup_script() is not in the template, display simple comment link
                if ( 0 == $number )
                    $str .= get_permalink() . '#respond';
                else
                    $str .= get_comments_link();
                $str .= '"';
            }
        
            if ( !empty( $css_class ) ) {
                $str .= ' class="'.$css_class.'" ';
            }
            $title = the_title_attribute( array('echo' => 0 ) );
        
            $str .= apply_filters( 'comments_popup_link_attributes', '' );
        
            $str .= ' title="' . esc_attr( sprintf( __('Comment on %s'), $title ) ) . '">';
            $str .= get_comments_number_str( $zero, $one, $more );
            $str .= '</a>';
        
            return $str;
        }
        
        /**
         * Modifies WordPress's built-in comments_number() function to return string instead of echo
         */
        function get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
            if ( !empty( $deprecated ) )
                _deprecated_argument( __FUNCTION__, '1.3' );
        
            $number = get_comments_number();
        
            if ( $number > 1 )
                $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments') : $more);
            elseif ( $number == 0 )
                $output = ( false === $zero ) ? __('No Comments') : $zero;
            else // must be one
                $output = ( false === $one ) ? __('1 Comment') : $one;
        
            return apply_filters('comments_number', $output, $number);
        }
        // Add Shortcode
        function rt_carousel_shortcode( $atts , $content = null ) {
        
            // Attributes
            extract( shortcode_atts(
                array(
                    'id' => 'carousel-example-generic',
                    'indicators' => false,
                    'control' => false,
                ), $atts )
            );
        
            // Code
            $output = '<div id="' . $id . '" class="carousel slide" data-ride="carousel">';
            if ($indicators) {
                $output .= '<ol class="carousel-indicators">';
                for ($i = 0; $i < $indicators; $i++) {
                    if ($i == 0) {
                        $output .= '<li data-target="#' . $id . '" data-slide-to="' . $i . '" class="active"></li>';
                    } else {
                        $output .= '<li data-target="#' . $id . '" data-slide-to="' . $i . '"></li>';
                    }
                }  
                $output .= '</ol>';
            }
            $output .= '<div class="carousel-inner">';
            $output .= do_shortcode( $content );
            $output .= '</div>';
            if ($control) {
                $output .= '<a class="left carousel-control" href="#' . $id . '" data-slide="prev">';
                $output .= '<span class="glyphicon glyphicon-chevron-left"></span>';
                $output .= '</a>';
                $output .= '<a class="right carousel-control" href="#' . $id . '" data-slide="next">';
                $output .= '<span class="glyphicon glyphicon-chevron-right"></span>';
                $output .= '</a>';
            }
            $output .= '</div>';
            return $output;
        }
        add_shortcode( 'rt_carousel', 'rt_carousel_shortcode' );
        
        // Add Shortcode
        function rt_carousel_item_shortcode( $atts , $content = null ) {
        
            // Attributes
            extract( shortcode_atts(
                array(
                    'src' => '',
                    'active' => false,
                    'alt' => false,
                ), $atts )
            );
        
            // Code
            $output = ($active) ? '<div class="item active">' : '<div class="item">';
            $output .= '<img src="' . esc_attr($src) . '" alt="' . esc_attr($alt) . '">';
            $output .= '<div class="carousel-caption">';
            $output .= do_shortcode( $content );
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
        add_shortcode( 'rt_carousel_item', 'rt_carousel_item_shortcode' );
        
        function rt_font_awesome_shortcode( $atts ) {
            extract( shortcode_atts(
                array(
                    'class' => '',
                ), $atts )
            );
            return '<i class="' . esc_attr($class) . '"></i>';
        }
        add_shortcode( 'rt_icon', 'rt_font_awesome_shortcode' );
        
        function rt_the_year( $atts ) {
            return date("Y");
        }
        add_shortcode( 'rt_the_year', 'rt_the_year' );
        
        function rt_blog_title( $atts ) {
            return '<a href="' . get_bloginfo( 'url' ) . '">' . get_bloginfo() . '</a>';
        }
        add_shortcode( 'rt_blog_title', 'rt_blog_title' );
        
        function rt_wp_link( $atts ) {
            return '<a href="' . esc_url( __( 'http://wordpress.org/', 'retouch' ) ) . '">' . sprintf( __( 'Proudly Powered By %s', 'retouch' ), 'WordPress' ) . '</a>';
        }
        add_shortcode( 'rt_wp_link', 'rt_wp_link' );
        
        function rt_container_shortcode( $atts, $content = null ) {
            extract( shortcode_atts(
                array(
                    'class' => '',
                ), $atts )
            );
        
            $output = ($class) ? '<div class="container ' . esc_attr($class) . '">' : '<div class="container">'; 
            $output .= do_shortcode($content);
            $output .= '</div>';
        
            return $output;
        }
        add_shortcode( 'rt_container', 'rt_container_shortcode' );
        
        function rt_callout_shortcode( $atts, $content = null ) {
            extract( shortcode_atts(
                array(
                    'class' => false,
                    'title' => false,
                    'btn_class' => false,
                    'btn_url' => false,
                    'btn_name' => false,            
                ), $atts )
            );
        
            $output = ($class) ? '<div class="action-box ' . esc_attr($name) . '">' : '<div class="action-box">'; 
            $output .= ($title) ? '<h3>' . esc_attr($title) . '</h3>' : '<h3>Hey, are you ready to buy this awesome theme?</h3>'; 
            $output .= '<p>' . do_shortcode($content) . '</p>';
            $output .= '<a class="';
            $output .= ($btn_class) ? esc_attr($btn_class) : 'btn btn-flat flat-color'; 
            $output .= ($btn_url) ? '" href="' . esc_attr($btn_url) . '">' : '" href="#">'; 
            $output .= ($btn_name) ? esc_attr($btn_name) . '</a>' : 'Purchase Now</a>'; 
            $output .= '</div>';
        
            return $output;
        }
        add_shortcode( 'rt_callout', 'rt_callout_shortcode' );
        
        function rt_simple_title_shortcode( $atts ) {
            extract( shortcode_atts(
                array(
                    'name' => false,
                    'style' => false,
                    'icon' => false,
                ), $atts )
            );
        
            $output = ($style) ? '<div class="subpage-title" style="' . esc_attr($style) . '">' : '<div class="subpage-title">';  
            $output .= '<h5>';
            $output .= ($icon) ? '<i class="' . esc_attr($icon) . '"></i>' : ''; 
            $output .= ($name) ? esc_attr($name) : 'Simple Title'; 
            $output .= '</h5>';
            $output .= '</div>';
        
            return $output;
        }
        add_shortcode( 'rt_simple_title', 'rt_simple_title_shortcode' );
        
        function rt_section_shortcode( $atts, $content = null ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'class' => false,
                    'style' => false,
                ), $atts )
            );
            $output = ($id) ? '<section id="' . esc_attr($id) . '"' : '<section';    
            $output .= ($class) ? ' class="section ' . esc_attr($class) . '"' : ' class="section"';
            $output .= ($style) ? ' style="' . esc_attr($style) . '"' : '';   
            $output .= '>';
            $output .= do_shortcode($content);
            $output .= '</section>';
        
            return $output;
        }
        add_shortcode( 'rt_section', 'rt_section_shortcode' );
        
        function rt_service_shortcode( $atts, $content = null ) {
            extract( shortcode_atts(
                array(
                    'icon' => false,
                    'title' => false,
                    'boxed' => false,
                ), $atts )
            );
        
            $output = ($boxed) ? '<div class="service service-2">' : '<div class="service">';
            $output .= '<div class="service-inner">';
            $output .= ($icon) ? '<span class="service-icon"><i class="' . esc_attr($icon) . '"></i></span>' : '';
            $output .= '<div class="service-details">';
            $output .= ($title) ? '<h4>' . esc_attr($title) . '</h4>' : '';
            $output .= '<p>' . do_shortcode($content) . '</p>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        }
        
        
        add_shortcode( 'rt_service', 'rt_service_shortcode' );
        
        
        function rt_portfolio_shortcode(  $atts ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'flush' => false,
                    'column' => 'col-sm-6 col-md-4',
                    'items' => 9,
                    'excerpt' => true,
                ), $atts )
            );
        
            global $post;
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $the_query = new WP_Query( array( 'post_type' => 'rt_portfolio', 'posts_per_page' => $items, 'paged' => $paged, ) );
            $filters = '';
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $retrive_cats = wp_get_object_terms($post->ID, 'portfolio_cats', array( 'fields' => 'all' ));
                    foreach($retrive_cats as $category){
                        $findme = '<li><a href="#" data-filter=".' . $category->slug . '">' . $category->name . '</a></li>';
                        $pos = strpos($filters, $findme);
                        if ($pos === false) {
                            $filters .= $findme;
                        }
                    }
                }
            }
            wp_reset_postdata();
        
            $the_query = new WP_Query( array( 'post_type' => 'rt_portfolio', 'posts_per_page' => $items, 'paged' => $paged, ) );
            if ( $the_query->have_posts() ) {
                $output = ($id) ? '<section id="' . esc_attr($id) . '" class="portfolio">' : '<section class="portfolio">';
                $output .= '<div class="container">'; 
                $output .= ($id) ? '<ul class="' . esc_attr($id) . '-portfolio-filter nav nav-pills">' : '<ul class="portfolio-filter nav nav-pills">';
                $output .= '<li class="active"><a href="#" data-filter="*">All</a></li>';
        
                $output .= $filters;
        
                $output .= '</ul>';
                $output .= ($flush) ? '<div class="row flush">' : '<div class="row">'; 
                $output .= ($id) ? '<div id="' . esc_attr($id) . '-portfolio-container">' : '<div id="portfolio-container">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $retrive_cats = wp_get_object_terms($post->ID, 'portfolio_cats', array( 'fields' => 'slugs' ));
                    $cats = implode( ' ' , $retrive_cats );
        
                    $output .= ( !empty( $retrive_cats ) ) ? '<div class="' . esc_attr($column) . ' portfolio-item-wrapper ' . $cats . '">' : '<div class="' . esc_attr($column) . ' portfolio-item-wrapper">';
                    $output .= '<div class="portfolio-item">';
                    $output .= '<div class="portfolio-thumb">';
        
                    $images = rwmb_meta( 'rt_portfolio_image_upload', array ( 'type' => 'plupload_image', 'size' => 'portrait-medium' ) );
                    $portfolio_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portrait-medium' );
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        
                    if ($images) {
                        $i = 0;
                        foreach ( $images as $image ) {
                            if ($i == 0) {
                                $output .= '<img src="' . $image['url'] . '" class="img-responsive" alt="' . $image['alt'] . '">';
                                $output .= '<div class="image-overlay"></div>';            
                                $output .= '<a href="' . $image['full_url'];
                            }
                            $i++;
                        }
                    } else {
                        $output .= '<img src="' . $portfolio_thumbnail_src[0] . '" class="img-responsive" alt="">';
                        $output .= '<div class="image-overlay"></div>';            
                        $output .= '<a href="' . $thumbnail_src[0];
                    }
        
                    $output .= ($id) ? '" rel="prettyPhoto[' . str_replace("-", "_", esc_attr($id)) . '_pp_gal]"' : '" rel="prettyPhoto[pp_gal]"'; 
                    $output .= ' class="portfolio-zoom"><i class="fa fa-eye"></i></a>'; 
                    $output .= '<a href="' . get_permalink() . '" class="portfolio-link"><i class="fa fa-link"></i></a>';
                    $output .= '</div>';    
                    $output .= '<div class="portfolio-details">'; 
                    $output .= '<h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>'; 
                    $output .= ($excerpt) ? '<p>' . get_the_excerpt() . '</p>' : '';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
        
                $big = 999999999;
                $paginate_links = paginate_links( array( 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ), 'total' => $the_query->max_num_pages, 'type' => 'list' ) );
        
                $output .= $paginate_links;
        
                $output .= '</div>';
                $output .= '</section>'; 
        
                $output .= '<script type="text/javascript">';
                $output .= 'jQuery(document).ready(function($) {';
                $output .= ($id) ? 'var $container = $("#' . esc_attr($id) . '-portfolio-container");' : 'var $container = $("#portfolio-container");';
                $output .= ($id) ? 'var $filter = $(".' . esc_attr($id) . '-portfolio-filter");' : 'var $filter = $(".portfolio-filter");';
                $output .= '$(window).load(function () {';
                $output .= '$container.isotope({';
                $output .= 'itemSelector: ".portfolio-item-wrapper"';
                $output .= '});';
                $output .= ($id) ? '$(".' . esc_attr($id) . '-portfolio-filter a").click(function () {' : '$(".portfolio-filter a").click(function () {';
                $output .= 'var selector = $(this).attr("data-filter");';
                $output .= '$container.isotope({ filter: selector });';
                $output .= 'return false;';
                $output .= '});';
                $output .= '$filter.find("a").click(function () {';
                $output .= 'var selector = $(this).attr("data-filter");';
                $output .= '$filter.find("a").parent().removeClass("active");';
                $output .= '$(this).parent().addClass("active");';
                $output .= '});';
                $output .= '});';
                $output .= '$(window).smartresize(function () {';
                $output .= '$container.isotope("reLayout");';
                $output .= '});';
                $output .= '});';
                $output .= '</script>';
            } else {
                $output = '<section class="section">';
                $output .= '<div class="container">'; 
                $output .= '<div class="zero-results">';
                $output .= '<h3>No portfolios to display!</h3>';
        
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to create your first portfolio item? <a href="' . admin_url( 'post-new.php?post_type=portfolio' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_portfolio', 'rt_portfolio_shortcode' );
        
        function rt_caroufredsel_portfolio_shortcode(  $atts ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'title' => false,
                    'flush' => false,
                    'items' => 5,
                ), $atts )
            );
        
            $the_query = new WP_Query( array( 'post_type' => 'rt_portfolio', 'posts_per_page' => $items ) );
            $post_count = $the_query->post_count;
            if ( $the_query->have_posts() ) {
                $output = ($id) ? '<section id="' . esc_attr($id) . '" class="caroufredsel-portfolio">' : '<section class="caroufredsel-portfolio">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Recent Works</h5>';
        
                if($post_count > 3) {
                    $output .= '<div class="controls">';
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>' : '<span id="caroufredsel-portfolio-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>'; 
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>' : '<span id="caroufredsel-portfolio-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>';   
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= ($flush) ? '<div class="row flush">' : '<div class="row">'; 
                $output .= ($id) ? '<div id="' . esc_attr($id) . '-container">' : '<div id="caroufredsel-portfolio-container">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $output .= '<div class="col-xs-12 col-sm-6 col-md-4 portfolio-item-wrapper">';
                    $output .= '<div class="portfolio-item">';
                    $output .= '<div class="portfolio-thumb">';
        
                    $images = rwmb_meta( 'rt_portfolio_image_upload', array ( 'type' => 'plupload_image', 'size' => 'portrait-medium' ) );
                    $portfolio_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portrait-medium' );
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        
                    if ($images) {
                        $i = 0;
                        foreach ( $images as $image ) {
                            if ($i == 0) {
                                $output .= '<img src="' . $image['url'] . '" class="img-responsive" alt="' . $image['alt'] . '">';
                                $output .= '<div class="image-overlay"></div>';            
                                $output .= '<a href="' . $image['full_url'];
                            }
                            $i++;
                        }
                    } else {
                        $output .= '<img src="' . $portfolio_thumbnail_src[0] . '" class="img-responsive" alt="">';
                        $output .= '<div class="image-overlay"></div>';            
                        $output .= '<a href="' . $thumbnail_src[0];
                    }
        
                    $output .= ($id) ? '" rel="prettyPhoto[' . str_replace("-", "_", esc_attr($id)) . '_pp_gal]"' : '" rel="prettyPhoto[pp_gal]"'; 
                    $output .= ' class="portfolio-zoom"><i class="fa fa-eye"></i></a>'; 
                    $output .= '<a href="' . get_permalink() . '" class="portfolio-link"><i class="fa fa-link"></i></a>';
                    $output .= '</div>';  
                    $output .= '<div class="portfolio-details">'; 
                    $output .= '<h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>'; 
                    $output .= '<p>' . get_the_excerpt() . '</p>'; 
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</section>'; 
        
                if($post_count > 3) {
                    $output .= '<script type="text/javascript">';
                    $output .= ($id) ? 'var ' . str_replace("-", "_", esc_attr($id)) . ' = function () {' : 'var caroufredselPortfolio = function () {';
                    $output .= ($id) ? 'jQuery("#' . esc_attr($id) . '-container").carouFredSel({' : 'jQuery("#caroufredsel-portfolio-container").carouFredSel({';
                    $output .= 'responsive: true,';
                    $output .= 'scroll: 1,';
                    $output .= 'circular: false,';
                    $output .= 'infinite: false,';
                    $output .= 'items: {';
                    $output .= 'visible: {';
                    $output .= 'min: 1,';
                    $output .= 'max: 3';
                    $output .= '}';
                    $output .= '},';
                    $output .= ($id) ? 'prev: "#' . esc_attr($id) . '-prev",' : 'prev: "#caroufredsel-portfolio-prev",';
                    $output .= ($id) ? 'next: "#' . esc_attr($id) . '-next",' : 'next: "#caroufredsel-portfolio-next",';
                    $output .= 'auto: {';
                    $output .= 'play: false';
                    $output .= '}';
                    $output .= '});';
                    $output .= '};';
                    $output .= 'jQuery(window).load(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselPortfolio();';
                    $output .= '});';
                    $output .= 'jQuery(window).resize(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselPortfolio();';
                    $output .= '});';
                    $output .= '</script>';
                }
            } else {
                $output = '<section class="section">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Recent Works</h5>';
                $output .= '</div>';
                $output .= '<div class="zero-results">';
                $output .= '<h3>No portfolios to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to create your first portfolio item? <a href="' . admin_url( 'post-new.php?post_type=rt_portfolio' ) . '">Get started here.</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_caroufredsel_portfolio', 'rt_caroufredsel_portfolio_shortcode' );
        
        
        
        
        function rt_caroufredsel_posts_shortcode( $atts ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'title' => false,
                    'flush' => false,
                    'posts' => 5,
                    'category_name' => '',
                ), $atts )
            );
        
            global $post;
            $the_query = new WP_Query( array ( 'post_type' => 'post', 'posts_per_page' => $posts, 'category_name' => $category_name ) );
            $post_count = $the_query->post_count;
            if ( $the_query->have_posts() ) {
                $output = ($id) ? '<section id="' . esc_attr($id) . '" class="caroufredsel-posts">' : '<section class="caroufredsel-posts">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Recent Blog Posts</h5>';
        
                if($post_count > 3) {
                    $output .= '<div class="controls">';
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>' : '<span id="caroufredsel-posts-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>'; 
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>' : '<span id="caroufredsel-posts-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>';   
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= ($flush) ? '<div class="row flush">' : '<div class="row">'; 
                $output .= ($id) ? '<div id="' . esc_attr($id) . '-posts-container">' : '<div id="caroufredsel-posts-container">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $output .= '<div class="col-xs-12 col-sm-6 col-md-4">';
                    $output .= '<article class="post">';            
        
                    $post_format = get_post_format($post->ID);
        
                    if ($post_format == 'video') {
                        $post_video_embeded_code = rwmb_meta( 'rt_post_video_embeded_code' );
                        if ( !empty($post_video_embeded_code)) {
                            $output .= '<div class="post-thumb">';
                            $output .= $post_video_embeded_code;
                            $output .= '</div>';
                        } else {
                            $output .= '<a href="' . get_permalink() . '" class="post-thumb fallback-thumb">';
                            $output .= '<span class="fallback-im">';
                            $output .= '<img data-src="holder.js/767x431/auto/textmode:exact" class="img-responsive">';
                            $output .= '</span>';
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-film"></i></span>';
                            $output .= '</a>';
                        }
                    } elseif ($post_format == 'gallery') {
                        $images = rwmb_meta( 'rt_post_image_upload', array ( 'type' => 'plupload_image', 'size' => 'landscape-medium' ) );
                        $total_images = count( $images );
                        if ( $images ) {
                            $output .= '<div class="post-thumb">';
                            $output .= '<div id="carousel-' . $post->ID . '" class="carousel slide" data-ride="carousel">';
                            $output .= '<div class="carousel-inner">';
        
                            $i = 0;
                            foreach ( $images as $image ) {
                                if ($i == 0) {
                                    $output .= '<div class="item active">';
                                    $output .= '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                                    $output .= '</div>';
                                } else {
                                    $output .= '<div class="item">';
                                    $output .= '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                                    $output .= '</div>';
                                }
                                $i++;
                            }
        
                            $output .= '</div>';
                            $output .= '<a class="left carousel-control" href="#carousel-' . $post->ID . '" data-slide="prev">';
                            $output .= '<span class="glyphicon glyphicon-chevron-left"></span>';
                            $output .= '</a>';
                            $output .= '<a class="right carousel-control" href="#carousel-' . $post->ID . '" data-slide="next">';
                            $output .= '<span class="glyphicon glyphicon-chevron-right"></span>';
                            $output .= '</a>';
                            $output .= '</div>';
                            $output .= '</div>';
                        } else {
                            $output .= '<a href="' . get_permalink() . '" class="post-thumb fallback-thumb">';
                            $output .= '<span class="fallback-im">';
                            $output .= '<img data-src="holder.js/767x431/auto/textmode:exact" class="img-responsive">';
                            $output .= '</span>';
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-picture-o"></i></span>';
                            $output .= '</a>';
                        }                                
                    } elseif ($post_format == 'image' || has_post_thumbnail() ) {
                        $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' );
                        if ( !empty($post_thumbnail_src)) {
                            $output .= '<a href="' . get_permalink() . '" class="post-thumb">';
                            $output .= '<img src="' . $post_thumbnail_src[0] . '" class="img-responsive" alt="">';
                            $output .= '</a>';
                        } else {
                            $output .= '<a href="' . get_permalink() . '" class="post-thumb fallback-thumb">';
                            $output .= '<span class="fallback-im">';
                            $output .= '<img data-src="holder.js/767x431/auto/textmode:exact" class="img-responsive">';
                            $output .= '</span>';
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-picture-o"></i></span>';
                            $output .= '</a>';
                        }             
                    } else {
                        $output .= '<a href="' . get_permalink() . '" class="post-thumb fallback-thumb">';
                        $output .= '<span class="fallback-im">';
                        $output .= '<img data-src="holder.js/767x431/auto/textmode:exact" class="img-responsive">';
                        $output .= '</span>';
        
                        if ($post_format == 'aside') {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-file-text-o"></i></span>';
                        } elseif ($post_format == 'audio') {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-music"></i></span>';                       
                        } elseif ($post_format == 'chat') {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-comments"></i></span>';
                        } elseif ($post_format == 'link') {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-link"></i></span>';
                        } elseif ($post_format == 'quote') {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-quote-right"></i></span>';
                        } elseif ($post_format == 'status') {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-file-text-o"></i></span>';
                        } else {
                            $output .= '<span class="fallback-post-type-icon"><i class="fa fa-pencil"></i></span>';
                        }
        
                        $output .= '</a>';           
                    }
        
                    $output .= '<div class="post-details">';
                    $output .= '<h5 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
                    $output .= '<span class="post-meta" ><i class="fa fa-clock-o"></i> ' . get_the_date('j F, Y g:i a') . '</span>';            
                    $output .= '</div>';
                    $output .= '</article>';
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</section>';
        
                if($post_count > 3) {
                    $output .= '<script type="text/javascript">';
                    $output .= ($id) ? 'var ' . str_replace("-", "_", esc_attr($id)) . ' = function () {' : 'var caroufredselPosts = function () {';
                    $output .= ($id) ? 'jQuery("#' . esc_attr($id) . '-posts-container").carouFredSel({' : 'jQuery("#caroufredsel-posts-container").carouFredSel({';
                    $output .= 'responsive: true,';
                    $output .= 'scroll: 1,';
                    $output .= 'circular: false,';
                    $output .= 'infinite: false,';
                    $output .= 'items: {';
                    $output .= 'visible: {';
                    $output .= 'min: 1,';
                    $output .= 'max: 3';
                    $output .= '}';
                    $output .= '},';
                    $output .= ($id) ? 'prev: "#' . esc_attr($id) . '-prev",' : 'prev: "#caroufredsel-posts-prev",';
                    $output .= ($id) ? 'next: "#' . esc_attr($id) . '-next",' : 'next: "#caroufredsel-posts-next",';
                    $output .= 'auto: {';
                    $output .= 'play: false';
                    $output .= '}';
                    $output .= '});';
                    $output .= '};';
                    $output .= 'jQuery(window).load(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselPosts();';
                    $output .= '});';
                    $output .= 'jQuery(window).resize(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselPosts();';
                    $output .= '});';
                    $output .= '</script>';
                }
            } else {
                $output = '<section class="section">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Recent Blog Posts</h5>';
                $output .= '</div>';
                $output .= '<div class="zero-results">';
                $output .= '<h3>No posts to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to publish your first post? <a href="' . admin_url( 'post-new.php' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        
        add_shortcode( 'rt_caroufredsel_posts', 'rt_caroufredsel_posts_shortcode' );
        
        function rt_blog_shortcode( $atts ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'column' => false,
                    'posts' => 10,           
                    'layoutMode' => false,
                    'category_name' => '',
                ), $atts )
            );
        
            // THE QUERY
            global $post;
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $the_query = new WP_Query( array ( 'post_type' => 'post', 'posts_per_page' => $posts, 'category_name' => $category_name, 'paged' => $paged ) );
        
            // THE LOOP
            if ( $the_query->have_posts() ) {
        
                $layout_option = rwmb_meta( 'rt_layout_option' );
        
                if (!$layout_option) {
                    $output = '<div class="container">';
                }
        
                if ($column) {
                    $output .= '<div class="row">';
                    $output .= '<div id="article-container">';
                }
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $format = get_post_format();
        
                    if(!$format) {
                       $format = 'standard';
                    }
        
                    if ($column) {
                        $output .= '<div class="' . esc_attr($column) . ' article-wrap">';
                    }
        
                    $output .= '<article id="post-' . get_the_ID() . '" class="' . implode( ' ' , get_post_class() ) . '">'; 
                    $output .= '<div class="entry-wrap">';
        
                    // ENTRY THUMB
                    if (($format == 'image' || $format == 'standard') && has_post_thumbnail() ) {
                        $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-full' );
        
                        $output .= '<div class="entry-thumb">';
                        $output .= '<img src="' . $post_thumbnail_src[0] . '" class="img-responsive" alt="">';
                        $output .= '</div>';                
                    }
        
                    if ($format == 'audio' ) {
                        $post_audio_url = rwmb_meta( 'rt_post_audio_url' );
                        $post_audio_embeded_code = rwmb_meta( 'rt_post_audio_embeded_code' );
        
                        if ( !empty($post_audio_url) ) {
                            $output .= '<div class="entry-thumb style="padd"">';
                            $output .= do_shortcode('[audio src="' . $post_audio_url . '"]');
                            $output .= '</div>';
                        } else {
                            if ( !empty($post_audio_embeded_code) ) {
                                $output .= '<div class="entry-thumb">';
                                $output .= $post_audio_embeded_code;
                                $output .= '</div>';
                            }
                        }               
                    }
        
                    if ($format == 'video' ) {
                        $post_video_url = rwmb_meta( 'rt_post_video_url' );
                        $post_video_poster = rwmb_meta( 'rt_post_video_poster' );
                        $post_video_embeded_code = rwmb_meta( 'rt_post_video_embeded_code' );
        
                        if ( !empty($post_video_url) ) {
                            $output .= '<div class="entry-thumb">';
                            $output .= do_shortcode('[video src="' . $post_video_url . '" poster="' . $post_video_poster . '"]');
                            $output .= '</div>';
                        } else {
                            if ( !empty($post_video_embeded_code) ) {
                                $output .= '<div class="entry-thumb">';
                                $output .= $post_video_embeded_code;
                                $output .= '</div>';
                            }
                        }               
                    }
        
                    if ($format == 'gallery') {
                        $images = rwmb_meta( 'rt_post_image_upload', array ( 'type' => 'plupload_image', 'size' => 'landscape-full' ) );
                        $total_images = count( $images );
                        if ( $images ) {
                            $output .= '<div class="entry-thumb">';
                            $output .= '<div id="carousel-' . $post->ID . '" class="carousel slide" data-ride="carousel">';
                            $output .= '<div class="carousel-inner">';
        
                            $i = 0;
                            foreach ( $images as $image ) {
                                if ($i == 0) {
                                    $output .= '<div class="item active">';
                                    $output .= '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                                    $output .= '</div>';
                                } else {
                                    $output .= '<div class="item">';
                                    $output .= '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                                    $output .= '</div>';
                                }
                                $i++;
                            }
        
                            $output .= '</div>';
                            $output .= '<a class="left carousel-control" href="#carousel-' . $post->ID . '" data-slide="prev">';
                            $output .= '<span class="glyphicon glyphicon-chevron-left"></span>';
                            $output .= '</a>';
                            $output .= '<a class="right carousel-control" href="#carousel-' . $post->ID . '" data-slide="next">';
                            $output .= '<span class="glyphicon glyphicon-chevron-right"></span>';
                            $output .= '</a>';
                            $output .= '</div>';
                            $output .= '</div>';
                        }                               
                    }
        
        
                    // ENTRY HEADER
        
        
                    if ($format == 'link') {
                        $output .= '<header class="entry-header">';
                            $output .= '<h1 class="entry-title">'; 
        
                        if (function_exists('get_url_in_content')) {
                            $content = get_the_content();
                            $has_url = get_url_in_content( $content );     
        
                            if ($has_url) {
                                $output .= '<a href="' . $has_url . '" rel="bookmark">' . get_the_title() . '</a>';
                            } else {
                                $output .= '<a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a>';
                            }
                        } else {
                            $output .= '<a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a>';
                        }
        
                        $output .= '</h1>';
                        $output .= '</header>';
                    } else {
                        if (!($format == 'quote' || $format == 'status' || $format == 'aside')) {
                            $output .= '<header class="entry-header">';
                            $output .= '<h1 class="entry-title">';  
                            $output .= '<a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a>';
                            $output .= '</h1>';
                            $output .= '</header>';
                        }
                    }
        
                    // ENTRY SUMMSRY/CONTENT
                    if ( is_search() || ($column  && !($format == 'quote') ) ) {
                        $content = get_the_excerpt();
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
        
                        $output .= '<div class="entry-summary">';
                        $output .= $content;
                        $output .= '</div>'; // .entry-summary
                    } else {
                        $content = get_the_content();
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
        
                        $output .= '<div class="entry-content">';              
                        $output .= $content;
                        $output .= wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'retouch' ), 'after' => '</div>', 'echo' => 0 ) );
                        $output .= '</div>'; // .entry-content
                    }
        
                    // ENTRY META
                    $categories_list = get_the_category_list( __( ', ', 'retouch' ) );
                    $tag_list = get_the_tag_list( '', __( ', ', 'retouch' ) );
                    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
                        esc_url( get_permalink() ),
                        esc_attr( get_the_time() ),
                        esc_attr( get_the_date( 'c' ) ),
                        esc_html( get_the_date() )
                    );
                    $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( __( 'View all posts by %s', 'retouch' ), get_the_author() ) ),
                        get_the_author()
                    );
        
                    $output .= '<footer class="entry-meta">';
        
                    if ($format) {
                        $output .= '<span class="post-format">';
        
                        if ($format == 'link') {
                            $output .= '<i class="fa fa-link"></i> <a href="' . esc_url( get_post_format_link( 'link' ) ) . '">' . get_post_format_string( 'link' ) . '</a>';
                        }
        
                        if ($format == 'image') {
                            $output .= '<i class="fa fa-camera-retro"></i> <a href="' . esc_url( get_post_format_link( 'image' ) ) . '">' . get_post_format_string( 'image' ) . '</a>';
                        }
        
                        if ($format == 'video') {
                            $output .= '<i class="fa fa-play"></i> <a href="' . esc_url( get_post_format_link( 'video' ) ) . '">' . get_post_format_string( 'video' ) . '</a>';
                        }
        
                        if ($format == 'quote') {
                            $output .= '<i class="fa fa-quote-right"></i> <a href="' . esc_url( get_post_format_link( 'quote' ) ) . '">' . get_post_format_string( 'quote' ) . '</a>';
                        }
        
                        if ($format == 'gallery') {
                            $output .= '<i class="fa fa-picture-o"></i> <a href="' . esc_url( get_post_format_link( 'gallery' ) ) . '">' . get_post_format_string( 'gallery' ) . '</a>';
                        }
        
                        if ($format == 'aside') {
                            $output .= '<i class="fa fa-dot-circle-o"></i> <a href="' . esc_url( get_post_format_link( 'aside' ) ) . '">' . get_post_format_string( 'aside' ) . '</a>';
                        }
        
                        if ($format == 'status') {
                            $output .= '<i class="fa fa-question"></i> <a href="' . esc_url( get_post_format_link( 'status' ) ) . '">' . get_post_format_string( 'status' ) . '</a>';
                        }
        
                        if ($format == 'chat') {
                            $output .= '<i class="fa fa-comments"></i> <a href="' . esc_url( get_post_format_link( 'chat' ) ) . '">' . get_post_format_string( 'chat' ) . '</a>';
                        }
        
                        $output .= '</span>';
                    }
        
                    if ( $tag_list ) {
                        $output .= '<span class="post-date"><i class="fa fa-clock-o"></i> ' . $date . '</span>';
                        $output .= '<span class="post-author"><span class="glyphicon glyphicon-user"></span> ' . $author . '</span>';
                        $output .= '<span class="post-cats"><i class="fa fa-th-list"></i> ' . $categories_list . '</span>';
                        $output .= '<span class="post-taxs"><i class="fa fa-tags"></i> ' . $tag_list . '</span>';
                    } elseif ( $categories_list ) {
                        $output .= '<span class="post-date"><i class="fa fa-clock-o"></i> ' . $date . '</span>';
                        $output .= '<span class="post-author"><span class="glyphicon glyphicon-user"></span> ' . $author . '</span>';
                        $output .= '<span class="post-cats"><i class="fa fa-th-list"></i> ' . $categories_list . '</span>';
                    } else {
                        $output .= '<span class="post-date"><i class="fa fa-clock-o"></i> ' . $date . '</span>';
                        $output .= '<span class="post-author"><span class="glyphicon glyphicon-user"></span> ' . $author . '</span>';
                    }
        
                    if ( comments_open() ) {
                        $output .= '<span class="comments-link">';
                        $output .= '<span class="glyphicon glyphicon-comment"></span> ' . get_comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'retouch' ) . '</span>', __( '1 Reply', 'retouch' ), __( '% Replies', 'retouch' ) );
                        $output .= '</span>';
                    }
        
                    if ( current_user_can('edit_post') ) {
                        $output .= '<span class="edit-link">';
                        $output .= '<i class="fa fa-pencil"></i> <a class="post-edit-link" href="' . get_edit_post_link() . '">Edit</a>';
                        $output .= '</span>';
                    }
        
                    $output .= '</footer>'; // .entry-meta
        
                    $output .= '</div>'; // .entry-wrap
                    $output .= '</article>'; // article
        
                    if ($column) {
                        $output .= '</div>'; // .col-sm-6
                    }
        
                }
        
                if ($column) {
                    $output .= '</div>'; // .article-container
                    $output .= '</div>'; // .row
        
                    $output .= '<script type="text/javascript">';
                    $output .= 'jQuery(document).ready(function($) {';
                    $output .= 'var $article_container = $("#article-container");';
                    $output .= '$(window).load(function () {';
                    $output .= '$article_container.isotope({';
                    $output .= 'itemSelector: ".article-wrap",';
                    $output .= ($layoutMode) ? 'layoutMode: "' . esc_attr($layoutMode) . '"' : 'layoutMode: "fitRows"'; 
                    $output .= '});';
                    $output .= '});';
                    $output .= '$(window).smartresize(function () {';
                    $output .= '$article_container.isotope("reLayout");';
                    $output .= '});';
                    $output .= '});';
                    $output .= '</script>';
                }
        
                $big = 999999999;
                $paginate_links = paginate_links( array( 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 'format' => '?paged=%#%', 'current' => max( 1, get_query_var('paged') ), 'total' => $the_query->max_num_pages, 'type' => 'list' ) );
        
                $output .= $paginate_links;
        
                if (!$layout_option) {
                    $output .= '</div>'; // .container
                }        
        
            } else {
                $output = '<section class="section">';
                $output .= '<div class="zero-results">';
                $output .= '<h3>No posts to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to publish your first post? <a href="' . admin_url( 'post-new.php' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_blog', 'rt_blog_shortcode' );
        
        
        function rt_caroufredsel_partner_shortcode(  $atts ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'title' => false,
                    'flush' => false,
                    'items' => 5,
                    'category_name' => '',
                ), $atts )
            );
        
            $the_query = new WP_Query( array( 'post_type' => 'rt_partner', 'posts_per_page' => $items, 'partner_cats' => $category_name ) );
            $post_count = $the_query->post_count;
            if ( $the_query->have_posts() ) {
                $output = ($id) ? '<section id="' . esc_attr($id) . '" class="caroufredsel-partner">' : '<section class="caroufredsel-partner">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Our Partners</h5>';
        
                if($post_count > 3) {
                    $output .= '<div class="controls">';
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>' : '<span id="caroufredsel-partner-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>'; 
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>' : '<span id="caroufredsel-partner-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>';   
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= ($flush) ? '<div class="row flush">' : '<div class="row">'; 
                $output .= ($id) ? '<div id="' . esc_attr($id) . '-container">' : '<div id="caroufredsel-partner-container">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    $rt_partner_url     = rwmb_meta( 'rt_partner_url' );
        
                    $output .= '<div class="col-xs-12 col-sm-4 col-md-3 client-wrapper">';
                    $output .= ($rt_partner_url) ? '<a href="' . $rt_partner_url . '">' : '<a href="#">';
                    $output .= '<img class="img-responsive" src="' . $post_thumbnail_src[0] . '" alt=""></a>';
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</section>'; 
        
                if($post_count > 3) {
                    $output .= '<script type="text/javascript">';
                    $output .= ($id) ? 'var ' . str_replace("-", "_", esc_attr($id)) . ' = function () {' : 'var caroufredselPartner = function () {';
                    $output .= ($id) ? 'jQuery("#' . esc_attr($id) . '-container").carouFredSel({' : 'jQuery("#caroufredsel-partner-container").carouFredSel({';
                    $output .= 'responsive: true,';
                    $output .= 'scroll: 1,';
                    $output .= 'circular: false,';
                    $output .= 'infinite: false,';
                    $output .= 'items: {';
                    $output .= 'visible: {';
                    $output .= 'min: 1,';
                    $output .= 'max: 4';
                    $output .= '}';
                    $output .= '},';
                    $output .= ($id) ? 'prev: "#' . esc_attr($id) . '-prev",' : 'prev: "#caroufredsel-partner-prev",';
                    $output .= ($id) ? 'next: "#' . esc_attr($id) . '-next",' : 'next: "#caroufredsel-partner-next",';
                    $output .= 'auto: {';
                    $output .= 'play: false';
                    $output .= '}';
                    $output .= '});';
                    $output .= '};';
                    $output .= 'jQuery(window).load(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselPartner();';
                    $output .= '});';
                    $output .= 'jQuery(window).resize(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselPartner();';
                    $output .= '});';
                    $output .= '</script>';
                }
            } else {
                $output = '<section class="section">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Our Partners</h5>';
                $output .= '</div>';
                $output .= '<div class="zero-results">';
                $output .= '<h3>No partners to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to create your first partner item? <a href="' . admin_url( 'post-new.php?post_type=rt_partner' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_partner', 'rt_caroufredsel_partner_shortcode' );
        
        function rt_caroufredsel_testimonial_shortcode(  $atts ) {
            extract( shortcode_atts(
                array(
                    'id' => false,
                    'title' => false,
                    'flush' => false,
                    'items' => 3,
                    'category_name' => '',
                ), $atts )
            );
        
            $the_query = new WP_Query( array( 'post_type' => 'rt_testimonial', 'posts_per_page' => $items, 'testimonial_cats' => $category_name ) );
            $post_count = $the_query->post_count;
        
            if ( $the_query->have_posts() ) {
                $output = ($id) ? '<section id="' . esc_attr($id) . '" class="section caroufredsel-testimonial">' : '<section class="section caroufredsel-testimonial">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Testimonials</h5>';
        
                if($post_count > 1) {
                    $output .= '<div class="controls">';
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>' : '<span id="caroufredsel-testimonial-prev" class="caroufredsel-prev"><i class="fa fa-angle-left"></i></span>'; 
                    $output .= ($id) ? '<span id="' . esc_attr($id) . '-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>' : '<span id="caroufredsel-testimonial-next" class="caroufredsel-next"><i class="fa fa-angle-right"></i></span>';   
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= ($id) ? '<div id="' . esc_attr($id) . '-container">' : '<div id="caroufredsel-testimonial-container">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $testimonial_company_name = rwmb_meta( 'rt_testimonial_company_name' );
                    $testimonial_url = rwmb_meta( 'rt_testimonial_url' );
                    $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape' );
        
                    $output .= '<div class="testimonial">';
                    $output .= '<div class="testimonial-author">';
                    $output .= '<img class="img-responsive" src="' . $post_thumbnail_src[0] . '" alt="">';
                    $output .= '</div>';
                    $output .= '<div class="testimonial-details">';
                    $output .= '<p>'. get_the_content() .'</p>';
                    $output .= ($testimonial_company_name) ? '<span class="user">' . get_the_title() . ' <span>/</span> <a href="' . $testimonial_url . '">' . $testimonial_company_name . '</a></span>' : '<span class="user">' . get_the_title() . '</span>'; 
                    $output .= '';
                    $output .= '</div>';
                    $output .= '</div>'; // .testimonial
                }
        
                $output .= '</div>';
                $output .= '</section>'; 
        
                if($post_count > 1) {
                    $output .= '<script type="text/javascript">';
                    $output .= ($id) ? 'var ' . str_replace("-", "_", esc_attr($id)) . ' = function () {' : 'var caroufredselTestimonial = function () {';
                    $output .= ($id) ? 'jQuery("#' . esc_attr($id) . '-container").carouFredSel({' : 'jQuery("#caroufredsel-testimonial-container").carouFredSel({';
                    $output .= 'responsive: true,';
                    $output .= 'scroll: 1,';
                    $output .= 'circular: false,';
                    $output .= 'infinite: false,';
                    $output .= 'items: {';
                    $output .= 'visible: {';
                    $output .= 'min: 1,';
                    $output .= 'max: 1';
                    $output .= '}';
                    $output .= '},';
                    $output .= ($id) ? 'prev: "#' . esc_attr($id) . '-prev",' : 'prev: "#caroufredsel-testimonial-prev",';
                    $output .= ($id) ? 'next: "#' . esc_attr($id) . '-next",' : 'next: "#caroufredsel-testimonial-next",';
                    $output .= 'auto: {';
                    $output .= 'play: false';
                    $output .= '}';
                    $output .= '});';
                    $output .= '};';
                    $output .= 'jQuery(window).load(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselTestimonial();';
                    $output .= '});';
                    $output .= 'jQuery(window).resize(function ($) {';
                    $output .= ($id) ? str_replace("-", "_", esc_attr($id)) . '();' : 'caroufredselTestimonial();';
                    $output .= '});';
                    $output .= '</script>';
                }
            } else {
                $output = '<section class="section">';
                $output .= '<div class="subpage-title">';
                $output .= ($title) ? '<h5>' . esc_attr($title) . '</h5>' : '<h5>Our Partners</h5>';
                $output .= '</div>';
                $output .= '<div class="zero-results">';
                $output .= '<h3>No testimonials to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to create your first testimonial item? <a href="' . admin_url( 'post-new.php?post_type=rt_testimonial' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_testimonial', 'rt_caroufredsel_testimonial_shortcode' );
        
        function rt_team_shortcode(  $atts ) {
            extract( shortcode_atts(
                array(
                    'title' => false,
                    'column' => 'col-sm-6 col-md-4',
                    'flush' => false,
                    'items' => 3,
                    'category_name' => '',
                ), $atts )
            );
        
            $the_query = new WP_Query( array( 'post_type' => 'rt_team', 'posts_per_page' => $items, 'team_cats' => $category_name ) );
        
            $post_count = $the_query->post_count;
            if ( $the_query->have_posts() ) {
                $output = '<div class="section team-members">'; 
                if ($title) {
                    $output .= '<div class="subpage-title">';
                    $output .= '<h5>' . esc_attr($title) . '</h5>';
                    $output .= '</div>';
                }
                $output .= ($flush) ? '<div class="row flush">' : '<div class="row">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $member_position = rwmb_meta( 'rt_member_position' );
                    $member_facebook_url = rwmb_meta( 'rt_member_facebook_url' ); 
                    $member_google_plus_url = rwmb_meta( 'rt_member_google_plus_url' );
                    $member_twitter_url = rwmb_meta( 'rt_member_twitter_url' );
                    $member_linkedin_url = rwmb_meta( 'rt_member_linkedin_url' ); 
                    $member_pinterest_url = rwmb_meta( 'rt_member_pinterest_url' );
        
                    $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portrait-medium' );
        
                    $output .= '<div class="' . esc_attr($column) . '">';
                    $output .= '<div class="team-member">';
                    $output .= '<div class="member-thumb">';
                    $output .= '<img src="' . $post_thumbnail_src[0] . '" class="img-responsive" alt="">';
                    $output .= '</div>';
                    $output .= '<div class="member-details">';
                    $output .= '<h4 class="member-name">' . get_the_title() . '</h4>';
        
                    if ($member_position) {
                        $output .= '<span class="position">' . $member_position . '</span>';
                    }
        
                    $output .= get_the_content();
                    $output .= '</div>';
        
                    if ($member_facebook_url || $member_google_plus_url || $member_linkedin_url || $member_pinterest_url || $member_twitter_url) {
                        $output .= '<ul class="social-links">';
                    }
        
                    if ($member_facebook_url) {
                         $output .= '<li><a class="facebook" href="' . $member_facebook_url . '"><i class="fa fa-facebook"></i></a></li>';
                    }
                    if ($member_google_plus_url) {
                        $output .= '<li><a class="google-plus" href="' . $member_google_plus_url . '"><i class="fa fa-google-plus"></i></a></li>';
                    }
                    if ($member_twitter_url) {
                        $output .= '<li><a class="twitter" href="' . $member_twitter_url . '"><i class="fa fa-twitter"></i></a></li>';
                    }
                    if ($member_pinterest_url) {
                        $output .= '<li><a class="pinterest" href="' . $member_pinterest_url . '"><i class="fa fa-pinterest"></i></a></li>';
                    }
                    if ($member_linkedin_url) {
                        $output .= '<li><a class="linkedin" href="' . $member_linkedin_url . '"><i class="fa fa-linkedin"></i></a></li>';
                    }
        
                    if ($member_facebook_url || $member_google_plus_url || $member_linkedin_url || $member_pinterest_url || $member_twitter_url) {
                        $output .= '</ul>';
                    }
        
                    $output .= '</div>';
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
            } else {
                $output = '<section class="section">';
                if ($title) {
                    $output .= '<div class="subpage-title">';
                    $output .= '<h5>' . esc_attr($title) . '</h5>';
                    $output .= '</div>';
                }
                $output .= '<div class="zero-results">';
                $output .= '<h3>No teams to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to create your first team item? <a href="' . admin_url( 'post-new.php?post_type=rt_team' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_team', 'rt_team_shortcode' );
        
        function rt_price_shortcode(  $atts ) {
            extract( shortcode_atts(
                array(
                    'title' => false,
                    'column' => 'col-sm-6 col-md-4',
                    'flush' => false,
                    'items' => 3,
                    'category_name' => '',
                ), $atts )
            );
        
            $the_query = new WP_Query( array( 'post_type' => 'rt_price', 'posts_per_page' => $items, 'price_cats' => $category_name ) ); 
            $post_count = $the_query->post_count;
        
            if ( $the_query->have_posts() ) {
                $output = '<div class="section pricing-tables">'; 
                if ($title) {
                    $output .= '<div class="subpage-title">';
                    $output .= '<h5>' . esc_attr($title) . '</h5>';
                    $output .= '</div>';
                }
                $output .= ($flush) ? '<div class="row flush">' : '<div class="row">'; 
        
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
        
                    $price_currency = rwmb_meta( 'rt_price_currency' ); 
                    $price_value = rwmb_meta( 'rt_price_value' );            
                    $price_time = rwmb_meta( 'rt_price_time' ); 
                    $price_color = rwmb_meta( 'rt_price_color' );
                    $price_button_name = rwmb_meta( 'rt_price_button_name' );
                    $price_button_class = rwmb_meta( 'rt_price_button_class' );
                    $price_button_url = rwmb_meta( 'rt_price_button_url' );
        
                    $output .= '<div class="' . esc_attr($column) . '">';
                    $output .= '<div class="pricing">';
                    $output .= '<div class="p-header">';
                    $output .= '';
                    $output .= ($price_color) ? '<div class="title"  style="background-color: ' . $price_color . '">' : '<div class="title">';
                    $output .= '<h4>' . get_the_title() . '</h4>';
                    $output .= '</div>';
                    $output .= '<div class="price">';
                    $output .= ($price_currency) ? '<span class="dollar">' . $price_currency . '</span>' : '<span class="dollar">$</span>';
                    $output .= '';
                    $output .= ($price_value) ? '<h2>' . $price_value . '</h2>' : '<h2>0</h2>';
                    $output .= '';
                    $output .= ($price_time) ? '<span class="per">/' . $price_time . '</span>' : '<span class="per">/month</span>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="details">';
                    $output .= get_the_content();
                    $output .= '</div>';
                    $output .= '<div class="p-footer">'; 
                    $output .= ($price_button_url) ? '<a href="' . $price_button_url . '" class="' : '<a href="http://www.example.com/" class="'; 
                    $output .= ($price_button_class) ? $price_button_class : 'btn btn-flat flat-color'; 
                    $output .= ($price_button_name) ? '">' . $price_button_name . '</a>' : '">Purchase Now</a>'; 
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                }
        
                $output .= '</div>';
                $output .= '</div>';
            } else {
                $output = '<section class="section">';
                if ($title) {
                    $output .= '<div class="subpage-title">';
                    $output .= '<h5>' . esc_attr($title) . '</h5>';
                    $output .= '</div>';
                }
                $output .= '<div class="zero-results">';
                $output .= '<h3>No prices to display!</h3>';
                if ( current_user_can( 'edit_posts' ) ) {
                    $output .= '<p>Ready to create your first price item? <a href="' . admin_url( 'post-new.php?post_type=rt_price' ) . '">Get started here</a></p>';
                } else {
                    $output .= '<p>Apologies, but no results were found.</p>';
                }
        
                $output .= '</div>';
                $output .= '</section>';
            }
            wp_reset_postdata();
        
            return $output;
        }
        add_shortcode( 'rt_price', 'rt_price_shortcode' );
        
        
        add_action( 'admin_print_scripts', 'display_metaboxes', 1000 );
        
        function display_metaboxes() {
    ?>
    <script type="text/javascript">
        <!--//--><![CDATA[//><!--
        jQuery(document).ready(function ($) {
            var ids = "#format-aside, #format-gallery, #format-quote, #format-audio, #format-video, #format-link";
            var displayMetaboxes = function () {
            $(ids).hide();
            var selectedElt = $("input[name='post_format']:checked").attr("id");
            if (selectedElt == 'post-format-aside') {
                $("#format-aside").fadeIn();
            }
            if (selectedElt == 'post-format-gallery') {
                $("#format-gallery").fadeIn();
            }
            if (selectedElt == 'post-format-quote') {
                $("#format-quote").fadeIn();
            }
            if (selectedElt == 'post-format-video') {
                $("#format-video").fadeIn();
            }
            if (selectedElt == 'post-format-audio') {
                $("#format-audio").fadeIn();
            }
            if (selectedElt == 'post-format-link') {
                $("#format-link").fadeIn();
            }
        }
        
            displayMetaboxes();
            $("input[name='post_format']").change(function () {
                displayMetaboxes();
            });
        });
        //--><!]]>
    </script>
    <?php
         }
        
        
        if ( ! function_exists( 'is_version' ) ) {
            function is_version( $version = '3.8' ) {
                global $wp_version;
        
                if ( version_compare( $wp_version, $version, '>=' ) ) {
                    return true;
                }
                return false;
            }
        }
        
        
        function codex_custom_post_type() {
          $labels = array(
            'name'               => 'Portfolios',
            'singular_name'      => 'Portfolio',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Portfolio',
            'edit_item'          => 'Edit Portfolio',
            'new_item'           => 'New Portfolio',
            'all_items'          => 'All Portfolios',
            'view_item'          => 'View Portfolio',
            'search_items'       => 'Search Portfolios',
            'not_found'          => 'No portfolios found',
            'not_found_in_trash' => 'No portfolios found in Trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Portfolios'
          );
        
          $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'portfolio' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
          );
          if (is_version()) {
              $args['menu_icon'] = 'dashicons-portfolio';
          }
        
          register_post_type( 'rt_portfolio', $args );
        
            $labels = array(
            'name'               => 'Team Members',
            'singular_name'      => 'Team Member',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Team Member',
            'edit_item'          => 'Edit Team Member',
            'new_item'           => 'New Team Member',
            'all_items'          => 'All Team Members',
            'view_item'          => 'View Team Member',
            'search_items'       => 'Search Team Members',
            'not_found'          => 'No team members found',
            'not_found_in_trash' => 'No team members found in Trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Team Members'
          );
        
          $args = array(
            'labels'             => $labels,
            'public'             => true,    
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'team' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
          );
          if (is_version()) {
              $args['menu_icon'] = 'dashicons-groups';
          }
        
          register_post_type( 'rt_team', $args );
        
          $labels = array(
            'name'               => 'Partners',
            'singular_name'      => 'Partner',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Partner',
            'edit_item'          => 'Edit Partner',
            'new_item'           => 'New Partner',
            'all_items'          => 'All Partners',
            'view_item'          => 'View Partner',
            'search_items'       => 'Search Partners',
            'not_found'          => 'No Partners found',
            'not_found_in_trash' => 'No Partners found in Trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Partners'
          );
        
          $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'partner' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'thumbnail' )
          );
          if (is_version()) {
              $args['menu_icon'] = 'dashicons-smiley';
          }
        
          register_post_type( 'rt_partner', $args );
        
            $labels = array(
            'name'               => 'Testimonials',
            'singular_name'      => 'Testimonial',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Testimonial',
            'edit_item'          => 'Edit Testimonial',
            'new_item'           => 'New Testimonial',
            'all_items'          => 'All Testimonials',
            'view_item'          => 'View Testimonial',
            'search_items'       => 'Search Testimonials',
            'not_found'          => 'No testimonials found',
            'not_found_in_trash' => 'No testimonials found in Trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Testimonials'
          );
        
          $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'testimonial' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
          );
        
          if (is_version()) {
              $args['menu_icon'] = 'dashicons-admin-comments';
          }
        
          register_post_type( 'rt_testimonial', $args );
        
            $labels = array(
            'name'               => 'Pricing Tables',
            'singular_name'      => 'Pricing Table',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Pricing Table',
            'edit_item'          => 'Edit Pricing Table',
            'new_item'           => 'New Pricing Table',
            'all_items'          => 'All Pricing Tables',
            'view_item'          => 'View Pricing Table',
            'search_items'       => 'Search Pricing Tables',
            'not_found'          => 'No pricing table found',
            'not_found_in_trash' => 'No pricing table found in Trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Pricing Tables'
          );
        
          $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'price' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
          );
          if (is_version()) {
              $args['menu_icon'] = 'dashicons-list-view';
          }
        
          register_post_type( 'rt_price', $args );
        }
        
        add_action( 'init', 'codex_custom_post_type' );
        
        // hook into the init action and call create_portfolio_taxonomies when it fires
        add_action( 'init', 'create_portfolio_taxonomies', 0 );
        
        // create two taxonomies, category and skills for the post type "portfolio"
        function create_portfolio_taxonomies() {
            // Add new taxonomy, make it hierarchical (like categories)
            $labels = array(
                'name'              => _x( 'Categories', 'taxonomy general name' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
                'search_items'      => __( 'Search Categories' ),
                'all_items'         => __( 'All Categories' ),
                'parent_item'       => __( 'Parent Category' ),
                'parent_item_colon' => __( 'Parent Category:' ),
                'edit_item'         => __( 'Edit Category' ),
                'update_item'       => __( 'Update Category' ),
                'add_new_item'      => __( 'Add New Category' ),
                'new_item_name'     => __( 'New Category Name' ),
                'menu_name'         => __( 'Category' ),
            );
        
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'portfolio_cats' ),
            );
        
        
            register_taxonomy( 'portfolio_cats', array( 'rt_portfolio' ), $args );
        
            // Add new taxonomy, make it hierarchical (like categories)
            $labels = array(
                'name'              => _x( 'Categories', 'taxonomy general name' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
                'search_items'      => __( 'Search Categories' ),
                'all_items'         => __( 'All Categories' ),
                'parent_item'       => __( 'Parent Category' ),
                'parent_item_colon' => __( 'Parent Category:' ),
                'edit_item'         => __( 'Edit Category' ),
                'update_item'       => __( 'Update Category' ),
                'add_new_item'      => __( 'Add New Category' ),
                'new_item_name'     => __( 'New Category Name' ),
                'menu_name'         => __( 'Category' ),
            );
        
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'team_cats' ),
            );
        
        
            register_taxonomy( 'team_cats', array( 'rt_team' ), $args );
        
            // Add new taxonomy, make it hierarchical (like categories)
            $labels = array(
                'name'              => _x( 'Categories', 'taxonomy general name' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
                'search_items'      => __( 'Search Categories' ),
                'all_items'         => __( 'All Categories' ),
                'parent_item'       => __( 'Parent Category' ),
                'parent_item_colon' => __( 'Parent Category:' ),
                'edit_item'         => __( 'Edit Category' ),
                'update_item'       => __( 'Update Category' ),
                'add_new_item'      => __( 'Add New Category' ),
                'new_item_name'     => __( 'New Category Name' ),
                'menu_name'         => __( 'Category' ),
            );
        
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'testimonial_cats' ),
            );
        
        
            register_taxonomy( 'testimonial_cats', array( 'rt_testimonial' ), $args );
        
                // Add new taxonomy, make it hierarchical (like categories)
            $labels = array(
                'name'              => _x( 'Categories', 'taxonomy general name' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
                'search_items'      => __( 'Search Categories' ),
                'all_items'         => __( 'All Categories' ),
                'parent_item'       => __( 'Parent Category' ),
                'parent_item_colon' => __( 'Parent Category:' ),
                'edit_item'         => __( 'Edit Category' ),
                'update_item'       => __( 'Update Category' ),
                'add_new_item'      => __( 'Add New Category' ),
                'new_item_name'     => __( 'New Category Name' ),
                'menu_name'         => __( 'Category' ),
            );
        
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'partner_cats' ),
            );
        
        
            register_taxonomy( 'partner_cats', array( 'rt_partner' ), $args );
        
               // Add new taxonomy, make it hierarchical (like categories)
            $labels = array(
                'name'              => _x( 'Categories', 'taxonomy general name' ),
                'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
                'search_items'      => __( 'Search Categories' ),
                'all_items'         => __( 'All Categories' ),
                'parent_item'       => __( 'Parent Category' ),
                'parent_item_colon' => __( 'Parent Category:' ),
                'edit_item'         => __( 'Edit Category' ),
                'update_item'       => __( 'Update Category' ),
                'add_new_item'      => __( 'Add New Category' ),
                'new_item_name'     => __( 'New Category Name' ),
                'menu_name'         => __( 'Category' ),
            );
        
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'price_cats' ),
            );
        
        
            register_taxonomy( 'price_cats', array( 'rt_price' ), $args );
        
            // Add new taxonomy, NOT hierarchical (like tags)
            $labels = array(
                'name'                       => _x( 'Skills', 'taxonomy general name' ),
                'singular_name'              => _x( 'Skill', 'taxonomy singular name' ),
                'search_items'               => __( 'Search Skills' ),
                'popular_items'              => __( 'Popular Skills' ),
                'all_items'                  => __( 'All Skills' ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit Skill' ),
                'update_item'                => __( 'Update Skill' ),
                'add_new_item'               => __( 'Add New Skill' ),
                'new_item_name'              => __( 'New Skill Name' ),
                'separate_items_with_commas' => __( 'Separate skills with commas' ),
                'add_or_remove_items'        => __( 'Add or remove skills' ),
                'choose_from_most_used'      => __( 'Choose from the most used skills' ),
                'not_found'                  => __( 'No skills found.' ),
                'menu_name'                  => __( 'Skills' ),
            );
        
            $args = array(
                'hierarchical'          => false,
                'labels'                => $labels,
                'show_ui'               => true,
                'show_admin_column'     => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var'             => true,
                'rewrite'               => array( 'slug' => 'skills' ),
            );
        
            register_taxonomy( 'skills', 'rt_portfolio', $args );
        }
        
        function portfolio_excerpt_length($length) {
            global $post;
            if ($post->post_type == 'rt_portfolio') {
                return 5;
            } else {
                return 50;
            }    
        }
        add_filter('excerpt_length', 'portfolio_excerpt_length');
        
        
        /**
         * Recent_Posts widget class
         *
         * @since 2.8.0
         */
        class WP_Widget_Featured_Posts extends WP_Widget {
                function __construct() {
                        $widget_ops = array('classname' => 'widget_featured_entries', 'description' => __( "Your site&#8217;s most featured Posts.") );
                        parent::__construct('featured-posts', __('Featured Posts'), $widget_ops);
                        $this->alt_option_name = 'widget_featured_entries';
                        add_action( 'save_post', array($this, 'flush_widget_cache') );
                        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
                        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
                }
                function widget($args, $instance) {
                        $cache = wp_cache_get('widget_featured_posts', 'widget');
                        if ( !is_array($cache) )
                                $cache = array();
                        if ( ! isset( $args['widget_id'] ) )
                                $args['widget_id'] = $this->id;
                        if ( isset( $cache[ $args['widget_id'] ] ) ) {
                                echo $cache[ $args['widget_id'] ];
                                return;
                        }
                        ob_start();
                        extract($args);
                        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Featured Posts' );
                        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
                        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
                        if ( ! $number )
                                $number = 10;
                        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
                        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
                        if ($r->have_posts()) :
    ?>
    <?php echo $before_widget; ?>
    <?php if ( $title ) echo $before_title . $title . $after_title; ?>
    <ul class="recent-posts">



        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
        <?php $images = rwmb_meta( 'rt_post_image_upload', array ( 'type' => 'plupload_image', 'size' => 'thumbnail' ) ); ?>
        <li>
            <div class="post-thumb">
                <?php if ( has_post_thumbnail() ) { ?>
                <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
                <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
                <?php
                    } elseif ($images) {
                                                   $i = 0;
                                       foreach ( $images as $image ) {
                                           if ($i == 0) {
                                               $post_thumb = '<img src="' . $image['url'] . '" class="img-responsive" alt="">';
                    
                                           }
                                           $i++;
                                       }
                    
                                       echo $post_thumb;
                    
                                               } else {
                ?>
                <?php $post_format = get_post_format($post->ID); ?>

                <a href="<?php echo esc_url( get_post_format_link( $post_format ) ); ?>" class="fallback-post-type-icon">

                    <?php if ($post_format == 'link') { ?>
                    <i class="fa fa-link"></i>
                    <?php } elseif ($post_format == 'image') { ?>
                    <i class="fa fa-camera"></i>
                    <?php } elseif ($post_format == 'gallery') { ?>
                    <i class="fa fa-picture-o"></i>
                    <?php } elseif ($post_format == 'chat') { ?>
                    <i class="fa fa-comments"></i>
                    <?php } elseif ($post_format == 'aside') { ?>
                    <i class="fa fa-file-text-o"></i>
                    <?php } elseif ($post_format == 'audio') { ?>
                    <i class="fa fa-music"></i>
                    <?php } elseif ($post_format == 'quote') { ?>
                    <i class="fa fa-quote-right"></i>
                    <?php } elseif ($post_format == 'video') { ?>
                    <i class="fa fa-play"></i>
                    <?php } elseif ($post_format == 'status') { ?>
                    <i class="fa fa-file-o"></i>
                    <?php } else { ?>
                    <i class="fa fa-pencil"></i>
                    <?php } ?>
                </a>
                <?php } ?>
            </div>
            <div class="post-details">
                <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                <?php if ( $show_date ) : ?>
                <small class="post-date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></small>
                <?php endif; ?>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php echo $after_widget; ?>
    <?php
                // Reset the global $the_post as this query will have stomped on it
                wp_reset_postdata();
                endif;
                $cache[$args['widget_id']] = ob_get_flush();
                wp_cache_set('widget_featured_posts', $cache, 'widget');
        }
        function update( $new_instance, $old_instance ) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);
                $instance['number'] = (int) $new_instance['number'];
                $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
                $this->flush_widget_cache();
                $alloptions = wp_cache_get( 'alloptions', 'options' );
                if ( isset($alloptions['widget_featured_entries']) )
                        delete_option('widget_featured_entries');
                return $instance;
        }
        function flush_widget_cache() {
                wp_cache_delete('widget_featured_posts', 'widget');
        }
        function form( $instance ) {
                $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
                $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    </p>
    <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
    </p>
    <?php
                }
        }
        
        // register Foo_Widget widget
        function register_foo_widget() {
            register_widget( 'WP_Widget_Featured_Posts' );
        }
        add_action( 'widgets_init', 'register_foo_widget' );
        
        
        
        // Add specific CSS class by filter
        add_filter('body_class','my_class_names');
        function my_class_names($classes) {
            global $data; 
            $boxed_layout = $data['switch_boxed_layout'];
        
            // add 'class-name' to the $classes array
            $classes[] = ( $boxed_layout ) ? 'l-boxed retouch-background' : 'l-wide';
        
            // return the $classes array
            return $classes;
        }
        
        function my_styles_method() {
            global $data; 
            $background_pattern                = $data['background_pattern'];
            $background_image                  = $data['background_image'];
            $background_repeat                 = $data['background_repeat'];
            $background_position               = $data['background_position'];
            $background_size                   = $data['background_size'];
            $background_attachment             = $data['background_attachment'];
            $predefind_skin                    = $data['predefind_skin'];
            $color_skin                        = $data['color_skin'];
            $custom_css                        = stripslashes($data['custom_css']);
        
            $retouch_background_image          = ( $background_image ) ? $background_image : $background_pattern;
            $retouch_background_repeat         = ( $background_repeat  ) ? $background_repeat : 'repeat';
            $retouch_background_position       = ( $background_position ) ? $background_position : '0% 0%';
            $retouch_background_size           = ( $background_size ) ? $background_size : 'auto';
            $retouch_background_attachment     = ( $background_attachment ) ? $background_attachment : 'scroll';
            $retouch_color_skin                = ( $color_skin ) ? $color_skin : $predefind_skin;
        
            $inline_css = "
                .retouch-background {
                    background-image: url('{$retouch_background_image}');
                    background-repeat: {$retouch_background_repeat};
                    background-position: {$retouch_background_position};
                    background-size: {$retouch_background_size};
                    background-attachment: {$retouch_background_attachment};
                }";
        
            $inline_css .= "#respond input#submit,
        .widget_calendar caption,
        #masthead .navbar-toggle:hover, 
        #masthead .navbar-toggle:focus,
        .flat-color, 
        .flat-color.btn-bordered:hover,
        .controls .caroufredsel-prev, 
        .controls .caroufredsel-next,
        .portfolio-item .portfolio-thumb .image-overlay,
        .portfolio-item .portfolio-thumb .portfolio-zoom:hover, 
        .portfolio-item .portfolio-thumb .portfolio-link:hover,
        #toTopHover,
        .portfolio .nav-pills > li.active > a,
        .portfolio .nav-pills > li.active > a:hover,
        .portfolio .nav-pills > li.active > a:focus,
        .pricing .price,
        .rt-error404,
        .fallback-post-type-icon,
        .the-icons a:hover,
        .team-member .social-links {
            background-color: {$retouch_color_skin};
        }
        #respond input#submit,
        #masthead .navbar-toggle:hover, 
        #masthead .navbar-toggle:focus,
        .flat-color,
        .flat-color:hover,
        .flat-color:active,
        .portfolio .nav-pills > li.active > a,
        .portfolio .nav-pills > li.active > a:hover,
        .portfolio .nav-pills > li.active > a:focus {
            border-color: {$retouch_color_skin};
        }
        #respond input#submit:hover, 
        #respond input#submit:active,
        a:hover, 
        a:focus,
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:hover,
        .nav-tabs > li.active > a:focus,
        .flat-color:hover,  
        .flat-color.btn-bordered,
        #footer-2 a:hover,
        .service .service-icon {
            color: {$retouch_color_skin};
        }
        @media (min-width: 768px) {
            #masthead .navbar-nav > li > a:hover, 
            #masthead .navbar-nav > li > a:focus,
            #masthead .navbar-nav > .open > a, 
            #masthead .navbar-nav > .open > a:hover, 
            #masthead .navbar-nav > .open > a:focus {
                color: {$retouch_color_skin};
            }
            #masthead .navbar-nav > .active > a, 
            #masthead .navbar-nav > .active > a:hover, 
            #masthead .navbar-nav > .active > a:focus,
            #masthead .navbar-nav > .current-menu-parent > a, 
            #masthead .navbar-nav > .current-menu-parent > a:hover, 
            #masthead .navbar-nav > .current-menu-parent > a:focus,
            #masthead.affix .navbar-nav > .active > a, 
            #masthead.affix .navbar-nav > .active > a:hover, 
            #masthead.affix .navbar-nav > .active > a:focus,
            #masthead .navbar-nav > .active > a:after,
            #masthead .navbar-nav > .current-menu-parent > a:after {
                border-bottom-color: {$retouch_color_skin};
            }
        
        
            #masthead .navbar-nav > li .dropdown-menu {
                border-top-color: {$retouch_color_skin};
            }
            #masthead .dropdown-menu > .active > a, 
            #masthead .dropdown-menu > .active > a:hover, 
            #masthead .dropdown-menu > .active > a:focus, 
            #masthead .dropdown-menu > li > a:hover, 
            #masthead .dropdown-menu > li > a:focus {
                background-color: {$retouch_color_skin};
                border-color: {$retouch_color_skin};
            }
        }";
        
        
            if ($custom_css) {
                $inline_css .= $custom_css;
            }
        
        
            wp_add_inline_style( 'retouch-style', $inline_css );
        }
        add_action( 'wp_enqueue_scripts', 'my_styles_method' );
        
        function rt_color_skin() {
            global $data; 
            $switch_scroll_top = stripslashes($data['switch_scroll_top']);
        
            if ($switch_scroll_top) {
                echo '<script type="text/javascript">';
                echo 'jQuery(document).ready(function ($) {
            $().UItoTop({ easingType: "easeOutQuart" });
        });';
                echo '</script>';
            }
        }
        add_action('wp_footer', 'rt_color_skin', 100);
    