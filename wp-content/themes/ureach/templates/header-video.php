<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0.14
 */
$ureach_header_video = ureach_get_header_video();
$ureach_embed_video = '';
if (!empty($ureach_header_video) && !ureach_is_from_uploads($ureach_header_video)) {
	if (ureach_is_youtube_url($ureach_header_video) && preg_match('/[=\/]([^=\/]*)$/', $ureach_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$ureach_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($ureach_header_video) . '[/embed]' ));
			$ureach_embed_video = ureach_make_video_autoplay($ureach_embed_video);
		} else {
			$ureach_header_video = str_replace('/watch?v=', '/embed/', $ureach_header_video);
			$ureach_header_video = ureach_add_to_url($ureach_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$ureach_embed_video = '<iframe src="' . esc_url($ureach_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php ureach_show_layout($ureach_embed_video); ?></div><?php
	}
}
?>