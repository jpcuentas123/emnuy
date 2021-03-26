<?php
   Redux::setSection( $opt_name, array(
      'title' => esc_html__('General Options', 'vizeon'),
      'desc' => '',
      'icon' => 'el-icon-wrench',
      'fields' => array(
         array(
           'id' => 'skin_color',
           'type' => 'select',
           'title' => esc_html__('Skin Color', 'vizeon'),
           'desc' => '',
           'options' => array(
             '' => 'Default',
             'blue'          => 'Blue',
             'brown'         => 'Brown',
             'green'         => 'Green',
             'lilac'         => 'Lilac',
             'lime-green'    => 'Lime Green',
             'orange'        => 'Orange',
             'pigad-blue'    => 'Pigad Blue',
             'pink'          => 'Pink',
             'purple'        => 'Purple',
             'red'           => 'Red',
             'turquoise'     => 'Turquoise',
             'turquoise2'    => 'Turquoise II',
             'violet-red'    => 'Violet Red',
             'yellow'        => 'Yellow'
             ),
           'default' => ''
         ),
         array(
           'id' => 'page_layout',
           'type' => 'button_set',
           'title' => esc_html__('Page Layout', 'vizeon'),
           'subtitle' => esc_html__('Select the page layout type', 'vizeon'),
           'desc' => '',
           'options' => array('boxed' => 'Boxed','fullwidth' => 'Fullwidth'),
           'default' => 'fullwidth'
         ),
         array(
           'id' => 'enable_backtotop',
           'type' => 'button_set',
           'title' => esc_html__('Enable Back To Top', 'vizeon'),
           'subtitle' => esc_html__('Enable the back to top button that appears in the bottom right corner of the screen.', 'vizeon'),
           'desc' => '',
           'options' => array('1' => 'On','0' => 'Off'),
           'default' => '1'
         ),
         array(
           'id' => 'map_api_key',
           'type' => 'text',
           'title' => esc_html__('Google Map API key', 'vizeon'),
           'default' => ''
         ),

      )
   ));