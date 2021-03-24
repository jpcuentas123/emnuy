<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

						// Widgets area inside page content
						ureach_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					ureach_create_widgets_area('widgets_below_page');

					$ureach_body_style = ureach_get_theme_option('body_style');
					if ($ureach_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$ureach_footer_style = ureach_get_theme_option("footer_style");
			if (strpos($ureach_footer_style, 'footer-custom-')===0) $ureach_footer_style = 'footer-custom';
			get_template_part( "templates/{$ureach_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (ureach_is_on(ureach_get_theme_option('debug_mode')) && ureach_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(ureach_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>