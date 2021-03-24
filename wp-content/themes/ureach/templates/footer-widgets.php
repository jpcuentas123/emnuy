<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.10
 */

// Footer sidebar
$ureach_footer_name = ureach_get_theme_option('footer_widgets');
$ureach_footer_present = !ureach_is_off($ureach_footer_name) && is_active_sidebar($ureach_footer_name);
if ($ureach_footer_present) { 
	ureach_storage_set('current_sidebar', 'footer');
	$ureach_footer_wide = ureach_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($ureach_footer_name) ) {
		dynamic_sidebar($ureach_footer_name);
	}
	$ureach_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($ureach_out)) {
		$ureach_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $ureach_out);
		$ureach_need_columns = true;
		if ($ureach_need_columns) {
			$ureach_columns = max(0, (int) ureach_get_theme_option('footer_columns'));
			if ($ureach_columns == 0) $ureach_columns = min(4, max(1, substr_count($ureach_out, '<aside ')));
			if ($ureach_columns > 1)
				$ureach_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($ureach_columns).' widget ', $ureach_out);
			else
				$ureach_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($ureach_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$ureach_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($ureach_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'ureach_action_before_sidebar' );
				ureach_show_layout($ureach_out);
				do_action( 'ureach_action_after_sidebar' );
				if ($ureach_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$ureach_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>