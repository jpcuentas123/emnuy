<?php 
   $images = get_post_meta( get_the_ID(), 'vizeon_gallery_images' , false );
   $extra_link = get_post_meta(get_the_ID(), 'vizeon_service_extra_link', true);
   $service_link = get_the_permalink();
   if(!empty($extra_link)){
      $service_link = $extra_link;
   }
   if(!isset($excerpt_words)){
      $excerpt_words = 20;
   }
   $thumbnail = 'post-thumbnail';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }
?>
<div class="item">
   <div class="service-block service-item-v1">      
      <div class="service-images lightGallery">
         <?php if($images && is_array($images) && count($images) > 0){
            $i = 0;
            foreach($images as $image): 
               $i++; $image_full_src = false; $image_thumb_src = false;
               if($image_full_src = wp_get_attachment_image_src($image, 'full')) $image_full_src = $image_full_src['0'];
               if($image_thumb_src = wp_get_attachment_image_src($image, 'thumbnail')) $image_thumb_src = $image_thumb_src['0']; 
               if($i==1){ ?>
                  <div class="image-item">
                     <a href="<?php echo esc_url($image_full_src) ?>" class="zoomGallery" data-rel="lightGallery">
                        <span class="icon-expand"><i class="fa fa-expand"></i></span>
                        <img src="<?php echo esc_url($image_thumb_src) ?>"  class="hidden" alt="<?php the_title_attribute() ?>" />
                     </a>
                     <?php echo wp_get_attachment_image( $image, $thumbnail ); ?>
                  </div>
               <?php }else{ ?>
                  <div class="image-item">
                     <a href="<?php echo esc_url($image_full_src) ?>" class="zoomGallery hidden" data-rel="lightGallery">
                        <img src="<?php echo esc_url($image_thumb_src) ?>" alt="<?php the_title_attribute() ?>" class="hidden" />
                     </a>
                  </div>
               <?php }
            endforeach;
         }?>
      </div>   
      <div class="service-content">
         <div class="content-inner">
            <h3 class="title">
               <a href="<?php echo esc_url($service_link) ?>"><?php the_title(); ?></a>
            </h3>
            <div class="desc"><?php echo vizeon_limit_words($excerpt_words, get_the_excerpt(), get_the_content()); ?></div> 
            <div class="readmore">
               <a href="<?php echo esc_url($service_link) ?>"><?php echo esc_html__('Read More', 'vizeon'); ?></a>
            </div>
         </div>    
      </div>
   </div>
</div>