<?php global $product; $time_sale = get_post_meta( $product->get_id(), '_sale_price_dates_to', true ); ?>
<div class="item-product-deals clearfix">
    <div class="product-block">
        <div class="product-block-inner">
             <figure class="product-thumbnail image text-center">
                 <?php echo trim($product->get_image('shop_catalog')); ?>
                 <div class="shop-loop-actions ">   
                    <?php
                        if( class_exists( 'YITH_WCWL' ) ) {
                            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                        }
                    ?>   
            
                    <?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
                        <?php
                            $action_add = 'yith-woocompare-add-product';
                            $url_args = array(
                                'action' => $action_add,
                                'id' => $product->get_id()
                            );
                        ?>

                        <div class="yith-compare">
                            <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>"  class="compare" data-product_id="<?php echo esc_attr($product->get_id()); ?>"></a>
                        </div>

                    <?php } ?>
                    <div class="quickview">
                       <a href="javascript:void(0);" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>" class="btn-quickview product_type_<?php echo esc_attr( $product->get_type() ) ?>"></a>
                       </div>
                 </div>
             </figure>

            <div class="caption">
                <div class="time">
                    <div class="gva-countdown clearfix" data-countdown="countdown"
                          data-date="<?php echo date('m',$time_sale).'-'.date('d',$time_sale).'-'.date('Y',$time_sale).'-'. date('H',$time_sale) . '-' . date('i',$time_sale) . '-' .  date('s',$time_sale) ; ?>">
                    </div>
                </div>
                <div class="deals-information">
                    
                    <div class="rating clearfix">
                        <?php if ( $rating_html = $product->get_rating_html() ) { ?>
                            <div><?php echo wp_kses($rating_html, true); ?></div>
                        <?php }else{ ?>
                            <div class="star-rating"></div>
                        <?php } ?>
                    </div>

                    <h3 class="shop-loop-title clearfix">
                        <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo esc_attr( $product->get_title() ); ?></a>
                    </h3>

                    <?php if($show_desc == 'on'){ ?>
                        <div class="shop-loop-description">
                          <?php echo vizeon_limit_words( 15, get_the_excerpt(), get_the_content() ) ?>
                        </div>
                    <?php } ?>      

                    <div class="add-to-cart">
                       <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div> 
                    <div class="shop-loop-price clearfix">
                        <div class="price"><?php echo wp_kses($product->get_price_html(), true); ?></div>
                    </div>  
                </div>
            </div>    
        </div>     
    </div>
</div>
