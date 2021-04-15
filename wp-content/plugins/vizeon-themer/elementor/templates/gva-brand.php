<?php
   if (!defined('ABSPATH')) {
      exit; // Exit if accessed directly.
   }

   use Elementor\Group_Control_Image_Size;

   $this->add_render_attribute('wrapper', 'class', ['gva-brand-carousel' ]);
   $this->add_render_attribute('carousel', 'class', ['init-carousel-owl owl-carousel']);
?>

   <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
      <div <?php echo $this->get_render_attribute_string('carousel') ?> <?php echo $this->get_carousel_settings() ?>>
         <?php
         foreach ($settings['brands'] as $brand): ?>
            <div class="item brand-item">

               <div class="brand-item-content">
                  <?php
                     $image_html = Group_Control_Image_Size::get_attachment_image_html($brand, 'image');
                     echo $image_html;
                  ?>
               </div>
              
            </div>
         <?php endforeach; ?>
      </div>
   </div>
