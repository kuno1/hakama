<?php
/**
 *
 *
 * @package hakama
 */

load_theme_textdomain( 'hakama', 'languages' );

// Load autoloader
$autoloader = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $autoloader ) ) {
	require $autoloader;
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
