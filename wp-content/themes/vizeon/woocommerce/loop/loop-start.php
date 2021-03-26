<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

global $woocommerce_loop; 
$columns = vizeon_get_option('product_display_columns', '4');

if(isset($_GET['xcol']) && $_GET['xcol']){
   $columns = $_GET['xcol'];
}
if($woocommerce_loop['columns'] == 2) $woocommerce_loop['columns'] = 3;
if ( ( isset( $woocommerce_loop['columns'] ) && $woocommerce_loop['columns'] != '' ) ) {
   $xcolumns = $woocommerce_loop['columns'];
} else {
   $xcolumns = ( isset( $_GET['col'] ) ) ? intval( $_GET['col'] ) : $columns;
}
$class_grid = vizeon_calc_class_grid($xcolumns);

?>
<div class="clearfix"></div>
<div class="products_wrapper grid-view">
	<div class="products <?php echo esc_attr($class_grid) ?>">