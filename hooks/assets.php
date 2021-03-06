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
	// Support alignfull
	add_theme_support( 'align-wide' );
} );

/**
 * Remove jQuery migrate
 */
add_action( 'init', function() {
	// If admin, skip.
	if ( is_admin() || ( isset( $_SERVER['SCRIPT_FILENAME'] ) && 'wp-login.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) ) {
		return;
	}
	global $wp_scripts;
	$jquery = $wp_scripts->registered['jquery-core'];
	$jquery_ver = $jquery->ver;
	$jquery_src = $jquery->src;
	// Deregister.
	wp_deregister_script( 'jquery' );
	wp_deregister_script( 'jquery-core' );
	// Re-register.
	wp_register_script( 'jquery-core', $jquery_src, [], $jquery_ver, false );
	wp_register_script( 'jquery', false, ['jquery-core'], $jquery_ver, false );

}, 1 );

/**
 * Register files.
 */
add_action( 'init', function() {
	// Register external libraries.
	wp_register_style( 'fontawesome5', 'https://use.fontawesome.com/releases/v5.14.0/css/all.css', null,  '5.14.0' );
	// All
	$version = wp_get_theme()->get( 'Version' );
	foreach ( [
		[ 'hakama-i18n', 'js/hakama.js', [ 'wp-i18n' ] ],
		[ 'hakama', 'js/hakama.app.js', [ 'hakama-i18n', 'bootstrap' ] ],
		[ 'hakama-tracking', 'js/hakama-tracking.js', [ 'jquery' ] ],
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
		$tag = str_replace( '/>', " integrity='sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc' crossorigin='anonymous'/>", $tag );
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

	if ( is_singular( 'product' ) ) {
		wp_enqueue_script( 'swiper-helper' );
		wp_enqueue_style( 'swiper-custom' );
	}

	if ( is_singular() ) {
		$brand = hakama_get_brand();
		wp_enqueue_script( 'hakama-tracking' );
		wp_localize_script( 'hakama-tracking', 'HakamaTracking', [
			'id'     => get_queried_object_id(),
			'type'   => get_queried_object()->post_type,
			'parent' => $brand ? $brand->ID : 0,
		] );
	}
});

/**
 * Remove not serif jp to be loaded.
 */
add_filter( 'gettext_with_context', function( $translation, $text, $context, $domain ) {
	switch ( $context ) {
		case 'Google Font Name and Variants':
			$translation = 'off';
			break;
		case 'CSS Font Family for Editor Font':
			$translation = 'YuMincho';
			break;
	}
	return $translation;
}, 10, 4 );

/**
 * Start buffer for replacing img tag.
 */
add_action( 'wp_head', function() {
	ob_start();
}, 9999 );

/**
 * Replace img tag.
 */
add_action( 'wp_footer', function() {
	$body     = ob_get_contents();
	$replaced = preg_replace_callback( '#<img([^>]+)>#u', function( $matches ) {
		list( $match, $attr ) = $matches;
		foreach ( [
					  'loading'  => 'lazy',
				  ] as $key => $val ) {
			if ( false !== strpos( $attr, $key . '=' ) ) {
				continue;
			}
			$attr = sprintf( ' %s="%s"%s', $key, $val, $attr );
		}
		return sprintf( '<img%s>', $attr );
	}, $body );
	ob_end_clean();
	echo $replaced;
}, 9999 );
