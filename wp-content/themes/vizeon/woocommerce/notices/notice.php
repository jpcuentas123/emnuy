<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert_info">
		<div class="alert_icon"><i class="icon icon-help"></i></div>
		<div class="alert_wrapper"><?php echo wc_kses_notice( $message ); ?></div>
		<a class="close" href="#"><i class="icon icon-cancel"></i></a>
	</div>
<?php endforeach; ?>

