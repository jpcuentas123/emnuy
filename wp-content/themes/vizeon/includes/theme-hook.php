<?php
add_filter( 'max_srcset_image_width', 'vizeon_max_srcset_image_width' );
function vizeon_max_srcset_image_width(){
  return 1;
}
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

add_theme_support( 'wp-block-styles' );

/**
 * Hook to before breadcrumb
 */
function vizeon_style_breadcrumb(){
  global $post;
  $post_id = vizeon_id();
  $result['title'] = '';
  $result['styles'] = '';
  $result['styles_overlay'] = '';
  $result['classes'] = '';

  $show_no_breadcrumbs = vizeon_get_option('enable_breadcrumb', 'enable') == 'disable' ? true : false;
  if(get_post_meta($post_id, 'vizeon_no_breadcrumbs', true) == true){
    $show_no_breadcrumbs = true;
  }
  $breadcrumb_padding_top = vizeon_get_option('breadcrumb_padding_top', '100'); //275
  $breadcrumb_padding_bottom = vizeon_get_option('breadcrumb_padding_bottom', '100');
  $breadcrumb_show_title = vizeon_get_option('breadcrumb_show_title', '1');
  $breadcrumb_bg_color = vizeon_get_option('breadcrumb_background_color', '1');;
  $breadcrumb_bg_color_opacity = vizeon_get_option('breadcrumb_background_opacity', '1');
  $breadcrumb_enable_image = vizeon_get_option('breadcrumb_image', '1');
  $breadcrumb_image = vizeon_get_option('breadcrumb_background_image', array('id'=> 0));
  $breadcrumb_text_style = vizeon_get_option('breadcrumb_text_stype', 'text-light');
  $breadcrumb_text_align = vizeon_get_option('breadcrumb_text_align', 'text-center');
  $breadcrumb_page_title_one = '';

  if(get_post_meta($post_id, 'vizeon_breadcrumb_layout', true) == 'page_options'){
    $breadcrumb_padding_top = get_post_meta($post_id, 'vizeon_breadcrumb_padding_top', true);
    $breadcrumb_padding_bottom = get_post_meta($post_id, 'vizeon_breadcrumb_padding_bottom', true);
    $breadcrumb_show_title = get_post_meta($post_id, 'vizeon_page_title', true);
    $breadcrumb_bg_color = get_post_meta($post_id, 'vizeon_bg_color_title', true);
    $breadcrumb_bg_color_opacity = get_post_meta($post_id, 'vizeon_bg_opacity_title', true);
    $breadcrumb_enable_image = get_post_meta($post_id, 'vizeon_image_breadcrumbs', true);
    $breadcrumb_image = get_post_meta($post_id, 'vizeon_page_title_image', true);
    $breadcrumb_text_style = get_post_meta($post_id, 'vizeon_page_title_text_style', true);
    $breadcrumb_text_align = get_post_meta($post_id, 'vizeon_page_title_text_align', true);
    $breadcrumb_page_title_one = get_post_meta($post_id, 'vizeon_page_title_one', true);
  }
  if ( metadata_exists( 'post', $post_id, 'vizeon_page_title' ) || is_archive()) {
    $breadcrumb_show_title = true;
  }

  //Breadcrumb category and tag products
  if(vizeon_woocommerce_activated()){
    if( is_product_tag() || is_product_category() || is_shop() || is_product() ){
      $breadcrumb_padding_top = vizeon_get_option('woo_breadcrumb_padding_top', '100');
      $breadcrumb_padding_bottom = vizeon_get_option('woo_breadcrumb_padding_bottom', '100');
      $breadcrumb_show_title = vizeon_get_option('woo_breadcrumb_show_title', '1');
      $breadcrumb_bg_color = vizeon_get_option('woo_breadcrumb_background_color', '1');;
      $breadcrumb_bg_color_opacity = vizeon_get_option('woo_breadcrumb_background_opacity', '1');
      $breadcrumb_image = vizeon_get_option('woo_breadcrumb_image', array('id'=> 0));
      $breadcrumb_text_style = vizeon_get_option('woo_breadcrumb_text_stype', 'text-light');
      $breadcrumb_text_align = vizeon_get_option('woo_breadcrumb_text_align', 'text-center');
      if(isset($breadcrumb_image['id']) && $breadcrumb_image['id']){
        $breadcrumb_image = $breadcrumb_image['id'];
      }else{
        $breadcrumb_image = '';
      }
    }
  }

  $result = array();
  $styles = array();
  $styles_inner = array();
  $styles_overlay = '';
  $classes = array();
  $title = '';
  if($show_no_breadcrumbs){
    $result['no_breadcrumbs'] = true;
  }

  if(!isset($breadcrumb_show_title) || empty($breadcrumb_show_title) || $breadcrumb_show_title){
    $title = get_the_title();
    if(is_archive()) $title = single_cat_title('', false);
    if(vizeon_woocommerce_activated() && is_shop()){
      $title = woocommerce_page_title(false);
    }
    if($breadcrumb_page_title_one){
      $title = $breadcrumb_page_title_one;
    }   
  }

  if(is_home()) { // Home Index
    $breadcrumb_show_title = true;
    $title = esc_html__( 'Latest posts', 'vizeon' );
    $breadcrumb_padding_top = '100';
    $breadcrumb_padding_bottom = '100';
    $breadcrumb_text_align = 'text-center';
    $breadcrumb_text_style = 'text-light';
    $breadcrumb_enable_image = true;
  }
  
  if($breadcrumb_bg_color){
    $rgba_color = vizeon_convert_hextorgb($breadcrumb_bg_color);
    $styles_overlay = 'background-color: rgba(' . esc_attr($rgba_color['r']) . ',' . esc_attr($rgba_color['g']) . ',' . esc_attr($rgba_color['b']) . ', ' . ($breadcrumb_bg_color_opacity/100) . ')';
  }
  //Tmp
  $breadcrumb_text_style = 'text-light';
  //Classes
  $classes[] = $breadcrumb_text_style;
  $classes[] = $breadcrumb_text_align;
  if($breadcrumb_enable_image){
    $image_background_breadcrumb = '';
    if($breadcrumb_image){
      if(isset($breadcrumb_image['id']) && $breadcrumb_image['id'] && !is_numeric($breadcrumb_image)){
        if($breadcrumb_image['id'] && is_numeric($breadcrumb_image['id'])){
          $breadcrumb_image = $breadcrumb_image['id'];
        }
        $image = wp_get_attachment_image_src( $breadcrumb_image, 'full');
        if(isset($image[0]) && $image[0]){
          $image_background_breadcrumb = esc_url($image[0]);
        }
      }elseif(!is_array($breadcrumb_image)){
        $image_background_breadcrumb = $breadcrumb_image;
      }
    }
    if(!$image_background_breadcrumb) {
      $image_background_breadcrumb = VIZEON_THEME_URL . '/images/bg-breadcrumb.jpg';
    }
    $styles[] = 'background-image: url(\'' . $image_background_breadcrumb . '\')';
  }

  if(is_single() && empty($breadcrumb_page_title_one)){
    $title = get_the_title();
  }

  if($breadcrumb_padding_top){
    $styles_inner[] = "padding-top:{$breadcrumb_padding_top}px";
  }
  if($breadcrumb_padding_bottom){
    $styles_inner[] = "padding-bottom:{$breadcrumb_padding_bottom}px";
  }

  if( get_post_type() == 'post'){
    $title = esc_html__( 'Blog', 'vizeon' );
  }

  if(is_search()){
    $title = esc_html__('Search', 'vizeon');
  }

  if(function_exists('is_product') && is_product()){
    $title = esc_html__('Product', 'vizeon');
  }

  $result['title'] = $title;
  $result['styles'] = $styles;
  $result['styles_inner'] = $styles_inner;
  $result['styles_overlay'] = $styles_overlay;
  $result['classes'] = $classes;
  $result['show_page_title'] = $breadcrumb_show_title;
  return $result;
}

function vizeon_breadcrumb(){
   $result = vizeon_style_breadcrumb();
   extract($result);
   if(isset($no_breadcrumbs) && $no_breadcrumbs == true){
    echo '<div class="disable-breadcrumb clearfix"></div>';
    return false;
   }
    $image_breadcumb_standard = vizeon_get_option('image_breadcumb_standard', 'show-bg');
    $classes[] = $image_breadcumb_standard;
   ?>
   
   <div class="custom-breadcrumb <?php echo implode(' ', $classes); ?>" <?php echo(count($styles) > 0 ? 'style="' . implode(';', $styles) . '"' : ''); ?>>
      <?php if($styles_overlay){ ?>
         <div class="breadcrumb-overlay" style="<?php echo esc_attr($styles_overlay); ?>"></div>
      <?php } ?>
      <div class="breadcrumb-main">
        <div class="container">
          <div class="breadcrumb-container-inner" <?php echo(count($styles_inner) > 0 ? 'style="' . implode(';', $styles_inner) . '"' : ''); ?>>
            <?php vizeon_general_breadcrumbs(); ?>
            <?php if($title && ( $show_page_title || empty($show_page_title) ) ){ 
              echo '<h2 class="heading-title">' . esc_html( $title ) . '</h2>';
            } ?>
          </div>  
        </div>   
      </div>  
   </div>
   <?php
}

add_action( 'vizeon_before_page_content', 'vizeon_breadcrumb', '10' );

/**
 * Hook to select footer of page
 */
function vizeon_get_footer_layout( $footer = '' ){
  $post = get_post();
  
  $footer = ($post && get_post_meta( $post->ID, 'vizeon_page_footer', true )) ? get_post_meta( $post->ID, 'vizeon_page_footer', true ) : '__default_option_theme';
  
  if ( $footer == '__default_option_theme'){
    $footer = vizeon_get_option('footer_layout', '');
  }else{
    return trim( $footer );
  }

  return $footer;
} 
add_filter( 'vizeon_get_footer_layout', 'vizeon_get_footer_layout' );

/**
 * Hook to select footer of page
 */
function vizeon_get_header_layout( $header = '' ){
  $post = get_post();
  $header = ($post && get_post_meta( $post->ID, 'vizeon_page_header', true )) ? get_post_meta( $post->ID, 'vizeon_page_header', true ) : '__default_option_theme';
  if ( $header == '__default_option_theme'){
    $header = vizeon_get_option('header_layout', '');
  }
  if(empty($header)){
    $header = 'main-menu';
  }
  return $header;
} 
add_filter( 'vizeon_get_header_layout', 'vizeon_get_header_layout' );

function vizeon_main_menu(){
  if(has_nav_menu( 'primary' )){
    $vizeon_menu = array(
      'theme_location'    => 'primary',
      'container'         => 'div',
      'container_class'   => 'navbar-collapse',
      'container_id'      => 'gva-main-menu',
      'menu_class'        => ' gva-nav-menu gva-main-menu',
      'walker'            => new vizeon_Walker()
    );
    wp_nav_menu($vizeon_menu);
  }  
}
add_action( 'vizeon_main_menu', 'vizeon_main_menu', 10 );
 
function vizeon_mobile_menu(){
  if(has_nav_menu( 'primary' )){
    $vizeon_menu = array(
      'theme_location'    => 'primary',
      'container'         => 'div',
      'container_class'   => 'navbar-collapse',
      'container_id'      => 'gva-mobile-menu',
      'menu_class'        => 'gva-nav-menu gva-mobile-menu',
      'walker'            => new vizeon_Walker()
    );
    wp_nav_menu($vizeon_menu);
  }  
}
add_action( 'vizeon_mobile_menu', 'vizeon_mobile_menu', 10 );

function vizeon_my_account_menu(){
  if(has_nav_menu( 'my_account' )){
    $vizeon_menu = array(
      'theme_location'    => 'my_account',
      'container'         => 'div',
      'container_class'   => 'navbar-collapse',
      'container_id'      => 'gva-my-account-menu',
      'menu_class'        => 'gva-my-account-menu',
      'walker'            => new vizeon_Walker()
    );
    wp_nav_menu($vizeon_menu);
  }  
}
add_action( 'vizeon_my_account_menu', 'vizeon_my_account_menu', 11 );

function vizeon_header_mobile(){
  get_template_part('templates/parts/header', 'mobile');
}
add_action('vizeon_header_mobile', 'vizeon_header_mobile', 10);


if ( !function_exists( 'vizeon_style_footer' ) ) {
  function vizeon_style_footer(){
    $footer = vizeon_get_footer_layout(''); 
    
    if($footer!='default'){
      $shortcodes_custom_css = get_post_meta( $footer, '_wpb_shortcodes_custom_css', true );
      if ( ! empty( $shortcodes_custom_css ) ) {
        echo '<style>
          '.$shortcodes_custom_css.'
          </style>';
      }
    }
  }
  add_action('wp_head','vizeon_style_footer', 18);
}

add_filter('gavias-elements/map-api', 'vizeon_googlemap_api');
if(!function_exists('vizeon_googlemap_api')){
  function vizeon_googlemap_api( $key = '' ){
    return vizeon_get_option('map_api_key', '');
  }
}

add_filter('gavias-post-type/slug-service', 'vizeon_slug_service');
if(!function_exists('vizeon_slug_service')){
  function vizeon_slug_service( $key = '' ){
    return vizeon_get_option('slug_service', '');
  }
}

add_filter('gavias-post-type/slug-portfolio', 'vizeon_slug_portfolio');
if(!function_exists('vizeon_slug_portfolio')){
  function vizeon_slug_portfolio( $key = '' ){
    return vizeon_get_option('slug_portfolio', '');
  }
}

function vizeon_load_posttypes_default(){
  return array('megamenu');
}
add_filter( 'gaviasthemer_load_posttypes_default', 'vizeon_load_posttypes_default', 11, 2 );

function vizeon_setup_admin_setting(){
  global $pagenow; 
  if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
    update_option( 'gaviasthemer_active_post_types', array() );
    update_option( 'thumbnail_size_w', 180 );  
    update_option( 'thumbnail_size_h', 180 );  
    update_option( 'thumbnail_crop', 1 );  
    update_option( 'medium_size_w', 750 );  
    update_option( 'medium_size_h', 510 ); 
    update_option( 'medium_crop', 1 );  
  }
}
add_action( 'init', 'vizeon_setup_admin_setting'  );

if ( !function_exists( 'vizeon_page_class_names' ) ) {
  function vizeon_page_class_names( $classes ) {
    $class_el = get_post_meta( vizeon_id(), 'vizeon_extra_page_class', true  );
    if($class_el) $classes[] = $class_el;
    return $classes;
  }
}
add_filter( 'body_class', 'vizeon_page_class_names' );

