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
   if(!empty($settings['title_size'])) $header_tag = $settings['title_size'];

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

   $this->add_render_attribute( 'block', 'class', [ 'widget', 'milestone-block', $settings['style'] ] );
   $this->add_render_attribute( 'description_text', 'class', 'milestone-content' );
   $this->add_render_attribute( 'title_text', 'class', 'milestone-text' );

   $this->add_inline_editing_attributes( 'title_text', 'none' );
   $this->add_inline_editing_attributes( 'description_text' );

   ?>

   <?php if($style == 'style-1' || $style == 'style-2'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="box-content">
            <?php if ( $has_icon ){ ?>
               <div class="milestone-icon">
                  <?php if( $settings['use_icon_image'] != 'yes' ){ ?>
                     <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>></span>
                  <?php }else{ ?>
                     <span class="icon icon-image"><img src="<?php echo esc_url($icon_image) ?>" alt="<?php echo esc_html($settings['title_text']) ?>"/></span>
                  <?php } ?>   
               </div>
            <?php } ?>

            <div class="milestone-content">
               <div class="milestone-number-inner"><span class="milestone-number"><?php echo esc_attr($settings['number']); ?></span><span class="symbol"></span></div>
               <?php if(!empty($settings['title_text'])){ ?>
                  <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                     <?php echo $title_html; ?>
                  </<?php echo esc_attr($header_tag) ?>>
               <?php } ?>
            </div>
         </div>   
      </div> 
   <?php } ?>

