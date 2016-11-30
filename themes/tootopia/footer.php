<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage ReTouch
 * @since ReTouch 1.0
 */
?>
	 <?php global $data; ?>

	<footer id="colophon" role="contentinfo">


<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>


        <div id="footer-2" class="footer-2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5">
                        <div class="site-info">
                        	Coryright &copy;2016 土逗公社 版权所有 | 粤ICP备16092561号-1
		                </div>
                    </div>
                    <div class="col-xs-12 col-sm-7">
                        <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu', 'depth' => 1 ) ); ?>
                    </div>
                </div>
            </div>
        </div>



	</footer><!-- #colophon -->

</div><!-- #page -->

<?php $switch_style_switcher = stripslashes($data['switch_style_switcher']); ?>

<?php if ($switch_style_switcher) { ?>

<div id="skin-chooser-wrap" class="skin-chooser-wrap hidden-xs">
                <span class="skin-chooser-toggle"><i class="fa fa-cog"></i></span>

                <section class="section">
                    <h4>Style Switcher</h4>
                </section>

                <section class="section">
                    <h6>Layout Options</h6>
                <p>Which layout option you want to use?</p>
                    <p>
                        <a id="l-boxed" class="btn btn-default btn-xs" href="#" role="button">Boxed</a>
                    <em>or</em>
                <a id="l-wide" class="btn btn-primary btn-xs" href="#" role="button">Wide</a>
                </p>
                </section>
                <section class="section">
                    <h6>Color Schemes</h6>
                <p>Which theme color you want to use? Here are some predefined colors.</p>

                <ul class="list-inline">
                    <li>
                        <div id="color-skin-1" class="color-skin active"></div>
                    </li>
                    <li>
                        <div id="color-skin-2" class="color-skin"></div>
                    </li>
                    <li>
                        <div id="color-skin-3" class="color-skin"></div>
                    </li>
                    <li>
                        <div id="color-skin-4" class="color-skin"></div>
                    </li>
                    <li>
                        <div id="color-skin-5" class="color-skin"></div>
                    </li>
                </ul>
                </section>
                <section class="section">
                    <h6>Patterns</h6>
                <p>You can choose between four patterns.</p>

                <ul class="list-inline">
                    <li>
                        <div id="color-pattern-1" class="color-pattern active"></div>
                    </li>
                    <li>
                        <div id="color-pattern-2" class="color-pattern"></div>
                    </li>
                    <li>
                        <div id="color-pattern-3" class="color-pattern"></div>
                    </li>
                    <li>
                        <div id="color-pattern-4" class="color-pattern"></div>
                    </li>
                    <li>
                        <div id="color-pattern-5" class="color-pattern"></div>
                    </li>
                </ul>
                </section>
            </div>
            <!-- /#skin-chooser-wrap -->

<?php } ?>

<?php echo stripslashes($data['google_analytics']); ?>

<?php wp_footer(); ?>
</body>
</html>
