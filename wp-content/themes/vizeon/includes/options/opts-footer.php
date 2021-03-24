<?php
Redux::setSection( $opt_name, array(
   'title' => esc_html__('Footer Options', 'vizeon'),
   'desc' => '',
   'icon' => 'el-icon-compass',
   'fields' => array(
      array(
        'id' => 'footer_layout',
        'type' => 'select',
        'options' => vizeon_get_footer(),
        'default' => 'footer-1'
      ),
      array(
        'id' => 'copyright_text',
        'type' => 'editor',
        'title' => esc_html__('Footer Copyright Text', 'vizeon'),
        'desc' => '',
        'default' => "Copyright - 2019 - Company - All rights reserved. Powered by WordPress."
      )
   )
) );