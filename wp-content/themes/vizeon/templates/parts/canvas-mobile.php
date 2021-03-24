<div class="d-xl-none d-lg-none d-md-block d-sm-block d-xs-block">
   <div class="canvas-menu gva-offcanvas">
     <a class="dropdown-toggle" data-canvas=".mobile" href="#"><i class="gv-icon-103"></i></a>
   </div>
   <div class="gva-offcanvas-content mobile">
      <div class="close-canvas"><a><i class="gv-icon-8"></i></a></div>
      <div class="wp-sidebar sidebar">
         <?php do_action('vizeon_mobile_menu'); ?>
         <div class="after-offcanvas">
            <?php
               if(is_active_sidebar( 'offcanvas_sidebar_mobile' )){ 
                  dynamic_sidebar( 'offcanvas_sidebar_mobile' );
               }
            ?>
         </div>    
     </div>
   </div>
</div>