<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


if ( !function_exists('ureach_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'ureach_options_theme_setup1', 1 );
	function ureach_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		ureach_storage_set('settings', array(
			
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'		=> 3,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'	=> 30,			// Max words number for the excerpt in the blog style 'Excerpt'.
													// For style 'Classic' - get half from this value

			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use fontello icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use fontello icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal'	// Icons selector in the shortcodes:
													// vc  default  - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('ureach_options_create')) {

	function ureach_options_create() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Homepage, Blog archive, Shop, Events, etc.) or in the settings of individual pages', 'ureach');

		ureach_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'ureach'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'ureach') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'ureach') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'ureach'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'ureach'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 'header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'ureach'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 'default',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'ureach') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'ureach'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"dependency" => array(
					'header_style' => array('header-default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => ureach_get_list_range(0,6),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'ureach'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'ureach'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'ureach'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"dependency" => array(
					'header_style' => array('header-default')
				),
				"std" => 1,
				"type" => "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Menu settings', 'ureach'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'ureach') ),
				"type" => "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'ureach'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'ureach'),
					'left'	=> esc_html__('Left',	'ureach'),
					'right'	=> esc_html__('Right',	'ureach')
				),
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Menu Color Scheme', 'ureach'),
				"desc" => wp_kses_data( __('Select color scheme to decorate main menu area', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'ureach'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'ureach') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'ureach'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'ureach') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'ureach'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'ureach') ),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'ureach'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'ureach') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'ureach'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'ureach') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'ureach'),
				"desc" => wp_kses_data( __('Options of the content area.', 'ureach') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'ureach'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'ureach'),
				"desc" => wp_kses_data( __('Select width of the body content', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'ureach'),
					'wide'		=> esc_html__('Wide',		'ureach'),
					'fullwide'	=> esc_html__('Fullwide',	'ureach'),
					'fullscreen'=> esc_html__('Fullscreen',	'ureach')
				),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'ureach') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"std" => '',
				"type" => "image"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'ureach'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'ureach')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'ureach'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'ureach')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'ureach'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'ureach') ),
				"std" => 0,
				"type" => "text"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'ureach') ),
				"std" => '',
				"type" => "image"
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'ureach'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'ureach') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'privacy_text' => array(
				"title" => esc_html__("Text with Privacy Policy link", 'ureach'),
				"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'ureach') ),
				"std"   => wp_kses( __( 'I agree that my submitted data is being collected and stored.', 'ureach'), 'ureach_kses_content' ),
				"type"  => "text"
			),
			'author_info' => array(
				"title" => esc_html__('Author info', 'ureach'),
				"desc" => wp_kses_data( __("Display block with information about post's author", 'ureach') ),
				"std" => 1,
				"type" => "checkbox"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'ureach'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'ureach') ),
				"std" => 2,
				"options" => ureach_get_list_range(0,9),
				"type" => "select"
				),
			'related_columns' => array(
				"title" => esc_html__('Related columns', 'ureach'),
				"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'ureach') ),
				"std" => 2,
				"options" => ureach_get_list_range(1,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'ureach'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'ureach') ),
				"std" => 2,
				"options" => ureach_get_list_styles(1,2),
				"type" => "select"
				),
			
		
		
			// Section 'Content'
			'sidebar' => array(
				"title" => esc_html__('Sidebar', 'ureach'),
				"desc" => wp_kses_data( __('Options of the sidebar area.', 'ureach') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section",
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'ureach'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'ureach'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'ureach'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'ureach') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Widgets', 'ureach')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
		
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'ureach'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number in the site footer', 'ureach') )
							. '<br>'
							. wp_kses_data( $msg_override ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'ureach'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'ureach')
				),
				"std" => 'footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'ureach'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'ureach')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'ureach')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'ureach'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'ureach')
				),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 3,
				"options" => ureach_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'ureach'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'ureach') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'ureach')
				),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'ureach'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'ureach') ),
				'refresh' => false,
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'ureach') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'ureach'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'ureach') ),
				"dependency" => array(
					'footer_style' => array('footer-default'),
					'logo_in_footer' => array('1')
				),
				"std" => '',
				"type" => "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'ureach'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'ureach') ),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'ureach'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'ureach') ),
				"std" => esc_html__('AncoraThemes &copy; {Y}. All rights reserved.', 'ureach'),
				"dependency" => array(
					'footer_style' => array('footer-default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'ureach'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'ureach') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'ureach'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'ureach') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'ureach'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'ureach') ),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'ureach'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'ureach') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'ureach'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'ureach'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_home' => array(
				"title" => esc_html__('Header widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the homepage', 'ureach') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'ureach'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'ureach') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_page_home' => array(
				"title" => esc_html__('Widgets above the page', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'ureach') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_home' => array(
				"title" => esc_html__('Widgets above the content', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'ureach') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_home' => array(
				"title" => esc_html__('Widgets below the content', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'ureach') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_home' => array(
				"title" => esc_html__('Widgets below the page', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'ureach') ),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'ureach'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'ureach') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'ureach'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'ureach') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'ureach'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => 'excerpt',
				"options" => array(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'ureach'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'ureach') ),
				"std" => 2,
				"options" => ureach_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'ureach'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => array(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'ureach'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => array(),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'ureach'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'meta_parts' => array(
				"title" => esc_html__('Post meta', 'ureach'),
				"desc" => wp_kses_data( __("Select elements to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Post meta' in the 'Theme Options' section of this page. Attention! You can drag items to change their order", 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
				"options" => array(
					'categories' => esc_html__('Categories', 'ureach'),
					'date'		 => esc_html__('Post date', 'ureach'),
					'author'	 => esc_html__('Post author', 'ureach'),
					'counters'	 => esc_html__('Post counters', 'ureach'),
					'share'		 => esc_html__('Share links', 'ureach'),
					'edit'		 => esc_html__('Edit link', 'ureach')
				),
				"type" => "checklist"
			),
			'counters' => array(
				"title" => esc_html__('Counters', 'ureach'),
				"desc" => wp_kses_data( __("Select counters to show in the post meta area on default blog archive and search results. If your blog archive created by page with parameter 'Page template' equal to 'Blog archive' - please set up parameter 'Counters' in the 'Theme Options' section of this page. Attention! You can drag items to change their order. Likes and Views available only if ThemeREX Addons is active", 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"dir" => 'vertical',
				"sortable" => true,
				"std" => 'views=1|likes=1|comments=1',
				"options" => array(
					'views' => esc_html__('Views', 'ureach'),
					'likes' => esc_html__('Likes', 'ureach'),
					'comments' => esc_html__('Comments', 'ureach')
				),
				"type" => "checklist"
			),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'ureach'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"std" => "pages",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'ureach'),
					'links'	=> esc_html__("Older/Newest", 'ureach'),
					'more'	=> esc_html__("Load more", 'ureach'),
					'infinite' => esc_html__("Infinite scroll", 'ureach')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'ureach'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'ureach'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'ureach') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'ureach'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'ureach') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'ureach'),
					'fullpost'	=> esc_html__('Full post',	'ureach')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'ureach'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'ureach') ),
				"std" => 0,
				"type" => "text"
				),
			'sticky_style' => array(
				"title" => esc_html__('Sticky posts style', 'ureach'),
				"desc" => wp_kses_data( __('Select style of the sticky posts output', 'ureach') ),
				"std" => 'inherit',
				"options" => array(
					'inherit' => esc_html__('Decorated posts', 'ureach'),
					'columns' => esc_html__('Mini-cards',	'ureach')
				),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'ureach'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'ureach')
				),
				"dependency" => array(
					'#page_template' => array( 'blog.php' ),
					'.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => "none",
				"options" => array(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'ureach'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'ureach'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'header_widgets_blog' => array(
				"title" => esc_html__('Header widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on the blog archive', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'ureach'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'ureach'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'ureach') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'ureach'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'ureach') ),
				"std" => 0,
				"type" => "checkbox"
				),
			'widgets_above_page_blog' => array(
				"title" => esc_html__('Widgets above the page', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_above_content_blog' => array(
				"title" => esc_html__('Widgets above the content', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_content_blog' => array(
				"title" => esc_html__('Widgets below the content', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			'widgets_below_page_blog' => array(
				"title" => esc_html__('Widgets below the page', 'ureach'),
				"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'ureach') ),
				"std" => 'inherit',
				"options" => array(),
				"type" => "select"
				),
			
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'ureach'),
				"desc" => esc_html__("Modify colors and preview changes on your site", 'ureach'),
				"priority" => 1000,
				"type" => "section"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Color schemes', 'ureach'),
				"desc" => esc_html__('Select color scheme to modify. Attention! Only those sections will be changed which this scheme was assigned to', 'ureach'),
				"std" => '$ureach_get_scheme_storage',
				"refresh" => false,
				"type" => "scheme_editor"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'ureach'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'ureach') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'ureach')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'ureach'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'ureach') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'ureach')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'ureach'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'ureach'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'ureach') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'ureach') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'ureach'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'ureach') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'ureach') ),
				"refresh" => false,
				"std" => '$ureach_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=ureach_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(__('Font %s', 'ureach'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'ureach'),
				"desc" => '',
				"refresh" => false,
				"std" => '$ureach_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'ureach'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'ureach') )
							: '',
				"refresh" => false,
				"std" => '$ureach_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'ureach'),
					'serif' => esc_html__('serif', 'ureach'),
					'sans-serif' => esc_html__('sans-serif', 'ureach'),
					'monospace' => esc_html__('monospace', 'ureach'),
					'cursive' => esc_html__('cursive', 'ureach'),
					'fantasy' => esc_html__('fantasy', 'ureach')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'ureach'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'ureach') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'ureach') )
							: '',
				"refresh" => false,
				"std" => '$ureach_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = ureach_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(__('%s settings', 'ureach'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses( sprintf(__('Font settings of the "%s" tag.', 'ureach'), $tag), 'ureach_kses_content' ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'ureach'),
						'100' => esc_html__('100 (Light)', 'ureach'), 
						'200' => esc_html__('200 (Light)', 'ureach'), 
						'300' => esc_html__('300 (Thin)',  'ureach'),
						'400' => esc_html__('400 (Normal)', 'ureach'),
						'500' => esc_html__('500 (Semibold)', 'ureach'),
						'600' => esc_html__('600 (Semibold)', 'ureach'),
						'700' => esc_html__('700 (Bold)', 'ureach'),
						'800' => esc_html__('800 (Black)', 'ureach'),
						'900' => esc_html__('900 (Black)', 'ureach')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'ureach'),
						'normal' => esc_html__('Normal', 'ureach'), 
						'italic' => esc_html__('Italic', 'ureach')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'ureach'),
						'none' => esc_html__('None', 'ureach'), 
						'underline' => esc_html__('Underline', 'ureach'),
						'overline' => esc_html__('Overline', 'ureach'),
						'line-through' => esc_html__('Line-through', 'ureach')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'ureach'),
						'none' => esc_html__('None', 'ureach'), 
						'uppercase' => esc_html__('Uppercase', 'ureach'),
						'lowercase' => esc_html__('Lowercase', 'ureach'),
						'capitalize' => esc_html__('Capitalize', 'ureach')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$ureach_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		ureach_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			ureach_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'ureach'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'ureach') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'ureach')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('ureach_options_get_list_choises')) {
	add_filter('ureach_filter_options_get_list_choises', 'ureach_options_get_list_choises', 10, 2);
	function ureach_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = ureach_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = ureach_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, 'header_scheme')===0 
					|| strpos($id, 'menu_scheme')===0
					|| strpos($id, 'color_scheme')===0
					|| strpos($id, 'sidebar_scheme')===0
					|| strpos($id, 'footer_scheme')===0)
				$list = ureach_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = ureach_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = ureach_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = ureach_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = ureach_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = ureach_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = ureach_array_merge(array(0 => esc_html__('- Select category -', 'ureach')), ureach_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = ureach_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = ureach_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = ureach_get_list_load_fonts(true);
		}
		return $list;
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('ureach_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'ureach_options_theme_setup2', 2 );
	function ureach_options_theme_setup2() {
		ureach_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('ureach_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'ureach_options_theme_setup5', 5 );
	function ureach_options_theme_setup5() {
		ureach_storage_set('options_reloaded', false);
		ureach_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('ureach_load_custom_options')) {
		add_action( 'wp_loaded', 'ureach_load_custom_options' );
		function ureach_load_custom_options() {
			if (!ureach_storage_get('options_reloaded')) {
				ureach_storage_set('options_reloaded', true);
				ureach_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('ureach_load_theme_options') ) {
	function ureach_load_theme_options() {
		$options = ureach_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$ureach_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = sanitize_text_field($_GET[$k]);
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				ureach_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			ureach_customizer_save_css();
		} else {
			do_action('ureach_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('ureach_override_theme_options') ) {
	add_action( 'wp', 'ureach_override_theme_options', 1 );
	function ureach_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			ureach_storage_set('blog_archive', true);
			ureach_storage_set('blog_template', get_the_ID());
		}
		ureach_storage_set('blog_mode', ureach_detect_blog_mode());
		if (is_singular()) {
			ureach_storage_set('options_meta', get_post_meta(get_the_ID(), 'ureach_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('ureach_get_theme_option')) {
	function ureach_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!ureach_storage_isset('post_options_meta', $post_id))
				ureach_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'ureach_options', true));
			if (ureach_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = ureach_storage_get_array('post_options_meta', $post_id, $name);
				if (!ureach_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && ureach_storage_isset('options')) {
			$blog_mode = ureach_storage_get('blog_mode');
			if ( !ureach_storage_isset('options', $name) && (empty($blog_mode) || !ureach_storage_isset('options', $name.'_'.$blog_mode)) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'ureach'), $name);
						if (function_exists('dco')) ureach_dco($s);
						else print_r($s);
						echo '</pre>';
						wp_die();
					} else
						$rez = $defa;
				}
			} else {
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = ureach_get_value_gpc($name . '_' . $blog_mode);
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = ureach_get_value_gpc($name);
				// Override option from current page settings (if exists)
				} else if (ureach_storage_isset('options_meta', $name) && !ureach_is_inherit(ureach_storage_get_array('options_meta', $name))) {
					$rez = ureach_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && ureach_storage_isset('options', $name . '_' . $blog_mode, 'val') && !ureach_is_inherit(ureach_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = ureach_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (ureach_storage_isset('options', $name, 'val')) {
					$rez = ureach_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('ureach_check_theme_option')) {
	function ureach_check_theme_option($name) {
		return ureach_storage_isset('options', $name);
	}
}


// Return customizable option value, stored in the posts meta
if (!function_exists('ureach_get_theme_option_from_meta')) {
	function ureach_get_theme_option_from_meta($name, $defa='') {
		$rez = $defa;
		if (ureach_storage_isset('options_meta')) {
			if (ureach_storage_isset('options_meta', $name))
				$rez = ureach_storage_get_array('options_meta', $name);
			else
				$rez = 'inherit';
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( !function_exists('ureach_get_theme_dependencies') ) {
	function ureach_get_theme_dependencies() {
		$options = ureach_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('ureach_get_theme_setting')) {
	function ureach_get_theme_setting($name) {
		if ( !ureach_storage_isset('settings', $name) ) {
			$s = debug_backtrace();
			$s = array_shift($s);
			echo '<pre>' . sprintf(esc_html__('Undefined setting "%s" called from:', 'ureach'), $name);
			if (function_exists('dco')) ureach_dco($s);
			else print_r($s);
			echo '</pre>';
			wp_die();
		} else
			return ureach_storage_get_array('settings', $name);
	}
}

// Set theme setting
if ( !function_exists( 'ureach_set_theme_setting' ) ) {
	function ureach_set_theme_setting($option_name, $value) {
		if (ureach_storage_isset('settings', $option_name))
			ureach_storage_set_array('settings', $option_name, $value);
	}
}
?>