<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_header_css = $ureach_header_image = '';
$ureach_header_video = ureach_get_header_video();
if (true || empty($ureach_header_video)) {
	$ureach_header_image = get_header_image();
	if (ureach_is_on(ureach_get_theme_option('header_image_override')) && apply_filters('ureach_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($ureach_cat_img = ureach_get_category_image()) != '')
				$ureach_header_image = $ureach_cat_img;
		} else if (is_singular() || ureach_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$ureach_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($ureach_header_image)) $ureach_header_image = $ureach_header_image[0];
			} else
				$ureach_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($ureach_header_image) || !empty($ureach_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($ureach_header_video!='') echo ' with_bg_video';
					if ($ureach_header_image!='') echo ' '.esc_attr(ureach_add_inline_css_class('background-image: url('.esc_url($ureach_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (ureach_is_on(ureach_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(ureach_is_inherit(ureach_get_theme_option('header_scheme')) 
													? ureach_get_theme_option('color_scheme') 
													: ureach_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($ureach_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (ureach_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );



?></header>