<?php
$sidebars_count = 0;
for( $i = 1; $i <= 4; $i++ ){
   if ( is_active_sidebar( 'footer-sidebar-'. $i ) ) $sidebars_count++;
}

if( $sidebars_count > 0 ){
   echo '<div class="widgets_wrapper">';
      echo '<div class="container">';
      
         $sidebar_class = '';
         switch( $sidebars_count ){
            case 2: $sidebar_class = 'footer-second col-lg-6 col-md-6 col-md-6 col-xs-12'; break;
            case 3: $sidebar_class = 'footer-third col-lg-4 col-md-4 col-md-1 col-xs-12'; break;
            case 4: $sidebar_class = 'footer-fourth col-lg-3 col-md-3 col-md-6 col-xs-12'; break;
            default: $sidebar_class = 'footer-one col-xs-12';break;
         }
         
         for( $i = 1; $i <= 4; $i++ ){
            if ( is_active_sidebar( 'footer-sidebar-'. $i ) ){
               echo '<div class="'. $sidebar_class .' column">';
                  dynamic_sidebar( 'footer-sidebar-'. $i );
               echo '</div>';
            }
         }
      
      echo '</div>';
   echo '</div>';
}