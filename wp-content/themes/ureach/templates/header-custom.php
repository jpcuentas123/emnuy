<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.06
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

$ureach_header_id = str_replace('header-custom-', '', ureach_get_theme_option("header_style"));
$ureach_header_meta = get_post_meta($ureach_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($ureach_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($ureach_header_id)));
						echo !empty($ureach_header_image) || !empty($ureach_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($ureach_header_video!='') 
							echo ' with_bg_video';
						if ($ureach_header_image!='') 
							echo ' '.esc_attr(ureach_add_inline_css_class('background-image: url('.esc_url($ureach_header_image).');'));
						if (!empty($ureach_header_meta['margin']) != '') 
							echo ' '.esc_attr(ureach_add_inline_css_class('margin-bottom: '.esc_attr(ureach_prepare_css_value($ureach_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (ureach_is_on(ureach_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(ureach_is_inherit(ureach_get_theme_option('header_scheme')) 
														? ureach_get_theme_option('color_scheme') 
														: ureach_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($ureach_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('ureach_action_show_layout', $ureach_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>