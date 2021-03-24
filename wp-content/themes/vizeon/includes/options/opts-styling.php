<?php
Redux::setSection( $opt_name, array(
  'title'     => esc_html__( 'Styling', 'vizeon' ),
  'icon'      => 'el-icon-pencil',
  'fields' => array(
    array(
      'id'  => 'colors_info_styling',
      'type'   => 'info',
      'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Colors', 'vizeon' ) . '</h3>'
    ),
    array(
      'id'        => 'main_color',
      'type'         => 'color',
      'title'        => esc_html__( 'Main Color', 'vizeon' ),
      'desc'         => esc_html__( 'Used for the body text.', 'vizeon' ),
      'default'      => '',
      'transparent'  => false,
      'validate'     => 'color'
    ),
    array(
      'id'  => 'info_background',
      'type'   => 'info',
      'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Background', 'vizeon' ) . '</h3>'
    ),
    array(
      'id'        => 'main_background_color',
      'type'         => 'color',
      'title'        => esc_html__( 'Background Color', 'vizeon' ),
      'desc'         => esc_html__( 'Used for the main site background.', 'vizeon' ),
      'default'      => '',
      'transparent'  => false,
      'validate'     => 'color'
    ),
    array(
      'id'  => 'main_background_image',
      'type'   => 'media', 
      'url' => true,
      'title'  => esc_html__( 'Background Image', 'vizeon' ),
      'desc'   => esc_html__( 'Upload a background image or specify a URL (boxed layout).', 'vizeon' )
    ),
    array(
      'id'     => 'main_background_image_type',
      'type'      => 'select',
      'title'     => esc_html__( 'Background Type', 'vizeon' ),
      'desc'      => esc_html__( 'Select the background-image type (fixed image or repeat pattern/texture).', 'vizeon' ),
      'options'   => array( 'fixed' => 'Fixed (Full)', 'repeat' => 'Repeat (Pattern)' ),
      'default'   => 'fixed'
    ),
    array(
      'id'  => 'main_content_info_styling',
      'type'  => 'info',
      'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Main Content', 'vizeon' ) . '</h3>'
    ),
    array(
      'id'    => 'content_background_color',
      'type'    => 'color',
      'title'   => esc_html__( 'Background Color', 'vizeon' ),
      'desc'    => esc_html__( 'Used for the header background.', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),
    array(
      'id'    => 'content_font_color',
      'type'    => 'color',
      'title'   => esc_html__( 'Text Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),
    array(
      'id'    => 'content_font_color_link',
      'type'    => 'color',
      'title'   => esc_html__( 'Link Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),
     array(
      'id'    => 'content_font_color_link_hover',
      'type'    => 'color',
      'title'   => esc_html__( 'Link Hover Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),

    array(
      'id'  => 'footer_info_styling',
      'type'  => 'info',
      'raw' => '<h3 style="margin: 0;">' . esc_html__( 'Footer Default Styling', 'vizeon' ) . '</h3>'
    ),
    array(
      'id'    => 'footer_background_color',
      'type'    => 'color',
      'title'   => esc_html__( 'Background Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),
    array(
      'id'    => 'footer_font_color',
      'type'    => 'color',
      'title'   => esc_html__( 'Text Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),
    array(
      'id'    => 'footer_font_color_link',
      'type'    => 'color',
      'title'   => esc_html__( 'Link Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    ),
     array(
      'id'    => 'footer_font_color_link_hover',
      'type'    => 'color',
      'title'   => esc_html__( 'Link Hover Color', 'vizeon' ),
      'default' => '',
      'validate'  => 'color'
    )
  )
));