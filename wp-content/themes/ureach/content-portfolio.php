<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_blog_style = explode('_', ureach_get_theme_option('blog_style'));
$ureach_columns = empty($ureach_blog_style[1]) ? 2 : max(2, $ureach_blog_style[1]);
$ureach_post_format = get_post_format();
$ureach_post_format = empty($ureach_post_format) ? 'standard' : str_replace('post-format-', '', $ureach_post_format);
$ureach_animation = ureach_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($ureach_columns).' post_format_'.esc_attr($ureach_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!ureach_is_off($ureach_animation) ? ' data-animation="'.esc_attr(ureach_get_animation_classes($ureach_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$ureach_image_hover = ureach_get_theme_option('image_hover');
	// Featured image
	ureach_show_post_featured(array(
		'thumb_size' => ureach_get_thumb_size(strpos(ureach_get_theme_option('body_style'), 'full')!==false || $ureach_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $ureach_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $ureach_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>