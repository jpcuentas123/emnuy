<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('ureach_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'ureach_mailchimp_theme_setup9', 9 );
	function ureach_mailchimp_theme_setup9() {
		if (ureach_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'ureach_mailchimp_frontend_scripts', 1100 );
			add_filter( 'ureach_filter_merge_styles',					'ureach_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'ureach_filter_tgmpa_required_plugins',		'ureach_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'ureach_exists_mailchimp' ) ) {
	function ureach_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'ureach_mailchimp_tgmpa_required_plugins' ) ) {
	function ureach_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', ureach_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'ureach'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'ureach_mailchimp_frontend_scripts' ) ) {
	function ureach_mailchimp_frontend_scripts() {
		if (ureach_exists_mailchimp()) {
			if (ureach_is_on(ureach_get_theme_option('debug_mode')) && ureach_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'ureach-mailchimp-for-wp',  ureach_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'ureach_mailchimp_merge_styles' ) ) {
	function ureach_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (ureach_exists_mailchimp()) { require_once UREACH_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>