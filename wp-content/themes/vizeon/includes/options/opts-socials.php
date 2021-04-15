<?php
Redux::setSection( $opt_name, array(
   'title'     => esc_html__( 'Social Profiles', 'vizeon' ),
   'icon'      => 'el-icon-share',
   'fields' => array(
      array(
         'id'     => 'social_facebook',
         'type'      => 'text',
         'title'  => esc_html__( 'Facebook', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Facebook profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_instagram',
         'type'      => 'text',
         'title'     => esc_html__( 'Instagram', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Instagram profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_twitter',
         'type'      => 'text',
         'title'     => esc_html__( 'Twitter', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Twitter profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_googleplus',
         'type'      => 'text',
         'title'     => esc_html__( 'Google+', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Google+ profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_linkedin',
         'type'      => 'text',
         'title'     => esc_html__( 'LinedIn', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your LinkedIn profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_pinterest',
         'type'      => 'text',
         'title'     => esc_html__( 'Pinterest', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Pinterest profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_rss',
         'type'      => 'text',
         'title'     => esc_html__( 'RSS', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your RSS feed URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_tumblr',
         'type'      => 'text',
         'title'     => esc_html__( 'Tumblr', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Tumblr profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_vimeo',
         'type'      => 'text',
         'title'     => esc_html__( 'Vimeo', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your Vimeo profile URL.', 'vizeon' ),
         'default'   => ''
      ),
      array(
         'id'     => 'social_youtube',
         'type'      => 'text',
         'title'     => esc_html__( 'YouTube', 'vizeon' ),
         'desc'      => esc_html__( 'Enter your YouTube profile URL.', 'vizeon' ),
         'default'   => ''
      )
   )
));