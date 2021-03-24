<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

if ( get_query_var('ureach_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	$ureach_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($ureach_src[0])) {
		ureach_sc_layouts_showed('featured', true);
		?><div class="sc_layouts_featured with_image <?php echo esc_attr(ureach_add_inline_css_class('background-image:url('.esc_url($ureach_src[0]).');')); ?>"></div><?php
	}
}
?>