<?php
/* elegro Crypto Payment support functions
------------------------------------------------------------------------------- */
// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'ureach_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'ureach_elegro_payment_theme_setup9', 9 );
	function ureach_elegro_payment_theme_setup9() {
		if ( ureach_exists_elegro_payment() ) {
            add_action('wp_enqueue_scripts', 'ureach_elegro_payment_frontend_scripts', 1100);
			add_filter( 'ureach_filter_merge_styles', 'ureach_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'ureach_filter_tgmpa_required_plugins', 'ureach_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'ureach_elegro_payment_tgmpa_required_plugins' ) ) {
	function ureach_elegro_payment_tgmpa_required_plugins( $list = array() ) {
            if (in_array('elegro-payment', ureach_storage_get('required_plugins'))) {
			$list[] = array(
                'name' 		=> esc_html__('elegro Crypto Payment', 'ureach'),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'ureach_exists_elegro_payment' ) ) {
	function ureach_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}

// Merge custom styles
if ( ! function_exists( 'ureach_elegro_payment_merge_styles' ) ) {
	function ureach_elegro_payment_merge_styles( $list ) {
		$list[] = 'plugins/elegro-payment/elegro-payment.css';
		return $list;
	}
}
// Enqueue custom styles
if (!function_exists('ureach_elegro_payment_frontend_scripts')) {
    function ureach_elegro_payment_frontend_scripts()
    {
        if (ureach_exists_elegro_payment()) {
            if (ureach_is_on(ureach_get_theme_option('debug_mode')) && ureach_get_file_dir('plugins/elegro-payment/elegro-payment.css') != '')
                wp_enqueue_style('ureach-elegro-payment', ureach_get_file_url('plugins/elegro-payment/elegro-payment.css'), array(), null);
        }
    }
}