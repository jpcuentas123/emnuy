<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$ureach_post_format = get_post_format();
$ureach_post_format = empty($ureach_post_format) ? 'standard' : str_replace('post-format-', '', $ureach_post_format);
$ureach_animation = ureach_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($ureach_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($ureach_post_format) ); ?>
	<?php echo (!ureach_is_off($ureach_animation) ? ' data-animation="'.esc_attr(ureach_get_animation_classes($ureach_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	ureach_show_post_featured(array(
		'thumb_size' => ureach_get_thumb_size($ureach_columns==1 ? 'big' : ($ureach_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($ureach_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(), 'sticky', $ureach_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>