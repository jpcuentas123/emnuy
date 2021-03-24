<?php
/**
 * Theme customizer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */



//--------------------------------------------------------------
//-- New panel in the Customizer Controls
//--------------------------------------------------------------

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('ureach_customizer_setup3')) {
	add_action( 'after_setup_theme', 'ureach_customizer_setup3', 3 );
	function ureach_customizer_setup3() {
		ureach_storage_merge_array('options', '', array(
			'cpt' => array(
				"title" => esc_html__('Custom post types', 'ureach'),
				"desc" => '',
				"type" => "panel"
				)
			)
		);
	}
}
// 3 - add/remove Theme Options elements
if (!function_exists('ureach_customizer_setup9999')) {
	add_action( 'after_setup_theme', 'ureach_customizer_setup9999', 9999 );
	function ureach_customizer_setup9999() {
		ureach_storage_merge_array('options', '', array(
			'cpt_end' => array(
				"type" => "panel_end"
				)
			)
		);
	}
}


//--------------------------------------------------------------
//-- Register Customizer Controls
//--------------------------------------------------------------

define('CUSTOMIZE_PRIORITY', 200);		// Start priority for the new controls

if (!function_exists('ureach_customizer_register_controls')) {
	add_action( 'customize_register', 'ureach_customizer_register_controls', 11 );
	function ureach_customizer_register_controls( $wp_customize ) {

		// Setup standard WP Controls
		// ---------------------------------
		
		// Remove unused sections
		$wp_customize->remove_section( 'colors');
		$wp_customize->remove_section( 'static_front_page');

		// Reorder standard WP sections
		$sec = $wp_customize->get_panel( 'nav_menus' );
		if (is_object($sec)) $sec->priority = 30;
		$sec = $wp_customize->get_panel( 'widgets' );
		if (is_object($sec)) $sec->priority = 40;
		$sec = $wp_customize->get_section( 'title_tagline' );
		if (is_object($sec)) $sec->priority = 50;
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) $sec->priority = 60;
		$sec = $wp_customize->get_section( 'header_image' );
		if (is_object($sec)) $sec->priority = 80;
		$sec = $wp_customize->get_section( 'custom_css' );
		if (is_object($sec)) {
			$sec->title = '* ' . $sec->title;
			$sec->priority = 2000;
		}
		
		// Modify standard WP controls
		$sec = $wp_customize->get_control( 'blogname' );
		if (is_object($sec))
			$sec->description = esc_html__('Use "[[" and "]]" to modify style and color of parts of the text, "||" to break current line',
											'ureach');
		$sec = $wp_customize->get_setting( 'blogname' );
		if (is_object($sec)) $sec->transport = 'postMessage';

		$sec = $wp_customize->get_setting( 'blogdescription' );
		if (is_object($sec)) $sec->transport = 'postMessage';
		
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) {
			$sec->title = esc_html__('Background', 'ureach');
			$sec->description = esc_html__('Used only if "Content - Body style" equal to "boxed"', 'ureach');
		}
		
		// Move standard option 'Background Color' to the section 'Background Image'
		$wp_customize->add_setting( 'background_color', array(
			'default'        => get_theme_support( 'custom-background', 'default-color' ),
			'theme_supports' => 'custom-background',
			'transport'		 => 'postMessage',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
			'label'   => esc_html__( 'Background color', 'ureach' ),
			'section' => 'background_image',
		) ) );
		

		// Add Theme specific controls
		// ---------------------------------
		
		$panels = array('');
		$p = 0;
		$sections = array('');
		$s = 0;
		$i = 0;

		// Reload Theme Options before create controls
		if (is_admin()) {
			ureach_storage_set('options_reloaded', true);
			ureach_load_theme_options();
		}
		$options = ureach_storage_get('options');
		
		foreach ($options as $id=>$opt) {
			
			$i++;
			
			if (!empty($opt['hidden'])) continue;
			
			if ($opt['type'] == 'panel') {

				$sec = $wp_customize->get_panel( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_panel( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($panels, $id);
				$p++;

			} else if ($opt['type'] == 'panel_end') {

				array_pop($panels);
				$p--;

			} else if ($opt['type'] == 'section') {

				$sec = $wp_customize->get_section( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_section( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'panel'  => esc_attr($panels[$p]),
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($sections, $id);
				$s++;

			} else if ($opt['type'] == 'section_end') {

				array_pop($sections);
				$s--;

			} else if ($opt['type'] == 'select') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'select',
					'choices'  => apply_filters('ureach_filter_options_get_list_choises', $opt['options'], $id)
				) );

			} else if ($opt['type'] == 'radio') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'radio',
					'choices'  => apply_filters('ureach_filter_options_get_list_choises', $opt['options'], $id)
				) );

			} else if ($opt['type'] == 'switch') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Ureach_Customize_Switch_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'choices'  => apply_filters('ureach_filter_options_get_list_choises', $opt['options'], $id)
				) ) );

			} else if ($opt['type'] == 'checkbox') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'checkbox'
				) );

			} else if ($opt['type'] == 'color') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'image') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if (in_array($opt['type'], array('media', 'audio', 'video'))) {
				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'icon') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Ureach_Customize_Icon_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'input_attrs' => array(
						'value' => ureach_get_theme_option($id),
					)
				) ) );

			} else if ($opt['type'] == 'checklist') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Ureach_Customize_Checklist_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'choices' => apply_filters('ureach_filter_options_get_list_choises', $opt['options'], $id),
					'input_attrs' => array(
						'value' => ureach_get_theme_option($id),
						'sortable' => !empty($opt['sortable']),
						'dir' => !empty($opt['dir']) ? $opt['dir'] : 'horizontal'
					)
				) ) );

			} else if ($opt['type'] == 'scheme_editor') {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Ureach_Customize_Scheme_Editor_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'input_attrs' => array(
						'value' => ureach_get_theme_option($id),
					)
				) ) );

			} else if ($opt['type'] == 'button') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );

				$wp_customize->add_control( new Ureach_Customize_Button_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'input_attrs' => array(
						'caption' => $opt['caption'],
						'action' => $opt['action']
					),
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'info') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => '',
					'sanitize_callback' => 'ureach_sanitize_value',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Ureach_Customize_Info_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'hidden') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_html',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Ureach_Customize_Hidden_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else {

				$wp_customize->add_setting( $id, array(
					'default'           => ureach_get_theme_option($id),
					'sanitize_callback' => 'ureach_sanitize_html',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => $opt['type']
				) );
			}

		}
	}
}


// Create custom controls for customizer
if (!function_exists('ureach_customizer_custom_controls')) {
	add_action( 'customize_register', 'ureach_customizer_custom_controls' );
	function ureach_customizer_custom_controls( $wp_customize ) {
	
		class Ureach_Customize_Info_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php ureach_show_layout( $this->description ); ?></span><?php
				}
				?></label><?php
			}
		}
	
		class Ureach_Customize_Switch_Control extends WP_Customize_Control {
			public $type = 'switch';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php ureach_show_layout( $this->description ); ?></span><?php
				}
				if (is_array($this->choices) && count($this->choices)>0) {
					foreach ($this->choices as $k=>$v) {
						?><label><input type="radio" name="_customize-radio-<?php echo esc_attr($this->id); ?>" <?php
										$this->link();
										?> value="<?php echo esc_attr($k); ?>">
						<?php echo esc_html($v); ?></label><?php
					}
				}
				?></label><?php
			}
		}
	
		class Ureach_Customize_Icon_Control extends WP_Customize_Control {
			public $type = 'icon';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php ureach_show_layout( $this->description ); ?></span><?php
				}
				?><span class="customize-control-field-wrap"><input type="text" <?php $this->link(); ?> /><?php
				ureach_show_layout(ureach_show_custom_field('_customize-icon-selector-'.esc_attr($this->id),
															array(
																'type'	 => 'icons',
																'button' => true,
																'icons'	 => true
															),
															$this->input_attrs['value']
															)
									);
				?></span></label><?php
			}
		}
	
		class Ureach_Customize_Checklist_Control extends WP_Customize_Control {
			public $type = 'checklist';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php ureach_show_layout( $this->description ); ?></span><?php
				}
				?><span class="customize-control-field-wrap"><input type="hidden" <?php $this->link(); ?> /><?php
				ureach_show_layout(ureach_show_custom_field('_customize-checklist-'.esc_attr($this->id),
															array(
																'type'	 => 'checklist',
																'options' => $this->choices,
																'sortable' => !empty($this->input_attrs['sortable']),
																'dir' => !empty($this->input_attrs['dir']) ? $this->input_attrs['dir'] : 'horizontal'
															),
															$this->input_attrs['value']
															)
									);
				?></span></label><?php
			}
		}
	
		class Ureach_Customize_Button_Control extends WP_Customize_Control {
			public $type = 'button';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php ureach_show_layout( $this->description ); ?></span><?php
				}
				?>
				<input type="button" 
						name="_customize-button-<?php echo esc_attr($this->id); ?>" 
						value="<?php echo esc_attr($this->input_attrs['caption']); ?>"
						data-action="<?php echo esc_attr($this->input_attrs['action']); ?>">
				</label>
				<?php
			}
		}

		class Ureach_Customize_Hidden_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?><input type="hidden" name="_customize-hidden-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value=""><?php
			}
		}
	
		class Ureach_Customize_Scheme_Editor_Control extends WP_Customize_Control {
			public $type = 'scheme_editor';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php ureach_show_layout( $this->description ); ?></span><?php
				}
				?><span class="customize-control-field-wrap"><input type="hidden" <?php $this->link(); ?> /><?php
				ureach_show_layout(ureach_show_custom_field('_customize-scheme-editor-'.esc_attr($this->id),
															array('type' => 'scheme_editor'),
															ureach_unserialize($this->input_attrs['value'])
															)
									);
				?></span></label><?php
			}
		}
	
	}
}


// Sanitize plain value
if (!function_exists('ureach_sanitize_value')) {
	function ureach_sanitize_value($value) {
		return empty($value) ? $value : trim(strip_tags($value));
	}
}


// Sanitize html value
if (!function_exists('ureach_sanitize_html')) {
	function ureach_sanitize_html($value) {
		return empty($value) ? $value : wp_kses($value, 'ureach_kses_content');
	}
}


//--------------------------------------------------------------
// Save custom settings in CSS file
//--------------------------------------------------------------

// Save CSS with custom colors and fonts after save custom options
if (!function_exists('ureach_customizer_action_save_after')) {
	add_action('customize_save_after', 'ureach_customizer_action_save_after');
	function ureach_customizer_action_save_after($api=false) {

		// Get saved settings
		$settings = $api->settings();

		// Store new schemes colors
		$schemes = ureach_unserialize($settings['scheme_storage']->value());
		if (is_array($schemes) && count($schemes) > 0) 
			ureach_storage_set('schemes', $schemes);

		// Store new fonts parameters
		$fonts = ureach_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = $settings["{$tag}_{$css_prop}"]->value();
			}
		}
		ureach_storage_set('theme_fonts', $fonts);

		// Regenerate CSS with new colors
		ureach_customizer_save_css();
	}
}

// Save CSS with custom colors and fonts after switch theme
if (!function_exists('ureach_customizer_action_switch_theme')) {
	add_action('after_switch_theme', 'ureach_customizer_action_switch_theme');
	function ureach_customizer_action_switch_theme() {
		// Remove condition if you want regenerate css after switch to this theme
		if (false) ureach_customizer_save_css();
	}
}

// Save CSS with custom colors and fonts into custom.css
if (!function_exists('ureach_customizer_save_css')) {
	add_action('trx_addons_action_save_options', 'ureach_customizer_save_css');
	function ureach_customizer_save_css() {
		$msg = 	'/* ' . esc_html__("ATTENTION! This file was generated automatically! Don't change it!!!", 'ureach') 
				. "\n----------------------------------------------------------------------- */\n";

		// Save CSS with custom colors and fonts into custom.css
		$css = ureach_customizer_get_css();
		$file = ureach_get_file_dir('css/__colors.css');
		if (file_exists($file)) ureach_fpc($file, $msg . $css );

		// Merge stylesheets
		$list = apply_filters( 'ureach_filter_merge_styles', array() );
		$css = '';
		foreach ($list as $f) {
			$css .= ureach_fgc(ureach_get_file_dir($f));
		}
		if ( $css != '') {
			ureach_fpc( ureach_get_file_dir('css/__styles.css'), $msg . apply_filters( 'ureach_filter_prepare_css', $css, true ) );
		}

		// Merge scripts
		$list = apply_filters( 'ureach_filter_merge_scripts', array(
																	'js/skip-link-focus.js',
																	'js/bideo.js',
																	'js/jquery.tubular.js',
																	'js/_utils.js',
																	'js/_init.js'
																	)
							);
		$js = '';
		foreach ($list as $f) {
			$js .= ureach_fgc(ureach_get_file_dir($f));
		}
		if ( $js != '') {
			ureach_fpc( ureach_get_file_dir('js/__scripts.js'), $msg . apply_filters( 'ureach_filter_prepare_js', $js, true ) );
		}
	}
}


//--------------------------------------------------------------
// Border radius settings
//--------------------------------------------------------------

// Return current theme-specific border radius for form's fields and buttons
if ( !function_exists( 'ureach_get_border_radius' ) ) {
	function ureach_get_border_radius() {
		$rad = str_replace(' ', '', ureach_get_theme_option('border_radius'));
		if (empty($rad)) $rad = 0;
		return ureach_prepare_css_value($rad); 
	}
}


//--------------------------------------------------------------
// Color schemes manipulations
//--------------------------------------------------------------

// Load saved values into color schemes
if (!function_exists('ureach_load_schemes')) {
	add_action('ureach_action_load_options', 'ureach_load_schemes');
	function ureach_load_schemes() {
		$schemes = ureach_storage_get('schemes');
		$storage = ureach_unserialize(ureach_get_theme_option('scheme_storage'));
		if (is_array($storage) && count($storage) > 0)  {
			foreach ($storage as $k=>$v) {
				if (isset($schemes[$k])) {
					$schemes[$k] = $v;
				}
			}
			ureach_storage_set('schemes', $schemes);
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( !function_exists( 'ureach_get_scheme_color' ) ) {
	function ureach_get_scheme_color($color_name, $scheme = '') {
		if (empty($scheme)) $scheme = ureach_get_theme_option( 'color_scheme' );
		if (empty($scheme) || ureach_storage_empty('schemes', $scheme)) $scheme = 'default';
		$colors = ureach_storage_get_array('schemes', $scheme, 'colors');
		return $colors[$color_name];
	}
}

// Return colors from current color scheme
if ( !function_exists( 'ureach_get_scheme_colors' ) ) {
	function ureach_get_scheme_colors($scheme = '') {
		if (empty($scheme)) $scheme = ureach_get_theme_option( 'color_scheme' );
		if (empty($scheme) || ureach_storage_empty('schemes', $scheme)) $scheme = 'default';
		return ureach_storage_get_array('schemes', $scheme, 'colors');
	}
}

// Return colors from all schemes
if ( !function_exists( 'ureach_get_scheme_storage' ) ) {
	function ureach_get_scheme_storage($scheme = '') {
		return serialize(ureach_storage_get('schemes'));
	}
}


// Return schemes list
if ( !function_exists( 'ureach_get_list_schemes' ) ) {
	function ureach_get_list_schemes($prepend_inherit=false) {
		$list = array();
		$schemes = ureach_storage_get('schemes');
		if (is_array($schemes) && count($schemes) > 0) {
			foreach ($schemes as $slug => $scheme) {
				$list[$slug] = $scheme['title'];
			}
		}
		return $prepend_inherit ? ureach_array_merge(array('inherit' => esc_html__("Inherit", 'ureach')), $list) : $list;
	}
}


//--------------------------------------------------------------
// Theme fonts
//--------------------------------------------------------------

// Load saved values into fonts list
if (!function_exists('ureach_load_fonts')) {
	add_action('ureach_action_load_options', 'ureach_load_fonts');
	function ureach_load_fonts() {
		// Fonts to load when theme starts
		$fonts = array();
		for ($i=1; $i<=ureach_get_theme_setting('max_load_fonts'); $i++) {
			if (($name = ureach_get_theme_option("load_fonts-{$i}-name")) != '') {
				$fonts[] = array(
					'name'	 => $name,
					'family' => ureach_get_theme_option("load_fonts-{$i}-family"),
					'styles' => ureach_get_theme_option("load_fonts-{$i}-styles")
				);
			}
		}
		ureach_storage_set('load_fonts', $fonts);
		ureach_storage_set('load_fonts_subset', ureach_get_theme_option("load_fonts_subset"));
		
		// Font parameters of the main theme's elements
		$fonts = ureach_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = ureach_get_theme_option("{$tag}_{$css_prop}");
			}
		}
		ureach_storage_set('theme_fonts', $fonts);
	}
}

// Return slug of the loaded font
if (!function_exists('ureach_get_load_fonts_slug')) {
	function ureach_get_load_fonts_slug($name) {
		return str_replace(' ', '-', $name);
	}
}

// Return load fonts parameter's default value
if (!function_exists('ureach_get_load_fonts_option')) {
	function ureach_get_load_fonts_option($option_name) {
		$rez = '';
		$parts = explode('-', $option_name);
		$load_fonts = ureach_storage_get('load_fonts');
		if ($parts[0] == 'load_fonts' && is_array($load_fonts) && count($load_fonts) > $parts[1]-1 && isset($load_fonts[$parts[1]-1][$parts[2]])) {
			$rez = $load_fonts[$parts[1]-1][$parts[2]];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if (!function_exists('ureach_get_load_fonts_subset')) {
	function ureach_get_load_fonts_subset($option_name) {
		return ureach_storage_get('load_fonts_subset');
	}
}

// Return load fonts list
if (!function_exists('ureach_get_list_load_fonts')) {
	function ureach_get_list_load_fonts($prepend_inherit=false) {
		$list = array();
		$load_fonts = ureach_storage_get('load_fonts');
		if (is_array($load_fonts) && count($load_fonts) > 0) {
			foreach ($load_fonts as $font) {
				$list[sprintf('%s%s', 
								strpos($font['name'], ' ')!==false ? sprintf('"%s"', $font['name']) : $font['name'],
								!empty($font['family']) ? ', '.trim($font['family']): '')] = $font['name'];
			}
		}
		return $prepend_inherit ? ureach_array_merge(array('inherit' => esc_html__("Inherit", 'ureach')), $list) : $list;
	}
}

// Return font settings of the theme specific elements
if ( !function_exists( 'ureach_get_theme_fonts' ) ) {
	function ureach_get_theme_fonts() {
		return ureach_storage_get('theme_fonts');
	}
}

// Return theme fonts parameter's default value
if (!function_exists('ureach_get_theme_fonts_option')) {
	function ureach_get_theme_fonts_option($option_name) {
		$rez = '';
		$parts = explode('_', $option_name);
		$theme_fonts = ureach_storage_get('theme_fonts');
		if (!empty($theme_fonts[$parts[0]][$parts[1]])) {
			$rez = $theme_fonts[$parts[0]][$parts[1]];
		}
		// For the font-families update options list also
		if ($parts[1] == 'font-family') {
			ureach_storage_set_array2('options', $option_name, 'options', ureach_get_list_load_fonts(true));
		}
		return $rez;
	}
}


//--------------------------------------------------------------
// Customizer JS and CSS
//--------------------------------------------------------------

// Binds JS listener to make Customizer color_scheme control.
// Passes color scheme data as colorScheme global.
if ( !function_exists( 'ureach_customizer_control_js' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'ureach_customizer_control_js' );
	function ureach_customizer_control_js() {
		wp_enqueue_style( 'ureach-customizer', ureach_get_file_url('theme-options/theme.customizer.css') );
		wp_enqueue_script( 'ureach-customizer-color-scheme-control',
									ureach_get_file_url('theme-options/theme.customizer.color-scheme.js'),
									array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true );
		wp_localize_script( 'ureach-customizer-color-scheme-control', 'ureach_color_schemes', ureach_storage_get('schemes') );
		wp_localize_script( 'ureach-customizer-color-scheme-control', 'ureach_theme_fonts', ureach_storage_get('theme_fonts') );
		wp_localize_script( 'ureach-customizer-color-scheme-control', 'ureach_customizer_vars', array(
			'max_load_fonts' => ureach_get_theme_setting('max_load_fonts'),
			'msg_refresh' => esc_html__('Refresh', 'ureach'),
			'msg_reset' => esc_html__('Reset', 'ureach'),
			'msg_reset_confirm' => esc_html__('Are you sure you want to reset all Theme Options?', 'ureach'),
			) );
		wp_localize_script( 'ureach-customizer-color-scheme-control', 'ureach_dependencies', ureach_get_theme_dependencies() );
	}
}

// Binds JS handlers to make the Customizer preview reload changes asynchronously.
if ( !function_exists( 'ureach_customizer_preview_js' ) ) {
	add_action( 'customize_preview_init', 'ureach_customizer_preview_js' );
	function ureach_customizer_preview_js() {
		wp_enqueue_script( 'ureach-customize-preview',
							ureach_get_file_url('theme-options/theme.customizer.preview.js'), 
							array( 'customize-preview' ), null, true );
	}
}

// Output an Underscore template for generating CSS for the color scheme.
// The template generates the css dynamically for instant display in the Customizer preview.
if ( !function_exists( 'ureach_customizer_css_template' ) ) {
	add_action( 'customize_controls_print_footer_scripts', 'ureach_customizer_css_template' );
	function ureach_customizer_css_template() {
		$colors = array();
		foreach (ureach_get_scheme_colors() as $k=>$v)
			$colors[$k] = '{{ data.'.esc_attr($k).' }}';

		$tmpl_holder = 'script';

		$schemes = array_keys(ureach_get_list_schemes());
		if (is_array($schemes) && count($schemes) > 0) {
			foreach ($schemes as $scheme) {
				echo '<' . esc_attr($tmpl_holder) . ' type="text/html" id="tmpl-ureach-color-scheme-'.esc_attr($scheme).'">'
						. ureach_customizer_get_css( $colors, false, false, $scheme )
					. '</' . esc_attr($tmpl_holder) . '>';
			}
		}


		// Fonts
		$fonts = ureach_get_theme_fonts();
		if (is_array($fonts) && count($fonts) > 0) {
			foreach ($fonts as $tag => $font) {
				$fonts[$tag]['font-family']		= '{{ data["'.$tag.'"]["font-family"] }}';
				$fonts[$tag]['font-size']		= '{{ data["'.$tag.'"]["font-size"] }}';
				$fonts[$tag]['line-height']		= '{{ data["'.$tag.'"]["line-height"] }}';
				$fonts[$tag]['font-weight']		= '{{ data["'.$tag.'"]["font-weight"] }}';
				$fonts[$tag]['font-style']		= '{{ data["'.$tag.'"]["font-style"] }}';
				$fonts[$tag]['text-decoration']	= '{{ data["'.$tag.'"]["text-decoration"] }}';
				$fonts[$tag]['text-transform']	= '{{ data["'.$tag.'"]["text-transform"] }}';
				$fonts[$tag]['letter-spacing']	= '{{ data["'.$tag.'"]["letter-spacing"] }}';
				$fonts[$tag]['margin-top']		= '{{ data["'.$tag.'"]["margin-top"] }}';
				$fonts[$tag]['margin-bottom']	= '{{ data["'.$tag.'"]["margin-bottom"] }}';
			}
			echo '<'.trim($tmpl_holder).' type="text/html" id="tmpl-ureach-fonts">'
					. trim(ureach_customizer_get_css( false, $fonts, false, false ))
				. '</'.trim($tmpl_holder).'>';
		}

	}
}


// Add scheme name in each selector in the CSS (priority 100 - after complete css)
if (!function_exists('ureach_customizer_add_scheme_in_css')) {
	add_action( 'ureach_filter_get_css', 'ureach_customizer_add_scheme_in_css', 100, 4 );
	function ureach_customizer_add_scheme_in_css($css, $colors, $fonts, $scheme) {
		if ($colors && !empty($css['colors'])) {
			$rez = '';
			$in_comment = $in_rule = false;
			$allow = true;
			$scheme_class = sprintf('.scheme_%s ', $scheme);
			$self_class = '.scheme_self';
			$self_class_len = strlen($self_class);
			$css_str = str_replace(array('{{', '}}'), array('[[',']]'), $css['colors']);
			for ($i=0; $i<strlen($css_str); $i++) {
				$ch = $css_str[$i];
				if ($in_comment) {
					$rez .= $ch;
					if ($ch=='/' && $css_str[$i-1]=='*') {
						$in_comment = false;
						$allow = !$in_rule;
					}
				} else if ($in_rule) {
					$rez .= $ch;
					if ($ch=='}') {
						$in_rule = false;
						$allow = !$in_comment;
					}
				} else {
					if ($ch=='/' && $css_str[$i+1]=='*') {
						$rez .= $ch;
						$in_comment = true;
					} else if ($ch=='{') {
						$rez .= $ch;
						$in_rule = true;
					} else if ($ch==',') {
						$rez .= $ch;
						$allow = true;
					} else if (strpos(" \t\r\n", $ch)===false) {
						if ($allow) {
							$pos_comma = strpos($css_str, ',', $i+1);
							$pos_bracket = strpos($css_str, '{', $i+1);
							$pos = $pos_comma === false
										? $pos_bracket
										: ($pos_bracket === false
												? $pos_comma
												: min($pos_comma, $pos_bracket)
											);
							$selector = $pos > 0 ? substr($css_str, $i, $pos-$i) : '';
							if (strpos($selector, $self_class) !== false) {
								$rez .= str_replace($self_class, trim($scheme_class), $selector);
								$i += strlen($selector) - 1;
							} else {
								$rez .= $scheme_class . trim($ch);
							}
							$allow = false;
						} else
							$rez .= $ch;
					} else {
						$rez .= $ch;
					}
				}
			}
			$rez = str_replace(array('[[',']]'), array('{{', '}}'), $rez);
			$css['colors'] = $rez;
		}
		return $css;
	}
}
	



// -----------------------------------------------------------------
// -- Page Options section
// -----------------------------------------------------------------

if ( !function_exists('ureach_init_override_options') ) {
	add_action( 'after_setup_theme', 'ureach_init_override_options' );
	function ureach_init_override_options() {
		if ( is_admin() ) {
			add_action("admin_enqueue_scripts", 'ureach_add_override_options_scripts');
			add_action('save_post',			'ureach_save_override_options');
			add_filter('ureach_filter_override_options',	'ureach_add_override_options');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'ureach_add_override_options_scripts' ) ) {
	add_action("admin_enqueue_scripts", 'ureach_add_override_options_scripts');
	function ureach_add_override_options_scripts() {
		// If current screen is 'Edit Page' - load fontello
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && ureach_allow_override_options(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
			wp_enqueue_style( 'fontello-icons',  ureach_get_file_url('css/fontello/fontello-embedded.css') );
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui'), null, true);
			wp_enqueue_script( 'ureach-override-options', ureach_get_file_url('theme-options/theme.override-options.js'), array('jquery'), null, true );
			wp_localize_script( 'ureach-override-options', 'ureach_dependencies', ureach_get_theme_dependencies() );
		}
	}
}


// Check if override options is allow
if (!function_exists('ureach_allow_override_options')) {
	function ureach_allow_override_options($post_type) {
		return apply_filters('ureach_filter_allow_override_options', in_array($post_type, array('page', 'post')), $post_type);
	}
}

// Add override options
if (!function_exists('ureach_add_override_options')) {
	function ureach_add_override_options($list = array()) {
		global $post_type;
		if (ureach_allow_override_options($post_type)) {
			$list[] = array(sprintf('ureach_override_options_%s', $post_type),
						esc_html__('Theme Options', 'ureach'),
						'ureach_show_override_options',
						$post_type,
						$post_type=='post' ? 'side' : 'advanced',
						'default');
		}

		return $list;
	}
}

// Callback function to show fields in override options
if (!function_exists('ureach_show_override_options')) {
	function ureach_show_override_options() {
		global $post, $post_type;
		if (ureach_allow_override_options($post_type)) {
			// Load saved options 
			$meta = get_post_meta($post->ID, 'ureach_options', true);
			$tabs_titles = $tabs_content = array();
			global $UREACH_STORAGE;
			// Refresh linked data if this field is controller for the another (linked) field
			// Do this before show fields to refresh data in the $UREACH_STORAGE
			foreach ($UREACH_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (!empty($v['linked'])) {
					$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
					if (!empty($v['val']) && !ureach_is_inherit($v['val']))
						ureach_refresh_linked_data($v['val'], $v['linked']);
				}
			}
			// Show fields
			foreach ($UREACH_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (empty($v['override']['section']))
					$v['override']['section'] = esc_html__('General', 'ureach');
				if (!isset($tabs_titles[$v['override']['section']])) {
					$tabs_titles[$v['override']['section']] = $v['override']['section'];
					$tabs_content[$v['override']['section']] = '';
				}
				$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
				$tabs_content[$v['override']['section']] .= ureach_show_override_options_field($k, $v);
			}
			if (is_array($tabs_titles) && count($tabs_titles) > 0) {
				?>
				<div class="ureach_override_options">
					<input type="hidden" name="override_options_post_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
					<input type="hidden" name="override_options_post_type" value="<?php echo esc_attr($post_type); ?>" />
					<div id="ureach_override_options_tabs">
						<ul><?php
							$cnt = 0;
							foreach ($tabs_titles as $k=>$v) {
								$cnt++;
								?><li><a href="#ureach_override_options_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
							}
						?></ul>
						<?php
							$cnt = 0;
							foreach ($tabs_content as $k=>$v) {
								$cnt++;
								?>
								<div id="ureach_override_options_<?php echo esc_attr($cnt); ?>" class="ureach_override_options_section">
									<?php ureach_show_layout($v); ?>
								</div>
								<?php
							}
						?>
					</div>
				</div>
				<?php		
			}
		}
	}
}

// Display single option's field
if ( !function_exists('ureach_show_override_options_field') ) {
	function ureach_show_override_options_field($name, $field) {

		if ($field['type'] == 'hidden') return '';

		$inherit_state = ureach_is_inherit($field['val']);
		$output = '<div class="ureach_override_options_item ureach_override_options_item_'.esc_attr($field['type'])
								. ' ureach_override_options_inherit_'.($inherit_state ? 'on' : 'off' )
								. '">'
						. '<h4 class="ureach_override_options_item_title">'
							. esc_html($field['title'])
							. '<span class="ureach_override_options_inherit_lock" id="ureach_override_options_inherit_'.esc_attr($name).'"></span>'
						. '</h4>'
						. '<div class="ureach_override_options_item_data">'
							. '<div class="ureach_override_options_item_field" data-param="'.esc_attr($name).'"'
									. (!empty($field['linked']) ? ' data-linked="'.esc_attr($field['linked']).'"' : '')
									. '>';
	
		// Type 'checkbox'
		if ($field['type']=='checkbox') {
			$output .= '<label class="ureach_override_options_item_label">'
						. '<input type="checkbox" name="ureach_override_options_field_'.esc_attr($name).'" value="1"'
								.($field['val']==1 ? ' checked="checked"' : '')
								.' />'
						. esc_html($field['title'])
					. '</label>';
		
		// Type 'switch' (2 choises) or 'radio' (3+ choises)
		} else if (in_array($field['type'], array('switch', 'radio'))) {
			$field['options'] = apply_filters('ureach_filter_options_get_list_choises', $field['options'], $name);
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="ureach_override_options_item_label">'
							. '<input type="radio" name="ureach_override_options_field_'.esc_attr($name).'"'
									. ' value="'.esc_attr($k).'"'.($field['val']==$k ? ' checked="checked"' : '')
									. ' />'
							. esc_html($v)
						. '</label>';
			}

		// Type 'text' or 'time' or 'date'
		} else if (in_array($field['type'], array('text', 'time', 'date'))) {
			$output .= '<input type="text" name="ureach_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(ureach_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />';
		
		// Type 'textarea'
		} else if ($field['type']=='textarea') {
			$output .= '<textarea name="ureach_override_options_field_'.esc_attr($name).'">'
							. esc_html(ureach_is_inherit($field['val']) ? '' : $field['val'])
						. '</textarea>';
			
		// Type 'select'
		} else if ($field['type']=='select') {
			$field['options'] = apply_filters('ureach_filter_options_get_list_choises', $field['options'], $name);
			$output .= '<select size="1" name="ureach_override_options_field_'.esc_attr($name).'">';
			foreach ($field['options'] as $k=>$v) {
				$output .= '<option value="'.esc_attr($k).'"'.($field['val']==$k ? ' selected="selected"' : '').'>'.esc_html($v).'</option>';
			}
			$output .= '</select>';

		// Type 'image', 'media', 'video' or 'audio'
		} else if (in_array($field['type'], array('image', 'media', 'video', 'audio'))) {
			$output .= (!empty($field['multiple'])
						? '<input type="hidden" id="ureach_override_options_field_'.esc_attr($name).'"'
							. ' name="ureach_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(ureach_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						: '<input type="text" id="ureach_override_options_field_'.esc_attr($name).'"'
							. ' name="ureach_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(ureach_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />')
					. ureach_show_custom_field('ureach_override_options_field_'.esc_attr($name).'_button',
												array(
													'type'			 => 'mediamanager',
													'multiple'		 => !empty($field['multiple']),
													'data_type'		 => $field['type'],
													'linked_field_id'=> 'ureach_override_options_field_'.esc_attr($name)
												),
												ureach_is_inherit($field['val']) ? '' : $field['val']);
		
		// Type 'icon'
		} else if ($field['type']=='icon') {
			$output .= '<input type="text" id="ureach_override_options_field_'.esc_attr($name).'"'
							. ' name="ureach_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(ureach_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. ureach_show_custom_field('ureach_override_options_field_'.esc_attr($name).'_button',
													array(
														'type'	 => 'icons',
														'button' => true,
														'icons'	 => true
													),
													$field['val']);
		
		// Type 'checklist'
		} else if ($field['type']=='checklist') {
			$output .= '<input type="hidden" id="ureach_override_options_field_'.esc_attr($name).'"'
							. ' name="ureach_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(ureach_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. ureach_show_custom_field('ureach_override_options_field_'.esc_attr($name).'_list',
													array(
														'type'	 => 'checklist',
														'options' => $field['options'],
														'sortable' => !empty($field['sortable']),
														'dir' => !empty($field['dir']) ? $field['dir'] : 'horizontal'
													),
													$field['val']);
		}
		
		$output .= '<div class="ureach_override_options_inherit_cover'.(!$inherit_state ? ' ureach_hidden' : '').'">'
							. '<span class="ureach_override_options_inherit_label">' . esc_html__('Inherit', 'ureach') . '</span>'
							. '<input type="hidden" name="ureach_override_options_inherit_'.esc_attr($name).'"'
									. ' value="'.esc_attr($inherit_state ? 'inherit' : '').'"'
									. ' />'
						. '</div>'
					. '</div>'
					. '<div class="ureach_override_options_item_description">'
						. (!empty($field['override']['desc'])
								? $field['override']['desc'] 
								: $field['desc'])
					. '</div>'
				. '</div>'
			. '</div>';
		return $output;
	}
}

// Save data from override options
if (!function_exists('ureach_save_override_options')) {
	
	function ureach_save_override_options($post_id) {

		// verify nonce
		if ( !wp_verify_nonce( ureach_get_value_gp('override_options_post_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$post_type = isset($_POST['override_options_post_type']) ?  sanitize_text_field($_POST['override_options_post_type']) :  sanitize_text_field($_POST['post_type']);

		// check permissions
		$capability = 'page';
		$post_types = get_post_types( array( 'name' => $post_type), 'objects' );
		if (!empty($post_types) && is_array($post_types)) {
			foreach ($post_types  as $type) {
				$capability = $type->capability_type;
				break;
			}
		}
		if (!current_user_can('edit_'.($capability), $post_id)) {
			return $post_id;
		}

		// Save meta
		$meta = array();
		$options = ureach_storage_get('options');
		foreach ($options as $k=>$v) {
			// Skip not overriden options
			if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
			// Skip inherited options
			if (!empty($_POST['ureach_override_options_inherit_' . $k])) continue;
			// Get option value from POST
			$meta[$k] = isset($_POST['ureach_override_options_field_' . $k])
							? $_POST['ureach_override_options_field_' . $k]
							: ($v['type']=='checkbox' ? 0 : '');
		}
		update_post_meta($post_id, 'ureach_options', $meta);
		
		// Save separate meta options to search template pages
		if ($post_type=='page' && !empty($_POST['page_template']) && $_POST['page_template']=='blog.php') {
			update_post_meta($post_id, 'ureach_options_post_type', isset($meta['post_type']) ? $meta['post_type'] : 'post');
			update_post_meta($post_id, 'ureach_options_parent_cat', isset($meta['parent_cat']) ? $meta['parent_cat'] : 0);
		}
	}
}

// Refresh data in the linked field
// according the main field value
if (!function_exists('ureach_refresh_linked_data')) {
	function ureach_refresh_linked_data($value, $linked_name) {
		if ($linked_name == 'parent_cat') {
			$tax = ureach_get_post_type_taxonomy($value);
			$terms = !empty($tax) ? ureach_get_list_terms(false, $tax) : array();
			$terms = ureach_array_merge(array(0 => esc_html__('- Select category -', 'ureach')), $terms);
			ureach_storage_set_array2('options', $linked_name, 'options', $terms);
		}
	}
}

// AJAX: Refresh data in the linked fields
if (!function_exists('ureach_callback_get_linked_data')) {
	add_action('wp_ajax_ureach_get_linked_data', 		'ureach_callback_get_linked_data');
	add_action('wp_ajax_nopriv_ureach_get_linked_data','ureach_callback_get_linked_data');
	function ureach_callback_get_linked_data() {
		if ( !wp_verify_nonce( ureach_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			wp_die();
		$chg_name = sanitize_text_field($_REQUEST['chg_name']);
		$chg_value = sanitize_text_field($_REQUEST['chg_value']);
		$response = array('error' => '');
		if ($chg_name == 'post_type') {
			$tax = ureach_get_post_type_taxonomy($chg_value);
			$terms = !empty($tax) ? ureach_get_list_terms(false, $tax) : array();
			$response['list'] = ureach_array_merge(array(0 => esc_html__('- Select category -', 'ureach')), $terms);
		}
		echo json_encode($response);
		wp_die();
	}
}

// Show theme specific fields in the override options
function ureach_show_custom_field($id, $field, $value) {
	$output = '';
	switch ($field['type']) {
		
		case 'mediamanager':
			wp_enqueue_media( );
			$title = empty($field['data_type']) || $field['data_type']=='image'
							? esc_html__( 'Choose Image', 'ureach')
							: esc_html__( 'Choose Media', 'ureach');
			$output .= '<a id="'.esc_attr($id).'"'
							. ' class="button mediamanager ureach_media_selector"'
							. '	data-param="' . esc_attr($id) . '"'
							. '	data-choose="'.esc_attr(!empty($field['multiple']) ? esc_html__( 'Choose Images', 'ureach') : $title).'"'
							. ' data-update="'.esc_attr(!empty($field['multiple']) ? esc_html__( 'Add to Gallery', 'ureach') : $title).'"'
							. '	data-multiple="'.esc_attr(!empty($field['multiple']) ? '1' : '0').'"'
							. '	data-type="'.esc_attr(!empty($field['data_type']) ? $field['data_type'] : 'image').'"'
							. '	data-linked-field="'.esc_attr($field['linked_field_id']).'"'
							. '>'
							. (!empty($field['multiple'])
									? (empty($field['data_type']) || $field['data_type']=='image'
										? esc_html__( 'Add Images', 'ureach')
										: esc_html__( 'Add Files', 'ureach')
										)
									: esc_html($title)
								)
							. '</a>';
			$output .= '<span class="ureach_override_options_field_preview">';
			$images = explode('|', $value);
			if (is_array($images)) {
				foreach ($images as $img)
					$output .= $img && !ureach_is_inherit($img)
							? '<span>'
									. (in_array(ureach_get_file_ext($img), array('gif', 'jpg', 'jpeg', 'png'))
											? '<img src="' . esc_url($img) . '" alt="' . esc_attr__('Image', 'ureach') . '">'
											: '<a href="' . esc_url($img) . '">' . esc_html(basename($img)) . '</a>'
										)
								. '</span>' 
							: '';
			}
			$output .= '</span>';
			break;

		case 'icons':
			$icons_type = !empty($field['style']) 
							? $field['style'] 
							: ureach_get_theme_setting('icons_type');
			if (empty($field['return']))
				$field['return'] = 'full';
			$ureach_icons = $icons_type=='images'
								? ureach_get_list_images()
								: ureach_array_from_list(ureach_get_list_icons());
			if (is_array($ureach_icons)) {
				if (!empty($field['button']))
					$output .= '<span id="'.esc_attr($id).'"'
									. ' class="ureach_list_icons_selector'
											. ($icons_type=='icons' && !empty($value) ? ' '.esc_attr($value) : '')
											.'"'
									. ' title="'.esc_attr__('Select icon', 'ureach').'"'
									. ' data-style="'.($icons_type=='images' ? 'images' : 'icons').'"'
									. ($icons_type=='images' && !empty($value) 
										? ' style="background-image: url('.esc_url($field['return']=='slug' 
																							? $ureach_icons[$value] 
																							: $value).');"' 
											: '')
								. '></span>';
				if (!empty($field['icons'])) {
					$output .= '<div class="ureach_list_icons">';
					foreach($ureach_icons as $slug=>$icon) {
						$output .= '<span class="'.esc_attr($icons_type=='icons' ? $icon : $slug)
								. (($field['return']=='full' ? $icon : $slug) == $value ? ' ureach_list_active' : '')
								. '"'
								. ' title="'.esc_attr($slug).'"'
								. ' data-icon="'.esc_attr($field['return']=='full' ? $icon : $slug).'"'
								. ($icons_type=='images' ? ' style="background-image: url('.esc_url($icon).');"' : '')
								. '></span>';
					}
					$output .= '</div>';
				}
			}
			break;

		case 'checklist':
			if (!empty($field['sortable']))
				wp_enqueue_script('jquery-ui-sortable', false, array('jquery', 'jquery-ui-core'), null, true);
			$output .= '<div class="ureach_checklist ureach_checklist_'.esc_attr($field['dir'])
						. (!empty($field['sortable']) ? ' ureach_sortable' : '') 
						. '">';
			if (!is_array($value)) {
				if (!empty($value) && !ureach_is_inherit($value)) parse_str(str_replace('|', '&', $value), $value);
				else $value = array();
			}
			// Sort options by values order
			if (!empty($field['sortable']) && is_array($value)) {
				$field['options'] = ureach_array_merge($value, $field['options']);
			}
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="ureach_checklist_item_label' 
								. (!empty($field['sortable']) ? ' ureach_sortable_item' : '') 
								. '">'
							. '<input type="checkbox" value="1" data-name="'.$k.'"'
								.( isset($value[$k]) && (int) $value[$k] == 1 ? ' checked="checked"' : '')
								.' />'
							. (substr($v, 0, 4)=='http' ? '<img src="'.esc_url($v).'">' : esc_html($v))
						. '</label>';
			}
			$output .= '</div>';
			break;
			
		case 'scheme_editor':
			if (!is_array($value)) break;
			$output .= '<select class="ureach_scheme_editor_selector">';
			foreach ($value as $scheme=>$v)
				$output .= '<option value="' . esc_attr($scheme) . '">' . esc_html($v['title']) . '</option>';
			$output .= '</select>';
			$groups = ureach_storage_get('scheme_color_groups');
			$colors = ureach_storage_get('scheme_color_names');
			$output .= '<div class="ureach_scheme_editor_colors">';
			foreach ($value as $scheme=>$v) {
				$output .= '<div class="ureach_scheme_editor_header">'
								. '<span class="ureach_scheme_editor_header_cell"></span>';
				foreach ($groups as $group_name=>$group_data) {
					$output .= '<span class="ureach_scheme_editor_header_cell" title="'. esc_attr($group_data['description']).'">' 
								. esc_html($group_data['title'])
								. '</span>';
				}
				$output .= '</div>';
				foreach ($colors as $color_name=>$color_data) {
					$output .= '<div class="ureach_scheme_editor_row">'
								. '<span class="ureach_scheme_editor_row_cell" title="'. esc_attr($color_data['description']).'">'
								. esc_html($color_data['title'])
								. '</span>';
					foreach ($groups as $group_name=>$group_data) {
						$slug = $group_name == 'main' 
									? $color_name 
									: str_replace('text_', '', "{$group_name}_{$color_name}");
						$output .= '<span class="ureach_scheme_editor_row_cell">'
									. (isset($v['colors'][$slug])
										? "<input type=\"text\" name=\"{$slug}\" class=\"iColorPicker\" value=\"".esc_attr($v['colors'][$slug])."\">"
										: ''
										)
									. '</span>';
					}
					$output .= '</div>';
				}
				break;
			}
			break;
	}
	return apply_filters('ureach_filter_show_custom_field', $output, $id, $field, $value);
}



//--------------------------------------------------------------
//-- Load Options list and styles
//--------------------------------------------------------------
require_once UREACH_THEME_DIR . 'theme-specific/theme.setup.php';
require_once UREACH_THEME_DIR . 'theme-options/theme.options.php';
require_once UREACH_THEME_DIR . 'theme-specific/theme.styles.php';
?>