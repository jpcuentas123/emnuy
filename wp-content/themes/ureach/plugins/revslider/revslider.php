<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('ureach_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'ureach_revslider_theme_setup9', 9 );
	function ureach_revslider_theme_setup9() {
		if (ureach_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'ureach_revslider_frontend_scripts', 1100 );
			add_filter( 'ureach_filter_merge_styles',			'ureach_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'ureach_filter_tgmpa_required_plugins','ureach_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'ureach_exists_revslider' ) ) {
	function ureach_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'ureach_revslider_tgmpa_required_plugins' ) ) {
	function ureach_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', ureach_storage_get('required_plugins'))) {
			$path = ureach_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'ureach'),
					'slug' 		=> 'revslider',
					'version'	=> '6.2.23',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'ureach_revslider_frontend_scripts' ) ) {
	function ureach_revslider_frontend_scripts() {
		if (ureach_is_on(ureach_get_theme_option('debug_mode')) && ureach_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'ureach-revslider',  ureach_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'ureach_revslider_merge_styles' ) ) {
	function ureach_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>