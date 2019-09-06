<?php
/**
 * Setting for theme.
 *
 *
 * @package hakama
 */


/**
 * Register supports.
 */
add_action( 'after_setup_theme', function() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 128,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', [
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	] );
	add_theme_support( 'woocommerce' );
} );

// Hide admin bar.
add_filter( 'show_admin_bar', '__return_false' );

// Change
add_filter( 'private_title_format', function( $filter, $post ) {
	return '%s';
}, 10, 2 );

// Change redirect
add_action( 'template_redirect', function () {
	global $wp;
	if ( isset( $wp->query_vars['customer-logout'] ) && wp_verify_nonce( filter_input( INPUT_GET, '_wpnonce' ), 'customer-logout' ) ) {
		$user = wp_get_current_user();
		// Logout.
		wp_logout();
		// Set redirect to.
		if ( ! empty( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $requested_redirect_to = $_REQUEST['redirect_to'];
		} else {
			$redirect_to           = wc_get_page_permalink( 'myaccount' );
			$requested_redirect_to = '';
		}
		/**
		 * Filters the log out redirect URL.
		 * @see ll.544 of wp-login.php
		 */
		$redirect_to = apply_filters( 'logout_redirect', $redirect_to, $requested_redirect_to, $user );
		wp_safe_redirect( $redirect_to );
		exit();
	}
}, 9 );
