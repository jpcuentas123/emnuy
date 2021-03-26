<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.10
 */

$ureach_footer_scheme =  ureach_is_inherit(ureach_get_theme_option('footer_scheme')) ? ureach_get_theme_option('color_scheme') : ureach_get_theme_option('footer_scheme');
$ureach_footer_id = str_replace('footer-custom-', '', ureach_get_theme_option("footer_style"));
$ureach_footer_meta = get_post_meta($ureach_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($ureach_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($ureach_footer_id))); 
						if (!empty($ureach_footer_meta['margin']) != '') 
							echo ' '.esc_attr(ureach_add_inline_css_class('margin-top: '.esc_attr(ureach_prepare_css_value($ureach_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($ureach_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('ureach_action_show_layout', $ureach_footer_id);
	?>
</footer><!-- /.footer_wrap -->
