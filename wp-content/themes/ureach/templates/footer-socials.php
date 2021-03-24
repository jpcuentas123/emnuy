<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.10
 */


// Socials
if ( ureach_is_on(ureach_get_theme_option('socials_in_footer')) && ($ureach_output = ureach_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php ureach_show_layout($ureach_output); ?>
		</div>
	</div>
	<?php
}
?>