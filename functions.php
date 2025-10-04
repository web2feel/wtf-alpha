<?php
/**
 * WTF Alpha Theme Functions
 *
 * @package WTF_Alpha
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function wtf_alpha_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'wtf-alpha'),
        'footer'  => esc_html__('Footer Menu', 'wtf-alpha'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add theme support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'wtf_alpha_setup');

/**
 * Register widget areas
 */
function wtf_alpha_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'wtf-alpha'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'wtf-alpha'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-xl font-bold mb-4">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer', 'wtf-alpha'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'wtf-alpha'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title text-lg font-semibold mb-3">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'wtf_alpha_widgets_init');

/**
 * Enqueue scripts and styles
 */
function wtf_alpha_scripts() {
    $theme_version = wp_get_theme()->get('Version');
    
    // Enqueue CSS
    wp_enqueue_style(
        'wtf-alpha-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        $theme_version
    );
    
    // Enqueue JS
    wp_enqueue_script(
        'wtf-alpha-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $theme_version,
        true
    );

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wtf_alpha_scripts');

/**
 * Custom navigation walker for Tailwind CSS
 */
require get_template_directory() . '/inc/class-tailwind-nav-walker.php';

/**
 * Custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Theme customizer
 */
require get_template_directory() . '/inc/customizer.php';
