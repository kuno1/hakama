<?php

/**
 * Change redirect URL.
 *
 * @param string $url
 * @return string
 */
add_filter( 'makibishi_seller_connect_redirect', function( $url ) {
	if ( current_user_can( 'seller' ) ) {
		return $url;
	} else {
		return home_url( '/become-seller' );
	}
} );

/**
 * Register user as seller.
 */
add_action( 'makibishi_user_is_connected', function( $user_id ) {
	if ( ! current_user_can( 'seller' ) ) {
		// Make him seller.
		$user = new WP_User( $user_id );
		$user->set_role( 'seller' );
	}
} );

/**
 * Get Register short code
 */
add_shortcode( 'seller_register', function() {
	$seller_manager = \Kunoichi\Makibishi\Controller\SellerManager::get_instance();
	return hakama_trim( hakama_template( 'form-register', '', [
		'is_connected' => $seller_manager->is_connected( get_current_user_id() ),
		'is_seller'    => current_user_can( 'seller' ),
		'url'          => $seller_manager->connect_url(),
	], false ) );
} );
