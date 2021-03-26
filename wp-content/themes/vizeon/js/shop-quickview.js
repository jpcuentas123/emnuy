(function($) {
   'use strict';

   $(document).ready(function(){
      var self = this,
      $qvContainer = $('#gva-quickview'),
      $qvOverlay = $('<div class="mfp-bg gva-mfp-fade-in"></div>'),
      productId;
      self.$html = $('html');
      self.$body = $('body');
      self.$body.on('click', '.btn-quickview', function(e) {
         e.preventDefault();
         productId = $(this).data('product_id');
         if (productId) {
            self.$html.css('width', 'auto');
            $qvOverlay.appendTo(self.$body);
            $qvOverlay.addClass('show mfp-ready gva-loader');
            
            var data = {
               product_id: productId, 
               action: 'vizeon_ajax_load_product'
            };

            //Run action ajax load quickview for product
            window.gva_quickview_get_product = $.ajax({
               type: 'POST',
               url: ajaxurl,
               data: data,
               dataType: 'html',
               cache: false,
               headers: {'cache-control': 'no-cache'},
               beforeSend: function() {
                  if (typeof window.gva_quickview_get_product === 'object') {
                     window.gva_quickview_get_product.abort();
                  }
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) {
                  console.log('GVA: AJAX error - _qvLoadProduct() - ' + errorThrown);
                  
                  self.$html.css('width', '');
                                          
                  $qvOverlay.removeClass('mfp-ready mfp-removing').remove();
               },
               success: function(data) {
                  $qvContainer.html(data);
                  
                  var $currentContainer = $qvContainer.children('#product-'+productId),
                     $productForm = $currentContainer.find('form.cart'),
                     $lastImg = $('#gva-quickview-images').find('img').last();
                  
                  $lastImg.one('load', function() { 
                     if ($currentContainer.hasClass('product-variable')) {

                        $productForm.wc_variation_form().find('.variations select:eq(0)').change();
                        
                        $productForm.find('select').selectOrDie(self.shopSelectConfig);
                        
                        self.shopToggleVariationDetails(); 
                        $productForm.on('found_variation', function() { 
                           self.shopToggleVariationDetails();
                        });
                        
                     }

                    //Quick view open popup magnific
                    $.magnificPopup.open({
                        mainClass: '',
                        closeMarkup: '<a class="gva-close"></a>',
                        removalDelay: 180,
                        items: {
                           src: $qvContainer,
                           type: 'inline'
                        },
                        callbacks: {
                           open: function() {
                              
                              // Init Slider for quickview product
                              $("#gva-quickview-images").owlCarousel({
                                 singleItem : true,
                                 loop: false,
                                 nav: true, 
                                 items: 1,
                                 autoplay: false,
                                 autoplayTimeout: 5000,
                                 autoplayHoverPause: true,
                                 navText: [ '<i class="gv-icon-158"></i>', '<i class="gv-icon-159"></i>' ],
                              });
                              
                              $qvOverlay.one('touchstart.qv', function() {
                                 $.magnificPopup.close();
                              });

                           },

                           beforeClose: function() {
                              $qvOverlay.addClass('mfp-removing');
                           },

                           close: function() {
                              self.$html.css('width', '');                  
                              $qvOverlay.removeClass('mfp-ready mfp-removing').remove(); 
                           }

                        }
                     });
                  });
               }
            });
         }
      });
   });
    
 
})(jQuery);
