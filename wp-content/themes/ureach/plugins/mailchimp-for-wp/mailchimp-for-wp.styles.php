<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('ureach_mailchimp_get_css')) {
	add_filter('ureach_filter_get_css', 'ureach_mailchimp_get_css', 10, 4);
	function ureach_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = ureach_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['bg_color']};
	border-color: transparent;
	color: {$colors['text_dark']};
}
.mc4wp-form input[type="email"]:hover {
	border-color: {$colors['text_link']};
}
.mc4wp-form .mc4wp-alert {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
CSS;
		}

		return $css;
	}
}
?>