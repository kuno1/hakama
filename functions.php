<?php
/**
 *
 *
 * @package hakama
 */

load_theme_textdomain( 'hakama', __DIR__ . '/languages' );

// Load autoloader
$autoloader = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $autoloader ) ) {
	require $autoloader;
	$base_dir = __DIR__ . '/app/Kunoichi/Hakama';
	foreach ( [ 'Widgets' ] as $dir ) {
		$path = $base_dir . '/' . $dir;
		if ( ! is_dir( $path ) ) {
			continue;
		}
		foreach ( scandir( $path ) as $file ) {
			if ( preg_match( '#^([^._].*)\.php$#u', $file, $matches ) ) {
				$class_name = 'Kunoichi\\Hakama\\' . $dir . '\\' . $matches[1];
				if ( class_exists( $class_name ) ) {
				
				}
			}
		}
	}
}

// Load all subroutines.
foreach ( [ 'hooks', 'functions' ] as $dir ) {
	$dir = get_template_directory() . '/' . $dir;
	if ( is_dir( $dir ) ) {
		foreach ( scandir( $dir ) as $file ) {
			if ( ! preg_match( '#^[^._].*\.php$#u', $file ) ) {
				continue;
			}
			include $dir . '/' . $file;
		}
	}
}
