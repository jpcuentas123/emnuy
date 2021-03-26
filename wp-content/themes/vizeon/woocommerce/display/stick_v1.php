<?php 
   global $woocommerce_loop; 
   $woocommerce_loop['columns'] = $columns_count;
?>
<?php $i = 0; $_count = 1; $_total = $loop->post_count; ?>
<div class="products grid-view">
   <div class="row">
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; $i++; ?>
         
         <?php 

         if($i == 1){ 
            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
               wc_get_template_part( 'content', 'product-big' );
            echo '</div>';

         }else{

            if($i==2){ ?>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="<?php echo esc_attr($class_column) ?>">
            <?php }

               wc_get_template_part( 'content', 'product' );
         }
         ?>
      <?php endwhile; ?>
            </div>
         </div>   
   </div>
</div>
