<?php
Redux::setSection( $opt_name, array(
   'title'   => esc_html__( 'Portfolio Options', 'vizeon' ),
   'icon'    => 'el-icon-website',
   'fields'  => array(
      array(
        'id'  => 'slug_portfolio_post_type',
        'type'  => 'info',
        'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Slug url portfolio post type', 'vizeon' ) . '</h3>'
      ),
      array(
        'id' => 'slug_portfolio',
        'type' => 'text',
        'title' => esc_html__('Slug Portfolio', 'vizeon'),
        'default' => 'portfolio'
      ),
      array(
        'id'  => 'portfolio_archive_info',
        'type'  => 'info',
        'icon'  => true,
        'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Archive/Listing', 'vizeon' ) . '</h3>',
      ),
      array(
        'id' => 'portfolio_columns_lg',
        'type' => 'select',
        'title' => esc_html__('Display Columns for Large Screen', 'vizeon'),
        'options' => array(
           '1'      => '1',
           '2'      => '2',
           '3'      => '3',
           '4'      => '4',
           '5'      => '5',
           '6'      => '6',
        ),
        'desc' => '',
        'default' => '3'
      ),
      array(
        'id' => 'portfolio_columns_md',
        'type' => 'select',
        'title' => esc_html__('Display Columns for Medium Screen', 'vizeon'),
        'options' => array(
           '1'      => '1',
           '2'      => '2',
           '3'      => '3',
           '4'      => '4',
           '5'      => '5',
           '6'      => '6',
        ),
        'desc' => '',
        'default' => '2'
      ),
      array(
        'id' => 'portfolio_columns_sm',
        'type' => 'select',
        'title' => esc_html__('Display Columns for Small Screen', 'vizeon'),
        'options' => array(
           '1'      => '1',
           '2'      => '2',
           '3'      => '3',
           '4'      => '4',
           '5'      => '5',
           '6'      => '6',
        ),
        'desc' => '',
        'default' => '2'
      ),
      array(
        'id' => 'portfolio_columns_xs',
        'type' => 'select',
        'title' => esc_html__('Display Columns for Extra Small Screen', 'vizeon'),
        'options' => array(
           '1'      => '1',
           '2'      => '2',
           '3'      => '3',
           '4'      => '4',
           '5'      => '5',
           '6'      => '6',
        ),
        'desc' => '',
        'default' => '1'
      ),
      array(
        'id' => 'archive_portfolio_sidebar',
        'type' => 'select',
        'title' => esc_html__('Default Archive Page Portfolio Sidebar Config', 'vizeon'),
        'subtitle' => "Choose single post layout.",
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
        'id' => 'archive_portfolio_left_sidebar',
        'type' => 'select',
        'title' => esc_html__('Default Archive Page Portfolio Left Sidebar', 'vizeon'),
        'subtitle' => "Choose the default left sidebar for Single Post.",
        'data'      => 'sidebars',
        'desc' => '',
        'default' => 'portfolio_sidebar'
      ),
       array(
        'id' => 'archive_portfolio_right_sidebar',
        'type' => 'select',
        'title' => esc_html__('Default Archive Page Portfolio Right Sidebar', 'vizeon'),
        'subtitle' => "Choose the default right sidebar for Single Post.",
        'data'      => 'sidebars',
        'desc' => '',
        'default' => 'portfolio_sidebar'
      ),

      array(
        'id'  => 'portfolio_single_post_info',
        'type'  => 'info',
        'icon'  => true,
        'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Single Portfolio', 'vizeon' ) . '</h3>',
      ),
      array(
        'id' => 'single_portfolio_sidebar',
        'type' => 'select',
        'title' => esc_html__('Default Single Sidebar Config', 'vizeon'),
        'subtitle' => "Choose single Portfolio layout.",
        'options' => array(
           'no-sidebars'     => 'No Sidebars',
           'left-sidebar'    => 'Left Sidebar',
           'right-sidebar'      => 'Right Sidebar',
           'both-sidebars'      => 'Both Sidebars'
        ),
        'desc' => '',
        'default' => 'right-sidebar'
      ),
      array(
        'id' => 'single_portfolio_left_sidebar',
        'type' => 'select',
        'title' => esc_html__('Default Single Left Sidebar', 'vizeon'),
        'subtitle' => "Choose the default left sidebar for Single Portfolio.",
        'data'      => 'sidebars',
        'desc' => '',
        'default' => 'portfolio_sidebar'
      ),
       array(
        'id' => 'single_portfolio_right_sidebar',
        'type' => 'select',
        'title' => esc_html__('Default Single Right Sidebar', 'vizeon'),
        'subtitle' => "Choose the default right sidebar for Single Portfolio.",
        'data'      => 'sidebars',
        'desc' => '',
        'default' => 'portfolio_sidebar'
      )
   )
));