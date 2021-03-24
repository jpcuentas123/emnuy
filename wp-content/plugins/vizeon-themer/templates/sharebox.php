<?php
/**
 * $Desc
 *
 * @version    1.0
 * @package    basetheme
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2016 Gaviasthemess. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
global $post;
?>
<ul class="social-networks">
	<?php if((bool)kiamo_get_option('product_sharing_facebook',true)): ?>
	<li class="facebook">
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="Facebook" href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php the_permalink(); ?>&p&#91;title&#93;=<?php the_title(); ?>" target="_blank">
			<i class="gv-icon-1405"></i>
		</a>
	</li>
	<?php endif; ?>

	<?php if((bool)kiamo_get_option('product_sharing_twitter',true)): ?>
	<li class="twitter">
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="Twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank">
			<i class="gv-icon-1406"></i>
		</a>
	</li>
	<?php endif; ?>

	<?php if((bool)kiamo_get_option('product_sharing_linkedin',true)): ?>
	<li class="linkedin">
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="LinkedIn" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank">
			<i class="gv-icon-1408"></i>
		</a>
	</li>
	<?php endif; ?>

	<?php if((bool)kiamo_get_option('product_sharing_tumblr',true)): ?>
	<li class="tumblr">
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="Tumblr" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank">
			<i class="gv-icon-1417"></i>
		</a>
	</li>
	<?php endif; ?>

	<?php if((bool)kiamo_get_option('product_sharing_google',true)): ?>
	<li class="google">
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="Google +1" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank">
			<i class="gv-icon-1409"></i>
		</a>
	</li>
	<?php endif; ?>

	<?php if((bool)kiamo_get_option('product_sharing_pinterest',true)): ?>
	<li class="pinterest">
		<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>" target="_blank">
			<i class="gv-icon-1416"></i>
		</a>
	</li>
	<?php endif; ?>
	
	<?php if((bool)kiamo_get_option('product_sharing_email',true)): ?>
	<li class="email">
		<a data-toggle="tooltip" data-placement="left" data-animation="true"  data-original-title="Email" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>">
			<i class="gv-icon-1432"></i>
		</a>
	</li>
	<?php endif; ?>
</ul>