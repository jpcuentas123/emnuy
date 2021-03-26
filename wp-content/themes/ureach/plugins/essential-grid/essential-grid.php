<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('ureach_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'ureach_essential_grid_theme_setup9', 9 );
	function ureach_essential_grid_theme_setup9() {
		if (ureach_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'ureach_essential_grid_frontend_scripts', 1100 );
			add_filter( 'ureach_filter_merge_styles',					'ureach_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'ureach_filter_tgmpa_required_plugins',		'ureach_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'ureach_exists_essential_grid' ) ) {
	function ureach_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'ureach_essential_grid_tgmpa_required_plugins' ) ) {
	function ureach_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', ureach_storage_get('required_plugins'))) {
			$path = ureach_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'ureach'),
						'slug' 		=> 'essential-grid',
						'version'	=> '3.0.7',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'ureach_essential_grid_frontend_scripts' ) ) {
	function ureach_essential_grid_frontend_scripts() {
		if (ureach_is_on(ureach_get_theme_option('debug_mode')) && ureach_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'ureach-essential-grid',  ureach_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'ureach_essential_grid_merge_styles' ) ) {
	function ureach_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>