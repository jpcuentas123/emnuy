<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_post_id    = get_the_ID();
$ureach_post_date  = ureach_get_date();
$ureach_post_title = get_the_title();
$ureach_post_link  = get_permalink();
$ureach_post_author_id   = get_the_author_meta('ID');
$ureach_post_author_name = get_the_author_meta('display_name');
$ureach_post_author_url  = get_author_posts_url($ureach_post_author_id, '');

$ureach_args = get_query_var('ureach_args_widgets_posts');
$ureach_show_date = isset($ureach_args['show_date']) ? (int) $ureach_args['show_date'] : 1;
$ureach_show_image = isset($ureach_args['show_image']) ? (int) $ureach_args['show_image'] : 1;
$ureach_show_author = isset($ureach_args['show_author']) ? (int) $ureach_args['show_author'] : 1;
$ureach_show_counters = isset($ureach_args['show_counters']) ? (int) $ureach_args['show_counters'] : 1;
$ureach_show_categories = isset($ureach_args['show_categories']) ? (int) $ureach_args['show_categories'] : 1;

$ureach_output = ureach_storage_get('ureach_output_widgets_posts');

$ureach_post_counters_output = '';
if ( $ureach_show_counters ) {
	$ureach_post_counters_output = '<span class="post_info_item post_info_counters">'
								. ureach_get_post_counters('comments')
							. '</span>';
}


$ureach_output .= '<article class="post_item with_thumb">';

if ($ureach_show_image) {
	$ureach_post_thumb = get_the_post_thumbnail($ureach_post_id, ureach_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($ureach_post_thumb) $ureach_output .= '<div class="post_thumb">' . ($ureach_post_link ? '<a href="' . esc_url($ureach_post_link) . '">' : '') . ($ureach_post_thumb) . ($ureach_post_link ? '</a>' : '') . '</div>';
}

$ureach_output .= '<div class="post_content">'
			. ($ureach_show_categories 
					? '<div class="post_categories">'
						. ureach_get_post_categories()
						. $ureach_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($ureach_post_link ? '<a href="' . esc_url($ureach_post_link) . '">' : '') . ($ureach_post_title) . ($ureach_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('ureach_filter_get_post_info', 
								'<div class="post_info">'
									. ($ureach_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($ureach_post_link ? '<a href="' . esc_url($ureach_post_link) . '" class="post_info_date">' : '') 
											. esc_html($ureach_post_date) 
											. ($ureach_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($ureach_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'ureach') . ' ' 
											. ($ureach_post_link ? '<a href="' . esc_url($ureach_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($ureach_post_author_name) 
											. ($ureach_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$ureach_show_categories && $ureach_post_counters_output
										? $ureach_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
ureach_storage_set('ureach_output_widgets_posts', $ureach_output);
?>