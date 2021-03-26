<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.10
 */

// Logo
if (ureach_is_on(ureach_get_theme_option('logo_in_footer'))) {
	$ureach_logo_image = '';
	if (ureach_get_retina_multiplier(2) > 1)
		$ureach_logo_image = ureach_get_theme_option( 'logo_footer_retina' );
	if (empty($ureach_logo_image)) 
		$ureach_logo_image = ureach_get_theme_option( 'logo_footer' );
	$ureach_logo_text   = get_bloginfo( 'name' );
	if (!empty($ureach_logo_image) || !empty($ureach_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($ureach_logo_image)) {
					$ureach_attr = ureach_getimagesize($ureach_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($ureach_logo_image).'" class="logo_footer_image" alt="'. esc_attr__('Logo', 'ureach') .'"'.(!empty($ureach_attr[3]) ? sprintf(' %s', $ureach_attr[3]) : '').'></a>' ;
				} else if (!empty($ureach_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($ureach_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>