<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_blog_style = explode('_', ureach_get_theme_option('blog_style'));
$ureach_columns = empty($ureach_blog_style[1]) ? 2 : max(2, $ureach_blog_style[1]);
$ureach_expanded = !ureach_sidebar_present() && ureach_is_on(ureach_get_theme_option('expand_content'));
$ureach_post_format = get_post_format();
$ureach_post_format = empty($ureach_post_format) ? 'standard' : str_replace('post-format-', '', $ureach_post_format);
$ureach_animation = ureach_get_theme_option('blog_animation');
$ureach_components = ureach_is_inherit(ureach_get_theme_option_from_meta('meta_parts')) 
							? 'date,counters'.($ureach_columns < 3 ? ',edit' : '')
							: ureach_array_get_keys_by_value(ureach_get_theme_option('meta_parts'));
$ureach_counters = ureach_is_inherit(ureach_get_theme_option_from_meta('counters')) 
							? 'comments'
							: ureach_array_get_keys_by_value(ureach_get_theme_option('counters'));

?><div class="<?php echo esc_attr($ureach_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($ureach_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($ureach_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($ureach_columns)
					. ' post_layout_'.esc_attr($ureach_blog_style[0]) 
					. ' post_layout_'.esc_attr($ureach_blog_style[0]).'_'.esc_attr($ureach_columns)
					); ?>
	<?php echo (!ureach_is_off($ureach_animation) ? ' data-animation="'.esc_attr(ureach_get_animation_classes($ureach_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	ureach_show_post_featured( array( 'thumb_size' => ureach_get_thumb_size($ureach_blog_style[0] == 'classic'
													? (strpos(ureach_get_theme_option('body_style'), 'full')!==false 
															? ( $ureach_columns > 2 ? 'big' : 'huge' )
															: (	$ureach_columns > 2
																? ($ureach_expanded ? 'med' : 'small')
																: ($ureach_expanded ? 'big' : 'med')
																)
														)
													: (strpos(ureach_get_theme_option('body_style'), 'full')!==false 
															? ( $ureach_columns > 2 ? 'masonry-big' : 'full' )
															: (	$ureach_columns <= 2 && $ureach_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($ureach_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('ureach_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('ureach_action_before_post_meta'); 

			// Post meta
			if (!empty($ureach_components))
				ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
					'components' => $ureach_components,
					'counters' => $ureach_counters,
					'seo' => false
					), $ureach_blog_style[0], $ureach_columns)
				);

			do_action('ureach_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$ureach_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($ureach_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($ureach_post_format == 'quote') {
				if (($quote = ureach_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					ureach_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($ureach_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($ureach_components))
				ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
					'components' => $ureach_components,
					'counters' => $ureach_counters
					), $ureach_blog_style[0], $ureach_columns)
				);
		}
		// More button

			?><p><a class="sc_button sc_button_simple" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'ureach'); ?></a></p><?php

		?>
	</div><!-- .entry-content -->

</article></div>