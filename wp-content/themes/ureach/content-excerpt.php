<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_post_format = get_post_format();
$ureach_post_format = empty($ureach_post_format) ? 'standard' : str_replace('post-format-', '', $ureach_post_format);
$ureach_animation = ureach_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'columns_wrap post_item post_layout_excerpt post_format_'.esc_attr($ureach_post_format) ); ?>
	<?php echo (!ureach_is_off($ureach_animation) ? ' data-animation="'.esc_attr(ureach_get_animation_classes($ureach_animation)).'"' : ''); ?>
	><div class="column-1_2 post_cat"><?php


		// Sticky label
		if ( is_sticky() && !is_paged() ) {
			?><span class="post_label label_sticky"></span><?php
		}

		do_action('ureach_action_before_post_meta');

		// Post meta
		$ureach_components = ureach_is_inherit(ureach_get_theme_option_from_meta('meta_parts'))
			? 'categories'
			: ureach_array_get_keys_by_value(ureach_get_theme_option('meta_parts'));
		$ureach_counters = ureach_is_inherit(ureach_get_theme_option_from_meta('counters'))
			? ''
			: ureach_array_get_keys_by_value(ureach_get_theme_option('counters'));

		if (!empty($ureach_components))
			ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
					'components' => $ureach_components,
					'counters' => $ureach_counters,
					'seo' => false
				), 'excerpt', 1)
			);

		// Featured image
		ureach_show_post_featured(array( 'thumb_size' => ureach_get_thumb_size( strpos(ureach_get_theme_option('body_style'), 'full')!==false ? 'full' : 'blog' ) )); ?>
	</div>


	<div class="column-1_2"><?php
		// Title and post meta
		if (get_the_title() != '') {
			?>
			<div class="post_header entry-header">
				<?php
				do_action('ureach_action_before_post_title');

				// Post title
				the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

				do_action('ureach_action_before_post_meta');

				// Post meta
				$ureach_components = ureach_is_inherit(ureach_get_theme_option_from_meta('meta_parts'))
					? 'date,counters'
					: ureach_array_get_keys_by_value(ureach_get_theme_option('meta_parts'));
				$ureach_counters = ureach_is_inherit(ureach_get_theme_option_from_meta('counters'))
					? 'comments'
					: ureach_array_get_keys_by_value(ureach_get_theme_option('counters'));

				if (!empty($ureach_components))
					ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
							'components' => $ureach_components,
							'counters' => $ureach_counters,
							'seo' => false
						), 'excerpt', 1)
					);
				?>
			</div><!-- .post_header --><?php
		}

		// Post content
		?><div class="post_content entry-content"><?php
			if (ureach_get_theme_option('blog_content') == 'fullpost') {
				// Post content area
				?><div class="post_content_inner"><?php
				the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'ureach' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ureach' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			} else {

				$ureach_show_learn_more = !in_array($ureach_post_format, array('link', 'aside', 'status', 'quote'));

				// Post content area
				?><div class="post_content_inner"><?php
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
				?></div><?php
				// More button
				if ( $ureach_show_learn_more ) {
					?><p><a class="sc_button sc_button_simple" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'ureach'); ?></a></p><?php
				}

			}
			?></div><!-- .entry-content -->
	</div>

</article>