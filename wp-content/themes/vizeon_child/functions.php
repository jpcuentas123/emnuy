<?php
/**
 *
 * @package [Parent Theme]
 * @author  gaviasthemes <gaviasthemes@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * 
 */

function vizeon_child_scripts() {
   wp_enqueue_style( 'vizeon-parent-style', get_template_directory_uri(). '/style.css');
   wp_enqueue_style( 'vizeon-child-style', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'vizeon_child_scripts', 9999 );