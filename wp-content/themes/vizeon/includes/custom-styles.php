<?php
/* Save custom theme styles */
if ( ! function_exists( 'vizeon_custom_styles_save' ) ) :
function vizeon_custom_styles_save() {

	$main_font = false;
	$main_font_enabled = ( vizeon_get_option('main_font_source', 0) == 0 ) ? false : true;
	if ( $main_font_enabled ) {
		$font_main = vizeon_get_option('main_font', '');
		if(isset($font_main['font-family']) && $font_main['font-family']){
			$main_font = $font_main['font-family'];
		}
	}

	$secondary_font = false;
	$secondary_font_enabled = ( vizeon_get_option('secondary_font_source', 0) == 0 ) ? false : true;
	if ( $secondary_font_enabled ) {
		$font_second = vizeon_get_option('secondary_font', '');
		if(isset($font_second['font-family']) && $font_second['font-family']){
			$secondary_font = $font_second['font-family'];
		}
	}

	ob_start();
?>


/* Typography */
<?php if ( $main_font_enabled && isset($main_font) && $main_font ) : ?>
body, .btn-theme, .btn-theme-second, .btn, .btn-white, .btn-black, .btn-give-theme, button.give-btn, input[type*="submit"]:not(.fa), 
.megamenu-main .widget .widget-title, .megamenu-main .widget .widgettitle, .gva-vertical-menu ul.navbar-nav li a
{
	font-family:<?php echo esc_attr( $main_font ); ?>,sans-serif;
}
<?php endif; ?>

<?php if ( $secondary_font_enabled && isset($secondary_font) && $secondary_font ) : ?>
h1, h2, h3, h4, h5, h6,.h1, .h2, .h3, .h4, .h5, .h6,
#wp-calendar caption, .gsc-call-to-action .title, .gsc-icon-box .highlight_content .title, .milestone-block.style-1 .box-content .milestone-content .milestone-number-inner,
.milestone-block.style-2 .box-content .milestone-content .milestone-number-inner, .gsc-icon-box-styles.style-1 .content-inner .title, .gsc-icon-box-styles.style-2 .content-inner .title,
.gsc-icon-box-styles.style-3 .content-inner .title, .gva-posts-grid .posts-grid-filter ul.nav-tabs > li > a, .gva-testimonial-carousel.style-1 .icon-quote, .gva-testimonial-carousel.style-1 .testimonial-item .testimonial-content,
.testimonial-node-1 .testimonial-content .quote, .testimonial-node-1 .testimonial-content .info .right .title, .gsc-pricing .content-inner .plan-price .price-value, .widget_recent_comments ul li, .widget_rss ul > li a, .widget_recent_entries ul > li a,
.widget_pages ul > li > a, .single.single-post #wp-content > article.post .content-top.entry-meta, .post-navigation a, .event-block .event-image .event-date .day, .event-block .event-content .event-info .title, .event-single .meta-block .block-title, 
.portfolio-v1 .content-inner .title a, .single-portfolio .portfolio-content .portfolio-information ul li .label, .give-block-2 .give-block-content .give-content .give__meta-top .raised, .give-block-2 .give-block-content .give-content .give__meta-top .percentage,
.gives-form-carousel-2 .tab-carousel-nav .link-service, .gives-form-carousel-2 .tab-carousel-nav .link-service .cat-links a, .content-single-give-form #give_purchase_form_wrap legend, .content-single-give-form #give-payment-mode-select legend, .team-block.team-v1 .team-name,
.team-block.team-v2 .team-content .team-name, #comments .nav-links .nav-previous a, #comments .nav-links .nav-next a, #comments ol.comment-list .vcard .fn
{
	font-family:<?php echo esc_attr( $secondary_font ); ?>,sans-serif;
}
<?php endif; ?>

/* ----- Main Color ----- */
<?php if($style = vizeon_get_option('main_color', '')){ ?>
	body{
		color:<?php echo esc_attr($style) ?>;
	}
<?php } ?>

/* ----- Background body ----- */
<?php 
	$main_background = vizeon_get_option('main_background_image', '');
	if(isset($main_background['url']) && $main_background['url']){
?>
body{
	<?php if ( strlen( $main_background['url'] ) > 0 ) : ?>
	background-image:url("<?php echo esc_url( $main_background['url'] ); ?>");
	<?php if ( vizeon_get_option('main_background_image_type', '') == 'fixed' ) : ?>
	background-attachment:fixed;
	background-size:cover;
	<?php else : ?>
	background-repeat:repeat;
	background-position:0 0;
	<?php endif; endif; ?>
	background-color:<?php echo esc_attr( vizeon_get_option('main_background_color', '') ); ?>;
}
<?php } ?>

/* ----- Main content ----- */
<?php if(vizeon_get_option('content_background_color', '')){ ?>
div.page {
	background: <?php echo esc_attr( vizeon_get_option('content_background_color', '') ); ?>!important;
}
<?php } ?>

<?php if(vizeon_get_option('content_font_color', '')){ ?>
div.page {
	color: <?php echo esc_attr( vizeon_get_option('content_font_color', '') ); ?>;
}
<?php } ?>

<?php if(vizeon_get_option('content_font_color_link', '')){ ?>
div.page a{
	color: <?php echo esc_attr( vizeon_get_option('content_font_color_link', '') ); ?>;
}
<?php } ?>

<?php if(vizeon_get_option('content_font_color_link_hover', '')){ ?>
div.page a:hover, div.page a:active, div.page a:focus {
	background: <?php echo esc_attr( vizeon_get_option('content_font_color_link_hover', '') ); ?>!important;
}
<?php } ?>

/* ----- Footer content ----- */
<?php if(vizeon_get_option('footer_background_color', '')){ ?>
#wp-footer {
	background: <?php echo esc_attr( vizeon_get_option('footer_background_color', '') ); ?>!important;
}
<?php } ?>

<?php if(vizeon_get_option('footer_font_color', '')){ ?>
#wp-footer {
	color: <?php echo esc_attr( vizeon_get_option('footer_font_color', '') ); ?>;
}
<?php } ?>

<?php if(vizeon_get_option('footer_font_color_link', '')){ ?>
#wp-footer a{
	color: <?php echo esc_attr( vizeon_get_option('footer_font_color_link', '') ); ?>;
}
<?php } ?>

<?php if(vizeon_get_option('footer_font_color_link_hover', '')){ ?>
#wp-footer a:hover, #wp-footer a:active, #wp-footer a:focus {
	background: <?php echo esc_attr( vizeon_get_option('footer_font_color_link_hover', '') ); ?>!important;
}
<?php } ?>

/* ----- Breacrumb Style ----- */

<?php
	$styles = ob_get_clean();
	
    $styles = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles );
	
	$styles = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '   ', '    ' ), '', $styles );
		
	update_option( 'vizeon_theme_custom_styles', $styles, true );
}
endif;

add_action( 'redux/options/vizeon_theme_options/saved', 'vizeon_custom_styles_save' );


/* Make sure custom theme styles are saved */
function vizeon_custom_styles_install() {
	if ( ! get_option( 'vizeon_theme_custom_styles' ) && get_option( 'vizeon_theme_options' ) ) {
		vizeon_custom_styles_save();
	}
}

add_action( 'redux/options/vizeon_theme_options/register', 'vizeon_custom_styles_install' );
