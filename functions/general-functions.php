<?php
/**
 * General functions for the plugin
 *
 * @package ItalyStrap
 * @since   2.0.0
 */

namespace ItalyStrap\Core;

use \ItalyStrapAdminMediaSettings;

/**
 * Combine user attributes with known attributes and fill in defaults when needed.
 *
 * The pairs should be considered to be all of the attributes which are
 * supported by the caller and given as a list. The returned attributes will
 * only contain the attributes in the $pairs list.
 *
 * If the $atts list has unsupported attributes, then they will be ignored and
 * removed from the final returned list.
 *
 * @since 2.0.0
 *
 * @param array  $pairs     Entire list of supported attributes and their defaults.
 * @param array  $atts      User defined attributes in shortcode tag.
 * @param string $shortcode Optional. The name of the shortcode, provided for context to enable filtering.
 * @return array Combined and filtered attribute list.
 */
function shortcode_atts_multidimensional_array( array $pairs, array $atts, $shortcode = '' ) {

	$atts = (array) $atts;

	$array = array();

	foreach ( $pairs as $name => $default ) {

		if ( array_key_exists( $name, $atts ) ) {
			$array[ $name ] = $atts[ $name ]; } else {
			$array[ $name ] = ( ( ! empty( $default['default'] ) ) ? $default['default'] : '' ); }
	}

	/**
	 * Filter a shortcode's default attributes.
	 *
	 * If the third parameter of the shortcode_atts() function is present then this filter is available.
	 * The third parameter, $shortcode, is the name of the shortcode.
	 *
	 * @param array  $array       The output array of shortcode attributes.
	 * @param array  $pairs     The supported attributes and their defaults.
	 * @param array  $atts      The user defined shortcode attributes.
	 * @param string $shortcode The shortcode name.
	 */
	if ( $shortcode ) {
		$array = apply_filters( "shortcode_atts_multidimensional_array_{$shortcode}", $array, $pairs, $atts, $shortcode );
	}

	return $array;

}

/**
 * Read and return file content
 *
 * @link https://tommcfarlin.com/reading-files-with-php/
 *
 * @param  file $filename	The file for lazyloading.
 *
 * @throws Exception If the file doesn't exist.
 *
 * @return string $content	Return the content of the file
 */
function get_file_content( $filename ) {

	// Check to see if the file exists at the specified path.
	if ( ! file_exists( $filename ) ) {
		throw new Exception( __( 'The file doesn\'t exist.', 'ItalyStrap' ) ); }

	// Open the file for reading.
	$file_resource = fopen( $filename, 'r' );

	/**
	 * Read the entire contents of the file which is indicated by
	 * the filesize argument
	 */
	$content = fread( $file_resource, filesize( $filename ) );
	fclose( $file_resource );

	return $content;

}

/**
 * Get an array with the taxonomies list
 *
 * @param  string $tax The name of taxonomy type.
 * @return array       Return an array with tax list
 */
function get_taxonomies_list_array( $tax ) {

	/**
	 * Array of taxonomies
	 *
	 * @todo Make object cache, see https://10up.github.io/Engineering-Best-Practices/php/#performance
	 * @todo Add a default value
	 * @var array
	 */
	$tax_arrays = get_terms( $tax );

	$get_taxonomies_list_array = array();

	if ( $tax_arrays && ! is_wp_error( $tax_arrays ) ) {

		foreach ( $tax_arrays as $tax_array ) {

			$get_taxonomies_list_array[ $tax_array->term_id ] = $tax_array->name;

		}
	}

	return $get_taxonomies_list_array;
}

/**
 * Get the size media registered
 *
 * @param  array $custom_size Custom size.
 * @return array               Return the array with all media size plus custom size
 */
function get_image_size_array( $custom_size = array() ) {

	/**
	 * Instance of list of image sizes
	 *
	 * @var ItalyStrapAdminMediaSettings
	 */
	$image_size_media = new ItalyStrapAdminMediaSettings;

	$image_size_media_array = (array) $image_size_media->get_image_sizes( array( 'full' => __( 'Real size', 'ItalyStrap' ) ) );

	return $image_size_media_array;

}

/**
 * Convert open square and closed square in < > and
 * allow you to put some HTML tag in title, widget and post.
 *
 * Function from HTML Widget Text plugins
 *
 * @author Jaimyn Mayer https://jabelone.com.au
 *
 * @package ItalyStrap
 * @since 2.0.0
 * @param  string $title The title.
 * @return string        The title converted
 */
function render_html_in_title_output( $title ) {

	$tagopen = '['; // Our HTML opening tag replacement.
	$tagclose = ']'; // Our HTML closing tag replacement.

	$title = str_replace( $tagopen, '<', $title );
	$title = str_replace( $tagclose, '>', $title );

	return $title;

}

/**
 * Return the instance of Mobile Detect
 * Use this function with apply_filter and then add_filter
 * Example:
 * Add this snippet where you want use the object
 * $detect = '';
 * $detect = apply_filters( 'mobile_detect', $detect );
 *
 * Then use add_filter to append object
 * add_filter( 'mobile_detect', 'ItalyStrap\Core\new_mobile_detect' );
 *
 * @see class-carousel.php for more information
 * @param  null $mobile_detect An empty variable.
 * @return object              Instance of Mobiloe detect
 */
function new_mobile_detect( $mobile_detect ) {

	$mobile_detect = new \Detection\MobileDetect;
	/**
	 * Istantiate Mobile_Detect class for responive use
	 *
	 * @todo Passare l'istanza dentro la classe http://stackoverflow.com/a/10634148
	 * @var obj
	 */
	return $mobile_detect;

}
