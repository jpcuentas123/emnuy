<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

require 'includes/overrides.php';

if(!class_exists('GVA_Elementor_Addons')){
  class GVA_Elementor_Addons {

    public function __construct() {
      add_action('elementor/init', array($this, 'add_category'));
      add_action('elementor/widgets/widgets_registered', array($this, 'include_elements'));
      add_action( 'elementor/frontend/after_register_scripts', [ $this, 'enqueue_frontend_scripts' ] );
      add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
      add_action( 'elementor/preview/enqueue_styles', function() {
        wp_enqueue_style( 'owl-carousel-css' );
      } );
    }

    public function include_elements($widgets_manager) {
    
      require 'elements/gva-base.php';

      require 'elements/gva-logo.php';
      $widgets_manager->register_widget_type(new GVAElement_Logo());

      require 'elements/gva-navigation-menu.php';
      $widgets_manager->register_widget_type(new GVAElement_Navigation_Menu());

      require 'elements/gva-search-box.php';
      $widgets_manager->register_widget_type(new GVAElement_Search_Box());

      require 'elements/gva-brand.php';
      $widgets_manager->register_widget_type(new GVAElement_Brand());

      require 'elements/gva-counter.php';
      $widgets_manager->register_widget_type(new GVAElement_Counter());

      require 'elements/gva-icon-box-classic.php';
      $widgets_manager->register_widget_type(new GVAElement_Icon_Box_Classic());

      require 'elements/gva-icon-box-styles.php';
      $widgets_manager->register_widget_type(new GVAElement_Icon_Box_Styles());

      require 'elements/gva-heading-block.php';
      $widgets_manager->register_widget_type(new GVAElement_Heading_Block());
     
      require 'elements/gva-image-content.php';
      $widgets_manager->register_widget_type(new GVAElement_Image_Content());

      require 'elements/gva-posts.php';
      $widgets_manager->register_widget_type(new GVAElement_Posts());

      require 'elements/gva-teams.php';
      $widgets_manager->register_widget_type(new GVAElement_Teams());

      require 'elements/gva-testimonial.php';
      $widgets_manager->register_widget_type(new GVAElement_Testimonial());

      require 'elements/gva-video-box.php';
      $widgets_manager->register_widget_type(new GVAElement_Video_Box());

      require 'elements/gva-gallery.php';
      $widgets_manager->register_widget_type(new GVAElement_Gallery());

      require 'elements/gva-pricing-block.php';
      $widgets_manager->register_widget_type(new GVAElement_Pricing_Block());

      require 'elements/gva-services.php';
      $widgets_manager->register_widget_type(new GVAElement_Services());

      require 'elements/gva-events.php';
      $widgets_manager->register_widget_type(new GVAElement_Events());
      
      require 'elements/gva-map.php';
      $widgets_manager->register_widget_type(new GVAElement_Map());

      require 'elements/gva-call-to-action.php';
      $widgets_manager->register_widget_type(new GVAElement_Call_To_Action());

      require 'elements/gva-portfolio.php';
      $widgets_manager->register_widget_type(new GVAElement_Portfolio());

      require 'elements/gva-tabs-color.php';
      $widgets_manager->register_widget_type(new GVAElement_Tabs_Color());

      require 'elements/gva-socials.php';
      $widgets_manager->register_widget_type(new GVAElement_Socials());

      require 'elements/gva-information.php';
      $widgets_manager->register_widget_type(new GVAElement_Information());

      require 'elements/gva-career-block.php';
      $widgets_manager->register_widget_type(new GVAElement_Career_Block());

      if(class_exists('RevSlider')){
        require 'elements/gva-rev-slider.php';
        $widgets_manager->register_widget_type(new GVAElement_Rev_Slider());
      }
    }

    public function add_category() {
      Elementor\Plugin::instance()->elements_manager->add_category(
      'gavias_elements',
      array(
        'title' => __('Gavias Elements', 'vizeon-themer'),
        'icon'  => 'fa fa-plug',
      ),
      9);
    }
         
    public function enqueue_frontend_scripts() {
      wp_register_script('jquery.owl.carousel', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/libs/owl-carousel/owl.carousel.js' , array(), '1.0.0', true);
      wp_register_script('jquery.appear', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/libs/jquery.appear.js' , array(), '1.0.0', true);
      wp_register_script('jquery.count_to', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/libs/count-to.js' , array(), '1.0.0', true);
      wp_register_script('isotope', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/libs/isotope.pkgd.min.js' , array(), '1.0.0', true);
      wp_register_script('gavias.elements', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/main.js' , array(), '1.0.0', true);
      
      wp_register_script('map-ui', GAVIAS_VIZEON_PLUGIN_URL . '/elementor/assets/libs/jquery.ui.map.min.js');
      $google_api_key = apply_filters('gavias-elements/map-api', '');
      wp_register_script(
        'google-maps-api',
        add_query_arg( array( 'key' => $google_api_key ), 'https://maps.googleapis.com/maps/api/js' ), false, false, true
      );
    }

    public function enqueue_frontend_styles() {
      wp_register_style('owl-carousel-css', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/libs/owl-carousel/assets/owl.carousel.css', false, '1.0.0');
      wp_enqueue_style('gva-element-base', GAVIAS_VIZEON_PLUGIN_URL . 'elementor/assets/css/base.css');
    }
  }     
}

$addons = new GVA_Elementor_Addons();

