<?php
    /**
     * Template for displaying search forms in ReTouch
     *
     * @package WordPress
     * @subpackage ReTouch
     * @since ReTouch 1.0
     */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( '请居中光标并搜索关键词', 'retouch' ); ?>" />
</form>
