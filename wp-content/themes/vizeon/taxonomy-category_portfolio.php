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
    
   $sidebar_layout_config = vizeon_get_option('archive_portfolio_sidebar', 'right-sidebar'); 
   $left_sidebar = vizeon_get_option('archive_portfolio_left_sidebar', 'portfolio_sidebar');
   $right_sidebar = vizeon_get_option('archive_portfolio_right_sidebar', 'portfolio_sidebar');

   $left_sidebar_config  = array('active' => false);
   $right_sidebar_config = array('active' => false);
   $main_content_config  = array('class' => 'col-lg-12 col-xs-12');

   $columns_lg = vizeon_get_option('portfolio_columns_lg', '4');
   $columns_md = vizeon_get_option('portfolio_columns_md', '3');
   $columns_sm = vizeon_get_option('portfolio_columns_sm', '2');
   $columns_xs = vizeon_get_option('portfolio_columns_xs', '1');

   $sidebar_config = vizeon_sidebar_global($sidebar_layout_config, $left_sidebar, $right_sidebar);
   
   extract($sidebar_config);

 ?>

<section id="wp-main-content" class="clearfix main-page">
    <?php do_action( 'vizeon_before_page_content' ); ?>
    <div class="container">  
      <div class="main-page-content row">
        <div class="content-page <?php echo esc_attr($main_content_config['class']); ?>">      
          <div id="wp-content" class="wp-content clearfix">
            <div class="lg-block-grid-<?php echo esc_attr($columns_lg) ?> md-block-grid-<?php echo esc_attr($columns_md) ?> sm-block-grid-<?php echo esc_attr($columns_sm) ?> xs-block-grid-<?php echo esc_attr($columns_xs) ?>">
               <?php while ( have_posts() ) : the_post(); ?>
                  <?php get_template_part( 'templates/content/item', 'portfolio-style-1' ); ?>
               <?php endwhile; ?>  
            </div>
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
