<?php
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 10 );
add_action('woocommerce_after_single_product_summary', 'vizeon_woocommerce_output_product_data', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'vizeon_woocommerce_breadcrumb', 20 );

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_filter( 'loop_shop_per_page', 'vizeon_woocommerce_shop_pre_page', 20 );

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title',  'vizeon_swap_images', 10);

// Add save percent next to sale item prices.
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'vizeon_woocommerce_custom_sales_price', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

if(!function_exists('vizeon_woocommerce_custom_sales_price')){
  function vizeon_woocommerce_custom_sales_price() {
    global $product;
    if($product->get_sale_price()){
      $percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
      echo ( '<span class="onsale">-' . $percentage . '%</span>' );
    }
  }
}

if(!function_exists('vizeon_woocommerce_shop_pre_page')){
   function vizeon_woocommerce_shop_pre_page(){
      return vizeon_get_option('products_per_page', 16);
   }
}

if(!function_exists('vizeon_woocommerce_breadcrumb')){
  function vizeon_woocommerce_breadcrumb(){
      $result = vizeon_style_breadcrumb();
      extract($result);
    ?>
    <div class="custom-breadcrumb <?php echo implode(' ', $classes); ?>" <?php echo(count($styles) > 0 ? 'style="' . implode(';', $styles) . '"' : ''); ?>>
      <?php if($styles_overlay){ ?>
         <div class="breadcrumb-overlay" style="<?php echo esc_attr($styles_overlay); ?>"></div>
      <?php } ?>
      <div class="breadcrumb-main">
        <div class="container">
          <div class="breadcrumb-container-inner" <?php echo(count($styles_inner) > 0 ? 'style="' . implode(';', $styles_inner) . '"' : ''); ?>>
            <?php vizeon_general_breadcrumbs(); ?>
            <?php if($title && $show_page_title){  
              echo '<h2 class="heading-title">' . esc_html( $title ) . '</h2>';
            } ?>
          </div>  
        </div>   
      </div>  
    </div>
    <?php
  }
}

if ( ! function_exists( 'vizeon_woocommerce_output_product_data_accordions' ) ) {
   function vizeon_woocommerce_output_product_data_accordions() {
      wc_get_template( 'single-product/tabs/accordions.php' );
   }
}

if(!function_exists('vizeon_woocommerce_output_product_data')){
   function vizeon_woocommerce_output_product_data(){
      global $post;
      $tab_style = get_post_meta($post->ID, 'vizeon_product_tab_style', true);
      $tab_style = 'tabs';
      if($tab_style == 'accordion'){
         vizeon_woocommerce_output_product_data_accordions();
      }else{
         woocommerce_output_product_data_tabs();
      }
   }
}      

if(! function_exists('vizeon_display_modes_value')){
   function vizeon_display_modes_value(){
      $woo_display = 'grid';
      if ( isset($_COOKIE['vizeon_woo_display']) && $_COOKIE['vizeon_woo_display'] == 'list' ) {
         $woo_display = $_COOKIE['vizeon_woo_display'];
      }
      return $woo_display;
   }
}

if ( ! function_exists('vizeon_display_modes_link')){
   function vizeon_display_modes_link(){
      global $wp;
      $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );;
      $woo_display = vizeon_display_modes_value();
      $current_url = preg_replace('/([?&])display=[^&]+(&|$)/','$2',$current_url);
      if(strpos($current_url, '?')){
        $current_url .= '&';
      }
      else{
        $current_url .= '?';
      }

      echo '<div class="woo-display-mode">';
        echo '<a href="'.esc_url( $current_url . 'display=grid' ).'" title="'.esc_attr__('Grid', 'vizeon' ).'" class="btn grid '.($woo_display == 'grid' ? 'active' : '').'"><i class="gv-icon-99"></i></a>';  
        echo '<a href="'.esc_url( $current_url . 'display=list' ).'" title="'.esc_attr__( 'List', 'vizeon' ).'" class="btn list '.($woo_display == 'list' ? 'active' : '').'"><i class="gv-icon-105"></i></a>';
      echo '</div>';
   }
}   
add_action( 'woocommerce_before_shop_loop', 'vizeon_display_modes_link' , 11 );

if ( ! function_exists('vizeon_set_woo_display_mode')){
   function vizeon_set_woo_display_mode(){
      if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
         setcookie( 'vizeon_woo_display', trim($_GET['display']) , time()+3600*24*100,'/' );
         $_COOKIE['vizeon_woo_display'] = trim($_GET['display']);
      }
   }
}   
add_action( 'init', 'vizeon_set_woo_display_mode' );


function vizeon_swap_images(){
  global $post, $product, $woocommerce;
  $image_size = get_option('shop_catalog_image_size');
  $_width = $image_size['width'];
  $_height = $image_size['height'];
  $output = '';
  $class = 'image';
  if(has_post_thumbnail()){
      $attachment_ids = $product->get_gallery_image_ids();
      if($attachment_ids && isset($attachment_ids[0])) {
        $output .= '<div class="swap-thumbnail">';
        $output .= '<a href="' . get_the_permalink() . '">';
        $class = 'image-second';
        $output .= wp_get_attachment_image($attachment_ids[0],'shop_catalog', false, array('class'=>$class));
      }

      $output .= '<span class="attachment-shop_catalog">' . get_the_post_thumbnail( $post->ID,'shop_catalog', array('class'=>'') ) . '</span>';

      if($attachment_ids && isset($attachment_ids[0])) {
         $output .= '</a>';
         $output .= '</div>';
          
      }
  }else{
      $output .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'. $post->title .'" class="'.$class.'" width="'.$_width.'" height="'.$_height.'" />';
  }
 
  echo trim($output);
}


/*
 * Load product ajax (Quick view)
*/
if ( ! function_exists('vizeon_ajax_load_product')){
   function vizeon_ajax_load_product() {
      global $woocommerce, $product, $post;
      $product = wc_get_product( $_POST['product_id'] );
      $post = $product->post;
      $output = '';
      
      setup_postdata( $post );
         
      ob_start();
      wc_get_template_part( 'quickview/content', 'quickview' );
      $output = ob_get_clean();
      
      wp_reset_postdata();
            
      echo trim($output);
            
      exit;
   }
}   

add_action( 'wp_ajax_vizeon_ajax_load_product' , 'vizeon_ajax_load_product' );
add_action( 'wp_ajax_nopriv_vizeon_ajax_load_product', 'vizeon_ajax_load_product' );
add_action( 'wc_ajax_vizeon_ajax_load_product', 'vizeon_ajax_load_product' );

/*
 * Load product ajax (Quick view)
*/
if ( ! function_exists('vizeon_ajax_load_product_tab')){
   function vizeon_ajax_load_product_tab() {
      global $woocommerce, $product, $post;
      $output = '';
      
      $columns_count = $_POST['columns'];
      $carousel_row = $_POST['row'];
      $style = $_POST['style'];
      $product_cat = $_POST['categories'];
      $number = $_POST['number'];
      $product_type = $_POST['product_type'];
      $class_column = vizeon_calc_class_grid($columns_count);
      $loop = vizeon_woocommerce_query($product_type, $number, $product_cat);
         
      ob_start();
      
      if($loop->have_posts()){
        wc_get_template( 'display/'.$style.'.php' , array( 'loop'=>$loop, 'columns_count'=>$columns_count, 'class_column'=>$class_column, 'carousel_row' => $carousel_row  ) );
      }

      $output = ob_get_clean();
      
      wp_reset_postdata();
            
      echo trim($output);
            
      exit;
   }
}   

add_action( 'wp_ajax_vizeon_ajax_load_product_tab' , 'vizeon_ajax_load_product_tab' );
add_action( 'wp_ajax_nopriv_vizeon_ajax_load_product_tab', 'vizeon_ajax_load_product_tab' );
add_action( 'wc_ajax_vizeon_ajax_load_product_tab', 'vizeon_ajax_load_product_tab' );