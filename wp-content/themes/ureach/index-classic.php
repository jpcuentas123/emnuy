<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

ureach_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(ureach_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'classie', ureach_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'ureach-gallery-script', ureach_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$ureach_classes = 'posts_container '
						. (substr(ureach_get_theme_option('blog_style'), 0, 7) == 'classic' ? 'columns_wrap' : 'masonry_wrap');
	$ureach_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$ureach_sticky_out = ureach_get_theme_option('sticky_style')=='columns' 
							&& is_array($ureach_stickies) && count($ureach_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($ureach_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$ureach_sticky_out) {
		if (ureach_get_theme_option('first_post_large') && !is_paged() && !in_array(ureach_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($ureach_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($ureach_sticky_out && !is_sticky()) {
			$ureach_sticky_out = false;
			?></div><div class="<?php echo esc_attr($ureach_classes); ?>"><?php
		}
		get_template_part( 'content', $ureach_sticky_out && is_sticky() ? 'sticky' : 'classic' );
	}
	
	?></div><?php

	ureach_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>