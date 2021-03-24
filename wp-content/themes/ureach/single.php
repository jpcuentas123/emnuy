<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Previous/next post navigation.
	?><?php

	// Related posts
	$ureach_related_posts = (int) ureach_get_theme_option('related_posts');
	if ($ureach_related_posts > 0) {
		ureach_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, ureach_get_theme_option('related_posts'))),
										'columns' => max(1, min(4, ureach_get_theme_option('related_columns')))
										),
									ureach_get_theme_option('related_style')
									);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>