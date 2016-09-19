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
    <?php dynamic_sidebar( $sidebar ); ?>
</div><!-- #secondary -->
<?php endif; ?>