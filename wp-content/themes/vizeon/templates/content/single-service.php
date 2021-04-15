<?php 
   $images = get_post_meta( get_the_ID(), 'vizeon_gallery_images' , false );
   $show_gallery = get_post_meta( get_the_ID(), 'vizeon_show_service_gallery' , false );
?>
<div class="service-block-single margin-bottom-60">
  <?php if($show_gallery){ ?>
    <div class="service-images">
      <div class="service-thumbnail">
        <?php $gallery = get_post_meta(get_the_ID(), 'vizeon_gallery_images', false ); ?>
        <?php if(count($gallery)){ ?>
          <div class="init-carousel-owl-theme owl-carousel" data-items="1" data-items_lg="1" data-items_md="1" data-items_sm="1" data-items_xs="1" data-loop="1" data-speed="1000" data-auto_play="1" data-auto_play_speed="1000" data-auto_play_timeout="3000" data-auto_play_hover="1" data-navigation="1" data-rewind_nav="1" data-pagination="0" data-mouse_drag="1" data-touch_drag="1">
            <?php foreach ($gallery as $image) { 
              $img = wp_get_attachment_image_src($image, 'full');
            ?>
            <div class="item"><img src="<?php echo esc_url($img[0]) ?>" alt="<?php the_title_attribute() ?>" /></div>
            <?php } ?>
          </div>
        <?php }else{ ?>  
          <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
        <?php } ?>
      </div>
    </div>
  <?php } ?>  

  <div class="service-content margin-top-20">
    <div class="content-inner"><?php the_content() ?></div>
  </div> 
</div>