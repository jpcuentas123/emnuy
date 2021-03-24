<?php
class Gavias_Themer_Footer{
  public static $post_type = 'footer';
  
  public static $instance;

  public static function getInstance() {
    if (!isset(self::$instance) && !(self::$instance instanceof Gavias_Themer_Footer)) {
      self::$instance = new Gavias_Themer_Footer();
    }
    return self::$instance;
  }

  public function __construct(){ 
    
  }

  public function register_post_type_footer(){
    add_action('init', array($this, 'args_post_type_footer'), 10);
  }

  public function args_post_type_footer(){
    $labels = array(
      'name' => __( 'Footer Builder', 'gaviasframework' ),
      'singular_name' => __( 'Footer Builder', 'gaviasframework' ),
      'add_new' => __( 'Add Footer Builder', 'gaviasframework' ),
      'add_new_item' => __( 'Add Footer Builder', 'gaviasframework' ),
      'edit_item' => __( 'Edit Footer', 'gaviasframework' ),
      'new_item' => __( 'New Footer Builder', 'gaviasframework' ),
      'view_item' => __( 'View Footer Builder', 'gaviasframework' ),
      'search_items' => __( 'Search Footer Profiles', 'gaviasframework' ),
      'not_found' => __( 'No Footer Profiles found', 'gaviasframework' ),
      'not_found_in_trash' => __( 'No Footer Profiles found in Trash', 'gaviasframework' ),
      'parent_item_colon' => __( 'Parent Footer:', 'gaviasframework' ),
      'menu_name' => __( 'Footer Builder', 'gaviasframework' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => true,
        'description'         => __('List Footer', "gaviasthemer"),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post'
    );
    register_post_type( self::$post_type, $args );
  }


    // /**
    //  * @param $wp_admin_bar WP_Admin_Bar
    //  */
    // public function custom_button_footer_builder($wp_admin_bar) {
    //     global $osf_footer;
    //     if ($osf_footer && $osf_footer instanceof WP_Post) {
    //         $args = array(
    //             'id'    => 'footer-builder-button',
    //             'title' => __('Edit Footer', 'vizeon-themer'),
    //             'href'  => add_query_arg('action', 'elementor', remove_query_arg('action', get_edit_post_link($osf_footer->ID))),
    //         );
    //         $wp_admin_bar->add_node($args);
    //     }
    // }

  public function get_footers(){
    $args = array(
      'post_type'     => 'footer',
      'posts_per_page'   => -1,
      'post_status'    => 'publish',
    );
    $footers = array();
    $post_list = get_posts($args);
    foreach ( $post_list as $post ) {
      $footers[$post->post_name] = $post->post_title;
    }
    
    $footers['__default_option_theme'] = esc_html__('Default Option Theme', 'vizeon');
    $footers['__disable_footer'] = esc_html__('Disable Footer', 'vizeon');
    $footers['__default'] = __('Default Widget Footer', 'vizeon-themer');
    wp_reset_postdata();
    return apply_filters('gaviasthemes_list_footer', $footers );
  }

  public function render_footer_builder($footer_slug) {
    $footer = get_page_by_path($footer_slug, OBJECT, 'footer');
    if ($footer && $footer instanceof WP_Post) {
      return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer->ID );
    }
  }
}

Gavias_Themer_Footer::getInstance()->register_post_type_footer();