<?php
/**
 * The template to display the Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;



// Callback for output single comment layout
if (!function_exists('ureach_output_single_comment')) {
	function ureach_output_single_comment( $comment, $args, $depth ) {
		switch ( $comment->comment_type ) {
			case 'pingback' :
				?>
				<li class="trackback"><?php esc_html_e( 'Trackback:', 'ureach' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'ureach' ), '<span class="edit-link">', '<span>' ); ?>
				<?php
				break;
			case 'trackback' :
				?>
				<li class="pingback"><?php esc_html_e( 'Pingback:', 'ureach' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'ureach' ), '<span class="edit-link">', '<span>' ); ?>
				<?php
				break;
			default :
				$author_id = $comment->user_id;
				$author_link = get_author_posts_url( $author_id );
				$mult = ureach_get_retina_multiplier();
				?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment_item'); ?>>
					<div id="comment_body-<?php comment_ID(); ?>" class="comment_body">
						<div class="comment_author_avatar"><?php echo get_avatar( $comment, 90*$mult ); ?></div>
						<div class="comment_content">
							<div class="comment_info">
								<h6 class="comment_author"><?php echo (!empty($author_id) ? '<a href="'.esc_url($author_link).'">' : '') . comment_author() . (!empty($author_id) ? '</a>' : ''); ?></h6>
								<div class="comment_posted">
									<span class="comment_posted_label"><?php esc_html_e('Posted', 'ureach'); ?></span>
									<span class="comment_date"><?php
										echo ureach_get_date(get_comment_date('U'));
									?></span>
									<span class="comment_time"><?php
										echo get_comment_date(get_option('time_format'));
									?></span>
									<?php if ( $comment->comment_approved == 1 ) { ?>
									<span class="comment_counters"><?php ureach_show_comment_counters(); ?></span>
									<?php } ?>
								</div>
							</div>
							<div class="comment_text_wrap">
								<?php if ( $comment->comment_approved == 0 ) { ?>
								<div class="comment_not_approved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ureach' ); ?></div>
								<?php } ?>
								<div class="comment_text"><?php comment_text(); ?></div>
							</div>
							<?php
							if ($depth < $args['max_depth']) {
								?><div class="reply comment_reply"><?php 
									comment_reply_link( array_merge( $args, array(
																				'add_below' => 'comment_body',
																				'depth' => $depth, 
																				'max_depth' => $args['max_depth']
																				)
																	)
														);
								?></div><?php
							}
							?>
						</div>
					</div>
				<?php
				break;
		}
	}
}


// Return template for the single field in the comments
if (!function_exists('ureach_single_comments_field')) {
	function ureach_single_comments_field($args) {
		$path_height = $args['form_style'] == 'path' 
							? ($args['field_type'] == 'text' ? 75 : 190)
							: 0;
		return '<div class="comments_field comments_'.esc_attr($args['field_name']).'">'
					. ($args['form_style'] == 'default' 
						? '<label for="comment" class="'.esc_attr($args['field_req'] ? 'required' : 'optional') . '">' . esc_html($args['field_title']) . '</label>'
						: ''
						)
					. '<span class="sc_form_field_wrap">'
						. ($args['field_type']=='text'
							? '<input id="'.esc_attr($args['field_name']).'" name="'.esc_attr($args['field_name']).'" type="text"' . ($args['form_style']=='default' ? ' placeholder="'.esc_attr($args['field_placeholder']) . ($args['field_req'] ? ' *' : '') . '"' : '') . ' value="' . esc_attr($args['field_value']) . '"' . ( $args['field_req'] ? ' aria-required="true"' : '' ) . ' />'
							: '<textarea id="'.esc_attr($args['field_name']).'" name="'.esc_attr($args['field_name']).'"' . ($args['form_style']=='default' ? ' placeholder="'.esc_attr($args['field_placeholder']) . ($args['field_req'] ? ' *' : '') . '"' : '') . ( $args['field_req'] ? ' aria-required="true"' : '' ) . '></textarea>'
							)
						. ($args['form_style']!='default'
							? '<span class="sc_form_field_hover">'
									. ($args['form_style'] == 'path'
										? '<svg class="sc_form_field_graphic" preserveAspectRatio="none" viewBox="0 0 520 ' . intval($path_height) . '" height="100%" width="100%"><path d="m0,0l520,0l0,'.intval($path_height).'l-520,0l0,-'.intval($path_height).'z"></svg>'
										: ''
										)
									. ($args['form_style'] == 'iconed'
										? '<i class="sc_form_field_icon '.esc_attr($args['field_icon']).'"></i>'
										: ''
										)
									. '<span class="sc_form_field_content" data-content="'.esc_attr($args['field_title']).'">'.esc_html($args['field_title']).'</span>'
								. '</span>'
							: ''
							)
					. '</span>'
				. '</div>';
	}
}


// Output comments list
if ( have_comments() || comments_open() ) {
	?>
	<section class="comments_wrap">
	<?php
	if ( have_comments() ) {
	?>
		<div id="comments" class="comments_list_wrap">
			<h5 class="section_title comments_list_title"><span class="hide"><?php $ureach_post_comments = get_comments_number(); echo esc_html($ureach_post_comments); ?></span> <?php echo (1==$ureach_post_comments ? esc_html__('Comment', 'ureach') : esc_html__('Comments', 'ureach')); ?></h5>
			<ul class="comments_list">
				<?php
				wp_list_comments( array('callback'=>'ureach_output_single_comment') );
				?>
			</ul><!-- .comments_list -->
			<?php if ( !comments_open() && get_comments_number()!=0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
				<p class="comments_closed"><?php esc_html_e( 'Comments are closed.', 'ureach' ); ?></p>
			<?php }	?>
			<div class="comments_pagination"><?php paginate_comments_links(); ?></div>
		</div><!-- .comments_list_wrap -->
	<?php 
	}

	if ( comments_open() ) {
		?>
		<div class="comments_form_wrap">
			<div class="comments_form">
				<?php
				$ureach_form_style = esc_attr(ureach_get_theme_option('input_hover'));
				if (empty($ureach_form_style) || ureach_is_inherit($ureach_form_style)) $ureach_form_style = 'default';
				$ureach_commenter = wp_get_current_commenter();
				$ureach_req = get_option( 'require_name_email' );
				$ureach_comments_args = apply_filters( 'ureach_filter_comment_form_args', array(
						// class of the 'form' tag
						'class_form' => 'comment-form ' . ($ureach_form_style != 'default' ? 'sc_input_hover_' . esc_attr($ureach_form_style) : ''),
						// change the id of send button 
						'id_submit' => 'send_comment',
						// change the title of send button 
						'label_submit' => esc_html__('Add Your Comment', 'ureach'),
						// change the title of the reply section
						'title_reply' => esc_html__('Add Your Comment', 'ureach'),
						'title_reply_before' => '<h5 class="section_title comments_form_title">',
						'title_reply_after' => '</h5>',
						// remove "Logged in as"
						'logged_in_as' => '',
						// remove text before textarea
						'comment_notes_before' => '',
						// remove text after textarea
						'comment_notes_after' => '',
						'fields' => array(
							'author' => ureach_single_comments_field(array(
												'form_style' => $ureach_form_style,
												'field_type' => 'text',
												'field_req' => $ureach_req,
												'field_icon' => 'icon-user',
												'field_value' => isset($ureach_commenter['comment_author']) ? $ureach_commenter['comment_author'] : '',
												'field_name' => 'author',
												'field_title' => esc_attr__('Name', 'ureach'),
												'field_placeholder' => esc_attr__( 'Your Name', 'ureach' )
											)),
							'email' => ureach_single_comments_field(array(
												'form_style' => $ureach_form_style,
												'field_type' => 'text',
												'field_req' => $ureach_req,
												'field_icon' => 'icon-mail',
												'field_value' => isset($ureach_commenter['comment_author_email']) ? $ureach_commenter['comment_author_email'] : '',
												'field_name' => 'email',
												'field_title' => esc_attr__('E-mail', 'ureach'),
												'field_placeholder' => esc_attr__( 'Your E-mail', 'ureach' )
											))
						),
						// redefine your own textarea (the comment body)
						'comment_field' => ureach_single_comments_field(array(
												'form_style' => $ureach_form_style,
												'field_type' => 'textarea',
												'field_req' => true,
												'field_icon' => 'icon-feather',
												'field_value' => '',
												'field_name' => 'comment',
												'field_title' => esc_attr__('Comment', 'ureach'),
												'field_placeholder' => esc_attr__( 'Your comment', 'ureach' )
											)),
				));
			
				comment_form($ureach_comments_args);
				?>
			</div>
		</div><!-- /.comments_form_wrap -->
		<?php 
	}
	?>
	</section><!-- /.comments_wrap -->
<?php 
}
?>