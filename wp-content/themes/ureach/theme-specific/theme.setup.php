<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('ureach_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'ureach_customizer_theme_setup1', 1 );
	function ureach_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		ureach_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Overpass',
				'family' => 'sans-serif',
				'styles' => '300,300i,400,400i,600,600i,700,700i'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'	 => 'Poppins',
				'family' => 'sans-serif',
				'styles' => '400,500,600'		// Parameter 'style' used only for the Google fonts
			),
			array(
				'name'	 => 'Fira Sans',
				'family' => 'sans-serif',
				'styles' => '400,400i'		// Parameter 'style' used only for the Google fonts
			),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		ureach_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		ureach_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'ureach'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'ureach'),
				'font-family'		=> 'Overpass, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.15px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.4em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '4.5rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '5rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-3.5px',
				'margin-top'		=> '1.6em',
				'margin-bottom'		=> '0.65em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '3.75rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '4.5rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-3px',
				'margin-top'		=> '1.87em',
				'margin-bottom'		=> '0.55em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '3rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '3.75rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2.3px',
				'margin-top'		=> '2.31em',
				'margin-bottom'		=> '0.64em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '2.25rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '3rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.8px',
				'margin-top'		=> '3.1565em',
				'margin-bottom'		=> '0.75em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '1.5rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '2.063rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.7px',
				'margin-top'		=> '4.9em',
				'margin-bottom'		=> '0.9em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '1.25rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.625rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.6px',
				'margin-top'		=> '5.9176em',
				'margin-bottom'		=> '0.7412em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'ureach'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'ureach'),
				'font-family'		=> 'Overpass, sans-serif',
				'font-size' 		=> '18px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'lowercase',
				'letter-spacing'	=> '-0.3px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'ureach'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'ureach'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'ureach'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'ureach'),
				'description'		=> esc_html__('Font settings of the main menu items', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.4px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'ureach'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'ureach'),
				'font-family'		=> 'Poppins, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.4px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		ureach_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> esc_html__('Main', 'ureach'),
							'description'	=> esc_html__('Colors of the main content area', 'ureach')
							),
			'alter'	=> array(
							'title'			=> esc_html__('Alter', 'ureach'),
							'description'	=> esc_html__('Colors of the alternative blocks (sidebars, etc.)', 'ureach')
							),
			'extra'	=> array(
							'title'			=> esc_html__('Extra', 'ureach'),
							'description'	=> esc_html__('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'ureach')
							),
			'inverse' => array(
							'title'			=> esc_html__('Inverse', 'ureach'),
							'description'	=> esc_html__('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'ureach')
							),
			'input'	=> array(
							'title'			=> esc_html__('Input', 'ureach'),
							'description'	=> esc_html__('Colors of the form fields (text field, textarea, select, etc.)', 'ureach')
							),
			)
		);
		ureach_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> esc_html__('Background color', 'ureach'),
							'description'	=> esc_html__('Background color of this block in the normal state', 'ureach')
							),
			'bg_hover'	=> array(
							'title'			=> esc_html__('Background hover', 'ureach'),
							'description'	=> esc_html__('Background color of this block in the hovered state', 'ureach')
							),
			'bd_color'	=> array(
							'title'			=> esc_html__('Border color', 'ureach'),
							'description'	=> esc_html__('Border color of this block in the normal state', 'ureach')
							),
			'bd_hover'	=>  array(
							'title'			=> esc_html__('Border hover', 'ureach'),
							'description'	=> esc_html__('Border color of this block in the hovered state', 'ureach')
							),
			'text'		=> array(
							'title'			=> esc_html__('Text', 'ureach'),
							'description'	=> esc_html__('Color of the plain text inside this block', 'ureach')
							),
			'text_dark'	=> array(
							'title'			=> esc_html__('Text dark', 'ureach'),
							'description'	=> esc_html__('Color of the dark text (bold, header, etc.) inside this block', 'ureach')
							),
			'text_light'=> array(
							'title'			=> esc_html__('Text light', 'ureach'),
							'description'	=> esc_html__('Color of the light text (post meta, etc.) inside this block', 'ureach')
							),
			'text_link'	=> array(
							'title'			=> esc_html__('Link', 'ureach'),
							'description'	=> esc_html__('Color of the links inside this block', 'ureach')
							),
			'text_hover'=> array(
							'title'			=> esc_html__('Link hover', 'ureach'),
							'description'	=> esc_html__('Color of the hovered state of links inside this block', 'ureach')
							),
			'text_link2'=> array(
							'title'			=> esc_html__('Link 2', 'ureach'),
							'description'	=> esc_html__('Color of the accented texts (areas) inside this block', 'ureach')
							),
			'text_hover2'=> array(
							'title'			=> esc_html__('Link 2 hover', 'ureach'),
							'description'	=> esc_html__('Color of the hovered state of accented texts (areas) inside this block', 'ureach')
							),
			'text_link3'=> array(
							'title'			=> esc_html__('Link 3', 'ureach'),
							'description'	=> esc_html__('Color of the other accented texts (buttons) inside this block', 'ureach')
							),
			'text_hover3'=> array(
							'title'			=> esc_html__('Link 3 hover', 'ureach'),
							'description'	=> esc_html__('Color of the hovered state of other accented texts (buttons) inside this block', 'ureach')
							)
			)
		);
		ureach_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'ureach'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',  //+
					'bd_color'			=> '#d5dee6',  //+
		
					// Text and links colors
					'text'				=> '#787e82',  //+
					'text_light'		=> '#b7b7b7',
					'text_dark'			=> '#2c3a5a',  //+
					'text_link'			=> '#f87b80',  //+
					'text_hover'		=> '#d5575c',  //+
					'text_link2'		=> '#f57872',  //+
					'text_hover2'		=> '#f77d97',  //+
					'text_link3'		=> '#131e38',  //+
					'text_hover3'		=> '#f6f4f0',  //+
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f0f4f6',  //+
					'alter_bg_hover'	=> '#eef2f5',  //+
					'alter_bd_color'	=> '#e4e5e6',  //+
					'alter_bd_hover'	=> '#c6d3de',  //+
					'alter_text'		=> '#333333',
					'alter_light'		=> '#b5bbc9',  //+
					'alter_dark'		=> '#48536c',  //+
					'alter_link'		=> '#fe7259',
					'alter_hover'		=> '#72cfd5',
					'alter_link2'		=> '#ffffff',  //+
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ffffff',  //+
					'alter_hover3'		=> '#d5575c',  //+
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#2c3a5a',  //+
					'extra_bg_hover'	=> '#c3d1dc',  //+
					'extra_bd_color'	=> '#c5d2dc',  //+
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#c4c7cc',  //+
					'extra_light'		=> '#c4c4c4',  //+
					'extra_dark'		=> '#a4b5c2',  //+
					'extra_link'		=> '#f87b80',  //+
					'extra_hover'		=> '#d5575c',  //+
					'extra_link2'		=> '#9db0bf',  //+
					'extra_hover2'		=> '#c6c7c8',  //+
					'extra_link3'		=> '#2c3a5a',  //+
					'extra_hover3'		=> '#2c3a5a',  //+
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f0f4f6',  //+
					'input_bg_hover'	=> '#f0f4f6',  //+
					'input_bd_color'	=> '#f0f4f6',  //+
					'input_bd_hover'	=> '#2c3a5a',  //+
					'input_text'		=> '#919aa0',  //+
					'input_light'		=> '#d0d0d0',
					'input_dark'		=> '#1d1d1d',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',  //+
					'inverse_link'		=> '#ffffff',  //+
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'ureach'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#0e0d12',
					'bd_color'			=> '#1c1b1f',
		
					// Text and links colors
					'text'				=> '#d4d4d4',  //+
					'text_light'		=> '#c3c6cc',  //+
					'text_dark'			=> '#ffffff',  //+
					'text_link'			=> '#f87b80',  //+
					'text_hover'		=> '#d5575c',  //+
					'text_link2'		=> '#f57872',  //+
					'text_hover2'		=> '#f77d97',  //+
					'text_link3'		=> '#131e38',  //+
					'text_hover3'		=> '#f6f4f0',  //+

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1e1d22',
					'alter_bg_hover'	=> '#28272e',
					'alter_bd_color'	=> '#313131',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#cdd2db',  //+
					'alter_link'		=> '#ffaa5f',
					'alter_hover'		=> '#fe7259',
					'alter_link2'		=> '#9db0bf',  //+
					'alter_hover2'		=> '#8be77c',
					'alter_link3'		=> '#ffffff',  //+
					'alter_hover3'		=> '#f87b80',  //+

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffffff',
					'extra_hover'		=> '#fe7259',
					'extra_link2'		=> '#9db0bf',  //+
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#f87b80',  //+
					'extra_hover3'		=> '#2c3a5a',  //+

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#f0f4f6',  //+
					'input_bg_hover'	=> '#f0f4f6',  //+
					'input_bd_color'	=> '#f0f4f6',  //+
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#919aa0',  //+
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('ureach_customizer_add_theme_colors')) {
	function ureach_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = ureach_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = ureach_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = ureach_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = ureach_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = ureach_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = ureach_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = ureach_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = ureach_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = ureach_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = ureach_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_07']  = ureach_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = ureach_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = ureach_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_hover3_01']  = ureach_hex2rgba( $colors['text_hover3'], 0.1 );
			$colors['inverse_dark_05']  = ureach_hex2rgba( $colors['inverse_dark'], 0.5 );
			$colors['inverse_link_02']  = ureach_hex2rgba( $colors['inverse_link'], 0.2 );
			$colors['text_link_blend'] = ureach_hsb2hex(ureach_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = ureach_hsb2hex(ureach_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_hover3_01'] = '{{ data.text_hover3_01 }}';
			$colors['inverse_dark_05'] = '{{ data.inverse_dark_05 }}';
			$colors['inverse_link_02'] = '{{ data.inverse_link_02 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('ureach_customizer_add_theme_fonts')) {
	function ureach_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !ureach_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !ureach_is_inherit($font['font-size'])
														? 'font-size:' . ureach_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !ureach_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !ureach_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !ureach_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !ureach_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !ureach_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !ureach_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !ureach_is_inherit($font['margin-top'])
														? 'margin-top:' . ureach_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !ureach_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . ureach_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('ureach_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'ureach_customizer_theme_setup' );
	function ureach_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('ureach_filter_add_thumb_sizes', array(
			'ureach-thumb-huge'		=> array(1540, 922, true),
			'ureach-thumb-big' 		=> array( 1540, 820, true),
			'ureach-thumb-med' 		=> array( 370, 208, true),
			'ureach-thumb-tiny' 		=> array(  90,  90, true),
			'ureach-thumb-team' 		=> array(  740,  896, true),
			'ureach-thumb-service' 	=> array(  1140,  696, true),
			'ureach-thumb-blogger' 	=> array(  740,  552, true),
			'ureach-thumb-blog' 	=> array(  740,  640, true),
			'ureach-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'ureach-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = ureach_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'ureach_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('ureach_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'ureach_customizer_image_sizes' );
	function ureach_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('ureach_filter_add_thumb_sizes', array(
			'ureach-thumb-huge'		=> esc_html__( 'Fullsize image', 'ureach' ),
			'ureach-thumb-big'			=> esc_html__( 'Large image', 'ureach' ),
			'ureach-thumb-med'			=> esc_html__( 'Medium image', 'ureach' ),
			'ureach-thumb-tiny'		=> esc_html__( 'Small square avatar', 'ureach' ),
			'ureach-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'ureach' ),
			'ureach-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'ureach' ),
			)
		);
		$mult = ureach_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'ureach' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'ureach_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'ureach_customizer_trx_addons_add_thumb_sizes');
	function ureach_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'ureach_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'ureach_customizer_trx_addons_get_thumb_size');
	function ureach_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-team',
							'trx_addons-thumb-team-@retina',
							'trx_addons-thumb-service',
							'trx_addons-thumb-service-@retina',
							'trx_addons-thumb-blogger',
							'trx_addons-thumb-blogger-@retina',
							'trx_addons-thumb-blog',
							'trx_addons-thumb-blog-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'ureach-thumb-huge',
							'ureach-thumb-huge-@retina',
							'ureach-thumb-big',
							'ureach-thumb-big-@retina',
							'ureach-thumb-med',
							'ureach-thumb-med-@retina',
							'ureach-thumb-tiny',
							'ureach-thumb-tiny-@retina',
							'ureach-thumb-team',
							'ureach-thumb-team-@retina',
							'ureach-thumb-service',
							'ureach-thumb-service-@retina',
							'ureach-thumb-blogger',
							'ureach-thumb-blogger-@retina',
							'ureach-thumb-blog',
							'ureach-thumb-blog-@retina',
							'ureach-thumb-masonry-big',
							'ureach-thumb-masonry-big-@retina',
							'ureach-thumb-masonry',
							'ureach-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>