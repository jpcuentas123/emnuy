<?php
   $icon_tag = 'span';

   $icon = $icon_image = '';
   if($settings['use_icon_image'] == 'yes'){
      $icon_image = (isset($settings['icon_image']['url']) && $settings['icon_image']['url']) ? $settings['icon_image']['url'] : '';
   }else{
      $icon = $settings['icon'];
   }

   $has_icon = ! ( empty( $icon ) && empty( $icon_image ) );

   $style = $settings['style'];
   $description_text = $settings['description_text'];
   $header_tag = 'h2';
   if(!empty($settings['header_tag'])) $header_tag = $settings['header_tag'];

   if ( ! empty( $settings['link']['url'] ) ) {
      $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
      $icon_tag = 'a';

      if ( $settings['link']['is_external'] ) {
         $this->add_render_attribute( 'link', 'target', '_blank' );
      }

      if ( $settings['link']['nofollow'] ) {
         $this->add_render_attribute( 'link', 'rel', 'nofollow' );
      }
   }

   if ( $has_icon ) {
      $this->add_render_attribute( 'icon', 'class', ['icon', $icon] );
      $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
   }

   $title_html = $settings['title_text'];
   if (!empty($settings['link']['url'])) :
      $title_html = '<a href="' . esc_url($settings['link']['url']) . '">' . $title_html . '</a>';
   endif;

   $this->add_render_attribute( 'block', 'class', [ 'widget gsc-icon-box-styles', $settings['style'] ] );
   $this->add_render_attribute( 'description_text', 'class', 'desc' );
   $this->add_render_attribute( 'title_text', 'class', 'title' );

   $this->add_inline_editing_attributes( 'title_text', 'none' );
   $this->add_inline_editing_attributes( 'description_text' );

   ?>

   <?php if($style == 'style-1' || $style == 'style-4'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         
         <?php if ( $has_icon ){ ?>
            <div class="icon-inner">
               <?php if( $settings['use_icon_image'] != 'yes' ){ ?>
                  <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>></span>
               <?php }else{ ?>
                  <span class="icon icon-image"><img src="<?php echo esc_url($icon_image) ?>" alt="<?php echo esc_html($settings['title_text']) ?>"/></span>
               <?php } ?>   
            </div>
         <?php } ?>

         <div class="content-inner">
            <?php if(!empty($settings['title_text'])){ ?>
               <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                  <?php echo $title_html; ?>
               </<?php echo esc_attr($header_tag) ?>>
            <?php } ?>

            <?php if(!empty($settings['description_text'])){ ?>
               <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
            <?php } ?>

         </div>
      </div> 
   <?php } ?>

   <?php if($style == 'style-2'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="block-content">
            <?php if ( $has_icon ){ ?>
               <div class="icon-inner">
                  <?php if( $settings['use_icon_image'] != 'yes' ){ ?>
                     <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>></span>
                  <?php }else{ ?>
                     <span class="icon icon-image"><img src="<?php echo esc_url($icon_image) ?>" alt="<?php echo esc_html($settings['title_text']) ?>"/></span>
                  <?php } ?>   
               </div>
            <?php } ?>

            <div class="content-inner">
               <?php if(!empty($settings['title_text'])){ ?>
                  <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                     <?php echo $title_html; ?>
                  </<?php echo esc_attr($header_tag) ?>>
               <?php } ?>
            </div>
         </div>   
      </div> 
   <?php } ?>

   <?php if($style == 'style-3'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="block-content">
            <div class="content-inner">
               
               <?php if(!empty($settings['title_text'])){ ?>
                  <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                     <?php echo $title_html; ?>
                  </<?php echo esc_attr($header_tag) ?>>
               <?php } ?>

               <?php if(!empty($settings['description_text'])){ ?>
                  <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
               <?php } ?>

            </div>
         </div>   
      </div> 
   <?php } ?>   


