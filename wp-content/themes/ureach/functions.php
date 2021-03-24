<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
}

if (!defined("UREACH_THEME_DIR")) define("UREACH_THEME_DIR", trailingslashit( get_template_directory() ));
if (!defined("UREACH_CHILD_DIR")) define("UREACH_CHILD_DIR", trailingslashit( get_stylesheet_directory() ));

// Theme storage
$UREACH_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'booked',
		'contact-form-7',
		'essential-grid',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'woocommerce',
		'wp-gdpr-compliance',
        'trx_updater',
        'elegro-payment'
		)
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('ureach_theme_setup1') ) {
	add_action( 'after_setup_theme', 'ureach_theme_setup1', 1 );
	function ureach_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'ureach', get_template_directory() . '/languages' );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'ureach_filter_content_width', 1170 );
	}
}

if ( !function_exists('ureach_theme_setup') ) {
	add_action( 'after_setup_theme', 'ureach_theme_setup' );
	function ureach_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );

		// Add wide and full blocks support
		add_theme_support( 'align-wide' );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				ureach_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			ureach_theme_fonts_for_editor()
			)
		);	
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'ureach'),
			'menu_mobile' => esc_html__('Mobile Menu', 'ureach'),
			'menu_footer' => esc_html__('Footer Menu', 'ureach')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'ureach_excerpt_length' );
		add_filter( 'excerpt_more',							'ureach_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'ureach_wp_head', 0);
		
		// Load current page/post customization (if present)
		add_action('wp_footer',		 						'ureach_wp_footer');
		add_action('admin_footer',	 						'ureach_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'ureach_wp_scripts', 1000);			// priority 1000 - load styles
																									// before the plugin's support custom styles
																									// (with priority 1100)
		add_action('wp_enqueue_scripts', 					'ureach_wp_scripts_child', 1200);		// priority 1200 - load styles
																									// after the plugin's support custom styles
																									// (with priority 1100)
		add_action('wp_enqueue_scripts', 					'ureach_wp_scripts_responsive', 2000);	// priority 2000 - load responsive
																									// after all other styles
		add_action('wp_footer',		 						'ureach_localize_scripts');
		
		// Add body classes
		add_filter( 'body_class',							'ureach_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'ureach_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'ureach_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'ureach_wp_scripts' ) ) {
	
	function ureach_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = ureach_theme_fonts_links();
		if (is_array($links) && count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('ureach-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello-icons',  ureach_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'ureach-main', $main_stylesheet, array(), null );

		// Add custom bg image for the body_style == 'boxed'
		if ( ureach_get_theme_option('body_style') == 'boxed' && ($bg_image = ureach_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'ureach-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( ureach_is_off(ureach_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'ureach-styles', ureach_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && ureach_is_off(ureach_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'ureach-colors', ureach_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'ureach-main', ureach_customizer_get_css() );

		// Add post nav background
		ureach_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(ureach_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', ureach_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', ureach_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( ureach_is_off(ureach_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'ureach-init', ureach_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', ureach_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = ureach_get_header_video();
			if (!empty($header_video) && !ureach_is_inherit($header_video)) {
				if (ureach_is_youtube_url($header_video))
					wp_enqueue_script( 'tubular', ureach_get_file_url('js/jquery.tubular.js'), array('jquery'), null, true );
				else
					wp_enqueue_script( 'bideo', ureach_get_file_url('js/bideo.js'), array(), null, true );
			}
			// Theme scripts
			wp_enqueue_script( 'ureach-utils', ureach_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'ureach-init', ureach_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (ureach_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Load child-theme stylesheet (if different) after all styles (with priorities 1000 and 1100)
if ( !function_exists( 'ureach_wp_scripts_child' ) ) {
	function ureach_wp_scripts_child() {
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'ureach-child', $child_stylesheet, array('ureach-main'), null );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'ureach_localize_scripts' ) ) {
	function ureach_localize_scripts() {

		$video = ureach_get_header_video();

		wp_localize_script( 'ureach-init', 'UREACH_STORAGE', apply_filters( 'ureach_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
			'theme_url' => get_template_directory_uri(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', ureach_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
			'mobile_device' => wp_is_mobile(),
						
			// Sidemenu options
			'menu_side_stretch' => ureach_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => ureach_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => ureach_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => ureach_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'comment_maxlength'	=> intval(ureach_get_theme_setting('comment_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'ureach'),
					'error_global'		=> esc_html__('Error data validation!', 'ureach'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'ureach'),
					'name_long'			=> esc_html__('Too long name', 'ureach'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'ureach'),
					'email_long'		=> esc_html__('Too long email address', 'ureach'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'ureach'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'ureach'),
					'text_long'			=> esc_html__('Too long message text', 'ureach')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'ureach_wp_scripts_responsive' ) ) {
	function ureach_wp_scripts_responsive() {
		wp_enqueue_style( 'ureach-responsive', ureach_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('ureach_wp_head')) {
	function ureach_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('ureach_add_body_classes') ) {
	function ureach_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(ureach_get_theme_option('color_scheme'));

		$blog_mode = ureach_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(ureach_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(ureach_get_theme_option('blog_style'));
			if (ureach_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (ureach_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(ureach_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (ureach_is_on(ureach_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (ureach_is_on(ureach_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(ureach_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(ureach_get_theme_option("header_position"));

		$menu_style= ureach_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load current page/post customization (if present)
if ( !function_exists( 'ureach_wp_footer' ) ) {
	function ureach_wp_footer() {
		if (($css = ureach_get_inline_css()) != '') {
			wp_enqueue_style(  'ureach-inline-styles',  ureach_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'ureach-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('ureach_register_sidebars') ) {
	function ureach_register_sidebars() {
		$sidebars = ureach_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => esc_html($sb['name']),
										'description'   => esc_html($sb['description']),
										'id'            => esc_attr($id),
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('ureach_get_sidebars') ) {
	function ureach_get_sidebars() {
		$list = apply_filters('ureach_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'ureach')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'ureach')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Top Page Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'ureach')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'ureach')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'ureach')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Bottom Page Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'ureach')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'ureach'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'ureach')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('ureach_theme_fonts_links') ) {
	function ureach_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Google fonts: on or off', 'ureach' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Custom fonts (included in the theme): on or off', 'ureach' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !ureach_storage_empty('load_fonts') ) {
			$load_fonts = ureach_storage_get('load_fonts');
			if (is_array($load_fonts) && count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = ureach_get_load_fonts_slug($font['name']);
					$url  = ureach_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', ureach_get_protocol(), $google_fonts, ureach_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('ureach_theme_fonts_for_editor') ) {
	function ureach_theme_fonts_for_editor() {
		$links = array_values(ureach_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('ureach_excerpt_length') ) {
	function ureach_excerpt_length( $length ) {
		return max(1, ureach_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('ureach_excerpt_more') ) {
	function ureach_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'ureach_importer_set_options' ) ) {
	function ureach_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(ureach_get_protocol() . '://demofiles.ancorathemes.com/ureach/');
			// Required plugins
			$options['required_plugins'] = ureach_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('uReach Demo', 'ureach');
			$options['files']['default']['domain_dev'] = esc_url(ureach_get_protocol().'://ureach.dv.ancorathemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(ureach_get_protocol().'://ureach.ancorathemes.com');		// Demo-site domain
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once UREACH_THEME_DIR . 'includes/utils.php';
require_once UREACH_THEME_DIR . 'includes/storage.php';
require_once UREACH_THEME_DIR . 'includes/lists.php';
require_once UREACH_THEME_DIR . 'includes/wp.php';

if (is_admin()) {
	require_once UREACH_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once UREACH_THEME_DIR . 'includes/admin.php';
}

require_once UREACH_THEME_DIR . 'theme-options/theme.customizer.php';

require_once UREACH_THEME_DIR . 'theme-specific/theme.tags.php';
require_once UREACH_THEME_DIR . 'theme-specific/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($UREACH_STORAGE['required_plugins']) && count($UREACH_STORAGE['required_plugins']) > 0) {
	foreach ($UREACH_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = ureach_esc($plugin_slug);
		$plugin_path = UREACH_THEME_DIR . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>