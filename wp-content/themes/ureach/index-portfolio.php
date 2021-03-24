<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

ureach_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', ureach_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'ureach-gallery-script', ureach_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$ureach_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$ureach_sticky_out = ureach_get_theme_option('sticky_style')=='columns' 
							&& is_array($ureach_stickies) && count($ureach_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$ureach_cat = ureach_get_theme_option('parent_cat');
	$ureach_post_type = ureach_get_theme_option('post_type');
	$ureach_taxonomy = ureach_get_post_type_taxonomy($ureach_post_type);
	$ureach_show_filters = ureach_get_theme_option('show_filters');
	$ureach_tabs = array();
	if (!ureach_is_off($ureach_show_filters)) {
		$ureach_args = array(
			'type'			=> $ureach_post_type,
			'child_of'		=> $ureach_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $ureach_taxonomy,
			'pad_counts'	=> false
		);
		$ureach_portfolio_list = get_terms($ureach_args);
		if (is_array($ureach_portfolio_list) && count($ureach_portfolio_list) > 0) {
			$ureach_tabs[$ureach_cat] = esc_html__('All', 'ureach');
			foreach ($ureach_portfolio_list as $ureach_term) {
				if (isset($ureach_term->term_id)) $ureach_tabs[$ureach_term->term_id] = $ureach_term->name;
			}
		}
	}
	if (count($ureach_tabs) > 0) {
		$ureach_portfolio_filters_ajax = true;
		$ureach_portfolio_filters_active = $ureach_cat;
		$ureach_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters ureach_tabs ureach_tabs_ajax">
			<ul class="portfolio_titles ureach_tabs_titles">
				<?php
				foreach ($ureach_tabs as $ureach_id=>$ureach_title) {
					?><li><a href="<?php echo esc_url(ureach_get_hash_link(sprintf('#%s_%s_content', $ureach_portfolio_filters_id, $ureach_id))); ?>" data-tab="<?php echo esc_attr($ureach_id); ?>"><?php echo esc_html($ureach_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$ureach_ppp = ureach_get_theme_option('posts_per_page');
			if (ureach_is_inherit($ureach_ppp)) $ureach_ppp = '';
			foreach ($ureach_tabs as $ureach_id=>$ureach_title) {
				$ureach_portfolio_need_content = $ureach_id==$ureach_portfolio_filters_active || !$ureach_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $ureach_portfolio_filters_id, $ureach_id)); ?>"
					class="portfolio_content ureach_tabs_content"
					data-blog-template="<?php echo esc_attr(ureach_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(ureach_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($ureach_ppp); ?>"
					data-post-type="<?php echo esc_attr($ureach_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($ureach_taxonomy); ?>"
					data-cat="<?php echo esc_attr($ureach_id); ?>"
					data-parent-cat="<?php echo esc_attr($ureach_cat); ?>"
					data-need-content="<?php echo (false===$ureach_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($ureach_portfolio_need_content) 
						ureach_show_portfolio_posts(array(
							'cat' => $ureach_id,
							'parent_cat' => $ureach_cat,
							'taxonomy' => $ureach_taxonomy,
							'post_type' => $ureach_post_type,
							'page' => 1,
							'sticky' => $ureach_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		ureach_show_portfolio_posts(array(
			'cat' => $ureach_cat,
			'parent_cat' => $ureach_cat,
			'taxonomy' => $ureach_taxonomy,
			'post_type' => $ureach_post_type,
			'page' => 1,
			'sticky' => $ureach_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>