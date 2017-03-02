<?php
/**
 * ItalyStrap init file
 *
 * Init the plugin front-end functionality
 *
 * @link www.italystrap.com
 * @since 4.0.0
 *
 * @package ItalyStrap
 */

namespace ItalyStrap\Core;

use ItalyStrap\Core\Asset\Inline_Style;
use ItalyStrap\Core\Cache\Menu as Menu_Cache;
use ItalyStrap\Core\Social\Share;

if ( ! defined( 'ITALYSTRAP_PLUGIN' ) or ! ITALYSTRAP_PLUGIN ) {
	die();
}

if ( is_admin() ) {
	return;
}

/**
 * Adjust priority to make sure this runs
 */
add_action( 'init', array( $init, 'on_load' ), 100 );

if ( isset( $options['media_carousel_shortcode'] ) ) {
	$init->add_carousel_to_gallery_shortcode();
}

if ( ! empty( $options['widget_visibility'] ) ) {
	add_action( 'init', array( 'ItalyStrap\Widget\Visibility\Visibility', 'init' ) );
}

/**
 * Instantiate Init Class
 *
 * @var Init
 */
// $customizer_manager = $injector->make( 'ItalyStrap\Admin\Customizer_Manager' );
// add_action( 'customize_register', array( $customizer_manager, 'register_init' ), 11 );

/**
 * Activate LazyLoad
 */
if ( ! empty( $options['lazyload'] ) ) {
	/**
	 * Instantiate lazy_load_image Class
	 *
	 * @var lazy_load_image
	 */
	$lazy_load_image = $injector->make( 'ItalyStrap\Core\Lazyload\Lazy_Load_Image' );
	$lazy_load_image::init();
}

if ( ! empty( $options['lazyload_video'] ) ) {
	/**
	 * Instantiate lazy_load_video Class
	 *
	 * @var lazy_load_video
	 */
	$lazy_load_video = $injector->make( 'ItalyStrap\Core\Lazyload\Video' );
}

/**
 * This filter render HTML in widget title parsing {{}}
 */
if ( isset( $options['render_html_in_widget_title'] ) ) {
	add_filter( 'widget_title', 'ItalyStrap\Core\render_html_in_title_output' );
}

/**
 * Instantiate MobileDetect Class
 *
 * @var MobileDetect
 */
// $mobile_detect = $injector->make( 'Detection\MobileDetect' );
/**
 * This filter is applyed in class-carousel in get_img_size_attr() method
 * @todo Create an injection for Detection\MobileDetect in carousel class
 */
add_filter( 'mobile_detect', 'ItalyStrap\Core\new_mobile_detect' );

if (  ! empty( $options['activate_custom_css'] )  ) {
	/**
	 * Instantiate Post_Meta Class
	 *
	 * @var Post_Meta
	 */
	$post_meta = $injector->make( 'ItalyStrap\Core\Postmeta\Post_Meta' );

	/**
	 * Get metaboxes value
	 */
	add_action( 'wp', array( $post_meta, 'add_post_type_custom_css' ) );
	add_filter( 'body_class', array( $post_meta, 'body_class' ) );
	add_filter( 'post_class', array( $post_meta, 'post_class' ) );
}

// if (  ! empty( $options['activate_custom_script'] )  ) {
// 	add_action( 'wp_footer', function () {
// 		echo apply_filters( 'italystrap_footer_scripts', $options['custom_script'] );
// 	});
// }

if ( ! empty( $options['web_font_loading'] ) ) {
	/**
	 * Load the Web_Font_Loading classes
	 *
	 * @var Web_Font_loading
	 */
	$web_font_loading = $injector->make( 'ItalyStrap\Core\Web_Font_Loading' );
	add_action( 'wp_footer', array( $web_font_loading, 'lazy_load_fonts'), 9999 );
}

if ( ! empty( $options['widget_attributes'] ) ) {
	/**
	 * Init the Widget_Attributes
	 *
	 * @var Widget_Attributes
	 */
	$injector->define( 'ItalyStrap\Widget\Attributes\Attributes', array( 'fields_type' => 'ItalyStrap\Fields\Fields' ) );
	$widget_attributes = $injector->make( 'ItalyStrap\Widget\Attributes\Attributes' );
	// add_action( 'widgets_init', array( 'Widget_Attributes', 'setup' ) );
	add_filter( 'dynamic_sidebar_params', array( $widget_attributes, 'insert_attributes' ) );
}

/**
 * Option for killing the emojis
 */
if ( ! empty( $options['kill-emojis'] ) ) {
	add_action( 'init', 'ItalyStrap\Core\kill_emojis' );
}

/**
 * General
 * Allow shortcode in widget text.
 */
if ( ! empty( $options['do_shortcode_widget_text'] ) ) {
	add_filter( 'widget_text', 'do_shortcode' );
}

if ( ! empty( $options['remove_widget_title'] ) ) {
	/**
	 * @see ItalyStrap\Core\remove_widget_title()
	 */
	add_filter( 'widget_title', '\ItalyStrap\Core\remove_widget_title', 999 );
}

if ( ! empty( $options['activate_analytics'] ) ) {
	/**
	 * Generate the Google analytics code
	 *
	 * @var Generate_Analytics
	 */
	$analytics = $injector->make( 'ItalyStrap\Core\Google\Analytics' );
	add_action( 'wp_footer', array( $analytics, 'render_analytics' ), 99999 );
}

/**
 * @link https://github.com/inpsyde/menu-cache
 */
if ( ! empty( $options['menu_cache'] ) && version_compare( PHP_VERSION, '5.4.0', '>=' ) ) {

	$cache = new Menu_Cache();

	add_filter( 'pre_wp_nav_menu', array( $cache, 'get_menu' ), 10, 2 );

	// Unfortunately, there is no appropriate action, so we have to (mis)use a filter here. Almost as last as possible.
	add_filter( 'wp_nav_menu', array( $cache, 'cache_menu' ), PHP_INT_MAX - 1, 2 );
}

if ( ! empty( $options['activate_social_share'] ) && is_beta() ) {

	$social_share = $injector->make( 'ItalyStrap\Core\Social\Share' );
	add_filter( 'the_content', array( $social_share, 'add_social_button' ), 9999, 1 );
}

if ( ! empty( $options['activate_excerpt_more_mods'] ) ) {

	$excerpt = $injector->make( 'ItalyStrap\Core\Excerpt\Excerpt' );
	add_filter( 'get_the_excerpt', array( $excerpt, 'custom_excerpt_more') );
	add_filter( 'excerpt_more', array( $excerpt, 'read_more_link') );
	add_filter( 'excerpt_length', array( $excerpt, 'excerpt_length') );
	add_filter( 'wp_trim_words', array( $excerpt, 'excerpt_end_with_punctuation' ), 10, 4 );
}

/**
 * Set CSS from admin option Script
 */
Inline_Style::set( strip_tags( $options['custom_css'] ) );

if ( ! empty( $options['show_theme_hooks'] ) ) {
	$event_manager->add_subscriber( $injector->make( 'ItalyStrap\Debug\Visual_Hook' ) );
}

/**
 * Print the inline assets
 */
$event_manager->add_subscriber( $injector->make( 'ItalyStrap\Core\Asset\Inline_Asset_Factory' ) );
