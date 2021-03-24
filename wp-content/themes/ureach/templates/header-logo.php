<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

$ureach_args = get_query_var('ureach_logo_args');

// Site logo
$ureach_logo_image  = ureach_get_logo_image(isset($ureach_args['type']) ? $ureach_args['type'] : '');
$ureach_logo_text   = ureach_is_on(ureach_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$ureach_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($ureach_logo_image) || !empty($ureach_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url(home_url('/')); ?>"><?php
		if (!empty($ureach_logo_image)) {
			$ureach_attr = ureach_getimagesize($ureach_logo_image);
			echo '<img src="'.esc_url($ureach_logo_image).'" alt="' . esc_attr__('Logo', 'ureach') . '"'.(!empty($ureach_attr[3]) ? sprintf(' %s', $ureach_attr[3]) : '').'>' ;
		} else {
			ureach_show_layout(ureach_prepare_macros($ureach_logo_text), '<span class="logo_text">', '</span>');
			ureach_show_layout(ureach_prepare_macros($ureach_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>