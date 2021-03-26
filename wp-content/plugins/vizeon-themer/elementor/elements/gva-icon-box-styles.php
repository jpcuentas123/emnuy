<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class GVAElement_Icon_Box_Styles extends GVAElement_Base {  

	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gva-icon-box-styles';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'GVA Icon Box Styles', 'vizeon-themer' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'GVA Icon Box Classic', 'vizeon-themer' ),
			]
		);
		
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I', 'vizeon-themer' ),
					'style-2' 		=> __( 'Style II', 'vizeon-themer' ),
					'style-3' 		=> __( 'Style III', 'vizeon-themer' ),
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'use_icon_image',
			[
				'label' => __( 'Use Icon Image', 'vizeon-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Use Icon Image or Icon Font', 'vizeon-themer' ),
				'default' => 'yes',
				'condition' => [
					'style' => ['style-1', 'style-2']
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon Class', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'gv-icon-75',
				'placeholder' => __( 'gv-icon-75', 'vizeon-themer' ),
				'description' => 'Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/ionicon/">Custom icon</a>',
				'condition' => [
					'use_icon_image!' => 'yes',
					'style' => ['style-1', 'style-2']
				]
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label' => __( 'Icon Image', 'vizeon-themer' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/images/icon-placeholder.png',
				],
				'condition' => [
					'use_icon_image' => 'yes',
					'style' => ['style-1', 'style-2']
				]
			]
		);
		
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'vizeon-themer' ),
				'placeholder' => __( 'Enter your title', 'vizeon-themer' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'vizeon-themer' ),
				'placeholder' => __( 'Enter your description', 'vizeon-themer' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
				'condition' => [
					'style' => ['style-1', 'style-3']
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'vizeon-themer' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'vizeon-themer' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'Title HTML Tag', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'vizeon-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .block-content::before, {{WRAPPER}} .gsc-icon-box-styles.style-2 .block-content::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-3 .block-content::before, {{WRAPPER}} .gsc-icon-box-styles.style-3 .block-content::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_second_color',
			[
				'label' => __( 'Second Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1'],
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' 		=> 40,
					'right' 		=> 40,
					'left'		=> 40,
					'bottom'		=> 40,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'label' => __( 'Min Height', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .block-content' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => ['style-3'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'vizeon-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['style-1', 'style-2'],
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Primary Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}. gsc-icon-box-styles .icon-inner .icon' => 'color: {{VALUE}};'
				],
			]
		);


		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1 .icon-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .icon-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'vizeon-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'vizeon-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'	=> [
					'size'	=> 16
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1 .content-inner .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .content-inner .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-3 .content-inner .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles .title a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-styles .title, {{WRAPPER}} .gsc-icon-box-styles .title a',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'vizeon-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['style-1', 'style-3'],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .desc' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'style' => ['style-1', 'style-3'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-styles .desc',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => [
					'style' => ['style-1', 'style-3'],
				],

			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template('gva-icon-box-styles.php');
      print '</div>';
	}
}
