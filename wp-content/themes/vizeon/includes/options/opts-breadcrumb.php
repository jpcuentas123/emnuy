<?php
Redux::setSection( $opt_name, array(
   'title' => esc_html__('Breadcrumb Options', 'vizeon'),
   'desc' => '',
   'icon' => 'el-icon-compass',
   'fields' => array(
      array(
        'id' => 'breadcrumb_show_title',
        'type' => 'button_set',
        'title' => esc_html__('Breadcrumb Display Title Page', 'vizeon'),
        'desc' => '',
        'options' => array(1 => 'Enable', 0 => 'Disable'),
        'default' => 1
      ),
      array(
        'id'        => 'breadcrumb_padding_top',
        'type'      => 'slider',
        'title'     => esc_html__( 'Breadcrumb Padding Top', 'vizeon' ),
        'default'   => 275,
        'min'       => 50,
        'max'       => 500,
        'step'      => 1,
        'display_value' => 'text',
      ),
      array(
        'id'        => 'breadcrumb_padding_bottom',
        'type'      => 'slider',
        'title'     => esc_html__( 'Breadcrumb Padding Top', 'vizeon' ),
        'default'   => 100,
        'min'       => 50,
        'max'       => 500,
        'step'      => 1,
        'display_value' => 'text',
      ),
      array(
        'id' => 'breadcrumb_background_color',
        'type' => 'color',
        'title' => esc_html__('Background Overlay Color', 'vizeon'),
        'default' => ''
      ),
      array(
        'id'        => 'breadcrumb_background_opacity',
        'type'      => 'slider',
        'title'     => esc_html__( 'Breadcrumb Ovelay Color Opacity', 'vizeon' ),
        'default'   => 50,
        'min'       => 0,
        'max'       => 100,
        'step'      => 1,
        'display_value' => 'text',
      ),
      array(
        'id' => 'breadcrumb_image',
        'type' => 'button_set',
        'title' => esc_html__('Enable Breadcrumb Image', 'vizeon'),
        'desc' => '',
        'options' => array(1 => 'Enable', 0 => 'Disable'),
        'default' => 1
      ),
      array(
        'id' => 'breadcrumb_background_image',
        'type' => 'media',
        'url' => true,
        'title' => esc_html__('Breadcrumb Background Image', 'vizeon'),
        'default' => '',
        'required'  => array( 'breadcrumb_image', '=', 1 )
      ),
      array(
        'id'    => 'breadcrumb_text_stype',
        'type'    => 'select',
        'title'   => esc_html__( 'Breadcrumb Text Stype', 'vizeon' ),
        'options' => 
        array(
          'text-light'     => esc_html__('Light', 'vizeon'),
          'text-dark'      => esc_html__('Dark', 'vizeon')
        ),
        'default' => 'text-light'
      ),
      array(
        'id'    => 'breadcrumb_text_align',
        'type'    => 'select',
        'title'   => esc_html__( 'Breadcrumb Text Align', 'vizeon' ),
        'options' => 
        array(
          'text-left'      => esc_html__('Left', 'vizeon'),
          'text-center'    => esc_html__('Center', 'vizeon'),
          'text-right'     => esc_html__('Right', 'vizeon')
        ),
        'default' => 'text-center'
      )
   )
) );