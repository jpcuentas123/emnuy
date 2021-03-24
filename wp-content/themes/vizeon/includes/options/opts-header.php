<?php
  Redux::setSection( $opt_name, array(
    'title' => esc_html__('Header Options', 'vizeon'),
    'desc' => '',
    'icon' => 'el-icon-compass',
    'fields' => array(
      array(
        'id' => 'header_layout',
        'type' => 'select',
        'title' => esc_html__('Header Layout', 'vizeon'),
        'subtitle' => esc_html__('Select a header layout option from the examples.', 'vizeon'),
        'desc' => '',
        'options' => vizeon_get_headers(false),
        'default' => 'header-1'
      ),
      array(
        'id' => 'header_logo', 
        'type' => 'media',
        'url' => true,
        'title' => esc_html__('Logo in header', 'vizeon'), 
        'default' => ''
      ),  
      array(
        'id' => 'header_logo_mobile',
        'type' => 'media',
        'url' => true,
        'title' => esc_html__('Logo in header mobile', 'vizeon'),
        'default' => ''
      ),
    )
  ));