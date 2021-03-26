<?php
   if ( empty( $settings['title_text'] ) ) {
      return;
   }
   $title_text = $settings['title_text'];

   $this->add_render_attribute( 'block', 'class', [ 'widget gsc-pricing' ] );
   $header_tag = 'div';

   $this->add_render_attribute( 'title_text', 'class', 'title btn-black' );

   $this->add_inline_editing_attributes( 'title_text', 'none' );

   ?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <div class="content-inner">
       
         <?php if($title_text){ ?>
            <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
               <span><?php echo $settings['title_text'] ?></span>
            </<?php echo esc_attr($header_tag) ?>>
         <?php } ?>
        
         <div class="plan-price">
            <div class="price-value clearfix">
               <span class="currency"><?php echo esc_html( $settings['currency'] ) ?></span><span class="value"><?php echo esc_html( $settings['price'] ) ?></span>
            </div>
            <div class="interval"><?php echo esc_html( $settings['period'] ) ?></div>
         </div>

         <?php if($settings['pricing_content']){ ?>
            <ul class="plan-list">
               <?php foreach ($settings['pricing_content'] as $key => $item) { ?>
                  <li><?php echo $item['pricing_features'] ?></li>  
               <?php } ?>
            </ul>
         <?php } ?>   


         <?php if($settings['button_url']['url']){ ?>
            <div class="pricing-action">
               <?php $this->gva_render_button('btn-theme'); ?>
            </div>
         <?php } ?>
      </div>
   </div>
   <div class="clearfix"></div>
