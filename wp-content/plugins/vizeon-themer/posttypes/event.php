<?php
  if(!function_exists('gavias_post_type_event')   ){
    function gavias_post_type_event(){
      $labels = array(
        'name' => __( 'Events', 'gaviasframework' ),
        'singular_name' => __( 'Events', 'gaviasframework' ),
        'add_new' => __( 'Add New Event', 'gaviasframework' ),
        'add_new_item' => __( 'Add New Event', 'gaviasframework' ),
        'edit_item' => __( 'Edit Event', 'gaviasframework' ),
        'new_item' => __( 'New Event', 'gaviasframework' ),
        'view_item' => __( 'View Event', 'gaviasframework' ),
        'search_items' => __( 'Search Event', 'gaviasframework' ),
        'not_found' => __( 'No Event found', 'gaviasframework' ),
        'not_found_in_trash' => __( 'No Event found in Trash', 'gaviasframework' ),
        'parent_item_colon' => __( 'Parent Event:', 'gaviasframework' ),
        'menu_name' => __( 'Events', 'gaviasframework' ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => true,
          'description' => 'List Event',
          'supports' => array( 'title', 'editor', 'thumbnail','excerpt'),
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'show_in_nav_menus' => false,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'has_archive' => true,
          'query_var' => true,
          'can_export' => true,
          'rewrite'    => array( 'slug' => 'event' ),
          'capability_type' => 'post'
      );
      $slug = apply_filters('gavias-post-type/slug-event', '');
      if($slug){
        $args['rewrite']['slug'] = $slug;
      }
      register_post_type( 'gva_event', $args );
    }
   add_action( 'init','gavias_post_type_event' ); 
  }

if(!function_exists('gavias_event_register_taxonomy')){
  function gavias_event_register_taxonomy(){
    $args = array(
        'labels' => array(
              'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'gaviasframework' ),
              'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'gaviasframework' ),
              'search_items'        => esc_html__( 'Search Categories', 'gaviasframework' ),
              'all_items'           => esc_html__( 'All Categories', 'gaviasframework' ),
              'parent_item'         => esc_html__( 'Parent Category', 'gaviasframework' ),
              'parent_item_colon'   => esc_html__( 'Parent Category:', 'gaviasframework' ),
              'edit_item'           => esc_html__( 'Edit Category', 'gaviasframework' ),
              'update_item'         => esc_html__( 'Update Category', 'gaviasframework' ),
              'add_new_item'        => esc_html__( 'Add New Category', 'gaviasframework' ),
              'new_item_name'       => esc_html__( 'New Category Name', 'gaviasframework' ),
              'menu_name'           => esc_html__( 'Categories', 'gaviasframework' ),
          ),
        'public'         => true,
        'hierarchical'     => true,
        'show_ui'        => true,
        'show_admin_column'  => true,
        'query_var'      => true,
        'show_in_nav_menus'  => false,
        'show_tagcloud'    => false
      );
    register_taxonomy('gva_event_cat', 'gva_event', $args);
  }
  add_action( 'init','gavias_event_register_taxonomy' );
}

// -- Dynamic Social Teacher Metabox -- 
  add_action( 'add_meta_boxes', 'gaviasthemer_event_speaker' );
  add_action( 'save_post', 'event_speaker_save_postdata' );
  function gaviasthemer_event_speaker() {
      add_meta_box(
          'gaviasthemer_event_speaker',
          __( 'Speaker', 'gaviasframework' ),
          'event_speaker_inner_custom_box',
          'gva_event');
  }
  function event_speaker_inner_custom_box() {
      global $post;
      wp_nonce_field( plugin_basename( __FILE__ ), 'dynamic_event_speaker_noncename' );
      ?>
      <div id="meta_inner">
      <?php

      $event_speakers = get_post_meta($post->ID, 'event_speakers', true);

      $c = 0;
      if ( ($event_speakers) && count( $event_speakers ) > 0 ) {
        foreach( $event_speakers as $speaker ) {
          if ( isset( $speaker['name'] ) || isset( $speaker['job'] ) || isset($speaker['avatar']) ) {
            if(!isset($speaker['name'])) $speaker['name'] = '';
            if(!isset($speaker['job'])) $speaker['job'] = '';
            if(!isset($speaker['avatar'])) $speaker['avatar'] = '';
            printf( '<p><input size="50" type="text" placeholder="Name" name="event_speakers[%1$s][name]" value="%2$s" /><input size="40" type="text" placeholder="Job" name="event_speakers[%1$s][job]" value="%3$s" /><br><span style="margin: 6px 0 0; display: block;"><input id="gva-speaker-avata-%1$s" size="100" type="text" placeholder="Avatar" readonly="true" name="event_speakers[%1$s][avatar]" value="%4$s" /><a class="button btn-select-avata-speaker" data-input="gva-speaker-avata-%1$s">Select Avatar</a></span><img class="menu-image-upload-demo" style="width: 150px; height:auto;" src="%4$s"><a class="button remove">%5$s</a></p>', $c, $speaker['name'], $speaker['job'], $speaker['avatar'], __( 'Remove' ) );
            $c = $c +1;
          }
        }
      }

      ?>
  <span id="event-speaker-list"></span>
  <a class="add-speaker-item"><?php _e('Add Speaker'); ?></a>
  <script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
      var count = <?php echo $c; ?>;
      $(".add-speaker-item").click(function() {
          count = count + 1;
          $('#event-speaker-list').append('<p><input size="50" type="text" placeholder="Name" name="event_speakers['+count+'][name]" value="" /><input size="40" type="text" placeholder="job" name="event_speakers['+count+'][job]" value="" /><br><span style="margin: 6px 0 0; display: block;"><input id="gva-speaker-avata-'+count+'" size="100" type="text" placeholder="Avatar" readonly="true" name="event_speakers['+count+'][avatar]" value="" /><a class="button btn-select-avata-speaker" data-input="gva-speaker-avata-'+count+'">Select Avatar</a></span><br><a class="remove button">Remove</a></p>' );
          return false;
      });
      $(".remove").on('click', function() {
          $(this).parent().remove();
      });

      $('body').delegate('.btn-select-avata-speaker', 'click', function( event ){
        var file_frame;
        event.preventDefault();
        var input = $(this).data('input');
        var img_demo = $(this).data('image');
        var $this = $(this);

        if ( file_frame ) {
            file_frame.open();
            return;
        } 

        file_frame = wp.media({
          multiple: false,
          title: 'Choose image',
          button: {
              text: 'upload',
          }
        });
        file_frame.on( 'select', function() {
            var attachment = file_frame.state().get( 'selection' ).first();
            $('#' + input).val(attachment.attributes.url);
            $this.parent().parent().find('.menu-image-upload-demo').each(function(){
                $(this).remove();
            });
            $this.parent().after('<div style="clear:both;"></div><img class="menu-image-upload-demo" style="width: 150px; height:auto;" src="'+ attachment.attributes.url +'"/>');
        });
        file_frame.open();
      });
      

    });

    </script>
  </div><?php
  }

  function event_speaker_save_postdata( $post_id ) {
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;
     if ( !isset( $_POST['dynamic_event_speaker_noncename'] ) )
        return;

     if ( !wp_verify_nonce( $_POST['dynamic_event_speaker_noncename'], plugin_basename( __FILE__ ) ) )
        return;
     $event_speakers = $_POST['event_speakers'];
     update_post_meta($post_id,'event_speakers', $event_speakers);
  }