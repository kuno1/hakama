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
	$version = wp_get_theme()->get( 'Version' );
	wp_register_script( 'hakama', get_template_directory_uri() . '/assets/js/hakama.app.js', [ 'bootstrap', 'jquery-masonry' ], $version, true );
	wp_register_style( 'fontawesome5', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', null,  '5.2.0' );
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/style.css', [ 'material-design-icon' ], $version );
	wp_register_style( 'hakama-editor', get_template_directory_uri() . '/assets/css/editor.css', [], $version );
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
