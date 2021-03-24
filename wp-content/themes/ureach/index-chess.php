<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

ureach_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$ureach_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$ureach_sticky_out = ureach_get_theme_option('sticky_style')=='columns' 
							&& is_array($ureach_stickies) && count($ureach_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($ureach_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$ureach_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($ureach_sticky_out && !is_sticky()) {
			$ureach_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $ureach_sticky_out && is_sticky() ? 'sticky' :'chess' );
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