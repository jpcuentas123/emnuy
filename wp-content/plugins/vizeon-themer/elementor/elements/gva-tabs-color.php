<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class GVAElement_Tabs_Color extends GVAElement_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gva-tabs-color';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'GVA Tabs Color', 'vizeon-themer' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-tabs';
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
		return [ 'tabs', 'accordion', 'toggle' ];
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_tabs',
			[
				'label' => __( 'GVA Tabs Color', 'vizeon-themer' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'vizeon-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'vizeon-themer' ),
				'placeholder' => __( 'Tab Title', 'vizeon-themer' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_image',
			[
				'label' => __( 'Choose Image', 'vizeon-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'vizeon-themer' ),
				'default' => __( 'Tab Content', 'vizeon-themer' ),
				'placeholder' => __( 'Tab Content', 'vizeon-themer' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'tab_background_color',
			[
				'label' 		=> __( 'Tab Background Color', 'vizeon-themer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' =>	[
					'{{WRAPPER}} .gsc-tabs-color .nav_tabs {{CURRENT_ITEM}} a' => 'background: {{VALUE}};',
				]
			]
		);
		$repeater->add_control(
			'tab_color',
			[
				'label' 		=> __( 'Tab Color', 'vizeon-themer' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' =>	[
					'{{WRAPPER}} .gsc-tabs-color .nav_tabs {{CURRENT_ITEM}} a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'tabs',
			[
				'label' => __( 'Tabs Items', 'vizeon-themer' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Business Growth', 'vizeon-themer' ),
						'tab_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
						'tab_background_color' => '#FFFF',
						'tab_color'	=> '#18212e'
					],
					[
						'tab_title' => __( 'Financial Advice', 'vizeon-themer' ),
						'tab_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
						'tab_background_color' => '#E74D57',
						'tab_color'	=> '#ffff'
					],
					[
						'tab_title' => __( 'Gobal Solutions', 'vizeon-themer' ),
						'tab_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
						'tab_background_color' => '#18212E',
						'tab_color'	=> '#ffff'
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

	
		$this->add_responsive_control(
			'width_tab_item',
			[
				'label' => __( 'Width Tab Item', 'vizeon-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 33,
				],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-tabs-color .nav_tabs > li' => 'width: {{SIZE}}%;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => __( 'Tabs', 'vizeon-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
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

		$this->add_control(
			'background_active',
			[
				'label' => __( 'Active Background Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffff',
				'selectors' => [
					'{{WRAPPER}} .gsc-tabs-color .nav_tabs > li.active a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_active',
			[
				'label' => __( 'Active Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#18212e',
				'selectors' => [
					'{{WRAPPER}} .gsc-tabs-color .nav_tabs > li.active a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .gsc-tabs-color .nav_tabs > li a',
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label' => __( 'Content', 'vizeon-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'vizeon-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-tabs-color .tab-content .tab-pane .tab-content-item' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .gsc-tabs-color .tab-content .tab-pane .tab-content-item',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$tabs = $this->get_settings_for_display( 'tabs' );
   	$_random = gaviasthemer_random_id();

		$id_int = substr( $this->get_id_int(), 0, 3 );
		?>
		<div class="gsc-tabs-color" role="tablist">
			<div class="tabs_wrapper">
				<ul class="nav_tabs clearfix">
					<?php
					foreach ( $tabs as $index => $item ) :
						$tab_count = $index + 1;

						$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

						$this->add_render_attribute( $tab_title_setting_key, [
							'class' 			=> [  $index == 0 ? 'active show' : ''  ],
							'role' 			=> 'tab',
							'data-toggle' 	=> 'tab',
							'href'			=> '#' . $_random .'-'. $index
						] );
						?>
						<li class="elementor-repeater-item-<?php echo esc_attr($item['_id']) ?><?php echo ($index == 0 ? ' active show' : '') ?>">
							<a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
								<?php echo $item['tab_title']; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="tab-content clearfix">
					<?php foreach ( $tabs as $index => $item ) :
						$tab_count = $index + 1;

						$tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
						$tab_content_setting_text_key = $this->get_repeater_setting_key( 'tab_content', 'tabs_text', $index );
						
						$image = $item['tab_image']['url']; 

						$this->add_render_attribute( $tab_content_setting_key, [
							'class' 				=> ['tab-pane fade in', $index == 0 ? 'active show' : '' ],
							'role'				=> 'tabpanel',
							'id' 					=> $_random .'-'. $index,
						] );

						$this->add_render_attribute( $tab_content_setting_text_key, [
							'class' 	=> ['tab-content-item', $image ? 'has_image' : '' ],
						] );

						$this->add_inline_editing_attributes( $tab_content_setting_text_key, 'advanced' );
						?>
						<div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
							<?php if($image){ ?>
								<div class="tab-image">
									<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($item['tab_title']) ?>" />
								</div>
							<?php } ?>
							<div <?php echo $this->get_render_attribute_string( $tab_content_setting_text_key ); ?>>
								<?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
							</div>
						</div>
					
					<?php endforeach; ?>
				</div>
			</div>	
		</div>
		<?php
	}

}
