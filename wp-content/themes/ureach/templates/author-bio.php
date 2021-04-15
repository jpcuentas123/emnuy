<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage UREACH
 * @since UREACH 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$ureach_mult = ureach_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120*$ureach_mult ); 
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<span><?php echo esc_html__( 'About Author', 'ureach' ); ?></span>
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__(' %s', 'ureach'), '<span class="fn">'.get_the_author().'</span>')); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses(wpautop(get_the_author_meta( 'description' )), 'ureach_kses_content'); ?>

			<?php do_action('ureach_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
