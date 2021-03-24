<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

// Header sidebar
$ureach_header_name = ureach_get_theme_option('header_widgets');
$ureach_header_present = !ureach_is_off($ureach_header_name) && is_active_sidebar($ureach_header_name);
if ($ureach_header_present) { 
	ureach_storage_set('current_sidebar', 'header');
	$ureach_header_wide = ureach_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($ureach_header_name) ) {
		dynamic_sidebar($ureach_header_name);
	}
	$ureach_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($ureach_widgets_output)) {
		$ureach_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $ureach_widgets_output);
		$ureach_need_columns = strpos($ureach_widgets_output, 'columns_wrap')===false;
		if ($ureach_need_columns) {
			$ureach_columns = max(0, (int) ureach_get_theme_option('header_columns'));
			if ($ureach_columns == 0) $ureach_columns = min(6, max(1, substr_count($ureach_widgets_output, '<aside ')));
			if ($ureach_columns > 1)
				$ureach_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($ureach_columns).' widget ', $ureach_widgets_output);
			else
				$ureach_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($ureach_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$ureach_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($ureach_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'ureach_action_before_sidebar' );
				ureach_show_layout($ureach_widgets_output);
				do_action( 'ureach_action_after_sidebar' );
				if ($ureach_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$ureach_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>