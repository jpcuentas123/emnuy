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
class GVAElement_Search_Box extends GVAElement_Base {  

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
		return 'gva-search-box';
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
		return __( 'GVA Search Box', 'vizeon-themer' );
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
		return [ 'search' ];
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
			'section_layout',
			[
				'label' => __( 'Layout', 'vizeon-themer' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'vizeon-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I', 'vizeon-themer' ),
				],
				'default' => 'style-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'vizeon-themer' ),
				'style' => ['style-1']
			]
		);
		
		$this->add_control(
			'use_icon_image',
			[
				'label' => __( 'Use Icon Image', 'vizeon-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Use Icon Image or Icon Font', 'vizeon-themer' ),
				'default' => 'yes'
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
				'default' => 'fa fa-search',
				'placeholder' => __( 'fa fa-search', 'vizeon-themer' ),
				'description' => 'Use class icon font <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/ionicon/">Custom icon</a>',
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
				'default' => [
					'url' => GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/images/icon-placeholder.png',
				],
				'condition' => [
					'use_icon_image' => 'yes'
				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'vizeon-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'vizeon-themer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'vizeon-themer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'vizeon-themer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'vizeon-themer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-search-box' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
				'condition' => [
					'style' => 'style-1'
				]
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'condition' => [
					'use_icon_image!' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-search-box .control-search .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gsc-search-box .control-search' => 'color: {{VALUE}}', 
            ],
            'condition' => [
					'use_icon_image!' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Color Hover', 'vizeon-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gsc-search-box .control-search:hover' => 'color: {{VALUE}}', 
            ],
            'condition' => [
					'use_icon_image!' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label' => __( 'Background', 'vizeon-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gsc-search-box .control-search' => 'background: {{VALUE}}', 
            ],
			]
		);

		$this->add_control(
			'icon_background_hover',
			[
				'label' => __( 'Background Hover', 'vizeon-themer' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gsc-search-box .control-search:hover' => 'background: {{VALUE}}', 
            ],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-search-box .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'vizeon-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'vizeon-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' 		=> 15,
					'right' 		=> 15,
					'left'		=> 15,
					'bottom'		=> 15,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-search-box .gva-search .gva-search-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'content_size',
			[
				'label' => __( 'Content Width', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 200,
				],
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-search-box .gva-search-content' => 'width: {{SIZE}}{{UNIT}};',
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
         include $this->get_template('gva-search-box.php');
      print '</div>';
	}
}
