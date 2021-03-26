<?php
function vizeon_path_demo_content(){
	return (__DIR__.'/demo-data/');
}
add_filter('wbc_importer_dir_path', 'vizeon_path_demo_content');

/************************************************************************
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/
add_action( 'wbc_importer_before_content_import', 'wbc_extended_example', 10, 2 );

if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );
		if ( class_exists( 'RevSlider' ) ) {
			$wbc_sliders_array = array( 'slider-1.zip', 'slider-2.zip', 'slider-3.zip'  );
			$slider = new RevSlider();
			foreach ($wbc_sliders_array as $s) {
				if ( file_exists( vizeon_path_demo_content().'main/'. $s ) ) {
					$slider->importSliderFromPost( true, true, vizeon_path_demo_content().'main/'.$s );
				}
			}
		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/
		$wbc_menu_array = array( 'main' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'primary' => $top_menu->term_id
					)
				);
			}
		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/
		$wbc_home_pages = array(
			'main' => 'Home 1'
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
	}
	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}

?>
