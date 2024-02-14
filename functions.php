<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage motaphoto
 * @since motaphoto 1.0
 */

function mytheme_enqueue_styles() {
  wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;1,400&display=swap');
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

function mytheme_enqueue_scripts() {
    wp_enqueue_script('mytheme-scripts', get_template_directory_uri() . '/js/scripts.js', array());
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

function mytheme_register_menus() {
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'mytheme_register_menus');

add_filter('template_include', 'load_custom_template');

function load_custom_template($template) {
  if (is_page()) { // Vérifiez si une page WordPress est affichée
    $custom_template = locate_template(array('templates/page.php'));
    if (!empty($custom_template)) {
      return $custom_template;
    }
  }
  return $template; 
}







