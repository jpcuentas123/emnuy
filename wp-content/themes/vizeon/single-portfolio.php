<?php
/**
 * $Desc
 *
 * @version    1.0
 * @package    basetheme
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2016 Gaviasthemess. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
    get_header(); 

    $page_id = vizeon_id();

    $default_sidebar_config = vizeon_get_option('single_portfolio_sidebar', 'right-sidebar'); 
    $default_left_sidebar = vizeon_get_option('single_portfolio_left_sidebar', 'blog_sidebar');
    $default_right_sidebar = vizeon_get_option('single_portfolio_right_sidebar', 'blog_sidebar');

    $sidebar_layout_config = get_post_meta($page_id, 'vizeon_sidebar_config', true);
    $left_sidebar = get_post_meta($page_id, 'vizeon_left_sidebar', true);
    $right_sidebar = get_post_meta($page_id, 'vizeon_right_sidebar', true);

    if ($sidebar_layout_config == "") {
        $sidebar_layout_config = $default_sidebar_config;
    }
    if ($left_sidebar == "") {
        $left_sidebar = $default_left_sidebar;
    }
    if ($right_sidebar == "") {
        $right_sidebar = $default_right_sidebar;
    }

   $left_sidebar_config  = array('active' => false);
   $right_sidebar_config = array('active' => false);
   $main_content_config  = array('class' => 'col-lg-12 col-xs-12');

    $sidebar_config = vizeon_sidebar_global($sidebar_layout_config, $left_sidebar, $right_sidebar);
   
    extract($sidebar_config);

 ?>

<section id="wp-main-content" class="clearfix main-page">
    <?php do_action( 'vizeon_before_page_content' ); ?>
    <div class="container">  
      <div class="main-page-content row">
        <div class="content-page <?php echo esc_attr($main_content_config['class']); ?>">      
          <div id="wp-content" class="wp-content clearfix">
            <?php while ( have_posts() ) : the_post(); ?>
              
              <div class="portfolio-thumbnail">
                <?php $gallery = get_post_meta(get_the_ID(), 'vizeon_gallery_images', false ); ?>
                <?php if(count($gallery)){ ?>
                  <div class="init-carousel-owl-theme owl-carousel" data-items="1" data-items_lg="1" data-items_md="1" data-items_sm="1" data-items_xs="1" data-loop="1" data-speed="1000" data-auto_play="1" data-auto_play_speed="1000" data-auto_play_timeout="3000" data-auto_play_hover="1" data-navigation="1" data-rewind_nav="1" data-pagination="1" data-mouse_drag="1" data-touch_drag="1">
                    <?php foreach ($gallery as $image) { 
                      $img = wp_get_attachment_image_src($image, 'full');
                      $img_thumb = wp_get_attachment_image_src($image, 'thumbnail');
                    ?>
                    <div class="item"><img src="<?php echo esc_url($img[0]) ?>" alt="<?php the_title_attribute() ?>" /></div>
                    <?php } ?>
                  </div>
                <?php }else{ ?>  
                  <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                <?php } ?>
              </div>
              
              <div class="portfolio-content">
                <h1 class="title"><?php echo get_the_title() ?></h1>
                <?php 
                
                  $informations = get_post_meta(get_the_ID(), 'pinformations', false ); 
                  if(isset($informations[0]) && $informations){
                    $informations = $informations[0];
                    $informations = array_filter($informations);
                  }else{
                    $informations = false;
                  }
                ?>

                <?php if($informations && !empty($informations)){ ?>

                  <div class="portfolio-information">
                    <ul>
                      <?php foreach ($informations as $key => $info) { ?>
                        <?php if(isset($info['value']) && !empty($info['value'])){ ?>
                          <li>
                            <span class="label"><?php echo esc_html($info['label']) ?>: </span>
                            <span class="value"><?php echo esc_html($info['value']) ?></span>
                          </li>
                        <?php } ?>  
                      <?php } ?>
                    </ul>
                  </div>
                <?php } ?>

                <div class="content-inner"><?php the_content() ?></div>

              </div>  
            <?php endwhile; ?>  

            <?php 
              if( comments_open() || get_comments_number() ) {
                comments_template();
              }
            ?>
            <?php vizeon_post_nav(); ?>
          </div>    
        </div>      

         <!-- Left sidebar -->
         <?php if($left_sidebar_config['active']): ?>
         <div class="sidebar wp-sidebar sidebar-left <?php echo esc_attr($left_sidebar_config['class']); ?>">
            <?php do_action( 'vizeon_before_sidebar' ); ?>
            <div class="sidebar-inner">
               <?php dynamic_sidebar($left_sidebar_config['name'] ); ?>
            </div>
            <?php do_action( 'vizeon_after_sidebar' ); ?>
         </div>
         <?php endif ?>

         <!-- Right Sidebar -->
         <?php if($right_sidebar_config['active']): ?>
         <div class="sidebar wp-sidebar sidebar-right <?php echo esc_attr($right_sidebar_config['class']); ?>">
            <?php do_action( 'vizeon_before_sidebar' ); ?>
               <div class="sidebar-inner">
                  <?php dynamic_sidebar($right_sidebar_config['name'] ); ?>
               </div>
            <?php do_action( 'vizeon_after_sidebar' ); ?>
         </div>
         <?php endif ?>
      </div>   
    </div>
    <?php do_action( 'vizeon_after_page_content' ); ?>
</section>

<?php get_footer(); ?>
