<?php
/**
 * Menu related functions.
 *
 * @package hakama
 */

// Register menus
add_action( 'after_setup_theme', function() {
	register_nav_menus( [
		'global_menu' => _x( 'Global menu.', 'admin', 'hakama' ),
	] );
} );

/**
 * Add body class
 */
add_filter( 'body_class', function( $classes ) {
	$classes[] = 'with-header-nav';
	return $classes;
} );

/**
 * Filter capability
 */
add_filter( 'hashboard_wp_link_cap', function() {
	return 'edit_others_posts';
} );

/**
 * Change redirect URL
 *
 * @param string $redirect_to
 * @param string $default_redirect_to
 * @param WP_User $user
 */
add_filter( 'login_redirect', function( $redirect_to, $requested_redirect_to, $user ) {
	if ( ! $user || is_wp_error( $user ) ) {
		return $redirect_to;
	}
	/** @var WP_User $user */
	if ( $requested_redirect_to && ! preg_match( '#/wp-admin#u', $requested_redirect_to ) ) {
		return $redirect_to;
	}
	if ( $user->has_cap( 'edit_others_posts' ) ) {
		return $redirect_to;
	} elseif ( $user->has_cap( 'seller' ) ) {
		return \Hametuha\Hashboard::screen_url();
	} else {
		return get_permalink( wc_get_page_id( 'myaccount' ) );
	}
}, 10, 3 );
