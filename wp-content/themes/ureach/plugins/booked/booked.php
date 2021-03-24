<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('ureach_booked_theme_setup9')) {
	add_action( 'after_setup_theme', 'ureach_booked_theme_setup9', 9 );
	function ureach_booked_theme_setup9() {
		if (ureach_exists_booked()) {
			add_action( 'wp_enqueue_scripts', 							'ureach_booked_frontend_scripts', 1100 );
			add_filter( 'ureach_filter_merge_styles',					'ureach_booked_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'ureach_filter_tgmpa_required_plugins',		'ureach_booked_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'ureach_exists_booked' ) ) {
	function ureach_exists_booked() {
		return class_exists('booked_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'ureach_booked_tgmpa_required_plugins' ) ) {
	
	function ureach_booked_tgmpa_required_plugins($list=array()) {
		if (in_array('booked', ureach_storage_get('required_plugins'))) {
			$path = ureach_get_file_dir('plugins/booked/booked.zip');
			$list[] = array(
					'name' 		=> esc_html__('Booked Appointments', 'ureach'),
					'slug' 		=> 'booked',
					'version'	=> '2.2.6',
					'source' 	=> !empty($path) ? $path : 'upload://booked.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'ureach_booked_frontend_scripts' ) ) {
	
	function ureach_booked_frontend_scripts() {
		if (ureach_is_on(ureach_get_theme_option('debug_mode')) && ureach_get_file_dir('plugins/booked/booked.css')!='')
			wp_enqueue_style( 'ureach-booked',  ureach_get_file_url('plugins/booked/booked.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'ureach_booked_merge_styles' ) ) {
	
	function ureach_booked_merge_styles($list) {
		$list[] = 'plugins/booked/booked.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (ureach_exists_booked()) { require_once UREACH_THEME_DIR . 'plugins/booked/booked.styles.php'; }
?>