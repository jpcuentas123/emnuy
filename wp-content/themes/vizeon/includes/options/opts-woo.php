<?php
Redux::setSection( $opt_name, array(
   'icon' => 'el-icon-shopping-cart',
   'title' => esc_html__('WooCommerce Options', 'vizeon'),
   'fields' => array(
      array(
        'id'        => 'products_per_page',
        'type'      => 'text',
        'title'     => esc_html__('Products Per Page', 'vizeon'),
        'subtitle'  => esc_html__('Number value.', 'vizeon'),
        'desc'      => esc_html__('The amount of products you would like to show per page on shop/category pages.', 'vizeon'),
        'validate'  => 'numeric',
        'default'   => '24'
      )       
   )
));

Redux::setSection( $opt_name, array(
   'icon' => 'el-icon-shopping-cart',
   'title' => esc_html__('Shop Options', 'vizeon'),
   'subsection' => true,
   'fields' => array(
      array(
         'id' => 'product_display_layout',
         'type' => 'select',
         'title' => esc_html__('Default Product Display Layout', 'vizeon'),
         'subtitle' => "Choose the default product display layout for WooCommerce shop/category pages.",
         'options' => array(
            'grid'      => 'Grid',
            'list'   => 'List',
        ),
        'desc' => '',
        'default' => 'standard'
      ),
      array(
         'id' => 'product_display_columns',
         'type' => 'select',
         'title' => esc_html__('Product Display Columns', 'vizeon'),
         'subtitle' => "Choose the number of columns to display on shop/category pages.",
         'options' => array(
            '1'      => '1',
            '2'      => '2',
            '3'      => '3',
            '4'      => '4',
            '5'      => '5',
            '6'      => '6',
         ),
         'desc' => '',
         'default' => '4'
      ),
      array(
         'id' => 'woo_sidebar_config',
         'type' => 'select',
         'title' => esc_html__('WooCommerce Sidebar Config', 'vizeon'),
         'subtitle' => "Choose the sidebar config for WooCommerce shop/category pages.",
         'options' => array(
           'no-sidebars'     => 'No Sidebars',
           'left-sidebar'    => 'Left Sidebar',
           'right-sidebar'      => 'Right Sidebar',
           'both-sidebars'      => 'Both Sidebars'
         ),
         'desc' => '',
         'default' => 'no-sidebars'
      ),
      array(
         'id' => 'woo_left_sidebar',
         'type' => 'select',
         'title' => esc_html__('WooCommerce Left Sidebar', 'vizeon'),
         'subtitle' => "Choose the left sidebar for WooCommerce shop/category pages.",
         'data'      => 'sidebars',
         'desc' => '',
         'default' => 'woocommerce_sidebar'
      ),
      array(
         'id' => 'woo_right_sidebar',
         'type' => 'select',
         'title' => esc_html__('WooCommerce Right Sidebar', 'vizeon'),
         'subtitle' => "Choose the right sidebar for WooCommerce shop/category pages.",
         'data'      => 'sidebars',
         'desc' => '',
         'default' => 'woocommerce_sidebar'
      ),
      array(
         'id' => 'woo_shop_divide_0',
         'type' => 'divide'
      ),
      array(
         'id' => 'woo_breadcrumb_show_title',
         'type' => 'button_set',
         'title' => esc_html__('Breadcrumb Display Title Page', 'vizeon'),
         'desc' => '',
         'options' => array(1 => 'Enable', 0 => 'Disable'),
         'default' => 1
      ),
      array(
         'id'        => 'woo_breadcrumb_padding_top',
         'type'      => 'slider',
         'title'     => esc_html__( 'Breadcrumb Padding Top', 'vizeon' ),
         'default'   => 275,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'woo_breadcrumb_padding_bottom',
         'type'      => 'slider',
         'title'     => esc_html__( 'Breadcrumb Padding Top', 'vizeon' ),
         'default'   => 100,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id' => 'woo_breadcrumb_background_color',
         'type' => 'color',
         'title' => esc_html__('Background Overlay Color', 'vizeon'),
         'default' => ''
      ),
      array(
         'id'        => 'woo_breadcrumb_background_opacity',
         'type'      => 'slider',
         'title'     => esc_html__( 'Breadcrumb Ovelay Color Opacity', 'vizeon' ),
         'default'   => 50,
         'min'       => 0,
         'max'       => 100,
         'step'      => 2,
         'display_value' => 'text',
      ),
      array(
         'id' => 'woo_breadcrumb_image',
         'type' => 'button_set',
         'title' => esc_html__('Breadcrumb Image', 'vizeon'),
         'desc' => '',
         'options' => array( 1 => 'Enable', 0 => 'Disable'),
         'default' => 'enable'
      ),
      array(
         'id' => 'woo_breadcrumb_background_image',
         'type' => 'media',
         'url' => true,
         'title' => esc_html__('Breadcrumb Background Image', 'vizeon'),
         'default' => '',
         'required'  => array( 'woo_breadcrumb_image', '=', 1 )
      ),
      array(
         'id'    => 'woo_breadcrumb_text_stype',
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
         'id'    => 'woo_breadcrumb_text_align',
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
));

Redux::setSection( $opt_name, array(
   'icon' => 'el-icon-shopping-cart',
   'title' => esc_html__('Product Options', 'vizeon'),
   'subsection' => true,
   'fields' => array(
      array(
         'id' => 'product_sidebar_config',
         'type' => 'select',
         'title' => esc_html__('Default Product Sidebar Config', 'vizeon'),
         'subtitle' => "Choose the sidebar config for WooCommerce shop/category pages.",
         'options' => array(
            'no-sidebars'     => 'No Sidebars',
            'left-sidebar'    => 'Left Sidebar',
            'right-sidebar'      => 'Right Sidebar',
            'both-sidebars'      => 'Both Sidebars'
         ),
         'desc' => '',
         'default' => 'no-sidebars'
      ),
      array(
         'id' => 'product_left_sidebar',
         'type' => 'select',
         'title' => esc_html__('Default Product Left Sidebar', 'vizeon'),
         'subtitle' => "Choose the default left sidebar for WooCommerce product pages.",
         'data'      => 'sidebars',
         'desc' => '',
         'default' => 'woocommerce-sidebar'
      ),
      array(
         'id' => 'product_right_sidebar',
         'type' => 'select',
         'title' => esc_html__('Default Product Right Sidebar', 'vizeon'),
         'subtitle' => "Choose the default right sidebar for WooCommerce product pages.",
         'data'      => 'sidebars',
         'desc' => '',
         'default' => 'woocommerce-sidebar'
      ),
      array(
         'id' => 'upsell_heading_text',
         'type' => 'text',
         'title' => esc_html__('Upsell Heading Text', 'vizeon'),
         'subtitle' => "Heading text for the upsell products on the product page.",
         'desc' => '',
         'default' => 'Complete the look'
      ),
      array(
         'id' => 'related_heading_text',
         'type' => 'text',
         'title' => esc_html__('Related Heading Text', 'vizeon'),
         'subtitle' => "Heading text for the related products on the product page.",
         'desc' => '',
         'default' => 'Related products'
      )
   )
));