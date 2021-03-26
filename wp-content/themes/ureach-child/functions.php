<?php
/**
 * Child-Theme functions and definitions
 */

function ureach_enqueue_styles() {
    wp_enqueue_style( 'ureach_parent-style', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'ureach_enqueue_styles' );

?>