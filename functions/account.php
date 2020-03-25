<?php
/**
 * Account related functions.
 *
 * @package hakama
 */

/**
 * Get account url
 *
 * @return string
 */
function hakama_account_url() {
	if ( hakama_has_woo() ) {
		return wc_get_account_endpoint_url( 'dashboard' );
	} else {
		return admin_url( 'profile.php' );
	}
}

/**
 * @param string $redirect_to
 *
 * @return string
 */
function hakama_login_url( $redirect_to = '' ) {
	if ( hakama_has_woo() ) {
		$url = wc_get_page_permalink( 'myaccount' );
		if ( $redirect_to ) {
			$url = add_query_arg( [
				'redirect_to' => $redirect_to,
			], $url );
		}
		return $url;
	} else {
		return wp_login_url( $redirect_to );
	}
}

/**
 * Get registration URL
 *
 * @param string $redirect_to
 *
 * @return string
 */
function hakama_registration_url( $redirect_to = '' ) {
	if ( hakama_has_woo() ) {
		$url = wc_get_page_permalink( 'myaccount' );
	} else {
		$url = wp_registration_url();
	}
	if ( $redirect_to ) {
		$url = add_query_arg( [
			'redirect_to' => $redirect_to,
		], $url );
	}
	return $url;
}

/**
 * Get user's short name.
 *
 * @param null|WP_User $user
 *
 * @return string
 */
function hakama_short_name( $user = null ) {
	if ( ! $user ) {
		$user = get_userdata( get_current_user_id() );
	} elseif ( is_numeric( $user ) ) {
		$user = get_userdata( $user );
	}
	if ( ! $user ) {
		return __( 'Guest', 'hakama' );
	}
	$fist_name = $user->first_name;
	return $fist_name ?: $user->display_name;
}

/**
 * Get back link.
 *
 * @return string
 */
function hakama_admin_back_link() {
	$screen = get_current_screen();
	if ( 'post' === $screen->base ) {
		$url = admin_url( 'edit.php' );
		switch ( $screen->post_type ) {
			case 'post':
				// Do nothing.
				break;
			case 'brand':
				if ( current_user_can( 'seller' ) ) {
					$url = \Hametuha\Hashboard::screen_url( 'brand' );
				}
				break;
			case 'faq':
				if ( current_user_can( 'seller' ) ) {
					$url = \Hametuha\Hashboard::screen_url( 'documentation' );
				}
				break;
			case 'product':
				if ( $parent = wp_get_post_parent_id( filter_input( INPUT_GET, 'post' ) ) ) {
					$url = \Hametuha\Hashboard::screen_url( sprintf( 'editor/brand/%d#products', $parent ) );
				} else {
					$url = \Hametuha\Hashboard::screen_url( 'products' );
				}
				break;
			default:
				$url = add_query_arg( [
					'post_type' => $screen->post_type,
				], $url );
				break;
		}
		return $url;
	} else {
		return \Hametuha\Hashboard::screen_url();
	}
}

/**
 * Get dashboard URL
 *
 * @return string
 */
function hakama_admin_dashboard_link() {
	if ( class_exists( 'Hametuha\\HashBoard' ) ) {
		$url = \Hametuha\Hashboard::screen_url();
	} else {
		$url = admin_url();
	}
	return $url;
}
