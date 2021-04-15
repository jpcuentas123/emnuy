<?php
   $this->add_render_attribute( 'icon', 'class', [ 'icon icon-font'] );
   
   $this->add_render_attribute( 'icon_image', 'class', [ 'icon icon-image' ] );
   
   $icon = $icon_image = '';
   if($settings['use_icon_image'] == 'yes'){
      $icon_image = (isset($settings['icon_image']['url']) && $settings['icon_image']['url']) ? $settings['icon_image']['url'] : '';
   }else{
      $icon = $settings['icon'];
   }

   $has_icon = ! ( empty( $icon ) && empty( $icon_image ) );

   if(!$has_icon){
      $icon = 'fa fa-search';
      $has_icon = true;
      $settings['use_icon_image'] = false;
   }
   if($settings['use_icon_image'] != 'yes'){
      $this->add_render_attribute( 'i', 'class', $settings['icon'] );
      $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
   }
   $this->add_render_attribute( 'block', 'class', [ $settings['style'], 'widget gsc-search-box' ] );

   ?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="content-inner">
         
         <div class="main-search gva-search">
            <?php if($has_icon){ ?>
               <a class="control-search">
                  <?php if( $settings['use_icon_image'] != 'yes' ){ ?>
                     <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
                        <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
                     </span>   
                  <?php }else{ ?>
                     <span <?php echo $this->get_render_attribute_string( 'icon_image' ); ?>><img src="<?php echo esc_url($icon_image) ?>" alt=""/></span>
                  <?php } ?>
               </a>
            <?php } ?>   

            <div class="gva-search-content search-content">
              <div class="search-content-inner">
                <div class="content-inner"><?php get_search_form(); ?></div>  
              </div>  
            </div>
         </div>
         
      </div>
   </div>
