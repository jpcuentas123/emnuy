<?php $vizeon_options = vizeon_get_options(); ?>

<div class="header-mobile d-xl-none d-lg-none d-md-block d-sm-block d-xs-block">
  <div class="container">
    <div class="row"> 
     
      <div class="left col-md-3 col-sm-3 col-xs-3">
        <?php get_template_part('templates/parts/canvas-mobile'); ?>
      </div>

      <div class="center text-center col-md-6 col-sm-6 col-xs-6 mobile-logo">
        <div class="logo-menu">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo ((isset($vizeon_options['header_logo_mobile']['url']) && $vizeon_options['header_logo_mobile']['url']) ? $vizeon_options['header_logo_mobile']['url'] : get_template_directory_uri().'/images/logo-mobile.png'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
          </a>
        </div>
      </div>

      <div class="right col-md-3 col-sm-3 col-xs-3">
        <?php if(vizeon_woocommerce_activated()){ ?>
          <div class="mini-cart-header">
              <?php  vizeon_get_cart_contents(); ?>
          </div>
        <?php } ?>
        <div class="main-search gva-search">
          <a class="control-search"><i class="icon fa fa-search"></i></a>
          <div class="gva-search-content search-content">
            <div class="search-content-inner">
              <div class="content-inner"><?php get_search_form(); ?></div>  
            </div>  
          </div>
        </div>
      </div> 

    </div>  
  </div>  
</div>