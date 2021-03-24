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
?>
<?php get_header(); ?>
<div id="content">
	<div class="page-wrapper">
	
		<div class="not-found-wrapper text-center">
			<div class="not-found-title"><h1><span><?php echo esc_html__('404', 'vizeon') ?></span></h1></div>
			<div class="not-found-subtitle"><?php echo esc_html__('PAGE NOT FOUND', 'vizeon') ?></div>
			<div class="not-found-desc"><?php echo esc_html__('The page requested couldn\'t be found. This could be a spelling error in the URL or a removed page.','vizeon' )?></div> 

			<div class="not-found-home text-center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="gv-icon-200"></i><?php echo esc_html__('Back Homepage', 'vizeon') ?></a>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>