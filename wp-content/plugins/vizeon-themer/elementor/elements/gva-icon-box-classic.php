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
class GVAElement_Icon_Box_Classic extends GVAElement_Base {  

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
		return 'gva-icon-box-classic';
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
		return __( 'GVA Icon Box Classic', 'vizeon-themer' );
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
			'use_icon_image',
			[
				'label' => __( 'Use Icon Image', 'vizeon-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Use Icon Image or Icon Font', 'vizeon-themer' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'gv-icon-75',
				'placeholder' => __( 'gv-icon-75', 'vizeon-themer' ),
				'label_block' => true,
				'description' => 'Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/ionicon/">Custom icon</a>',
				'condition' => [
					'use_icon_image!' => 'yes'
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
				'default'  => [
                'url' => GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/images/icon-placeholder.png',
            ],
				'condition' => [
					'use_icon_image' => 'yes'
				]
			]
		);
		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'vizeon-themer' ),
					'stacked' => __( 'Stacked', 'vizeon-themer' ),
					'framed' => __( 'Framed', 'vizeon-themer' ),
				],
				'default' => 'default',
				'prefix_class' => 'elementor-view-',
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'vizeon-themer' ),
					'square' => __( 'Square', 'vizeon-themer' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
					'icon!' => '',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);

		$this->add_control(
			'position',
			[
				'label' => __( 'Position', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top-center' 		=> __( 'Top Center', 'vizeon-themer' ),
					'top-left' 			=> __( 'Top Left', 'vizeon-themer' ),
					'top-right' 		=> __( 'Top Right', 'vizeon-themer' ),
					'right' 				=> __( 'Right', 'vizeon-themer' ),
					'left' 				=> __( 'Left', 'vizeon-themer' ),
				],
				'default' => 'top-center',
				'condition' => [
					'icon!' => '',
				],
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub-Title', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your sub title', 'vizeon-themer' ),
				'label_block' => true,
				'condition' => [
					'position' => 'top-center',
				],
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
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
			'title_size',
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
			'section_style_icon',
			[
				'label' => __( 'Icon', 'vizeon-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'vizeon-themer' ),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'vizeon-themer' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'use_icon_image!' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'vizeon-themer' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_responsive_control(
			'icon_size_font',
			[
				'label' => __( 'Size', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 38,
				],
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .icon.icon-font' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'use_icon_image!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'icon_size_image',
			[
				'label' => __( 'Image Icon Size', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'condition' => [
					'use_icon_image' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .icon.icon-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'default'	=>[
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight-icon .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => __( 'Margin', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .gsc-icon-box .icon img' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
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
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'vizeon-themer' ),
					'middle' => __( 'Middle', 'vizeon-themer' ),
					'bottom' => __( 'Bottom', 'vizeon-themer' ),
				],
				'default' => 'top',
				'prefix_class' => 'elementor-vertical-align-',
			]
		);

		$this->add_control(
			'heading_subtitle_style',
			[
				'label' => __( 'Sub Title', 'vizeon-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'position' => 'top-center',
				]
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .highlight_content .sub-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'position' => 'top-center',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .highlight_content .sub-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => [
					'position' => 'top-center',
				]
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => __( 'Padding', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'	=> [
					'top' 		=> 10,
					'bottom'		=> 0,
					'right' 		=> 0,
					'left'  		=> 0,
					'unit'		=> 'px'
				],
				'condition' => [
					'position' => 'top-center',
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight_content .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => __( 'Margin', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight_content .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'position' => 'top-center',
				]
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
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .highlight_content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .highlight_content .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .highlight_content .title, {{WRAPPER}} .highlight_content .title a',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'vizeon-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .highlight_content .desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .highlight_content .desc',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'	=> [
					'top' 		=> 10,
					'bottom'		=> 0,
					'right' 		=> 0,
					'left'  		=> 0,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight_content .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __( 'Margin', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box .highlight_content .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
         include $this->get_template('gva-icon-box-classic.php');
      print '</div>';
	}

}
