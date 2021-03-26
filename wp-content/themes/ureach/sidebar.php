<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_sidebar_position = ureach_get_theme_option('sidebar_position');
if (ureach_sidebar_present()) {
	ob_start();
	$ureach_sidebar_name = ureach_get_theme_option('sidebar_widgets');
	ureach_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($ureach_sidebar_name) ) {
		dynamic_sidebar($ureach_sidebar_name);
	}
	$ureach_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($ureach_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($ureach_sidebar_position); ?> widget_area<?php if (!ureach_is_inherit(ureach_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(ureach_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'ureach_action_before_sidebar' );
				ureach_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $ureach_out));
				do_action( 'ureach_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>