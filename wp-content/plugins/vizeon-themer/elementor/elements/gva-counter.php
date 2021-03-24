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
class GVAElement_Counter extends GVAElement_Base {  

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
		return 'gva-counter';
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
		return __( 'GVA Counter', 'vizeon-themer' );
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
		return [ 'counter', 'icon' ];
	}

	public function get_script_depends() {
      return [
         'jquery.count_to',
         'jquery.appear',
      ];
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
			'section_content',
			[
				'label' => __( 'Content', 'vizeon-themer' ),
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
				'label' => __( 'Content', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'gv-icon-75',
				'placeholder' => __( 'gv-icon-75', 'vizeon-themer' ),
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
				'default' => [
					'url' => '',
				],
				'condition' => [
					'use_icon_image' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'number',
			[
				'label' => __( 'Number', 'vizeon-themer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 63000
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
				'default' => 'div',
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
				],
				'default' => 'style-1',
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

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Primary Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'use_icon_image!' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-icon .icon' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-icon .icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .milestone-block .milestone-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block.style-1 .milestone-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .milestone-block.style-2 .milestone-icon' => 'padding-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .milestone-block .milestone-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'vizeon-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_top_space',
			[
				'label' => __( 'Spacing', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-text' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .milestone-block .milestone-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .milestone-block .milestone-text',
			]
		);

		$this->end_controls_section();

		// Number Text
		$this->start_controls_section(
			'sectionn_number_style',
			[
				'label' => __( 'Number Text', 'vizeon-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'number_bottom_space',
			[
				'label' => __( 'Spacing', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-number-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'number_text_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-number' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_text_typography',
				'selector' => '{{WRAPPER}} .milestone-block .milestone-number',
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
         include $this->get_template('gva-counter.php');
      print '</div>';
	}
}
