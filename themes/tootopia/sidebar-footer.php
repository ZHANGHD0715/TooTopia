<?php
    /**
     * Footer widget areas
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>
<?php
    /*
     * The footer widget area is triggered if any of the areas
     * have widgets. So let's check that first.
     *
     * If none of the sidebars have widgets, then let's bail early.
     */
    if (   ! is_active_sidebar( 'sidebar-3'  )
        && ! is_active_sidebar( 'sidebar-4' )
        && ! is_active_sidebar( 'sidebar-5'  )
        && ! is_active_sidebar( 'sidebar-6'  )
    )
        return;
    // If we get this far, we have widgets. Let do this.
?>
<div id="supplementary">
    <div class="container">
        <div class="row">
            <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
            <div class="col-md-3">
                <div id="first" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-3' ); ?>
                </div><!-- #first .widget-area -->
            </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
            <div class="col-md-3">
                <div id="second" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-4' ); ?>
                </div><!-- #second .widget-area -->
            </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
            <div class="col-md-3">
                <div id="third" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-5' ); ?>
                </div><!-- #third .widget-area -->
            </div>
            <?php endif; ?>
            <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
            <div class="col-md-3">
                <div id="fourth" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-6' ); ?>
                </div><!-- #third .widget-area -->
            </div>
            <?php endif; ?>
        </div>
    </div>
</div><!-- #supplementary -->