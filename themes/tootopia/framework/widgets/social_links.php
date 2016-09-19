<?php
add_action('widgets_init', 'social_links_load_widgets');

function social_links_load_widgets()
{
	register_widget('Social_Links_Widget');
}

class Social_Links_Widget extends WP_Widget {

	function Social_Links_Widget()
	{
		$widget_ops = array('classname' => 'social_links', 'description' => '');

		$control_ops = array('id_base' => 'social_links-widget');

		$this->WP_Widget('social_links-widget', 'ReTouch: Social Links', $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		global $data;

		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}

		if(!isset($instance['linktarget'])) {
			$instance['linktarget'] = '';
		}

		?>
		<ul class="social-links <?php echo $color_scheme; ?>">
			<?php if($instance['fb_link']): ?>
            <li>
                <a class="facebook" href="<?php echo $instance['fb_link']; ?>"  target="<?php echo $instance['linktarget']; ?>"><i class="fa fa-facebook"></i></a>
            </li>
			<?php endif; ?>

			<?php if($instance['twitter_link']): ?>
            <li>
                <a class="twitter" href="<?php echo $instance['twitter_link']; ?>"  target="<?php echo $instance['linktarget']; ?>"><i class="fa fa-twitter"></i></a>
            </li>
			<?php endif; ?>

			<?php if($instance['google_link']): ?>
            <li>
                <a class="google-plus" href="<?php echo $instance['google_link']; ?>"  target="<?php echo $instance['linktarget']; ?>"><i class="fa fa-google-plus"></i></a>
            </li>
			<?php endif; ?>

            <?php if($instance['pinterest_link']): ?>
            <li>
                <a class="pinterest" href="<?php echo $instance['pinterest_link']; ?>"  target="<?php echo $instance['linktarget']; ?>"><i class="fa fa-pinterest"></i></a>
            </li>
			<?php endif; ?>

			<?php if($instance['linkedin_link']): ?>
            <li>
                <a class="linkedin" href="<?php echo $instance['linkedin_link']; ?>"  target="<?php echo $instance['linktarget']; ?>"><i class="fa fa-linkedin"></i></a>
            </li>
			<?php endif; ?>
			
		</ul>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
        $instance['linktarget'] = $new_instance['linktarget'];
		$instance['fb_link'] = $new_instance['fb_link'];
		$instance['twitter_link'] = $new_instance['twitter_link'];
		$instance['google_link'] = $new_instance['google_link'];
		$instance['linkedin_link'] = $new_instance['linkedin_link'];
		$instance['pinterest_link'] = $new_instance['pinterest_link'];
		$instance['flickr_link'] = $new_instance['flickr_link'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Get Social', 'color_scheme' => 'Light', 'linktarget' => '', 'rss_link' => '', 'fb_link' => '', 'twitter_link' => '', 'dribbble_link'=> '', 'google_link' => '', 'linkedin_link' => '', 'blogger_link' => '', 'tumblr_link' => '', 'reddit_link' => '', 'yahoo_link' => '', 'deviantart_link' => '', 'vimeo_link' => '', 'youtube_link' => '', 'pinterest_link' => '', 'digg_link' => '', 'flickr_link' => '', 'forrst_link' => '', 'myspace_link' => '', 'skype_link' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('linktarget'); ?>">Link Target:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('linktarget'); ?>" name="<?php echo $this->get_field_name('linktarget'); ?>" type="text" value="<?php echo $instance['linktarget']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('fb_link'); ?>">Facebook Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('fb_link'); ?>" name="<?php echo $this->get_field_name('fb_link'); ?>" type="text" value="<?php echo $instance['fb_link']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('twitter_link'); ?>">Twitter Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo $instance['twitter_link']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('google_link'); ?>">Google+ Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_link'); ?>" name="<?php echo $this->get_field_name('google_link'); ?>" type="text" value="<?php echo $instance['google_link']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('linkedin_link'); ?>">LinkedIn Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" type="text" value="<?php echo $instance['linkedin_link']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('pinterest_link'); ?>">Pinterest Link:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest_link'); ?>" name="<?php echo $this->get_field_name('pinterest_link'); ?>" type="text" value="<?php echo $instance['pinterest_link']; ?>" />
		</p>

	<?php
	}
}
?>