<?php
/**
 * Asset subroutines.
 *
 * @package hakama
 */

add_action( 'after_setup_theme', function() {
	// For plugin icon.
	set_post_thumbnail_size( 512, 512, true );
	// For slide show, same aspect ratio with WP plugin dir. (772x250)
	add_image_size( 'carousel', 2316, 750, true );
} );

/**
 * Register files.
 */
add_action( 'init', function() {
	// Register external libraries.
	wp_register_style( 'fontawesome5', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', null,  '5.2.0' );
	// All
	$version = wp_get_theme()->get( 'Version' );
	foreach ( [
		[ 'hakama-i18n', 'js/hakama.js', [ 'wp-i18n' ] ],
		[ 'hakama', 'js/hakama.js', [ 'wp-i18n' ] ],
		[ 'bootstrap', 'css/hakama.css', [ 'fontawesome5', 'material-design-icon' ] ],
		[ 'hakama-editor', 'css/hakama-editor.css', [] ],
		[ 'hakama-block-editor-style', 'css/hakama-editor-style.css', [ 'fontawesome5' ] ],
		[ 'hakama-block-style', 'js/editor-styles.js', [ 'hakama-i18n', 'wp-blocks'] ],
		[ 'swiper-custom', 'css/hakama-swiper.css', [ 'bootstrap' ] ],
		[ 'swiper', 'js/swiper.min.js', [] ],
		[ 'swiper-helper', 'js/hakama-swiper.js', [ 'swiper', 'jquery' ] ],
	] as list( $handle, $path, $deps ) ) {
		$path = '/assets/' . $path;
		$js = preg_match( '/\.jsx?$/u', $path );
		$full_path = get_template_directory() . $path;
		if ( ! file_exists( $full_path ) ) {
			trigger_error( sprintf( 'File %s doesn\'t exist', $path ) );
			continue;
		}
		$url = get_template_directory_uri() . $path;
		$version = filemtime( $full_path );
		if ( $js ) {
			wp_register_script( $handle, $url, $deps, $version, true );
		} else {
			wp_register_style( $handle, $url, $deps, $version );
		}
	}

	// Register translations.
	wp_set_script_translations( 'hakama-i18n', 'hakama', get_template_directory() . '/languages' );
} );

//<link rel="stylesheet" href="">

// Change src for font awesome.
add_filter( 'style_loader_tag', function ( $tag, $handle ) {
	if ( 'fontawesome5' === $handle ) {
		$tag = str_replace( '/>', " integrity='sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ' crossorigin='anonymous'/>", $tag );
	}
	return $tag;
}, 10, 2 );
																																													  /**
 * Register scripts.
 */
add_action('wp_enqueue_scripts', function() {
	global $wp_styles;
	if ( isset( $wp_styles->registered['bootstrap'] ) ) {
		$wp_styles->registered['bootstrap']->deps[] = 'fontawesome5';
		if ( hakama_has_woo() ) {
			$wp_styles->registered['bootstrap']->deps[] = 'woocommerce-general';
		}
	}
	wp_enqueue_script( 'hakama' );
	wp_enqueue_style( 'bootstrap' );
});
