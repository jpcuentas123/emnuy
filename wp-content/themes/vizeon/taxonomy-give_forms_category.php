<?php
  get_header();

  $page_id = vizeon_id();
  
  $sidebar_layout_config = vizeon_get_option('give_sidebar_config', '');
  $left_sidebar = vizeon_get_option('give_left_sidebar', '');
  $right_sidebar = vizeon_get_option('give_right_sidebar', '');

  $left_sidebar_config  = array('active' => false);
  $right_sidebar_config = array('active' => false);
  $main_content_config  = array('class' => 'col-lg-12 col-xs-12');

  $columns_lg = vizeon_get_option('give_columns_lg', '4');
  $columns_md = vizeon_get_option('give_columns_md', '3');
  $columns_sm = vizeon_get_option('give_columns_sm', '2');
  $columns_xs = vizeon_get_option('give_columns_xs', '1');

  $left_sidebar_config  = array('active' => false);
  $right_sidebar_config = array('active' => false);
  $main_content_config  = array('class' => 'col-lg-12 col-xs-12');

  $sidebar_config = vizeon_sidebar_global($sidebar_layout_config, $left_sidebar, $right_sidebar);
   
  extract($sidebar_config);

  $edu_display = vizeon_display_modes_value();
  global $query;
 ?>

<section id="wp-main-content" class="clearfix archive-give main-page">
  <?php do_action( 'vizeon_give_before_main_content' ); ?>
  <div class="container">  
    <div class="main-page-content">
      
      <div class="content-page <?php echo esc_attr($main_content_config['class']); ?>">    
        <div id="wp-content" class="wp-content">  
          <?php if ( have_posts() ) : ?>
            <div class="shop-loop-container course-grid">
              <div class="layout-<?php echo esc_attr($edu_display) ?>">
                <div class="lg-block-grid-<?php echo esc_attr($columns_lg) ?> md-block-grid-<?php echo esc_attr($columns_md) ?> sm-block-grid-<?php echo esc_attr($columns_sm) ?> xs-block-grid-<?php echo esc_attr($columns_xs) ?>">
                  <?php while ( have_posts() ) : the_post(); ?>
                    <div class="item-columns margin-bottom-30"><?php get_template_part( 'give/content', 'form' ); ?></div>
                  <?php endwhile; ?>
                </div>  
              </div>
              <?php echo vizeon_pagination($query); ?>
            </div>
          <?php endif ?>
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
  <?php do_action( 'vizeon_give_after_main_content' ); ?>
</section>

<?php get_footer(); ?>
