<?php
/* WP GDPR Compliance support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('ureach_wp_gdpr_compliance_theme_setup9')) {
	add_action( 'after_setup_theme', 'ureach_wp_gdpr_compliance_theme_setup9', 9 );
	function ureach_wp_gdpr_compliance_theme_setup9() {
		if (is_admin()) {
			add_filter( 'ureach_filter_tgmpa_required_plugins',		'ureach_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'ureach_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	function ureach_wp_gdpr_compliance_tgmpa_required_plugins($list=array()) {
		if (in_array('wp-gdpr-compliance', (array)ureach_storage_get('required_plugins'))) {
			$list[] = array(
					'name' 		=> esc_html__('WP GDPR Compliance', 'ureach'),
					'slug' 		=> 'wp-gdpr-compliance',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'ureach_exists_wp_gdpr_compliance' ) ) {
	function ureach_exists_wp_gdpr_compliance() {
		return defined('WP_GDPR_C_SLUG');
	}
}
?>