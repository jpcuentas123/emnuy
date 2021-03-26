<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

// Page (category, tag, archive, author) title

if ( ureach_need_page_title() ) {
	ureach_sc_layouts_showed('title', true);
	ureach_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
									'components' => 'categories,date,counters,edit',
									'counters' => 'views,comments,likes',
									'seo' => true
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$ureach_blog_title = ureach_get_blog_title();
							$ureach_blog_title_text = $ureach_blog_title_class = $ureach_blog_title_link = $ureach_blog_title_link_text = '';
							if (is_array($ureach_blog_title)) {
								$ureach_blog_title_text = $ureach_blog_title['text'];
								$ureach_blog_title_class = !empty($ureach_blog_title['class']) ? ' '.$ureach_blog_title['class'] : '';
								$ureach_blog_title_link = !empty($ureach_blog_title['link']) ? $ureach_blog_title['link'] : '';
								$ureach_blog_title_link_text = !empty($ureach_blog_title['link_text']) ? $ureach_blog_title['link_text'] : '';
							} else
								$ureach_blog_title_text = $ureach_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($ureach_blog_title_class); ?>"><?php
								$ureach_top_icon = ureach_get_category_icon();
								if (!empty($ureach_top_icon)) {
									$ureach_attr = ureach_getimagesize($ureach_top_icon);
									?><img src="<?php echo esc_url($ureach_top_icon); ?>" alt="<?php  esc_attr_e('Icon', 'ureach')?>" <?php if (!empty($ureach_attr[3])) ureach_show_layout($ureach_attr[3]);?>><?php
								}
								echo wp_kses($ureach_blog_title_text, 'ureach_kses_content');
							?></h1>
							<?php
							if (!empty($ureach_blog_title_link) && !empty($ureach_blog_title_link_text)) {
								?><a href="<?php echo esc_url($ureach_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($ureach_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'ureach_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>