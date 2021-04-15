<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$ureach_content = '';
$ureach_blog_archive_mask = '%%CONTENT%%';
$ureach_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $ureach_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($ureach_content = apply_filters('the_content', get_the_content())) != '') {
		if (($ureach_pos = strpos($ureach_content, $ureach_blog_archive_mask)) !== false) {
			$ureach_content = preg_replace('/(\<p\>\s*)?'.$ureach_blog_archive_mask.'(\s*\<\/p\>)/i', $ureach_blog_archive_subst, $ureach_content);
		} else
			$ureach_content .= $ureach_blog_archive_subst;
		$ureach_content = explode($ureach_blog_archive_mask, $ureach_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) ureach_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$ureach_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$ureach_args = ureach_query_add_posts_and_cats($ureach_args, '', ureach_get_theme_option('post_type'), ureach_get_theme_option('parent_cat'));
$ureach_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($ureach_page_number > 1) {
	$ureach_args['paged'] = $ureach_page_number;
	$ureach_args['ignore_sticky_posts'] = true;
}
$ureach_ppp = ureach_get_theme_option('posts_per_page');
if ((int) $ureach_ppp != 0)
	$ureach_args['posts_per_page'] = (int) $ureach_ppp;
// Make a new query
query_posts( $ureach_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($ureach_content) && count($ureach_content) == 2) {
	set_query_var('blog_archive_start', $ureach_content[0]);
	set_query_var('blog_archive_end', $ureach_content[1]);
}

get_template_part('index');
?>