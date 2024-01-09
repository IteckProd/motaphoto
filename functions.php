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
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

function mytheme_enqueue_scripts() {
    wp_enqueue_script('mytheme-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');



function mytheme_get_header($name = null) {
    $templates = array();
    $name = (string) $name;
    if ('' !== $name) {
        $templates[] = "templates-part/header-{$name}.php";
    }

    $templates[] = 'templates-part/header.php';

    locate_template($templates, true);
}
add_action('get_header', 'mytheme_get_header');

function mytheme_get_footer($name = null) {
    $templates = array();
    $name = (string) $name;
    if ('' !== $name) {
        $templates[] = "templates-part/footer-{$name}.php";
    }

    $templates[] = 'templates-part/footer.php';

    locate_template($templates, true);
}
add_action('get_footer', 'mytheme_get_footer');

function mytheme_register_menus() {
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'mytheme_register_menus');





