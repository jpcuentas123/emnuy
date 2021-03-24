<?php
/**
 * The Gallery template to display posts
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
$ureach_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($ureach_columns).' post_format_'.esc_attr($ureach_post_format) ); ?>
	<?php echo (!ureach_is_off($ureach_animation) ? ' data-animation="'.esc_attr(ureach_get_animation_classes($ureach_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($ureach_image[1]) && !empty($ureach_image[2])) echo intval($ureach_image[1]) .'x' . intval($ureach_image[2]); ?>"
	data-src="<?php if (!empty($ureach_image[0])) echo esc_url($ureach_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$ureach_image_hover = 'icon';
	if (in_array($ureach_image_hover, array('icons', 'zoom'))) $ureach_image_hover = 'dots';
	$ureach_components = ureach_is_inherit(ureach_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: ureach_array_get_keys_by_value(ureach_get_theme_option('meta_parts'));
	$ureach_counters = ureach_is_inherit(ureach_get_theme_option_from_meta('counters')) 
								? 'comments'
								: ureach_array_get_keys_by_value(ureach_get_theme_option('counters'));
	ureach_show_post_featured(array(
		'hover' => $ureach_image_hover,
		'thumb_size' => ureach_get_thumb_size( strpos(ureach_get_theme_option('body_style'), 'full')!==false || $ureach_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($ureach_components)
										? ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
											'components' => $ureach_components,
											'counters' => $ureach_counters,
											'seo' => false,
											'echo' => false
											), $ureach_blog_style[0], $ureach_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'ureach') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>