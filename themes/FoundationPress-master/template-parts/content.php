<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('blogpost-entry'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
    <div class="entry-thumb">
        <?php $post_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-medium' ); ?>
        <img src="<?php echo $post_thumbnail_src[0]; ?>" class="img-responsive" alt="">
    </div>
    <?php } ?>
	<header>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php foundationpress_entry_meta(); ?>
	</header>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading...', 'foundationpress' ) ); ?>
	</div>
	<footer>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><p><?php the_tags(); ?></p><?php } ?>
	</footer>
	<hr />
</div>
