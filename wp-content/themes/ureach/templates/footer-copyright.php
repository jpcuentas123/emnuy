<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.10
 */

// Copyright area
$ureach_footer_scheme =  ureach_is_inherit(ureach_get_theme_option('footer_scheme')) ? ureach_get_theme_option('color_scheme') : ureach_get_theme_option('footer_scheme');
$ureach_copyright_scheme = ureach_is_inherit(ureach_get_theme_option('copyright_scheme')) ? $ureach_footer_scheme : ureach_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($ureach_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$ureach_copyright = ureach_prepare_macros(ureach_get_theme_option('copyright'));
				if (!empty($ureach_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $ureach_copyright, $ureach_matches)) {
						$ureach_copyright = str_replace($ureach_matches[1], date(str_replace(array('{', '}'), '', $ureach_matches[1])), $ureach_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($ureach_copyright));
				}
			?></div>
		</div>
	</div>
</div>
