<?php
/**
 * Editor related functions
 *
 * @package hakama
 */

/**
 * Allow gutenberg to edit.
 *
 * @param bool   $can_edit
 * @param string $post_type
 * @return bool
 */
add_filter( 'gutenberg_can_edit_post_type', function( $can_edit, $post_type ) {
	switch ( $post_type ) {
		case 'page':
		case 'post':
			return true;
			break;
		default:
			return $can_edit;
			break;
	}
}, 10, 2 );

/**
 * Remove header and sidebar from admin screen.
 *
 * @param string $page
 */
add_action( 'admin_enqueue_scripts', function( $page ) {
	$screen = get_current_screen();
	if ( ! current_user_can( 'edit_others_posts' ) ) {
		wp_enqueue_style( 'hakama-editor' );
		// Render admin header.
		add_action( 'admin_footer', function() {
			if ( ! current_user_can( 'edit_others_posts' ) ) {
				hakama_template( 'header-admin' );
			}
		} );
	}
} );


/**
 * Change admin style for post editor.
 *
 * @param mixed  $result
 * @param string $option
 * @param WP_User $user
 * @return mixed
 */
add_filter( 'get_user_option_admin_color', function( $result, $option, $user ) {
	return 'midnight';
}, 10, 3 );

/**
 * Add link to Woo dashboard.
 */
add_filter( 'woocommerce_account_menu_items', function( $links ) {
	$new_links = [];
	foreach ( $links as $key => $label ) {
		$new_links[ $key ] = $label;
		switch ( $key ) {
			case 'dashboard':
				if ( current_user_can( 'edit_others_posts' ) ) {
					$new_links[ 'wp-admin' ] = __( 'WordPress Admin', 'hakama' );
				}
				if ( current_user_can( 'seller' ) ) {
					$new_links[ 'seller' ]   = __( 'Seller Dashboard', 'hakama' );
				}
				break;
			default:
				// Do nothing.
				break;
		}
	}
	return $new_links;
}, 10, 1 );



/**
 * Change account URL endpoint.
 *
 * @param string $url
 * @param string $enpoint
 * @param string $value
 * @param string $permalink
 * @return string
 */
add_filter( 'woocommerce_get_endpoint_url', function( $url, $endpoint, $value, $permalink ) {
	if ( 'seller' ===  $endpoint && class_exists( 'Hametuha\\Hashboard' ) ) {
		$url = Hametuha\Hashboard::screen_url();
	} elseif ( 'wp-admin' === $endpoint ) {
		$url = admin_url();
	}
	return $url;
}, 10, 4 );