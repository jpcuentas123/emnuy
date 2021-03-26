<?php
  use Elementor\Group_Control_Image_Size;

  $settings = $this->get_settings_for_display();
  if ( empty( $settings['title_text'] ) ) {
    return;
  }
  $skin = $settings['style'];
  $title_text = $settings['title_text'];
  $description_text = $settings['description_text'];
  $this->add_render_attribute( 'block', 'class', [ 'gsc-image-content', $settings['style'] ] );
  $header_tag = 'h2';
   
  $this->add_render_attribute( 'title_text', 'class', 'title' );
  $this->add_render_attribute( 'description_text', 'class', 'desc' );

  if ( ! empty( $settings['link']['url'] ) ) {
    $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
    if ( $settings['link']['is_external'] ) {
      $this->add_render_attribute( 'link', 'target', '_blank' );
    }
    if ( $settings['link']['nofollow'] ) {
      $this->add_render_attribute( 'link', 'rel', 'nofollow' );
    }
  }

  $this->add_inline_editing_attributes( 'title_text', 'none' );
  $this->add_inline_editing_attributes( 'description_text' );

  $title_html = $settings['title_text'];
  if (!empty($settings['link']['url'])) :
    $team_name_html = '<a href="' . esc_url($settings['link']['url']) . '">' . $title_html . '</a>';
  endif;
?>
      
   <?php if($skin == 'skin-v1'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
        
        <?php if (!empty($settings['image']['url'])) : ?>
          <div class="image">
            <?php $image_url = $settings['image']['url']; ?>
            <a <?php echo $this->get_render_attribute_string( 'link' ) ?>>
              <img src="<?php echo esc_url($image_url)?>" alt="<?php echo esc_attr($settings['title_text']) ?>" />
            </a>
            <?php if($title_text){ ?>
              <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                 <?php echo $title_html; ?>
              </<?php echo esc_attr($header_tag) ?>>
            <?php } ?> 
          </div>
        <?php endif; ?>

        <?php if (!empty($settings['image_second']['url'])) : ?>
          <div class="image-second">
            <?php $image_url_second = $settings['image_second']['url']; ?>
            <a <?php echo $this->get_render_attribute_string( 'link' ) ?>>
              <img src="<?php echo esc_url($image_url_second)?>" alt="<?php echo esc_attr($settings['title_text']) ?>" />
            </a>
          </div>
        <?php endif; ?>

      </div>
   <?php } ?>  
    
   <?php if($skin == 'skin-v2'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <?php if (!empty($settings['image']['url'])) : ?>
            <div class="image">
               <?php
                 $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
                 echo $image_html;
               ?>
            </div>
         <?php endif; ?>
         <div class="box-content">
            <?php if($title_text){ ?>
               <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                  <?php echo $title_html; ?>
               </<?php echo esc_attr($header_tag) ?>>
            <?php } ?>
            <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
            <?php if(!empty($settings['link']['url'])){ ?>
               <div class="read-more"><a class="btn-inline" href="<?php echo $settings['link']['url'] ?>"><?php echo $settings['link_text'] ?></a></div>
            <?php } ?>
         </div>  
      </div>
   <?php } ?> 

   <?php if($skin == 'skin-v3'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
        <?php if (!empty($settings['image']['url'])) : ?>
          <div class="image">
            <?php
              $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
              echo $image_html;
            ?>
          </div>
        <?php endif; ?>  
        <div class="content-inner">
          <?php if($title_text){ ?>
             <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                <?php echo $title_html; ?>
             </<?php echo esc_attr($header_tag) ?>>
          <?php } ?>
          <?php if($description_text){ ?>
            <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
          <?php } ?>
        </div>  
      </div>
<?php } ?> 