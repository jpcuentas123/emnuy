<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.10
 */

// Footer menu
$ureach_menu_footer = ureach_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($ureach_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php ureach_show_layout($ureach_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>