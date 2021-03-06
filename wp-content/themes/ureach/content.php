<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type()) 
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												. ' itemscope'
												); ?>
		itemscope itemtype="//schema.org/<?php echo esc_attr(is_single() ? 'BlogPosting' : 'Article'); ?>">
	<?php
	// Structured data snippets
	if (ureach_is_on(ureach_get_theme_option('seo_snippets'))) {
		?>
		<div class="structured_data_snippets">
			<meta itemprop="headline" content="<?php the_title_attribute(); ?>">
			<meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
			<meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
			<meta itemscope itemprop="mainEntityOfPage" itemType="//schema.org/WebPage" itemid="<?php echo esc_url(get_the_permalink()); ?>" content="<?php the_title_attribute(); ?>"/>
			<div itemprop="publisher" itemscope itemtype="//schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="//schema.org/ImageObject">
					<?php 
					$ureach_logo_image = ureach_get_retina_multiplier(2) > 1 
										? ureach_get_theme_option( 'logo_retina' )
										: ureach_get_theme_option( 'logo' );
					if (!empty($ureach_logo_image)) {
						$ureach_attr = ureach_getimagesize($ureach_logo_image);
						?>
						<img itemprop="url" src="<?php echo esc_url($ureach_logo_image); ?>">
						<meta itemprop="width" content="<?php echo esc_attr($ureach_attr[0]); ?>">
						<meta itemprop="height" content="<?php echo esc_attr($ureach_attr[1]); ?>">
						<?php
					}
					?>
				</div>
				<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
				<meta itemprop="telephone" content="">
				<meta itemprop="address" content="">
			</div>
		</div>
		<?php
	}
	?><div class="single_post_cat"><?php

	do_action('ureach_action_before_post_meta');

	// Post meta
	$ureach_components = ureach_is_inherit(ureach_get_theme_option_from_meta('meta_parts'))
		? 'categories'
		: ureach_array_get_keys_by_value(ureach_get_theme_option('meta_parts'));
	$ureach_counters = ureach_is_inherit(ureach_get_theme_option_from_meta('counters'))
		? ''
		: ureach_array_get_keys_by_value(ureach_get_theme_option('counters'));

	if (!empty($ureach_components))
		ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
				'components' => $ureach_components,
				'counters' => $ureach_counters,
				'seo' => false
			), 'excerpt', 1)
		);
	?></div><?php

	// Featured image
	if ( !ureach_sc_layouts_showed('featured'))
		ureach_show_post_featured();

	// Title and post meta
	if ( (!ureach_sc_layouts_showed('title') || !ureach_sc_layouts_showed('postmeta')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if (!ureach_sc_layouts_showed('title')) {
				the_title( '<h4 class="post_title entry-title"'.(ureach_is_on(ureach_get_theme_option('seo_snippets')) ? ' itemprop="headline"' : '').'>', '</h4>' );
			}
			// Post meta
			if (!ureach_sc_layouts_showed('postmeta')) {
				ureach_show_post_meta(apply_filters('ureach_filter_post_meta_args', array(
					'components' => 'date,counters',
					'counters' => 'comments',
					'seo' => ureach_is_on(ureach_get_theme_option('seo_snippets'))
					), 'single', 1)
				);
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	?>
	<div class="post_content entry-content" itemprop="articleBody">
		<?php
			the_content( );

			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'ureach' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ureach' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			// Taxonomies and share
			if ( is_single() && !is_attachment() ) {
				?>
				<div class="post_meta post_meta_single"><?php

					// Share
					ureach_show_share_links(array(
						'type' => 'block',
						'caption' => 'share:',
						'before' => '<span class="post_meta_item post_share">',
						'after' => '</span>'
					));

					// Post taxonomies
					the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'ureach').'</span> ', ', ', '</span>' );


					?>
				</div>
				<?php
			}
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( ureach_get_theme_option('author_info')==1 && is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {
			get_template_part( 'templates/author-bio' );
		}
	?>
</article>
