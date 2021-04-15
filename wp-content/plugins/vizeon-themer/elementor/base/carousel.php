<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

abstract class GVAElement_Carousel_Base extends Elementor\Widget_Base {

    protected function add_control_carousel($condition = array()) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label' => __('Carousel Options', 'vizeon-themer'),
                'type'  => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'items_lg',
            [
                'label'     => __('Responsive Items for Large Screen', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
            ]
        );

        $this->add_control(
            'items_md',
            [
                'label'     => __('Responsive Items for Medium Screen', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
            ]
        );

        $this->add_control(
            'items_sm',
            [
                'label'     => __('Responsive Items for Small Screen', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 2,
                'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
            ]
        );

        $this->add_control(
            'items_xs',
            [
                'label'     => __('Responsive Items for Extra Small Screen', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 2,
                'options'   => array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6)
            ]
        );

        $this->add_control(
            'ca_loop',
            [
                'label'     => __('Loop', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_speed',
            [
                'label'     => __('Speed', 'vizeon-themer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1000,
            ]
        );

        $this->add_control(
            'ca_auto_play',
            [
                'label'     => __('Auto Play', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_auto_play_timeout',
            [
                'label'     => __('Auto Play Timeout', 'vizeon-themer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3000,
            ]
        );

        $this->add_control(
            'ca_auto_play_speed',
            [
                'label'     => __('Auto Play Speed', 'vizeon-themer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1000,
            ]
        );

        $this->add_control(
            'ca_play_hover',
            [
                'label'     => __('Play Hover', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_navigation',
            [
                'label'     => __('Navigation', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_rewind_nav',
            [
                'label'     => __('Rewind Nav', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_pagination',
            [
                'label'     => __('Pagination', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_mouse_drag',
            [
                'label'     => __('Mouse Drag', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->add_control(
            'ca_touch_drag',
            [
                'label'     => __('Touch Drag', 'vizeon-themer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'      => __('Enable', 'vizeon-themer'),
                    'no'       => __('Disable', 'vizeon-themer')
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_carousel_settings() {
        $settings = $this->get_settings_for_display();
        $ouput = '';
        $carousel_attributes = array(

          'items'               => $settings['items_lg'],
          'items_lg'            => $settings['items_lg'],
          'items_md'            => $settings['items_md'],
          'items_sm'            => $settings['items_sm'],
          'items_xs'            => $settings['items_xs'],

          'loop'                => $settings['ca_loop'] === 'yes' ? 1 : 0,
          'speed'               => $settings['ca_speed'],
          'auto_play'           => $settings['ca_auto_play'],
          'auto_play_speed'     => $settings['ca_auto_play_speed'],
          'auto_play_timeout'   => $settings['ca_auto_play_timeout'],
          'auto_play_hover'     => $settings['ca_play_hover'] === 'yes' ? 1 : 0,
          'navigation'          => $settings['ca_navigation'] === 'yes' ? 1 : 0,
          'rewind_nav'          => $settings['ca_rewind_nav'] === 'yes' ? 1 : 0,
          'pagination'          => $settings['ca_pagination'] === 'yes' ? 1 : 0,
          'mouse_drag'          => $settings['ca_mouse_drag'] === 'yes' ? 1 : 0,
          'touch_drag'          => $settings['ca_touch_drag'] === 'yes' ? 1 : 0
        );

        foreach ($carousel_attributes as $key => $value) {
          $ouput .= 'data-' . esc_attr( $key ) . '="' . esc_attr($value) . '" ';
        }
        return $ouput;
    }
}